@extends('admin/layout/layout_main')
@section('title','订单列表管理~')
@section('wrapper')
<style>
	 h4 > a,.pull-right > a{color:#145ccd;}
</style>

<section>
<hr/>
<div class="list">
  <header>
    <h3><i class="icon-list-ul"></i> 订单列表 <small>共 <strong class="text-danger">{{$count['count_size']}}</strong> 条</small></h3>
  </header>
   <form action="" method="post">
    <div class="input-group" style="width: 200px;float: left;margin-right: 20px;">
    <span class="input-group-addon">名称</span>
    <input type="text" class="form-control" name="member_nick" value="{{$r['member_nick']}}" placeholder="名称">
  </div>

  <div class="input-group" style="width: 200px;float: left;margin-right: 20px;">
    <span class="input-group-addon">手机号</span>
    <input type="text" class="form-control" name="member_mobile" value="{{$r['member_mobile']}}" placeholder="手机号">
  </div>
  <div class="input-group" style="width: 180px;float: left;margin-right: 10px;">
    <span class="input-group-addon">身份号</span>
    <input type="text" class="form-control" name="cert_member_idcard" value="{{$r['member_nick']}}" placeholder="身份号">
  </div>
  <div class="input-group" style="width: 150px;float: left;margin-right: 10px;">
     <span class="input-group-addon">实名状态</span>
  <select name="member_cert" class="form-control">
    <option value="" >全部</option>
    <option value="1" @if($r['member_cert']==1) selected @endif>已认证</option>
    <option value="2" @if($r['member_cert']==2) selected @endif>未认证</option>
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
    <input type="text" class="form-control date-picker" id="dateTimeRange" placeholder="注册时间查询" />
    <input type="hidden" name="beginTime" id="beginTime" value="" />
    <input type="hidden" name="endTime" id="endTime" value="" />
    <z class='clearTime'>X</z>
</div>
  <button class="btn btn-primary" type="submit">搜索</button>
</form>
  <div class="items items-hover">
      <!-- HTML 代码 -->
          <table class="table datatable">
           <thead>
                 <tr>
                 <!-- 以下两列左侧固定 -->
                      <th>#</th>
                      <th>订单号</th>
                      <th>用户</th>
                      <th>订单类型</th>
                      <th class="flex-col">订单总金额</th>
                      <th class="flex-col">实际金额</th> 
                      <th class="flex-col">手续费</th> 
                      <th>订单状态</th>
                      <th>创建时间</th>
                      <th>操作</th>
                 </tr>
      </thead>
      <tbody>
           @foreach ($order_lists as $list)
           <tr>
                 <td>{{$list->order_id}}</td>
                 <td><code>{{$list->order_no}}</code></td>
                 <td>{{$list->member_nick}}</td>
                 <td>@if($list->order_type==1)套现@else代还@endif</td>

                 <td>{{$list->order_money}}</td>

                 <td>{{$list->order_pracmoney}}</td>
                 <td>{{$list->order_charge}}</td>
                 <td>@if($list->order_state==1)成功@elseif($list->order_state==-1)失败@else待审核@endif</td>
                 <td>{{$list->order_add_time}}</td>
                 <td>
                      <div class="btn-group">
                           <button type="button" data-toggle="modal" data-remote="{{url('/index/order/edit/id/'.$list->order_id)}}" class="btn btn-default btn-sm">详细信息</button>
                      </div>
                 </td>
           </tr>
           @endforeach
      </tbody>
</table>
  </div>
  {!! $order_lists->render() !!}
</div>
</section>
<script>
  $(document).ready(function(){
       $('.menu .nav .active').removeClass('active');
       $('.menu .nav li.order').addClass('active');
       $('.menu .nav li.order-manager').addClass('show');
 })
</script>
@endsection
