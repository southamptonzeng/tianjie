<?php

namespace app\admin\model\gonglue;

use think\Model;


class Contentcomment extends Model
{

    

    

    // 表名
    protected $name = 'gonglue_contentcomment';
    
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

    /**
     * 关联Contentcomment和Content模型
     */
    public function content()
    {
        return $this->belongsTo('Content', 'content_id', 'id', [], 'RIGHT')->setEagerlyType(0);
    }

    //添加评论
    public function addComment($data) {
        $validate = new \app\admin\validate\gonglue\Contentcomment();
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
