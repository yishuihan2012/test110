<?php
 /**
 * @authors Bill(755969423@qq.com)
 * @date    2017-12-08 10:26:05
 * @version $Bill$
 */
 namespace app\api\controller;
 use think\Config;
 use think\Request;
 use think\Exception;
 use think\Loader;

 Class Index{
 	 public function index(Request $Request)
 	 {
    // var_dump($Request);die;
 	 	 try{
 	 	 	 #判断请求方式
 	 	 	 if(!$Request->isPost())
 	 	 	 	 exit($this->return_json('400'));
 	 	 	 #获取请求参数
 	 	 	 $data=$Request->only('data');
 	 	 	 $data=$data['data'];
                 if(!is_array($data))
                      $data = json_decode($data, true);
 	 	 	 #解密data请求参数 TODO:解密方式 非对称解密
 	 	 	 #if request action and method is not exit
 	 	 	 if(!isset($data['action']) or !isset($data['method']))
 	 	 	 	 exit($this->return_json('400'));
 	 	 	 #if param is empty 
 			 if (empty($data['param']) || !isset($data['param']))
                	 $data['param']=[];
 	 	 	 #set class name
 	 	 	 $action_name="\app\api\controller\\".$data['action'];
 	 	 	 $action=new $action_name($data['param']);
 	 	 	 #return action errorcode to app because the action have error
			 if ($action->error)
                	 exit($this->return_json($action->error)) ;
                 #return method errorcode to app because the method have error
            	 $return=$action->{$data['method']}(Request::instance());
            	 #if the method have errormsg  return method errormsg 
            	 $return['msg']=isset($return['msg']) ? $return['msg'] : $this->get_code_message($return['code']);
            	 #如果方法有返回值 或者返回的data不为空 则进行加密 返回给App TODo :返回值加密方法 非对称加密
            	 if (isset($return['data']) && !empty($return['data'])) {
                	 //$return['data']=$this->encryption_data($return['data']);
                	 $return['data']=$return['data'];// //需要解密的时候放开
            	 } else
                 	 $return['data']=""; //需要加密的时候放开
            	 echo json_encode($return);
 	 	 } catch (\Exception $e) {
            	 echo json_encode(['code'=>'400',"msg"=>$e->getMessage(),"data"=>""]);
        	 }
 	 }

      #获取错误码说明
      private function get_code_message($code)
      {
           $messages=Config::get('response.'.$code);
           return $messages;
      }

      #返回json
      private function return_json($code, $data="")
      {
           $msg=$this->get_code_message($code) ? $this->get_code_message($code) : "系统错误~";
           if ($data)
                 $data=$this->encryption_data($data);
           return json_encode(['code'=>$code, 'msg'=>$msg, 'data'=>$data]);
      }
 }