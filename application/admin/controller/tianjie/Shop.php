<?php

namespace app\admin\controller\tianjie;

use app\common\controller\Backend;
use think\Request;



/**
 * 店铺管理
 *
 * @icon fa fa-circle-o
 */
class Shop extends Backend
{
    
    /**
     * Shop模型对象
     * @var \app\admin\model\tianjie\Shop
     */
    protected $model = null;
    protected $noNeedLogin = [
        'category',
        'categoryShop',
        'hotShop',
        'viewShop',
        'viewComment',
        'addComment',
        'likeComment',
        'searchShop'
    ];

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\tianjie\Shop;
        $this->view->assign("statusList", $this->model->getStatusList());
    }
    
    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */

    /**
     * 获取分类
     */
    public function category(Request $request)
    {
        $category = new \app\admin\model\tianjie\Shopcategory();
        $page = $request->param('page');
        $num = $request->param('num');

        $data = $category->page($page, $num)->select();
        return json($data);
    }

    /**
     * 具体分类下的店铺
     */
    public function categoryShop(Request $request)
    {
        $shop = new \app\admin\model\tianjie\Shop();
        $category_id = $request->param('category_id');
        $num = $request->param('num');
        $page = $request->param('page');
        return json($shop
            ->where('category_id', $category_id)
            ->page($page, $num)->select());
    }

    /**
     * 获取爆款推荐内容
    */
    public function hotShop(Request $request)
    {
        $page = $request->param('page');
        $num = $request->param('num');
        $shop = new \app\admin\model\tianjie\Shop();
        $hotShop = $shop->order('comments', 'desc')->page($page, $num)->select();
        return json($hotShop);
    }


    /**
     * 浏览单个店铺
     */
    public function viewShop(Request $request)
    {

        $data = $request->param('shop_id');

        $shop = new \app\admin\model\tianjie\Shop();
        $viewData = $shop->where('id', $data)->find();
        return json($viewData);

    }

    /**
     * 浏览店铺的评论
    */
    public function viewComment(Request $request)
    {
        $data = $request->param('shop_id');
        $num = $request->param('num');
        $page = $request->param('page');

        $shopComment = new \app\admin\model\tianjie\Shopcomment();
        $commentData = $shopComment->where('shop_id', $data)->page($page, $num)->select();
        return json($commentData);
    }


    /**
     * 添加评论，计算评分
     */
    public function addComment(Request $request)
    {

        $data = [
            'shop_id' => $request->param('shop_id'),
            'username' => $request->param('username'),
            'avatar' => $request->param('avatar'),
            'content' => $request->param('content'),
            'quality' => $request->param('quality'),
            'service' => $request->param('service'),
            'product' => $request->param('product')
        ];

        $averagescore = ($data['product'] + $data['quality'] + $data['service'])/3;

        $data = array_merge($data,
            ['averagescore' => $averagescore]);

        $shopComment = new \app\admin\model\tianjie\Shopcomment();
        $result = $shopComment->addComment($data);

        if ($result == 1) {
            $shop = new \app\admin\model\tianjie\Shop();

            $shop->where('id', $data['shop_id'])->setInc('comments');

            //求评平均分
            $score= $shop->where('id', $data['shop_id'])->value('score');
            $comments = $shop->where('id',$data['shop_id'])->value('comments');
            $score = ($score*($comments - 1) + $averagescore)/$comments;

            $shop->where('id', $data['shop_id'])->setField('score', $score);

            $this->success('评论添加成功');
        } else {
            $this->error($result);
        }

    }


    /**
     * 评论点赞
     */
    public function likeComment(Request $request) {
        $comment_id = $request->param('comment_id');

        $comment = new \app\admin\model\tianjie\Shopcomment();
        $comment->where('id', $comment_id)->setInc('likes');
        $this->success('点赞成功');
    }

    /**
     * 搜索店铺
    */
    public function searchShop(Request $request)
    {
        $keywords = $request->param('keywords');  //获取搜索关键字
        $page = $request->param('page');
        $num = $request->param('num');

        $where['shopname|description|address'] = array('like','%'.$keywords.'%');  //用like条件搜索shopname，description，address字段
        $shop = new \app\admin\model\tianjie\Shop();
        $data =$shop->where($where)->page($page, $num)->select();
        return json($data);
    }
}