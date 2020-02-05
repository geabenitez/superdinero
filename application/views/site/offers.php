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
  <div class='bg-green-500 mb-6 pb-4'>
    <div class="flex flex-col container mx-auto">
      <div class='flex flex-row items-center justify-center'>
        <img src="https://superdinero.org/wp-content/uploads/2017/12/SUPERDINERO-3.png" alt="">
      </div>
      <div class='flex flex-col lg:flex-row items-center justify-center -mt-4 text-xs text-white uppercase tracking-wide'>
        <div class='flex flex-row items-center lg:mr-4'>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class='h-4 w-4 mr-1'><path class="fill-current" d="M13.04 14.69l1.07-2.14a1 1 0 0 1 1.2-.5l6 2A1 1 0 0 1 22 15v5a2 2 0 0 1-2 2h-2A16 16 0 0 1 2 6V4c0-1.1.9-2 2-2h5a1 1 0 0 1 .95.68l2 6a1 1 0 0 1-.5 1.21L9.3 10.96a10.05 10.05 0 0 0 3.73 3.73zM8.28 4H4v2a14 14 0 0 0 14 14h2v-4.28l-4.5-1.5-1.12 2.26a1 1 0 0 1-1.3.46 12.04 12.04 0 0 1-6.02-6.01 1 1 0 0 1 .46-1.3l2.26-1.14L8.28 4zm12.01-1.7a1 1 0 0 1 1.42 1.4L17.4 8H20a1 1 0 0 1 0 2h-5a1 1 0 0 1-1-1V4a1 1 0 0 1 2 0v2.59l4.3-4.3z"/></svg>
          <span>(888) 839-7029</span>
        </div>
        <div class='flex flex-row items-center lg:mr-4'>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class='h-4 w-4 mr-1'><path class="fill-current" d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2zm16 3.38V6H4v1.38l8 4 8-4zm0 2.24l-7.55 3.77a1 1 0 0 1-.9 0L4 9.62V18h16V9.62z"/></svg>
          <span>hola@superdinero.org</span>
        </div>
        <div class='flex flex-row items-center lg:mr-4 hidden md:flex'>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class='h-4 w-4 mr-1'><path class="fill-current" d="M5.64 16.36a9 9 0 1 1 12.72 0l-5.65 5.66a1 1 0 0 1-1.42 0l-5.65-5.66zm11.31-1.41a7 7 0 1 0-9.9 0L12 19.9l4.95-4.95zM12 14a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/></svg>
          <span>4530 S. Orange Blossom Trail Orlando, FL 32839</span>
        </div>
        <div class='flex flex-row items-center lg:mr-4'>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class='h-4 w-4 mr-1'><path class="fill-current" d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm1-8.41l2.54 2.53a1 1 0 0 1-1.42 1.42L11.3 12.7A1 1 0 0 1 11 12V8a1 1 0 0 1 2 0v3.59z"/></svg>
          <span>Lunes a Domingo 8am-8pm</span>
        </div>
      </div>
    </div>
  </div>
  <div class="flex flex-col lg:flex-row container mx-auto px-4 lg:px-0" id='app'>
    <div class='lg:hidden w-full'>
      <el-button class='uppercase text-xs tracking-wide w-full' @click='showSettings = !showSettings'>{{showSettings ? 'Ocultar' : 'Mostrar'}} ajustes</el-button>
    </div>
    <div class='flex flex-col justify-between bg-white w-full lg:w-1/4 mt-2 lg:mt-0 lg:mr-3 p-4 rounded border lg:flex' :class='{hidden: !showSettings, "md:flex": showSettings}'>
      <div class='border-b pb-2'>
        <span class='font-semibold text-xs text-gray-900 uppercase tracking-wide'>Ajustar resultados</span>
      </div>
      <div class='my-2'></div>  
      <span class='font-semibold text-xs text-gray-600 uppercase tracking-wide text-right cursor-pointer hover:underline'>Reiniciar filtros</span>
    </div>
    <div class='flex flex-col md:flex-row bg-white w-full lg:w-3/4 p-4 mt-2 lg:mt-0 rounded border'>
      <div class='flex flex-col w-full lg:w-4/12 py-4'>
        <div class='flex flex-row items-center justify-start'>
          <div class='flex flex-row items-center justify-center w-6 h-6 bg-green-500'>
            <span class='font-semibold text-lg text-white'>1</span>
          </div>
          <div class='flex flex-row items-center pl-2 w-full h-6 bg-green-400 border-l-2 border-white'>
            <span class='font-semibold text-xs uppercase text-white'>La mejor opcion posible</span>
          </div>
        </div>
        <div class='flex flex-row items-center justify-center bg-gray-200 w-full h-24 my-2 rounded border text-gray-500'>LOGO</div>
        <el-rate
          class='w-full'
          v-model="rating"
          disabled
          show-score
          text-color="#ff9900"
          score-template="{value} puntos">
        </el-rate>
      </div>
      <div class='flex flex-col w-full lg:w-5/12 p-4'>
        <span class='font-semibold uppercase text-sm tracking-wide text-gray-900 mb-4'>Nombre del proveedor</span>
        <ul>
          <li class='flex flex-row items-center' v-for='n in 4' :key='n'>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class='w-5 h-5 mr-1 text-green-500'>
              <path class="fill-current" d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-2.3-8.7l1.3 1.29 3.3-3.3a1 1 0 0 1 1.4 1.42l-4 4a1 1 0 0 1-1.4 0l-2-2a1 1 0 0 1 1.4-1.42z"/>
            </svg>
            <span>Option number {{ n }}</span>
          </li>
        </ul>
      </div>
      <div class='flex flex-row items-center justify-center w-full lg:w-3/12 p-4'>
        <span class='w-full py-2 bg-green-500 hover:bg-green-400 cursor-pointer text-white text-sm uppercase font-semibold rounded text-center'>GET MY RATE</span>
      </div>
    </div>
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