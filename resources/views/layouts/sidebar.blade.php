 <!-- expand-hover push -->
      <!-- COOPERATIVE Sidebar -->
      @auth
@if(Auth::user()->role_name == 'cooperative')
      <div class="adminx-sidebar expand-hover push">
        <p></p>
       
        <ul class="sidebar-nav">
         
               <hr style="color:#f7f7f7;"></hr>
          <li class="sidebar-nav-item">
            <a href="{{ url('cooperative') }}" class="sidebar-nav-link active">
              <span class="sidebar-nav-icon">
                <i data-feather="home"></i>
              </span>
              <span class="sidebar-nav-name">
                Dashboard
              </span>
              <span class="sidebar-nav-end">

              </span>
            </a>
          </li>
        
      <hr style="color:#f7f7f7;"></hr>

          <li class="sidebar-nav-item">
            <a class="sidebar-nav-link collapsed" data-toggle="collapse" href="#member" aria-expanded="false" aria-controls="member">
              <span class="sidebar-nav-icon">
                <i data-feather="users"></i>
              </span>
              <span class="sidebar-nav-name">
                Members
              </span>
              <span class="sidebar-nav-end">
                <i data-feather="chevron-right" class="nav-collapse-icon"></i>
              </span>
            </a>

            <ul class="sidebar-sub-nav collapse" id="member">
               <li class="sidebar-nav-item">
                <a href="{{url('members')}}" class="sidebar-nav-link">
                  <span class="sidebar-nav-abbr">
                    View  
                  </span>
                  <span class="sidebar-nav-name">
                &nbsp; all
                  </span>
                </a>
              </li>
            </ul>
          </li>

          <hr style="color:#f7f7f7;"></hr>

         <li class="sidebar-nav-item">
          <a class="sidebar-nav-link " href="{{ url('profile') }}">
               <span class="sidebar-nav-icon">
               <i class="fa fa-user-o"></i> 
              </span>Profile
             </a>
          
            </li>
             <hr style="color:#f7f7f7;"></hr>

         <li class="sidebar-nav-item">
          <a class="sidebar-nav-link " href="{{ route('logout') }}"
             onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
               <span class="sidebar-nav-icon">
               <i class="fa fa-arrow-circle-right"></i> 
              </span>{{ __('Logout') }}
             </a>
             <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
              </form>
            </li>
             
        
              <hr style="color:#f7f7f7;"></hr>

              <li class="sidebar-nav-item">
          <a class="sidebar-nav-link " href="{{ url('/') }}">
               <span class="sidebar-nav-icon">
               <i class="fa fa-arrow-circle-left"></i> 
              </span> Coopmart  
             </a>
          
            </li>

        </ul>
      </div><!-- Sidebar End -->
      @endif
      @endauth


      <!-- Sidebar Members -->
 @auth
@if(Auth::user()->role_name == 'member')
      <div class="adminx-sidebar expand-hover push">
        <p></p>
       
        <ul class="sidebar-nav">
          <li class="sidebar-nav-item">
            <a href="{{ url('dashboard') }}" class="sidebar-nav-link active">
              <span class="sidebar-nav-icon">
                <i data-feather="home"></i>
              </span>
              <span class="sidebar-nav-name">
                Dashboard
              </span>
              <span class="sidebar-nav-end">

              </span>
            </a>
          </li>
        
      <hr style="color:#f7f7f7;"></hr>

          <li class="sidebar-nav-item">
            <a class="sidebar-nav-link collapsed" data-toggle="collapse" href="#member" aria-expanded="false" aria-controls="member">
              <span class="sidebar-nav-icon">
                <i data-feather="users"></i>
              </span>
              <span class="sidebar-nav-name">
                Orders
              </span>
              <span class="sidebar-nav-end">
                <i data-feather="chevron-right" class="nav-collapse-icon"></i>
              </span>
            </a>

            <ul class="sidebar-sub-nav collapse" id="member">
               <li class="sidebar-nav-item">
                <a href="{{url('')}}" class="sidebar-nav-link">
                  <span class="sidebar-nav-abbr">
                    View  
                  </span>
                  <span class="sidebar-nav-name">
                &nbsp; all
                  </span>
                </a>
              </li>
            </ul>
          </li>
             
             <hr style="color:#f7f7f7;"></hr>

         <li class="sidebar-nav-item">
          <a class="sidebar-nav-link " href="{{ url('profile') }}">
               <span class="sidebar-nav-icon">
               <i class="fa fa-user-o"></i> 
              </span>Profile
             </a>
          
            </li>
             <hr style="color:#f7f7f7;"></hr>

         <li class="sidebar-nav-item">
          <a class="sidebar-nav-link " href="{{ route('logout') }}"
             onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
               <span class="sidebar-nav-icon">
               <i class="fa fa-arrow-circle-right"></i> 
              </span>{{ __('Logout') }}
             </a>
             <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
              </form>
            </li>
             
          
              <hr style="color:#f7f7f7;"></hr>

              <li class="sidebar-nav-item">
          <a class="sidebar-nav-link " href="{{ url('/') }}">
               <span class="sidebar-nav-icon">
               <i class="fa fa-arrow-circle-left"></i> 
              </span> Coopmart  
             </a>
          
            </li>

        </ul>
      </div><!-- Sidebar Member End -->
      @endif
      @endauth



