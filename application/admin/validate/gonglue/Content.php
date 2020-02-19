<?php

namespace app\admin\validate\gonglue;

use think\Validate;

class Content extends Validate
{
    /**
     * 验证规则
     */
    protected $rule = [

        'category_id' => 'require', //分类id, 做一个下拉框TODO
        'title' => 'require', //文章标题
        'content' => 'require', //文章内容
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

    //添加文章场景
    public function sceneAddContent() {
        return $this->only(['category_id', 'title', 'content', 'username']);
    }
    
}
