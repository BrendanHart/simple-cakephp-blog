<?php

App::uses('AppModel', 'Model');

class Post extends AppModel {

    public $validate = array(
        'title' => array(
            'rule' => 'notBlank'
        ),
        'body' => array(
            'rule' => 'notBlank'
        )
    );

    public function isOwnedBy($postId, $userId) {
        return $this->field('id', array('id' => $postId, 'user_id' => $userId)) !== false;
    }

}

