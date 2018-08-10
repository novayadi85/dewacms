@extends('page::layouts.page')
@section('content')
<section class="bookings bookings-inner">
	<div class="section-header hidden">
		<div class="container">
			<h2 class="title"><span>Booking</span> &amp; reservations</h2>
		</div>
	</div>

	<div class="bookings-wrapper">
		<div class="container">
            <div class="main-content col-md-9">
                <div class="box white">
                    <form action="http://book.sidemenparadise.com/bookings/save_checkout" method="post" class="payment-form payment-form-new">
                        <input type="hidden" name="pageid" value="20">
                        <div class="form-groups row">
                            <div class="col-md-12">
                                <h1>Address Infomartion</h1>
                                <hr class="line">
                            </div>
                            <div class="col-md-6">
                                <label for="firstname">First Name</label>
                                <input id="firstname" name="firstname" type="text" required="" value="" maxlength="50" tabindex="10" class="form-control">
                                <span class="errormsg"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="lastname">Last Name</label>
                                <input id="lastname" name="lastname" type="text" required="" value="" maxlength="50" tabindex="10" class="form-control">
                                <span class="errormsg"></span>
                            </div>
                        </div>
                        <div class="form-groups row">
                            <div class="col-md-6">
                                <label for="email">E-mail</label>
                                <input id="email" name="email" type="email" required="" value="" maxlength="50" tabindex="10" class="form-control">
                                <span class="errormsg"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="land">Telefonnummer</label>
                                <input class="form-control" id="telp" required="" name="telp" type="text" value="" maxlength="50" tabindex="38">
                            </div>
                        </div>
                        <div class="form-groups row">
                            
                            <div class="col-md-6">
                                <label for="addresse">Address</label>
                                <input class="form-control" id="addresse" name="address" type="text" value="" maxlength="50" tabindex="38">
                            </div>
                            
                            <div class="col-md-6">
                                <label for="addresse">Address 2</label>
                                <input class="form-control" id="addresse2" name="address2" type="text" value="" maxlength="50" tabindex="38">
                            </div>
                        </div>
                        
                        <div class="form-groups row">
                            
                            <div class="col-md-6  col-xs-12">
                                <label for="by">City</label>
                                <input class="form-control" id="by" required="" name="city" type="text" value="" maxlength="50" tabindex="38">
                            </div>
                            <div class="col-md-6  col-xs-12">
                                <label for="by">State</label>
                                <input class="form-control" id="by" required="" name="state" type="text" value="" maxlength="50" tabindex="38">
                            </div>
                        </div>
                        <div class="form-groups row">
                            <div class="col-md-6  col-xs-12">
                                <label for="land">Country</label>
                                <input class="form-control" id="land" name="country" type="text" value="" maxlength="50" tabindex="38">
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <label for="postnummer">Postnummer</label>
                                <input class="form-control" id="postnummer" name="postcode" type="text" value="" maxlength="50" tabindex="38">
                            </div>
                        </div>
                        <div class="form-groups row">
                            <div class="col-md-12  col-xs-12">
                                <label for="note">Note</label>
                                <textarea class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                        
                        
                        
                        <div class="form-groups row">
                            <div class="col-md-12  col-xs-12">
                                <input type="checkbox" checked="checked">
                                <label for="agreement">Agreement <a class="show-modal" data-toggle="modal" data-target="#agreement_modal"> term &amp; conditions</a>...</label>
                                
                            </div>
                        </div>
                        
                        <div class="form-groups row">
                            <div class="col-md-8  col-xs-8">
                                <div class="table-display" style="height: 50px;">
                                    <div class="table-cell text-right"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</div>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-4">
                                <button class="form-control btn btn-black btn-continue formsubmit" tabindex="130">Book Now</button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
            
            <div class="col-md-3 col-xs-3">
                <div class="box white">
                    <h2>Pilihlah</h2>
                    <hr class="line">
                    
                    <div class="form-groups row">
                        <div class="col-md-12  col-xs-12">
                            <label for="note">Start</label>
                            <input type="text" required="" value="" class="datepicker hasDatepicker form-control">
                        </div>
                    </div>  
                    <div class="form-groups row">
                        <div class="col-md-12  col-xs-12">
                            <label for="note">End</label>
                            <input type="text" required="" value="" class="datepicker hasDatepicker form-control">
                        </div>
                    </div> 
                </div>
            </div>

        </div>
    </div>
</section>
@stop
