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
    #修改留言
    public function changemsg()
    {
        $msg = new Message;
        $request=Request::instance();
        $id=$request->param('messageId');
        $message=$msg->where(array('messageId'=>$id))->find();
        $this->assign('msgid',$id);
        $this->assign('content',$message['content']);
        if(request()->isPost())
        {
            $content = input('post.words');
            return 'M='.dump($message['content']);
            $result=$msg->where(array('messageId'=>$id))->setField(array('content'=>$content));
            if($result)
            {
                $this->success('Change success !',url('index/login/messagelst'));
            }else{
                $this->error('Change fail !');
            }
        }
        return view('message/changemsg');
    }
    #保存用户留言
    public function savemsg()
    {
        $this -> checkUser();
        $content = input('post.words');
        if(empty($content))
        {
            $this->assign('iserror',1);//No content
            //$this->display('')                    ###***
        }elseif(mb_strlen($content,'utf-8')>225){
            $this->assign('iserror',2);//The number of message limit
            //$this->display('')                    ###***
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