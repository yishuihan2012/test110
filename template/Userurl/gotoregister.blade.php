<!doctype html>
<html class="bg-w">
	<head>
		<meta charset="UTF-8">
		<title>分享注册链接</title>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link href="/static/css/mui.min.css" rel="stylesheet" />
		<link href="/static/css/iconfont.css" rel="stylesheet" />
		<link href="/static/css/base.css" rel="stylesheet" />
		<link href="/static/css/themes.css" rel="stylesheet" />
		<link href="/static/css/page.css" rel="stylesheet" />
	</head>
	<body>
		<div class="mui-content bg-w" >
		    <div class="exc-code2" id="shareLink">
			  <img src="{{$share_thumb}}">
			  <a class="my-btn-r f16" href="{{$url}}" id="shareCode">立即注册</a>
			</div>
		</div>
		<script src="/static/js/mui.min.js"></script>
		<script type="text/javascript">
	      var u = navigator.userAgent;
	      var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Adr') > -1; //android终端
	      var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端
			mui.init();
			mui.ready(function(){
				var _h =  window.screen.availHeight;
				document.getElementById("shareLink").style.height = _h - 150 +"px";
				//分享二维码
			});
		</script>
	</body>

</html>