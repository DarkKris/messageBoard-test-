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
use think\request;
class Setting extends controller
{
    public function setting()
    {
        $id=session('users.userId');
        $userssrc=Db::table('users')
            ->where(array('userId'=>$id))
            ->find();
        $this->assign('rows',$userssrc['pagrows']);
        $this->assign('name',session('users.name'));
        $this->assign('address',$userssrc['imgsrc']);
        return $this->fetch();
    }

    public function upload()
    {
        $file=request()->file('users.avator');

        $info=$file->move(ROOT_PATH . 'public' . DS . 'uploads');//
        if($info)
        {
            $id=session('users.userId');
            $address=$info->getSaveName();
            $user = new Users;
            $user->where(array('id'=>$id))->setField(array('imgsrc'=>$address));
        }else{
            $this->error('Upload fail');
        }
    }

    public function setpaginate()
    {
        $rows=input('post.number');
        $id=session('users.userId');
        $user = new Users;
        $result=$user->where(array('userId'=>$id))->setField('pagrows',$rows);
        if($result)
        {
            $this->success('Set success !');
        }else {
            $this->error('Set fail');
        }
    }
}
?>