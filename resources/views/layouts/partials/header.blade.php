<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold text-info" href="{{ route('home') }}">🏥 Hospital System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">

                @auth
                    {{-- Admin-only links --}}
                    @if (Auth::user()->user_type === 'admin')
                        <li class="nav-item"><a class="nav-link text-light" href="{{ route('countries.index') }}">Countries</a></li>
                        <li class="nav-item"><a class="nav-link text-light" href="{{ route('regions.index') }}">Regions</a></li>
                        <li class="nav-item"><a class="nav-link text-light" href="{{ route('addresses.index') }}">Addresses</a></li>
                        <li class="nav-item"><a class="nav-link text-light" href="{{ route('hospitals.index') }}">Hospitals</a></li>
                        <li class="nav-item"><a class="nav-link text-light" href="{{ route('rooms.index') }}">Rooms</a></li>
                        <li class="nav-item"><a class="nav-link text-light" href="{{ route('users.index') }}">Users</a></li>
                        <li class="nav-item"><a class="nav-link text-light" href="{{ route('medicine_companies.index') }}">Companies</a></li>
                    @endif

                    {{-- Medicines for doctor/pharmacist/admin --}}
                    @if (in_array(Auth::user()->user_type, ['doctor', 'pharmacist', 'admin']))
                        <li class="nav-item"><a class="nav-link text-light" href="{{ route('medicines.index') }}">Medicines</a></li>
                    @endif

                    {{-- Medicine Descriptions for all roles except nurse --}}
                    @if (Auth::user()->user_type !== 'nurse')
                        <li class="nav-item"><a class="nav-link text-info fw-semibold" href="{{ route('medicine_descriptions.index') }}">My Prescriptions</a></li>
                    @endif

                    {{-- Profile and Logout --}}
                    <li class="nav-item"><a class="nav-link text-light" href="{{ route('profile') }}">Profile</a></li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('auth.logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-light ms-2">Logout</button>
                        </form>
                    </li>
                @else
                    {{-- Guest links --}}
                    <li class="nav-item"><a class="nav-link text-light" href="{{ route('register') }}">Register</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="{{ route('login') }}">Login</a></li>
                @endauth

            </ul>
        </div>
    </div>
</nav>