<?php


 class IdPassesController extends AppController{

     public $uses=array('IdPass','User');

     public $helpers = array('Html', 'Form');

     public $paginate = array(
         'limit'=>10,
         'order'=>array(
             'User.id'=>'ASC',
         ),
     );

     public function beforeFilter(){
         $user=$this->Auth->user();
         $this->set('user', $user);
    }


     public function index(){
         $id_passes=$this->paginate('IdPass',array('IdPass.id not'=>null));
         $this->set('id_passes', $id_passes);
     }


     public function add(){
         // addはeditと同じ処理。ただしidは無指定
         return $this->modify();
     }

     public function modify($id=null){
         //modifyの場合の処理
         if($this->request->is('post')) {
             if (isset($this->request->data['IdPass']['modify'])) {
                 $id = $this->request->data['IdPass']['modify'];
                 $options = array(
                     'conditions' => array(
                         'IdPass.id' => $id
                     )
                 );

                 $id_pass = $this->IdPass->find('first', $options);

                 //データが見つからない場合は一覧へ
                 if ($id_pass == false) {
                     $this->Session->setFlash('タスクが見つかりません');
                     $this->redirect('/id_passes/index');
                 } else {
                     //データがある場合は、初期データをフォームにセット
                     $this->request->data = $id_pass;
                 }

             } else {

                 $app_data = array(
                     'app_name' => $this->request->data['IdPass']['app_name'],
                     'app_id' => $this->request->data['IdPass']['app_id'],
                     'app_password' => $this->request->data['IdPass']['app_password']
                 );

                 if ($this->IdPass->save($app_data)) {
                     $this->Session->setFlash('更新しました');
                     $this->redirect('index');
                 }
             }
         }else{
             //add の場合の処理、以下を一応明示しないと、add.ctpを探しに行ってしまうため。
             $this->render('modify');
         }
     }

     public function delete($id=null){

         $id = $this->request->data['IdPass']['delete'];

         if (!$id) {
             throw new NotFoundException(__('無効な動作です'));
         }

         $this->IdPass->delete($id);

         $this->Session->setFlash('削除しました');
         $this->redirect('index');
     }


     public function master(){
         if($this->request->is('post')) {
             $master_data = array(
                 'name' => $this->request->data['User']['name'],
                 'username' => $this->request->data['User']['username'],
                 'user_email' => $this->request->data['User']['user_email'],
                 'password' => $this->request->data['User']['password']
             );


             if ($this->User->save($master_data)) {
                 $this->Session->setFlash('更新しました');
                 $this->redirect('index');
             }

         }else{

             $data=$this->Auth->user();
             $options = array(
                 'conditions' => array(
                     'User.username' => $data['username']
                 )
             );

             $master_data= $this->User->find('first', $options);
             $this->request->data = $master_data;


         }


     }

 }