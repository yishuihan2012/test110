 <!--dialog Title-->
 <div class="modal-header animated fadeInLeft">
	 <div class="row">
        	 <div class="col-sm-8"><h4>新增通道</h4></div>
        	 <div class="col-sm-4">
            	 <div class="text-right">
                	 <span class="label label-dot"></span>
                	 <span class="label label-dot label-primary"></span>
                	 <span class="label label-dot label-success"></span>
                	 <span class="label label-dot label-info"></span>
                	 <span class="label label-dot label-warning"></span>
                	 <span class="label label-dot label-danger"></span>
            	 </div>
        	 </div>
    	 </div>
 </div>

 <!--dialog Content-->
 <div class="modal-content animated fadeInLeft">
	 <form action="{{url('/index/passageway/creat')}}" method="post" class="form-horizontal" id="myform">
	 <h2></h2>
	 <div class="row form-group">
		 <label for="passageway_name" class="col-sm-3 text-right"><b>通道名称:</b></label>
		 <div class="col-sm-6" id="passageway_name">
			 <input type="text" class="form-control passageway_name" name="passageway_name" placeholder="请填写通道的名称" value="">
		 </div>		
	 </div>
	 <div class="row form-group">
		 <label for="passageway_true_name" class="col-sm-3 text-right"><b>真实名称:</b></label>
		 <div class="col-sm-6" id="passageway_true_name">
			 <input type="text" class="form-control passageway_true_name" name="passageway_true_name" placeholder="APP不显示，用于后台确认是哪个通道" value="">
		 </div>		
	 </div>

	 <div class="row form-group">
		 <label for="passageway_status" class="col-sm-3 text-right"><b>是否必须入网:</b></label>
		 <div id="passageway_status" class="col-sm-6">
			 <select name="passageway_status" class="form-control passageway_status">
				 <option value="1">是</option>
				 <option value="0">否</option>
			 </select>
		 </div>		
	 </div>

	  <div class="row form-group">
		 <label for="passageway_no" class="col-sm-3 text-right"><b>平台约定刷卡费率:</b></label>
		 <div class="col-sm-6" id="passageway_no">
			 <input type="text" class="form-control passageway_no" name="passageway_rate" placeholder="请填写通道与平台约定的费率" value="">
		 </div>		
	 </div>

	 <div class="row form-group">
		 <label for="passageway_no" class="col-sm-3 text-right"><b>平台约定刷卡固定收益:</b></label>
		 <div class="col-sm-6" id="passageway_no">
			 <input type="text" class="form-control passageway_income" name="passageway_income" placeholder="请填写通道与平台约定的固定收益" value="">
		 </div>
	 </div>

	  <div class="row form-group">
		 <label for="passageway_no" class="col-sm-3 text-right"><b>平台约定代付费率:</b></label>
		 <div class="col-sm-6" id="passageway_no">
			 <input type="text" class="form-control passageway_rate" name="passageway_qf_rate" placeholder="请填写通道与平台约定的费率" value="">
		 </div>		
	 </div>

	  <div class="row form-group">
		 <label for="passageway_no" class="col-sm-3 text-right"><b>平台约定代付定额:</b></label>
		 <div class="col-sm-6" id="passageway_no">
			 <input type="text" class="form-control passageway_rate" name="passageway_qf_fix" placeholder="请填写通道与平台约定的费率" value="">
		 </div>		
	 </div>
	  <div class="row form-group">
		 <label for="passageway_method" class="col-sm-3 text-right"><b>入网调用方法地址:</b></label>
		 <div class="col-sm-6" id="passageway_method">
			 <input type="text" class="form-control passageway_method" name="passageway_method" placeholder="请填写通道的入网调用方法地址" value="">
		 </div>		
	 </div>

	 <div class="row form-group">
		 <label for="passageway_mech" class="col-sm-3 text-right"><b>通道机构号:</b></label>
		 <div class="col-sm-6" id="passageway_mech">
			 <input type="text" class="form-control passageway_mech" name="passageway_mech" placeholder="请填写通道的机构号" value="">
		 </div>		
	 </div>

	 <div class="row form-group">
		 <label for="passageway_key" class="col-sm-3 text-right"><b>通道机构KEY:</b></label>
		 <div class="col-sm-6" id="passageway_key">
			 <input type="text" class="form-control passageway_key" name="passageway_key" placeholder="请填写通道的机构KEY" value="">
		 </div>		
	 </div>
	  <div class="row form-group">
		 <label for="passageway_pwd_key" class="col-sm-3 text-right"><b>加密KEY（passageway_pwd_key）:</b></label>
		 <div class="col-sm-6" id="passageway_pwd_key">
			 <input type="text" class="form-control passageway_pwd_key" name="passageway_pwd_key" placeholder="加密KEY（passageway_pwd_key）" value="">
		 </div>		
	 </div>

	 <div class="row form-group">
		 <label for="passageway_also" class="col-sm-3 text-right"><b>是代还还是快捷支付:</b></label>
		 <div id="passageway_also" class="col-sm-6">
			 <select name="passageway_also" class="form-control passageway_also">
				 <option value="1">快捷支付</option>
				 <option value="2">代还</option>
			 </select>
		 </div>		
	 </div>
	 <div class="row form-group">
		 <label for="passageway_rate" class="col-sm-3 text-right"><b>是否提现通道:</b></label>
		 <div id="passageway_rate" class="col-sm-6">
			 <select name="passageway_rate" class="form-control passageway_rate">
				 <option value="1">是</option>
				 <option value="2">否</option>
			 </select>
		 </div>		
	 </div>
	 <div class="row form-group">
		 <label for="iv" class="col-sm-3 text-right"><b>加密偏移量:</b></label>
		 <div class="col-sm-6" id="iv">
			 <input type="text" class="form-control iv" name="iv" placeholder="请填加密偏移量" value="">
		 </div>		
	 </div>
	  <div class="row form-group">
		 <label for="secretkey" class="col-sm-3 text-right"><b>加密KEY（secretkey）:</b></label>
		 <div class="col-sm-6" id="secretkey">
			 <input type="text" class="form-control secretkey" name="secretkey" placeholder="请填写通道的机构KEY" value="">
		 </div>		
	 </div>
	 <div class="row form-group">
		 <label for="secretkey" class="col-sm-3 text-right"><b>签名KEY:</b></label>
		 <div class="col-sm-6" id="secretkey">
			 <input type="text" class="form-control secretkey" name="secretkey" placeholder="请填加密KEY（secretkey）" value="">
		 </div>		
	 </div>
	 <div class="row form-group">
		 <label for="passageway_desc" class="col-sm-3 text-right"><b>通道描述:</b></label>
		 <div class="col-sm-6" id="passageway_desc">
			 <textarea name="passageway_desc" class="form-control passageway_desc" ></textarea>
		 </div>		
	 </div>
	 <div class="row form-group">
		 <label for="passageway_limit" class="col-sm-3 text-right"><b>额度说明:</b></label>
		 <div class="col-sm-6" id="passageway_limit">
			 <textarea name="passageway_limit" class="form-control passageway_limit" ></textarea>
		 </div>		
	 </div>

	 <!-- <div class="row form-group">
		 <label for="passageway_avatar" class="col-sm-3 text-right"><b>通道图标:</b></label>
		 <div id="passageway_avatar" class="col-sm-6">
			 <div id='uploaderExample3' class="uploader">
			 	 <div class="uploader-message text-center">
			    	 	 <div class="content"></div>
			    		 <button type="button" class="close">×</button>
			  	 </div>
			  	 <div class="uploader-files file-list file-list-grid"></div>
			 	 <div>
			 	 	 <hr class="divider">
			 	 	 <div class="uploader-status pull-right text-muted"></div>
			 	 	 <button type="button" class="btn btn-link uploader-btn-browse"><i class="icon icon-plus"></i> 选择文件</button>
			 	 	 <button type="button" class="btn btn-link uploader-btn-start"><i class="icon icon-cloud-upload"></i> 开始上传</button>
			 	 </div>
			 </div>
			 <input type="hidden" class="form-control passageway_avatar" name="passageway_avatar" value="">
		 </div>		
	 </div> -->

	 <div class="row form-group">
		 <label for="passageway_state" class="col-sm-3 text-right"><b>状态:</b></label>
		 <div id="passageway_state" class="col-sm-6">
			 <select name="passageway_state" class="form-control">
				 <option value="1">正常</option>
				 <option value="0">停用</option>
			 </select>
		 </div>		
	 </div>

	 <h2></h2>
	 </form>
</div>

 <!--dialog Button-->
 <div class="modal-footer animated fadeInLeft">
	 <button type="button" class="btn btn-primary save">保存</button>
      <button type="button" class="btn" data-dismiss="modal">关闭</button>
 </div>

 <script>
 $(".save").click(function(){	
	if(!$(".passageway_name").val()){
		 $(".passageway_name").parent().addClass("has-error");
		 return;
	 }

	 	if(!$(".passageway_no").val()){
		 	$(".passageway_no").parent().addClass("has-error");
			 return;
		 }


	 $("#myform").submit()
 })
 //上传文件设置
 $('#uploaderExample3').uploader({
      url: "{{url('/index/Tool/upload_one')}}",
	 file_data_name:'bank',
	 filters:{ max_file_size: '10mb',},
	 limitFilesCount:1,
	 onFileUploaded(file, responseObject) {
	    	 var attr=eval('('+responseObject.response+")");
	    	 attr.code ? $("input[name=passageway_avatar]").val(attr.url) : bootbox.alert({ message: attr.msg, size: 'small' });
	 }
 });
</script>