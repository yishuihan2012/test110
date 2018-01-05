<?php
/**
 *  @version Order controller / 订单控制器
 *  @author $bill$(755969423@qq.com)
 *   @datetime    2017-11-24 10:22:05
 *   @return 
 */
namespace app\index\controller;
use app\index\model\Order as Orders;
use app\index\model\Withdraw;
use app\index\model\CashOrder;
use app\index\model\Recomment;
use app\index\model\Member;
use app\index\model\MemberGroup;
use think\Controller;
use think\Request;
use think\Session;
use think\Config;
use think\Loader;

class Order extends Common{
	 #order列表
	 public function index()
	 {
	 	$r=request()->param();
	 	 #搜索条件
	 	$data = memberwhere($r);
	 	$r = $data['r'];
	 	$where = $data['where'];
	 	 //注册时间
		if(request()->param('beginTime') && request()->param('endTime')){
			$endTime=strtotime(request()->param('endTime'))+24*3600;
			$where['member_creat_time']=["between time",[request()->param('beginTime'),$endTime]];
		}
		#身份证查询
		$wheres = array();
		 if( request()->param('cert_member_idcard')){
			$wheres['m.cert_member_idcard'] = ['like',"%".request()->param('cert_member_idcard')."%"];
		}else{
			$r['cert_member_idcard'] = '';
		}
	 	 // #查询订单列表分页
	 	$order_lists = Orders::haswhere('member',$where)->join("wt_member_cert m", "m.cert_member_id=Member.member_id","left")->where($wheres)->field('wt_member.member_nick')->paginate(Config::get('page_size'),false, ['query'=>Request::instance()->param()]);
	 	 // dump(Orders::getLastsql());
	 	 #统计订单条数
	 	 $count['count_size']=Orders::haswhere('member',$where)->join("wt_member_cert m", "m.cert_member_id=Member.member_id","left")->where($wheres)->count();
		$this->assign('order_lists', $order_lists);
	    $this->assign('count', $count);
		 
		$this->assign('r', $r);
		 #获取用户分组
		$member_group=MemberGroup::all();
		$this->assign('member_group', $member_group);
		 #渲染视图
		return view('admin/order/index');
	 }

	 #订单详情
	 public function edit(Request $request){
	 	if(!$request->param('id'))
	 	 {
			 Session::set('jump_msg', ['type'=>'error','msg'=>'参数错误']);
			 $this->redirect($this->history['1']);
	 	 }
	 	 #查询到当前订单的基本信息
	 	 $order_info=Orders::with('member')->find($request->param('id'));
	 	 $this->assign('order_info', $order_info);
	 	 return view('admin/order/edit');
	 }

	 #提现订单
	 public function withdraw(){

	 	$r=request()->param();
	 	 #搜索条件
	 	$data = memberwhere($r);
	 	$r = $data['r'];
	 	$where = $data['where'];
	 	 //注册时间
		if(request()->param('beginTime') && request()->param('endTime')){
			$endTime=strtotime(request()->param('endTime'))+24*3600;
			$where['member_creat_time']=["between time",[request()->param('beginTime'),$endTime]];
		}
		#身份证查询
		$wheres = array();
		 if( request()->param('cert_member_idcard')){
			$wheres['m.cert_member_idcard'] = ['like',"%".request()->param('cert_member_idcard')."%"];
		}else{
			$r['cert_member_idcard'] = '';
		}
	 	 // #查询订单列表分页
	 	 $order_lists = Withdraw::haswhere('member',$where)->join("wt_member_cert m", "m.cert_member_id=Member.member_id","left")->where($wheres)->paginate(Config::get('page_size'), false, ['query'=>Request::instance()->param()]);


	 	 #统计订单条数
	 	 $countmoney=Withdraw::where('withdraw_state=12')->sum('withdraw_amount');
	 	 $count['count_size']=Withdraw::haswhere('member',$where)->join("wt_member_cert m", "m.cert_member_id=Member.member_id","left")->where($wheres)->count();
		 $this->assign('order_lists', $order_lists);
		 $this->assign('countmoney', $countmoney);
		 $this->assign('count', $count);
		 #获取用户分组
		$member_group=MemberGroup::all();
		$this->assign('member_group', $member_group);
		$this->assign('r', $r);
		 #渲染视图
	 	return view('admin/order/withdraw');
	 }

