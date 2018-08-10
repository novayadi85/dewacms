@extends('page::layouts.filter')
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
<section id="post-product">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <ul class="nav nav-tabs">
                    @foreach($metaTabs as $metaTab)
                        @if ($loop->first)  
                            <li class="active"><a href="#tab2" data-toggle="tab" aria-expanded="true">{{$metaTab->title}}</a></li>
                        @else 
                            <li class=""><a href="#tab1" data-toggle="tab" aria-expanded="false">>{{$metaTab->title}}</a></li>                           
                        @endif     
                    @endforeach
                    
                </ul>

                <div class="tab-content">
                    @foreach($metaTabs as $metaTab)

                        @if ($loop->first)  
                            <div class="tab-pane active" id="tab2">
                        @else 
                            <div class="tab-pane active" id="tab2">
                        @endif
                         <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent=".tab-pane" href="#collapseTwo">{{$metaTab->title}}</a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        {!! $metaTab->text !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>
            </div>
            <div class="col-md-3">
                <div class="sidebar box-asside mt--min-10">
                    <div class="box-1 text-center">
                    <h3><i class="fa fa-tag"></i> <span>Rp. 500,00</span></h3>
                    </div>

                    <div class="box-2 form-block form-block--style3 block-after-indent">
                        <h3 class="form-block__title heading text-center">Enquiry</h3>
                        <form id="BookingForm" method="POST">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></span>
                                    <input id="name" type="text" class="form-control" name="name" placeholder="Name">
                                </div>
                            </div>   

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope-square" aria-hidden="true"></i></span>
                                    <input id="email" type="text" class="form-control" name="email" placeholder="Email">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone-square" aria-hidden="true"></i></span>
                                    <input id="phone" type="text" class="form-control" name="phone" placeholder="Phone">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-address-book" aria-hidden="true"></i></span>
                                    <input id="address" type="text" class="form-control" name="address" placeholder="Address">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                    <select name="date" class="form-control">
                                        <option value="20 - 5 -2018">
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user-plus" aria-hidden="true"></i></span>
                                    <input id="address" type="number" class="form-control" name="quantity" placeholder="Quantity">
                                </div>
                            </div>

                            <div class="form-group  text-center">
                                <button class="btn btn-primary" type="submit">Book now</button>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop 