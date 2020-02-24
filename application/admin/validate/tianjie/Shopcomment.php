<?php

namespace app\admin\validate\tianjie;

use think\Validate;

class Shopcomment extends Validate
{
    /**
     * 验证规则
     */
    protected $rule = [
        'shop_id' =>'require',
        'username' => 'require',
        'content' => 'require',
        'product' => 'require',
        'service' => 'require',
        'quality' => 'require'
    ];
    /**
     * 提示消息
     */
    protected $message = [
    ];
    /**
     * 验证场景
     */
    protected $scene = [
        'add'  => [],
        'edit' => [],
    ];

    //添加评论场景场景
    public function sceneAddComment()
    {
        return $this->only(['shop_id', 'content', 'username', 'product', 'service', 'quality']);
    }
}
