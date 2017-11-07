<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController {

    public $uses = array('User', 'Post');

    public function login() {
        if($this->request->is('post')) {
            if($this->Auth->login()) {
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again.'));
        }
    }

    public function makeAdmin($id = null) {
        if(!$id) {
            throw new NotFoundException(__('Invalid user'));
        }

        $post = $this->User->findById($id);
        if(!$post) {
            throw new NotFoundException(__('Invalid user'));
        }

        if($this->request->is(array('post', 'put'))) {
            $this->User->id = $id;
            if($this->User->saveField('role', 'admin')) {
                $this->Flash->success(__('User has been made an admin.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to make user an admin'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add', 'logout');
    }
    
    public function add() {
        if($this->request->is('post')) {
            $this->User->create();
            if($this->User->save($this->request->data)) {
                $this->Flash->success(__('User has been created.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(
                __('User could not be created. Please try again.')
            );
        }
    }

    public function index() {
        $this->User->recursive = 0;
        $users = $this->paginate();
        for($i = 0; $i < count($users); $i++) {
            $count = count($this->Post->findByUserId($users[$i]['User']['id']));
            $users[$i]['User']['post_count'] = $count;
        }
        $this->set('users', $users);
    }

    public function view($id = null) {
        $this->User->id = $id;
        if(!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->findById($id));
        $this->set('posts', $this->Post->findByUserId($id));
        if($this->request->is('post')) {
            $this->User->create();
            if($this->User->save($this->request->data)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(
                __('The user could not be saved. Please, try again.')
            );
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if(!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if($this->request->is('post') || $this->request->is('put')) {
            if($this->User->save($this->request->data)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(
                __('The user could not be saved. Please, try again.')
            );
        } else {
            $this->request->data = $this->User->findById($id);
            unset($this->request->data['user']['password']);
        }
    }

    public function delete($id = null) {
        $this->request->allowMethod('post');

        $this->User->id = $id;
        if(!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if($this->User->delete()) {
            $this->Flash->success(__('User deleted'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__('User was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }

}
