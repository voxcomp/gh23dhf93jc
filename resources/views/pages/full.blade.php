@extends('layouts.app')

@section('title')
	Registration
@stop

@section('content')
	<div class="medium-content-area">
		<h4 class="text-center">{!!nl2br($statusmessage)!!}</h4>
	</div>
@endsection

@section('rightsidebar')
<p><img src="http://register.brancelcharters.com/images/BBC-side-bar-image.png" class="img-fluid mx-auto d-block"></p>
<h2 class="text-center">{{$options['eventdate']}}</h2>

@endsection
