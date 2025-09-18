@extends('layouts.app')

@section('title')
	Administration
@stop

@section('content')
	@if (session('message'))
	    <div class="alert alert-warning nohide">
	        {!! session('message') !!}
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
		<h3>Site Status: <span class="text-{{($options['sitestatus']=='open')?'success':'danger'}}">{{strtoupper($options['sitestatus'])}}</span></h3>
		{{ html()->form('POST', route('admin.status', ))->id('status_form')->open() }}
			<div class="mb-2">
				<div class="row">
					<div class="col-sm-3 mb-2">
						&nbsp;<br>
						{{ html()->radio('status', $options['sitestatus'] == 'open' ? true : false, 'open') }} <strong>OPEN</strong><br>
						{{ html()->radio('status', $options['sitestatus'] != 'open' ? true : false, 'closed') }} <strong>CLOSED</strong><br>
					</div>
					<div class="col-sm mb-2">
						{{ html()->label('Message to visitors when site is closed:', 'statusmessage') }}
						{{ html()->textarea('statusmessage', old('statusmessage', $options['statusmessage']))->class('form-control') }}
					</div>
				</div>
			</div>
			<div class="text-center">
				<button type="submit" href="{{route('admin.status')}}" class="btn btn-primary">Save</button>
			</div>
			<p>Special registration link: <strong>{{url('/'.md5(date('Y')))}}</strong></p>
		{{ html()->form()->close() }}
		<p>&nbsp;</p>
		<hr>
		<p>&nbsp;</p>
		{{ html()->form('POST', route('admin.options', ))->id('options_form')->open() }}
		    <h3>General Site Options</h3>
	        <div class="form-group row">
		        <div class="col-sm col-spacing">
			        <label for="eventdate">Event Date</label>
		            <input id="eventdate" name="eventdate" type="text" class="form-control" value="{{ old('eventdate',(isset($options['eventdate']))?$options['eventdate']:'') }}">
		        </div>
		        <div class="col-sm">
			        <label for="startdate">Start Date</label>
		            <input id="startdate" name="startdate" type="text" class="form-control" value="{{ old('startdate',(isset($options['startdate']))?$options['startdate']:'') }}">
		        </div>
		        <div class="col-sm">
			        <label for="enddate">End Date</label>
		            <input id="enddate" name="enddate" type="text" class="form-control" value="{{ old('enddate',(isset($options['enddate']))?$options['enddate']:'') }}">
		        </div>
	        </div>
	        <div class="form-group row">
		        <div class="col-sm col-spacing">
		        <label for="beginning">Beginning Town</label>
	            <input id="beginning" name="beginning" type="text" class="form-control" value="{{ old('beginning',(isset($options['beginning']))?$options['beginning']:'') }}">
		        </div>
		        <div class="col-sm">
		        <label for="ending">Ending Town</label>
	            <input id="ending" name="ending" type="text" class="form-control" value="{{ old('ending',(isset($options['ending']))?$options['ending']:'') }}">
		        </div>
	        </div>
	        <div class="form-group row">
		        <div class="col-sm col-spacing">
		        <label for="option1price">Option 1 Price</label>
	            <input id="option1price" name="option1price" type="text" class="form-control" value="{{ old('option1price',(isset($options['option1price']))?$options['option1price']:'') }}">
		        </div>
		        <div class="col-sm">
		        <label for="option2price">Option 2 Price</label>
	            <input id="option2price" name="option2price" type="text" class="form-control" value="{{ old('option2price',(isset($options['option2price']))?$options['option2price']:'') }}">
		        </div>
		        <div class="col-sm">
		        <label for="option3price">Option 3 Price</label>
	            <input id="option3price" name="option3price" type="text" class="form-control" value="{{ old('option3price',(isset($options['option3price']))?$options['option3price']:'') }}">
		        </div>
		        <div class="col-sm">
		        <label for="option4price">Option 4 Price</label>
	            <input id="option4price" name="option4price" type="text" class="form-control" value="{{ old('option4price',(isset($options['option4price']))?$options['option4price']:'') }}">
		        </div>
	        </div>
	        <div class="form-group row">
		        <div class="col-sm col-spacing">
		        <label for="recumbentoption1">Recumbent Price (option 1)</label>
	            <input id="recumbentoption1" name="recumbentoption1" type="text" class="form-control" value="{{ old('recumbentoption1',(isset($options['recumbentoption1']))?$options['recumbentoption1']:'') }}">
		        </div>
		        <div class="col-sm">
		        <label for="recumbentoption2">Recumbent Price (option 2)</label>
	            <input id="recumbentoption2" name="recumbentoption2" type="text" class="form-control" value="{{ old('recumbentoption2',(isset($options['recumbentoption2']))?$options['recumbentoption2']:'') }}">
		        </div>
	        </div>
	        <div class="form-group row">
		        <div class="col-sm col-spacing">
		        <label for="towel">Towel Price</label>
	            <input id="towel" name="towel" type="text" class="form-control" value="{{ old('towel',(isset($options['towel']))?$options['towel']:'') }}">
		        </div>
		        <div class="col-sm">
		        <label for="jersey">Jersey Price</label>
	            <input id="jersey" name="jersey" type="text" class="form-control" value="{{ old('jersey',(isset($options['jersey']))?$options['jersey']:'') }}">
		        </div>
	        </div>
	        {{--
	        <div class="form-group row">
		        <div class="col-sm-12">
			        <label for="option1reserve">Allow reservations for the following Options:</label>
			    </div>
			    <div class="col-sm-3">
				    <input name="option1reserve" type="checkbox" value="1" @if(old('option1reserve',(isset($options['option1reserve']))?$options['option1reserve']:1)) checked @endif> <strong>Option 1:</strong> Bus/Bike Transportation PLUS Camping
			    </div>
			    <div class="col-sm-3">
				    <input name="option2reserve" type="checkbox" value="1" @if(old('option2reserve',(isset($options['option2reserve']))?$options['option2reserve']:1)) checked @endif> <strong>Option 2:</strong> Bus/Bike Transportation
			    </div>
			    <div class="col-sm-3">
				    <input name="option3reserve" type="checkbox" value="1" @if(old('option3reserve',(isset($options['option3reserve']))?$options['option3reserve']:1)) checked @endif> <strong>Option 3:</strong> Camping for Week
			    </div>
			    <div class="col-sm-3">
				    <input name="option4reserve" type="checkbox" value="1" @if(old('option4reserve',(isset($options['option4reserve']))?$options['option4reserve']:1)) checked @endif> <strong>Option 4:</strong> Per Day Camping
			    </div>
	        </div>
	        --}}
			<p>&nbsp;</p>
		    <div class="row form-group">
		        <div class="col-sm rtecenter">
		            <input type="submit" class="btn btn-primary" value="Save Options">
		        </div>
		    </div>
		{{ html()->form()->close() }}
	</div>
	<p>&nbsp;</p>
	<hr>
	<p>&nbsp;</p>
	<div class="medium-content-area">
		 <h3>Registration Download</h3>
		<p><a href="{{route('admin.download')}}" class="btn btn-primary">Download Registrations</a></p>
		@if(isset($options['lastexport']))
			<p><a href="{{route('admin.download.last')}}" class="btn btn-primary">Download Registrations Since {{date("m/d/Y g:i a",strtotime($options['lastexport']))}}</a></p>
		@endif
	</div>
	<p>&nbsp;</p>
	<hr>
	<p>&nbsp;</p>
	<div class="medium-content-area">
		 <h3>Reserved Reservation Payment Request</h3>
		<p>Request payment from those registrations that are marked as reserved.</p>
		<p><a href="#" class="btn btn-primary request-payment">Send Payment Request</a></p>
		<div class="small-note payment-message"></div>
	</div>
	<p>&nbsp;</p>
	<hr>
	<p>&nbsp;</p>
	<div class="medium-content-area">
		<h3>Reservation Payment Request</h3>
		<p>Request a payment from the list of registrations provided.</p>
		{{ html()->form('POST', route('payment.request.send', ))->id('options_form')->open() }}
	        <div class="form-group">
		        <label for="requestlist">Enter a list of invoice numbers separated by commas to send payment request emails:</label>
	            <textarea id="requestlist" name="requestlist" type="text" class="form-control" required></textarea>
	        </div>
		    <div class="form-group">
	            <input type="submit" class="btn btn-primary" value="Send Request Payment To List">
		    </div>
		{{ html()->form()->close() }}
	</div>
@endsection

@section('footer')
<script>
	(function($) {
		$(".request-payment").on("click",function(event) {
			event.preventDefault();
			$.ajaxSetup({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});
	        $.ajax({
	            url: "{{route('payment.request')}}",
	            type: 'GET',
	            dataType: 'html',
	            success: function(data) {
		            $(".payment-message").text(data);
	            }
	        });
	    });
	})(jQuery);
</script>
@endsection