	  #提现订单详情
	 public function showwithdraw(Request $request){
	 	if(!$request->param('id'))
	 	 {
			 Session::set('jump_msg', ['type'=>'error','msg'=>'参数错误']);
			 $this->redirect($this->history['1']);
	 	 }
	 	 #查询到当前订单的基本信息
	 	 $order_info=Withdraw::with('member,adminster')->find($request->param('id'));
	 	 // var_dump($order_info);die;
	 	 $this->assign('order_info', $order_info);
	 	 return view('admin/order/showwithdraw');
	 }
	 #审核提现列表
	 public function toexminewithdraw(){
	 	if($_POST){
	 		
	 	}
	 	$this->assign("id",input("id"));
	 	return view("admin/order/toexminewithdraw");
	 }

	  #套现订单
	 public function cash(){
	 	$r=request()->param();
	 	 #搜索条件
	 	$data = memberwhere($r);
	 	$r = $data['r'];
	 	$where = $data['where'];
	 	 //注册时间
		if(request()->param('beginTime') && request()->param('endTime')){
			$endTime=strtotime(request()->param('endTime'))+24*3600;
			$where['member_creat_time']=["between time",[request()->param('beginTime'),$endTime]];
		}
		#身份证查询
		$wheres = array();
		 if( request()->param('cert_member_idcard')){
			$wheres['mc.cert_member_idcard'] = ['like',"%".request()->param('cert_member_idcard')."%"];
		}else{
			$r['cert_member_idcard'] = '';
		}
	 	 // #查询订单列表分页
	 	 $order_lists = CashOrder::with('passageway')->join('wt_member m',"m.member_id=wt_cash_order.order_member")->where($where)->join("wt_member_cert mc", "mc.cert_member_id=m.member_id","left")->where($wheres)->paginate(Config::get('page_size'), false, ['query'=>Request::instance()->param()]);
	 	
	 	 #统计订单条数
	 	 $count['count_size']=CashOrder::with('passageway')->join('wt_member m',"m.member_id=wt_cash_order.order_member")->where($where)->join("wt_member_cert mc", "mc.cert_member_id=m.member_id","left")->where($wheres)->count();
			 $this->assign('order_lists', $order_lists);
			 $this->assign('count', $count);
		if(!Request::instance()->param('member_nick')){
		 	$where['member_nick']='';
		 }
		 if(!Request::instance()->param('member_mobile')){
		 	$where['member_mobile']='';
		 }
		 $member_group=MemberGroup::all();
		$this->assign('member_group', $member_group);
		$this->assign('r', $r);
		 #渲染视图
	 	return view('admin/order/cash');
	 }

	   #实名红包订单
	 public function recomment(){
	 	 // #查询订单列表分页
	 	  #如果有查询条件
	 	 $r=request()->param();
	 	 #搜索条件
	 	$data = memberwhere($r);
	 	$r = $data['r'];
	 	$where = $data['where'];
	 	 //注册时间
		if(request()->param('beginTime') && request()->param('endTime')){
			$endTime=strtotime(request()->param('endTime'))+24*3600;
			$where['member_creat_time']=["between time",[request()->param('beginTime'),$endTime]];
		}
		#身份证查询
		$wheres = array();
		 if( request()->param('cert_member_idcard')){
			$wheres['m.cert_member_idcard'] = ['like',"%".request()->param('cert_member_idcard')."%"];
		}else{
			$r['cert_member_idcard'] = '';
		}

	 	 // #查询订单列表分页
	 	 $order_lists = Recomment::haswhere('member',$where)->join("wt_member_cert m", "m.cert_member_id=Member.member_id","left")->where($wheres)->paginate(Config::get('page_size'), false, ['query'=>Request::instance()->param()]);
	 	 foreach ($order_lists as $key => $value) {
	 	 		$order_lists[$key]['recomment_member_name']=Member::where(['member_id'=>$value['recomment_member_id']])->value('member_nick');
	 	 		$order_lists[$key]['recomment_children_name']=Member::where(['member_id'=>$value['recomment_children_member']])->value('member_nick');
	 	 }
	 	 $countmoney=Recomment::sum('recomment_money');
	 	 #统计订单条数
	 	 $count['count_size']=Recomment::haswhere('member',$where)->join("wt_member_cert m", "m.cert_member_id=Member.member_id","left")->where($wheres)->count();
			 $this->assign('countmoney', $countmoney);
			 $this->assign('order_lists', $order_lists);
			 $this->assign('count', $count);
		 #获取用户分组
		$member_group=MemberGroup::all();
		$this->assign('member_group', $member_group);
	
		 $this->assign('r', $r);
		 #渲染视图
	 	return view('admin/order/recomment');
	 }
}
