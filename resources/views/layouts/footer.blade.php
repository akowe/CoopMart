   <!-- NEWSLETTER -->
        <div id="newsletter" class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-12">
   
                        <div class="newsletter">
                            <p>Sign Up for the <strong>NEWSLETTER</strong></p>
                            <form method="POST" action="{{ url('newsletter') }}" enctype="multipart/form-data" name="submit">
                              @csrf
                                <input class="input" type="email" name="email"  placeholder="Enter Your Email">
                                  @error('email')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                                <button class="newsletter-btn" type="submit"><i class="fa fa-envelope"></i> Subscribe</button>
                            </form>
                            <ul class="newsletter-follow">
                                <li>
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /NEWSLETTER -->

        <!-- FOOTER -->
        <footer id="footer">
            <!-- top footer -->
            <div class="section">
                <!-- container -->
                <div class="container">
                    <!-- row -->
                    <div class="row">
                        <div class="col-md-3 col-xs-6">
                            <div class="footer">
                                <h3 class="footer-title">About Us</h3>
                                <p style="font-size:12px;">Our mission keeps us focused and accountable, Our vision drives is and our values dictate how we succeed.</p>
                                <ul class="footer-links" style="font-size:12px;">
                                    <li><a href="#"><i class="fa fa-map-marker"></i>72, Ayinke Plaza,  
                                    Sabo,ikorodu, Lagos</a></li>
                                    <li><a href="#"><i class="fa fa-phone"></i>+234 (0) 906 496 5041</a></li>
                                    <li><a href="mailto:info@coopmart.ng"><i class="fa fa-envelope-o"></i>info@coopmart.ng</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-3 col-xs-6">
                            <div class="footer">
                                <h3 class="footer-title">Categories</h3>
                                <ul class="footer-links" style="font-size:12px;">
                                     @foreach (\App\Models\Categories::select('cat_name')->limit(10)->get() as $id => $category)
                                         <li class="myClass" data-option-id="{{ $category->cat_name }}">
                                            <a href="{{route('category')}}?category={{ $category->cat_name }}">{{ $category->cat_name }}</a></li>
                                
                                        @endforeach
                                    </ul>
                            </div>
                        </div>

                        <div class="clearfix visible-xs"></div>

                        <div class="col-md-3 col-xs-6">
                            <div class="footer">
                                <h3 class="footer-title">Information</h3>
                                <ul class="footer-links" style="font-size:12px;">
                                    <li><a href="{{url('about_us')}}">About Us</a></li>
                                    <li><a href="{{url('privacy_policy')}}">Privacy Policy</a></li>
                                    <li><a href="{{url('return_policy')}}">Return & Refund </a></li>
                                    <li><a href="{{url('terms')}}">Terms & Conditions</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-3 col-xs-6">
                            <div class="footer">
                                <h3 class="footer-title">Service</h3>
                                <ul class="footer-links" style="font-size:12px;">
                                    
                                    <li>
                                         @if (Route::has('login'))
                                        @auth
                                        
                                     @if(Auth::user()->role_name == 'cooperative')
                                        <a href="{{ route('cooperative') }}">My Account</a>
                                         @endif

                                          @if(Auth::user()->role_name == 'member')
                                        <a href="{{ route('dashboard') }}">My Account</a>
                                         @endif

                                           @if(Auth::user()->role_name == 'merchant')
                                        <a href="{{ route('merchant') }}">My Account</a>
                                         @endif

                                           @if(Auth::user()->role_name == 'superadmin')
                                        <a href="{{ route('superadmin') }}">My Account</a>
                                         @endif

                                         @else
                                  
                                  <a href="{{ route('login') }}">My Account</a></li>
                                        @endif
                                      @endauth

                                    </li>
                                      

                                    <li><a href="{{ route('cart') }}" class="cursor">View Cart</a></li>
                                   
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /row -->
                </div>
                <!-- /container -->
            </div>
            <!-- /top footer -->

            <!-- bottom footer -->
            <div id="bottom-footer" class="section">
                <div class="container">
                    <!-- row -->
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <ul class="footer-payments">
                              
                            </ul>
                            <span class="copyright">
                                 <a href="" style="color:#a8a8a8;"> &copy; {{ date('Y')}} CoopMart.ng</a>
                            </span>
                        </div>
                    </div>
                        <!-- /row -->
                </div>
                <!-- /container -->
            </div>
            <!-- /bottom footer -->
        </footer>
        <!-- /FOOTER -->

        <!-- Button trigger modal -->

