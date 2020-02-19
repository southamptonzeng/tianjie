<?php

namespace app\admin\controller\gonglue;

use app\common\controller\Backend;
use think\Request;

/**
 * 内容管理
 *
 * @icon fa fa-circle-o
 */
class Content extends Backend
{

    /**
     * Content模型对象
     * @var \app\admin\model\gonglue\Content
     */
    protected $model = null;
    protected $noNeedLogin = ['category', 'categoryContent', 'view', 'addComment', 'addContent', 'searchContent', 'likeContent', 'likeComment'];

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\gonglue\Content;
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
        $category = new \app\admin\model\gonglue\Contentcategory();
        $page = $request->param('page');
        $num = $request->param('num');

        $data = $category->page($page, $num)->select();
        return json($data);
    }

    /**
     * 具体分类下的文章
     */
    public function categoryContent(Request $request)
    {
        $content = new \app\admin\model\gonglue\Content();
        $category_id = $request->param('category_id');
        $num = $request->param('num');
        $page = $request->param('page');
        return json($content
            ->where('category_id', $category_id)
            ->page($page, $num)->select());

    }

    /**
     * 浏览单个博文
     */
    public function view(Request $request)
    {

        $data = $request->param('content_id');
        $num = $request->param('num');
        $page = $request->param('page');

        $content = new \app\admin\model\gonglue\Content();
        $viewData = $content->where('id', $data)->find();
        $content->where('id', $data)->setInc('views');

        $contentComment = new \app\admin\model\gonglue\Contentcomment();
        $commentData = $contentComment->where('content_id', $data)->page($page, $num)->select();

        $view = [
            'viewData' => $viewData,
            'commentData' => $commentData
        ];
        return json($view);

    }

    /**
     * 添加评论
     */
    public function addComment(Request $request)
    {

        $data = $request->param();
        $contentComment = new \app\admin\model\gonglue\Contentcomment();
        $result = $contentComment->addComment($data);
        if ($result == 1) {
            $content_id = $request->param('content_id');
            $content = new \app\admin\model\gonglue\Content();
            $content->where('id', $content_id)->setInc('comments');

            $this->success('评论添加成功');
        } else {
            $this->error($result);
        }

    }

    /**
     * 添加文章
     */
    public function addContent(Request $request)
    {

        $data = $request->param();
        $content = new \app\admin\model\gonglue\Content();
        $result = $content->addContent($data);
        if ($result == 1) {
            $this->success('文章添加成功');
        } else {
            $this->error($result);
        }

    }

    /**
     * 搜索文章
     */
    public function searchContent(Request $request)
    {
        $keywords = $request->param('keywords');  //获取搜索关键字
        $page = $request->param('page');
        $num = $request->param('num');

        $where['title|content'] = array('like','%'.$keywords.'%');  //用like条件搜索title和content两个字段
        $Content = new \app\admin\model\gonglue\Content();
        $data =$Content->where($where)->page($page, $num)->select();
        return json($data);
    }

    /**
     * 文章点赞
     */
    public function likeContent(Request $request) {
        $content_id = $request->param('content_id');

        $content = new \app\admin\model\gonglue\Content();
        $content->where('id', $content_id)->setInc('likes');
        $this->success('点赞成功');
    }

    /**
     * 文章评论点赞
     */
    public function likeComment(Request $request) {
        $comment_id = $request->param('comment_id');

        $comment = new \app\admin\model\gonglue\Contentcomment();
        $comment->where('id', $comment_id)->setInc('likes');
        $this->success('点赞成功','');
    }
}