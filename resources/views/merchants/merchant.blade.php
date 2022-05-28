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
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Seller</li>
              </ol>
            </nav>

            <div class="pb-3">
              <h1>Dashboard</h1>  
<!-- 
              <h5 class="navbar bg-dark text-white" style="padding-left: 10px;" >
               
                </h5> -->
               

                <div class="card-body">
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
                       Total Products
                      </h5>

                      <div class="card-title-sub">
                         {{ $count_product->count() }}
                      </div>
                    </div>

                    <div class="progress mt-auto">
                      <div class="progress-bar" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
              </div>

            
           
            </div>

  @if(Session::has('remove')== true)
                                        <!--show alert-->
                                        <p class="alert {{ Session::get('alert-class', 'alert-info') }} text-center">{{ Session::get('remove') }}</p>
                                        @endif

                @if(Session::has('remove')== false)
                                        <!--show alert-->
                    <p style="display: none;">{{ Session::get('remove') }}</p>
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
                    <h4 class="card-title">All products</h4>
                    <p class="card-text">Note that CoopMart percentage and coperative percentage would be added to each product on our landing page.</p>
                    
                    <table class="table-striped table">
                        <thead>
                          <tr class="small">
                            <th>Date</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Old Price</th>
                             <th>New Price</th>
                             <th>Status</th>
                            
                            <th>Remove Product</th>
                          
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($products as $product)
                          <tr class="small">
                            <td> {{ date('d/m/y', strtotime($product->created_at))}}</td>
                             <td>{{$product->prod_name }}</td>
                             <td>{{$product->quantity }}</td>
                             <td>{{$product->old_price }}</td>
                             <td>{{$product->price }}</td>
                                  <td>
                                    @if($product->prod_status == 'approve')
                                  
                                        <span  class="text-success"><i class="fa fa-check"></i> </span>
                                  
                                    @else
                                        Pending
                                    
                                   
                                  @endif</td>
                             <td class="text-danger">
                                 <form action="/remove_product" method="post" name="submit">
                            @csrf
                                 <input type="hidden" name="id"   value="{{$product->id }}">

                                  <input type="hidden" name="prod_status"  value="remove"  >

                                   <button type="submit" name="submit" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash-o"></i></button>
                            
                                    </form>
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
               <div class="col-lg-4">
                <div class="card">
                  <div class="card-header">
                  New Products
                  </div>
                  <div class="card-body">
                    <h4 class="card-title"></h4>
                    <p class="card-text">Note that all uploaded products would be review and approve by CoopMart before it becomes visible. This is within 48hours.</p>
                       <a href="{{ route('product') }}" class="btn btn-danger">Add Products</a>
                   
                   
                  </div>
                </div>
              </div>
             
            </div>
          </div>
        </div>
      </div>
  </div>
  @endsection
  

