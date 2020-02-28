<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <title>SuperDinero | Cuestionario</title>
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
      <div class='flex flex-col justify-center items-center bg-white w-full lg:w-3/4 p-4 mt-2 lg:mt-0 rounded border' v-loading="loading">
        <el-progress class='w-full pb-4 border-b' :percentage="calculatePorcentage(questionNumber)"></el-progress>
        <div class='flex items-center justify-center w-2/3 my-5'>
          <div class='flex flex-col w-full' v-if="questionNumber == 1">
            <span class='uppercase font-semibold text-lg tracking-wider text-black text-center'>{{spanishLang ? questions[1].nameES: questions[1].nameEN}}</span>
            <el-slider v-model="responses.amount" :min='1' :format-tooltip="formatTooltip" :marks="marks"></el-slider>
            <div class='flex flex-row items-center justify-center w-full mt-6'>
              <div class="w-64">
                <input 
                  type="text" 
                  :value="formatMoney(calcValue(responses.amount))" 
                  class='border text-center text-black font-semibold text-xl rounded py-1 bg-green-200' 
                  readonly>
              </div>
            </div>
          </div>
          <div class='flex flex-col w-full' v-if="questionNumber == 2">
            <span class='uppercase font-semibold text-lg tracking-wider text-black text-center'>{{spanishLang ? questions[2].nameES: questions[2].nameEN}}</span>
            <el-select v-model="responses.category" filterable :placeholder="spanishLang ? 'Seleccionar opcion' : 'Select option'" class='mt-2'>
              <el-option
                v-for="category in categories"
                :key="category.id"
                :label="spanishLang ? category.nameES : category.nameEN"
                :value="category.id">
              </el-option>
            </el-select>
          </div>
          <div class='flex flex-col w-full' v-if="questionNumber == 3">
            <span class='uppercase font-semibold text-lg tracking-wider text-black text-center'>{{spanishLang ? questions[3].nameES: questions[3].nameEN}}</span>
            <el-select v-model="responses.document" filterable :placeholder="spanishLang ? 'Seleccionar opcion' : 'Select option'" class='mt-2'>
              <el-option
                v-for="document in documents"
                :key="document.id"
                :label="spanishLang ? document.nameES : document.nameEN"
                :value="document.id">
              </el-option>
            </el-select>
          </div>
          <div class='flex flex-col w-full' v-if="questionNumber == 4">
            <span class='uppercase font-semibold text-lg tracking-wider text-black text-center'>{{spanishLang ? questions[4].nameES: questions[4].nameEN}}</span>
            <el-select v-model="responses.record" filterable :placeholder="spanishLang ? 'Seleccionar opcion' : 'Select option'" class='mt-2'>
              <el-option
                v-for="record in records"
                :key="record.id"
                :label="spanishLang ? record.nameES : record.nameEN"
                :value="record.id">
              </el-option>
            </el-select>
          </div>
          <div class='flex flex-col w-full' v-if="questionNumber == 5">
            <span class='uppercase font-semibold text-lg tracking-wider text-black text-center'>{{spanishLang ? questions[5].nameES: questions[5].nameEN}}</span>
            <el-select v-model="responses.state" filterable :placeholder="spanishLang ? 'Seleccionar opcion' : 'Select option'" class='mt-2'>
              <el-option
                v-for="state in states"
                :key="state.id"
                :label="spanishLang ? state.nameES : state.nameEN"
                :value="state.id">
              </el-option>
            </el-select>
          </div>
          <div class='flex flex-col w-full' v-if="questionNumber == 6">
            <span class='uppercase font-semibold text-lg tracking-wider text-black text-center'>{{spanishLang ? questions[6].nameES: questions[6].nameEN}}</span>
            <el-select v-model="responses.has_car" filterable :placeholder="spanishLang ? 'Seleccionar opcion' : 'Select option'" class='mt-2'>
              <el-option :label="spanishLang ? 'SI' : 'YES'" :value="true"></el-option>
              <el-option label="NO" :value="false"></el-option>
            </el-select>
          </div>
          <div class='flex flex-col w-full' v-if="questionNumber == 7">
            <span class='uppercase font-semibold text-lg tracking-wider text-black text-center'>{{spanishLang ? questions[7].nameES: questions[7].nameEN}}</span>
            <el-select v-model="responses.has_house" filterable :placeholder="spanishLang ? 'Seleccionar opcion' : 'Select option'" class='mt-2'>
              <el-option :label="spanishLang ? 'SI' : 'YES'" :value="true"></el-option>
              <el-option label="NO" :value="false"></el-option>
            </el-select>
          </div>
          <div class='flex flex-col w-full' v-if="questionNumber == 8">
            <span class='uppercase font-semibold text-lg tracking-wider text-black text-center'>{{spanishLang ? questions[8].nameES: questions[8].nameEN}}</span>
            <el-select v-model="responses.earnings" filterable :placeholder="spanishLang ? 'Seleccionar opcion' : 'Select option'" class='mt-2'>
              <el-option label="$1,000.00 - $5,000.00" value="1000-5000"></el-option>
              <el-option label="$5,001.00 - $15,000.00" value="1001-15000"></el-option>
            </el-select>
          </div>
          <div class='flex flex-col w-full' v-if="questionNumber == 9">
            <span class='uppercase font-semibold text-lg tracking-wider text-black text-center'>{{spanishLang ? questions[9].nameES: questions[9].nameEN}}</span>
            <el-select v-model="responses.payform" filterable :placeholder="spanishLang ? 'Seleccionar opcion' : 'Select option'" class='mt-2'>
              <el-option
                v-for="option in paymentOptions"
                :key="option.nameES"
                :label="spanishLang ? option.nameES : option.nameEN"
                :value="option.nameES">
              </el-option>
            </el-select>
          </div>
        </div>
        <div class="w-full flex flex-row justify-between border-t pt-4">
          <button 
            class='rounded bg-gray-500 py-1 px-6 uppercase text-sm text-white font-semibold' 
            v-if="questionNumber > 1"
            @click="prev(questionNumber)">Atrás</button>
          <button 
            class='rounded bg-green-500 py-1 px-6 uppercase text-sm text-white font-semibold' 
            v-if="questionNumber < totalQuestions"
            @click="next(questionNumber)">Continuar</button>
          <button 
            class='rounded bg-blue-500 py-1 px-6 uppercase text-sm text-white font-semibold' 
            v-if="questionNumber == totalQuestions"
            @click="uri()">BUSCAR OPCIONES</button>
        </div>
      </div>
    </div>
    <?php $this->load->view('/site/_footer') ?>
  </div>
  <script>
    window.site_url = '<?= site_url() ?>'
    window.cs = '<?= $this->session->token ?>'
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