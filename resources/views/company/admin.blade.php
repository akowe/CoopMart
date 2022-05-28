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
                <li class="breadcrumb-item active" aria-current="page">Admin</li>
              </ol>
            </nav>

            <div class="pb-3">
              <h1>Dashboard</h1>  
                <div class="card-body">

                    @if (session('pay'))
                        <div class="alert alert-success" role="alert">
                            {{ session('pay') }}
                        </div>
                    @endif
            </div>

            <div class="row">
              <div class="col-md-3 col-lg-3 d-flex">
                <div class="card mb-grid w-100">
                  <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between mb-3">
                      <h5 class="card-title mb-0 small">
                       Total Sellers 
                      </h5>

                      <div class="card-title-sub">
                        {{ $sellers->count() }}
                      </div>
                    </div>

                    <div class="progress mt-auto">
                      <div class="progress-bar" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
              </div>

               <div class="col-md-3 col-lg-3 d-flex">
                <div class="card mb-grid w-100">
                  <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between mb-3">
                      <h5 class="card-title mb-0 small">
                       Total Cooperatives
                      </h5>

                      <div class="card-title-sub">
                     {{ $cooperatives->count() }}
                      </div>
                    </div>

                    <div class="progress mt-auto">
                      <div class="progress-bar" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-3 col-lg-3 d-flex">
                <div class="card mb-grid w-100">
                  <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between mb-3">
                      <h5 class="card-title mb-0 small">
                      Total Members
                      </h5>

                      <div class="card-title-sub">
                   {{ $members->count() }}
                      </div>
                    </div>

                    <div class="progress mt-auto">
                      <div class="progress-bar" role="progressbar" style="width: 60%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
              </div>

           

              <div class="col-md-3 col-lg-3 d-flex">
                <div class="card border-0 bg-dark text-white text-center mb-grid w-100">
                  <div class="d-flex flex-row align-items-center h-100">
                    <div class="card-icon d-flex align-items-center h-100 justify-content-center">
                      <i data-feather="users"></i>
                    </div>
                    <a href="{{url('users_list')}}" class="card-body text-white">
                      <div class="card-info-title">Overall Users</div>
                      <h3 class="card-title mb-0">
                      {{ $users->count() }}
                      </h3>
                    </a>
                  </div>
                </div>
              </div>
            </div>

                  <!-- count product, order and sales-->

             <div class="row">
              <div class="col-md-6 col-lg-3 d-flex">
                <div class="card mb-grid w-100">
                  <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between mb-3">
                      <h5 class="card-title mb-0 small">
                       Total Products
                      </h5>

                      <div class="card-title-sub">
                  {{ $products->count() }}
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
                       Total Order
                      </h5>

                      <div class="card-title-sub">
                        {{ $count_orders->count() }}
                      </div>
                    </div>

                    <div class="progress mt-auto">
                      <div class="progress-bar" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
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
                    <a href="{{url('transactions') }}" class="card-body text-white">
                      <div class="card-info-title">Sales</div>
                      <h3 class="card-title mb-0">
                     
                        ₦{{ number_format($sales->sum('tran_amount')) }}
                      </h3>
                    </a>
                  </div>
                </div>
              </div>

            </div><!--row-->

            <div class="row">
              <div class="col-lg-12">
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
                    <h4 class="card-title">Order History</h4>
                    <p class="card-text">Mark an order "Paid" only when you have collected "Physical cash or cheque". </p>
                    <h6 class="alert-danger"> Any order you marked "Paid", the cooperative would'nt be able to pay for such order </h6>
                    
                    <table class="table-striped table">
                        <thead>
                          <tr class="small" >
                            <th>Date</th>
                            <th>Member</th>
                              <th>Cooperative</th>
                            <th>Amount</th>
                            <th>Order Number</th>
                              <th>Status</th>
                            <th>Make Payment</th>
                          
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($orders as $order)
                          <tr class="small">
                            <td>
                            {{ date('d/m/y', strtotime($order->created_at))}}</td>
                             <td>{{$order['fname']}} {{$order['lname']}}</td>
                             <td>{{$order['coopname'] }}</td>
                             <td>₦{{ number_format($order['total']) }}</td>
                             <td>
                              <a href="sales_invoice/{{ $order->order_id }}" title="Click to view">{{$order['order_number'] }}</a>
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
                                    <span style="display:block;" class="text-success"><i class="fa fa-check"></i> Done</span>

                                @endif

                                 @if( $order->status == 'confirmed' )
                                  <form method="POST" action="/mark_paid" accept-charset="UTF-8" class="form-horizontal" role="form" style="display:block;">
    
                                    @csrf
                                    <div class="form-group" >
                                        <input type="hidden" name="order_id" value="{{$order->order_id }}">
                                    </div>

                                    <input type="submit" name="submit" value="Paid" class="btn btn-outline-primary btn-sm">

                                </form>

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
             
             
            </div>
          </div>
        </div>
      </div>
  </div>
  @endsection
  

