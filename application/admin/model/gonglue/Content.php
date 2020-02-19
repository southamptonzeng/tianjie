<?php

namespace app\admin\model\gonglue;

use think\Model;


class Content extends Model
{

    

    

    // 表名
    protected $name = 'gonglue_content';
    
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
    

    protected static function init()
    {
        self::afterInsert(function ($row) {
            $pk = $row->getPk();
            $row->getQuery()->where($pk, $row[$pk])->update(['weigh' => $row[$pk]]);
        });
    }

    
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
     * 关联Content和Contentcategory模型
    */
    public function contentCategory()
    {
        return $this->belongsTo('Contentcategory', 'category_id', 'id', [], 'RIGHT')->setEagerlyType(0);
    }

    //添加文章
    public function addContent($data) {
        $validate = new \app\admin\validate\gonglue\Content();
        if (!$validate->scene('addContent')->check($data)) {
            return $validate->getError();
        }
        $result = $this->allowField(true)->save($data);
        if ($result) {
            return 1;
        } else {
            return '文章添加失败!';
        }
    }

}
