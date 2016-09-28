<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    /**
     * 获取操作列表
     */
    protected function _getMenu() {
        $this->_checkLogin();

        $this->loadModel('Group');
        $group = $this->Group->findById($this->Session->read('userInfo.groupId'));

        $this->loadModel('Resource');
        $menus = $this->Resource->find('all', array('conditions' => array('isMenu'=>'1')));
        $data = array();
        foreach($menus as $menu){
            if(in_array($menu['Resource']['_id'], $group['Group']['auth'])){
                if($menu['Resource']['isParent']){
                    $data[$menu['Resource']['parentId']]['childMenu'][] = $menu['Resource'];
                }else{
                    $data[$menu['Resource']['_id']] = $menu['Resource'];
                }
            }
        }
        $this->set('menus', $data);
    }

    /**
     * 权限校验
     */
    protected function _checkLogin() {
        if (!$this->Session->check('adminId')) {
            $this->Session->setFlash('验证权限错误，请先登录');
            $this->redirect('/');
        }
    }
}
