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

    public function upload(Request $request)
    {
        $file=$request->file('image');

//            if(!is_dir($dir))
//            {
//                mkdir($dir,0777,true);
//            }
            $info=$file->move(ROOT_PATH . 'public' . DS . 'uploads');
            $filename=$info->getSaveName();
            $user = new Users;
            $id=session('users.userId');
            $result = $user->where(array('userId'=>$id))->setField(array('imgsrc'=>$filename));
            if($result)
            {
                $this->success('Upload success !');
            }else{
                $this->error('Upload fail !');
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
}
?>