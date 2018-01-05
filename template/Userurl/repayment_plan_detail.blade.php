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
			      <p class="invalid-color f16">还款总金额(含手续费{{$order_pound}})</p>
			      <p class="f24 space-up3 space-bot"><strong>{{$generation['generation_total']+$order_pound}}</strong></p>
			    </div>
			    <div class="dis-flex fc">
			      <p class="invalid-color f16">消费笔数</p>
			      <p class="f24 space-up3 space-bot"><strong>{{$generation['generation_count']}}</strong></p>
			    </div>
			  </div>
			  <div>
				<p class="space-up2 f16">
				  <span class="invalid-color">还款日期为:</span>
				  <span class="blue-color-th">{{date('m月d日',strtotime($generation['generation_start']))}}-{{date('m月d日',strtotime($generation['generation_end']))}}</span>
				</p>
				<p class="invalid-color space-up3 f16">订单号：{{$generation['generation_no']}}</p>
				<p class="invalid-color space-up3 f16">银行卡：{{$generation['card_bankname']}}({{substr($generation['generation_card'], -4)}})</p>
			  </div>
			</div>
			<!--还款详情列表-->
			<ul>

				@foreach($order as $key=>$list)
				<li class="bg-w wrap2 space-up2">
				<!-- 还款详情列表头 -->
					<div class="dis-flex-be wrap-bt bor-bot">
					  <p>
						<span class="iconfont icon-jihua blue-color-th f16"></span>
				        <span class="blue-color-th f14">{{$key}}</span>
				       </p>
				       <p class="invalid-color f-tex-l f14"><span>还款:{{$list['get']}}元</span><span class="space-lr">|</span><span>消费:{{$list['pay']}}元</span></p>
					</div>
					@foreach($list as $v)
						 
						@if($v['order_status']==1)
						<!-- 还款 -->
						<div class="dis-flex-be wrap-bt bor-bot">
							<p class="f15">
								@if($v['order_type']==1)
								<span class="my-badge-inpro">消费</span>
								@elseif($v['order_type']==2)
								<span class="my-badge-success">还款</span>
								@endif
								<span class="invalid-color space-lr2">{{date('H:i',strtotime($v['order_time']))}}</span>
								<span><strong>{{$v['order_money']}}元</strong></span>
							</p>
							<p class="f16 yellow-color">
							  <span class="">进行中</span>
							  <span class="iconfont icon-shijian-copy-copy f20 v-m"></span>
					        </p>
						</div>
						@elseif($v['order_status']==-1)
						<!-- 还款失败 -->
						<div class="dis-flex-be wrap-bt bor-bot">
							<p class="f15">
								@if($v['order_type']==1)
								<span class="my-badge-inpro">消费</span>
								@elseif($v['order_type']==2)
								<span class="my-badge-success">还款</span>
								@endif
								<span class="invalid-color space-lr2">{{date('H:i',strtotime($v['order_time']))}}</span>
								<span><strong>{{$v['order_money']}}元</strong></span>
							</p>
							<p class="f16 red-color">
							  <span class="">执行失败</span>
							  <span class="iconfont icon-zhifuyouwenti f20 v-m"></span>
					        </p>
 					</div>
						@elseif($v['order_status']==2)
						<!-- 取消还款 -->
						<div class="dis-flex-be wrap-bt bor-bot">
							<p class="f15">
								@if($v['order_type']==1)
								<span class="my-badge-inpro">消费</span>
								@elseif($v['order_type']==2)
								<span class="my-badge-success">还款</span>
								@endif
								<span class="invalid-color space-lr2">{{date('H:i',strtotime($v['order_time']))}}</span>
								<span><strong>{{$v['order_money']}}元</strong></span>
							</p>
							<p class="f16 green-color2">
							  <span>执行成功</span>
							  <span class="iconfont icon-successful f20 v-m"></span>
					        </p>
						</div>
						@elseif($v['order_status']==3)
						<div class="dis-flex-be wrap-bt bor-bot">
							<p class="f15">
								@if($v['order_type']==1)
								<span class="my-badge-cancel  green">消费</span>
								@elseif($v['order_type']==2)
								<span class="my-badge-cancel">还款</span>
								@endif
								<span class="invalid-color space-lr2">{{date('H:i',strtotime($v['order_time']))}}</span>
								<span><strong>{{$v['order_money']}}元</strong></span>
							</p>
							<p class="f16 red-color2">
							  <span>取消计划</span>
							  <span class="iconfont icon-quxiao f20 v-m"></span>
					        </p>
						</div>
						@endif
					@endforeach
					
				</li>
		@endforeach

			</ul>
		</div>
		<script src="/static/js/mui.min.js"></script>
		<script type="text/javascript">
			mui.init();
		</script>
	</body>
<style type="text/css">
	.green{
		color: green;
	}
</style>
</html>