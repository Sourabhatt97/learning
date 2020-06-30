@extends('layout.front.app')
@section('head')
<style type="text/css">
	table {
		font-family: arial, sans-serif;
		border-collapse: collapse;
		width: 100%;
	}

	td, th {
		border: 1px solid #dddddd;
		text-align: left;
		padding: 8px;
	}

	tr:nth-child(even) {
		background-color: #dddddd;
	}
</style>

@stop
@section('content')
<div class="wrapper"> 	
	<div class="page">
		<div class="main-container col1-layout content-color color">
			<div class="woocommerce">
				<div class="container">
					<div class="content-top">
						<h2>Checkout</h2>
						<p>Need to Help? Call us: +91 6378707734 or Email: <a href="https://bit.ly/2II0hUV">sbhatt692@gmail.com</a></p>
					</div><!--- .content-top-->
					<div class="checkout-step-process">
						<ul>
							<li>
								<div class="step-process-item active"><i data-href="checkout-step2.html"  class="redirectjs  step-icon icon-pointer"></i><span class="text">Address</span></div>
							</li>
							<li>
								<div class="step-process-item"><i data-href="checkout-step5.html"  class="redirectjs  step-icon icon-notebook"></i><span class="text"><a href = "#" >Order Review</a></span></div>
							</li>
						</ul>
					</div><!--- .checkout-step-process --->
					<form name="myform" id = "myform" method="post" class="checkout woocommerce-checkout form-in-checkout" action="{{url('billing/add')}}" enctype="multipart/form-data">
						@csrf
						@isset($bills)
						<TABLE border = "5">
							
							@foreach($bills as $key=>$bill)
							<tr class="old_addresses"> 
								<td>
									<input type="radio" id="newaddress" name="newaddress" value="{{$bill->id}}" checked>
								</td>
								<td>
									<label><b>{{$bill->name}} 
									<br>
								</td>

								<td>
									{{$bill->phone}}
								</td>

								<td>
									{{$bill->city}}
								</td>

								<td>
									{{$bill->state}}
								</td>

								<td>
									{{$bill->country}}
								</td>

								<td>
									{{$bill->address}}
								</td>
							</tr>
							@endforeach
							
						</TABLE>
						@endisset
						<br><label><input type="radio" id="newaddress" name="newaddress" value="addaddress">
						Add New Address</label><br>

						<ul class="row">
							<li class="col-md-9">
								<div class = "showhide" hidden>
									<div class="checkout-info-text">
										<h3>Billing Address</h3>
									</div>

									<div class="woocommerce-billing-fields">
										<ul class="row">
											<li class="col-md-12">
												<p class="form-row " id="billing_first_name_field">
													<label for="billing_first_name" class="">Name <abbr class="required" title="required">*</abbr></label>
													<input type="text" class="input-text " name="name" id="billing_first_name" placeholder="" value="">
												</p>
											</li>
											<li class="col-md-12">
												<p class="form-row " id="billing_email_field">
													<label for="billing_email" class="">Email ID <abbr class="required" title="required">*</abbr></label>
													<input type="text" class="input-text " name="email" id="billing_email" placeholder="" value="">
												</p>
											</li>

											Select Country: 
											<select name="country" id="countySel" size="1">
												<option value="" selected="selected">Select Country</option>
											</select>

											Select State: 
											<select name="state" id="stateSel" size="1">
												<option value="" selected="selected">Please select Country first</option>
											</select>

											Select City:
											<select name="city" id="citySel" size="1">
												<option value="" selected="selected">Please select State first</option>
											</select>

											<li class="col-md-12">
												<p class="form-row address-field validate-postcode woocommerce-validated zip" id="billing_postcode_field">
													<label for="billing_postcode" class="">Zip code <abbr class="required" title="required">*</abbr></label>
													<input type="text" class="input-text " name="zip_code" id="billing_postcode" value="">
												</p>
											</li>

											<br><br>Complete Address:<textarea name="address" value = "{{old('address')}}" placeholder="Address" class="form-control input-md"></textarea><br>

											<li class="col-md-12">
												<p class="form-row validate-required validate-phone woocommerce-validated" id="billing_phone_field">
													<br><label for="billing_phone" class="">Phone number <abbr class="required" title="required">*</abbr></label>
													<input type="text" class="input-text " name="phone" id="billing_phone" placeholder="" value="">
												</p>
											</li>
										</div>
									</ul>
								</div><!--- .woocommerce-billing-fields--->	

								<div class="checkout-col-footer">
									<input type="submit" value="Continue" class="btn-step">
								</div><!--- .checkout-col-footer--->
							</div>	
						</li>
					</ul>
				</form><!--- form.checkout--->
			</div>
		</div>
	</div>
</div>
</div>

@stop

@section('scripts')
<script type="text/javascript">

	setTimeout(function() {
		$('#success').fadeOut('fast');
	}, 5000);
	
	var stateObject = {
		"India": { "Delhi": ["new Delhi", "North Delhi"],
		"Gujarat": ["Ahmedabad", "Rajkot","Gandhinagar"],
		"Rajasthan": ["Banswara", "Udaipur","Jaipur"],
	},
}
window.onload = function () {
	var countySel = document.getElementById("countySel"),
	stateSel = document.getElementById("stateSel"),
	districtSel = document.getElementById("citySel");
	for (var country in stateObject) {
		countySel.options[countySel.options.length] = new Option(country, country);
	}
	countySel.onchange = function () {
stateSel.length = 1; // remove all options bar first
districtSel.length = 1; // remove all options bar first
if (this.selectedIndex < 1) return; // done 
for (var state in stateObject[this.value]) {
	stateSel.options[stateSel.options.length] = new Option(state, state);
}
}
countySel.onchange(); // reset in case page is reloaded
stateSel.onchange = function () {
districtSel.length = 1; // remove all options bar first
if (this.selectedIndex < 1) return; // done 
var district = stateObject[countySel.value][this.value];
for (var i = 0; i < district.length; i++) {
	districtSel.options[districtSel.options.length] = new Option(district[i], district[i]);
}
}
}

$(document).ready(function () {

	var error = $('#myform').validate({
		rules:
		{
			first_name: 
			{
				required: true
			},

			last_name:
			{
				required: true
			},

			email:
			{
				email: true,
				required: true
			},

			phone:
			{
				required: true,
				digits: true,
				minlength: 10,
				maxlength: 10
			},

			zip_code:
			{
				required: true,
				digits: true,
				maxlength: 10
			},

			country:
			{
				required: true
			},

			state:
			{
				required: true
			},

			address:
			{
				required: true
			},

			city:
			{
				required: true
			}
		},
		messages:
		{
			first_name:
			{
				required: 'Please add first name'
			},

			last_name:
			{
				required: 'Please add Last name'
			},

			email:
			{
				required: 'Please add email'
			},

			zip_code:
			{
				required: 'Please add zipcode'
			},

			address:
			{
				required: 'Please add Address'
			},

			country:
			{
				required: 'Please add country'
			},

			state:
			{
				required: 'Please add state'
			},

			city:
			{
				required: 'Please add city'
			},

			phone:
			{
				required: 'Please add phone'
			}
		},
	});
});

$(document).ready(function(){
	$("input[type='radio']").click(function(){

		var radioValue = $("input[name='newaddress']:checked").val();
		
		if(radioValue == "addaddress")
		{
			$("div.showhide").show("slow");
		}

		else
		{
			$("div.showhide").hide("slow");
		}
	});
});

$(document).ready(function(){
	var matched = $('.old_addresses').length;

	if(matched==0)
	{
		$("div.showhide").show("slow");	
	}
});
</script>
@stop