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
                <li class="breadcrumb-item active" aria-current="page">Cooperative</li>
              </ol>
            </nav>

            <div class="pb-3">
              <h1>Dashboard</h1>  

              <h5 class="navbar bg-dark text-white" style="padding-left: 10px;" >
                Your CoopMart User ID is:  &nbsp; {{Auth::user()->code}}.
                </h5>
                 Share it with your members; it's  used in pairing a member to your cooperative.

                  <div class="card-body text-center">

                   @if (session('profile'))
                        <div class="alert alert-danger" role="alert">
                            <a href="{{url('profile') }}" class="cursor"> {!! session('profile') !!}</a>
                        </div>
                    @endif
                    
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
            </div>

            <div class="row">
              <div class="col-md-6 col-lg-3 d-flex">
                <div class="card mb-grid w-100">
                  <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between mb-3">
                      <h5 class="card-title mb-0 small">
                       Total Members Credit
                      </h5>

                      <div class="card-title-sub">
                        ₦{{ number_format($credit->sum('credit')) }}
                      </div>
                    </div>

                    <div class="progress mt-auto">
                      <div class="progress-bar" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-6 col-lg-3 d-flex">
                <div class="card mb-grid w-100">
                  <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between mb-3">
                      <h5 class="card-title mb-0 small">
                      Total Confirmed Orders
                      </h5>

                      <div class="card-title-sub">
                      {{ $count_orders->count() }}
                      </div>
                    </div>

                    <div class="progress mt-auto">
                      <div class="progress-bar" role="progressbar" style="width: 60%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-6 col-lg-3 d-flex">
                <div class="card border-0 bg-primary text-white text-center mb-grid w-100">
                  <div class="d-flex flex-row align-items-center h-100">
                    <div class="card-icon d-flex align-items-center h-100 justify-content-center">
                      <i data-feather="shopping-cart"></i>
                    </div>
                    <div class="card-body">
                      <div class="card-info-title">Sales</div>
                      <h3 class="card-title mb-0">
                       ₦{{ number_format($sales->sum('tran_amount')) }}

                      </h3>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-6 col-lg-3 d-flex">
                <div class="card border-0 bg-dark text-white text-center mb-grid w-100">
                  <div class="d-flex flex-row align-items-center h-100">
                    <div class="card-icon d-flex align-items-center h-100 justify-content-center">
                      <i data-feather="users"></i>
                    </div>
                    <a class="card-body text-white" href="{{url('members') }}">
                      <div class="card-info-title">Members</div>
                      <h3 class="card-title mb-0">
                       {{ $members->count() }}
                      </h3>
                    </a>
                  </div>
                </div>
              </div>
            </div>

  @if(Session::has('payment')== true)
                                        <!--show alert-->
                                        <p class="alert {{ Session::get('alert-class', 'alert-info') }} text-center">{{ Session::get('payment') }}</p>
                                        @endif

                @if(Session::has('payment')== false)
                                        <!--show alert-->
                    <p style="display: none;">{{ Session::get('payment') }}</p>
                 @endif
          

            <div class="row">
              <div class="col-lg-8">
                <div class="card">
                  <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-header-title">Payment</div>

                    <nav class="card-header-actions">
                      <a class="card-header-action" data-toggle="collapse" href="#card1" aria-expanded="false" aria-controls="card1">
                        <i data-feather="minus-circle"></i>
                      </a>
                      
                      <div class="dropdown">
                        <a class="card-header-action" href="#" role="button" id="card1Settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i data-feather="settings"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="card1Settings">
                          <a class="dropdown-item" href="#">Invoices</a>
                          <a class="dropdown-item" href="#">Another action</a>
                          <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                      </div>

                      <a href="#" class="card-header-action">
                        <i data-feather="x-circle"></i>
                      </a>
                    </nav>
                  </div>
                  <div class="card-body collapse show tabel-resposive" id="card">
                    <h4 class="card-title">All orders placed by members</h4>
                    <p class="card-text">Confirmed orders become's sales when you make payment.</p>
               
                      <p>
                        @php 
                        $tamount = 0
                        @endphp 
                        @php $ran = random_int(10000000, 99999999); 
                        $tamount += $all_orders->sum('total')* 100
                        @endphp
                           
            
                        <form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal" role="form" >
          
                             @csrf
                              <div class="form-group">
                                <!--information of the person making the payment-->
                                <input type="hidden"  name="email" value="{{Auth::user()->email}}" />
                                <!-- amount to be paid-- which is the total amount of the order placed by a member --->
                                  <!-- paystack reference -->
                              <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}">
            
                               <input type="hidden" name="metadata" value="{{ json_encode($array = 
                               [
                                'user_id' => Auth::user()->id,
                                'order_id'=>$all_orders_id->pluck('id'),
                                ]
                                ) }}" > <!-- {{-- For other necessary things you want to add to your payload. it is optional though --}}
                              -->
                             <input type="hidden" name="order_id" value="{{ $all_orders_id->pluck('id') }}">
                              
                                <input type="hidden" name="amount" value="{{$tamount}}" />
                             
                              </div>

                              <div class="form-submit">
                                 Total Amount.
                                  <span class="" style="font-weight:700;">&nbsp;₦{{number_format($all_orders->sum('total'))}}&nbsp; &nbsp; 

                                  <!--   {{collect($all_orders_id)}}  {{$all_orders_id->pluck('id')}} -->

                                  </span>
                                <button type="submit" name="submit" value="Pay Now!" class="btn btn-outline-danger btn-sm"> Pay All Confirmed Order ! </button>
                              </div>

                            </form>
                          </p>
                    
                    <table class="table-striped table">
                        <thead>
                          <tr class="small">
                            <th>Date</th>
                            <th>Member</th>
                            <th>Cooperative</th>
                            <th>Amount</th>
                            <th>Order Number</th>
                              <th>Status</th>
                           <th></th>
                          
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($orders as $order)
                        
                          <tr class="small">
                            <td>
                            {{ date('d/m/y', strtotime($order->created_at))}}</td>
                             <td>{{$order['fname']}} {{$order['lname']}}</td>
                             
                             <td>{{$order['coopname']}}</td>
                             <td id="amount">{{ number_format($order['total']) }}</td>
                             <td>
                              <a href="invoice/{{ $order->order_number }}" title="Click to view">{{$order['order_number'] }}</a>
                            </td>
                               <td>{{$order['status']}}</td>
                             
                              <td>
                                @php 
                                 $pamount = 0
                                 @endphp 
                                  @php $ran = random_int(10000000, 99999999); 
                                  $pamount += $order['total']* 100
                                  @endphp

                                @if( $order->status == 'Paid' )
                                <span style="display:block;" class="text-success"><i class="fa fa-check"></i> </span>

                                @endif

                                 @if( $order->status == 'confirmed' )
                              

                              @endif
                          </td>
                              
                          </tr>
                        
                            @endforeach
                        

                        </tbody>

                    </table>
                     <div class="store-filter clearfix">
                          {{$orders->links()}}

                          
                        </div>
                  </div>
                </div>
              </div><!-- col-12-->
               <div class="col-lg-4">

                <div class="card">
                  <div class="card-header">
                  Credit Limit
                  </div>
                  <div class="card-body">
                    <h4 class="card-title"></h4>
                    <p class="card-text">A Voucher is same as cash or credit. Members can use it to place orders base on it's credit limit</p>
                       <a href="{{ route('members')}}" class="btn btn-danger">Add Credit Limit To A Member Voucher</a>
                   
                   
                  </div>
                </div><!--card-->
              </div>
             
            </div>
          </div>
        </div>
      </div>
  </div>
  @endsection
  

