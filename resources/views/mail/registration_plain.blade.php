@section('content')
	Thank you for registering with Brancel Bicycle Charters.
	
	@if($registrant->paytype=='mail')
	Please mail a check for ${{$registrant->paid}} to:
	
	Brancel Bicycle Charters
	P.O. Box 393
	Waunakee, WI 53597
	@endif
	@if($registrant->paytype=='paypal')
	You will receive a PayPal invoice at {{$registrant->email}}.
	@endif
	@if($registrant->paytype=='reserve')
	You will receive an e-mail with a payment link at a later date.
	@endif

	Registration details:
	Invoice: {{$registrant->invoice}}
	{{($registrant->paytype=='mail' || $registrant->paytype=='reserve')?'Cost':'Paid'}}: ${{$registrant->paid}}
	
		Trip Option: 
		@if($registrant['option']==1)
			Bus/Bike Transportation PLUS Camping
		@elseif($registrant['option']==2)
			Bus/Bike Transportation
		@elseif($registrant['option']==3)
			Camping for Week
		@elseif($registrant['option']==4)
			Camping per day
		@endif
		Recumbent: {{$registrant['recumbent']}}
		Towel Service: {{$registrant['towel']}}
		Shower Card: {{$registrant['shower']}}
		
		Jerseys:
		<?php $jersey = explode(';',$registrant['jersey']); ?>
				@if(!empty($jersey[0]))
				@foreach($jersey as $item)
					@if(!empty($item))
						<?php $list = explode(':',$item); ?>
						{{$list[2]}} {{ucfirst(str_replace("_"," ",$list[0]))}} jersey{{(($list[2]>1)?'s':'')}} in size {{$list[1]}}
					@endif
				@endforeach
			@else
				None
			@endif
			For those using our bike / bus transportation our bike loading will be on Friday July 18 from 2:00 PM – 8:30 PM in the ending town.  Our buses arrive on Saturday July 19 starting at 7:15 AM with the last departure being around 8:15 AM.
				 
			Week long parking is handled via the town's website at www.guttenbergragbrai.com.
			We will send out more charter information as the ride gets closer.
			Thanks for using our services.

@stop
