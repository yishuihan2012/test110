<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>银联还款通道签约</title>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link href="/static/css/mui.min.css" rel="stylesheet" />
		<link href="/static/css/iconfont.css" rel="stylesheet" />
		<link href="/static/css/base.css" rel="stylesheet" />
		<link href="/static/css/page.css" rel="stylesheet" />
		<link href="/static/css/themes.css" rel="stylesheet"/>
	</head>
	<body>
		<!--<header class="wrap bg-blue dis-flex-be white-color">
	  	<span></span>
	  	<span>银联还款通道签约</span>
	  	<span></span>
	  </header>-->
  <div class="mui-content order-payment">
  	<div class="f16 normal-color wrap">
  		<img src="/static/images/unionpay.png" class="v-m space-right media-pic2">
  		<span>首次使用银联还款通道需签约，请确认您的信用卡信息无误，完成签约。</span>
  	</div>
  	<ul class="mui-table-view bg-color signed-list">
	    <li class="mui-table-view-cell bg-w bor-bot">
	    	姓名：<span class="poa-r invalid-color">{{$data['Members']['MemberCert']['cert_member_name']}}</span>
	    </li>
	    <li class="mui-table-view-cell bg-w bor-bot">
	    	身份证号：<span class="poa-r invalid-color">{{$data['Members']['MemberCert']['cert_member_idcard']}}</span>
	    </li>
	    <li class="mui-table-view-cell bg-w bor-bot">
	    	信用卡号：<span class="poa-r invalid-color">{{$data['MemberCreditcard']['card_bankno']}}</span>
	    </li>
	    <li class="mui-table-view-cell bg-w bor-bot">
	    	CVV2：<span class="poa-r invalid-color">{{$data['MemberCreditcard']['card_Ident']}}</span>
	    </li>
	    <li class="mui-table-view-cell bg-w bor-bot">
	    	有效期：<span class="poa-r invalid-color">{{$data['MemberCreditcard']['card_expireDate']}}</span>
	    </li>
	    <div class="bg-color wrap f14 normal-color">*若CVV2或有效期信息有误请返回"信用卡管理"进行修改</div>
	    <li class="mui-table-view-cell bg-w bor-bot">
	    	银行预留手机号：<span class="poa-r invalid-color">{{$data['MemberCreditcard']['card_phone']}}</span>
	    </li>
	    <li class="mui-table-view-cell bg-w">
	    	验证码：
	    	<input type="hidden" name="bindId" value="">
	    	<input type="text" placeholder="请输入验证码" value="" class="my-code" id="myCode002"/>
	    	<input type="button" class="code-btn2 mui-pull-right blue-color-th2" value="获取验证码" id="sendCode002">
	    </li>
	</ul>
  <div id="loading" class="loading-box hid-load">
    <img src='/static/images/loading.gif'/>
  </div>
  <input type="button" value="确认签约" class="my-confirm2 bg-blue2" id="confirmBtn002">
  </div>
		<script src="/static/js/mui.min.js"></script>
		<script src="/static/js/jquery-2.1.4.min.js"></script>
		<script type="text/javascript">
			mui.init();
			mui.ready(function(){
		  		// 发送验证码
		      var InterValObj; //timer变量，控制时间
		      var count = 60; //间隔函数，1秒执行
		      var curCount;//当前剩余秒数
		      $("#sendCode002").click(function(){
		        curCount = count;
		          //设置button效果，开始计时
		          $(".code-btn2").attr("disabled", "true");
		          $(".code-btn2").val("" + curCount + "秒");
		          InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
		          //向后台发送处理数据
		            var url = '/api/Membernet/mishua_income_new';
		            var data={
		          			'uid':"{{$data['MemberCreditcard']['card_member_id']}}",
					        // 'token': "{$data['Members']['memberLogin']['login_token']}",
					        'creditCardNo':"{{$data['MemberCreditcard']['card_bankno']}}",
					        'creditCardId':"{{$data['MemberCreditcard']['card_id']}}",
					        'phone':"{{$data['MemberCreditcard']['card_phone']}}",
					        'bank_name': "{{$data['MemberCreditcard']['card_bankname']}}",
					        'cvv':"{{$data['MemberCreditcard']['card_Ident']}}",
					        'expireDate':"{{$data['MemberCreditcard']['card_expireDate']}}",
					        'billDate': "{{$data['MemberCreditcard']['card_billDate']}}",
					        'deadline':"{{$data['MemberCreditcard']['card_deadline']}}",
					        "passageway_id":"{{$passageway_id}}",
					        'group_id':"{{$data['Members']['member_group_id']}}"
		          		};
		            $.post(url,data,function(data){
		            	 if(data.code==463){
		            	 	setTimeout(function(){ window.location.href="/api/Userurl/repayment_plan_create_detail/order_no/{{$order_no}}"; },1000);
		            	 }
		            	 if(data.code==200){
		            	 	 $('input[name="bindId"]').val(data.data.bindId);
		            	 }
		            	 mui.toast(data.msg); 
		             });
		          });
		      //timer处理函数
		      function SetRemainTime() {
		        if (curCount == 0) {
		          window.clearInterval(InterValObj);//停止计时器
		          $(".code-btn2").removeAttr("disabled");//启用按钮
		          $(".code-btn2").val("重新发送");
		        }
		        else {
		          curCount--;
		          $(".code-btn2").val("" + curCount + "秒");
		        }
		      }
		      $("#confirmBtn002").click(function(){
		      		 $("#confirmBtn002").attr("disabled", true); 
		      		var vcode = $("#myCode002").val();
		      		preg=/^\d{6}$/;
		      		if(!vcode || !preg.test(vcode)){
		      			mui.toast('请输入正确的验证码'); return;
		      		}
		      		var	bindId=$('input[name="bindId"]').val();
		      		if(!bindId){
		      			mui.toast('获取数据失败，请重新发送验证码'); return;
		      		}
		      		var url = '/api/Member_cert_card/addition_card_codes_new';
		            var data={
		          		action:'MemberCertCard',
		          		method:'addition_card_codes',
		          		param:{
		          			'uid':"{{$data['MemberCreditcard']['card_member_id']}}",
					        'token': "{{$data['Members']['memberLogin']['login_token']}}",
					        'bindId':$('input[name="bindId"]').val(),
					        'passageway_id':'{{$passageway_id}}',
					        'smsCode':vcode
		          		}
		          	};
		            $.post(url,data,function(data){

		            	if(data.msg){
		            		$("#confirmBtn002").attr("disabled", false); 
		            		mui.toast(data.msg);
		            	}else{
		            		$("#confirmBtn002").attr("disabled", false);
		            		mui.toast('签约失败。');
		            	}
		            	if(data.code==200){
		            	 	setTimeout(function(){ window.location.href="/api/Userurl/repayment_plan_create_detail/order_no/{{$order_no}}"; },1000);
		            	 	
		            	 }
		             });
		      });
		  	});
		</script>
	</body>

</html>