@extends('page::layouts.master')
@section('title', $title)
@section('content')
<!--Video Section-->
<section class="banner clearfix video-section">
	<div class="pattern-overlay">
		<a id="qjP4QdZK7tc" class="player" data-property="{videoURL:'https://youtu.be/qjP4QdZK7tc',containment:'.video-section', quality:'large', autoPlay:true, mute:true, opacity:1,startAt:5}">bg</a>
		<div class="container text-center">
			<h1 class="uppercase text-x-large showFirst">Discover the beautifull of @yield('title')</h1>
		</div>
		<!-- End of .content -->
	</div>
	
</section>
<!--Video Section-->
<section class="banner clearfix video-section">
	<div class="pattern-overlay">
		<a id="qjP4QdZK7tc" class="player" data-property="{videoURL:'https://youtu.be/qjP4QdZK7tc',containment:'.video-section', quality:'large', autoPlay:true, mute:true, opacity:1,startAt:5}">bg</a>
		<div class="container text-center">
			<h1 class="uppercase text-x-large showFirst">Discover the beautifull of @yield('title')</h1>
		</div>
		<!-- End of .content -->
	</div>
	
</section>
@foreach($posts as $post)
	<section id="post-{{$post->id}}">
		<div class="container">
			<h2 class="section_title text-center">
				<?php print $post->title;?>
			
				<?php 
				if(isset($post->metadata["sub-headline"])):
					print  "<span>".$post->metadata["sub-headline"]->value."</span>";
				endif;?>
			</h2>
			<div class="row text-center">
				<div class="service col-sm-12 col-md-12 wow fadeInUp" data-wow-offset="100" style="visibility: hidden; animation-name: none;">
					{!! $post->html !!}
				</div>
			</div>
		</div>
	</section>
@endforeach 
@stop