<!-- Sidebar Merchant -->
 @auth
@if(Auth::user()->role_name == 'merchant')
      <div class="adminx-sidebar expand-hover push">
        <p></p>
       
        <ul class="sidebar-nav">
          <li class="sidebar-nav-item">
            <a href="{{ url('merchant') }}" class="sidebar-nav-link active">
              <span class="sidebar-nav-icon">
                <i data-feather="home"></i>
              </span>
              <span class="sidebar-nav-name">
                Dashboard
              </span>
              <span class="sidebar-nav-end">

              </span>
            </a>
          </li>
        
      <hr style="color:#f7f7f7;"></hr>

          <li class="sidebar-nav-item">
            <a class="sidebar-nav-link collapsed" data-toggle="collapse" href="#member" aria-expanded="false" aria-controls="member">
              <span class="sidebar-nav-icon">
                <i data-feather="users"></i>
              </span>
              <span class="sidebar-nav-name">
                Products
              </span>
              <span class="sidebar-nav-end">
                <i data-feather="chevron-right" class="nav-collapse-icon"></i>
              </span>
            </a>

            <ul class="sidebar-sub-nav collapse" id="member">
               
              <li class="sidebar-nav-item">
                <a href="{{route('product')}}" class="sidebar-nav-link">
                  <span class="sidebar-nav-abbr">
                    Add  
                  </span>

                <span class="sidebar-nav-name">
                  &nbsp; new
                  </span>
                </a>
              </li>
            
            </ul>
          </li>
                <hr style="color:#f7f7f7;"></hr>

         <li class="sidebar-nav-item">
          <a class="sidebar-nav-link " href="{{ url('profile') }}">
               <span class="sidebar-nav-icon">
               <i class="fa fa-user-o"></i> 
              </span>Profile
             </a>
          
            </li>
             <hr style="color:#f7f7f7;"></hr>

         <li class="sidebar-nav-item">
          <a class="sidebar-nav-link " href="{{ route('logout') }}"
             onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
               <span class="sidebar-nav-icon">
               <i class="fa fa-arrow-circle-right"></i> 
              </span>{{ __('Logout') }}
             </a>
             <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
              </form>
            </li>
             
              <hr style="color:#f7f7f7;"></hr>

              <li class="sidebar-nav-item">
          <a class="sidebar-nav-link " href="{{ url('/') }}">
               <span class="sidebar-nav-icon">
               <i class="fa fa-arrow-circle-left"></i> 
              </span> Coopmart  
             </a>
          
            </li>

        </ul>
      </div><!-- Sidebar Merchant End -->
      @endif
      @endauth




      <!-- SIDE BAR for Super admin -->
            @auth
