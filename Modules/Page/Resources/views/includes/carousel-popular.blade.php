@php 
$injection = new Devdewa\Injection\Product(); 
$injection->post = $post;
$listings = $injection->most_popular();
@endphp
<!--<div class="text-left">
<pre>
{{ dump($listings) }}
</pre>
</div>-->
<div class="most-popular" id="most-popular" style="background-image:url({{asset('images/bali-tour.jpg')}});">
    <div class="owl-slider  wow fadeInUp">
        <div class="owl-carousel owl-theme carousel" data-items="3">
        @foreach($listings as $listing)
            <div class="item grid-item wow fadeIn" style="visibility: hidden; animation-name: none;">
                <div class="grid-top">
                    <a href="{!! url('/product/'. $listing->id); !!}" class="img_container">
                        @if(isset($listing->children["attachment"]))
                             @if($images = head($listing->children["attachment"]))
                                <img src="{{asset($images->guid)}}" alt="blog_img" class="img-responsive">
                             @endif
                        @else
                             <img src="{{asset('images/1.jpg')}}" alt="blog_img" class="img-responsive">   
                        @endif 
                        <div class="overlay"></div>
                    </a>
                    @if (isset($listing->metadata["price"]))
                    <div class="item-price"><span>{{$listing->metadata["price"]->value}}</span></div>
                    @endif
                </div>
                <div class="grid-middle">
                    <h3>{{$listing->title}}</h3>
                    @if (isset($listing->metadata["sub-headline"]))
                    <p>{{$listing->metadata["sub-headline"]->value}}</p>
                    @endif
                </div>
                <div class="grid-bottom  text-center">
                    <a href="{!! url('/product/'. $listing->id); !!}" class="#"><span class="fa fa-arrow-right"></span></a>
                </div>
            </div>
        @endforeach
        </div>
        <div class="customNav owl-nav"></div>
    </div>
    <!-- End of .grid -->
</div>