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
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Terms and Condition Page</li>
              </ol>
            </nav>

            <div class="pb-3">
              <h4>  @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif</h4>
              <p class="text-danger"></p>
            </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12 d-flex ">
                    
    	       <form action="{{ url('tandc_update/'.$about->id) }}" method="POST">
                @csrf
                @method('PUT')
                    <div class="form-group">
                     <h6>T & C </h6>
                        <textarea type="text" name="terms_c" rows="135" cols="130" style="text-align:justify !important; display: flex; padding: 10px;">
                            {{$about->terms_c}}
                            </textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-danger">Update</button>
                    </div>
                </form>
           
        </div><!--col 12-->
    </div><!--roww-->

</div>
</div> <!-- section -->

<script type="text/javascript">
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>

@endsection