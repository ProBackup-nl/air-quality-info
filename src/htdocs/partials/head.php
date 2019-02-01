<!DOCTYPE html>
<html lang="en">
  <head>
<?php if (CONFIG['ga_id']): ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo CONFIG['ga_id']; ?>"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', '<?php echo CONFIG['ga_id']; ?>');
    </script>
<?php endif; ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" sizes="512x512" href="/public/img/dragon-512.png">
    <link rel="manifest" href="/manifest.json">

    <title><?php echo __('Air quality') ?> - <?php echo $device['description']; ?></title>

    <style><?php echo file_get_contents('public/css/critical.css') ?></style>

    <script defer src="/public/js/vendor.min.js"></script>
    <script defer src="/public/js/main.js?v=15"></script>
    <script defer src="/public/js/graph.js?v=15"></script>
  </head>
  <body data-is-pwa="<?php echo $current_action == 'index_pwa' ?>" data-device-name="<?php echo $device['name'] ?>" data-pm10-limit1h="<?php echo PM10_LIMIT_1H ?>" data-pm25-limit1h="<?php echo PM25_LIMIT_1H ?>" data-pm10-limit24h="<?php echo PM10_LIMIT_24H ?>" data-pm25-limit24h="<?php echo PM25_LIMIT_24H ?>" data-current-lang='<?php echo $current_lang ?>' data-locale='<?php echo json_encode($locale) ?>'>
    <div class="container">
      <div class="row">
        <div class="col-md-8 offset-md-2">
          <nav class="navbar navbar-expand-md navbar-light bg-light">
            <a href="<?php echo l($device, 'index'); ?>" class="navbar-left navbar-brand"><img src="/public/img/dragon.png"/> Air Quality Info</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Nawigacja">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
                <?php foreach(array('index' => __('Home'), 'graphs' => __('Graphs'), 'about' => __('About')) as $action => $name): ?>
                <li class="nav-item">
                  <a class="nav-link <?php echo ($action == $current_action) ? 'active' : ''; ?>" href="<?php echo l($device, $action); ?>"><?php echo $name; ?></a>
                </li>
                <?php endforeach ?>
                <?php require('partials/navbar/locations.php') ?>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo __('Theme') ?>
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <li>
                  <?php foreach(THEMES as $name => $desc): ?>
                    <a class="dropdown-item <?php echo ($name == $current_theme) ? 'active' : ''; ?>" href="<?php echo l($device, $current_action, array('theme' => $name)); ?>"><?php echo $desc ?></a>
                  <?php endforeach ?>
                  </li>
                  </ul>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-globe" aria-hidden="true"></i>
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <?php foreach($supported_languages as $lang => $desc): ?>
                  <li>
                    <a class="dropdown-item <?php echo ($lang == $current_lang) ? 'active' : ''; ?>" href="<?php echo l($device, $current_action, array('lang' => $lang)); ?>"><img src="/public/img/flags/<?php echo $lang ?>.png"/> <?php echo $desc ?></a>
                  </li>
                  <?php endforeach ?>
                  </ul>
                </li>
              </ul>
            </div>
          </nav>
        </div>
      </div>
<?php if (isset($device['maintenance'])): ?>
      <div class="row">
        <div class="col-md-8 offset-md-2">
          <div class="alert alert-warning">
            <?php echo $device['maintenance'] ?>
          </div>
        </div>
      </div>
<?php endif ?>
