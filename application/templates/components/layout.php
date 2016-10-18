<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo $meta_data['title']; ?></title>

  <link href="<?php echo $permalink; ?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
  <script src="<?php echo $permalink; ?>assets/bootstrap/js/bootstrap.min.js"></script>

  <link href="<?php echo $permalink; ?>assets/css/style.css" rel="stylesheet">
</head>
<body>
  <div class="body">
    <?php echo $content['header']; ?>

    <?php echo $content['main']; ?>

    <?php echo $content['footer']; ?>
  </div>
</body>
</html>