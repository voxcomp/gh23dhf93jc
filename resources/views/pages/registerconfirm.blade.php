@extends('layouts.app')

@section('title')
	Registration Confirmation
@stop

@section('content')
	<div class="medium-content-area">
		<p>Thank you for your registration and choosing Brancel Bicycle Charters.</p>
		@if($registration['paytype']=='mail')
		<p>Please mail a check for <strong>${{$registration['paid']}}</strong> to:<br><br><strong>Brancel Bicycle Charters<br>P.O. Box 393<br>Waunakee, WI 53597</strong></p>
		@else
		<p>You will receive an e-mail with a payment link at a later date.</p>
		@endif
		<p>&nbsp;</p>
		<p>Invoice: {{$registration['invoice']}}<br><br>
			Trip Option: 
			@if($registration['option']==1)
				Bus/Bike Transportation PLUS Camping
			@elseif($registration['option']==2)
				Bus/Bike Transportation
			@elseif($registration['option']==3)
				Camping for Week
			@elseif($registration['option']==4)
				Camping per day
			@endif<br>
			Recumbent: {{$registration['recumbent']}}<br>
			Towel Service: {{$registration['towel']}}<br>
			Shower Card: {{$registration['shower']}}<br><br>
			Jerseys:
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
	</div>
@endsection
