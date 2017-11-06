<?php
/**
 * Created by PhpStorm.
 * User: DarkKris
 * Date: 2017/11/7
 * Time: 上午12:02
 */
namespace app\index\controller;
use think\Controller;
use app\index\model\users;
class Setting extends controller
{
    public function setting()
    {
        return $this->fetch('setting/setting');
    }

    public function upload()
    {
        
    }

    public function setpaginate()
    {
        $rows=input('post.number');
    }
}
?>