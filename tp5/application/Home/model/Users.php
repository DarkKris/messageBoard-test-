<?php
/**
 * Created by PhpStorm.
 * User: DarkKris
 * Date: 2017/10/28
 * Time: 下午3:32
 */
    namespace app\Home\model;
    use think\Model;
    use think\Db;
    class Users extends Model
    {
        protected $table='users';
        //关联users table与comments table
        public function comm()
        {
            return $this->hasMany('comments','UserId','UserId');
        }
        //用户登录验证
        public function checkUser($id,$pw)
        {
            return Db::name('users')->where(array('name'=>))
        }
    }
?>