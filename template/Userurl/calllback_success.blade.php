<!doctype html>
<html class="bg-w">
	<head>
		<meta charset="UTF-8">
		<title>还款计划详情</title>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link href="/static/css/mui.min.css" rel="stylesheet" />
		<link href="/static/css/iconfont.css" rel="stylesheet" />
		<link href="/static/css/base.css" rel="stylesheet" />
		<link href="/static/css/page.css" rel="stylesheet" />
		<link href="/static/css/themes.css" rel="stylesheet" />
	</head>
	<body>
		<div class="mui-content bg-w repay-suc">
			<div class="fc">
		    	<span class="mui-icon iconfont icon-successful f48"></span>
		    	<p class="space-up2">交易成功</p>
		    	<!-- <p class="space-up2 invalid-color">自助还款计划已设置成功</p>
		    	<p class="invalid-color">还款期间，请务必保持卡余额不变，</p>
		    	<p class="invalid-color">否则会影响还款成功率</p> -->
		    </div>
		    <div class="fc my-btn-container">
		    	<a class="my-btn-blue2 space-right2 f18" id="seeDetails">完成</a>
		    </div>
		</div>
		<script src="/static/js/mui.min.js"></script>
		<script type="text/javascript">
			mui.init();
			mui.ready(function(){
				document.getElementById('seeDetails').addEventListener('tap',function(){
					mui.openWindow({
						url:'repayment_history.html',
						id:'repayment_history'
					});
				});
			});
		</script>
	</body>

</html>