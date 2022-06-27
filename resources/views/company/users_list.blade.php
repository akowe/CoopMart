@extends('layouts.app')

@extends('layouts.sidebar')


@section('content')

   <!-- ALL CART SECTION -->
           <div class="adminx-content">
        <!-- <div class="adminx-aside">

        </div> -->

        <div class="adminx-main-content">
          <div class="container-fluid">
            <!-- container -->
            <nav aria-label="breadcrumb" role="navigation">
              <ol class="breadcrumb adminx-page-breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Members</li>
              </ol>
            </nav>

            <div class="pb-3">
              <h4>All cooperatives organization</h4>
              <p class="text-danger"> To add credit to a member voucher, enter the amount and click "Add Credit"<br> To subtract from a member credit enter "-"" amount example: enter -100</p>
            </div>
                @if(Session::has('credit')== true)
                                        <!--show alert-->
                                        <p class="alert {{ Session::get('alert-class', 'alert-info') }} text-center">{{ Session::get('credit') }}</p>
                                        @endif

                @if(Session::has('credit')== false)
                                        <!--show alert-->
                    <p style="display: none;">{{ Session::get('credit') }}</p>
                 @endif

                 <!-- alert if member is not verified-->
                  @if(Session::has('verified')== true)
                                        <!--New registration alert-->
                                        <p class="alert {{ Session::get('alert-class', 'alert-info') }} text-center">{{ Session::get('verified') }}</p>
                                        @endif

                @if(Session::has('verified')== false)
                                        <!--show alert-->
                    <p style="display: none;">{{ Session::get('verified') }}</p>
                 @endif
            
          
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12 d-flex table-responsive">
                    <table class="table table-striped " id="myTable">
                    <thead>
                        <tr>
                            
                            <th>Cooperative</th>
                             <th>Email</th>
                            <th>Coop Details</th>
                            <th>Credit</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
       
                         @foreach($coop as  $details)
                         <tr >
                                  
                        <td >{{ $details['coopname'] }}</td>
                          <td> {{ $details['email'] }}</td>
                        <td >{{ $details['fname'] }}
                            <br>
                            {{ $details['lname'] }}
                            
                            <br>
                            {{ $details['phone'] }}
                            <br>
                            {{ $details['address'] }}
                            <br>
                            {{ $details['location'] }}
                        </td>
                        
                             
                        <!--  <td >{{ $details['code'] }}</td> -->

                        <td >{{number_format($details['credit'])  }}</td>
                    
                        <td>
                        <form action="/credit_limit" method="post" name="submit">
                            @csrf
                         <input type="hidden" name="user_id"lass="col-sm-3"  value="{{ $details['user_id'] }}">

                          <input type="number" name="credit"class="col-md-3" style="border:none;"   id="new_bal" placeholder="amount"  required>

                           <button type="submit" name="submit" class="btn btn-outline-danger btn-sm">Add Credit</button>

                          <!--   <a href="edit/{{ $details->id }}"> ll
                            </a> -->
                        </form>

                         
                    </td>
                      </tr>

                    @endforeach
                
                    
                   
                </tbody>
            </table>
    	    
        </div><!--col 12-->
 {{ $coop->links() }}
    </div><!--roww-->

</div>
<br><br>
  <div class="container-fluid">
            <!-- container -->
           <div class="pb-3">
              <h4>All members of cooperatives</h4>
        
            </div>

      <!-- row -->
                <div class="row">
                    <div class="col-lg-12 d-flex table-responsive">
                    <table class="table table-striped " id="myTable">
                    <thead>
                         <tr>
                            
                            <th>Cooperative</th>
                           
                            <th>Buyer Details</th>
                            <th>Credit</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
       
                         @foreach($members as  $details)
                         <tr >
                                  
                         <td >{{ $details['coopname'] }}</td>
                       
                        <td >{{ $details['fname'] }}
                            <br>
                            {{ $details['lname'] }}
                            <br>
                            {{ $details['email'] }}
                            <br>
                            {{ $details['phone'] }}
                            <br>
                            {{ $details['address'] }}
                            <br>
                            {{ $details['location'] }}
                        </td>

                        <td >{{number_format($details['credit'])  }}</td>
                    
                      
                      </tr>

                    @endforeach
                
                     
                   
                </tbody>
            </table>
            
        </div><!--col 12-->
{{ $members->links() }}
    </div><!--roww-->
</div>


<br><br>
  <div class="container-fluid">
            <!-- container -->
           <div class="pb-3">
              <h4>Sellers On CoopMart</h4>
      
            </div>

      <!-- row -->
                <div class="row">
                    <div class="col-lg-12 d-flex table-responsive">
                    <table class="table table-striped " id="myTable">
                    <thead>
                         <tr>
                            
                            <th>Store</th>
                            <th>Email</th>
                            <th>Seller Details</th>
                        </tr>
                    </thead>
                    <tbody>
       
                         @foreach($merchants as  $details)
                         <tr >
                                  
                        <td >{{ $details['coopname'] }}</td>
                        <td>{{ $details['email'] }}</td>
                        <td >{{ $details['fname'] }}
                            <br>
                        {{ $details['lname'] }}
                            <br>
                         {{ $details['phone'] }}
                         <br>
                         {{ $details['address'] }}
                         <br>
                          {{ $details['location'] }}
                        </td>
                       
                            
                      </tr>

                    @endforeach
                
                     
                   
                </tbody>
            </table>
            
        </div><!--col 12-->
{{ $merchants->links() }}
    </div><!--roww-->
</div>
</div> <!-- section -->

<script type="text/javascript">
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>

@endsection