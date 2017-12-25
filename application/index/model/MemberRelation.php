<?php
 /**
 * MemberRelation Model / 会员关系表模型
 * @authors 摇耳朵的小布丁 (755969423@qq.com)
 * @date    2017-09-29 17:14:23
 * @version $会员关系表模型 Bill$
 */
 namespace app\index\model;
 use think\Db;
 use think\Model;

 class MemberRelation extends Model{

        #定义模型数据表 默认为Class名加前缀 如不一样 可自己定义
        #protected $table = 'ft_member_login';
        #定义主键信息  可留空 默认主键
        protected $pk 	 = 'relation_id';
         #定义自动写入时间字段开启 格式为时间格式
        protected $autoWriteTimestamp = 'datetime';
      #定义时间戳字段名 信息添加时间
        protected $createTime = 'relation_add_time';
        #定义时间戳字段名 信息修改时间
        protected $updateTime = false;
        #定义返回数据类型
        protected $resultSetType = 'collection';
        #初始化模型
        protected function initialize()
        {
            #需要调用父类的`initialize`方法
            parent::initialize();
            #TODO:自定义的初始化
        }

        #相对的模型关联(Member) 一对一关联
        public function member()
        {
            return $this->belongsTo('Member', 'member_id', 'relation_member_id')->bind('member_nick,member_cert');   
        }

        #相对父级信息(memberp)
        public function memberp()
        {
            return $this->hasOne('Member', 'member_id','relation_parent_id')->bind('member_cert')->setEagerlyType(0);
        } 

}
