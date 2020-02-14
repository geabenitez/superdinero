<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <title>SuperDinero | Ofertas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]},
            active: function () {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <?php if (isset($styles)) {
        $lambda = function() use ($styles) {
            $slash = DIRECTORY_SEPARATOR;
            foreach ($styles as $each) {
              $version = filemtime(str_replace("system".$slash,"",BASEPATH) . str_replace("\\",$slash, $each));
              echo '<link rel="stylesheet" href="' . site_url($each) . '?v=' . $version . '" type="text/css" /> ' . "\n";
            }
        };
        $lambda();
    } ?>
    <link rel="shortcut icon" href="<?= site_url('assets/ico.png') ?>"/>
</head>
<body class=bg-gray-200>
  <div id='app'>
    <?php $this->load->view('/site/_header') ?>
    <div class='flex flex-row w-full my-6 items-center justify-end container mx-auto font-semibold text-xs uppercase tracking-wide px-4 lg:px-0'>
      <span @click='spanishLang = true' class='w-1/2 md:w-auto cursor-pointer py-1 px-5 rounded-l text-white text-center' :class='{"bg-green-500": spanishLang, "text-green-500 border border-green-500": !spanishLang}'>Español</span>
      <span @click='spanishLang = false' class='w-1/2 md:w-auto cursor-pointer py-1 px-5 rounded-r text-white text-center' :class='{"bg-green-500": !spanishLang, "text-green-500 border border-green-500": spanishLang}'>English</span>
    </div>
    <div class="flex justify-center container mx-auto px-4 lg:px-0">
      <div class='flex flex-col justify-center items-center bg-white w-full lg:w-3/4 p-4 mt-2 lg:mt-0 rounded border'>
        <el-progress class='w-full' :percentage="50"></el-progress>
        <span>CUESTIONARIO</span>
      </div>
    </div>
    <?php $this->load->view('/site/_footer') ?>
  </div>
  <?php if (isset($scripts)) {
    $lambda = function() use ($scripts) {
        $slash = DIRECTORY_SEPARATOR;
        foreach ($scripts as $each) {
          $version = filemtime(str_replace("system".$slash,"",BASEPATH) . str_replace("\\",$slash, $each));
          echo '<script type="text/javascript" src="' . site_url($each) . '?v=' . $version . '"></script>' . "\n";
        }
    };
    $lambda();
  } ?>
  <script>ELEMENT.locale(ELEMENT.lang.es)</script>
</body>
</html>