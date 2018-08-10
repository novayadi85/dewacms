@if ($listings->count() == 0) 
    <li><p>No listing found</p></li>
    @else   
    @foreach($listings as $listing)
        <li class="wow fadeInUp" data-wow-offset="100">
            <a href="{!! url('/product/'. $listing->id); !!}">
                <div class="pd-card slide-up">
                    <div class="pd-img">
                        @php $image = "" @endphp
                        @foreach($attachments as $attachment)
                            @if($attachment->parent_id == $listing->id)
                                @php $image = $attachment->guid @endphp
                                <img src="{{asset($attachment->guid)}}" alt="{{$listing->title}}" class="img-responsive">
                            @break
                            @endif
                        @endforeach
                        @if(!$image)
                        <img src="{{asset('images/1.jpg')}}" alt="{{$listing->title}}" class="img-responsive">
                        @endif 
                    </div>
                    <div class="pd-desc-2">
                        <div class="pd-2">{{$listing->title}}</div>
                        <div class="pd-3">Start from</div>
                        <div class="pd-4"><span>{{$listing->price}}</span></div>
                        
                    </div>
                    <div class="pd-caption">
                        <div class="pd-desc-3">
                            <div class="pd-6">{{$listing->title}}</div>
                            <div class="pd-3">Start from</div>
                            <div class="pd-4"><span>{{$listing->price}}</span></div>
                        </div>
                        <!--<div class="pd-desc-5">
                            @if (isset($listing->metadata["sub-headline"]))
                                <p>{{$listing->metadata["sub-headline"]->value}}</p>
                            @endif
                        </div>-->
                </div>
            </a>
            <div class="pd-5">
                <a href="{!! url('/product/'. $listing->id); !!}"></a>
                <a href="{!! url('/product/'. $listing->id); !!}">More Details</a>
            </div>
        </li>
    @endforeach	
@endif