<?php
/**
 * Created by PhpStorm.
 * User: YoheiSugiyama
 * Date: 15/02/28
 * Time: 4:51
 */

App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');


class User extends AppModel{




    function beforeSave($options=array()){
        //パスワードが入力されている場合は暗号化する

        if(!empty($this->data[$this->alias]['password'])){
            $passwordHasher = new SimplePasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash($this->data[$this->alias]['password']);
        }

        return true;
    }


}