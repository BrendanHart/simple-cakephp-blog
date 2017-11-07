<?php

class PostsController extends AppController {

    public $uses = array('Post', 'User');

    public $helpers = array('Html', 'Form');

    public function isAuthorized($user) {
        if($this->action === 'add') {
            return true;
        }

        if(in_array($this->action, array('edit', 'delete'))) {
            $postId = (int) $this->request->params['pass'][0];
            if($this->Post->isOwnedBy($postId, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

    public function index() {
        $posts = $this->Post->find('all');
        $length = count($posts);
        for($i = 0; $i < $length; $i++) {
            $user = $this->User->findById($posts[$i]['Post']['user_id']);
            if(count($user) > 0) {
                $posts[$i]['User']['found'] = true;
                $posts[$i]['User']['username'] = $user['User']['username'];
            } else {
                $posts[$i]['User']['found'] = false;
            }
        }
        $this->set('posts', $posts);
    }

    public function view($id = null) {
        if(!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $post = $this->Post->findById($id);
        if(!$post) {
            throw new NotFoundException(__('Invalid post'));
        }

        $user = $this->User->findById($post['Post']['user_id']);
        if(count($user) > 0) {
            $post['User']['found'] = true;
            $post['User']['username'] = $user['User']['username'];
        } else {
            $post['User']['found'] = false;
        }

        $this->set('post', $post);
    }

    public function add() {
        if($this->request->is('post')) {
            $this->Post->create();
            $this->request->data['Post']['user_id'] = $this->Auth->user('id');
            if($this->Post->save($this->request->data)) {
                $this->Flash->success(__('Your post has been saved.'));
                return $this->redirect(array('action'=>'index'));
            }
            $this->Flash->error(__('Unable to add your post.'));
        }
    }

    public function edit($id = null) {
        if(!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $post = $this->Post->findById($id);
        if(!$post) {
            throw new NotFoundException(__('Invalid post'));
        }

        if($this->request->is(array('post', 'put'))) {
            $this->Post->id = $id;
            if($this->Post->save($this->request->data)) {
                $this->Flash->success(__('Your post has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to update your post.'));
        }

        if(!$this->request->data) {
            $this->request->data = $post;
        }
    }

    public function delete($id = null) {
        if($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if($this->Post->delete($id)) {
            $this->Flash->success(
                __('The post with id: %s has been deleted.', h($id))
            );
        } else {
            $this->Flash->error(
                __('The post with id: %s could not be deleted.', h($id))
            );
        }

        return $this->redirect(array('action' => 'index'));

    }

}

?>
