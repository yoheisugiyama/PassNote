<!-- NAVBAR
================================================== -->

<div class="navbar-wrapper">
    <div class="container">
        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    </button>
                    <a class="navbar-brand" href="#">PassNote</a>
                </div>
            </div>
        </nav>

    </div>
</div>


<!-- Viewer
================================================== -->
<div id="myCarousel" class="carousel slide" data-ride="carousel">

    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <div class="container">
                <div class="carousel-caption">
                    <div class="carousel-main">
                        <h1>PassNote</h1>
                        <p>あなたの大切なアプリのパスワード、PassNoteで管理します。</p>
                        <p><a class="btn btn-lg btn-primary" href="signup.php" role="button">新規登録はこちら</a></p>
                    </div>
                    <div class="carousel-form">
                        <form method="post">
<!--                            IDパスワード入力欄-->
                            <?php echo $this->Form->create('User'); ?>
                            <div class="form-group">
                                <?php echo $this->Form->label('User.username', 'Email Address'); ?>
                                <?php echo $this->Form->input('User.username', array('label'=>false, 'class'=>'form-control', 'id'=>'exampleInputEmail1', 'placeholder'=>'Enter email')); ?>
                            </div>
                            <div class="form-group">
                                <?php echo $this->Form->label('User.password', 'Password'); ?>
                                <?php echo $this->Form->input('User.password', array('label'=>false, 'class'=>'form-control', 'id'=>'exampleInputPassword1', 'placeholder'=>'Password')); ?>
                            </div>
<!--                            <button class="btn btn-lg btn-success" type="submit">ログイン</button>-->
                            <?php  echo $this->Form->button('ログイン', array('class'=>'btn btn-lg btn-success', 'type'=>'submit')); ?>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div><!-- /.carousel -->


<!-- Marketing messaging and featurettes
================================================== -->
<!-- Wrap the rest of the page in another container to center all the content. -->

<div class="container marketing">
    <!-- START THE FEATURETTES -->

    <hr class="featurette-divider">

    <div class="row featurette">
        <div class="col-md-7">
            <h2 class="featurette-heading">特徴 <span class="text-muted">Main Features</span></h2>
            <p class="lead">
                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> シンプルでかつ安全なパスワード管理ツール
            </p>
            <p class="lead">
                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> 面倒なユーザー登録一切なし！マスターID・マスターパスワード・e-mailのみでアカウント開設！
            </p>
            <p class="lead">
                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> パスワード自動生成機能付
            </p>
            <p class="lead">
                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> 全て無料！（有料オプションなし）
            </p>
        </div>
        <div class="col-md-5">
            <?php echo $this->Html->image('photo1.jpg', array('alt'=>'Generic placeholder image','class'=>'featurette-image img-responsive')); ?>
        </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
        <div class="col-md-5">
            <?php echo $this->Html->image('photo2.jpg', array('alt'=>'Generic placeholder image','class'=>'featurette-image img-responsive')); ?>

        </div>
        <div class="col-md-7">
            <h2 class="featurette-heading">安全性について<span class="text-muted">Secure Your Passwords</span></h2>
            <p class="lead">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> ネットで保存しても大丈夫なの？
            </p>
            <p class="lead">
                → 大丈夫です！！
            </p>
            <p class="lead">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> 自動生成されたパスワードは、パスワードそのものがランダムな英数字にて構成されて安全性が高いだけでなく、サーバーに保管するにあたり、全て「ハッシュ化」されるため、あなたのパスワードの機密性は万全に確保されます。
            </p>
        </div>
    </div>

    <hr class="featurette-divider">


    <!-- /END THE FEATURETTES -->


    <!-- FOOTER -->
    <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>&copy; 2015 CreaTive WorkS LLC &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
    </footer>

</div><!-- /.container -->


