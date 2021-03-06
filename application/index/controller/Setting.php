<?php
/**
 * Created by PhpStorm.
 * User: DarkKris
 * Date: 2017/11/7
 * Time: 上午12:02
 */
namespace app\index\controller;
use think\Controller;
use think\Db;
use app\index\model\Users;
use think\File;
use think\Image;
use think\Request;
class Setting extends controller
{
    public function admincontrol()
    {
        $list=Db::table('users')->paginate(20);
        $this->assign('list',$list);
        return $this->fetch('usercenter/admin');
    }

    public function edituser($id)
    {
        $name=input('post.name');
        $pagrows=input('post.pagrows');
        $deny=input('post.deny');
        $user = new Users;
        $result=$user->where('userId',$id)->update(['name'=>$name,'pagrows'=>$pagrows,'deny'=>$deny]);
        if($result)
        {
            $this->success('Change success !');
        }else{
            $this->error('Change fail !');
        }
    }

    public function deleteuser($id)
    {
        $result=Db::table('users')->delete($id);
        if($result>0)
        {
            $this->success('Delete success !');
        }else{
            $this->error('Delete fail !');
        }
    }

    public function setting()
    {
        $id=session('users.userId');
        $userssrc=Db::table('users')
            ->where(array('userId'=>$id))
            ->find();
        if($userssrc['deny']==1)
        {
            session(null);
            $this->error('Your Acoount Has Been Deny !!!',url('index/login/login'));
        }
        $this->assign('rows',$userssrc['pagrows']);
        $this->assign('name',session('users.name'));
        $this->assign('address',$userssrc['imgsrc']);
        return $this->fetch();
    }

    public function upload(Request $request)
    {
        $user = new Users;
        $id=session('users.userId');
        if($id==2)
        {
            $this->error('Please login to use this function !');
        }else {
            $file = $request->file('image');
            $info = $file->rule('uniqid')->move(ROOT_PATH . 'public' . DS . 'uploads' . DS . date("Ym"));
            $filename = $info->getFilename();
            $result = $user->where(array('userId' => $id))->setField(array('imgsrc' => date("Ym") . DS . $filename));
            if ($result) {
                $this->success('Upload success !');
            } else {
                $this->error('Upload fail !');
            }
        }
    }

    public function setpaginate()
    {
        $rows=input('post.number');
        $id=session('users.userId');
        $user = new Users;
        $result=$user->where(array('userId'=>$id))->setField(array('pagrows'=>$rows));
        if($result)
        {
            $this->success('Set success !');
        }else {
            $this->error('Set fail');
        }
    }

    #修改密码
    public function changepw()
    {
        if(session('users.userId')==2)
        {
            $this->error('Please Login to use this function !',url('login/messagelst'));
        }
        if(request()->isPost())
        {
            $user = new Users;
            $id = session('users.userId');
            $data = Db::table('users')
                ->where(array('userId' => $id))
                ->find();
            $pw = $data['password'];
            $oripw = md5(input('post.ori'));//键入原密码
            $newpw = md5(input('post.new'));
            $conf = md5(input('post.repw'));
            $this->assign('rows',$data['pagrows']);
            $this->assign('name',session('users.name'));
            $this->assign('address',$data['imgsrc']);
            if ($newpw != $conf) {
                $this->assign("iserror", 3);//3:两次密码不相同
                $this->display('usercenter/usercenter');
            } else {
                if ($pw != $oripw) {
                    $this->assign("iserror", 2);//2:原密码错误
                    $this->display('setting/setting');
                } else {
                    $result = $user->where(array('userId' => $id))->setField(array('password' => $newpw));
                    if ($result) {
                        $this->success('Set success !');
                    } else {
                        $this->error('Set fail');
                    }
                }
            }
        }
        return view('setting/setting');
    }
}
?>