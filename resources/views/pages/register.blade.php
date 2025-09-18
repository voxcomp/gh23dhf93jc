@extends('layouts.app')

@section('title')
	Registration
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
		<p>Please fill out the below form per person. You must be a RAGBRAI registered rider to use our services.</p>
<!-- 		<p>When you receive your wristband number in May, <a href="{{route('event.register.wristband')}}">please click here</a> to add that to your registration.</p> -->
		{!! Form::open(array('route' => ['event.register.step1'], 'id'=>'event_register_form')) !!}
		    <h3>Contact Information</h3>
	        <div class="row form-group">
				<div class="col-sm col-spacing {{ $errors->has('fname') ? ' has-error' : '' }}">
		            <input id="fname" type="text" class="form-control" name="fname" value="{{ old('fname',(isset($user['fname']))?$user['fname']:'') }}" required autofocus placeholder="First Name">
		            @if ($errors->has('fname'))
		                <span class="help-block">
		                    <strong>{{ $errors->first('fname') }}</strong>
		                </span>
		            @endif
				</div>
				<div class="col-sm {{ $errors->has('email') ? ' has-error' : '' }}">
		            <input id="lname" type="text" class="form-control" name="lname" value="{{ old('lname',(isset($user['lname']))?$user['lname']:'') }}" required placeholder="Last Name">
		            @if ($errors->has('lname'))
		                <span class="help-block">
		                    <strong>{{ $errors->first('lname') }}</strong>
		                </span>
		            @endif
				</div>
	        </div>
	        <div class="row form-group">
			    <div class="col-sm col-spacing{{ $errors->has('email') ? ' has-error' : '' }}">
			        <input id="email" type="email" class="form-control" name="email" value="{{ old('email',(isset($user['email']))?$user['email']:'') }}" autocomplete="off" required placeholder="E-mail Address">
			        @if ($errors->has('email'))
			            <span class="help-block">
			                <strong>{{ $errors->first('email') }}</strong>
			            </span>
			        @endif
			    </div>
			    <div class="col-sm col-spacing{{ $errors->has('phone') ? ' has-error' : '' }}">
			        <input id="phone" type="phone" class="form-control" name="phone" value="{{ old('phone',(isset($user['phone']))?$user['phone']:'') }}" autocomplete="off" required placeholder="Phone">
			        @if ($errors->has('phone'))
			            <span class="help-block">
			                <strong>{{ $errors->first('phone') }}</strong>
			            </span>
			        @endif
			    </div>
			    <div class="col-sm">
			        <input id="cell" type="cell" class="form-control" name="cell" value="{{ old('cell',(isset($user['cell']))?$user['cell']:'') }}" autocomplete="off" placeholder="Cell Phone">
			    </div>
		    </div>
		    <p>&nbsp;</p>
		    <h3>Billing Address</h3>
			<div class="row form-group{{ $errors->has('address') ? ' has-error' : '' }}">
		        <div class="col-sm">
		            <input id="address" type="text" class="form-control" name="address" value="{{ old('address',(isset($user['address']))?$user['address']:'') }}" required autofocus placeholder="Address">
		            @if ($errors->has('address'))
		                <span class="help-block">
		                    <strong>{{ $errors->first('address') }}</strong>
		                </span>
		            @endif
		        </div>
			</div>
			<div class="row form-group">
				<div class="col-sm-6 col-xs-12 col-spacing{{ $errors->has('city') ? ' has-error' : '' }}">
		            <input id="city" type="text" class="form-control" name="city" value="{{ old('city',(isset($user['city']))?$user['city']:'') }}" required placeholder="City">
		            @if ($errors->has('city'))
		                <span class="help-block">
		                    <strong>{{ $errors->first('city') }}</strong>
		                </span>
		            @endif
				</div>
				<div class="col-sm-2 col-xs-4 col-spacing{{ $errors->has('state') ? ' has-error' : '' }}">
		            <input id="state" type="text" class="form-control" name="state" value="{{ old('state',(isset($user['state']))?$user['state']:'') }}" required placeholder="State">
		            @if ($errors->has('state'))
		                <span class="help-block">
		                    <strong>{{ $errors->first('state') }}</strong>
		                </span>
		            @endif
				</div>
				<div class="col-sm-4 col-xs-8{{ $errors->has('zip') ? ' has-error' : '' }}">
		            <input id="zip" type="text" class="form-control" name="zip" value="{{ old('zip',(isset($user['zip']))?$user['zip']:'') }}" required placeholder="Zip Code">
		            @if ($errors->has('zip'))
		                <span class="help-block">
		                    <strong>{{ $errors->first('zip') }}</strong>
		                </span>
		            @endif
				</div>
			</div>
			<div class="row form-group">
				<div class="col-sm-4 {{ $errors->has('country') ? ' has-error' : '' }}">
		            {{ Form::select('country', ['AF' => 'Afghanistan', 'AL' => 'Albania', 'DZ' => 'Algeria', 'DS' => 'American Samoa', 'AD' => 'Andorra', 'AO' => 'Angola', 'AI' => 'Anguilla', 'AQ' => 'Antarctica', 'AG' => 'Antigua and Barbuda', 'AR' => 'Argentina', 'AM' => 'Armenia', 'AW' => 'Aruba', 'AU' => 'Australia', 'AT' => 'Austria', 'AZ' => 'Azerbaijan', 'BS' => 'Bahamas', 'BH' => 'Bahrain', 'BD' => 'Bangladesh', 'BB' => 'Barbados', 'BY' => 'Belarus', 'BE' => 'Belgium', 'BZ' => 'Belize', 'BJ' => 'Benin', 'BM' => 'Bermuda', 'BT' => 'Bhutan', 'BO' => 'Bolivia', 'BA' => 'Bosnia and Herzegovina', 'BW' => 'Botswana', 'BV' => 'Bouvet Island', 'BR' => 'Brazil', 'IO' => 'British Indian Ocean Territory', 'BN' => 'Brunei Darussalam', 'BG' => 'Bulgaria', 'BF' => 'Burkina Faso', 'BI' => 'Burundi', 'KH' => 'Cambodia', 'CM' => 'Cameroon', 'CA' => 'Canada', 'CV' => 'Cape Verde', 'KY' => 'Cayman Islands', 'CF' => 'Central African Republic', 'TD' => 'Chad', 'CL' => 'Chile', 'CN' => 'China', 'CX' => 'Christmas Island', 'CC' => 'Cocos (Keeling) Islands', 'CO' => 'Colombia', 'KM' => 'Comoros', 'CD' => 'Democratic Republic of the Congo', 'CG' => 'Republic of Congo', 'CK' => 'Cook Islands', 'CR' => 'Costa Rica', 'HR' => 'Croatia (Hrvatska)', 'CU' => 'Cuba', 'CY' => 'Cyprus', 'CZ' => 'Czech Republic', 'DK' => 'Denmark', 'DJ' => 'Djibouti', 'DM' => 'Dominica', 'DO' => 'Dominican Republic', 'TP' => 'East Timor', 'EC' => 'Ecuador', 'EG' => 'Egypt', 'SV' => 'El Salvador', 'GQ' => 'Equatorial Guinea', 'ER' => 'Eritrea', 'EE' => 'Estonia', 'ET' => 'Ethiopia', 'FK' => 'Falkland Islands (Malvinas)', 'FO' => 'Faroe Islands', 'FJ' => 'Fiji', 'FI' => 'Finland', 'FR' => 'France', 'FX' => 'France, Metropolitan', 'GF' => 'French Guiana', 'PF' => 'French Polynesia', 'TF' => 'French Southern Territories', 'GA' => 'Gabon', 'GM' => 'Gambia', 'GE' => 'Georgia', 'DE' => 'Germany', 'GH' => 'Ghana', 'GI' => 'Gibraltar', 'GK' => 'Guernsey', 'GR' => 'Greece', 'GL' => 'Greenland', 'GD' => 'Grenada', 'GP' => 'Guadeloupe', 'GU' => 'Guam', 'GT' => 'Guatemala', 'GN' => 'Guinea', 'GW' => 'Guinea-Bissau', 'GY' => 'Guyana', 'HT' => 'Haiti', 'HM' => 'Heard and Mc Donald Islands', 'HN' => 'Honduras', 'HK' => 'Hong Kong', 'HU' => 'Hungary', 'IS' => 'Iceland', 'IN' => 'India', 'IM' => 'Isle of Man', 'ID' => 'Indonesia', 'IR' => 'Iran (Islamic Republic of)', 'IQ' => 'Iraq', 'IE' => 'Ireland', 'IL' => 'Israel', 'IT' => 'Italy', 'CI' => 'Ivory Coast', 'JE' => 'Jersey', 'JM' => 'Jamaica', 'JP' => 'Japan', 'JO' => 'Jordan', 'KZ' => 'Kazakhstan', 'KE' => 'Kenya', 'KI' => 'Kiribati', 'KP' => 'Korea, Democratic People\'s Republic of', 'KR' => 'Korea, Republic of', 'XK' => 'Kosovo', 'KW' => 'Kuwait', 'KG' => 'Kyrgyzstan', 'LA' => 'Lao People\'s Democratic Republic', 'LV' => 'Latvia', 'LB' => 'Lebanon', 'LS' => 'Lesotho', 'LR' => 'Liberia', 'LY' => 'Libyan Arab Jamahiriya', 'LI' => 'Liechtenstein', 'LT' => 'Lithuania', 'LU' => 'Luxembourg', 'MO' => 'Macau', 'MK' => 'North Macedonia', 'MG' => 'Madagascar', 'MW' => 'Malawi', 'MY' => 'Malaysia', 'MV' => 'Maldives', 'ML' => 'Mali', 'MT' => 'Malta', 'MH' => 'Marshall Islands', 'MQ' => 'Martinique', 'MR' => 'Mauritania', 'MU' => 'Mauritius', 'TY' => 'Mayotte', 'MX' => 'Mexico', 'FM' => 'Micronesia, Federated States of', 'MD' => 'Moldova, Republic of', 'MC' => 'Monaco', 'MN' => 'Mongolia', 'ME' => 'Montenegro', 'MS' => 'Montserrat', 'MA' => 'Morocco', 'MZ' => 'Mozambique', 'MM' => 'Myanmar', 'NA' => 'Namibia', 'NR' => 'Nauru', 'NP' => 'Nepal', 'NL' => 'Netherlands', 'AN' => 'Netherlands Antilles', 'NC' => 'New Caledonia', 'NZ' => 'New Zealand', 'NI' => 'Nicaragua', 'NE' => 'Niger', 'NG' => 'Nigeria', 'NU' => 'Niue', 'NF' => 'Norfolk Island', 'MP' => 'Northern Mariana Islands', 'NO' => 'Norway', 'OM' => 'Oman', 'PK' => 'Pakistan', 'PW' => 'Palau', 'PS' => 'Palestine', 'PA' => 'Panama', 'PG' => 'Papua New Guinea', 'PY' => 'Paraguay', 'PE' => 'Peru', 'PH' => 'Philippines', 'PN' => 'Pitcairn', 'PL' => 'Poland', 'PT' => 'Portugal', 'PR' => 'Puerto Rico', 'QA' => 'Qatar', 'RE' => 'Reunion', 'RO' => 'Romania', 'RU' => 'Russian Federation', 'RW' => 'Rwanda', 'KN' => 'Saint Kitts and Nevis', 'LC' => 'Saint Lucia', 'VC' => 'Saint Vincent and the Grenadines', 'WS' => 'Samoa', 'SM' => 'San Marino', 'ST' => 'Sao Tome and Principe', 'SA' => 'Saudi Arabia', 'SN' => 'Senegal', 'RS' => 'Serbia', 'SC' => 'Seychelles', 'SL' => 'Sierra Leone', 'SG' => 'Singapore', 'SK' => 'Slovakia', 'SI' => 'Slovenia', 'SB' => 'Solomon Islands', 'SO' => 'Somalia', 'ZA' => 'South Africa', 'SS' => 'South Sudan', 'GS' => 'South Georgia South Sandwich Islands', 'ES' => 'Spain', 'LK' => 'Sri Lanka', 'SH' => 'St. Helena', 'PM' => 'St. Pierre and Miquelon', 'SD' => 'Sudan', 'SR' => 'Suriname', 'SJ' => 'Svalbard and Jan Mayen Islands', 'SZ' => 'Swaziland', 'SE' => 'Sweden', 'CH' => 'Switzerland', 'SY' => 'Syrian Arab Republic', 'TW' => 'Taiwan', 'TJ' => 'Tajikistan', 'TZ' => 'Tanzania, United Republic of', 'TH' => 'Thailand', 'TG' => 'Togo', 'TK' => 'Tokelau', 'TO' => 'Tonga', 'TT' => 'Trinidad and Tobago', 'TN' => 'Tunisia', 'TR' => 'Turkey', 'TM' => 'Turkmenistan', 'TC' => 'Turks and Caicos Islands', 'TV' => 'Tuvalu', 'UG' => 'Uganda', 'UA' => 'Ukraine', 'AE' => 'United Arab Emirates', 'GB' => 'United Kingdom', 'US' => 'United States', 'UM' => 'United States minor outlying islands', 'UY' => 'Uruguay', 'UZ' => 'Uzbekistan', 'VU' => 'Vanuatu', 'VA' => 'Vatican City State', 'VE' => 'Venezuela', 'VN' => 'Vietnam', 'VG' => 'Virgin Islands (British)', 'VI' => 'Virgin Islands (U.S.)', 'WF' => 'Wallis and Futuna Islands', 'EH' => 'Western Sahara', 'YE' => 'Yemen', 'ZM' => 'Zambia', 'ZW' => 'Zimbabwe'], old('country',(isset($user['country']))?$user['country']:'US'), ['class'=>'form-control', 'required']) }}
		            @if ($errors->has('country'))
		                <span class="help-block">
		                    <strong>{{ $errors->first('country') }}</strong>
		                </span>
		            @endif
				</div>
			</div>
			<p>&nbsp;</p>
			<h3>Emergency Contact</h3>
			<div class="row form-group">
		        <div class="col-sm col-spacing">
				    <label for="econtact">Name</label><br>
		            <input id="econtact" type="text" class="form-control" name="econtact" value="{{ old('econtact',(isset($user['econtact']))?$user['econtact']:'') }}" required>
		        </div>
		        <div class="col-sm">
				    <label for="enumber">Number</label><br>
		            <input id="enumber" type="text" class="form-control" name="enumber" value="{{ old('enumber',(isset($user['enumber']))?$user['enumber']:'') }}" required>
		        </div>
			</div>
			<div class="row form-group">
		        <div class="col-sm">
				    <label for="medical">Please describe any medical conditions of which we should be aware</label><br>
		            <textarea id="medical" class="form-control" name="medical">{{ old('medical',(isset($user['medical']))?$user['medical']:'') }}</textarea>
		        </div>
			</div>
			
			<p>&nbsp;</p>
			<h3>Additional Details</h3>
			<div class="row form-group">
		        <div class="col-sm col-spacing">
				    <label for="dob">Birthdate</label><br>
		            <input id="dob" type="text" class="datepicker form-control" name="dob" value="{{ old('dob',(isset($user['dob']))?$user['dob']:'') }}" required placeholder="Birthdate">
		            @if ($errors->has('dob'))
		                <span class="help-block">
		                    <strong>{{ $errors->first('dob') }}</strong>
		                </span>
		            @endif
		        </div>
		        <div class="col-sm">
				    <label for="gender">Gender</label><br>
			        {{Form::select('gender',['male'=>'Male','female'=>'Female'], old('gender',(isset($user['gender']))?$user['gender']:'male'), ['class'=>'form-control'])}}
		        </div>
			</div>
			<div class="row form-group">
		        <div class="col-sm col-spacing">
				    <label for="group">Number of RAGBRAIs Completed</label><br>
				    {!! Form::select('ragbrais',[0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60],old('ragbrais',(isset($user['ragbrais']))?$user['ragbrais']:0),['class'=>'form-control']) !!}
		        </div>
<!--
		        <div class="col-sm col-spacing">
				    <label for="wristband">Wristband Number</label><br>
		            <input id="wristband" type="text" class="form-control" name="wristband" value="{{ old('wristband',(isset($user['wristband']))?$user['wristband']:'') }}">
		            <div class="small-note">When you receive your wristband number in May, <a href="{{route('event.register.wristband')}}">please click here</a> to add that to your registration.</div>
		        </div>
-->
		        <div class="col-sm">
				    <label for="group">Group</label><br>
		            <input id="group" type="text" class="form-control" name="group" value="{{ old('group',(isset($user['group']))?$user['group']:'') }}">
		        </div>
			</div>
			<p>&nbsp;</p>
		    <div class="row form-group">
		        <div class="col-sm rtecenter">
		            <input type="submit" class="btn btn-primary" value="Continue to Step 2">
		        </div>
		    </div>
		{!! Form::close() !!}
	</div>
@endsection

@section('rightsidebar')
<p><img src="http://register.brancelcharters.com/images/BBC-side-bar-image.png" class="img-fluid mx-auto d-block"></p>
<h2 class="text-center">{{$options['eventdate']}}</h2>

@endsection
