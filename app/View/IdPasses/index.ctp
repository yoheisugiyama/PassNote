<div class="sidebar">
    <h1 class="main_signup">PASSNOTE</h1>
    <ul class="sidebar_list list-unstyled nav nav-pills nav-stacked">
        <li><?php echo $this->Html->link('IDパスワード登録',array('action'=>'add')); ?></li>
        <li><?php echo $this->Html->link('マスター設定',array('action'=>'master')); ?></li>
        <li><?php echo $this->Html->link('ログアウト',array('controller' =>'Users', 'action'=>'logout')); ?></li>
    </ul>
</div>

<div class="main_contents">
    <h1 class="main_signup"><strong><?php echo h($user['name']);?></strong>のマイページ</h1>
    <h1 class="main_signup">一覧表示画面</h1>

    <br><br>

    <table class="table table-striped">
            <tr>
                <th><?php echo $this->Paginator->sort('app_name', 'アプリ名') ?></th>
                <th><?php echo $this->Paginator->sort('app_id', 'ID') ?></th>
                <th><?php echo $this->Paginator->sort('app_password', 'パスワード') ?></th>
                <th>変更</th>
                <th>削除</th>
            </tr>
            <?php foreach ($id_passes as $row): ?>
                <tr>
                    <td><?php echo h($row['IdPass']['app_name']); ?></td>
                    <td><?php echo h($row['IdPass']['app_id']); ?></td>
                    <td><?php echo h($row['IdPass']['app_password']); ?></td>
                    <td>
                        <?php echo $this->Form->create('IdPass',array('type'=>'post','action'=>'modify')); ?>
                        <?php echo $this->Form->button('変更',array('class'=>'btn btn-default')); ?>
                        <?php echo $this->Form->hidden('modify', array('value'=>$row['IdPass']['id'])); ?>
                        <?php echo $this->Form->end(); ?>
                    </td>
                    <td>
                        <?php echo $this->Form->create('IdPass',array('type'=>'post','action'=>'delete')); ?>
                        <?php echo $this->Form->button('削除', array('class'=>'btn btn-default')); ?>
                        <?php echo $this->Form->hidden('delete', array('value'=>$row['IdPass']['id'])) ?>
                        <?php echo $this->Form->end(); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </form>
    </table>

    <div class="paginator_bottom">
    <?php echo $this->Paginator->counter(); ?><br/>
    <?php echo $this->Paginator->prev('前へ'); ?>
    <?php echo $this->Paginator->numbers(); ?>
    <?php echo $this->Paginator->next('次へ'); ?>
    </div>
</div>