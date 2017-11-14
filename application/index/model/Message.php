<?php
/**
 * Created by PhpStorm.
 * User: DarkKris
 * Date: 2017/10/28
 * Time: 下午3:25
 */
namespace app\index\model;
use think\Model;
class Message extends Model
{
    protected $table = 'message';

    public function msgcom()
    {
        //hasMany('关联模型名','外键名','主键名',['模型别名定义']);
        //一对多关联users表与message表
        return $this->hasMany('comment','messageId','messageId');
    }
}
?>