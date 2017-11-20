<?php
/**
 * Created by PhpStorm.
 * User: DarkKris
 * Date: 2017/11/20
 * Time: 下午11:49
 */
namespace app\index\Model;
use think\Model;
class Addlike extends Model
{
    protected $table = 'addlike';

    public function assigntable()
    {
        return $this->belongsToMany('Users','message','userId','messageId');
    }
}
?>