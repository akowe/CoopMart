<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
   
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/adminx.css') }}" media="screen" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CoopMart') }}</title>


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
   
    <div id="app" class="adminx-container">
       
        <!-- COOP NAV BAR-->

        <nav class="navbar navbar-expand justify-content-between fixed-top">
        <a class="navbar-brand mb-0 h1 d-none d-md-block text-danger" href="{{ url('/') }}">
          <img src="{{ asset('admin/img/logo-2.png') }}" class="d-inline-block align-top mr-2" width="179" height="50" alt="Coopmart" title="CoopMart">
        </a>

       

        <div class="d-flex flex-1 d-block d-md-none">
          <a href="#" class="sidebar-toggle ml-3">
            <i data-feather="menu"></i>
          </a>
        </div>

        <ul class="navbar-nav d-flex justify-content-end mr-2">
          <!-- Notificatoins -->
          <li class="nav-item dropdown d-flex align-items-center mr-2">
           
          </li>
          <!-- Notifications -->
            @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
          <li class="nav-item dropdown">
            <a class="nav-link avatar-with-name text-capitalize text-dark" id="navbarDropdownMenuLink" data-toggle="dropdown" href="#">
                     {{ Auth::user()->coopname }}   &nbsp;
              <img src="{{ asset ('admin/img/userav.png')}}" class="d-inline-block align-top" alt="">
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="{{ url('profile') }}">My Profile</a>
              <div class="dropdown-divider"></div>
            
                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
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
                      </nav>
<!-- END COOP NAV BAR-->



        <!-- MERCHANT NAV BAR-->
        @auth
@if(Auth::user()->role_name == 'merchant')

        <nav class="navbar navbar-expand justify-content-between fixed-top">
        <a class="navbar-brand mb-0 h1 d-none d-md-block text-danger" href="{{ url('/') }}">
        <img src="{{ asset('admin/img/logo-2.png') }}" class="d-inline-block align-top mr-2" width="179" height="50" alt="Coopmart" title="CoopMart">  
        </a>


        <div class="d-flex flex-1 d-block d-md-none">
          <a href="#" class="sidebar-toggle ml-3">
            <i data-feather="menu"></i>
          </a>
        </div>

        <ul class="navbar-nav d-flex justify-content-end mr-2">
          <!-- Notificatoins -->
          
          </li>
          <!-- Notifications -->
            @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
          <li class="nav-item dropdown">
            <a class="nav-link avatar-with-name text-capitalize text-dark" id="navbarDropdownMenuLink" data-toggle="dropdown" href="#">
                     {{ Auth::user()->coopname }}
              <img src="{{ asset ('admin/img/userav.png')}}" class="d-inline-block align-top" alt="">
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="{{ url('profile') }}">My Profile</a>
              <div class="dropdown-divider"></div>
            
                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
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
                      </nav>
                      @endif
                      @endauth
<!-- END MERCHANT NAV BAR-->



   <!-- MERCHANT NAV BAR-->
        @auth
@if(Auth::user()->role_name == 'superadmin')

        <nav class="navbar navbar-expand justify-content-between fixed-top">
        <a class="navbar-brand mb-0 h1 d-none d-md-block text-danger" href="{{ url('/') }}">
        <img src="{{ asset('admin/img/logo-2.png') }}" class="d-inline-block align-top mr-2" width="179" height="50" alt="Coopmart" title="CoopMart">
              
        </a>

       
        <div class="d-flex flex-1 d-block d-md-none">
          <a href="#" class="sidebar-toggle ml-3">
            <i data-feather="menu"></i>
          </a>
        </div>

        <ul class="navbar-nav d-flex justify-content-end mr-2">
          <!-- Notificatoins -->
          <li class="nav-item dropdown d-flex align-items-center mr-2">
           
          </li>
          <!-- Notifications -->
            @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
          <li class="nav-item dropdown">
            <a class="nav-link avatar-with-name text-capitalize text-dark" id="navbarDropdownMenuLink" data-toggle="dropdown" href="#">
                     {{ Auth::user()->fname }}
              <img src="{{ asset ('admin/img/userav.png')}}" class="d-inline-block align-top" alt="">
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="{{ url('profile') }}">My Profile</a>
              <div class="dropdown-divider"></div>
            
                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
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
                      </nav>
                      @endif
                      @endauth
<!-- END SUPERADMIN NAV BAR-->

<!-- MEMBER NAV BAR-->
@auth
@if(Auth::user()->role_name == 'member')
 <nav class="navbar navbar-expand justify-content-between fixed-top">
        <a class="navbar-brand mb-0 h1 d-none d-md-block text-danger" href="{{ url('/') }}">
        <img src="{{ asset('admin/img/logo-2.png') }}" class="d-inline-block align-top mr-2" width="179" height="50" alt="Coopmart" title="CoopMart">
              
        </a>

    

        <div class="d-flex flex-1 d-block d-md-none">
          <a href="#" class="sidebar-toggle ml-3">
            <i data-feather="menu"></i>
          </a>
        </div>

        <ul class="navbar-nav d-flex justify-content-end mr-2">
          <!-- Notificatoins -->
         
          </li>
          <!-- Notifications -->
            @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
          <li class="nav-item dropdown">
            <a class="nav-link avatar-with-name text-capitalize text-dark" id="navbarDropdownMenuLink" data-toggle="dropdown" href="" title="My Profile">
                     {{ Auth::user()->fname }}
              <img src="{{ asset ('admin/img/userav.png')}}" class="d-inline-block align-top" alt="">
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="{{ url('profile') }}">My Profile</a>
              <div class="dropdown-divider"></div>
            
                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
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
                      </nav>
                      @endif
                      @endauth
                      <!-- END MEMBER NAV BAR-->


        <main class="py-4">
            @yield('content')
        </main>


      @yield('scripts')
        </div><!--adminx-container-->

    
    <!-- footer-->
    <!--script-->
     <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
    <script src="admin/js/vendor.js"></script>
    <script src="admin/js/adminx.js"></script>
     <script src="admin/js/custom.js"></script>
     <!-- Footer row -->
          
               
</body>
</html>
