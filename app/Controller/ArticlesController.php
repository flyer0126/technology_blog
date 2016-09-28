<?php
/**
 * UsersController class
 *
 * @uses          AppController
 * @package       mongodb
 * @subpackage    mongodb.samples.controllers
 */
App::uses('AppController', 'Controller');
class ArticlesController extends AppController {

    /**
     * name property
     */
	public $name = 'Articles';

    public $components = array('Paginator');

    public function beforeFilter() {
        parent::beforeFilter();
    }

    /**
     * index method
     *
     * @return void
     * @access public
     */
    public function admin_index() {
        $this->set('title_for_layout', '用户管理');

        $this->Paginator->settings = array(
            'conditions' => array(),
            'limit' => 10
        );
        $this->set('results', $this->Paginator->paginate('Article', array('Article.status' => '0')));
    }

    /**
     * add method
     *
     * @return void
     * @access public
     */
    public function admin_add() {
        $this->set('title_for_layout', '用户管理-添加');

        if (!empty($this->data)) {
            $title      = isset($this->data['Article']['title']) ? trim($this->data['Article']['title']) : '';
            $categoryId = isset($this->data['Article']['category_id']) ? trim($this->data['Article']['category_id']) : '';
            $content    = isset($this->data['Article']['content']) ? trim($this->data['Article']['content']) : '';

            // 验证必要参数的完整性
            if(empty($title) || empty($categoryId) || empty($content)){
                $this->Session->setFlash('请完善必要信息！');
            } else {
                // 添加记录
                $this->Article->create();
                if ($this->Article->save($this->data)) {
                    $this->Session->setFlash('添加成功！');
                    $this->redirect('/admin/articles/index');
                } else {
                    $this->Session->setFlash('添加失败！');
                }
            }
        } else {
            $this->loadModel('Category');
            $this->set('categories', $this->Category->find('all', array('conditions' => array('status' => '0'))));
        }
    }

    /**
     * view method
     *
     * @param mixed $id null
     * @return void
     * @access public
     */
    public function admin_view($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash('无效的类型！');
            $this->redirect('/admin/articles/index');
        }
        $this->set('article', $this->Article->find('first', array('conditions' => array('Article.id' => $id))));
    }

    /**
     * edit method
     *
     * @param mixed $id null
     * @return void
     * @access public
     */
    public function admin_edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash('无效的文章！');
            $this->redirect('/admin/articles/index');
        }
        if (!empty($this->data)) {
            $this->Article->id = $id;
            if ($this->Article->save($this->data)) {
                $this->Session->setFlash('编辑成功！');
                $this->redirect('/admin/articles/index');
            } else {
                $this->Session->setFlash('编辑失败！');
            }
        }
        if (empty($this->data)) {
            $this->loadModel('Category');
            $this->set('categories', $this->Category->find('all', array('conditions' => array('status' => '0'))));
            $this->set('article', $this->Article->read(null, $id));
        }
    }

    /**
     * delete method
     *
     * @param mixed $id null
     * @return void
     * @access public
     */
    public function admin_delete($id = null) {
        $this->layout = false;
        $this->autoRender = false;

        // 验证参数及是否对应记录
        if (!$id) {
            $this->Session->setFlash('无效的文章！');
            $this->redirect('/admin/articles/index');
        }
        $user = $this->Article->read(null, $id);
        if (empty($user)) {
            $this->Session->setFlash('无效的文章！');
            $this->redirect('/admin/articles/index');
        }

        // 执行删除操作
        $this->Article->id = $id;
        if ($this->Article->save(array('status' => '1'))) {
            $this->Session->setFlash('删除成功！');
        } else {
            $this->Session->setFlash('删除失败！');;
        }
        $this->redirect('/admin/articles/index');
    }

}