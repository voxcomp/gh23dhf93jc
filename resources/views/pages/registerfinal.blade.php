@extends('layouts.app')

@section('title')
	Registration Final Step
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
		{!! Form::open(array('route' => ['event.register.pay'], 'id'=>'event_register_form', 'autocomplete'=>'off')) !!}
		    <h3>Prior Passenger Loyalty Discount</h3>
		    <label for="discount">Please select the number of years you have traveled with us: </label>
		    {{Form::select("discount",[0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20],0)}}
			<p>&nbsp;</p>
		    <h3>Cancellation</h3>
		    <p>We allow transfers if you find someone to take your place.  July 13 and after no transfers.
				We will provide refund, less a $30 cancellation fee, through June 15.
				June 16 to June 30, we will provide a refund less 25% cancellation fee.
				July 1 to July 12 we will provide a refund less a 50% cancellation fee.
				July 13 and after we have a no refund policy.<br><br>In consideration of Brancel Bicycle Charters’ acceptance of my registration to participate in RAGBRAI LIII, I hereby for myself, my heirs and assigns: release, indemnify, and agree to hold harmless Brancel Bicycle Charters’, its directors, officers, employees, agents, and participants who may be performing functions for the ride, from any and all actions, claims, demands, administrative proceedings, judgments or decrees, including attorney’s fees of any kind, including negligence on behalf of Brancel Bicycle Charters’, its directors agents, employees, officers, assigns or participants that may arise out of my participation RAGBRAI L.</p>
			<p>&nbsp;</p>
		    <h3>Waiver</h3>
		    @if(time()<strtotime('+18 years',strtotime($dob)))
			    <p>As the parent or guardian, the undersigned parent/guardian signs this Liability Release on behalf of himself/herself and (“Child”) and warrants and represents that he/she has the legal authority to sign on behalf of the Child.  The undersigned parent/guardian has read this Liability Release and voluntarily agrees to the terms and conditions stated below.  The undersigned parent/guardian acknowledges that he/she has had the opportunity to ask questions of Brancel Charters, LLC (“Brancel”) regarding this Liability Release.  The undersigned parent/guardian further acknowledges that no oral representations, statements, or inducements apart from the written agreement contained herein have been made.</p>
	
				<p><strong>IN CONSIDERATION OF PARTICIPATING IN BRANCEL’S ACTIVITIES, INCLUDING BUT NOT LIMITED TO, TRANSPORTATION OF MY CHILD AND HIS OR HER BELONGINGS BY BRANCEL OR BRANCEL’S AGENT TO ANY LOCATION (COLLECTIVELY REFERRED TO AS THE “ACTIVITIES”), THE UNDERSIGNED PARENT/GUARDIAN HEREBY ASSUMES ALL RISKS AND HAZARDS INCIDENT TO THE CHILD’S PARTICIPATION IN ALL BRANCEL ACTIVITIES REGARDLESS OF PURPOSE OR LOCATION.  IN PARTICULAR, THE UNDERSIGNED PARENT/GUARDIAN ACKNOWLEDGES THAT PRIOR TO THE ACTIVITY’S COMMENCEMENT, HE/SHE HAS BEEN MADE AWARE OF AND UNDERSTANDS THE RISKS INVOLVED IN SUCH ACTIVITY.  ON BEHALF OF SUCH CHILD AND HIMSELF/HERSELF, THE UNDERSIGNED PARENT/GUARDIAN IS PREPARED TO ASSUME ALL OF SUCH RISKS AS HIS/HER AND THE CHILD’S SOLE RESPONSIBILITY.  THE UNDERSIGNED PARENT/GUARDIAN HEREBY RELEASES AND HOLDS HARMLESS ACT AND ITS MEMBERS, MANAGERS, AGENTS, PARTICIPANTS, SUBCONTRACTORS, AND EMPLOYEES (COLLECTIVELY THE “RELEASED PARTIES”) FROM AND AGAINST ANY AND ALL LIABILITY OCCURRING DURING THE CHILD’S PARTICIPATION, INCLUDING ANY CLAIM THAT ARISES OUT OF THE NEGLIGENCE OF THE RELEASED PARTIES.  THIS RELEASE DOES NOT APPLY TO ANY INTENTIONAL ACTS OF THE RELEASED PARTIES.</strong></p>
				
				<p>The undersigned parent/guardian has considered that if this waiver and release of liability was not as broad as it is, the cost for my Child’s participation in Brancel’s activities would be considerably higher.  As the undersigned parent/guardian does not wish to pay considerably higher costs for the services of Brancel, the undersigned parent/guardian waives the right to bargain for different waiver of liability terms.</p>
				
				<p>The terms and conditions of this Liability Release shall be legally binding upon the undersigned parent/guardian and such child and his/her respective estate, representative and assigns.</p>
		    @else
			    <p>The undersigned signs this Liability Release on behalf of himself/herself.  The undersigned has read this Liability Release and voluntarily agrees to the terms and conditions stated below.  The undersigned acknowledges that he/she has had the opportunity to ask questions of Brancel Charters, LLC (“Brancel”) regarding this Liability Release.  The undersigned further acknowledges that no oral representations, statements, or inducements apart from the written agreement contained herein have been made.</p>
	
				<p><strong>IN CONSIDERATION OF PARTICIPATING IN BRANCEL’S ACTIVITIES, INCLUDING BUT NOT LIMITED TO, TRANSPORTATION OF HIM OR HERSELF AND HIS OR HER BELONGINGS BY BRANCEL OR BRANCEL’S AGENT TO ANY LOCATION (COLLECTIVELY REFERRED TO AS THE “ACTIVITIES”), THE UNDERSIGNED HEREBY ASSUMES ALL RISKS AND HAZARDS INCIDENT TO HIS OR HER PARTICIPATION IN ALL BRANCEL ACTIVITIES REGARDLESS OF PURPOSE OR LOCATION.  IN PARTICULAR, THE UNDERSIGNED ACKNOWLEDGES THAT PRIOR TO THE ACTIVITY’S COMMENCEMENT, HE/SHE HAS BEEN MADE AWARE OF AND UNDERSTANDS THE RISKS INVOLVED IN SUCH ACTIVITY.  ON BEHALF OF HIMSELF/HERSELF, THE UNDERSIGNED IS PREPARED TO ASSUME ALL OF SUCH RISKS AS HIS/HER SOLE RESPONSIBILITY.  THE UNDERSIGNED HEREBY RELEASES AND HOLDS HARMLESS ACT AND ITS MEMBERS, MANAGERS, AGENTS, PARTICIPANTS, SUBCONTRACTORS, AND EMPLOYEES (COLLECTIVELY THE “RELEASED PARTIES”) FROM AND AGAINST ANY AND ALL LIABILITY OCCURRING DURING HIS OR HER PARTICIPATION, INCLUDING ANY CLAIM THAT ARISES OUT OF THE NEGLIGENCE OF THE RELEASED PARTIES.  THIS RELEASE DOES NOT APPLY TO ANY INTENTIONAL ACTS OF THE RELEASED PARTIES.</strong></p>
				
				<p>The undersigned has considered that if this waiver and release of liability was not as broad as it is, the cost for his or her participation in Brancel’s activities would be considerably higher.  As the undersigned does not wish to pay considerably higher costs for the services of Brancel, the undersigned waives the right to bargain for different waiver of liability terms.</p>
				
				<p>The terms and conditions of this Liability Release shall be legally binding upon the undersigned and his/her respective estate, representative and assigns.</p>
		    @endif
		    <input type="checkbox" value="1" name="waver" required> I agree
			<p>&nbsp;</p>
		    <div class="row">
			    <div class="col-sm-8 col-spacing">
				    <label for="signature">Signature</label>
					{{Form::text('signature',null,['class'=>'form-control','required'])}}
					<p class="small-note" style="margin-top:8px;">Registrant name or Guardian name if minor</p>
			    </div>
			    <div class="col-sm-4">
				    <label for="signdate">Date</label>
				    {{Form::text('signdate',null,['class'=>'form-control datepicker','required'])}}
			    </div>
		    </div>
	        <div class="form-group">
				<div class="col col-sm-8">
					<input id="mailinglist" type="checkbox" class="" name="mailinglist" value="1" checked> Join our mailing list
				</div>
	        </div>
			<p>&nbsp;</p>
			<h4 class="text-center green-text font-20">Registration Cost: $<span class="cost">{{$cost}}</span></h4>
			<div>&nbsp;</div>
	        {{Form::hidden('paymenttype','online')}}
		    <div class="row form-group">
		        <div class="col-sm rtecenter">
					@if(date('n')>=9 || date('n')<=6)
		            <p><a href="#" class="btn btn-primary paymenttypebtn btn-block" data-type='mail'>Submit and Mail Payment</a></p>
		            <p class="small-note">Checks may not be cashed until January</p>
		            @endif
		        </div>
		        <div class="col-sm rtecenter">
					@if(date('n')>=9 && date('n')<12)
		            <p><a href="#" class="btn btn-primary paymenttypebtn btn-block" data-type='reserve'>Pay by Invoice in January</a></p>
		            @endif
					@if(date('n')>=9 || date('n')<=6 || 1)
		            <p><a href="#" class="btn btn-primary paymenttypebtn btn-block" data-type='online'>Continue to Payment</a></p>
		            @endif
