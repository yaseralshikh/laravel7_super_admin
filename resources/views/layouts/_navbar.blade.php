<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('home') }}">Home
                    <span class="sr-only">(current)</span>
                    </a>
                </li>
                
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Categories
                    </a>
                    <!-- Categories Links -->
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        @foreach ( $nav_categories as $category )
                        <a class="dropdown-item" href="{{ route('home',$category->id) }}">
                            {{ ucfirst(trans($category->name)) }}
                        </a>
                        @endforeach
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('home') }}">
                            All
                        </a>
                    </div>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('profile', auth()->user()->id ) }}">Profile</a>

                            @if (auth()->user()->hasRole('super_admin|admin'))
                                <a class="dropdown-item" href="{{ route('dashboard.welcome') }}">Dashboard</a>
                                <div class="dropdown-divider"></div>
                            @endif
                            
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
            <form class="form-inline my-2 my-lg-0" action="{{ route('search') }}" method="POST">
                @csrf
                <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search" required  value="{{ request()->search }}">
                <button class="btn btn-outline-success my-2 my-sm-0"  type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>