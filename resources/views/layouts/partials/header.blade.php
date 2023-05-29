<nav class="navbar navbar-expand-md navbar-light bg-black shadow-sm">
    <div class="container-fluid px-5">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <div class="logo_boolean">
                <img src="{{Vite::asset('resources/img/boolean-logo.png')}}" alt="">
            </div>
            {{-- config('app.name', 'Laravel') --}}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto d-flex gap-3">
                <li class="nav-item d-flex align-items-center">
                    <h1 class="__bordered-text fw-bold" style="">Boolfolio</h1>
                </li>
                <li class="nav-item d-flex align-items-center">
                    <a class="nav-link text-white fw-bold" href="{{url('/') }}">{{ __('Home') }}</a>
                </li>

                @if (auth()->check())
                <li class="nav-item d-flex align-items-center">
                    <a href="{{route('admin.dashboard.home') }}" class=" fw-bold text-white">Admin Area</a>
                </li>
                @endif
            </ul>


            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                <li class="nav-item">
                    <a class="nav-link text-white fw-bold" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link text-white fw-bold" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('admin.dashboard.home') }}">{{__('Dashboard')}}</a>
                        <a class="dropdown-item" href="{{ route('profile.edit')}}">{{__('Profile')}}</a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