<!-- Merchant Modal -->
<div class="modal fade" id="merchantModal" tabindex="-1" role="dialog" aria-labelledby="merchantModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
       
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
         <h5 class="modal-title" id="merchantModalLabel">Are you a Merchant or Seller</h5>
        <p>Do you have products for sale in wholesale price; kindly register to start selling on Coopmart</p>
       
      </div>
      <div class="modal-body">
        
        <p>
 <form method="POST" action="{{ route('register') }}">
                        @csrf

                          <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Your Store Name</label>
                          <div class="col-md-6 form-group">
                              @php
                            $coopID = rand(100,999);
                            @endphp
                                <input  type="hidden"  name="code" value="Coopmart{{ $coopID }}">
                                <input type="hidden"  name="role" value="3">
                              <input type="hidden"  name="role_name" value="merchant">
                               @php
                            $rand = rand(100000000,999999999);
                            @endphp
                            <input type="hidden" name="voucher" value="C{{ $rand }}">

                            <input id="coopname" type="text"name="coopname" required class="form-control" >
                       
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">First Name</label>

                            <div class="col-md-6 form-group">
                                <input id="fname" type="text" name="fname" value="" required class="form-control" >

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                          <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Last Name</label>

                            <div class="col-md-6 form-group ">
                                <input id="lname" type="text"  name="lname" value="" required class="form-control" >

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6 form-group ">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6 input-icons" style="width:50%">
                               
                                <input id="password" type="password" class="@error('password') is-invalid @enderror input-field " name="password" required autocomplete="new-password">
                                 <span class="hide-show ">
                                    <i class="fa fa-eye-slash icon-password"></i></span>
                                    <br>
                                <span class="small text-danger">password minimum leght: 6</span>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <br>
                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6 ">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" style="text-align:center;">
                            </div>
                        </div> 
                        
                   
         </p>
      </div>
      <div class="modal-footer">
        <button  type="submit" class="btn btn-danger">{{ __('Register') }}</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        

         </form>
      </div>
    </div>
  </div>
</div><!-- merchant modal -->


<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-danger">&times;</span>
        </button>
        <h5 class="modal-title" id="loginModalLabel">Already a member? {{ __('Login') }}</h5>
      
       </div>
      <div class="modal-body">
       <div class="row">
        <div class="col-md-2">
        </div>

        <div class="col-md-8">

            <form method="POST" action="{{ route('login') }}">
                        @csrf

                          
                             <label for="email" class="text-md-end">{{ __('Email Address') }}</label>
                           <div class="input-icons">
                                 <i class="fa fa-envelope icon"></i>
                                   <input id="email" type="email" class="input-field @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                   <br>
                                @error('email')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                       <br>
                            </div>
                   

                            <label for="password" class=" text-md-end">{{ __('Password') }}</label>

                            <div class="input-icons">
                                 <i class="fa fa-lock icon"></i>
                                <input id="password" type="password" class=" @error('password') is-invalid @enderror input-field " name="password" required autocomplete="current-password" id="password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <span class="hide-show ">
                                    <i class="fa fa-eye-slash icon-password"></i></span>
                          
                              
                            </div>
                      

                        <div class="form-group text-center">
                               <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                                <br>
                           
                                <button type="submit" class="btn btn-danger btn-block">
                                    {{ __('Login') }}
                                </button>
                        </div>
                    </form>

                                 <div class="text-right">
                                @if (Route::has('password.request'))
                                    <a class="text-danger" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                           
                           
                         <div class="text-center" >
                            <p>
                                <br>
                         @if (Route::has('register'))
                                      
                      <h6> Don't have an account? </h6></p>
                       
                         <p>
                       <a class="text-danger" href="" data-toggle="modal" data-target="#regModal"  >{{ __('Register') }} as a Member  here&nbsp;</a>
                       <br>
                       <a class="text-primary" href="" data-toggle="modal" data-target="#coopModal"> Register as a  Cooperative Organization here</a>

                            @endif
                            </p>
                        </div>
      

      
        </div>

        <div class="col-md-2">
        </div>
       </div>

      </div><!--body-->
     
    </div>
  </div>
</div><!--Login modal end-->


