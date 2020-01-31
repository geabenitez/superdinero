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
  <div class="flex flex-row container mx-auto my-4">
    <div class='flex flex-col bg-white w-1/3 mr-3 p-4 rounded border'>
      <div class='border-b pb-2'>
        <span class='font-semibold text-xs text-gray-900 uppercase tracking-wide'>Ajustar resultados</span>
      </div>
      <div class='my-2'></div>  
      <span class='font-semibold text-xs text-gray-600 uppercase tracking-wide text-right cursor-pointer hover:underline'>Reiniciar filtros</span>
    </div>
    <div class='flex flex-col bg-white w-2/3 p-4 rounded border'></div>
  </div>
</body>
</html>