<?php
/**
 * Created by PhpStorm.
 * User: YoheiSugiyama
 * Date: 15/03/01
 * Time: 18:20
 */

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');


class SendMailController extends AppController
{

    public $name = 'SendMail';

    public function send()
    {
        $email = new CakeEmail('default');
        $email->from('yoheisugiyamameister@gmail.com');
        $email->to(array('yoheisugiyamameister@gmail.com' => '杉山　洋平'));
        $email->subject('メールサブジェクト');
        $email->send('メール本文');

    }

}