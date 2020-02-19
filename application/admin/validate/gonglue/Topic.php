<?php

namespace app\admin\validate\gonglue;

use think\Validate;

class Topic extends Validate
{
    /**
     * 验证规则
     */
    protected $rule = [
        'title' => 'require', //话题标题
        'content' => 'require', //话题内容
        'username' => 'require', //用户名
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

    //添加话题场景
    public function sceneAddTopic() {
        return $this->only(['title', 'content', 'username']);
    }
    
}
