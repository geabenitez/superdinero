<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <title>SuperDinero | Redireccionando..,</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
  <script>
    WebFont.load({
      google: {
        "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
      },
      active: function() {
        sessionStorage.fonts = true;
      }
    });
  </script>
  <?php if (isset($styles)) {
    $lambda = function () use ($styles) {
      $slash = DIRECTORY_SEPARATOR;
      foreach ($styles as $each) {
        $version = filemtime(str_replace("system" . $slash, "", BASEPATH) . str_replace("\\", $slash, $each));
        echo '<link rel="stylesheet" href="' . site_url($each) . '?v=' . $version . '" type="text/css" /> ' . "\n";
      }
    };
    $lambda();
  } ?>
  <link rel="shortcut icon" href="<?= site_url('assets/ico.png') ?>" />
  <!-- Google Tag Manager -->
  <script>
    (function(w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({
        'gtm.start': new Date().getTime(),
        event: 'gtm.js'
      });
      var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s),
        dl = l != 'dataLayer' ? '&l=' + l : '';
      j.async = true;
      j.src =
        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-K238W6J');
  </script>
  <!-- End Google Tag Manager -->
</head>

<body class='bg-green-500 h-screen w-screen flex flex-col justify-center items-center'>
  <span class='font-semibold text-white text-xl uppercase tracking-wide'>Te estamos transfiriendo...</span>
  <span class='font-semibold text-green-900'>...a través de una conexión segura</span>
  <div class='flex flex-col md:flex-row items-center bg-white rounded-lg p-8 shadow my-4'>
    <div class='flex flex-row justify-center md:justify-start w-64 p-4 font-semibold uppercase text-xs tracking-wide text-gray-900'><?= $partner ?></div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
      <path class="fill-current text-green-800" d="M9.3 8.7a1 1 0 0 1 1.4-1.4l4 4a1 1 0 0 1 0 1.4l-4 4a1 1 0 0 1-1.4-1.4l3.29-3.3-3.3-3.3z" />
    </svg>
    <div class='flex flex-row w-64 p-4 justify-center md:justify-end'>
      <img src='/<?= $image ?>' class='w-64 h-24 bg-gray-300 border border-gray-400 rounded'></div>
  </div>
  </div>
  <span class='font-semibold text-green-900'>Espera un momento por favor...</span>

  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K238W6J" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->

  <script>
    setTimeout(
      function() {
        const questionMark = atob("<?= $redirect ?>").includes("?") ? '&' : '?'
        window.location.href = atob("<?= $redirect ?>") <?= (!empty($params)) ? '+ questionMark + atob("' . $params . '")' : '' ?>;
      },
      3500
    );
  </script>
</body>

</html>