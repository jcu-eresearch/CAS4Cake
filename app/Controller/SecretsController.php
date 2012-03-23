<?php

App::uses('AppController', 'Controller');

class SecretsController extends AppController {

    public function index() {
        if($this->Auth->loggedIn()){
            $this->set('loggedIn', TRUE);
            $this->set('user', $this->Auth->user('username'));
        } else {
            $this->set('loggedIn', FALSE);
        }
        $this->render('/secret');
    }

}
