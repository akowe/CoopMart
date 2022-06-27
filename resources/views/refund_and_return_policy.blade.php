@extends('layouts.header')

@section('content')

        <!-- ALL CART SECTION -->
        <div  class="section">
            <!-- container -->
            <div class="container">

                <!-- row -->
                <div class="row">
                     @foreach($about as $details)
                    <div class="col-md-12">
                      <h4>Reurn & Refund Policy</h4>
				    <p class="text-justify">{!! nl2br($details->return_policy) !!}</p>
                </div>
                 @endforeach

                </div> <!-- /row -->
            </div> <!-- /container -->
        </div> <!-- /CART SECTION -->


@endsection