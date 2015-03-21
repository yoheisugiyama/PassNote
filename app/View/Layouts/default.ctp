<!DOCTYPE html>
<html lang="ja">
<head>
    <?php echo $this->Html->charset(); ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PassNote</title>
    <!--[if lt IE 9]>
    <?php echo $this->Html->script('html5'); ?>
    <![endif]-->

    <!-- Bootstrap core CSS -->
    <?php echo $this->Html->css('bootstrap', null, array('media'=>"screen, projection")); ?>
    <?php echo $this->Html->css('style', null, array("screen, projection")); ?>

    <!-- <link href="css/carousel.css" rel="stylesheet"> -->

    <!--[if IE]>
    <?php echo $this->Html->css('ie', null, array('media'=>"screen, projection")); ?>
    <![endif]-->


    <!-- Custom styles for this template -->
</head>

<body>
<?php echo $this->Session->flash(); ?>
<?php echo $this->fetch('content'); ?>

<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<?php echo $this->Html->script('bootstrap.min.js'); ?>

<?php echo $this->element('sql_dump'); ?>
</body>
</html>


