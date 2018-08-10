<section id="services" data-scroll-id="services" tabindex="-1" style="outline: none;">
    <div class="container">
        @foreach($listings as $post)
        <div class="service col-sm-6 col-md-4 text-left wow fadeInUp" data-wow-offset="100">
             <span class="flaticon-icon"><img height="100%" width="50" src="{{asset($post->file)}}" alt="{{$post->title}}" class="img-responsive border-radius"></span>
            
            <h3>{{$post->title}}</h3>
            {!! $post->short_description !!}
        </div>
        @endforeach
    </div>
</div>