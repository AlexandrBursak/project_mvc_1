<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $meta_data['title']; ?></title>

    <link href="<?php echo $permalink; ?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href=<?php echo $permalink; ?>assets/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet">
    <link href="<?php echo $permalink; ?>assets/css/my_style.css" type="text/css" rel="stylesheet">
    <link href="<?php echo $permalink; ?>assets/css/style.css" rel="stylesheet">

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <style>@font-face {
            font-family: HelveticaNeueBd; /* Гарнитура шрифта */
            src: url(<?php echo $permalink; ?>assets/fonts/helveticaneue/Helvetica_Neu_Bold.ttf); /* Путь к файлу со шрифтом */
        }</style>
</head>
<body>
<div class="body">
    <?php echo $content['header']; ?>

    <?php echo $content['main']; ?>

    <?php echo $content['footer']; ?>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="http://malsup.github.com/jquery.cycle2.js"></script>
<script src="<?php echo $permalink; ?>assets/bootstrap/js/bootstrap.min.js"></script>
</html>