<?php
/**
 * Created by PhpStorm.
 * User: YoheiSugiyama
 * Date: 15/02/28
 * Time: 4:51
 */

class UsersController extends AppController{

    public $uses=array('IdPass','User');

    public function beforeFilter()
    {
        //ログインなしでアクセス可能なページを列挙
        $this->Auth->allow('add');
//        $this->Auth->fields = array('username' => 'email', 'password' => 'password');
    }

    public function login()
    {
       //Auth認証（ログイン）
        if ($this->request->isPost()) {
            if ($this->Auth->login()) {

                $this->Session->setFlash(__('ログイン成功!'));
                $this->redirect(array('controller'=>'IdPasses','action'=>'index'));

            } else {
                $this->Session->setFlash(__('ユーザー名とパスワードが正しくありません。もう一度試して下さい。'));
            }
        }
    }

    public function logout(){
        $this->Auth->logout();
        $this->redirect(array('controller'=>'Users','action'=>'login'));
    }

    public function add(){
        // addはeditと同じ処理。ただしidは無指定
        return $this->edit();
    }


    public function edit($id=null){
        // フォーム入力があった場合には保存処理。
        if($this->request->isPost()||$this->request->isPut()){
            //edit時にもパスワードが空白だったら対象外にする
            if($id!==null){
                if($this->request->data[$this->User->alias]['password']==''){
                    unset($this->request->data[$this->User->alias]['password']);
                }
            }
            if($this->User->save($this->request->data)){
                $this->Session->setFlash('ユーザー情報を保存しました');
//                $this->redirect(array('action'=>'userlist'));
            }else{
                $this->Session->setFlash('入力に間違いがあります');
            }
            //フォーム入力がなく、初めて編集ページが表示された場合、初期値の準備
        }else{
            if($id!=null){
                $this->request->data=$this->User->findById($id);
                //パスワードまで編集画面で見せる必要がないので、unsetする。
                unset($this->request->data[$this->User->alias]['password']);

                if(empty($this->request->data)){
                    $this->Session->setFlash('ユーザが見つかりませんでした');
                    $this->redirect(array('action'=>'userlist'));
                }
            }
        }
        //addもeditもedit.ctpを表示する（明示）
        $this->render('edit');
    }



}