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
            $nameCommon = data_get($country, 'name.common');
            $nameOfficial = data_get($country, 'name.official');
            $code = data_get($country, 'cca2');
            $flagUrl = data_get($country, 'flags.png');

            if (!($nameCommon && $nameOfficial && $code && $flagUrl)) {
                continue;
            }

            Country::updateOrCreate(
                ['code' => $code],
                [
                    'name' => $nameCommon,
                    'official_name' => $nameOfficial,
                    'flag_url' => $flagUrl,
                ]
            );

            $inserted++;
        }

        return $inserted;
    }
}