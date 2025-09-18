@extends('layouts.app')

@section('title')
	Registration - Wristband
@stop

@section('content')
	<div class="medium-content-area">
		<p>Your wristband number has been added to your registration.</p>
	</div>
@endsection

@section('rightsidebar')
<p><img src="http://register.brancelcharters.com/images/ragbrai.png" class="img-fluid mx-auto d-block"></p>
<h2 class="text-center">{{$options['eventdate']}}</h2>

@endsection
