<?php

namespace app\admin\validate\gonglue;

use think\Validate;

class Contentcomment extends Validate
{
    /**
     * 验证规则
     */
    protected $rule = [
        'content_id' => 'require',
        'username' => 'require', //用户名
        'content' => 'require' //评论内容
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
        return $this->only(['content_id', 'content', 'username']);
    }
    
}