<!-- 		            <p class="small-note">You will be redirected to PayPal for payment. You are able to pay as a guest in PayPal with a credit card if you don’t have a PayPal account.</p> -->
		        </div>
		    </div>
		{!! Form::close() !!}
	</div>
@endsection

@section('rightsidebar')
<p><img src="http://register.brancelcharters.com/images/BBC-side-bar-image.png" class="img-fluid mx-auto d-block"></p>
<h2 class="text-center">{{$options['eventdate']}}</h2>
<p>&nbsp;</p>
<p class="text-center"><a href="/cancel" class="btn btn-danger">Cancel Registration<br>and Restart</a></p>
@endsection

@section('footer')
<script>
	(function($) {
		$(document).ready(function() {
			$('.paymenttypebtn').click(function(event) {
				event.preventDefault();
				$("input[name='paymenttype']").val($(this).data('type'));
				$('#event_register_form').submit();
			});
			$('select[name=discount]').change(function() {
				var opt = {{$option}};
				var cost = {{$cost}};
				var finalcost = 0;
				var damount = ($('select[name=discount]').val()<=4 && $('select[name=discount]').val()>0)?$('select[name=discount]').val()*5:(($('select[name=discount]').val()>4)?20+(($('select[name=discount]').val()-4)*10):0);
				var discount = (opt==4)?0:damount; //($('select[name=discount]').val() * (($('select[name=discount]').val()<5)?5:(($('select[name=discount]').val()>4)?10:0)));
				if(opt==1 && discount>100) {
					discount = 100;
				}
				if(opt==2 && discount>35) {
					discount = 35;
				}
				if(opt==3 && discount>50) {
					discount = 50;
				}
				$('.cost').text(cost-discount);
			});
		});
	})(jQuery);
</script>
@endsection