

   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">
    

.carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      margin: auto;
  }
  
#myCarousel{
    max-width: 650px;
    margin: 0 auto;
    background: #fff;
       background-color: transparent;
}

.carousel-control{
    background-color: #fff!important;
    text-shadow: none!important;
    color: #333 !important;
}

.carousel-control.right{
    background: #fff !important;
     color: #333 !important;
}

  
.carousel-control.right: hover{
  
       background:  #ffffff !important;
        color: #333 !important;
}


.carousel-control.left{
    background: #fff !important;
     color: #333 !important;
}

  
.carousel-control.left: hover{
  
       background:  #ffffff !important;
        color: #333 !important;
}
#thumbCarousel{
   /* max-width: 650px;*/
    margin: 0 auto;
    overflow: hidden;
    background: #ffffff;
    padding: 10px 0;
}

#thumbCarousel .thumb{
    float: left;
    margin-right: 10px;
   /* border: 1px solid #ccc;*/
    background: #fff;
}

#thumbCarousel .thumb:last-child{
    margin-right: 0;
}

.thumb:hover{
    cursor: pointer;
}

.thumb img{
    opacity: 0.5;
}

.thumb img:hover{
    opacity: 1;
}

.thumb.active img{
    opacity: 1;
 /* border: 1px solid #1d62b7;*/
}

/*carousel*/
</style>


          <div class="container">
    <div class="row">
    
        <div class="col-md-12">
        <div class="col-md-2">
         </div>
      
       <h4>Product Preview </h4>
          <div class="col-md-8">
                       @foreach($products as $product)
 

<div id="myCarousel" class="carousel slide" data-interval="false">

  <div class="carousel-inner" role="listbox">
      <div class="item active">
      
        <img src="{{ $product->image }}"  style="width: 420px; height: 440px" >
      </div>
      <div class="item">

        <img src="{{ $product->img1 }}" style="width: 420px; height: 440px" >
      </div>

       <div class="item">
        <img src="{{ $product->img2 }}" style="width: 420px; height: 440px">
      </div>
    
     <div class="item">
        <img src="{{ $product->img3 }}" style="width: 420px; height: 440px">
      </div>
    
     <div class="item">
        <img src="{{ $product->img4 }}" style="width: 420px; height: 440px">
      </div>
    
   
      
   <!--    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
      </a> -->
    </div>
    
    <div id="thumbCarousel">
     <div data-target="#myCarousel" data-slide-to="0" class="thumb active">
        <img src="{{ $product->image }}"  style="width: 120px; height: 130px"></div>

      <div data-target="#myCarousel" data-slide-to="1" class="thumb">
        <img src="{{ $product->img1 }}" style="width: 120px; height: 130px"></div>      
        
        <div data-target="#myCarousel" data-slide-to="2" class="thumb">
            <img src="{{ $product->img2 }}" style="width: 120px; height: 130px"></div>  

         <div data-target="#myCarousel" data-slide-to="3" class="thumb">
            <img src="{{ $product->img3 }}" style="width: 120px; height: 130px"></div>   

          <div data-target="#myCarousel" data-slide-to="4" class="thumb">
            <img src="{{ $product->img4 }}" style="width: 120px; height: 130px"></div>    

    </div>
  
  </div>



     @endforeach
 </div>

                                                <div class="col-md-2">
                                                <h4>{{ $product->prod_name }}</h4>
                                               <h4 class="">{{ $product->prod_brand }}</h4>
                                                <p>{{ $product->description }}</p>

                                                 @if($product->quantity < 1)
                                                <del class="product-price">₦{{ number_format($product->price) }} </del>
                                          
                                          
                                                <br><br>
                                             
                                                <div class="add-to-cart">
                                                    <button type="button" class="add-to-cart btn"> 
                                                   
                                                    <i class="fa fa-shopping-cart"></i> Sold Out !</button>     
                                                    </div>
                                                @else
                                   
                                                <h4 class="product-price">₦{{ number_format($product->price) }}  <small><del class="product-old-price"> ₦{{number_format($product->old_price)  }}</del></small></h4>
                                          
                                          <div class="row">
                                                   <!-- end col -->
                                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                           
                                             <p>
                                                <br>
                                                  <label> Qty </label> <input type="number" name="" value="1" class="form-control">
                                              </p>
                                        </div>
                                         <!-- end col -->
                          
                                    </div>
                                     <div class="add-to-cart">
                                    <button type="button" class="add-to-cart btn"> 
                                    <a class="add-to-cart-btn btn" href="{{ route('add.cart', $product->id) }}">
                                    <i class="fa fa-shopping-cart"></i> Add To Cart</a></button>     
                                    </div>
                                    @endif
                         </div>
        </div><!--col-12-->

                    </div><!-- end row-->
            </div><!--container-->


     <script type="text/javascript">
$(document).ready(function(){
     
        //Show carousel-control
        
        $("#myCarousel").mouseover(function(){
            $("#myCarousel .carousel-control").show();
        });

        $("#myCarousel").mouseleave(function(){
            $("#myCarousel .carousel-control").hide();
        });
        
        //Active thumbnail
        
        $("#thumbCarousel .thumb").on("click", function(){
            $(this).addClass("active");
            $(this).siblings().removeClass("active");
        
        });
        
        //When the carousel slides, auto update
        
        $('#myCarousel').on('slide.bs.carousel', function(){
           var index = $('.carousel-inner .item.active').index();
           //console.log(index);
           var thumbnailActive = $('#thumbCarousel .thumb[data-slide-to="'+index+'"]');
           thumbnailActive.addClass('active');
           $(thumbnailActive).siblings().removeClass("active");
           //console.log($(thumbnailActive).siblings()); 
        });
     });
     </script>



