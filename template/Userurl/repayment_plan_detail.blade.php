<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>还款详情</title>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link href="/static/css/mui.min.css" rel="stylesheet" />
		<link href="/static/css/iconfont.css" rel="stylesheet" />
		<link href="/static/css/base.css" rel="stylesheet" />
		<link href="/static/css/page.css" rel="stylesheet" />
		<link href="/static/css/themes.css" rel="stylesheet"/>
	</head>
	<body>
		<div class="mui-content repayment-detail">
			<!--还款详情头部-->
			<div class="wrap bg-w">
			  <div class="dis-flex-be bor-bot">
			    <div class="dis-flex">
			      <p class="invalid-color f16">还款总金额(元)</p>
			      <p class="f24 space-up3 space-bot"><strong>{{$generation['generation_total']}}</strong></p>
			    </div>
			    <div class="dis-flex fc">
			      <p class="invalid-color f16">还款笔数</p>
			      <p class="f24 space-up3 space-bot"><strong>{{$count}}</strong></p>
			    </div>
			  </div>
			  <div>
				<p class="space-up2 f16">
				  <span class="invalid-color">还款日期为:</span>
				  <span class="blue-color-th">{{$generation['generation_start']}}—{{$generation['generation_end']}}</span>
				</p>
				<p class="invalid-color space-up3 f16">订单号：{{$generation['generation_no']}}</p>
				<p class="invalid-color space-up3 f16">银行卡：{{$generation['card_bankname']}}({{$generation['generation_card']}})</p>
			  </div>
			</div>
			<!--还款详情列表-->
			<ul>

				@foreach($order as $list)
				<li class="bg-w wrap2 space-up2">
				<!-- 还款详情列表头 -->
					<div class="dis-flex-be wrap-bt bor-bot">
					  <p>
						<span class="iconfont icon-jihua blue-color-th f16"></span>
				        <span class="blue-color-th f14">{{$list['time']}}</span>
				       </p>
				       <p class="invalid-color f-tex-l f14"><span>还款:{{$list['huan_money']}}元</span><span class="space-lr">|</span><span>消费:{{$list['pay_money']}}元</span></p>
					</div>
					<!-- 还款成功 -->
					<div class="dis-flex-be wrap-bt bor-bot">
						<p class="f15">
							<span class="my-badge-success">消费</span>
							<span class="invalid-color space-lr2">{{$list['pay']['time']}}</span>
							<span><strong>{{$list['pay']['order_money']}}元</strong></span>
						</p>
						<p class="f16 green-color2">
					  	  <span>还款成功</span>
						  <span class="iconfont icon-successful f20 v-m"></span>
				        </p>
					</div>
					@if($list['huan']['order_status']==1)
					<!-- 还款 -->
					<div class="dis-flex-be wrap-bt bor-bot">
						<p class="f15">
							<span class="my-badge-inpro">还款</span>
							<span class="invalid-color space-lr2">{{$list['huan']['time']}}</span>
							<span><strong>{{$list['huan']['order_money']}}元</strong></span>
						</p>
						<p class="f16 yellow-color">
						  <span class="">还款中</span>
						  <span class="iconfont icon-shijian-copy-copy f20 v-m"></span>
				        </p>
					</div>
					@elseif($list['huan']['order_status']==-1)
					<!-- 还款失败 -->
					<div class="dis-flex-be wrap-bt bor-bot">
						<p class="f15">
							<span class="my-badge-err">还款</span>
							<span class="invalid-color space-lr2">{{$list['huan']['time']}}</span>
							<span><strong>{{$list['huan']['order_money']}}元</strong></span>
						</p>
						<p class="f16 red-color">
						  <span class="">还款失败</span>
						  <span class="iconfont icon-zhifuyouwenti f20 v-m"></span>
				        </p>
					</div>
					@elseif($list['huan']['order_status']==2)
					<!-- 取消还款 -->
					<div class="dis-flex-be wrap-bt bor-bot">
						<p class="f15">
							<span class="my-badge-success">还款</span>
							<span class="invalid-color space-lr2">{{$list['huan']['time']}}</span>
							<span><strong>{{$list['huan']['order_money']}}元</strong></span>
						</p>
						<p class="f16 green-color2">
						  <span>取消还款</span>
						  <span class="iconfont icon-quxiao f20 v-m"></span>
				        </p>
					</div>
					@endif

				</li>

		@endforeach

			</ul>
		</div>
		<script src="/static/js/mui.min.js"></script>
		<script type="text/javascript">
			mui.init();
		</script>
	</body>

</html>