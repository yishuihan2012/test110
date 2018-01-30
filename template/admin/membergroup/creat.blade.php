<!--dialog Title-->
<link rel="stylesheet" href="/static/css/jquery-labelauty.css">
<style>
input.labelauty + label > span.labelauty-unchecked-image
{
	background-image: url( /static/images/input-unchecked.png );
}

input.labelauty + label > span.labelauty-checked-image
{
	background-image: url( /static/images/input-checked.png );
}
.dowebok {padding-left: 3px;}
.dowebok ul { list-style-type: none;}
.dowebok li { display: inline-block;}
.dowebok li { margin: 5px 3px 3px 0px;}
.dowebok label{margin-bottom: 0}
input.labelauty + label { font: 12px "Microsoft Yahei";}
</style>
<div class="modal-header animated fadeInLeft">
	<div class="row">
        <div class="col-sm-8"><h4>新增会员用户组</h4></div>
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

	<h2></h2>
	<form action="{{url('/index/member_group/group_creat')}} " method="post" class="form-horizontal" id="myform">

		<div class="row form-group">
			<label for="group_name" class="col-sm-2 text-right"><b>用户组名:</b></label>
			<div id="group_name" class="col-sm-6">
				<input type="text" class="form-control group_name" name="group_name" placeholder="请填写用户组名称" value="">
			</div>
		</div>

		<div class="row">
			<label for="group_salt" class="col-sm-2 text-right"><b>组 级 别:</b></label>
			<div id="group_salt" class="col-sm-6"><input type="number" class="form-control group_salt group_name" name="group_salt" value=""></div>
		</div>

		<br/>
		<div class="row">
			<label for="group_salt" class="col-sm-2 text-right"><b>升级方式:</b></label>
			<div id="group_salt" class="col-sm-6">
				 <select name="group_level_type" class="group_name form-control group_level_type">
				<option value="-1">不限</option>
				<option value="1">推荐人</option>
				<option value="2">刷卡量</option>
				<option value="3">付费升级</option>
			</select>
			</div>
		</div>
		<br/>
		<div class="row">
			<label for="group_salt" class="col-sm-2 text-right"><b>升级条件-推荐人数量:</b></label>
			<div id="group_salt" class="col-sm-6"><input type="number" class="form-control group_salt  " name="group_level_invite" value="" placeholder="">
			</div>
		</div>
		<br/>
		<div class="row">
			<label for="group_salt" class="col-sm-2 text-right"><b>升级条件-刷卡量:</b></label>
			<div id="group_salt" class="col-sm-6"><input type="number" class="form-control group_salt  " name="group_level_transact" value="" placeholder="">
			</div>
		</div>
		<br/>
		<div class="row">
			<label for="group_salt" class="col-sm-2 text-right"><b>升级条件-付费金额:</b></label>
			<div id="group_salt" class="col-sm-6"><input type="number" class="form-control group_salt  " name="group_level_money" value="" placeholder="">
			</div>
		</div>
		<!-- <br/>
		<div class="row">
			<label for="group_salt" class="col-sm-2 text-right"><b>运营商专用</b></label>
			<div id="group_salt" class="col-sm-6">
			 <select name="group_visible" class="group_name form-control group_visible">
				<option value="1">否</option>
				<option value="0">是</option>
			</select>
			</div>
		</div> -->
		<br/>
		<div class="row">
			<label for="group_salt" class="col-sm-2 text-right"><b>是否能分佣</b></label>
			<div id="group_salt" class="col-sm-6">
			 <select name="group_cent" class="group_name form-control group_visible">
				<option value="1">是</option>
				<option value="0">否</option>
			</select>
			</div>
		</div>
		<br/>
		<div class="row">
			<label for="group_salt" class="col-sm-2 text-right"><b>是否能分润</b></label>
			<div id="group_salt" class="col-sm-6">
			 <select name="group_run" class="group_name form-control group_visible">
				<option value="1">是</option>
				<option value="0">否</option>
			</select>
			</div>
		</div>
		<br/>
		<div class="row form-group">
			<label for="group_name" class="col-sm-2 text-right"><b>直接推荐人分佣金额:</b></label>
			<div id="group_level_value" class="col-sm-6">
				<input type="text" class="form-control group_level_value" name="group_direct_cent" placeholder="" value="">
			</div>
		</div>
		<div class="row form-group">
			<label for="group_name" class="col-sm-2 text-right"><b>二级推荐人分佣金额:</b></label>
			<div id="group_level_value" class="col-sm-6">
				<input type="text" class="form-control group_level_value" name="group_second_level_cent" placeholder="" value="">
			</div>
		</div>
		<div class="row form-group">
			<label for="group_name" class="col-sm-2 text-right"><b>三级推荐人分佣金额:</b></label>
			<div id="group_level_value" class="col-sm-6">
				<input type="text" class="form-control group_level_value" name="group_three_cent" placeholder="" value="">
			</div>
		</div>
		<h5></h5>

	</form>
	<h2></h2>
</div>

<!--dialog Button-->
<div class="modal-footer animated fadeInLeft">
    <button type="button" class="btn" data-dismiss="modal">关闭</button>
    <button type="button" class="btn btn-primary save">保存</button>
</div>
<script src="/static/js/jquery-labelauty.js"></script>
<script>
$(".save").click(function(){
	if(!$(".group_name").val()){
		$(".group_name").parent().addClass("has-error");
		return;
	}
	$("#myform").submit()
})
$(function(){
	$(':input').labelauty();
});
</script>