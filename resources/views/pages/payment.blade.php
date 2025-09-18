@extends('layouts.app')

@section('title')
	Registration Payment
@stop

@section('content')
	@if (session()->has('message'))
	    <div class="alert alert-warning">
	        {{ session()->get('message') }}
	    </div>
	@endif
	@if ($errors->any())
	    <div class="alert alert-danger">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
	@endif
	<div class="medium-content-area">
		{!! Form::open(array('route' => ['payment.pay'], 'id'=>'payment-form', 'autocomplete'=>'off')) !!}
			{{Form::hidden('invoice',$invoiceEncrypted)}}
			<h4>Invoice: {{$registrant->invoice}} ({{date('m/d/Y',strtotime($registrant->created_at))}})</h4>
			<p>{{$registrant->fname}} {{$registrant->lname}}<br>
				{{$registrant->address}}<br>
				{{$registrant->city}} {{$registrant->state}} {{$registrant->zip}}</p>
			
			<p>&nbsp;</p>
			<h4 class="text-center green-text font-20">Registration Cost: $<span class="cost">{{$registrant->paid}}</span></h4>
			<div>&nbsp;</div>
	        {{Form::hidden('paymenttype','online')}}
	    	<div class="form-group">
				<label for="cardname">Name on Card</label><br>
				<input id="cardname" type="text" class="form-control" name="cardname" value="{{old('cardname')}}">
	        </div>
	        <div class="form-group">
			        <!-- Stripe Element -->
			        <div id="card-element" class="form-control">
				      <!-- a Stripe Element will be inserted here. -->
				    </div>
				    <div id="payment-request-button">
				    </div>
	        </div>
	        <div id="card-errors"></div>
		    <div class="form-group">
	            <p><button class="btn btn-primary paymenttypebtn">Submit Payment</button></p>
		    </div>
		{!! Form::close() !!}
	</div>
@endsection

@section('rightsidebar')
<p><img src="http://register.brancelcharters.com/images/BBC-side-bar-image.png" class="img-fluid mx-auto d-block"></p>
<h2 class="text-center">{{$options['eventdate']}}</h2>
@endsection

@section('footer')
	<script src="https://js.stripe.com/v3/"></script>
	<script>
		(function($) {
			$(window).on("load",function() {
				var stripe = Stripe('{{ (env('STRIPE_MODE')=='live')?env('STRIPE_PK'):env('STRIPE_TEST_PK') }}');
				var elements = stripe.elements({
					fonts: [{
							cssSrc: 'https://fonts.googleapis.com/css?family=Montserrat',
						}]
					});
				var style = {
					base: {
						fontSize: '14px',
						iconColor: '#6AABDD',
						color: "#575757",
						fontWeight: 500,
						fontFamily: "Montserrat, Open Sans, sans-serif",
						fontSmoothing: 'antialiased',
						'::placeholder': {
				          color: '#121212',
				        },
				    },
					invalid: {
						iconColor: '#9E2A23',
						color: '#9E2A23',
					},
		   		}
				var card = elements.create('card', {style: style});
				card.mount('#card-element');
		
				var paymentRequest = stripe.paymentRequest({
					country: 'US',
					currency: 'usd',
					total: {
						label: 'Brancel Bicycle Charters',
						amount: {{$registrant['paid']*100}},
					},
				});
				card.addEventListener('change', function(event) {
				  var displayError = document.getElementById('card-errors');
				  if (event.error) {
				    displayError.textContent = event.error.message;
				  } else {
				    displayError.textContent = '';
				  }
				});
		
				// Create a token or display an error when the form is submitted.
				var form = document.getElementById('payment-form');
				form.addEventListener('submit', function(event) {
				  event.preventDefault();
				  var options = {
					  name: document.getElementById('cardname').value,
				  };
				  stripe.createToken(card,options).then(function(result) {
				    if (result.error) {
				      // Inform the customer that there was an error
				      var errorElement = document.getElementById('card-errors');
				      errorElement.textContent = result.error.message;
				      $('form .error').fadeIn(300);
				    } else {
				      // Send the token to your server
				      stripeTokenHandler(result.token);
				    }
				  });
				});
				function stripeTokenHandler(token) {
				  // Insert the token ID into the form so it gets submitted to the server
				  var form = document.getElementById('payment-form');
				  var hiddenInput = document.createElement('input');
				  hiddenInput.setAttribute('type', 'hidden');
				  hiddenInput.setAttribute('name', 'stripeToken');
				  hiddenInput.setAttribute('value', token.id);
				  form.appendChild(hiddenInput);
				
				  form.submit();
				}
			});
		})(jQuery);
	</script>
@stop