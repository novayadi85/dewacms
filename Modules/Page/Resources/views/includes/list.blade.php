@php 
$injection = new Devdewa\Injection\Product(); 
$injection->post = $post;
$listings = $injection->most_popular();
@endphp
<section id="popular">
    <div class="popular-destinations">
        <ul class="pd-list">
            @foreach($listings as $listing)
                <li class="wow fadeInUp" data-wow-offset="100">
                    <a href="{!! url('/product/'. $listing->id); !!}">
                        <div class="pd-card slide-up">
                            <div class="pd-img">
                                @if(isset($listing->children["attachment"]))
                                    @if($images = head($listing->children["attachment"]))
                                        <img src="{{asset($images->guid)}}" alt="{{$listing->title}}" class="img-responsive">
                                    @endif
                                @else
                                    <img src="{{asset('images/1.jpg')}}" alt="{{$listing->title}}" class="img-responsive">   
                                @endif 
                            </div>
                            <div class="pd-desc-2">
                                <div class="pd-1">Cost Saver</div>
                                <div class="pd-2">{{$listing->title}}</div>
                                <div class="pd-3">Start from</div>
                                @if (isset($listing->metadata["price"]))
                                     <div class="pd-4"><span>{{$listing->metadata["price"]->value}}</span></div>
                                @endif
                               
                            </div>
                            <div class="pd-caption">
                                <div class="pd-desc-3">
                                    <div class="pd-1">Cost Saver</div>
                                    <div class="pd-6">{{$listing->title}}</div>
                                    <div class="pd-3">Start from</div>
                                    @if (isset($listing->metadata["price"]))
                                        <div class="pd-4"><span>{{$listing->metadata["price"]->value}}</span></div>
                                    @endif
                                </div>
                                <div class="pd-desc-5">
                                    @if (isset($listing->metadata["sub-headline"]))
                                        <p>{{$listing->metadata["sub-headline"]->value}}</p>
                                    @endif
                                </div>
                        </div>
                    </a>
                    <div class="pd-5">
                        <a href="{!! url('/product/'. $listing->id); !!}"></a>
                        <a href="{!! url('/product/'. $listing->id); !!}">More Details</a>
                    </div>
                </li>
            @endforeach	
        </ul>        
    </div>
</section>