<?php
/**
 * Created by PhpStorm.
 * User: DarkKris
 * Date: 2017/10/29
 * Time: 上午8:20
 */
    namespace app\Home\controller;
    use think\View;
    use think\Db;
    use app\Home\model\Users;
    use app\Home\model\Message;
    use think\Controller;
    class Login extends Controller
    {
        //用户登录验证
        public function login()
        {
            $users = new Users;
            if(request()->isPost())//是否有post请求
            {
                $result = $users->checkUser(input('post.username'),input('post.password'));
                if($result)
                {
                    session_start();
                    session('user.userId',$result['userId']);//使用session保留登录信息
                    session('user.username',$result['name']);
                    $this->success('登录成功',url('messagelst'));//登录成功，跳转到当前模块当前控制器的messagelst方法
                }else{
                    $this->error('用户名或密码错误');
                }
            }
            return view();//如果没有登录就跳转至login.html
        }
    }


?>