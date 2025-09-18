<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="UTF-8">
		<title>{{ config('app.name') }}</title>
		<style>
			a {
				color:#FC8C10;
				text-decoration: none;
			}
			a:hover {
				color:#FC8C10;
				text-decoration: none;
			}
		</style>
	</head>
	<body>
    <!--[if mso]>
	 <center>
	 <table><tr><td width="600">
	<![endif]-->
	    <div style="max-width:600px; margin:0 auto;">
			<table cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td colspan="3" height="30px">&nbsp;</td>
				</tr>
				<tr>
					<td width="2%">&nbsp;</td>
					<td width="48%" valign="top"><img src="{{ config('app.url') }}/images/logo.png" width="100%" alt="{{ config('app.name') }}" style="max-width:300px;height:auto;display:inline-block;"></td>
					<td width="48%" valign="top" align="right"><font size="5" color="#f9a01e" weight="400"><span style="color:#f9a01e;font-size:22px;font-weight:400;"><a href="tel:6082155939" style="text-decoration: none;color:#f9a01e;">608-215-5939</a></span></td>
					<td width="2%">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="4" height="30">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="4" height="50" bgcolor="#6AABDD">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="4" height="20">&nbsp;</td>
				</tr>
				<tr>
					<td width="2%">&nbsp;</td>
					<td colspan="2">
						@yield('content')
					</td>
					<td width="2%">&nbsp;</td>
				</tr>
				@if(isset($link) && !empty($link))
				<tr>
					<td width="2%">&nbsp;</td>
					<td colspan="2" width="96%">
						<p style="text-align:center" align="middle"><a href="{{ $link }}" style="display:inline-block;padding:10px 16px;background-color:#F9A11F;color:#fff;text-decoration:none;font-size:15px;">@yield('buttontext')</a></p>
						<p>&nbsp;</p>
						<p>If you are having trouble clicking the button above, please copy and paste the URL below into your web browser:</p>
						<p style="word-break:break-all;"><font style="word-break:break-all;">{{ $link }}</font></p>
					</td>
					<td width="2%">&nbsp;</td>
				</tr>
				@endif
				<tr><td colspan="4" height="30"></td></tr>
				<tr>
					<td width="2%">&nbsp;</td>
					<td colspan="2">
						<p>Brancel Bicycle Charters</p>
					</td>
					<td width="2%">&nbsp;</td>
				</tr>
				<tr><td colspan="4" height="15">&nbsp;</td></tr>
				<tr><td colspan="4" bgcolor="#6AABDD" height="2"></td></tr>
				<tr><td colspan="4" height="15"></td></tr>
				<tr>
					<td width="2%">&nbsp;</td>
					<td width="96%" colspan="2">
						<p><font size="1"><span style="font-size:10px;">Note: This email has been sent from an unmonitored email account.  Please do not respond directly to this email.  If you have questions <a href="http://www.brancelcharters.com/contact-us/">contact Brancel Bicycle Charters</a></span></font></p>
					</td>
					<td width="2%">&nbsp;</td>
				</tr>
			</table>
	    </div>
	<!--[if mso]>
	 </td></tr></table>
	 </center>
	<![endif]-->
	</body>
</html>