@extends('layouts.app')

@extends('layouts.sidebar')


@section('content')

    <!-- adminx-content-aside -->
      <div class="adminx-content">
        <!-- <div class="adminx-aside">

        </div> -->

        <div class="adminx-main-content">
          <div class="container-fluid">
            <!-- BreadCrumb -->
            <nav aria-label="breadcrumb" role="navigation">
              <ol class="breadcrumb adminx-page-breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profile</li>
              </ol>
            </nav>

            <div class="pb-3">
              <h4 class="text-center" >Update Profile</h4>  
                <div class="card-body">

                     @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                          @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            <div class="row">
                 <div class="col-lg-3">
                 </div>
              <div class="col-lg-6">
                <div class="card">
                  <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-header-title">All</div>

                   
                  </div>
                  <div class="card-body collapse show tabel-resposive" id="card">
                    <h4 class="card-title"></h4>
                   
                    
                     @foreach($users as $user)
            <form method="post" action="/update_profile" name="submit">
                @csrf <!-- {{ csrf_field() }} -->
                              <div class="form-group">
                                <input class="form-control" type="email" id="email-address" value="{{$user['email']}}" readonly />
                              </div>

                              <div class="form-group">
                                <label>First Name</label>
                              
                                <input class="form-control"  type="text" name="fname"  value="{{$user['fname']}}"  />
                                   @error('fname')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                              </div>

                               <div class="form-group">
                                <label>Last Name</label>
                              
                                <input class="form-control"  type="text" name="lname"  value="{{$user['lname']}}"  />
                                       @error('lname')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                              </div>

                              <div class="form-group">
                          <label>Mobile Number</label>
                                <input class="form-control"  name="phone" type="number" value="{{$user['phone']}}"  id="first-name" />
                                       @error('phone')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                              </div>

                              <div class="form-group">
                             <label> Business Address</label>
                                <input class="form-control" name="address"  type="text" value="{{$user['address']}}" />
                                    @error('address')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                              </div>

                               <div class="form-group">
                             <label>State</label>
                                <input class="form-control"  name="location" type="text" value="{{$user['location']}}" />
                                    @error('location')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                              </div>
                               @auth
                              @if(Auth::user()->role_name == 'merchant')
                                 <div class="form-group">
                             <label>Bank Name</label>
                                <input class="form-control"  name="bank" type="text" value="{{$user['bank']}}" />
                                    @error('bank')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                              </div>

                              <div class="form-group">
                              <label>Account Name</label>
                                <input class="form-control"  name="account_name" type="text" value="{{$user['account_name']}}" />
                                    @error('account_name')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                              </div>

                              <div class="form-group">
                              <label>Account Number</label>
                                <input class="form-control"  name="account_number" type="number" value="{{$user['account_number']}}" />
                                    @error('account_number')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                              </div>
                              @else
                              @endif
                              @endauth

                            

                              <div class="form-submit">
                                <button type="submit"  name="submit" class="btn btn-outline-danger"> Update </button>
                              </div>

                            </form>
       
@endforeach
                  </div>
                </div>
              </div><!-- col-6-->
             
              <div class="col-lg-3">
                 </div>
            </div>


            </div><!--pb-3-->

        </div>
    </div>
</div>
</div>




@endsection