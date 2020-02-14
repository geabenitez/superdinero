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
    <div class='bg-green-500 pb-4'>
      <div class="flex flex-col container mx-auto">
        <div class='flex flex-row items-center justify-center'>
          <img src="https://superdinero.org/wp-content/uploads/2017/12/SUPERDINERO-3.png" alt="">
        </div>
        <div class='flex flex-col lg:flex-row items-center justify-center -mt-6 text-white tracking-wide'>
          <div class='flex flex-col items-center justify-center'>
            <span class='text-base lg:text-xl uppercase text-center mb-2'>Mejores Soluciones Financieras Del 2020</span>
            <p class='text-xs lg:text-sm text-center px-4 md:px-32 lg:px-64'>Compara gratuitamente soluciones financieras para latinos en USA de préstamos personales, préstamos automotrices, tarjetas de crédito, préstamos para negocios, programas de manejo de deudas, hipotecas y más.</p>
          </div>
        </div>
      </div>
    </div>
    <div class='flex flex-row w-full my-6 items-center justify-end container mx-auto font-semibold text-xs uppercase tracking-wide px-4 lg:px-0'>
      <span @click='spanishLang = true' class='w-1/2 md:w-auto cursor-pointer py-1 px-5 rounded-l text-white text-center' :class='{"bg-green-500": spanishLang, "text-green-500 border border-green-500": !spanishLang}'>Español</span>
      <span @click='spanishLang = false' class='w-1/2 md:w-auto cursor-pointer py-1 px-5 rounded-r text-white text-center' :class='{"bg-green-500": !spanishLang, "text-green-500 border border-green-500": spanishLang}'>English</span>
    </div>
    <div class='my-6 container mx-auto px-4 lg:px-0'>
      <div class='flex flex-row items-center justify-center bg-green-500 hover:bg-green-600 cursor-pointer rounded h-24 lg:h-32 w-full'>
        <span class='font-semibold text-xl uppercase tracking-wide text-white'>CHECK MY RATE</span>
      </div>
    </div>
    <div class="flex flex-col lg:flex-row container mx-auto px-4 lg:px-0">
      <div class='lg:hidden w-full'>
        <el-button class='uppercase text-xs tracking-wide w-full' @click='showSettings = !showSettings'>{{showSettings ? 'Ocultar' : 'Mostrar'}} ajustes</el-button>
      </div>
      <div class='flex flex-col justify-between bg-white w-full lg:w-1/4 mt-2 lg:mt-0 lg:mr-3 p-4 rounded border lg:flex' :class='{hidden: !showSettings, "md:flex": showSettings}'>
        <div class='border-b pb-2'>
          <span class='font-semibold text-xs text-gray-900 uppercase tracking-wide'>Ajustar resultados</span>
        </div>
        <div class='my-2'>
          <el-form label-position="top" label-width="100px" :model="form">
            <el-row :gutter='15'>
              <el-col :span='24'>
                <el-form-item label="Estados">
                  <el-select 
                    class='w-full' 
                    v-model="form.state" 
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
                    v-model="form.category" 
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
          <div class='flex flex-row w-full items-center justify-center'>
            <el-rate
              class='w-full'
              v-model="rating"
              disabled
              show-score
              text-color="#ff9900"
              score-template="{value} puntos">
            </el-rate>
          </div>
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
    <div class='bg-green-500 pb-4 mt-6'>
      <div class="flex flex-col container mx-auto">
        <div class='flex flex-col lg:flex-row items-center justify-center text-white'>
          <img class='h-24 -mb-6 lg:mb-0' src="https://superdinero.org/wp-content/uploads/2017/12/SUPERDINERO-3.png" alt="">
          <a href='javascript:;' class='mr-3 font-semibold text-sm tracking-wider hover:underline'>TERMINOS DE USO</a>
          <a href='javascript:;' class='mr-3 font-semibold text-sm tracking-wider hover:underline'>POLITICA DE PRIVACIDAD</a>
          <a href='javascript:;' class='mr-3 font-semibold text-sm tracking-wider hover:underline'>DIVULGACION PUBLICITARIA</a>
          <span class='text-xs mt-4 lg:mt-0'>4530 S. Orange Blossom Trail Orlando, FL 32839</span>
        </div>
        <div class='flex flex-col lg:flex-row items-center justify-center mt-6 lg:-mt-6 text-white tracking-wide'>
          <p class='px-4 md:px-24 lg:px-32 text-xs text-center'><span class='font-semibold'>Loans Rate and Terms Disclosure</span>: Rates for loans provided by lenders directly on the SuperDinero platform range between 3.84-35.99% APR with terms from 24 to 84 months. Rates presented include lender discounted rates for joining in autopay and loyalty programs, where applicable. Actual rates may be different from the rates advertised and/or shown and will be based on the lender’s eligibility criteria, which include factors such as credit score, loan amount, loan term, credit usage and history, and vary based on loan purpose. The lowest rates available typically require excellent credit, and for some lenders, may be reserved for specific loan purposes and/or shorter loan terms. The origination fee charged by the lenders on our platform varies so please check the terms of your offer. Each lender has their own qualification criteria with respect to their autopay and loyalty discounts (e.g., some lenders require the borrower to elect autopay prior to loan funding in order to qualify for the autopay discount). All rates are determined by the lender and must be agreed upon between the borrower and the borrower’s chosen lender. SuperDinero is not a bank nor a lender, does not broker loans to lenders and does not make credit or loan decisions. This web page does not constitute an offer nor a solicitation to lend. For full details on any service or product you must see the terms on the financial institution’s website that is making you an offer. If you have further customer service questions, please feel free to call (888) 839-7029. An example of total amount paid on a personal loan of $20,000 for a term of 60 months at a rate of 15% would be equivalent to $28,547.92 over the 60 month life of the loan. SuperDinero may receive compensation from its partners, at no cost to you, when you click or are referred to services offered or ads located on SuperDinero’s website.</p>
        </div>
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