@if(Auth::user()->role_name == 'superadmin')
      <div class="adminx-sidebar expand-hover push">
        <p></p>
       
        <ul class="sidebar-nav">
          <li class="sidebar-nav-item">
            <a href="{{ url('superadmin') }}" class="sidebar-nav-link active">
              <span class="sidebar-nav-icon">
                <i data-feather="home"></i>
              </span>
              <span class="sidebar-nav-name">
                Dashboard
              </span>
              <span class="sidebar-nav-end">

              </span>
            </a>
          </li>
            <hr style="color:#f7f7f7;"></hr>

            <li class="sidebar-nav-item">
            <a class="sidebar-nav-link collapsed" data-toggle="collapse" href="#products" aria-expanded="false" aria-controls="products">
              <span class="sidebar-nav-icon">
                <i class="fa fa-th-list"></i>
              </span>
              <span class="sidebar-nav-name">
                Products
              </span>
              <span class="sidebar-nav-end">
                <i data-feather="chevron-right" class="nav-collapse-icon"></i>
              </span>
            </a>

            <ul class="sidebar-sub-nav collapse" id="products">
              <li class="sidebar-nav-item">
                <a href="{{ url('products_list') }}" class="sidebar-nav-link">
                  <span class="sidebar-nav-abbr">
                    All
                  </span>
                  <span class="sidebar-nav-name">
                    
                  </span>
                </a>
              </li>

                   <li class="sidebar-nav-item">
                <a href="{{ url('removed_product') }}" class="sidebar-nav-link">
                  <span class="sidebar-nav-abbr">
                    Trashed
                  </span>

                <span class="sidebar-nav-name">
                  &nbsp; 
                  </span>
                </a>
              </li>

             
            </ul>
          </li>
        
      <hr style="color:#f7f7f7;"></hr>

          <li class="sidebar-nav-item">
            <a class="sidebar-nav-link collapsed" data-toggle="collapse" href="#member" aria-expanded="false" aria-controls="member">
              <span class="sidebar-nav-icon">
                <i data-feather="users"></i>
              </span>
              <span class="sidebar-nav-name">
                Members
              </span>
              <span class="sidebar-nav-end">
                <i data-feather="chevron-right" class="nav-collapse-icon"></i>
              </span>
            </a>

            <ul class="sidebar-sub-nav collapse" id="member">
               <li class="sidebar-nav-item">
                <a href="{{ url('users_list')}}" class="sidebar-nav-link">
                  <span class="sidebar-nav-abbr">
                    View  
                  </span>
                  <span class="sidebar-nav-name">
                &nbsp; all
                  </span>
                </a>
              </li>
            <!--   <li class="sidebar-nav-item">
                <a href="" class="sidebar-nav-link">
                  <span class="sidebar-nav-abbr">
                    Add  
                  </span>

                <span class="sidebar-nav-name">
                  &nbsp; new
                  </span>
                </a>
              </li> -->
            
            </ul>
          </li>


           <hr style="color:#f7f7f7;"></hr>

            <li class="sidebar-nav-item">
            <a class="sidebar-nav-link collapsed" data-toggle="collapse" href="#transactions" aria-expanded="false" aria-controls="transactions">
              <span class="sidebar-nav-icon">
                <i data-feather="shopping-cart"></i>
              </span>
              <span class="sidebar-nav-name">
                Transactions
              </span>
              <span class="sidebar-nav-end">
                <i data-feather="chevron-right" class="nav-collapse-icon"></i>
              </span>
            </a>

            <ul class="sidebar-sub-nav collapse" id="transactions">
              <li class="sidebar-nav-item">
                <a href="{{url('transactions') }}" class="sidebar-nav-link">
                  <span class="sidebar-nav-abbr">
                    All
                  </span>
                  <span class="sidebar-nav-name">
                    
                  </span>
                </a>
              </li>
            </ul>
          </li>


          <hr style="color:#f7f7f7;"></hr>
            <li class="sidebar-nav-item">
            <a class="sidebar-nav-link collapsed" data-toggle="collapse" href="#about" aria-expanded="false" aria-controls="about">
              <span class="sidebar-nav-icon">
                <i class="fa fa-file"></i>
              </span>
              <span class="sidebar-nav-name">
                About
              </span>
              <span class="sidebar-nav-end">
                <i data-feather="chevron-right" class="nav-collapse-icon"></i>
              </span>
            </a>

            <ul class="sidebar-sub-nav collapse" id="about">
              <li class="sidebar-nav-item">
                <a href="{{url('about') }}" class="sidebar-nav-link">
                  <span class="sidebar-nav-abbr">
                    About 
                  </span>
                </a>
            
              </li>
               
            </ul>
          </li>

           <hr style="color:#f7f7f7;"></hr>
            <li class="sidebar-nav-item">
            <a class="sidebar-nav-link collapsed" data-toggle="collapse" href="#privacy" aria-expanded="false" aria-controls="privacy">
              <span class="sidebar-nav-icon">
                <i class="fa fa-file"></i>
              </span>
              <span class="sidebar-nav-name">
                Privacy Policy
              </span>
              <span class="sidebar-nav-end">
                <i data-feather="chevron-right" class="nav-collapse-icon"></i>
              </span>
            </a>

            <ul class="sidebar-sub-nav collapse" id="privacy">
              <li class="sidebar-nav-item">
                <a href="{{url('privacy') }}" class="sidebar-nav-link">
                  <span class="sidebar-nav-abbr">
                    Privacy 
                  </span>
                </a>
            
              </li>
               
            </ul>
          </li>


            <hr style="color:#f7f7f7;"></hr>
            <li class="sidebar-nav-item">
            <a class="sidebar-nav-link collapsed" data-toggle="collapse" href="#return" aria-expanded="false" aria-controls="return">
              <span class="sidebar-nav-icon">
                <i class="fa fa-file"></i>
              </span>
              <span class="sidebar-nav-name">
                Return Policy
              </span>
              <span class="sidebar-nav-end">
                <i data-feather="chevron-right" class="nav-collapse-icon"></i>
              </span>
            </a>

            <ul class="sidebar-sub-nav collapse" id="return">
              <li class="sidebar-nav-item">
                <a href="{{url('refund') }}" class="sidebar-nav-link">
                  <span class="sidebar-nav-abbr">
                    Return 
                  </span>
                </a>
            
              </li>
               
            </ul>
          </li>


