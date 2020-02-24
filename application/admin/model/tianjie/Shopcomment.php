<?php

namespace app\admin\model\tianjie;

use think\Model;


class Shopcomment extends Model
{

    

    

    // 表名
    protected $name = 'tianjie_shopcomment';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'status_text'
    ];
    

    
    public function getStatusList()
    {
        return ['normal' => __('Normal'), 'hidden' => __('Hidden')];
    }


    public function getStatusTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['status']) ? $data['status'] : '');
        $list = $this->getStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    //添加评论
    public function addComment($data) {
        $validate = new \app\admin\validate\tianjie\Shopcomment();
        if (!$validate->scene('addComment')->check($data)) {
            return $validate->getError();
        }
        $result = $this->allowField(true)->save($data);
        if ($result) {
            return 1;
        } else {
            return '评论添加失败!';
        }
    }
}
