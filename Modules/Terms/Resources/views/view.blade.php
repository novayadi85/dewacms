@extends('page::layouts.filter')
@section('title', $title)
@section('content')

<section class="banner clearfix video-section">
    <div class="pattern-overlay">
        <a id="qjP4QdZK7tc" class="player" data-property="{videoURL:'https://youtu.be/qjP4QdZK7tc',containment:'.video-section', quality:'large', autoPlay:true, mute:true, opacity:1,startAt:5}">bg</a>
        <div class="container text-center">
            <h1 class="uppercase text-x-large showFirst">Discover the beautifull of @yield('title')</h1>
        </div>
        <!-- End of .content -->
    </div>
    
</section>

<section class="stretcher-wrapper">
    <!-- === stretcher === -->
    <h2 class="section_title text-center">
        MOST POPULAR RETREAT
        <span>We serve our customers with love.</span>
    </h2>
    <ul class="stretcher wow fadeInUp" data-wow-offset="100">
        <!-- === stretcher item === -->

        <li class="stretcher-item" style="background-image:url(http://www.elathemes.com/themes/colina/assets/images/services-1.jpg);">
            <!--logo-item-->
            <div class="stretcher-logo">
                <div class="text">
                    <span class="text-intro h4">Spa center</span>
                </div>
            </div>
            <!--main text-->
            <figure>
                <h4>Spa center</h4>
                <figcaption>Unparalleled devotion to luxury</figcaption>
            </figure>
            <!--anchor-->
            <a href="facility.html">Anchor link</a>
        </li>

        <!-- === stretcher item === -->

        <li class="stretcher-item" style="background-image:url(http://www.elathemes.com/themes/colina/assets/images/services-2.jpg);">
            <!--logo-item-->
            <div class="stretcher-logo">
                <div class="text">
                    <span class="text-intro h4">Gym</span>
                </div>
            </div>
            <!--main text-->
            <figure>
                <h4>Gym</h4>
                <figcaption>Care about results</figcaption>
            </figure>
            <!--anchor-->
            <a href="facility.html">Anchor link</a>
        </li>

        <!-- === stretcher item === -->

        <li class="stretcher-item" style="background-image:url(http://www.elathemes.com/themes/colina/assets/images/services-3.jpg);">
            <!--logo-item-->
            <div class="stretcher-logo">
                <div class="text">
                    <span class="text-intro h4">Fitness</span>
                </div>
            </div>
            <figure>
                <h4>Fitness</h4>
                <figcaption>Your daily activities</figcaption>
            </figure>
            <!--anchor-->
            <a href="facility.html">Anchor link</a>
        </li>

        <!-- === stretcher item more === -->

        <li class="stretcher-item more">
            <div class="more-icon">
                <span data-title-show="Show more" data-title-hide="+"></span>
            </div>
            <a href="facility.html">Anchor link</a>
        </li>

    </ul>
</section>

<!--section filtering -->

  </div>
  <!-- end filtering -->
@stop