<hr style="color:#f7f7f7;"></hr>
            <li class="sidebar-nav-item">
            <a class="sidebar-nav-link collapsed" data-toggle="collapse" href="#terms" aria-expanded="false" aria-controls="terms">
              <span class="sidebar-nav-icon">
                <i class="fa fa-file"></i>
              </span>
              <span class="sidebar-nav-name">
                T & C
              </span>
              <span class="sidebar-nav-end">
                <i data-feather="chevron-right" class="nav-collapse-icon"></i>
              </span>
            </a>

            <ul class="sidebar-sub-nav collapse" id="terms">
              <li class="sidebar-nav-item">
                <a href="{{url('tandc') }}" class="sidebar-nav-link">
                  <span class="sidebar-nav-abbr">
                    T & C 
                  </span>
                </a>
            
              </li>
               
            </ul>
          </li>
            <hr style="color:#f7f7f7;"></hr>

         <li class="sidebar-nav-item">
          <a class="sidebar-nav-link " href="{{ url('subscribers') }}">
               <span class="sidebar-nav-icon">
               <i class="fa fa-envelope-o"></i> 
              </span>Newsletter
             </a>
          
            </li> 

             <hr style="color:#f7f7f7;"></hr>


         <li class="sidebar-nav-item">
          <a class="sidebar-nav-link " href="{{ url('profile') }}">
               <span class="sidebar-nav-icon">
               <i class="fa fa-user-o"></i> 
              </span>Profile
             </a>
          
            </li>
             <hr style="color:#f7f7f7;"></hr>

         <li class="sidebar-nav-item">
          <a class="sidebar-nav-link " href="{{ route('logout') }}"
             onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
               <span class="sidebar-nav-icon">
               <i class="fa fa-arrow-circle-right"></i> 
              </span>{{ __('Logout') }}
             </a>
             <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
              </form>
            </li>
             
              <hr style="color:#f7f7f7;"></hr>

              <li class="sidebar-nav-item">
          <a class="sidebar-nav-link " href="{{ url('/') }}">
               <span class="sidebar-nav-icon">
               <i class="fa fa-arrow-circle-left"></i> 
              </span> Coopmart  
             </a>
          
            </li>

        </ul>
      </div><!-- Sidebar End -->
      @endif
      @endauth