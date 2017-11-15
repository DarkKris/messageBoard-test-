<?php
/**
 * Created by PhpStorm.
 * User: DarkKris
 * Date: 2017/10/28
 * Time: 下午3:32
 */
namespace app\index\model;
use think\Model;
use think\Db;
class Users extends Model
{
    protected $table='users';//制定当前操作的数据表

    public function comm()
    {
        //hasMany('关联模型名','外键名','主键名',['模型别名定义']);
        //一对多关联users表与message表
        return $this->hasMany('message','userId','userId');
    }
    public function comuser()
    {
        //hasMany('关联模型名','外键名','主键名',['模型别名定义']);
        //一对多关联users表与message表
        return $this->hasMany('comment','userId','userId');
    }
    //用户登录验证
    //  $id 用户名
    //  $pw 密码
    public function checkUser($id,$pw)
    {
        return Db::name('users')->where(array('name' => $id, 'password' => md5($pw)))->find();
    }
    //检测用户名是否已经使用过(注册时)
    //  $username 注册时输入的用户名
    public function findUser($username)
    {
        return Db::name('users')->where(array('name'=>$username))->find();
    }
}
?>