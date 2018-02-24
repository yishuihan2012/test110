<?php
 // Member controller / Api 会员接口

 namespace app\api\controller;
 use think\Db;
 use think\Config;
 use think\Request;
 use think\Loader;
 use app\index\model\Member ;
 use app\index\model\MemberGroup;
 use app\index\model\MemberRelation;
 use app\index\model\MemberLogin;
 use app\index\model\System;
 use app\index\model\SmsCode;
 use app\index\model\MemberSuggestion;
 use app\index\model\MemberAccount;
 use app\index\model\MemberTeam;
 use app\index\model\MemberCreditcard;
 use app\index\model\MemberCashcard;
 use app\index\model\ChannelRate;
 use app\index\model\ChannelType;
 use app\index\model\MemberCert;
 use app\index\model\Passageway;
 use app\index\model\PassagewayItem;
 use app\index\model\Wallet;
 use app\index\model\Recomment;
 use app\index\model\Upgrade;
 use app\index\model\Notice;
 use app\index\model\Announcement;
 use app\index\model\MemberRecommend;
 class Planaction{
 	//修改通道费率，需要重新报备费率的重新报备
 	public function update_passway_rate($params){
 		$Passageway_detail=Passageway::where(['passageway_id'=>8]);
 	}
 	//刷卡或者代还完成后调用此方法，记录为上级有效推荐一人
 	public function recommend_record($uid){
 		$parent_id=MemberRelation::where(['relation_member_id'=>$uid])->value('relation_parent_id');
 		if($parent_id){//如果有上级
 			//查询是否已经记录过
 			$find=MemberRecommend::where(['recommend_member_id'=>$parent_id,'recommend_reid'=>$uid])->find();
 			if(!$find){
 				return MemberRecommend::insert(['recommend_member_id'=>$parent_id,'recommend_reid'=>$uid]);
 			}
 		}
 	}
 	//推荐会员自动升级任务
 	public function self_update(){
 		#1取出所有会员，获得升级条件
 		$member_group=MemberGroup::where(['group_level'=>1])->select();
 		foreach ($member_group as $group_key => $group) {
 			// $group=$group->toArray();
 			if($group['group_level_type']==1){//能够推荐升级
 				 $min=$group['group_level_invite'];
 				 $ceil_recommend_level=MemberGroup::where('group_salt >'.$group['group_salt'])->find();
 				 if($ceil_recommend_level){
 				 	$max=$ceil_recommend_level['group_level_invite'];
 				 }else{
 				 	$max='9999999';
 				 }
 				 //查询符合升级条件的用户
 				 $Recommend=MemberRecommend::group('recommend_member_id')->field('count(recommend_reid) as count,recommend_member_id')->having('count(recommend_reid)>='.$min.' and count(recommend_reid)< '.$max)->select();
 				 foreach ($Recommend as $k => $member) {
 				 	//获取会员信息
 				 	$member_group_id=Member::where(['member_id'=>$member['recommend_member_id']])->value('member_group_id');
 				 	//如果当前用户组小于可以升级到的用户组，则表示可以升级到该级别-
 				 	$member_group_salt=MemberGroup::where(['group_id'=>$member_group_id])->value('group_salt');
 				 	if($member_group_salt<$group['group_salt']){
 				 		//当前 $member['recommend_member_id'] 用户能够升级到 $group['group_id']级别
	    				#升级
			            $arr=array(
				            'upgrade_member_id'=>$member['recommend_member_id'],
				            'upgrade_group_id'=>$group['group_id'],
				            'upgrade_type'=>'auto',
				            'upgrade_bak'=>'有效推荐自动升级为'.$group->group_name,
				            'upgrade_commission'=>999,
			            );
			            // print_r($params);die;
			            $Upgrade=new \app\api\controller\Upgrade();
	        			$res=$Upgrade->memberUpgrade($arr);
 				 	}
 				 	
		 		}
 			}
 		}
 	}
 }
