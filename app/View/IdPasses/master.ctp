<div class="sidebar">
    <h1 class="main_signup">PASSNOTE</h1>
    <ul class="sidebar_list list-unstyled nav nav-pills nav-stacked">
        <li><?php echo $this->Html->link('IDパスワード一覧',array('action'=>'index')); ?></li>
        <li><?php echo $this->Html->link('ログアウト',array('controller' =>'Users', 'action'=>'logout')); ?></li>
    </ul>
</div>



<div class="main_contents">
    <h1 class="main_signup">マスター設定変更画面</h1>
        <?php echo $this->Form->create(null, array('type'=>'post','class'=>'form-horizontal', 'url'=>array('controller'=>'id_passes','action'=>'master')));  ?>
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label" for="formGroupInputLarge">名前</label>
            <div class="col-sm-6">
                <?php echo $this->Form->input('User.name', array('type'=>'text', 'label'=>false,'required'=>false, 'class'=>'form-control', 'id'=>'formGroupInputLarge', 'placeholder'=>'名前')); ?>
            </div>
        </div>
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label" for="formGroupInputLarge">マスターID</label>
            <div class="col-sm-6">
                <?php echo $this->Form->input('User.username', array('type'=>'text', 'label'=>false,'required'=>false, 'class'=>'form-control', 'id'=>'formGroupInputLarge', 'placeholder'=>'マスターID')); ?>
            </div>
        </div>
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label" for="formGroupInputLarge">e-mailアドレス</label>
            <div class="col-sm-6">
                <?php echo $this->Form->input('User.user_email', array('type'=>'text', 'label'=>false,'required'=>false, 'class'=>'form-control', 'id'=>'formGroupInputLarge', 'placeholder'=>'e-mailアドレス')); ?>
            </div>
        </div>
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label" for="formGroupInputLarge">マスターPassword</label>
            <div class="col-sm-6">
                <?php echo $this->Form->input('User.password', array('type'=>'text', 'label'=>false,'required'=>false, 'class'=>'form-control', 'id'=>'formGroupInputLarge', 'placeholder'=>'マスターPassword')); ?>
            </div>
        </div>
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label" for="formGroupInputLarge">メール通知</label>
            <div class="col-sm-6">
                <?php echo $this->Form->input('User.mail_announce', array('type'=>'text', 'label'=>false,'required'=>false, 'class'=>'form-control', 'id'=>'formGroupInputLarge', 'placeholder'=>'メール通知')); ?>
            </div>
        </div>
        <!--			<div class="register">-->
        <!--			<p><a class="col-sm-4 btn btn-lg btn-primary" role="button">登録</a></p>-->
        <!--			</div>-->


        <div class="form-group col-sm-4 register">
            <?php echo $this->Form->button('マスター設定を変更', array('type'=>'submit','class'=>'btn btn-success btn-block btn-lg') ) ?>
            <?php echo $this->Form->end();  ?>
        </div>
    </form>
</div>


<div style="clear:both;"></div>