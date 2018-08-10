@extends('page::layouts.filter')
@section('title', $title)
@section('content')

<section class="frontpage-slider">
	<div class="owl-slider owl-slider-header owl-slider-fullscreen owl-carousel owl-theme">
        <div class="item" style="background-image: url({{asset('images/slide-1.jpg')}});">
            <div class="box text-center">
                <div class="container">
                    <h2 class="title animated h1" data-animation="fadeInDown" style="animation-delay: 100ms;">
                        The privacy and <br>
                        individuality of a custom
                    </h2>
                    <div class="desc animated" data-animation="fadeInUp" style="animation-delay: 280ms;">
                        The Residences have their own dedicated private entrance as well <br>
                        as an anonymous "celebrity" entrance, for ultimate privacy.
                    </div>
                    <div class="animated" data-animation="fadeInUp" style="animation-delay: 460ms;">
                        <a href="#" class="btn btn-clean">Virtual tour</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="item" style="background-image: url({{asset('images/1.jpg')}});">
            <div class="box text-center">
                <div class="container">
                    <h2 class="title animated h1" data-animation="fadeInDown" style="animation-delay: 100ms;">
                        The privacy and <br>
                        individuality of a custom
                    </h2>
                    <div class="desc animated" data-animation="fadeInUp" style="animation-delay: 280ms;">
                        The Residences have their own dedicated private entrance as well <br>
                        as an anonymous "celebrity" entrance, for ultimate privacy.
                    </div>
                    <div class="animated" data-animation="fadeInUp" style="animation-delay: 460ms;">
                        <a href="#" class="btn btn-clean">Virtual tour</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="booking booking-inner">
	<div class="section-header hidden">
		<div class="container">
			<h2 class="title"><span>Booking</span> &amp; reservations</h2>
		</div>
	</div>

	<div class="booking-wrapper">

		<div class="container">
			<div class="row">

				<!--=== date arrival ===-->

				<div class="col-xs-4 col-sm-3">
					<div class="date" id="dateArrival" data-text="Arrival">
						<input class="datepicker" readonly="readonly" id="dp1531512403001">
						<div class="date-value"><span class="day">19</span> <span class="month">Jul</span> <span class="year">2018</span></div>
					</div>
				</div>

				<!--=== date departure ===-->

				<div class="col-xs-4 col-sm-3">
					<div class="date" id="dateDeparture" data-text="Departure">
						<input class="datepicker" readonly="readonly" id="dp1531512403002">
						<div class="date-value"><span class="day">20</span> <span class="month">Jul</span> <span class="year">2018</span></div>
					</div>
				</div>

				<!--=== guests ===-->

				<div class="col-xs-4 col-sm-2">

					<div class="guests" data-text="Guests">
						<div class="result">
							<input class="qty-result" type="text" value="2" id="qty-result" readonly="readonly">
							<div class="qty-result-text date-value" id="qty-result-text">9</div>
						</div>
						<!--=== guests list ===-->
						<ul class="guest-list" style="display: none;">

							<li class="header">
								Please choose number of guests <span class="qty-apply"><i class="fa fa-close"></i></span>
							</li>

							<!--=== adults ===-->

							<li class="clearfix">

								<!--=== Adults value ===-->

								<div>
									<input class="qty-amount" value="2" type="text" id="ticket-adult" data-value="2" readonly="readonly">
								</div>

								<div>
									<span>Adults <small>16+ years</small></span>
								</div>

								<!--=== Add/remove quantity buttons ===-->

								<div>
									<input class="qty-btn qty-minus" value="-" type="button" data-field="ticket-adult">
									<input class="qty-btn qty-plus" value="+" type="button" data-field="ticket-adult">
								</div>

							</li>

							<!--=== chilrens ===-->

							<li class="clearfix">

								<!--=== Adults value ===-->

								<div>
									<input class="qty-amount" value="0" type="text" id="ticket-children" data-value="0" readonly="readonly">
								</div>

								<!--=== Label ===-->

								<div>
									<span>Children <small>2-11 years</small></span>
								</div>


								<!--=== Add/remove quantity buttons ===-->

								<div>
									<input class="qty-btn qty-minus" value="-" type="button" data-field="ticket-children">
									<input class="qty-btn qty-plus" value="+" type="button" data-field="ticket-children">
								</div>

							</li>

							<!--=== Infants ===-->

							<li class="clearfix">

								<!--=== Adults value ===-->

								<div>
									<input class="qty-amount" value="0" type="text" id="ticket-infants" data-value="0" readonly="readonly">
								</div>

								<!--=== Label ===-->

								<div>
									<span>Infants <small>Under 2 years</small></span>
								</div>

								<!--=== Add/remove quantity buttons ===-->

								<div>
									<input class="qty-btn qty-minus" value="-" type="button" data-field="ticket-infants">
									<input class="qty-btn qty-plus" value="+" type="button" data-field="ticket-infants">
								</div>
							</li>

						</ul>
					</div>
				</div>

				<!--=== button ===-->

				<div class="col-xs-12 col-sm-4">
					<a href="reservation-1.html" class="btn btn-clean">
						Book now
						<small>Best Prices Guaranteed</small>
					</a>
				</div>

			</div> <!--/row-->
		</div><!--/booking-wrapper-->
	</div> <!--/container-->
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

        <!-- === stretcher item === -->

        <li class="stretcher-item" style="background-image:url(http://www.elathemes.com/themes/colina/assets/images/services-4.jpg);">


            <!--logo-item-->
            <div class="stretcher-logo">
                <div class="text">
                    <span class="text-intro h4">Beauty salon</span>
                </div>
            </div>
            <!--main text-->
            <figure>
                <h4>Beauty salon</h4>
                <figcaption>Hair salons and spas</figcaption>
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
<div class="tours">
    <div class="container">
      <div class="filter">
        <div class="filter-title">
          Filter Tours
        </div>

        <div class="filter-search-result">
          72 results found
        </div>

        <div data-toggle="collapse" data-target="#sorting" class="filter-1 acc-title openlanguage" headerindex="0h">
          SORT RESULTS
        </div>

        <div id="sorting" class="acc-body collapse in" contentindex="0c">
          <ul class="filter-sort">
            <li data-sort="lowhighFl">Lowest Price</li>

            <li data-sort="highlowFl">Highest Price</li>

            <li class="active" data-sort="highlowView">Popularity</li>
          </ul>
        </div>

        <div data-toggle="collapse" data-target="#price-rules" class="filter-2 acc-title openlanguage" headerindex="1h">
          PRICE RANGE
        </div><a class="filter-reset" id="set-sliders-1"></a>

        <div class="clear"></div>

        <div id="price-rules" class="acc-body collapse in" contentindex="1c">
          <div class="filter-range-price">
            <div id="slider-range"></div>
        
            <div class="clear"></div>

            <div class="space-1"></div>

            <div class="filter-range-1">
                
              <div id="slider-range-value-lower-1">
                <span>Rp 0</span>
                <input type="hidden" class="range-price-value" id="range-min" value="0" readonly>
              </div>
            </div>

            <div class="filter-range-2">
              <div id="slider-range-value-upper-1">
                <span>Rp 100,000,000</span>
                <input type="hidden" class="range-price-value" id="range-max" value="1000" readonly>
              </div>
            </div>

            <div class="clear"></div>
          </div>
        </div>

        <div class="filter-line"></div>

        <div data-toggle="collapse" data-target="#filter-tags" class="filter-2 acc-title openlanguage" headerindex="2h">
          TOUR TYPE
        </div><input type="button" id="uncheckToursType" class="filter-reset" />

        <div class="clear"></div>

        <div id="filter-tags" class="acc-body collapse in" contentindex="2c">
          <ul class="filter-type" id="filter-type-checkbox">
            <li><input id="filter-type-0" type="checkbox" data-filter="1" checked=
            "checked" /> <label for="filter-type-0">Private Journeys</label></li>

            <li><input id="filter-type-1" type="checkbox" data-filter="2" checked=
            "checked" /> <label for="filter-type-1">Family Holidays</label></li>

            <li><input id="filter-type-2" type="checkbox" data-filter="3" checked=
            "checked" /> <label for="filter-type-2">Luxury</label></li>

            <li><input id="filter-type-3" type="checkbox" data-filter="4" checked=
            "checked" /> <label for="filter-type-3">Adventure</label></li>

            <li><input id="filter-type-4" type="checkbox" data-filter="5" checked=
            "checked" /> <label for="filter-type-4">Just the Two of Us</label></li>

            <li><input id="filter-type-5" type="checkbox" data-filter="6" checked=
            "checked" /> <label for="filter-type-5">Cost Saver</label></li>
          </ul>
        </div>

        <div class="filter-line"></div>

        <div class="filter-2 acc-title openlanguage" headerindex="3h">
          DURATION
        </div><a class="filter-reset" id="set-sliders-2"></a>

        <div class="clear"></div>

        <div class="acc-body" contentindex="3c" style="display: block;">
          <div class="filter-range-duration">
            <div id="slider-range-2" class="noUi-target noUi-ltr noUi-horizontal">
              <div class="noUi-base">
                <div class="noUi-origin" style="left: 0%;">
                  <div class="noUi-handle noUi-handle-lower" data-handle="0" tabindex="0"
                  role="slider" aria-orientation="horizontal" aria-valuemin="0.0"
                  aria-valuemax="100.0" aria-valuenow="0.0" aria-valuetext="1" style=
                  "z-index: 5;"></div>
                </div>

                <div class="noUi-connect" style="left: 0%; right: 0%;"></div>

                <div class="noUi-origin" style="left: 100%;">
                  <div class="noUi-handle noUi-handle-upper" data-handle="1" tabindex="0"
                  role="slider" aria-orientation="horizontal" aria-valuemin="0.0"
                  aria-valuemax="100.0" aria-valuenow="100.0" aria-valuetext="20" style=
                  "z-index: 4;"></div>
                </div>
              </div>
            </div>

            <div class="clear"></div>

            <div class="space-1"></div>

            <div class="filter-range-1">
              <div id="slider-range-value-lower-2">
                1
              </div>
            </div>

            <div class="filter-range-2">
              <div id="slider-range-value-upper-2">
                20
              </div>
            </div>

            <div class="clear"></div>
          </div>
        </div>

        <div class="filter-line"></div>
      </div>

      <ul class="tours-list">
        <li class="trentry" data-pc="2600000" data-vw="136" data-td="3" data-tt="6">
          <a href="https://smailingtour.co.id/tours/details/225?adt=1&amp;chd=0"></a>

          <div class="pd-card slide-up">
            <div class="pd-img"><img src=
            "https://smailingtour.co.id/images/uploads/Dubai_Thumbnail1.jpg" alt=
            "popular destinations" /></div>

            <div class="pd-desc-2">
              <div class="pd-1">
                Cost Saver
              </div>

              <div class="pd-2">
                3D Dubai + Dessert Safari
              </div>

              <div class="pd-3">
                Start from
              </div>

              <div class="pd-4">
                Rp <span>2,600,000</span>
              </div>
            </div>

            <div class="pd-caption">
              <div class="pd-desc-3">
                <div class="pd-1">
                  Cost Saver
                </div>

                <div class="pd-6">
                  3D Dubai + Dessert Safari
                </div>

                <div class="pd-3">
                  Start from
                </div>

                <div class="pd-4">
                  Rp <span>2,600,000</span>
                </div>
              </div>

              <div class="pd-desc-5">
                Bukan rahasia jika Dubai menjadi salah satu destinasi wisata paling
                populer karena keunikan bangunan sekaligus pemandangannya yang
                menakjubkan. Sebut saja Dessert Safari, gurun safari yang luas membentang
                ini bisa Anda jelajahi dengan menggunakan mobil 4WD. Bersiaplah untuk
                menikmati pengalaman tak terlupakan selama menjelajahi Dubai bersama
                kami!
              </div><!--<div class="pd-desc-4">
                                                    </div>-->
            </div>
          </div>

          <div class="pd-5">
            <a href=
            "https://smailingtour.co.id/tours/details/225?adt=1&amp;chd=0"></a><a href=
            "https://smailingtour.co.id/tours/detail/225">More Details</a>
          </div>
        </li>

        <li class="trentry" data-pc="9750000" data-vw="154" data-td="6" data-tt="2">
          <a href="https://smailingtour.co.id/tours/details/226?adt=1&amp;chd=0"></a>

          <div class="pd-card slide-up">
            <div class="pd-img"><img src=
            "https://smailingtour.co.id/images/uploads/dubai_adventure_thumbnail.jpg"
            alt="popular destinations" /></div>

            <div class="pd-desc-2">
              <div class="pd-1">
                Family Holidays
              </div>

              <div class="pd-2">
                6D Dubai Experience by Royal Jordanian
              </div>

              <div class="pd-3">
                Start from
              </div>

              <div class="pd-4">
                Rp <span>9,750,000</span>
              </div>
            </div>

            <div class="pd-caption">
              <div class="pd-desc-3">
                <div class="pd-1">
                  Family Holidays
                </div>

                <div class="pd-6">
                  6D Dubai Experience by Royal Jordanian
                </div>

                <div class="pd-3">
                  Start from
                </div>

                <div class="pd-4">
                  Rp <span>9,750,000</span>
                </div>
              </div>

              <div class="pd-desc-5">
                Bukan rahasia jika Dubai menjadi salah satu destinasi wisata paling
                populer karena keunikan bangunan sekaligus pemandangannya yang
                menakjubkan. Dengan mengikuti paket liburan berikut ini, Anda akan diajak
                mengunjungi Marina Walk, Palm Jumeirah, Burj Al Arab Beach, Burj Khalifa
                hingga menuju Dubai Festival City. Bersiaplah untuk terpukau dengan
                keunikan destinasi wisata terpopuler di United Emirates Arab ini!
              </div><!--<div class="pd-desc-4">
                                                    </div>-->
            </div>
          </div>

          <div class="pd-5">
            <a href=
            "https://smailingtour.co.id/tours/details/226?adt=1&amp;chd=0"></a><a href=
            "https://smailingtour.co.id/tours/detail/226">1 Departure Dates</a>
          </div>
        </li>

       
      </ul>

      <div class="clear"></div>
    </div>
  </div>
  <!-- end filtering -->
@stop