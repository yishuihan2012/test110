<?php
/**
*  @version Passageway Model 快捷支付设置模型
 * @author  $bill 755969423@qq.com
 * @time      2017-11-24 09:20
 * @return  
 */
namespace app\index\model;
use think\Db;
use think\Model;
use think\Config;

class Cashout extends Model{
      #定义模型数据表 默认为Class名加前缀 如不一样 可自己定义
      #protected $table = 'wt_article';
      #定义主键信息  可留空 默认主键
      protected $pk 	 = 'cashout_id';
      #定义自动写入时间字段开启 格式为时间格式
      protected $autoWriteTimestamp = 'datetime';
      #定义时间戳字段名 信息添加时间
      protected $createTime = 'cashout_add_time';
      #初始化模型
      protected function initialize()
      {
           #需要调用父类的`initialize`方法
           parent::initialize();
           #TODO:自定义的初始化
      }

      #关联模型 一对一关联 (Passageway) 关联通道表
      public function passageway()
      {
           return $this->hasOne('Passageway','passageway_id','cashout_passageway_id')->bind('passageway_name')->setEagerlyType(0);
      }

}
