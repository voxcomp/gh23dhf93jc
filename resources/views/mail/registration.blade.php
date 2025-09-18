@extends('layouts.mail')

@section('content')
	<p>Thank you for registering with Brancel Bicycle Charters.</p>
	
	@if($registrant->paytype=='mail')
	<p>Please mail a check for <strong>${{$registrant->paid}}</strong> to:<br><br><strong>Brancel Bicycle Charters<br>P.O. Box 393<br>Waunakee, WI 53597</strong></p>
	@endif
	@if($registrant->paytype=='paypal')
	<p>You will receive a PayPal invoice at <strong>{{$registrant->email}}</strong>.</p>
	@endif
	@if($registrant->paytype=='reserve')
	<p>You will receive an e-mail with a payment link at a later date.</p>
	@endif
	
	<p>Registration details:</p>
	<p>{{$registrant->fname}} {{$registrant->lname}}<br>
		<strong>Invoice:</strong> {{$registrant->invoice}}<br>
	<strong>{{($registrant->paytype=='mail' || $registrant->paytype=='reserve')?'Cost':'Paid'}}:</strong> ${{$registrant->paid}}<br><br>
		<strong>Trip Option:</strong> 
		@if($registrant['option']==1)
			Bus/Bike Transportation PLUS Camping
		@elseif($registrant['option']==2)
			Bus/Bike Transportation
		@elseif($registrant['option']==3)
			Camping for Week
		@elseif($registrant['option']==4)
			Camping per day
		@endif<br>
		<strong>Recumbent:</strong> {{$registrant['recumbent']}}<br>
		<strong>Towel Service:</strong> {{$registrant['towel']}}<br>
		<strong>Shower Card:</strong> {{$registrant['shower']}}<br><br>
		<strong>Jerseys:</strong>
		<?php $jersey = explode(';',$registrant['jersey']); ?>
				@if(!empty($jersey[0]))
				<br>
				@foreach($jersey as $item)
					@if(!empty($item))
						<?php $list = explode(':',$item); ?>
						{{$list[2]}} {{ucfirst(str_replace("_"," ",$list[0]))}} jersey{{(($list[2]>1)?'s':'')}} in size {{$list[1]}}<br>
					@endif
				@endforeach
			@else
				None
			@endif</p>
			<p>For those using our bike / bus transportation our bike loading will be on Friday July 18 from 2:00 PM – 8:30 PM in the ending town.  Our buses arrive on Saturday July 19 starting at 7:15 AM with the last departure being around 8:15 AM.</p>
				 
			<p>Week long parking is handled via the town's website at <a href="http://www.guttenbergragbrai.com">www.guttenbergragbrai.com</a></p> 
			<p>We will send out more charter information as the ride gets closer.</p>
			<p>Thanks for using our services.</p>
	<p>&nbsp;</p>
@stop