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
	<p><strong>Trip Option</strong>: 
	@if($registration['option']==1)
		Bus/Bike Transportation PLUS Camping
	@elseif($registration['option']==2)
		Bus/Bike Transportation
	@elseif($registration['option']==3)
		Camping for Week
	@elseif($registration['option']==4)
		Camping per day
	@endif<br>
	<strong>Towel Service</strong>: {{$registration['towel']}}<br>
	<strong>Recumbent</strong>: {{$registration['recumbent']}}<br>
	<strong>Jerseys</strong>:
	<?php $jersey = explode(';',$registration['jersey']); ?>
		@if(!empty($jersey[0]))
			<br>
			@foreach($jersey as $item)
				@if(!empty($item))
					<?php $list = explode(':',$item); ?>
					{{$list[2]}} {{ucfirst(str_replace("s","'s",$list[0]))}} jersey{{(($list[2]>1)?'s':'')}} in size {{$list[1]}}<br>
				@endif
			@endforeach
		@else
			None
		@endif</p>
    <form id="payment-form" name="payment-form" class="form-horizontal" method="POST" action="{{ route('event.register.submit') }}" autocomplete="off">
        {{ csrf_field() }}
		<h4>Cost: {{number_format($registration['paid'],2)}}</h4>
		<p>&nbsp;</p>
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
            <input type="submit" value="Register" class="btn btn-primary">
			<p>&nbsp;</p>
            <div class="small-note">Please be patient while we process your payment, only hit the submit button once.</div>
	    </div>
    {!! Form::close() !!}
@endsection

@section('rightsidebar')
<p><img src="http://register.brancelcharters.com/images/BBC-side-bar-image.png" class="img-fluid mx-auto d-block"></p>
<h2 class="text-center">{{$options['eventdate']}}</h2>
<p>&nbsp;</p>
<p class="text-center"><a href="/cancel" class="btn btn-danger">Cancel Registration<br>and Restart</a></p>
@endsection

@section('footer')
	<script src="https://js.stripe.com/v3/"></script>
	<script>
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
						amount: {{$registration['paid']*100}},
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
	</script>
@stop