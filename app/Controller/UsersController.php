<?php
/**
 * UsersController class
 *
 * @uses          AppController
 * @package       mongodb
 * @subpackage    mongodb.samples.controllers
 */
App::uses('AppController', 'Controller');
class UsersController extends AppController {

    /**
     * name property
     */
	public $name = 'Users';

    public $components = array('Paginator');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->layout = 'common';
    }

    /**
     * User login
     */
    public function login(){
        $this->layout = false;
        if ($this->Session->check('adminName')) {
            $this->redirect('/homes/index');
        }

        if (!empty($this->data)) {
            $username = isset($this->data['User']['username']) ? trim($this->data['User']['username']) : '';
            $password = isset($this->data['User']['password']) ? trim($this->data['User']['password']) : '';

            // 数据校验
            if (empty($username) || empty($password)) {
                $this->Session->setFlash(__('用户名或密码为空，请重试.', true));
                $this->redirect(array('action' => 'login'));
            }

            // 查询
            if(md5($username) == '026a31065c7e6aa3011f1e14abd963a9' && md5($password) == 'bf230ebbe18fbace5f5178e523cd98f8'){
                $this->Session->write('adminName', 'zhangh');
                $this->redirect('/homes/index');
            } else {
                $this->Session->setFlash(__('用户名或密码错误.', true));
            }
        }
    }

    /**
     * User logout
     */
    public function logout() {
        $this->Session->destroy();
        $this->redirect('/');
    }

    /**
     * home method
     *
     * @return void
     * @access public
     */
	public function home() {
        //$this->_getMenu();
        $this->set('title_for_layout', '控制面板');

        $this->loadModel('Category');
        $this->set('categories', $this->Category->find('all', array('conditions' => array('status' => 0))));
	}

    /**
     * admin_home method
     *
     * @return void
     * @access public
     */
    public function admin_home() {
        $this->layout = 'default';
        $this->set('title_for_layout', '控制面板');
    }

    /**
     * index method
     *
     * @return void
     * @access public
     */
    public function index() {
        $this->_getMenu();
        $this->set('title_for_layout', '用户管理');

        $this->Paginator->settings = array(
            'conditions' => array(),
            'limit' => 10
        );
        $results = $this->Paginator->paginate('User');

        $this->loadModel('Group');
        foreach($results as &$rlt){
            $group = $this->Group->read(null, $rlt['User']['groupId']);
            $rlt['User']['groupName'] = isset($group['Group']['name']) ? $group['Group']['name'] : '';
        }
        $this->set(compact('results'));
    }

    /**
     * add method
     *
     * @return void
     * @access public
     */
    public function add() {
        $this->_getMenu();
        $this->set('title_for_layout', '用户管理-添加');

        if (!empty($this->data)) {//print_r($this->data);exit;
            $name       = isset($this->data['User']['name']) ? trim($this->data['User']['name']) : '';
            $loginname  = isset($this->data['User']['loginname']) ? trim($this->data['User']['loginname']) : '';
            $password   = isset($this->data['User']['password']) ? trim($this->data['User']['password']) : '';
            $groupId    = isset($this->data['User']['groupId']) ? trim($this->data['User']['groupId']) : '';

            // 验证必要参数的完整性
            if(empty($name) || empty($loginname) || empty($password) || empty($groupId)){
                $this->Session->setFlash('请完善必要信息！');
            } else {
                // 更新密码生成规则
                $tmpData = array('User' => array(
                    'name'      => $name,
                    'loginname' => $loginname,
                    'password'  => md5(md5($password).Configure::read('Password.Salt')),
                    'groupId'   => $groupId
                ));
                // 添加记录
                $this->User->create();
                if ($this->User->save($tmpData)) {
                    $this->Session->setFlash('添加成功！');
                    $this->redirect('/users/index');
                } else {
                    $this->Session->setFlash('添加失败！');
                }
            }
        } else {
            $this->loadModel('Group');
            $this->set('groups', $this->Group->find('all', array('fields' => array('_id', 'name'))));
        }
    }

    /**
     * edit method
     *
     * @param mixed $id null
     * @return void
     * @access public
     */
    public function edit($id = null) {
        $this->_getMenu();
        $this->set('title_for_layout', '用户管理-编辑');

        if (!$id && empty($this->data)) {
            $this->Session->setFlash('无效的用户！');
            $this->redirect('/users/index');
        }
        if (!empty($this->data)) {
            $this->User->id = $id;
            if ($this->User->save($this->data)) {
                $this->Session->setFlash('编辑成功！');
                $this->redirect('/users/index');
            } else {
                $this->Session->setFlash('编辑失败！');
            }
        }
        if (empty($this->data)) {
            $this->loadModel('Group');
            $this->set('groups', $this->Group->find('all', array('fields' => array('_id', 'name'))));
            $this->set('user', $this->User->read(null, $id));
        }
    }

    /**
     * delete method
     *
     * @param mixed $id null
     * @return void
     * @access public
     */
    public function delete($id = null) {
        $this->layout = false;
        $this->autoRender = false;

        // 验证参数及是否对应记录
        if (!$id) {
            $this->Session->setFlash('无效的用户！');
            $this->redirect('/users/index');
        }
        $user = $this->User->read(null, $id);
        if (empty($user)) {
            $this->Session->setFlash('无效的用户！');
            $this->redirect('/users/index');
        }

        // 执行删除操作
        if ($this->User->delete($id)) {
            $this->Session->setFlash('删除成功！');
        } else {
            $this->Session->setFlash('删除失败！');;
        }
        $this->redirect('/users/index');
    }

}