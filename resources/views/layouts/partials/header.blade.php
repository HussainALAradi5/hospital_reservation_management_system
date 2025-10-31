<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">Hospital System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">

                @auth
                    @if (Auth::user()->user_type === 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('countries.index') }}">Countries</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('regions.index') }}">Regions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('addresses.index') }}">Addresses</a>
                        </li>
                    @endif

                    @if (in_array(Auth::user()->user_type, ['doctor', 'pharmacist', 'admin']))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('medicines.index') }}">Medicines</a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile') }}">Profile</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('auth.logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link" style="padding: 0;">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>
