 <!-- expand-hover push -->
      <!-- COOPERATIVE Sidebar -->
      @auth
@if(Auth::user()->role_name == 'cooperative')
      <div class="adminx-sidebar expand-hover push">
        <p></p>
       
        <ul class="sidebar-nav">
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
              <li class="sidebar-nav-item">
                <a href="" class="sidebar-nav-link">
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
                <a href="" class="sidebar-nav-link">
                  <span class="sidebar-nav-abbr">
                    All
                  </span>
                  <span class="sidebar-nav-name">
                    
                  </span>
                </a>
              </li>

              <li class="sidebar-nav-item">
                <a href="" class="sidebar-nav-link">
                  <span class="sidebar-nav-abbr">
                    Invoices
                  </span>
                  <span class="sidebar-nav-name">
                    
                  </span>
                </a>
              </li>
            </ul>
          </li>

            <hr style="color:#f7f7f7;"></hr>

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
                <a href="{{url('')}}" class="sidebar-nav-link">
                  <span class="sidebar-nav-abbr">
                    View  
                  </span>
                  <span class="sidebar-nav-name">
                &nbsp; all
                  </span>
                </a>
              </li>
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

        </ul>
      </div><!-- Sidebar End -->
      @endif
      @endauth