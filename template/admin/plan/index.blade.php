@extends('admin/layout/layout_main')
@section('title','还款计划~')
@section('wrapper')
<style>
	.text-ellipsis{cursor: pointer;}
</style>
<div class="panel">
  	<div class="panel-body">
  		<form action="" name="myform" class="form-group" method="get">

   <form action="" method="post">
    <div class="input-group" style="width: 150px;float: left;margin-right: 20px;">
    <span class="input-group-addon">还款会员</span>
    <input type="text" class="form-control" name="member_nick" value="{{$r['member_nick']}}" placeholder="还款会员" >
  </div>

  <div class="input-group" style="width: 200px;float: left;margin-right: 20px;">
    <span class="input-group-addon">手机号</span>
    <input type="text" class="form-control" name="member_mobile" value="{{$r['member_mobile']}}" placeholder="手机号">
  </div>
  <div class="input-group" style="width: 240px;float: left;margin-right: 10px;">
    <span class="input-group-addon">身份号</span>
    <input type="text" class="form-control" name="generation_card" value="{{$r['generation_card']}}" placeholder="身份号">
  </div>
  <div class="input-group" style="width: 150px;float: left;margin-right: 10px;">
     <span class="input-group-addon">计划状态</span>
  <select name="generation_state" class="form-control">
    <option value="" >全部</option>
    <option value="2" @if($r['generation_state']==2) selected @endif>还款中</option>
    <option value="3" @if($r['generation_state']==3) selected @endif>还款结束</option>
    <option value="-1" @if($r['generation_state']==-1) selected @endif>还款失败</option>
    <option value="4" @if($r['generation_state']==4) selected @endif>取消</option>
  </select>
 
  </div>
  <div class="input-group" style="width: 180px;float: left;margin-right: 10px;">
     <span class="input-group-addon">会员级别</span>
  <select name="member_group_id" class="form-control">
      <option value="" @if ($r['member_group_id']=='') selected="" @endif>全部</option>
    @foreach($member_group as $v)
      <option value="{{$v['group_id']}}" @if ($r['member_group_id']==$v['group_id']) selected @endif>{{$v['group_name']}}</option>
    @endforeach
  </select>
  </div>

<div class="input-group" style="width: 200px;float: left; margin-right: 10px;">
    <input type="text" class="form-control date-picker" id="dateTimeRange" placeholder="还款创建时间" />
    <input type="hidden" name="beginTime" id="beginTime" value="" />
    <input type="hidden" name="endTime" id="endTime" value="" />
    <z class='clearTime'>X</z>
</div>
  <button class="btn btn-primary" type="submit">搜索</button>
</form>


		</form>
  	</div>
</div>
<div class="list">
  <header>
    <h3>
        <i class="icon-list-ul"></i> 订单列表 <small>共 <strong class="text-danger">{{$count}}</strong> 条</small>
        <i class="icon icon-yen"></i> 还款总金额 <small>共 <strong class="text-danger">{{$sum}}</strong> 元</small>
        <i class="icon icon-yen"></i> 剩余还款总金额 <small>共 <strong class="text-danger">{{$surplussum}}</strong> 元</small>
    </h3>
  </header>

