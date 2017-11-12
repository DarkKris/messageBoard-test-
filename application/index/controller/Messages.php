<?php
/**
 * Created by PhpStorm.
 * User: DarkKris
 * Date: 2017/11/3
 * Time: 上午12:00
 */
namespace app\index\controller;
use think\Db;
use think\controller;
use app\index\model\Users;
use app\index\model\Message;
use think\request;
class Messages extends Controller
{
    #检测用户是否登录
    public function checkUser()
    {
        if(!session('users.userId'))
        {
            $this->error('Please login or login tourist firstly !',url('Login/login'));
        }
    }
    #修改留言-页面显示
    public function changemsg($messageId)
    {
        session('msgid',$messageId);
        $message=Db::name('message')->where(array('messageId'=>$messageId))->find();
        $this->assign('msgid',$messageId);
        $this->assign('content',$message['content']);
        return view('message/changemsg');
    }
    #修改留言
    public function changemessage()
    {
        if(request()->isPost())
        {
            $msg = new Message;
            $content = input('post.words');
            $result=$msg->where(array('messageId'=>session('msgid')))->setField(array('content'=>$content));
            if($result)
            {
                $this->success('Change success !',url('index/login/messagelst'));
            }else{
                $this->error('Change fail !',url('changemsg'));
            }
            unset($_SESSION['msgid']);
        }
    }
    #保存用户留言
    public function savemsg()
    {
        $this -> checkUser();
        $content = input('post.words');
        if(empty($content))
        {
            $this->error('No content');//No content
        }elseif(mb_strlen($content,'utf-8')>225){
            $this->error('The number of words is exceed');//The number of message limit
        }else{
            $user=Users::get(session('users.userId'));
            $message = new Message;
            $message->content=input('post.words');
            $message->creatAt=time();
            $user->comm()->save($message);
            $this->success('Post success',url('login/messagelst'));
        }
    }
    #删除留言
    public function delete()
    {
        $request=Request::instance();
        $id=$request->param('messageId');
        $result=Db::table('message')->delete($id);
        if($result>0)
        {
            $this->success('Delete success',url('Login/messagelst'));
        }else{
            $this->error('Delete fail');
        }
    }
}
?>