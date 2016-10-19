<header>
  <div class="page-header">
    <h1>Best MVC system forever</h1>
  </div>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <ul class="nav navbar-nav">
        <?php foreach ( $navigation as $nav ) : ?>
          <li role="presentation" class="<?php echo $nav['active']; ?>"><a
              href="<?php echo $permalink . $nav['url']; ?>"><?php echo $nav['title']; ?></a></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </nav>
</header>