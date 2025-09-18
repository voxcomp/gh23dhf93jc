@extends('layouts.app')

@section('title')
	Registration Complete
@stop

@section('content')
	<div class="medium-content-area">
		<p>Thank you for your registration and choosing Brancel Bicycle Charters on {{(isset($registration->created_at))?date("m-d-Y g:i A",strtotime($registration->created_at)):date("m-d-Y g:i A")}}.</p>
		<p>Your payment for ${{$registration->paid}} has been completed.</</p>
		<p>&nbsp;</p>
		<p>Invoice: {{$registration->invoice}}<br><br>
			{{$registration->fname}} {{$registration->lname}}<br>
			{{$registration->address}}<br>
			{{$registration->city}} {{$registration->state}} {{$registration->zip}}<br><br>
			<strong>Trip Option:</strong> 
			@if($registration->option==1)
				Bus/Bike Transportation PLUS Camping
			@elseif($registration->option==2)
				Bus/Bike Transportation
			@elseif($registration->option==3)
				Camping for Week
			@elseif($registration->option==4)
				Camping per day
			@endif<br>
			<strong>Towel Service:</strong> {{$registration->towel}}<br>
			<strong>Shower Card:</strong> {{$registration->shower}}<br><br>
			<strong>Recumbent:</strong> {{$registration->recumbent}}<br><br>
			<strong>Jerseys:</strong> 
			<?php $jersey = explode(';',$registration->jersey); ?>
				@if(!empty($jersey[0]))
					<br>
					@foreach($jersey as $item)
						@if(!empty($item))
							<?php $list = explode(':',$item); ?>
							{{$list[2]}} {{$list[0]}} jersey{{(($list[2]>1)?'s':'')}} in size {{$list[1]}}<br>
						@endif
					@endforeach
				@else
					None
				@endif</p>
		<p>&nbsp;</p>
		@if(!isset($invoice))
		<p><a href="/" class="btn btn-primary">New Registration</a></p>
		@endif
	</div>
@endsection
