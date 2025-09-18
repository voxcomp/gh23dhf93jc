@extends('layouts.app')

@section('title')
	Registration Options
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
		{!! Form::open(array('route' => ['event.register.options'], 'id'=>'event_register', 'autocomplete'=>'off')) !!}
			{{ method_field('PATCH') }}
			<p>Thank you {{$registration['fname']}}, now please continue with your trip details.</p>
			<p>&nbsp;</p>
		    <h3>Options</h3>
		    <p>Click on an icon or name to select your option.</p>
		    {{Form::hidden('option',old('option',0))}}
	        <div class="row form-group align-items-center">
				<div class="col-sm-3 col-xs-5 col-spacing">
					<div class="tripoption text-center hover" data-option="1"><img src="http://register.brancelcharters.com/images/icon-BBC.png" class="img-fluid mx-auto d-block"><h4>Bus/Bike Transportation<br>PLUS Camping</h4></div>
				</div>
				<div class="col-sm-9 col-xs-7 col-spacing">
					Transportation only from ‘{{$options['ending']}}’ to ‘{{$options['beginning']}}’ on {{date('F j',strtotime("-1 day",strtotime($options['startdate'].', '.substr($options['eventdate'],-4))))}} and daily baggage transportation for the week as part of our group: ${{$options['option1price']}}
<!-- 					<h2 style="color:red">SOLD OUT</h2> -->
				</div>
	        </div>
	        <div class="row form-group align-items-center">
				<div class="col-sm-3 col-xs-5 col-spacing">
					<div class="tripoption text-center hover" data-option="2"><img src="http://register.brancelcharters.com/images/icon-BB.png" class="img-fluid mx-auto d-block"><h4>Bus/Bike Transportation</h4></div>
				</div>
				<div class="col-sm-9 col-xs-7 col-spacing">
					Transportation only from ‘{{$options['ending']}}’ to ‘{{$options['beginning']}}’ on {{date('F j',strtotime("-1 day",strtotime($options['startdate'].', '.substr($options['eventdate'],-4))))}}: ${{$options['option2price']}}
<!-- 					<h2 style="color:red">SOLD OUT</h2> -->
				</div>
	        </div>
	        <div class="row form-group align-items-center">
				<div class="col-sm-3 col-xs-5 col-spacing">
					<div class="tripoption text-center hover" data-option="3"><img src="http://register.brancelcharters.com/images/icon-WC.png" class="img-fluid mx-auto d-block"><h4>Camping for Week</h4></div>
				</div>
				<div class="col-sm-9 col-xs-7 col-spacing">
					Daily camping / baggage service for the week (no bus trip): ${{$options['option3price']}}
<!-- 					<h2 style="color:red">SOLD OUT</h2> -->
				</div>
	        </div>
	        <div class="row form-group align-items-center">
				<div class="col-sm-3 col-xs-5 col-spacing">
					<div class="tripoption text-center hover daycamp" data-option="4"><img src="http://register.brancelcharters.com/images/icon-DC.png" class="img-fluid mx-auto d-block"><h4>Per Day Camping</h4></div>
				</div>
				<div class="col-sm-9 col-xs-7 col-spacing">
					Daily camping / baggage service for less than a week: ${{$options['option4price']}} per night
<!-- 					<h2 style="color:red">SOLD OUT</h2> -->
					<div class="dates">
						<p>&nbsp;</p>
					    <h4>Dates Attending</h4>
				        <div class="row">
							<div class="col-sm col-spacing {{ $errors->has('startdate') ? ' has-error' : '' }}">
							    <label for="startdate">Start Date</label><br>
					            <input id="startdate" type="text" class="datepicker form-control" name="startdate" value="{{ old('startdate',(isset($user['startdate']))?$user['startdate']:'') }}"  placeholder="Start">
					            @if ($errors->has('startdate'))
					                <span class="help-block">
					                    <strong>{{ $errors->first('startdate') }}</strong>
					                </span>
					            @endif
							</div>
							<div class="col-sm {{ $errors->has('enddate') ? ' has-error' : '' }}">
							    <label for="enddate">End Date</label><br>
					            <input id="enddate" type="text" class="datepicker form-control" name="enddate" value="{{ old('enddate',(isset($user['enddate']))?$user['enddate']:'') }}"  placeholder="End">
					            @if ($errors->has('enddate'))
					                <span class="help-block">
					                    <strong>{{ $errors->first('enddate') }}</strong>
					                </span>
					            @endif
							</div>
				        </div>
					</div>
				</div>
	        </div>
			<p>&nbsp;</p>
		    <h3 id="extras">General Extras</h3>
	        <div class="form-group">
	                <div>Are you bringing a recumbent bicycle? (${{$options['recumbentoption1']}})</div>
	                <label for="recumbent-1" class="control-label">No</label>
	                <input id="recumbent-1" class="radios addon" type="radio" class="form-control" name="recumbent" value="no" @if (old('recumbent',(isset($user['recumbent']))?$user['recumbent']:'')=='no') checked="checked" @else checked="checked" @endif>&nbsp;
	                <label for="recumbent-2" class="control-label">Yes</label>
	                <input id="recumbent-2" class="radios addon" type="radio" class="form-control" name="recumbent" value="yes" @if (old('recumbent',(isset($user['recumbent']))?$user['recumbent']:'')=='yes') checked="checked" @endif>
	                <span class="addon-price"></span>
	        </div>
	        <div class="form-group towel-service">
	                <div>Would you like towel service? (${{$options['towel']}})</div>
