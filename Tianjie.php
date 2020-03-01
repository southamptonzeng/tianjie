<?php

namespace addons\tianjie;

use addons\tianjie\library\FulltextSearch;
use app\common\library\Menu;
use think\Addons;

/**
 * 博客插件
 */
class Tianjie extends Addons
{

    /**
     * 插件安装方法
     * @return bool
     */
    public function install()
    {
        $menu = [
            [
                'name'    => 'tianjie',
                'title'   => '天街水城',
                'sublist' => [
                    [
                        'name'    => 'tianjie/shopcategory',
                        'title'   => '店铺分类管理',
                        'sublist' => [
                            ['name' => 'tianjie/shopcategory/index', 'title' => '查看'],
                            ['name' => 'tianjie/shopcategory/add', 'title' => '添加'],
                            ['name' => 'tianjie/shopcategory/edit', 'title' => '修改'],
                            ['name' => 'tianjie/shopcategory/del', 'title' => '删除'],
                            ['name' => 'tianjie/shopcategory/multi', 'title' => '批量更新'],
                        ]
                    ],


                    [
                        'name'    => 'tianjie/shop',
                        'title'   => '店铺管理',
                        'sublist' => [
                            ['name' => 'tianjie/shop/index', 'title' => '查看'],
                            ['name' => 'tianjie/shop/add', 'title' => '添加'],
                            ['name' => 'tianjie/shop/edit', 'title' => '修改'],
                            ['name' => 'tianjie/shop/del', 'title' => '删除'],
                            ['name' => 'tianjie/shop/multi', 'title' => '批量更新'],
                        ]
                    ],
                    [
                        'name'    => 'tianjie/shopcomment',
                        'title'   => '店铺评论管理',
                        'sublist' => [
                            ['name' => 'tianjie/shopcomment/index', 'title' => '查看'],
                            ['name' => 'tianjie/shopcomment/add', 'title' => '添加'],
                            ['name' => 'tianjie/shopcomment/edit', 'title' => '修改'],
                            ['name' => 'tianjie/shopcomment/del', 'title' => '删除'],
                            ['name' => 'tianjie/shopcomment/multi', 'title' => '批量更新'],
                        ]
                    ],
                    [
                        'name'    => 'tianjie/shuffle',
                        'title'   => '轮播图管理',
                        'sublist' => [
                            ['name' => 'tianjie/shuffle/index', 'title' => '查看'],
                            ['name' => 'tianjie/shuffle/add', 'title' => '添加'],
                            ['name' => 'tianjie/shuffle/edit', 'title' => '修改'],
                            ['name' => 'tianjie/shuffle/del', 'title' => '删除'],
                            ['name' => 'tianjie/shuffle/multi', 'title' => '批量更新'],
                        ]
                    ]

                ]
            ]
        ];
        Menu::create($menu);
        return true;
    }

    /**
     * 插件卸载方法
     * @return bool
     */
    public function uninstall()
    {
        Menu::delete('tianjie');
        return true;
    }

    /**
     * 插件启用方法
     */
    public function enable()
    {
        Menu::enable('tianjie');
    }

    /**
     * 插件禁用方法
     */
    public function disable()
    {
        Menu::disable('tianjie');
    }

    public function xunsearchConfigInit()
    {
        return FulltextSearch::config();
    }

    public function xunsearchIndexReset($project)
    {
        if (!$project['isaddon'] || $project['name'] != 'tianjie') {
            return;
        }
        return FulltextSearch::reset();
    }

    /**
     * 脚本替换
     */
    public function viewFilter(& $shop)
    {
        $request = \think\Request::instance();
        $dispatch = $request->dispatch();

        if ($request->module() || !isset($dispatch['method'][0]) || $dispatch['method'][0] != '\think\addons\Route') {
            return;
        }
        $addon = isset($dispatch['var']['addon']) ? $dispatch['var']['addon'] : $request->param('addon');
        if ($addon != 'tianjie') {
            return;
        }
        $style = '';
        $script = '';
        $result = preg_replace_callback("/<(script|style)\s(data\-render=\"(script|style)\")([\s\S]*?)>([\s\S]*?)<\/(script|style)>/i", function ($match) use (&$style, &$script) {
            if (isset($match[1]) && in_array($match[1], ['style', 'script'])) {
                ${$match[1]} .= str_replace($match[2], '', $match[0]);
            }
            return '';
        }, $shop);
        $shop = preg_replace_callback('/^\s+(\{__STYLE__\}|\{__SCRIPT__\})\s+$/m', function ($matches) use ($style, $script) {
            return $matches[1] == '{__STYLE__}' ? $style : $script;
        }, $result ? $result : $shop);
    }
}
