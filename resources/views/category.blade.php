@extends('layouts.header')

@section('content')
<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<ul class="breadcrumb-tree">
							<li><a href="{{ url('/') }}">Home</a></li>
							<li><a href="">All Categories</a></li>
							<li class="active"></li>
						</ul>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /BREADCRUMB -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- ASIDE -->
					<div id="aside" class="col-md-3">
						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Categories</h3>
							<div class="checkbox-filter">


                  
   @foreach (\App\Models\Categories::select('cat_name')->get() as $category)
								<div class="input-checkbox">
									<input type="checkbox" id="category-1" value="{{ $category->cat_name }}">
									<label for="category-1">
										<span></span>
										{{ $category['cat_name'] }}
										
									</label>
								</div>

								
  @endforeach
								
							</div>
						</div>
						<!-- /aside Widget -->

						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Price</h3>
							<div class="price-filter">
								<div id="price-slider"></div>
								<div class="input-number price-min">
									<input id="price-min" type="number">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
								<span>-</span>
								<div class="input-number price-max">
									<input id="price-max" type="number">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
							</div>
						</div>
						<!-- /aside Widget -->

						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Brand</h3>
							<div class="checkbox-filter">
								<div class="input-checkbox">
									<input type="checkbox" id="brand-1">
									<label for="brand-1">
										<span></span>
										SAMSUNG
										<small></small>
									</label>
								</div>
								<div class="input-checkbox">
									<input type="checkbox" id="brand-2">
									<label for="brand-2">
										<span></span>
										LG
										<small></small>
									</label>
								</div>
								<div class="input-checkbox">
									<input type="checkbox" id="brand-3">
									<label for="brand-3">
										<span></span>
										SONY
										<small></small>
									</label>
								</div>
								<div class="input-checkbox">
									<input type="checkbox" id="brand-4">
									<label for="brand-4">
										<span></span>
										SAMSUNG
										<small></small>
									</label>
								</div>
								<div class="input-checkbox">
									<input type="checkbox" id="brand-5">
									<label for="brand-5">
										<span></span>
										LG
										<small></small>
									</label>
								</div>
								<div class="input-checkbox">
									<input type="checkbox" id="brand-6">
									<label for="brand-6">
										<span></span>
										SONY
										<small></small>
									</label>
								</div>
							</div>
						</div>
						<!-- /aside Widget -->

						<!-- aside Widget -->
				
						<!-- /aside Widget -->
					</div>
					<!-- /ASIDE -->

					<!-- STORE -->
					<div id="store" class="col-md-9">
						<!-- store top filter -->
						<!-- <div class="store-filter clearfix">
							<div class="store-sort">
								<label>
									Sort By:
									<select class="input-select">
										<option value="0">Popular</option>
										<option value="1">Position</option>
									</select>
								</label>

								<label>
									Show:
									<select class="input-select">
										<option value="0">20</option>
										<option value="1">50</option>
									</select>
								</label>
							</div>
							<ul class="store-grid">
								<li class="active"><i class="fa fa-th"></i></li>
								<li><a href="#"><i class="fa fa-th-list"></i></a></li>
							</ul>
						</div> -->
						<!-- /store top filter -->

						<!-- store products -->
						<div class="row">
							<!-- product -->
							
							
							@if($products->isNotEmpty())
							    @foreach ($products as $product)
							       
							 
								<div class="col-md-4 col-xs-6">
								<div class="product">
									<div class="product-img text-center">
										 <img src="{{ $product->image }}" alt="" data-toggle="modal" data-target="#product_view{{ $product->id }}" class="cursor text-center">
										<!--product 30% sales label here-->
									</div>
									<div class="product-body">
										<p class="product-category">{{ $product->prod_brand }}</p>
										<h6 class="product-name"><a href="#">{{ $product->prod_name }}</a></h6>
										<h4 class="product-price">???{{ number_format($product->price )}} <del class="product-old-price">???{{number_format($product->old_price)  }}</del></h4>
										
										   <i style="display: none;">{{$product->seller_id }}</i>
										<div class="product-btns">
										
										
											<button class="quick-view" data-toggle="modal" data-target="#product_view{{ $product->id }}"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
										</div>
									</div>
									
 									
                                    <button type="button" class="add-to-cart btn"> 
                                    <a class="add-to-cart-btn btn" href="{{ route('add.to.cart', $product->id) }}">
                                    <i class="fa fa-shopping-cart"></i> Add To Cart</a></button>     
                                    

									</div>
								</div>
							<!-- col-4-->

							      <!-- quick view modal /col-3 -->
       
                            <div class="modal quick_view" id="product_view{{ $product->id }}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <a href="#" data-dismiss="modal" class="class pull-right"><span class="fa fa-times"></span></a>
                                        <h4 class="modal-title">{{ $product->prod_brand }}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                               <img src="{{ $product->image }}" alt="" width="500" height="500" style="text-align: left;">
                                           </div>
                                            <div class="col-md-4">
                                                <h4>{{ $product->prod_name }}</h4>
                                               
                                                <p>{{ $product->description }}</p>
                                                <h4 class="product-price">???{{ number_format($product->price )}}  <small><del class="product-old-price">???{{number_format($product->old_price)  }}</del></small></h4>
                                          
                                          <div class="row">
                                                   <!-- end col -->
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                           
                                             <p>
                                                <br>
                                                  <label>  Qty: </label> <input type="number" name="" value="1" class="form-control">
                                             </p>
                                        </div>
                            <!-- end col -->
                            <div class="col-md-4 col-sm-12">
                            
                            </div>
                            <!-- end col -->
                        </div>
                                                <div class="space-ten"></div>
                                                <div class="add-to-cart">
                                                    <button type="button" class="add-to-cart-btn btn"> 
                                                           <a class="add-to-cart-btn btn" href="{{ route('add.to.cart', $product->id) }}">
                                                            <i class="fa fa-shopping-cart"></i> Add To Cart
                                                        </a></button>

                                            
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
					<!-- quick view modal /col-3 -->
               @endforeach
							@else
							    <div>
							        <h2>No product found</h2>
							    </div>
							@endif
							<!-- /product -->
						
							<div class="clearfix visible-sm visible-xs"></div>

							
						</div><!-- /store products -->

						 <!-- store bottom filter -->
                      
                        <!-- /store bottom filter -->
					</div>
					<!-- ID/STORE -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

@endsection