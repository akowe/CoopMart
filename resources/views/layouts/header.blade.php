<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>CoopMart</title>

        <!-- dataTable css -->
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Google font -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

        <!-- Bootstrap -->
        <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>

        <!-- Slick -->
        <link type="text/css" rel="stylesheet" href="css/slick.css"/>
        <link type="text/css" rel="stylesheet" href="css/slick-theme.css"/>

        <!-- nouislider -->
        <link type="text/css" rel="stylesheet" href="css/nouislider.min.css"/>

        <!-- Font Awesome Icon -->
        <link rel="stylesheet" href="css/font-awesome.min.css">

        <!-- Custom stlylesheet -->
        <link type="text/css" rel="stylesheet" href="css/style.css"/>
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
               
<style>
 /* Top right text */
.top-right {
  position: absolute;
  top: -122px;
  background-color: #D10024;
  color: #fff;
  width:  120px;
  padding: 10px;
  text-align: center;
}
   
.dropbtn {
font-size: 14px;
  border: none;
 /* padding: 10px;*/
}

.dropdown {
  position: relative;
  display: inline-block;
  color: #000 !important;

}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #ffffff;
  min-width: 120px;
  left: -70px;
  color: #000000 !important;
 box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
  border-radius: 3px;


}

.dropdown-content a {
  color: #000000 !important;
  padding-left: 12px;
   padding-right: 12px;
  margin-top: 20px;
   margin-bottom: 20px;
  text-decoration: none;
  display: block;
  font-size: 12px;
}

/*.dropdown-content a:hover {background-color: #ddd;}*/

.dropdown:hover .dropdown-content {display: block;}

