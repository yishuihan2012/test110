<?php
/**
 * System controller / 系统配置控制器
 * @authors GongKe(755969423@qq.com)
 * @date    2017-12-04 10:27:05
 * @version $Bill$
 */
namespace app\index\controller;

use app\index\model\Announcement;
use app\index\model\CustomerService;
use app\index\model\Member as Members;
use app\index\model\Notice;
use app\index\model\Page;
use app\index\model\System as Systems;
use think\Config;
use think\Controller;
use think\Db;
use think\Loader;
use think\Request;
use think\Session;

class System extends Common
{
    #系统核心配置
    public function basic()
    {
        #如果是提交更新
        if (Request::instance()->isPost()) {
            $result = false;
            #验证器验证 触发update事件验证
            $validate = Loader::validate('SystemregisterValidate');
            #如果验证不通过
            if (!$validate->check(Request::instance()->param())) {
                #查询基本参数设置
                $setting = Systems::where('system_type', 'register')->whereOr('system_type', 'login')->order('system_id', 'asc')->select()->toArray();
                $this->assign('setting', $setting);
                #数据是否提交成功
                Session::set('jump_msg', ['type' => 'error', 'msg' => $validate->getError()]);
                $this->redirect($this->history['0']);
                exit;
            }
            #获取提交的所有数据
            $array = Request::instance()->param();
            #遍历提交的数据
            foreach ($array as $key => $value) {
                #读取出数据库中本项的值
                if (Systems::getName($key) != $value) {
                    $result  = Systems::setName($key, $value);
                    $content = $result === false ? ['type' => 'error', 'msg' => $key . '修改失败!'] : ['type' => 'success', 'msg' => '修改成功!'];
                    Session::set('jump_msg', $content);
                }
            }
            $this->redirect($this->history['0']);
        }
        #查询核心参数设置之注册登录配置
        $setting = Systems::order('system_id', 'asc')->select()->toArray();
        // var_dump(count($setting));die;
        $this->assign('setting', $setting);
        #查询核心参数设置之配置
        //$setting = Systems::where('system_type','register')->whereOr('system_type','login')->order('system_id', 'asc')->select()->toArray();
        //$this->assign('setting', $setting);
        #渲染视图
        return view('admin/system/basic');
    }

    //单页设置
    public function page()
    {
        $page = Request::instance()->param('page_type') ? Request::instance()->param('page_type') : 1;
        if (Request::instance()->isPost()) {
            $Page    = Page::get(Request::instance()->param('page_id'));
            $result  = $Page->allowField(true)->save($_POST);
            $content = ($result === false) ? ['type' => 'error', 'msg' => '修改失败'] : ['type' => 'success', 'msg' => '修改成功'];
            Session::set('jump_msg', $content);
            $this->redirect('System/page', array('page_type' => $page));
        }
        $pageinfo = Page::where("page_type=" . "{$page}")->find();
        $this->assign('pageinfo', $pageinfo);
        #渲染视图
        return view('admin/system/page');
    }

    #客服人员列表
    public function customer_service()
    {
        $services = CustomerService::paginate(Config::get('page_size'), false, ['query' => Request::instance()->param()]);
        $this->assign('button',
            [
                ['text' => '新增客服', 'link' => url('/index/System/add_service')],
            ]);
        $this->assign('services', $services);
        #渲染视图
        return view('admin/system/service');
    }

    #增加客服
    public function add_service()
    {
        if (Request::instance()->isPost()) {
            $CustomerService = new CustomerService($_POST);
            $result          = $CustomerService->allowField(true)->save();
            $content         = ($result === false) ? ['type' => 'error', 'msg' => '保存失败'] : ['type' => 'success', 'msg' => '保存成功'];
            Session::set('jump_msg', $content);
            $this->redirect('System/customer_service');
        }
        #渲染视图
        return view('admin/system/addservice');
    }