<!-- Register Modal -->
<div class="modal fade" id="regModal" tabindex="-1" role="dialog" aria-labelledby="regModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="coopModalLabel">Don't have an account? {{ __('Register') }}</h5>
      
       
      </div>
      <div class="modal-body">
        
        <p>
 <form method="POST" action="{{ route('register') }}">
                        @csrf

                          <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Cooperative Name</label>

                          <div class="col-md-6 form-group">

                           <input type="hidden"  name="role" value="4">
                              <input type="hidden"  name="role_name" value="member">
                               @php
                            $rand = rand(100000000,999999999);
                            @endphp
                            <input type="hidden" name="voucher" value="C{{ $rand }}">

                            <input  type="text"name="coopname" required class="form-control" >

                           
                            </div>
                        </div>

                          <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Cooperative Code</label>

                          <div class="col-md-6 form-group">
                            <input  type="text"  name="code" value="" class="form-control">
                             <span class="small text-danger">get it from your cooperative admin</span>

                           
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">First Name</label>

                            <div class="col-md-6 form-group">
                                <input id="fname" type="text" name="fname" value="" required class="form-control" >

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                          <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Last Name</label>

                            <div class="col-md-6 form-group ">
                                <input id="lname" type="text"  name="lname" value="" required class="form-control" >

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6 form-group ">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6 input-icons" style="width:50%">
                               
                                <input id="password" type="password" class="@error('password') is-invalid @enderror input-field " name="password" required autocomplete="new-password">
                                 <span class="hide-show ">
                                    <i class="fa fa-eye-slash icon-password"></i></span>
                                    <br>
                                <span class="small text-danger">password minimum leght: 6</span>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <br>
                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6 ">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" style="text-align:center;">
                            </div>
                        </div> 
        
                      <div class="modal-footer">
                        <button  type="submit" class="btn btn-danger">{{ __('Register') }}</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </p>
            </div>
      </div>
    </div>
  </div>
</div><!--Register modal end-->

<!-- Cooperative Modal -->
<div class="modal fade" id="coopModal" tabindex="-1" role="dialog" aria-labelledby="coopModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="coopModalLabel">Register your cooperative and give your members a splendid shopping experience...</h5>
        <p></p>
       
      </div>
      <div class="modal-body">
        
        <p>
 <form method="POST" action="{{ route('register') }}">
                        @csrf

                          <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Cooperative Name</label>
                          <div class="col-md-6 form-group">
                              @php
                            $coopID = rand(100,999);
                            @endphp
                                <input  type="hidden"  name="code" value="Coopmart{{ $coopID }}">
                                <input type="hidden"  name="role" value="2">
                              <input type="hidden"  name="role_name" value="cooperative">
                               @php
                            $rand = rand(100000000,999999999);
                            @endphp
                            <input type="hidden" name="voucher" value="C{{ $rand }}">

                            <input id="coopname" type="text"name="coopname" required class="form-control" >
                       
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">First Name</label>

                            <div class="col-md-6 form-group">
                                <input id="fname" type="text" name="fname" value="" required class="form-control" >

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                          <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Last Name</label>

                            <div class="col-md-6 form-group ">
                                <input id="lname" type="text"  name="lname" value="" required class="form-control" >

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6 form-group ">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                           <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6 input-icons" style="width:50%">
                               
                                <input id="password" type="password" class="@error('password') is-invalid @enderror input-field " name="password" required autocomplete="new-password">
                                 <span class="hide-show ">
                                    <i class="fa fa-eye-slash icon-password"></i></span>
                                    <br>
                                <span class="small text-danger">password minimum leght: 6</span>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <br>
                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6 ">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" style="text-align:center;">
                            </div>
                        </div> 
                        
                   
         </p>
      </div>
      <div class="modal-footer">
        <button  type="submit" class="btn btn-danger">{{ __('Register') }}</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        

         </form>
      </div>
    </div>
  </div>
</div><!--coop modal end-->

        <!-- jQuery Plugins -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/slick.min.js"></script>
        <script src="js/nouislider.min.js"></script>
       <!--  <script src="js/jquery.zoom.min.js"></script> -->
        <!-- dataTable js -->

        <!-- main js -->
        <script src="js/main.js"></script>
        
<script type="text/javascript">
   $(function(){
  $('.hide-show').show();
  $('.hide-show i').addClass('show')

  $('.hide-hide').hide();
  $('.hide-hide').addClass('hide')
  
  $('.hide-show i').click(function(){
    if( $(this).hasClass('show') ) {
      $(this).addClass('show');
      $('input[name="password"]').attr('type','text');
      $(this).removeClass('show');
    } else {
       $(this).addClass('show');
       $('input[name="password"]').attr('type','password');
       $(this).addClass('show');
    }
  });
    
    $('form button[type="submit"]').on('click', function(){
        $('.hide-show ').addClass('show');
        $('.hide-show i').parent().find('input[name="password"]').attr('type','password');
    }); 
});
</script>

     