.dropdown:hover .dropdown-content a {color: #D10024 !important;}
/*
.dropdown:hover .dropbtn {background-color: #3e8e41;}*/
</style>


         </head>
    <body class="antialiased">
        <!-- <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
</div> -->

<!-- HEADER -->
        <header>
            <!-- TOP HEADER -->
            <div id="top-header">
                <div class="container">
                    <ul class="header-links pull-left">
                        <li><a href="#"><i class="fa fa-phone"></i> +021-95-51-84</a></li>
                        <li><a href="#"><i class="fa fa-envelope-o"></i> support@coopmart.ng</a></li>
                        
                    </ul>
                    <ul class="header-links pull-right">
                        <li><a href="" data-toggle="modal" data-target="#coopModal"><i class="fa fa-users"></i>  Cooperative</a></li>
                        <li><a href="" data-toggle="modal" data-target="#merchantModal"><i class="fa fa-user-o"></i> Sell on CoopMart</a></li>
                        <li>
                            <!--show member name-->
                         @if (Route::has('login'))
                         @auth
                        <li class="nav-item dropdown">
                            
                             <a href="" class="dropbtn"> {{ Auth::user()->fname }}</a>
                              @if(Auth::user()->role_name == 'cooperative')
                              <div class="dropdown-content">
                                <a href="{{ route('cooperative') }}">My Account</a>
                              
                                  <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                              </div>
                                @endif


                                 @if(Auth::user()->role_name == 'merchant')
                              <div class="dropdown-content">
                                <a href="{{ route('merchant') }}">My Account</a>
                                 <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                              
                              </div>
                                @endif


                                  @if(Auth::user()->role_name == 'member')
                              <div class="dropdown-content">
                                <a href="{{ route('dashboard') }}">My Account</a>
                                 <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                                @endif


                                @if(Auth::user()->role_name == 'superadmin')
                              <div class="dropdown-content">
                                <a href="{{ route('superadmin') }}">My Account</a>
                                 <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                                @endif
                               
                                </li>
                                <!-- end show member name-->

                                 @else
                                  <a href="" data-toggle="modal" data-target="#loginModal" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a></li>
                            @endif
                            @endauth
                           
                    </ul>
                </div>
            </div>
            <!-- /TOP HEADER -->

            <!-- MAIN HEADER -->
            <div id="header" class="">
                <!-- container -->
                <div class="container">
                    <!-- row -->
                    <div class="row">
                        <!-- LOGO -->
                        <div class="col-md-3">
                            <div class="header-logo">
                                <a href="{{ url('/') }}" class="logo">
                                    <!-- <img src="./img/logo.png" alt=""> -->
                                    <h1 class="white" style="color:#fff;">CoopMart</h1>
                                </a>
                            </div>
                        </div>
                        <!-- /LOGO -->

                        <!-- SEARCH BAR -->
                        <div class="col-md-7">
                            <div class="header-search">
                               
                                <form action="{{ route('category') }}" method="GET" multipart/form-data>
                                    <select name="category" id="input" class="input-select">
                                        <option value="">All Categories</option>
                                        @foreach (\App\Models\Categories::select('cat_name')->get() as $category)
                                            <option  value="{{ $category->cat_name }}" >
                                             <a href="{{route('category')}}?category={{ $category->cat_name }}">{{ $category['cat_name'] }}</a>
                                            </option>
                                        @endforeach
                                    </select>
                  

                                  <input class="input" type="text" name="search" placeholder="Search here" />
                                  <button class="search-btn" type="submit">Search</button>
                                </form>

                            </div>
                        </div>
                        <!-- /SEARCH BAR -->

                        <!-- ACCOUNT -->
                        <div class="col-md-2">
                            <div class="header-ctn">
                             
                                <!-- Cart -->
                                <div class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" style="cursor: pointer;">
                                        <i class="fa fa-shopping-cart"></i>
                                        <span>Cart</span>
                                        <div class="qty">{{ count((array) session('cart')) }}</div>
                                    </a>
                                       @php $total = 0 @endphp
                                        @php $items = 0 @endphp
                                        @php $item = 1 @endphp
                                            @foreach((array) session('cart') as $id => $details)
                                                @php $total += $details['price'] * $details['quantity']
                                                 @endphp

                                                 @php $items += $details['quantity'] * $item
                                                 @endphp
                                            @endforeach
                                    <div class="cart-dropdown">
                                        @if(session('cart'))
                                        <div class="cart-list">
                                                
                                             @foreach(session('cart') as $id => $details)
                                            <div class="product-widget">
                                            
                                                <div class="product-img">
                                                    <img src="{{ $details['image'] }}" alt="" width="40">
                                                </div>
                                                <div class="product-body">
                                                   <h6 class="product-name">
                                                    <a href="#" style="cursor:pointer;">{{ $details['prod_name'] }}</a>
                                                </h6>

                                                      <h6 class="product-price">
                                                        <span class="qty">{{ $details['quantity'] }} &nbsp; x </span>
                                                     ₦ {{ number_format($details['price']) }}</h6>
                                                </div>
                                            </div><!-- product widget-->
                                              @endforeach

                                        </div>
                                        
                                        <div class="cart-summary">
                                            <small>{{$items}} Item(s) selected</small>
                                            <h5>SUBTOTAL: ₦ {{ number_format($total) }}</h5>
                                        </div>
                                             @endif
                                          
                                       
                                       

                                        <div class="cart-btns">
                                            <a href="{{ route('cart') }}" class="cursor">View Cart</a>
                                            <a href="{{ url('/checkout')}}" style="cursor:pointer;">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
                                        </div>

                                    </div><!-- cart dropdownt -->
                                </div><!-- /Cart -->
                               
                                <!-- Menu Toogle -->
                                <div class="menu-toggle">
                                    <a href="#">
                                        <i class="fa fa-bars"></i>
                                        <span>Menu</span>
                                    </a>
                                </div>
                                <!-- /Menu Toogle -->
                            </div>
                        </div>
                        <!-- /ACCOUNT -->
                    </div>
                    <!-- row -->
                </div>
                <!-- container -->
            </div>
            <!-- /MAIN HEADER -->
        </header>
        <!-- /HEADER -->

        <!-- NAVIGATION -->
        <nav id="navigation" class="">
            <!-- container -->
            <div class="container">
                <!-- responsive-nav -->
                <div id="responsive-nav">
                    <!-- NAV -->
                    <ul class="main-nav nav navbar-nav" style="font-size:13px;" >
                    <li class="active"><a href="{{ url('/')}}">Home</a></li>
                          @foreach (\App\Models\Categories::select('cat_name')->limit(8)->get() as 
                          $id => $category)
                    

                        <li class="myClass" data-option-id="{{ $category->cat_name }}">
                            <a href="{{route('category')}}?category={{ $category->cat_name }}">{{ $category->cat_name }}</a></li>
                
                        @endforeach
                    </ul>
                    <!-- /NAV -->
                </div>
                <!-- /responsive-nav -->
            </div>
            <!-- /container -->
        </nav>

        <div class="container">

              @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div> 
    @endif
    </div>
  
 
  

        <!-- /NAVIGATION -->
            @yield('content')
             @extends('layouts.footer')
            @yield('scripts')


  <script type="text/javascript">
$('#search').on('keyup',function(){
$value=$(this).val();
$.ajax({
type : 'get',
url : '{{URL::to('category')}}',
data:{'search':$value},
success:function(data){
$('tbody').html(data);
}
});
})
</script>
<script type="text/javascript">
$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>

            
    </body>
    </html>