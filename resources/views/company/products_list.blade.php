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
                <li class="breadcrumb-item"><a href="{{ url('superadmin') }}">dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">product_list</li>
              </ol>
            </nav>

            <div class="pb-3">
              <h1>Products</h1>  
                <div class="card-body">

                    @if (session('approve'))
                        <div class="alert alert-success" role="alert">
                            {{ session('approve') }}
                        </div>
                    @endif

                    <div class="row">
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-header-title">All</div>

                    <nav class="card-header-actions">
                      <a class="card-header-action" data-toggle="collapse" href="#card1" aria-expanded="false" aria-controls="card1">
                        <i data-feather="minus-circle"></i>
                      </a>
                      
                      <div class="dropdown">
                        <a class="card-header-action" href="#" role="button" id="card1Settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i data-feather="settings"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="card1Settings">
                       
                        </div>
                      </div>

                      <a href="#" class="card-header-action">
                        <i data-feather="x-circle"></i>
                      </a>
                    </nav>
                  </div>
                  <div class="card-body collapse show tabel-resposive" id="card">
                    <h4 class="card-title"></h4>
                    <p class="card-text">Only "approved" products will be visible on CoopMart landing page.</p>
                    <table class="table-striped table">
                        <thead>
                          <tr class="small" >
                            <th class="small">Date</th>
                            <th>Seller</th>
                              <th>Product</th>
                              <th>Quantity</th>
                              <th>Price</th>
                             <th>Images</th>
                            <th>Status</th>
                            <th>Approve</th>
                          
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($products as $product)
                          <tr class="small">
                            <td class="small">
                            {{ date('d/m/y', strtotime($product->created_at))}}</td>
                             <td>{{$product['fname']}} {{$product['lname']}}</td>
                         
                             <td>{{$product['prod_name']}}</td>
                             <td>{{$product['quantity'] }}</td>
                              <td>₦{{number_format($product['price']) }}</td>
                               <td>
                               <img src="{{asset( $product['image'] )}}" width="45" height="45">
                               	<br>
                               	 <img src="{{asset( $product['img1'] )}}" width="45" height="45">
                               		<br>
                                <img src="{{asset( $product['img2'] )}}" width="45" height="45">
                               	 	<br>
                              	<img src="{{asset( $product['img3'] )}}" width="45" height="45">

                               	 	<br>
                               	 <img src="{{asset( $product['img4'] )}}" width="45" height="45">
                               </td>
                              <td>{{$product['prod_status']}}</td>
                             
                              <td>
                               @if($product->prod_status == 'approve')
                                  <i class="fa fa-check"></i>

                                  @else
                                  <form method="POST" action="/approved" accept-charset="UTF-8" class="form-horizontal" role="form" style="display:block;">
    
                                    @csrf
                                    <div class="form-group" >
                                        <input type="hidden" name="id" value="{{$product->id }}">

                                    </div>

                                    <input type="submit" name="submit" value="Approve" class="btn btn-outline-primary btn-sm">

                                </form>
                                @endif

                          </td>
                              
                          </tr>
                          @endforeach

                        </tbody>

                    </table>
                     <div class="store-filter clearfix">
                           {{$products->links()}}
                        </div>
                  </div>
                </div>
              </div><!-- col-12-->
             
             
            </div>


            </div><!--pb-3-->

        </div>
    </div>
</div>
</div>
@endsection