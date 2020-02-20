<?php

namespace addons\gonglue;

use addons\gonglue\library\FulltextSearch;
use app\common\library\Menu;
use think\Addons;

/**
 * 博客插件
 */
class Gonglue extends Addons
{

    /**
     * 插件安装方法
     * @return bool
     */
    public function install()
    {
        $menu = [
            [
                'name'    => 'gonglue',
                'title'   => '攻略管理',
                'sublist' => [

                    [
                        'name'    => 'gonglue/topiccomment',
                        'title'   => '话题评论管理',
                        'sublist' => [
                            ['name' => 'gonglue/topiccomment/index', 'title' => '查看'],
                            ['name' => 'gonglue/topiccomment/add', 'title' => '添加'],
                            ['name' => 'gonglue/topiccomment/edit', 'title' => '修改'],
                            ['name' => 'gonglue/topiccomment/del', 'title' => '删除'],
                            ['name' => 'gonglue/topiccomment/multi', 'title' => '批量更新'],
                        ]
                    ],
                    [
                        'name'    => 'gonglue/topic',
                        'title'   => '话题管理',
                        'sublist' => [
                            ['name' => 'gonelue/topic/index', 'title' => '查看'],
                            ['name' => 'gonelue/topic/add', 'title' => '添加'],
                            ['name' => 'gonelue/topic/edit', 'title' => '修改'],
                            ['name' => 'gonelue/topic/del', 'title' => '删除'],
                            ['name' => 'gonelue/topic/multi', 'title' => '批量更新'],
                        ]
                    ],

                    [
                        'name'    => 'gonglue/contentcategory',
                        'title'   => '内容分类管理',
                        'sublist' => [
                            ['name' => 'gonglue/contentcategory/index', 'title' => '查看'],
                            ['name' => 'gonglue/contentcategory/add', 'title' => '添加'],
                            ['name' => 'gonglue/contentcategory/edit', 'title' => '修改'],
                            ['name' => 'gonglue/contentcategory/del', 'title' => '删除'],
                            ['name' => 'gonglue/contentcategory/multi', 'title' => '批量更新'],
                        ]
                    ],
                    [
                        'name'    => 'gonglue/contentcomment',
                        'title'   => '内容评论管理',
                        'icon'    => 'fa fa-comment',
                        'sublist' => [
                            ['name' => 'gonglue/contentcomment/index', 'title' => '查看'],
                            ['name' => 'gonglue/contentcomment/add', 'title' => '添加'],
                            ['name' => 'gonglue/contentcomment/edit', 'title' => '修改'],
                            ['name' => 'gonglue/contentcomment/del', 'title' => '删除'],
                            ['name' => 'gonglue/contentcomment/multi', 'title' => '批量更新'],
                        ]
                    ],
                    [
                        'name'    => 'gonglue/content',
                        'title'   => '内容管理',
                        'icon'    => 'fa fa-th-large',
                        'sublist' => [
                            ['name' => 'gonglue/content/index', 'title' => '查看'],
                            ['name' => 'gonglue/content/add', 'title' => '添加'],
                            ['name' => 'gonglue/content/edit', 'title' => '修改'],
                            ['name' => 'gonglue/content/del', 'title' => '删除'],
                            ['name' => 'gonglue/content/multi', 'title' => '批量更新'],
                        ]
                    ]
                    
                ]
            ]
        ];
        //Menu::create($menu);
        return true;
    }

    /**
     * 插件卸载方法
     * @return bool
     */
    public function uninstall()
    {
        Menu::delete('gonglue');
        return true;
    }

    /**
     * 插件启用方法
     */
    public function enable()
    {
        Menu::enable('gonglue');
    }

    /**
     * 插件禁用方法
     */
    public function disable()
    {
        Menu::disable('gonglue');
    }

    public function xunsearchConfigInit()
    {
        return FulltextSearch::config();
    }

    public function xunsearchIndexReset($project)
    {
        if (!$project['isaddon'] || $project['name'] != 'gonglue') {
            return;
        }
        return FulltextSearch::reset();
    }

    /**
     * 脚本替换
     */
    public function viewFilter(& $content)
    {
        $request = \think\Request::instance();
        $dispatch = $request->dispatch();

        if ($request->module() || !isset($dispatch['method'][0]) || $dispatch['method'][0] != '\think\addons\Route') {
            return;
        }
        $addon = isset($dispatch['var']['addon']) ? $dispatch['var']['addon'] : $request->param('addon');
        if ($addon != 'gonglue') {
            return;
        }
        $style = '';
        $script = '';
        $result = preg_replace_callback("/<(script|style)\s(data\-render=\"(script|style)\")([\s\S]*?)>([\s\S]*?)<\/(script|style)>/i", function ($match) use (&$style, &$script) {
            if (isset($match[1]) && in_array($match[1], ['style', 'script'])) {
                ${$match[1]} .= str_replace($match[2], '', $match[0]);
            }
            return '';
        }, $content);
        $content = preg_replace_callback('/^\s+(\{__STYLE__\}|\{__SCRIPT__\})\s+$/m', function ($matches) use ($style, $script) {
            return $matches[1] == '{__STYLE__}' ? $style : $script;
        }, $result ? $result : $content);
    }
}
