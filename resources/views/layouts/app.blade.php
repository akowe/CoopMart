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
         <!--  <img src="{{ asset('admin/img/logo.png') }}" class="navbar-brand-image d-inline-block align-top mr-2" alt=""> -->
         
        {{ config('app.name', 'Coopmart') }}
              
        </a>

        <form class="form-inline form-quicksearch d-none d-md-block mx-auto">
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-icon">
                <i data-feather="search"></i>
              </div>
            </div>
            <input type="text" class="form-control" id="search" placeholder="Type to search...">
          </div>
        </form>

        <div class="d-flex flex-1 d-block d-md-none">
          <a href="#" class="sidebar-toggle ml-3">
            <i data-feather="menu"></i>
          </a>
        </div>

        <ul class="navbar-nav d-flex justify-content-end mr-2">
          <!-- Notificatoins -->
          <li class="nav-item dropdown d-flex align-items-center mr-2">
            <a class="nav-link nav-link-notifications" id="dropdownNotifications" data-toggle="dropdown" href="#">
              <i class="oi oi-bell display-inline-block align-middle"></i>
              <span class="nav-link-notification-number">0</span>
            </a>

            <div class="dropdown-menu dropdown-menu-right dropdown-menu-notifications" aria-labelledby="dropdownNotifications">
              <div class="notifications-header d-flex justify-content-between align-items-center">
                <span class="notifications-header-title">
                  Notifications
                </span>
                <a href="#" class="d-flex"><small>Mark all as read</small></a>
              </div>

              <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action unread">
                 <!--  <p class="mb-1">Invitation for <strong>Lunch</strong> on <strong>Jan 12th 2018</strong> by <strong>Laura</strong></p> -->

                  <div class="mb-1">
                    <button type="button" class="btn btn-primary btn-sm">Accept invite</button>
                    <button type="button" class="btn btn-outline-danger btn-sm">Decline</button>
                  </div>

                <!--   <small>1 hour ago</small> -->
                </a>

            
              </div>

              <div class="notifications-footer text-center">
                <a href="#"><small>View all notifications</small></a>
              </div>
            </div>
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
              <a class="dropdown-item" href="#">My Profile</a>
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
         <!--  <img src="{{ asset('admin/img/logo.png') }}" class="navbar-brand-image d-inline-block align-top mr-2" alt=""> -->
         
        {{ config('app.name', 'Coopmart') }}
              
        </a>

        <form class="form-inline form-quicksearch d-none d-md-block mx-auto">
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-icon">
                <i data-feather="search"></i>
              </div>
            </div>
            <input type="text" class="form-control" id="search" placeholder="Type to search...">
          </div>
        </form>

        <div class="d-flex flex-1 d-block d-md-none">
          <a href="#" class="sidebar-toggle ml-3">
            <i data-feather="menu"></i>
          </a>
        </div>

        <ul class="navbar-nav d-flex justify-content-end mr-2">
          <!-- Notificatoins -->
          <li class="nav-item dropdown d-flex align-items-center mr-2">
            <a class="nav-link nav-link-notifications" id="dropdownNotifications" data-toggle="dropdown" href="#">
              <i class="oi oi-bell display-inline-block align-middle"></i>
              <span class="nav-link-notification-number">0</span>
            </a>

            <div class="dropdown-menu dropdown-menu-right dropdown-menu-notifications" aria-labelledby="dropdownNotifications">
              <div class="notifications-header d-flex justify-content-between align-items-center">
                <span class="notifications-header-title">
                  Notifications
                </span>
                <a href="#" class="d-flex"><small>Mark all as read</small></a>
              </div>

              <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action unread">
                  <p class="mb-1"><strong></strong><strong></strong>  <strong></strong></p>

                  <div class="mb-1">
                    <button type="button" class="btn btn-primary btn-sm"></button>
                    <button type="button" class="btn btn-outline-danger btn-sm"></button>
                  </div>

                  <small></small>
                </a>

            
              </div>

              <div class="notifications-footer text-center">
                <a href="#"><small>View all notifications</small></a>
              </div>
            </div>
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
              <a class="dropdown-item" href="#">My Profile</a>
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
         <!--  <img src="{{ asset('admin/img/logo.png') }}" class="navbar-brand-image d-inline-block align-top mr-2" alt=""> -->
         
        {{ config('app.name', 'Coopmart') }}
              
        </a>

        <form class="form-inline form-quicksearch d-none d-md-block mx-auto">
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-icon">
                <i data-feather="search"></i>
              </div>
            </div>
            <input type="text" class="form-control" id="search" placeholder="Type to search...">
          </div>
        </form>

        <div class="d-flex flex-1 d-block d-md-none">
          <a href="#" class="sidebar-toggle ml-3">
            <i data-feather="menu"></i>
          </a>
        </div>

        <ul class="navbar-nav d-flex justify-content-end mr-2">
          <!-- Notificatoins -->
          <li class="nav-item dropdown d-flex align-items-center mr-2">
            <a class="nav-link nav-link-notifications" id="dropdownNotifications" data-toggle="dropdown" href="#">
              <i class="oi oi-bell display-inline-block align-middle"></i>
              <span class="nav-link-notification-number">0</span>
            </a>

            <div class="dropdown-menu dropdown-menu-right dropdown-menu-notifications" aria-labelledby="dropdownNotifications">
              <div class="notifications-header d-flex justify-content-between align-items-center">
                <span class="notifications-header-title">
                  Notifications
                </span>
                <a href="#" class="d-flex"><small>Mark all as read</small></a>
              </div>

              <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action unread">
                  <p class="mb-1"> <strong>Lunch</strong>  <strong></strong><strong></strong></p>

                  <div class="mb-1">
                    <button type="button" class="btn btn-primary btn-sm">Accept invite</button>
                    <button type="button" class="btn btn-outline-danger btn-sm">Decline</button>
                  </div>

                  <small></small>
                </a>

            
              </div>

              <div class="notifications-footer text-center">
                <a href="#"><small>View all notifications</small></a>
              </div>
            </div>
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
              <a class="dropdown-item" href="#">My Profile</a>
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
         <!--  <img src="{{ asset('admin/img/logo.png') }}" class="navbar-brand-image d-inline-block align-top mr-2" alt=""> -->
         
        {{ config('app.name', 'Coopmart') }}
              
        </a>

        <form class="form-inline form-quicksearch d-none d-md-block mx-auto">
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-icon">
                <i data-feather="search"></i>
              </div>
            </div>
            <input type="text" class="form-control" id="search" placeholder="Type to search...">
          </div>
        </form>

        <div class="d-flex flex-1 d-block d-md-none">
          <a href="#" class="sidebar-toggle ml-3">
            <i data-feather="menu"></i>
          </a>
        </div>

        <ul class="navbar-nav d-flex justify-content-end mr-2">
          <!-- Notificatoins -->
          <li class="nav-item dropdown d-flex align-items-center mr-2">
            <a class="nav-link nav-link-notifications" id="dropdownNotifications" data-toggle="dropdown" href="#">
              <i class="oi oi-bell display-inline-block align-middle"></i>
              <span class="nav-link-notification-number">0</span>
            </a>

            <div class="dropdown-menu dropdown-menu-right dropdown-menu-notifications" aria-labelledby="dropdownNotifications">
              <div class="notifications-header d-flex justify-content-between align-items-center">
                <span class="notifications-header-title">
                  Notifications
                </span>
                <a href="#" class="d-flex"><small>Mark all as read</small></a>
              </div>

              <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action unread">
                  <p class="mb-1"> <strong></strong>  <strong></strong> <strong></strong></p>

                  <div class="mb-1">
                    <button type="button" class="btn btn-primary btn-sm">Accept invite</button>
                    <button type="button" class="btn btn-outline-danger btn-sm">Decline</button>
                  </div>

                  <small></small>
                </a>

            
              </div>

              <div class="notifications-footer text-center">
                <a href="#"><small>View all notifications</small></a>
              </div>
            </div>
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
              <a class="dropdown-item" href="#">My Profile</a>
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