    #查看
    public function show_service()
    {
        if (Request::instance()->isPost()) {
            $CustomerService = CustomerService::get(Request::instance()->param('service_id'));
            $result          = $CustomerService->allowField(true)->save($_POST);
            $content         = ($result === false) ? ['type' => 'error', 'msg' => '修改失败'] : ['type' => 'success', 'msg' => '修改成功'];
            Session::set('jump_msg', $content);
            $this->redirect('System/customer_service');
        }
        $services = CustomerService::where('service_id=' . Request::instance()->param('service_id'))->find();
        $this->assign('services', $services);
        #渲染视图
        return view('admin/system/showservice');
    }
    #删除服务内容
    public function service_remove()
    {
        $CustomerService = CustomerService::get(Request::instance()->param('service_id'));
        $result          = $CustomerService->delete();
        $content         = ($result === false) ? ['type' => 'error', 'msg' => '删除失败'] : ['type' => 'success', 'msg' => '删除成功'];
        Session::set('jump_msg', $content);
        $this->redirect('system/customer_service');
    }
    /**
     * 系统公告
     * @Author   Star(794633291@qq.com)
     * @DateTime 2017-12-26T14:06:39+0800
     * @version  [version]
     * @return   [type]                   [description]
     */
    public function announcement()
    {
        $list  = Announcement::with('adminster')->paginate(Config::get('page_size'));
        $count = Announcement::count();
        $this->assign("count", $count);
        $this->assign('button',
            [
                ['text' => '新增公告', 'link' => url('/index/System/add_announcement')],
            ]);
        $this->assign('list', $list);
        return view('admin/system/announcement');
    }

    #增加公告
    public function add_announcement()
    {
        if (Request::instance()->isPost()) {
            $param                         = request()->param();
            $content                       = array();
            $param['announcement_adminid'] = session('adminster.id');
            $msg                           = '增加失败';
            Db::startTrans();
            try {
                //写入系统通知表
                $Announcement = new Announcement($param);
                $result       = $Announcement->allowField(true)->save();
                if ($result != false) {
                    //批量写入用户通知表
                    $members = Members::all()->column('member_id');
                    $data    = [];
                    foreach ($members as $k => $v) {
                        $data[] = [
                        	#为避免大量重复内容 系统通知标题内容留空 查看时调用对应公告
                            'notice_title'           => '',
                            'notice_content'         => '',
                            'notice_adminid'         => $param['announcement_adminid'],
                            'notice_announcement_id' => $Announcement->announcement_id,
                            'notice_recieve'         => $v,
                        ];
                    }
                    $Notice = new Notice();
                    $result = $Notice->saveAll($data);
                    if ($result != false) {
                        Db::commit();
                    } else {
                        $msg = '批量写入用户通知表失败';
                    }
                } else {
                    $msg = '写入系统通知表失败';
                }
                if (!$result) {
                    Db::rollback();
                }

            } catch (\Exception $e) {
                Db::rollback();
                $result = false;
                $msg    = '异常错误';
            }
            $content = ($result === false) ? ['type' => 'error', 'msg' => $msg] : ['type' => 'success', 'msg' => '增加成功'];

            Session::set('jump_msg', $content);
            $this->redirect('System/announcement');
        }
        #渲染视图
        return view('admin/system/add_announcement');
    }

    #查看公告
    public function show_announcement()
    {
        if (Request::instance()->isPost()) {
            $Announcement = Announcement::get(Request::instance()->param('announcement_id'));
            $result       = $Announcement->allowField(true)->save($_POST);
            $content      = ($result === false) ? ['type' => 'error', 'msg' => '修改失败'] : ['type' => 'success', 'msg' => '修改成功'];
            Session::set('jump_msg', $content);
            $this->redirect('System/announcement');
        }
        $data = Announcement::where('announcement_id=' . Request::instance()->param('announcement_id'))->find();
        $this->assign('data', $data);
        #渲染视图
        return view('admin/system/show_announcement');
    }

    #删除公告
    public function del_announcement()
    {
        $param = request()->param();
        Db::startTrans();
        try {
            //系统通知表删除
            $result = Announcement::destroy($param['announcement_id']);
            if ($result) {
                //用户通知表批量删除
                $result = Notice::destroy(['notice_announcement_id' => $param['announcement_id']]);
                if ($result) {
                    Db::commit();
                }

            }
            if (!$result) {
                Db::rollback();
            }

        } catch (\Exception $e) {
            Db::rollback();
            $result = false;
        }
        // $Announcement =Announcement::get(Request::instance()->param('announcement_id'));
        // $result= $Announcement->delete();
        $content = ($result === false) ? ['type' => 'error', 'msg' => '删除失败'] : ['type' => 'success', 'msg' => '删除成功'];
        Session::set('jump_msg', $content);
        $this->redirect('System/announcement');
    }
}
