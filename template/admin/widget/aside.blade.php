<nav class="menu" data-ride="menu">
    <!-- <a class="btn btn-primary" href="#"><i class="icon icon-edit"></i> 新增项目</a> -->
    <!-- <a class="btn" href="{{url('/index/uploads/index')}}" data-remote="" data-size="lg" data-toggle="modal"><i class="icon icon-cloud-upload"></i> 会员组头像上传</a> -->
    <!-- <a class="btn" href="{{url('/index/uploads/logo')}}" data-remote="" data-size="lg" data-toggle="modal"><i class="icon icon-cloud-upload"></i> 网站logo上传</a> -->
    <ul class="nav nav-primary">

        <li class="dashboard"><a href="{{url('/index/dashboard/index')}}"><i class="0icon icon-dashboard"></i> 控制面板</a></li>
        <li class="nav-parent member-manager">
            <a href="javascript:;"><i class="icon icon-user"></i> 会员管理</a>
            <ul class="nav">
                <li class="member"><a href="{{url('/index/member/index')}}"> 会员管理</a></li>
                @if($admin['adminster_group_id']!=5)
                <li class="member_group"><a href="{{ url('/index/member_group/index') }}"> 用户组管理</a></li>
                @endif
            </ul>
        </li>
        @if($admin['adminster_group_id']!=5)
        @if(0)
        终极注释
        <li class="nav-parent member-activation-code">
            <a href="javascript:;"><i class="icon icon-barcode"></i> 激活码管理</a>
            <ul class="nav">
                <li class="activation_code"><a href="{{url('/index/activation_code/index')}}"> 激活码列表 </a></li>
            </ul>
        </li>
        @endif
        @endif
        @if($admin['adminster_group_id']!=5)
        <li class="nav-parent wallet-manager">
            <a href="javascript:;"><i class="icon icon-dollar"></i>钱包管理</a>
            <ul class="nav">
                <li class="wallet"><a href="{{ url('/index/wallet/index') }}">钱包列表</a></li>
                <li class="walletlog"><a href="{{ url('/index/wallet_log/index') }}">日志列表</a></li>
            </ul>
        </li>
        <li class="nav-parent order-manager">
            <a href="javascript:;"><i class="icon icon-user"></i> 订单统计</a>
            <ul class="nav">
                <li class="order"><a href="{{url('/index/order/index')}}"><i class="icon icon-sliders"></i> 升级订单列表</a></li>
                <li class="withdraw"><a href="{{url('/index/order/Withdraw')}}"><i class="icon icon-sliders"></i> 提现订单</a></li>
                <li class="recomment"><a href="{{url('/index/order/recomment')}}"><i class="icon icon-sliders"></i> 实名红包列表</a></li>
                <li class="cash"><a href="{{url('/index/order/cash')}}"><i class="icon icon-sliders"></i> 交易订单</a></li>
                 <li class="successcash"><a href="/index/order/cash?order_state=2"><i class="icon icon-sliders"></i> 成功交易订单</a></li>
                 <li class="successcash"><a href="/index/order/cash?order_state=!2"><i class="icon icon-sliders"></i> 未成功交易订单</a></li>
            </ul>
        </li>
        @endif
        <li class="nav-parent passageway-manager">
            <a href="javascript:;"><i class="icon icon-user"></i> 通道管理</a>
            <ul class="nav">
                <li class="passageway"><a href="{{url('/index/passageway/index')}}"><i class="icon icon-sliders"></i> 通道列表</a></li>
                <li class="passageway_bind"><a href="{{url('/index/passageway/passageway_bind')}}"><i class="icon icon-sliders"></i> 信用卡签约记录</a></li>
                
	
 			<!--<li class="passageway_rate"><a href="{{url('/index/passageway_rate/index')}}"><i class="icon icon-sliders"></i> 费率编码表</a></li>-->       
            </ul> 
        </li>
        @if($admin['adminster_group_id']!=5)
        <li class="nav-parent plan-manager">
            <a href="javascript:;"><i class="icon icon-user"></i> 自动代还</a>
            <ul class="nav">
                    <li class="plan"><a href="{{url('/index/plan/index')}}"><i class="icon icon-sliders"></i> 计划列表</a></li>
                    <li class="plan_detail"><a href="{{url('/index/plan/detail')}}"><i class="icon icon-sliders"></i> 计划列表详情</a></li>
                    <li class="plan_fail"><a href="/index/plan/detail?order_status=-1"><i class="icon icon-sliders"></i> 失败计划列表</a></li>
                    <li class="plan_fails"><a href="/index/plan/fail"><i class="icon icon-sliders"></i> 挂账列表</a></li>
            </ul>
        </li>
        <li class="nav-parent financial-manager">
            <a href="javascript:;"><i class="icon icon-yen"></i> 财务管理</a>
            <ul class="nav">
                    <li class="financial_center"><a href="{{url('/index/financial/index')}}"><i class=""></i> 对账中心</a></li>
                    <li class="commiss_center"><a href="{{url('/index/financial/commiss')}}"><i class=""></i> 分佣统计</a></li>
                    <li class="fenrun_center"><a href="{{url('/index/financial/fenrun')}}"><i class=""></i> 分润统计</a></li>
            </ul>
        </li>
        <li class="nav-parent model-manager">
                 <a href="#"><i class="0icon icon-cube-alt"></i> 自定义模块</a>
                 <ul class="nav">
                        <li class="model-list"><a href="{{url('/index/server_model/index')}}"><i class="icon icon-th-large"></i> 模块列表</a></li>
                        <li class="model-server"><a href="{{url('/index/server_model/service_list')}}"><i class="icon icon-server"></i> 服务列表</a></li>
                 </ul>
        </li>

        <li class="nav-parent article-manager">
            <a href="#"><i class="0icon icon-list"></i> 文章管理</a>
            <ul class="nav">
                <li class="articles"><a href="{{url('/index/article/index')}}"> 文章列表</a></li>
                <li class="articles_category"><a href="{{url('/index/article_category/index')}}"> 分类管理</a></li>
                <li class="new_zhiyin"><a href="{{url('/index/article/memberNovice')}}"> 新手指引</a></li>
                <li class="novice_calss"><a href="{{url('/index/novice_class/index')}}"> 新手指引分类</a></li>
            </ul>
        </li>

        <li class="nav-parent generalize-manager">
            <a href="#"><i class="0icon icon-share"></i> 推广模块</a>
            <ul class="nav">
                <li class="generalize"><a href="{{url('/index/generalize/index')}}"> 推广素材库</a></li>
                <li class="generalize_share"><a href="{{url('/index/generalize/share')}}"> 注册邀请链接</a></li>
                 <li class="generalize_share2"><a href="{{url('/index/generalize/exclusive_list')}}"> 专属二维码</a></li>
            </ul>
        </li>
        <li class="nav-parent bank-manager">
            <a href="javascript:;"><i class="icon icon-user"></i> 银行管理</a>
            <ul class="nav">
                <li class="bank_list"><a href="{{url('/index/bank/index')}}"><i class="icon icon-sliders"></i> 银行积分兑换</a></li>
                <li class="bank_ident"><a href="{{url('/index/bank/ident')}}"><i class="icon icon-sliders"></i> 银行识别</a></li>
            </ul>
        </li>

        <li class="nav-parent suggestion">
            <a href="javascript:;"><i class="icon icon-user"></i> 意见建议</a>
            <ul class="nav">
                <li class="suggestion_list"><a href="{{url('/index/suggestion/index')}}"><i class="icon icon-sliders"></i> 用户反馈</a></li>
            </ul>
        </li>
        @endif
        <li class="adminster-manager nav-parent">
            <a href="{{url('/index/adminster/index')}}"><i class="0icon icon-user"></i> 管 理 员</a>
            <ul class="nav">
                <li class="adminster"><a href="{{url('/index/adminster/index')}}">管理员管理</a></li>
                @if($admin['adminster_group_id']!=5)

                <li class="auth_group"><a href="{{url('/index/auth_group/index')}}">用户组管理</a></li>
                @endif
            </ul>
        </li>
        @if($admin['adminster_group_id']!=5)
        <li class="nav-parent system-setting">
            <a href="javascript:;"><i class="icon icon-cog"></i> 系统管理</a>
            <ul class="nav">
                <li class="setting-basic"><a href="{{url('/index/system/basic')}}"><i class="icon icon-sliders"></i> 核心设置</a></li>
                <li class="setting-page"><a href="{{url('/index/system/page')}}"><i class="icon icon-sliders"></i> 内置页面</a></li>
                <li class="setting-customer_service service"><a href="{{url('/index/system/customer_service')}}"><i class="icon icon-sliders"></i> 客服管理</a></li>
                <li class="setting-announcement"><a href="{{url('/index/system/announcement')}}"><i class="icon icon-sliders"></i> 公告管理</a></li>
                <li class="setting-Appversion"><a href="{{url('/index/appversion/index')}}"><i class="icon icon-sliders"></i> APP版本号</a></li>
                <li class="setting-alert"><a href="{{url('/index/alert/index')}}"><i class="icon icon-sliders"></i> APP弹窗</a></li>
                <li class="setting-logo"><a href="{{url('/index/uploads/logo')}}" data-remote="" data-size="lg" data-toggle="modal"><i class="icon icon-sliders"></i> 网站logo上传</a></li>
            </ul>
        </li>
        @endif
    </ul>
</nav>
