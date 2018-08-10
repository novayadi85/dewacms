<!-- Section top deals starts
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->
@php 
    $injection = new Devdewa\Injection\Product(); 
    $injection->post = $post;
    $listings = $injection->most_popular();
@endphp
<div id="blog">
    <div class="owl-slider fadeIn">
        <div class="owl-carousel owl-theme carousel" data-items="4">
         @foreach($listings as $listing)
            <div class="item grid-item wow fadeIn" style="visibility: hidden; animation-name: none;">
                <a href="{!! url('/product/1'); !!}" class="img_container">
                    @if(isset($listing->children["attachment"]))
                        @if($images = head($listing->children["attachment"]))
                        <img src="{{asset($images->guid)}}" alt="blog_img" class="img-responsive">
                        @endif
                    @else
                        <img src="{{asset('images/1.jpg')}}" alt="blog_img" class="img-responsive">   
                    @endif 
                    <div class="overlay"></div>
                </a>
                <h3>{{$listing->title}}</h3>
                <hr>
                @if (isset($listing->metadata["sub-headline"]))
                    <p>{{$listing->metadata["sub-headline"]->value}}</p>
                @endif
            </div>
        @endforeach
        </div>
        <div class="customNav owl-nav"></div>
    </div>
    <!-- End of .grid -->
</div>
<!-- End of #deals -->