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
    <div class='flex flex-col-reverse lg:flex-row w-full my-6 items-center justify-between container mx-auto font-semibold text-xs uppercase tracking-wide px-4 lg:px-0'>
      <div class="flex flex-col lg:flex-row items-center tracking-wider">
        <span class='text-green-800 uppercase text-base mr-2 text-center lg:text-left'>Revisa gratis tu puntaje de credito</span>
        <div class='flex flex-row'>
          <button class='bg-green-500 w-42 py-1 px-5 text-white rounded uppercase font-semibold tracking-wider text-center mr-2'>Credit sesame</button>
          <button class='bg-green-500 w-42 py-1 px-5 text-white rounded uppercase font-semibold tracking-wider text-center'>Credit karma</button>
        </div>
      </div>
      <div class='flex flex-row mb-6 lg:mb-0'>
        <span @click='spanishLang = true' class='w-1/2 md:w-auto cursor-pointer py-1 px-5 rounded-l text-white text-center' :class='{"bg-green-500": spanishLang, "text-green-500 border border-green-500": !spanishLang}'>Español</span>
        <span @click='spanishLang = false' class='w-1/2 md:w-auto cursor-pointer py-1 px-5 rounded-r text-white text-center' :class='{"bg-green-500": !spanishLang, "text-green-500 border border-green-500": spanishLang}'>English</span>
      </div>
    </div>
    <div class="flex flex-col lg:flex-row container mx-auto px-4 lg:px-0" v-loading='loading'>
      <div class='lg:hidden w-full'>
        <el-button class='uppercase text-xs tracking-wide w-full' @click='showSettings = !showSettings'>{{showSettings ? 'Ocultar' : 'Mostrar'}} ajustes</el-button>
      </div>
      <div style='height: fit-content' class='lg:sticky lg:top-0 flex flex-col justify-start bg-white w-full max-h-auto lg:w-1/4 mt-2 lg:mt-0 lg:mr-3 p-4 rounded border lg:flex' :class='{hidden: !showSettings, "md:flex": showSettings}'>
        <div class='border-b pb-2'>
          <span class='font-semibold text-xs text-gray-900 uppercase tracking-wide'>Ajustar resultados</span>
        </div>
        <div class='my-2'>
          <el-form label-position="top" label-width="100px" :model="query">
            <el-row :gutter='15'>
              <el-col :span='24'>
                <el-form-item label="Estados">
                  <el-select 
                    class='w-full' 
                    v-model="query.state" 
                    placeholder="Seleccionar" 
                    size='small'
                    clearable
                    no-data-text='No hay valores'
                    filterable >
                    <el-option
                        v-for='state in states'
                        :key="state.id"
                        :label="state.nameES"
                        :value="state.id">
                    </el-option>
                  </el-select>
                </el-form-item>
                <el-form-item label="Categorias">
                  <el-select 
                    class='w-full' 
                    v-model="query.category" 
                    placeholder="Seleccionar" 
                    size='small'
                    clearable
                    no-data-text='No hay valores'
                    filterable >
                    <el-option
                        v-for='category in categories'
                        :key="category.id"
                        :label="category.nameES"
                        :value="category.id">
                    </el-option>
                  </el-select>
                </el-form-item>
              </el-col>
            </el-row>
          </el-form>
        </div>  
        <span class='font-semibold text-xs text-gray-600 uppercase tracking-wide text-right cursor-pointer hover:underline'>Reiniciar filtros</span>
      </div>
      <div class='flex flex-col bg-white w-full lg:w-3/4 p-4 mt-2 lg:mt-0 rounded border'>
        <div class='flex flex-col md:flex-row border-b' v-for='(partner, k) in partners'>
          <div class='flex flex-col w-full lg:w-4/12 py-4'>
            <div class='flex flex-row items-center justify-start'>
              <div class='flex flex-row items-center justify-center w-6 h-6 bg-green-500'>
                <span class='font-semibold text-lg text-white'>{{ k + 1 }}</span>
              </div>
              <div class='flex flex-row items-center pl-2 w-full h-6 bg-green-400 border-l-2 border-white' v-if='k == 0'>
                <span class='font-semibold text-xs uppercase text-white'>La mejor opcion posible</span>
              </div>
            </div>
            <div class='flex flex-row items-center justify-center bg-gray-200 w-full h-24 my-2 rounded border text-gray-500'>LOGO</div>
            <div class='flex flex-row w-full items-center justify-center'>
              <el-rate
                class='w-full'
                :value="partner.rate"
                disabled
                show-score
                text-color="#ff9900"
                score-template="{value} estrellas">
              </el-rate>
            </div>
          </div>
          <div class='flex flex-col w-full lg:w-5/12 p-4'>
            <span class='font-semibold uppercase text-sm tracking-wide text-gray-900 mb-4'>{{ spanishLang ? partner.nameES : partner.nameEN }}</span>
            <ul>
              <li class='flex flex-row items-center' v-for='blurb in characteristics(partner.characteristicsES, partner.characteristicsEN)' :key='blurb'>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class='w-5 h-5 mr-1 text-green-500'>
                  <path class="fill-current" d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-2.3-8.7l1.3 1.29 3.3-3.3a1 1 0 0 1 1.4 1.42l-4 4a1 1 0 0 1-1.4 0l-2-2a1 1 0 0 1 1.4-1.42z"/>
                </svg>
                <span>{{blurb}}</span>
              </li>
            </ul>
          </div>
          <div class='flex flex-row items-center justify-center w-full lg:w-3/12 p-4'>
            <a :href='`/redirect?redirect=${partner.url}&partner=${partner.id}`' class='w-full py-2 bg-green-500 hover:bg-green-400 cursor-pointer text-white text-sm uppercase font-semibold rounded text-center'>GET MY RATE</a>
          </div>
        </div>
      </div>
    </div>
    <?php $this->load->view('/site/_footer') ?>
  </div>
  <script>
    window.site_url = '<?= site_url() ?>'
    window.cs = '$Q5444bbBrRt9Cd8goEObasdlYJbi33dduyfDu92BaviqfWCOw6wlEYBfbkwqpj/K'
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js" integrity="sha256-T/f7Sju1ZfNNfBh7skWn0idlCBcI3RwdLSS4/I7NQKQ=" crossorigin="anonymous"></script>

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
</body>
</html>