<!-- 	                <h2 style="color:red">SOLD OUT</h2> -->
	                <input id="towel" type="hidden" name="towel" value="no">
	                <label for="towel-1" class="control-label">No</label>
	                <input id="towel-1" class="radios addon" type="radio" class="form-control" name="towel" value="no" @if (old('towel',(isset($user['towel']))?$user['towel']:'')=='no') checked="checked" @else checked="checked" @endif>&nbsp;
	                <label for="towel-2" class="control-label">Yes</label>
	                <input id="towel-2" class="radios addon" type="radio" class="form-control" name="towel" value="yes" @if (old('towel',(isset($user['towel']))?$user['towel']:'')=='yes') checked="checked" @endif>
	                <span class="addon-price"></span>
	        </div>
	        <div class="form-group shower-card">
	                <div>Shower card - $45 for 6 showers <span class="small-note">(does not include towel, can also be bought at check in)</span></div>
	                <label for="shower-1" class="control-label">No</label>
	                <input id="shower-1" class="radios addon" type="radio" class="form-control" name="shower" value="no" @if (old('shower',(isset($user['shower']))?$user['shower']:'')=='no') checked="checked" @else checked="checked" @endif>&nbsp;
	                <label for="shower-2" class="control-label">Yes</label>
	                <input id="shower-2" class="radios addon" type="radio" class="form-control" name="shower" value="yes" @if (old('shower',(isset($user['shower']))?$user['shower']:'')=='yes') checked="checked" @endif>
	                <span class="addon-price"></span>
	        </div>
			<p>&nbsp;</p>
			<h3 class="jerseys-title">Brancel Bicycle Charters Jersey (<span class="orange-text">${{$options['jersey']}}</span>)</h3>
			<?php $jersey = explode(';',old('jersey')); ?>
		    {{Form::hidden('jersey',old('jersey'))}}
		    <div class="jerseys">
				@if(!empty($jersey))
					@foreach($jersey as $item)
						@if(!empty($item))
							<?php $list = explode(':',$item); ?>
							<div class="jersey" data-jersey="{{$item}}"><i class="delete fas fa-trash-alt"></i> &nbsp;{{$list[2]}} {{str_replace("_"," ",$list[0])}} jersey{{(($list[2]>1)?'s':'')}} in size {{$list[1]}}</div>
						@endif
					@endforeach
				@endif
		    </div>
			<p>Please complete the form below to add one or more jerseys to your registration.</p>
			<div class="row">
				<div class="col-sm-4">
				    <div class="jersey-warning">
				    </div>
					<div class="form-group">
		                <div class="mb-2"><label for="jersey-gender-1" class="control-label">Mens</label>
		                <input id="jersey-gender-1" class="radios" type="radio" class="form-control" name="jersey-gender" value="mens"></div>
		                <div class="mb-2"><label for="jersey-gender-2" class="control-label">Womens Regular</label>
		                <input id="jersey-gender-2" class="radios" type="radio" class="form-control" name="jersey-gender" value="womens_regular"></div>
		                <div class="mb-2"><label for="jersey-gender-3" class="control-label">Womens Sleeveless</label>
		                <input id="jersey-gender-3" class="radios" type="radio" class="form-control" name="jersey-gender" value="womens_sleeveless"></div>
					</div>
					<div class="form-group">
						{{Form::select('jersey-size',['0'=>'Choose Size','XS'=>'XS','S'=>'S','M'=>'M','L'=>'L','XL'=>'XL','XXL'=>'XXL','XXXL'=>'XXXL'],null,['class'=>'form-control'])}}
					</div>
					<div class="form-group">
						{{Form::number('jersey-quantity',1,['class'=>'form-control'])}}
					</div>
					<div class="form-group">
						<a href="#" class="btn btn-primary add-jersey">Add Jersey</a>
					</div>
	            </div>
				<div class="col-sm">
					<div class="row">
						<div class="col-sm">
							<p><img src="/images/front-jersey.jpg" class="img-fluid mx-auto d-block"></p>
						</div>
						<div class="col-sm">
							<p><img src="/images/back-jersey.jpg" class="img-fluid mx-auto d-block"></p>
						</div>
					</div>
					<p class="small-note text-center">Jersey by<br>Borah Teamwear custom apparel.</p>
				</div>
			</div>
			<p>&nbsp;</p>
		    <div class="row form-group">
		        <div class="col-sm rtecenter">
		            <input type="submit" class="btn btn-primary" value="Continue to Step 3">
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
			$('.tripoption').click(function() {
				$("input[name='option']").val($(this).data('option'));
				if($(this).data('option')=='2' || $(this).data('option')=='4') {
					$("#shower-2").prop("checked", false).checkboxradio( "refresh" );
					$("#shower-1").prop("checked", true).checkboxradio( "refresh" ).trigger('click');
					$(".shower-card").hide();
				} else {
					$(".shower-card").show();
				}
				$('html, body').animate(
				    {
				      scrollTop: $("#extras").offset().top,
				    },
				    500,
				    'linear'
				  );
/*
				console.log($("input[name=recumbent]:checked").val());
				console.log($("input[name=towel]:checked").val());
*/
				$("span.addon-price").hide().text('');
				if($("input[name=recumbent]:checked").val()=='yes') {
					cost = 0;
					if($('input[name=option]').val()=='1') {
						cost={{$options['recumbentoption1']}};
					} else if($('input[name=option]').val()=='2') {
						cost={{$options['recumbentoption2']}};
					}
					$("input[name=recumbent]:checked").nextAll('span.addon-price').text('+ $'+cost).fadeIn(200);
				}
				if($("input[name=towel]:checked").val()=='yes') {
					cost = 0;
					if($('input[name=option]').val()=='1' || $('input[name=option]').val()=='3' || $('input[name=option]').val()=='4') {
						cost = {{$options['towel']}};
					}
					$("input[name=towel]:checked").nextAll('span.addon-price').text('+ $'+cost).fadeIn(200);
				}
				if($("input[name=shower]:checked").val()=='yes') {
					cost = 0;
					if($('input[name=option]').val()=='1' || $('input[name=option]').val()=='3' || $('input[name=option]').val()=='4') {
						cost = 45;
					}
					$("input[name=shower]:checked").nextAll('span.addon-price').text('+ $'+cost).fadeIn(200);
				}
			});
			if($("input[name='option']").val()!='0') {
				$('.tripoption').eq($("input[name='option']").val()-1).trigger('click');
			}
			$('.addon').click(function() {
				optionname = $(this).attr('name');
				if($(this).val()=='yes') {
					var cost = 0;
					if(optionname=='recumbent' && $('input[name=option]').val()=='1') {
						cost={{$options['recumbentoption1']}};
					} else if(optionname=='recumbent' && $('input[name=option]').val()=='2') {
						cost={{$options['recumbentoption2']}};
					}
					if(optionname=='towel' && ($('input[name=option]').val()=='1' || $('input[name=option]').val()=='3' || $('input[name=option]').val()=='4')) {
						cost={{$options['towel']}};
					}
					if(optionname=='shower' && ($('input[name=option]').val()=='1' || $('input[name=option]').val()=='3' || $('input[name=option]').val()=='4')) {
						cost=45;
					}
					$(this).nextAll('span.addon-price').text('+ $'+cost).fadeIn(200);
				} else {
					$(this).nextAll('span.addon-price').fadeOut(200).text('');
				}
			});
			$('.add-jersey').click(function(event) {
				event.preventDefault();
				var jgender = $("input[name='jersey-gender']:checked").val();
				var jsize = $("select[name='jersey-size']").val();
				var jquantity = parseInt($("input[name='jersey-quantity']").val());
				if(!jgender) {
					$('.jersey-warning').text('Please select a jersey cut').fadeIn(300);
					return;
				}
				if(jsize==0) {
					$('.jersey-warning').text('Please select a size').fadeIn(300);
					return;
				}
				if(jquantity==0) {
					$('.jersey-warning').text('Please enter a quantity').fadeIn(300);
					return;
				}
				var jerseys = $("input[name=jersey]").val();
				var jersey = jgender+":"+jsize+":"+jquantity+";";
				jerseys+=jersey;
				$("input[name=jersey]").val(jerseys);
				$(".jerseys").append("<div class='jersey' data-jersey='"+jersey+"'><i class='delete fas fa-trash-alt'></i> &nbsp;"+jquantity+" "+jgender.replace("_"," ")+" jersey"+((jquantity>1)?'s':'')+" in size "+jsize+"</div>");
				$(".jersey .delete").on('click',function() {
					$(this).parent().remove();
					$("input[name=jersey]").val('');
					$.each($(".jerseys").children(),function() {
						$("input[name=jersey]").val($("input[name=jersey]").val()+";"+$(this).data('jersey'));
					});
					$('.jersey-warning').text('').fadeOut(100);
				});
			});
			$(".jersey .delete").on('click',function() {
				$(this).parent().remove();
				$("input[name=jersey]").val('');
				$.each($(".jerseys").children(),function() {
					$("input[name=jersey]").val($("input[name=jersey]").val()+";"+$(this).data('jersey'));
				});
				$('.jersey-warning').text('').fadeOut(100);
			});
		});
	})(jQuery);
</script>
@endsection
