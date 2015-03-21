<div class="sidebar">
    <h1 class="main_signup">PASSNOTE</h1>
    <ul class="sidebar_list list-unstyled nav nav-pills nav-stacked">
        <li><?php echo $this->Html->link('IDパスワード登録',array('action'=>'add')); ?></li>
        <li><?php echo $this->Html->link('マスター設定',array('action'=>'master')); ?></li>
        <li><?php echo $this->Html->link('ログアウト',array('controller' =>'Users', 'action'=>'logout')); ?></li>
    </ul>
</div>

<div class="main_contents">
    <h1 class="main_signup">IDパスワード登録画面</h1>
<!--    <form method="post" class="form-horizontal" onSubmit="return RunConfirm();">-->
        <?php echo $this->Form->create('IdPass',array('type'=>'post','action'=>'modify', 'class'=>'form-horizontal')); ?>
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label" for="formGroupInputLarge">アプリケーション名</label>
            <div class="col-sm-6">
<!--                <input class="form-control" type="text" id="formGroupInputLarge" placeholder="アプリケーション名" name="app_name" value="--><?php //echo($app_info['app_name']);?><!--">-->
                <?php echo $this->Form->input('app_name',array('type'=>'text','label'=>false,'required'=>false, 'class'=>'form-control', 'id'=>'formGroupInputLarge', 'placeholder'=>'アプリケーション名')) ?>
            </div>
        </div>
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label" for="formGroupInputLarge">アプリケーションID</label>
            <div class="col-sm-6">
<!--                <input class="form-control" type="text" id="formGroupInputLarge" placeholder="アプリケーションID" name="app_id" value="--><?php //echo($app_info['app_id']);?><!--">-->
                <?php echo $this->Form->input('app_id',array('type'=>'text','label'=>false,'required'=>false, 'class'=>'form-control', 'id'=>'formGroupInputLarge', 'placeholder'=>'アプリケーションID')) ?>
            </div>
        </div>
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label" for="formGroupInputLarge">アプリケーションパスワード</label>
            <div class="col-sm-6">
<!--                <input class="form-control" type="text" id="formGroupInputLarge" placeholder="アプリケーションパスワード" name="app_password" value="--><?php //echo($app_info['app_password']);?><!--">-->
                <?php echo $this->Form->input('app_password',array('type'=>'text','label'=>false, 'required'=>false, 'class'=>'form-control', 'id'=>'formGroupInputLarge', 'placeholder'=>'アプリケーションパスワード')) ?>
            </div>
        </div>
        <div class="form-group col-sm-6 register">
<!--            <input class="btn btn-success btn-block btn-lg" type="submit" value="アプリケーションIDパスワード登録">-->
            <?php echo $this->Form->button('アプリケーションIDパスワード登録', array('type'=>'submit','class'=>'btn btn-success btn-block btn-lg') ) ?>
            <?php echo $this->Form->end();  ?>
        </div>
    </form>
</div>

