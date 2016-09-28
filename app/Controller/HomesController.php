<?php
/**
 * UsersController class
 *
 * @uses          AppController
 * @package       mongodb
 * @subpackage    mongodb.samples.controllers
 */
App::uses('AppController', 'Controller');
class HomesController extends AppController {

    /**
     * name property
     */
	public $name = 'Homes';

    public $components = array('Paginator');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->layout = 'common';

        $this->Paginator->settings = array(
            'order' => array('Article.created' => 'desc'),
            'limit' => 10
        );

        $this->loadModel('Category');
        $this->set('categories', $this->Category->find('all', array('conditions' => array('status' => 0))));
    }

    /**
     * home method
     *
     * @return void
     * @access public
     */
	public function index() {
        $this->loadModel('Article');
        $this->Article->recursive = -1;
        $articles = $this->Paginator->paginate('Article',
            array('Article.status' => 0, 'Article.islove' => 1)
        );
        $this->set(compact('category', 'articles'));

	}

    /**
     * listByCategory
     * @param null $id categoryId
     */
    public function listByCategory($id = null) {
        // 验证参数及是否对应记录
        if (!$id) {
            $this->Session->setFlash('无效的类型！');
            $this->redirect('/homes/index');
        }
        $this->loadModel('Category');
        $category = $this->Category->findById($id);
        if(empty($category)){
            $this->Session->setFlash('无效的类型！');
            $this->redirect('/homes/index');
        }
        $this->loadModel('Article');
        $this->Article->recursive = -1;
        $articles = $this->Paginator->paginate('Article',
            array('Article.status' => 0, 'Article.category_id' => $id)
        );
        $this->set(compact('category', 'articles'));
    }

    /**
     * view method
     *
     * @param mixed $id null
     * @return void
     * @access public
     */
    public function view($id = null) {
        if (!intval($id)) {
            $this->Session->setFlash('无效的类型！');
            $this->redirect('/homes/index');
        }
        $this->loadModel('Article');
        $this->set('article', $this->Article->find('first', array('conditions' => array('Article.id' => $id))));
    }

    /**
     * 操作喜欢
     * @param null $id
     * @param int $status
     */
    public function loveArticle($id = null, $status = 0){
        if (!intval($id)) {
            $this->Session->setFlash('无效的类型！');
            $this->redirect('/homes/index');
        }
        $this->loadModel('Article');
        $this->Article->id = $id;
        if ($this->Article->save(array('Article' => array('islove' => $status)))) {
        //if ($this->Article->saveField('Article.islove', $status)) {
            $this->Session->setFlash(__('操作成功！'));
        } else {
            $this->Session->setFlash(__('操作失败！'));
        }
        $this->redirect($_SERVER[HTTP_REFERER]);
    }

}