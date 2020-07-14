<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm">
  <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">
          <i class="fa fa-cart-plus" aria-hidden="true"></i> ( {{ config('app.name', 'Store') }} )
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
                  <a class="nav-link" href="{{ route('home') }}">@lang('site.dashboard')
                  <span class="sr-only">(current)</span>
                  </a>
              </li>
              
              <li class="nav-item dropdown">
                  <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                      @lang('site.categories')
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
                          @lang('site.all_categories')
                      </a>
                  </div>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#">@lang('site.contact')</a>
              </li>

              <li class="nav-item">
                  <a class="nav-link" href="#">@lang('site.about')</a>
              </li>
              
              <!-- Authentication Links -->
              @guest
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('login') }}">@lang('site.login')</a>
                  </li>
                  @if (Route::has('register'))
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('register') }}">@lang('site.Register')</a>
                      </li>
                  @endif
              @else
                  <li class="nav-item dropdown">
                      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} <span class="caret"></span>
                      </a>

                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('profile', auth()->user()->id ) }}">@lang('site.profile')</a>
                            <a class="dropdown-item" href="{{ route('cart.client_orders', auth()->user()->id ) }}">@lang('site.myOrders')</a>

                          @if (auth()->user()->hasRole('super_admin|admin'))
                              <a class="dropdown-item" href="{{ route('dashboard.welcome') }}">@lang('site.admins_dashboard')</a>
                              <div class="dropdown-divider"></div>
                          @endif
                          
                          <a class="dropdown-item" href="{{ route('logout') }}"
                             onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                              @lang('site.logout')
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
              <input class="form-control mr-sm-2" type="search" name="search" placeholder="@lang('site.search')" aria-label="Search" required  value="{{ request()->search }}">
              <button class="btn btn-outline-success my-2 my-sm-0"  type="submit">@lang('site.search')</button>
          </form>
          <li role="separator" class="divider"></li>
            <a href="{{ route('cart.show')}}" class="btn btn-warning my-2 my-sm-0"> 
                <i class="fa fa-shopping-cart" aria-hidden="true">
                    <b> @lang('site.shopping_cart') </b> <b class="cart_quantity"> {{ session()->has('cart') ? session()->get('cart')->totalQty : '0' }}</b>
                </i>
            </a>
      </div>
  </div>
</nav>