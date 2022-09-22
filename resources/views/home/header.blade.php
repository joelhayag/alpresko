<header class="header_section">
    <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
            <a class="navbar-brand" href="{{ url('/') }}"><img width="210" src="{{ asset('images/logo.png') }}"
                    alt="#" /></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class=""> </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ url('/') }}">Home </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('products') }}">Products</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('contact') }}">Contact</a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('show_cart') }}">
                            My Cart&nbsp;
                            <span class='badge badge-warning' id='lblCartCount'> {{ $cart_count }} </span>
                        </a>
                    </li>


                    @auth

                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('show_order') }}">
                                My Orders&nbsp;
                                <span class='badge badge-warning' id='lblCartCount'>
                                    {{ App\Models\Order::where('user_id', '=', Auth::user()->id)->count() }}
                                </span>
                            </a>
                        </li>
                        {{-- @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('show_order') }}">
                                <i class="nav-icon fa fa-bag-shopping"></i>
                                <span class='badge badge-warning' id='lblCartCount'> 0 </span>
                            </a>
                        </li> --}}


                    @endauth




                    @if (Route::has('login'))
                        @auth


                            <div class="dropdown">

                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                    <a class="dropdown-item" href="{{ route('profile.show') }}">
                                        <span class="btn btn-primary"> {{ __('Profile') }} </span><a />

                                        <form class="dropdown-item" method="POST" action="{{ route('logout') }}">
                                            @csrf

                                            <a class="btn btn-danger" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                      this.closest('form').submit(); "
                                                role="button">
                                                {{ __('Log Out') }}
                                            </a>
                                        </form>
                                </div>

                            </div>
                        @else
                            <li class="nav-item mt-1 mr-1">
                                <a class="btn btn-login" href="{{ route('login') }}">Login</a>
                            </li>

                            <li class="nav-item mt-1 mr-1">
                                <a class="btn btn-register" href="{{ route('register') }}">Register</a>
                            </li>
                        @endauth
                    @endif


                </ul>
            </div>
        </nav>
    </div>
</header>
