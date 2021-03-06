 <!--dialog Title-->
 <div class="modal-header animated fadeInLeft">
	 <div class="row">
        	 <div class="col-sm-8"><h4>订单信息展示</h4></div>
        	 <div class="col-sm-4">
            	 <div class="text-right">
	                 <span class="label label-dot label-primary"></span>
	                 <span class="label label-dot label-success"></span>
	                 <span class="label label-dot label-info"></span>
	                 <span class="label label-dot label-warning"></span>
	                 <span class="label label-dot label-danger"></span>
            	 </div>
        	 </div>
    	 </div>
    	 <div class="help-block"></div>
 </div>

 <!--dialog Content-->
 <div class="modal-content animated fadeInLeft">
	 <form action="" method="post" class="form-group" id="myform">
	 <input type="hidden" name="id" value="">
	 <div class="help-block"><code>(基本信息)</code></div>
	 <table class="table table-bordered table-hover table-striped" style="width:90%; margin:0 auto;">
		 <tr>
			 <th>订单号</th>	
			 <td>{{$order_info->upgrade_no}}</td>	
			 <th>用户</th>	
			 <td>{{$order_info->member_nick}}</td>	
			 <th>用户头像</th>	
			 <th><img src="{{$order_info->member_image}}"  data-toggle="lightbox" style="border-radius: 50%; width:150px"></th>	
		 </tr>	
	 </table>

	 <div class="help-block"><code>(分成信息)</code></div>
	 <table class="table table-bordered table-hover table-striped" style="width:90%; margin:0 auto;">
		 <tr>
			 <th>手机号码</th>
			 <td>{{$order_info->member_mobile}}</td>
			 <th>升级前用户组</th>
			 <td>{{$front_group->group_name}}</td>
			 <th>升级后用户组</th>
			 <td>{{$after_group->group_name}}</td>
			 <th>升级流水号</th>
			 <td>{{$order_info->upgrade_no}}</td>
			 <th>升级金额</th>
			 <td>{{$order_info->upgrade_money}}</td>
		 </tr>
		 
	 </table>

	 <div class="help-block"><code>(其他信息)</code></div>
	 <table class="table table-bordered table-hover table-striped" style="width:90%; margin:0 auto;">
		 <tr>
			 <th>分佣金额</th>
			 <td>{{$order_info->upgrade_commission}}</td>
			 <th>支付状态</th>
			 <td>@if($order_info->upgrade_state == 0) 未支付 @else 已支付 @endif</td>
			  <th>订单备注</th>
			 <td>{{$order_info->upgrade_bak}}</td>
		 </tr>
	 </table>

	 </form>
 </div>

 <!--dialog Button-->
 <div class="modal-footer animated fadeInLeft">
	<!--  <button type="button" class="btn btn-primary save">保存</button>-->
      <button type="button" class="btn" data-dismiss="modal">关闭</button> 
 </div>
 <script>
	 $(".save").click(function(){
		 $("#myform").submit()
	 })
 </script>