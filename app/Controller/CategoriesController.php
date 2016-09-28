<?php
/**
 * UsersController class
 *
 * @uses          AppController
 * @package       mongodb
 * @subpackage    mongodb.samples.controllers
 */
App::uses('AppController', 'Controller');
class CategoriesController extends AppController {

    /**
     * name property
     */
	public $name = 'Categories';

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
        $this->set('results', $this->Paginator->paginate('Category', array('status' => '0')));
    }

    /**
     * add method
     *
     * @return void
     * @access public
     */
    public function admin_add() {
        if (!empty($this->data)) {
            $title  = isset($this->data['Category']['title']) ? trim($this->data['Category']['title']) : '';

            // 验证必要参数的完整性
            if(empty($title)){
                $this->Session->setFlash('请完善必要信息！');
            } else {
                // 添加记录
                $this->Category->create();
                if ($this->Category->save($this->data)) {
                    $this->Session->setFlash('添加成功！');
                    $this->redirect('/admin/categories/index');
                } else {
                    $this->Session->setFlash('添加失败！');
                }
            }
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
            $this->redirect('/admin/categories/index');
        }
        $this->set('category', $this->Category->find('first', array('conditions' => array('id' => $id))));
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
            $this->Session->setFlash('无效的类型！');
            $this->redirect('/admin/categories/index');
        }
        if (!empty($this->data)) {
            $this->Category->id = $id;
            if ($this->Category->save($this->data)) {
                $this->Session->setFlash('编辑成功！');
                $this->redirect('/admin/categories/index');
            } else {
                $this->Session->setFlash('编辑失败！');
            }
        } else {
            $this->set('category', $this->Category->find('first', array('conditions' => array('id' => $id))));
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
            $this->Session->setFlash('无效的类型！');
            $this->redirect('/admin/categories/index');
        }
        $category = $this->Category->read(null, $id);
        if (empty($category)) {
            $this->Session->setFlash('无效的类型！');
            $this->redirect('/admin/categories/index');
        }

        // 执行删除操作
        $this->Category->id = $id;
        if ($this->Category->save(array('status' => '1'))) {
            $this->Session->setFlash('删除成功！');
        } else {
            $this->Session->setFlash('删除失败！');;
        }
        $this->redirect('/admin/categories/index');
    }

}