<table class="table table-striped table-hover">
  	<thead>
	    <tr>
	      	<th>还款会员</th>
	      	<th>还款会员手机号</th>
	      	<th>计划代号</th>
	      	<th>需还信用卡</th>
	      	<th>需还款总额</th>
	      	<th>还款次数</th>
	      	<th>已还款总额</th>
	      	<th>剩余总额</th>
	      	<th>手续费</th>
	      	<th>开始还款日期</th>
	      	<th>最后还款日期</th>
          <th>计划状态</th>
          <!-- <th>还款失败原因</th> -->
	      	<th>操作</th>
	      
	    </tr>
 	</thead>
  	<tbody>
  
	    
  	</tbody>
  	<tfoot>
  		@foreach($list as $k => $v)
	    <tr>
	    	
	      	<td>{{$v['member_nick']}}</td>
	      	<td>{{$v['member_mobile']}}</td>
	      	<td>{{$v['generation_no']}}</td>
	      	<td>{{$v['card_bankno']}}</td>
	      	<td>{{$v['generation_total']}}</td>
	      	<td>{{$v['generation_count']}}</td>
	      	<td>{{$v['generation_has']}}</td>
	      	<td>{{$v['generation_left']}}</td>
	      	<td>{{$v['generation_pound']}}</td>
	      	<td>{{$v['generation_start']}}</td>
          <td>{{$v['generation_end']}}</td>
	      	<td>@if($v['generation_state']==2) 还款中 @elseif($v['generation_state']==3)还款结束 @elseif($v['generation_state']==-1)还款失败 @else 取消 @endif</td>
	      	<!-- <td>{{$v['generation_desc']}}</td> -->
	      	<td><a class="btn btn-sm"  href="{{url('/index/Plan/info/id/'.$v['generation_id'])}}" >查看详情</a></td>
	    </tr>
	    	@endforeach
  	</tfoot>
</table>
{!!$list->render()!!}
<script type="text/javascript">
$(document).ready(function(){
    $('.menu .nav .active').removeClass('active');
    $('.menu .nav li.plan').addClass('active');
    $('.menu .nav li.plan-manager').addClass('show');
    $(".freezing").click(function(){
    	var id = $(this).attr('data-id');
    	var explain = $(this).attr('explain');
		bootbox.prompt({
		    title: "请输入要"+explain+"的原因",
		    inputType: 'text',
		    callback: function (result) {
		        if(result!=null){
		        	$.ajax({
		        		url : "{{url('/index/wallet/freezing')}}",
		        		data : {id:id,wallet_desc:result},
		        		type : 'POST',
		        		dataType : 'Json',
		        		success:function(data){
		    				explain+=data ? '成功' : '失败';
		    				type= data ? 'success' : 'error';
							new $.zui.Messager(explain, { type: type, close: true, }).show();
							window.location.reload();
		        		}
		        	})
		        }
		    }
		});
    })
});
$('#dateTimeRange').daterangepicker({
        applyClass : 'btn-sm btn-success',
        cancelClass : 'btn-sm btn-default',
        locale: {
            applyLabel: '确认',
            cancelLabel: '取消',
            fromLabel : '起始时间',
            toLabel : '结束时间',
            customRangeLabel : '自定义',
            firstDay : 1
        },
        ranges : {
            //'最近1小时': [moment().subtract('hours',1), moment()],
            '今日': [moment().startOf('day'), moment()],
            '昨日': [moment().subtract('days', 1).startOf('day'), moment().subtract('days', 1).endOf('day')],
            '最近7日': [moment().subtract('days', 6), moment()],
            '最近30日': [moment().subtract('days', 29), moment()],
            '本月': [moment().startOf("month"),moment().endOf("month")],
            '上个月': [moment().subtract(1,"month").startOf("month"),moment().subtract(1,"month").endOf("month")]
        },
        opens : 'left',    // 日期选择框的弹出位置
        separator : ' 至 ',
        showWeekNumbers : true,     // 是否显示第几周

 
        //timePicker: true,
        //timePickerIncrement : 10, // 时间的增量，单位为分钟
        //timePicker12Hour : false, // 是否使用12小时制来显示时间
 
         
        //maxDate : moment(),           // 最大时间
        format: 'YYYY-MM-DD'
 
    }, function(start, end, label) { // 格式化日期显示框
        $('#beginTime').val(start.format('YYYY-MM-DD'));
        $('#endTime').val(end.format('YYYY-MM-DD'));
    });
begin_end_time_clear();
$('.clearTime').click(begin_end_time_clear);
  //清除时间
    function begin_end_time_clear() {
        $('#dateTimeRange').val('');
        $('#beginTime').val('');
        $('#endTime').val('');
    }
</script>
<style type="text/css">
   .clearTime{
    position: absolute;
    right: 5px;
    top: 5px;
    z-index: 99;
    border: 1px solid;
    color: red;
    font-size: .6rem;
    padding: 0 5px;
   }
 </style>
<!---->
@endsection
