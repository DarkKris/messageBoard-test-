<?php
/**
 * Created by PhpStorm.
 * User: DarkKris
 * Date: 2017/11/3
 * Time: 上午12:00
 */
namespace app\index\controller;
use app\index\model\Comment;
use think\Db;
use think\controller;
use app\index\model\Users;
use app\index\model\Message;
use think\request;
class Messages extends Controller
{
    #deny
    public function isdeny()
    {
        $us=Db::table('users')->where(array('userId'=>session('users.userId')))->find();
        if($us['deny']==1)
        {
            session(null);
            $this->error('Your Acoount Has Been Deny !!!',url('index/login/login'));
        }
    }
    #为留言增加评论-view
    public function commsg($messageId)
    {
        $us=Db::table('users')
            ->where(array('userId'=>session('users.userId')))
            ->find();
        $msg=Db::table('message')
            ->where(array('messageId'=>$messageId))
            ->find();
        $rows=$us['pagrows'];
        $this->assign('messageId',$messageId);
        $this->assign('content',$msg['content']);
        session('messageId',$messageId);
        $comlst=Db::table('users')
            ->alias('users')//指定当前数据表的别名
            ->where('messageId',$messageId)
            ->join('comment comment','users.userId = comment.userId')
            //join参数:要关联的数据表名或者别名;condition参数:关联条件;
            ->paginate($rows);
        $this->assign('comlst',$comlst);//assign()模板变量赋值
        if(request()->isPost())
        {
            $this->isdeny();
            $this->checkUser();
            $content=input('post.words');
            if(empty($content))
            {
                $this->error('Please type in !');
            }elseif(mb_strlen($content,'utf-8')>225){
                $this->error('The number of words is exceed');
            }else{
                $message=Message::get(session('messageId'));
                $comment = new Comment;
                $comment->content=input('post.words');
                $comment->createAt=time();
                $comment->userId=session('users.userId');
                $message->msgcom()->save($comment);
                session('messageId',null);
                $this->success('Post success'/*,url('login/messagelst')*/);
            }
        }
        return view('message/comment');
    }
    #保存用户留言
    public function savemsg()
    {
        $this->isdeny();
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
        $this->isdeny();
        $this->checkUser();
        session('msgid',$messageId);
        $message=Db::name('message')->where(array('messageId'=>$messageId))->find();
        $this->assign('msgid',$messageId);
        $this->assign('content',$message['content']);
        return view('message/changemsg');
    }
    #修改评论-页面显示
    public function changecom($commentId)
    {
        $this->isdeny();
        $this->checkUser();
        session('comid',$commentId);
        $comment=Db::name('comment')->where(array('commentId'=>$commentId))->find();
        $this->assign('comid',$commentId);
        $this->assign('content',$comment['content']);
        return view('message/changecom');
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
                unset($_SESSION['msgid']);
                $this->success('Change success !',url('index/login/messagelst'));
            }else{
                $this->error('Change fail !',url('changemsg'));
            }
        }
    }
    #修改评论
    public function changecomment()
    {
        if(request()->isPost())
        {
            $msg = new Comment;
            $content = input('post.words');
            $result=$msg->where(array('commentId'=>session('comid')))->setField(array('content'=>$content));
            if($result)
            {
                unset($_SESSION['msgid']);
                $this->success('Change success !',url('index/login/messagelst'));
            }else{
                $this->error('Change fail !');
            }
        }
    }
    #删除留言
    public function delete()
    {
        $this->isdeny();
        $this->checkUser();
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
    #删除评论
    public function deletecom()
    {
        $this->isdeny();
        $this->checkUser();
        $request=Request::instance();
        $id=$request->param('commentId');
        $result=Db::table('comment')->delete($id);
        if($result>0)
        {
            $this->success('Delete success');
        }else{
            $this->error('Delete fail');
        }
    }
}
?>