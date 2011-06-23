<?php
$benchmark_time = time()+ microtime();
/*	
 * FlickSourcer
 * Version 1.2
 * (cc) Xavi Esteve under Creative Commons By-SA 3.0
 * Last updated: 23 June 2011
 */
define("APP_URL", "http://www.xaviesteve.com/pro/flicksourcer/"); // no trailing slash
define("APP_TITLE", "FlickSourcer");
define("APP_SLOGAN", "Ultimate placeholder image tool");

date_default_timezone_set('Europe/London');
error_reporting(E_ALL);
error_reporting(E_STRICT);
ob_start("ob_gzhandler");


?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<link rel="shortcut icon" href="http://xaviesteve.com/pro/flicksourcer/flickr2.gif">
<title><?=APP_TITLE?> - <?=APP_SLOGAN?></title>
<style type="text/css">
html{color:#000;background:#FFF;}body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,code,form,fieldset,legend,input,button,textarea,p,blockquote,th,td{margin:0;padding:0;}table{border-collapse:collapse;border-spacing:0;}fieldset,img{border:0;}address,caption,cite,code,dfn,em,strong,th,var,optgroup{font-style:inherit;font-weight:inherit;}del,ins{text-decoration:none;}li{list-style:none;}caption,th{text-align:left;}h1,h2,h3,h4,h5,h6{font-size:100%;font-weight:normal;}q:before,q:after{content:'';}abbr,acronym{border:0;font-variant:normal;}sup{vertical-align:baseline;}sub{vertical-align:baseline;}legend{color:#000;}input,button,textarea,select,optgroup,option{font-family:inherit;font-size:inherit;font-style:inherit;font-weight:inherit;}input,button,textarea,select{*font-size:100%;}/* Copyright (c) 2010, Yahoo! Inc. All rights reserved. Code licensed under the BSD License: http://developer.yahoo.com/yui/license.html version: 2.8.1 */


.blue{color:#0061DC}
.pink{color:#FF0084}
.small{font-size:10px}
.em{font-style:italic}
html{background:#000;color:#fff;font-family:'Myriad Pro',Helvetica,Arial,sans-serif}
#header{height:32px;position:fixed;top:0;width:100%;background-image: -webkit-gradient(linear,left bottom,left top,color-stop(0, rgb(19,19,19)),color-stop(1, rgb(76,76,76)));background-image: -moz-linear-gradient(center bottom,rgb(19,19,19) 0%,rgb(76,76,76) 100%);}
#header h1{display:inline-block;font-size:20px;font-weight:900;letter-spacing:-1px;padding-left:20px}
#header h1 a{text-decoration:none}
#toolbar{display:inline}
#toolbar label{font-size:12px;margin-left:10px}
#toolbar input[type=text]{background-image:0 0 100%;border:1px solid #333;color:#000;font-size:13px;padding:2px 5px;width:50px}
#toolbar input[type=text].long{width:100px}
#toolbar input[type=submit]{font-weight:900;margin-left:20px;width:200px}
#canvas{background:#000;margin-top:28px;padding:20px 20px 50px;text-align:center}
#canvas img{border:10px solid #333;margin:10px}
#canvas img:hover{box-shadow:0 2px 4px #666}
.button{background:#A8C6ED;border:none;border-radius:5px;color:#000;font-size:14px;font-weight:900;padding:5px 10px}
a.button{cursor:pointer;display:block;margin:0 auto;text-decoration:none;width:33%}
#toolbar a.button{display:inline;font-size:12px;font-weight:100;margin-left:10px;padding:2px 10px}
#footer{color:#999;font-size:12px;padding:20px;text-align:center}
#footer a{color:#666;text-decoration:none}
.twitter-count-horizontal{position:fixed;right:0;top:5px}
</style>
</head>
<body>

<div id="wrap">
	<div id="header">
		<h1><a href="<?=APP_URL?>" title="<?=APP_TITLE?> - <?=APP_SLOGAN?>"><span class="blue">flick</span><span class="pink">sourcer</span></a></h1>
	<div id="toolbar">
		<label for="w">Width:</label> <input type="text" id="w" placeholder="width" value="350" /> 
		<label for="h">Height:</label> <input type="text" id="h" placeholder="height" value="150" /> 
		<label for="k">Keywords:</label> <input type="text" id="k" placeholder="keywords" class="long" value="<?=$_GET['q'];?>" /> 
		<label for="n">Quantity:</label> <input type="text" id="n" placeholder="Quantity" value="20" /> 
		<input type="submit" id="go" value="Generate" />
		<a id="toggleback" class="button">Toggle background</a> <a href="http://twitter.com/share" class="twitter-share-button" data-url="http://xaviesteve.com/pro/flicksourcer/" data-text="Check out this revolutionary Creative Commons image Search Tool" data-count="horizontal" data-via="xaviesteve">Tweet</a>
	</div>
</div>		
		
<div id="canvas"></div>

<p id="footer">
<a href="#" id="more" class="button">Show 10 more images</a><br>
All images are licensed under Creative Commons Attributive Share-Alike<br>
<a href="<?=APP_URL?>"><?=APP_TITLE?></a> created by <a href="http://xaviesteve.com/">Xavi</a> powered by <a href="http://flickholdr.com/">flickholdr</a> by <a href="http://jfoucher.com">Jonathan</a></p>	
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript">
<?php if($_GET['debug']=="yeah") { ?>
	$(document).ready(function() {
		generate = function() {
			$('#canvas').empty();
			if ($('#n').val()>100){$('#n').val(100);}
			for (i=1;i<=$('#n').val();i++) {
				$('#k').val( $('#k').val().replace(" ", ",") );
				$('#k').val( $('#k').val().replace("/", ",") );
				$('#k').val( $('#k').val().replace("+", ",") );
				title = 'http://flickholdr.com/'+$('#w').val()+'/'+$('#h').val()+'/'+$('#k').val()+'/'+i+'';
				$('#canvas').append('<img src="'+title+'" width="'+$('#w').val()+'" height="'+$('#h').val()+'" />');
			}
		}
		
		$('#n').val(20);
		generate();
		
		$('#go').click(function() {
			generate();
		});
		
		$('#more').click(function(){
			$('#n').val( parseInt($('#n').val())+10 );
			generate();
			return false;
		});
	});
	
	$('input').keyup(function(e){if(e.keyCode==13){generate();}});

	$('#toggleback').toggle(function() {
		$('html').css('background','#eee');
		$('#canvas').css('background','#fff');
		$('#canvas>img').css('border-color','#eee');
	},function() {
		$('html').css('background','#000');
		$('#canvas').css('background','#000');
		$('#canvas>img').css('border-color','#333');
	});
<?php }else{ ?>
$(document).ready(function(){generate = function(){$('#canvas').empty();if($('#n').val()>100){$('#n').val(100);}
for(i=1;i<=$('#n').val();i++){$('#k').val($('#k').val().replace(" ",","));$('#k').val($('#k').val().replace("/",","));$('#k').val($('#k').val().replace("+",","));title='http://flickholdr.com/'+$('#w').val()+'/'+$('#h').val()+'/'+$('#k').val()+'/'+i+'';$('#canvas').append('<img src="'+title+'" width="'+$('#w').val()+'" height="'+$('#h').val()+'" />');}}
$('#n').val(20);generate();$('#go').click(function(){generate();});$('#more').click(function(){$('#n').val(parseInt($('#n').val())+10);generate();return false;});});$('input').keyup(function(e){if(e.keyCode==13){generate();}});$('#toggleback').toggle(function(){$('html').css('background','#eee');$('#canvas').css('background','#fff');$('#canvas>img').css('border-color','#eee');},function(){$('html').css('background','#000');$('#canvas').css('background','#000');$('#canvas>img').css('border-color','#333');});var _gaq=_gaq||[];_gaq.push(['_setAccount','UA-1815428-14']);_gaq.push(['_trackPageview']);(function(){var ga=document.createElement('script');ga.type='text/javascript';ga.async=true;ga.src=('https:'==document.location.protocol?'https://ssl':'http://www')+'.google-analytics.com/ga.js';var s=document.getElementsByTagName('script')[0];s.parentNode.insertBefore(ga,s);})();
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-1815428-14']);
_gaq.push(['_trackPageview']);
(function() {
	var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
<?php } ?>
</script><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></body></html><?php
$benchmark_totaltime = time()+microtime() - $benchmark_time;
