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

        public function messagelst()//显示留言
        {
            $list=Db::table('users')
                ->alias('user')//指定当前数据表的别名
                ->join('comments comments','user.userId = comments.userId')
                //join参数:要关联的数据表名或者别名;condition参数:关联条件;
                ->paginate(5);
            $this->assign('list',$list);//assign()模板变量赋值
            return $this->fetch('message/messagelst');//fetch()渲染模版输出,[模块@][控制器/][操作]写法支持跨模块
            //这里将渲染模板输出至当前../view/message/message.html
            //fault?
        }

        public function register()
        {
            if(request()->isPost())
            {
                $username = input('post.username');
                $password = input('post.password');
                $repassword = input('post.repassword');
                if($password!=$repassword)
                {
                    $this -> error('两次输入的密码不一致');
                }
                $user = new Users;
                $result = $user -> findUser($username);
                if(!empty($result))
                {
                    $this -> error('用户名已存在');
                }else{
                    $user -> data([                     //将填写的数据保存至数据库
                        'username' => $username,
                        'password' => $password,
                        'createdAt'=> time()
                    ]);
                    $a = $user -> save();//save()返回写入的记录数
                    if($a > 0)//是否成功写入记录
                    {
                        $this -> success("注册成功！",url('login'));//跳转至当前模块当前控制器下的login方法
                    }
                }
            }
            return view('login/register');//定位到当前模块下的view文件夹下的login文件夹下的register.html
        }

        //退出登录并摧毁登录数据
        public function loginout()
        {
            session(null);//将当前用户会话中的session变量设为null
            $this->success('你已退出登录',url('login'));
        }
    }
?>