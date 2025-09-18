@extends('layouts.app')

@section('title')
	Registration - Wristband
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
		<p>Please complete the form below to add your wristband number to your registration:</p>
		{{ html()->form('POST', route('event.register.wristband', ))->id('event_register_form')->attribute('autocomplete', 'off')->open() }}
	        <div class="row form-group">
				<div class="col-sm-9 col-md-6 col-spacing {{ $errors->has('invoice') ? ' has-error' : '' }}">
		            <input id="invoice" type="text" class="form-control" name="invoice" value="{{ old('invoice') }}" required autofocus placeholder="Invoice Number">
		            @if ($errors->has('invoice'))
		                <span class="help-block">
		                    <strong>{{ $errors->first('invoice') }}</strong>
		                </span>
		            @endif
				</div>
	        </div>
	        <div class="row form-group">
		        <div class="col-sm-9 col-md-6 {{ $errors->has('wristband') ? ' has-error' : '' }}">
		            <input id="wristband" type="text" class="form-control" name="wristband" value="{{ old('wristband') }}" placeholder="Wristband Number" required>
		            @if ($errors->has('wristband'))
		                <span class="help-block">
		                    <strong>{{ $errors->first('wristband') }}</strong>
		                </span>
		            @endif
		        </div>
			</div>
	        <div class="row form-group">
		        <div class="col-sm-9 col-md-6 {{ $errors->has('wristband') ? ' has-error' : '' }}">
			        <p>Please update your cell phone number so that we can contact you during your travels.</p>
		            <input id="cell" type="text" class="form-control" name="cell" value="{{ old('cell') }}" placeholder="Cell Phone Number">
		            @if ($errors->has('cell'))
		                <span class="help-block">
		                    <strong>{{ $errors->first('cell') }}</strong>
		                </span>
		            @endif
		        </div>
			</div>
			<p>&nbsp;</p>
		    <div class="row form-group">
		        <div class="col-sm rtecenter">
		            <input type="submit" class="btn btn-primary" value="Submit">
		        </div>
		    </div>
		{{ html()->form()->close() }}
	</div>
@endsection

@section('rightsidebar')
<p><img src="http://register.brancelcharters.com/images/ragbrai.png" class="img-fluid mx-auto d-block"></p>
<h2 class="text-center">{{$options['eventdate']}}</h2>

@endsection
