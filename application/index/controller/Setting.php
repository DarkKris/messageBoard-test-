<?php
/**
 * Created by PhpStorm.
 * User: DarkKris
 * Date: 2017/11/7
 * Time: 上午12:02
 */
namespace app\index\controller;
use think\Controller;
use app\index\model\Users;
class Setting extends controller
{
    public function setting()
    {
        $userssrc=Db::table('users')//从数据库中提取头像信息
            ->where(array(''));//
        $this->assign('address',$userssrc);
        $this->display('setting/setting');
    }

    public function upload()
    {
        $file=request()->file('users.avator');

        $info=$file->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info)
        {
            $address=$info->getSaveName();
            //保存至数据库users.imgsrc
        }else{
            $this->error('Upload fail');
        }
    }

    public function setpaginate()
    {
        $rows=input('post.number');
        //保存至数据库users.pagrows
    }
}
?>