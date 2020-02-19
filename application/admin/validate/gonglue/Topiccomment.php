<?php

namespace app\admin\validate\gonglue;

use think\Validate;

class Topiccomment extends Validate
{
    /**
     * 验证规则
     */
    protected $rule = [
        'topic_id' => 'require',
        'username' => 'require',
        'content' => 'require'

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
        return $this->only(['topic_id', 'content', 'username']);
    }
}
