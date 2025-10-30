<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Country;

class CountryService
{
    public function fetchCountries(): array
    {
        $baseUrl = config('services.country_api.base');

        if (! $baseUrl) {
            throw new \Exception("API base URL is not configured.");
        }

        $response = Http::timeout(15)->retry(3, 1000)->get($baseUrl, [
            'fields' => 'name,cca2,flags',
        ]);

        if (! $response->successful()) {
            throw new \Exception("Failed to fetch country data.");
        }

        return $response->json();
    }

    public function storeCountries(array $countries): int
    {
        $inserted = 0;

        foreach ($countries as $country) {
            if (
                !isset($country['name']['common']) ||
                !isset($country['name']['official']) ||
                !isset($country['cca2']) ||
                !isset($country['flags']['png'])
            ) {
                continue;
            }

            Country::updateOrCreate(
                ['code' => $country['cca2']],
                [
                    'name' => $country['name']['common'],
                    'official_name' => $country['name']['official'],
                    'flag_url' => $country['flags']['png'],
                ]
            );

            $inserted++;
        }

        return $inserted;
    }
}