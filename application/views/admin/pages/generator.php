<div id='app'>
  <div class="flex justify-center container mx-auto">
    <div class='flex flex-col justify-center items-center bg-white w-full p-4 rounded border' v-loading="loading">
      <el-progress class='w-full pb-4 border-b' :percentage="calculatePorcentage(questionNumber)"></el-progress>
      <div class='flex items-center justify-center w-2/3 my-5'>
        <div class='flex flex-col w-full' v-if="questionNumber == 1">
          <span class='uppercase font-semibold text-lg tracking-wider text-black text-center'>{{spanishLang ? questions[1].nameES: questions[1].nameEN}}</span>
          <el-select v-model="responses.credit" filterable :placeholder="spanishLang ? 'Seleccionar opcion' : 'Select option'" class='mt-2' @change="changeCredit(responses.credit)">
            <el-option
              v-for="credit in credits"
              :key="credit.id"
              :label="spanishLang ? credit.nameES : credit.nameEN"
              :value="credit.id">
            </el-option>
          </el-select>
        </div>
        <div class='flex flex-col w-full' v-if="questionNumber == 2">
          <span class='uppercase font-semibold text-lg tracking-wider text-black text-center'>{{spanishLang ? questions[2].nameES: questions[2].nameEN}}</span>
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
        <div class='flex flex-col w-full' v-if="questionNumber == 3">
          <span class='uppercase font-semibold text-lg tracking-wider text-black text-center'>{{spanishLang ? questions[3].nameES: questions[3].nameEN}}</span>
          <el-select v-model="responses.category" filterable :placeholder="spanishLang ? 'Seleccionar opcion' : 'Select option'" class='mt-2'>
            <el-option
              v-for="category in categories"
              :key="category.id"
              :label="spanishLang ? category.nameES : category.nameEN"
              :value="category.id">
            </el-option>
          </el-select>
        </div>
        <div class='flex flex-col w-full' v-if="questionNumber == 4">
          <span class='uppercase font-semibold text-lg tracking-wider text-black text-center'>{{spanishLang ? questions[4].nameES: questions[4].nameEN}}</span>
          <el-select v-model="responses.document" filterable :placeholder="spanishLang ? 'Seleccionar opcion' : 'Select option'" class='mt-2'>
            <el-option
              v-for="document in documents"
              :key="document.id"
              :label="spanishLang ? document.nameES : document.nameEN"
              :value="document.id">
            </el-option>
          </el-select>
        </div>
        <div class='flex flex-col w-full' v-if="questionNumber == 5">
          <span class='uppercase font-semibold text-lg tracking-wider text-black text-center'>{{spanishLang ? questions[5].nameES: questions[5].nameEN}}</span>
          <el-select v-model="responses.record" filterable :placeholder="spanishLang ? 'Seleccionar opcion' : 'Select option'" class='mt-2'>
            <el-option
              v-for="record in records"
              :key="record.id"
              :label="spanishLang ? record.nameES : record.nameEN"
              :value="record.id">
            </el-option>
          </el-select>
        </div>
        <div class='flex flex-col w-full' v-if="questionNumber == 6">
          <span class='uppercase font-semibold text-lg tracking-wider text-black text-center'>{{spanishLang ? questions[6].nameES: questions[6].nameEN}}</span>
          <el-select v-model="responses.state" filterable :placeholder="spanishLang ? 'Seleccionar opcion' : 'Select option'" class='mt-2'>
            <el-option
              v-for="state in states"
              :key="state.id"
              :label="spanishLang ? state.nameES : state.nameEN"
              :value="state.id">
            </el-option>
          </el-select>
        </div>
        <div class='flex flex-col w-full' v-if="questionNumber == 7">
          <span class='uppercase font-semibold text-lg tracking-wider text-black text-center'>{{spanishLang ? questions[7].nameES: questions[7].nameEN}}</span>
          <el-select v-model="responses.has_car" filterable :placeholder="spanishLang ? 'Seleccionar opcion' : 'Select option'" class='mt-2'>
            <el-option :label="spanishLang ? 'SI' : 'YES'" :value="true"></el-option>
            <el-option label="NO" :value="false"></el-option>
          </el-select>
        </div>
        <div class='flex flex-col w-full' v-if="questionNumber == 8">
          <span class='uppercase font-semibold text-lg tracking-wider text-black text-center'>{{spanishLang ? questions[8].nameES: questions[8].nameEN}}</span>
          <el-select v-model="responses.has_house" filterable :placeholder="spanishLang ? 'Seleccionar opcion' : 'Select option'" class='mt-2'>
            <el-option :label="spanishLang ? 'SI' : 'YES'" :value="true"></el-option>
            <el-option label="NO" :value="false"></el-option>
          </el-select>
        </div>
        <div class='flex flex-col w-full' v-if="questionNumber == 9">
          <span class='uppercase font-semibold text-lg tracking-wider text-black text-center'>{{spanishLang ? questions[9].nameES: questions[9].nameEN}}</span>
          <el-select v-model="responses.earnings" filterable :placeholder="spanishLang ? 'Seleccionar opcion' : 'Select option'" class='mt-2'>
            <el-option label='$0.00 - $500.00' value='0 - 500'></el-option>
            <el-option label='$501.00 - $1,000.00' value='501 - 1000'></el-option>
            <el-option label='$1,001.00 - $1,500.00' value='1001 - 1500'></el-option>
            <el-option label='$1,501.00 - $2,000.00' value='1501 - 2000'></el-option>
            <el-option label='$2,001.00 - $2,500.00' value='2001 - 2500'></el-option>
            <el-option label='$2,501.00 - $3,000.00' value='2501 - 3000'></el-option>
            <el-option label='$3,001.00 - $3,500.00' value='3001 - 3500'></el-option>
            <el-option label='$3,501.00 - $4,000.00' value='3501 - 4000'></el-option>
            <el-option label='$4,001.00 - $4,500.00' value='4001 - 4500'></el-option>
            <el-option label='$4,501.00 - $5,000.00' value='4501 - 5000'></el-option>
            <el-option label='$5,001.00 - $6,000.00' value='5001 - 6000'></el-option>
            <el-option label='$6,001.00 - $7,000.00' value='6001 - 7000'></el-option>
            <el-option label='$7,001.00 - $8,000.00' value='7001 - 8000'></el-option>
            <el-option label='$8,001.00 - $9,000.00' value='8001 - 9000'></el-option>
            <el-option label='$9,001.00 - $10,000.00' value='9001 - 10000'></el-option>
            <el-option label='$10,001.00 - $15,000.00' value='10001 - 15000'></el-option>
            <el-option label='$15,001.00 - $20,000.00' value='15001 - 20000'></el-option>
            <el-option label='$20,001.00 - $25,000.00' value='20001 - 25000'></el-option>
            <el-option label='$25,001.00 - $30,000.00' value='25001 - 30000'></el-option>
            <el-option label='$30,001.00 - $40,000.00' value='30001 - 40000'></el-option>
            <el-option label='$40,001.00 - $50,000.00' value='40001 - 50000'></el-option>
            <el-option label='$50,000.00 - mas' value='50000 - mas'></el-option>
          </el-select>
        </div>
        <div class='flex flex-col w-full' v-if="questionNumber == 10">
          <span class='uppercase font-semibold text-lg tracking-wider text-black text-center'>{{spanishLang ? questions[10].nameES: questions[10].nameEN}}</span>
          <el-select v-model="responses.payform" filterable :placeholder="spanishLang ? 'Seleccionar opcion' : 'Select option'" class='mt-2'>
            <el-option
              v-for="option in paymentOptions"
              :key="option.nameES"
              :label="spanishLang ? option.nameES : option.nameEN"
              :value="option.nameES">
            </el-option>
          </el-select>
        </div>
        <div class='flex flex-col w-full' v-for='(question, k) in aditionalQuestions' v-if="questionNumber == totalQuestions - k">
          <span class='uppercase font-semibold text-lg tracking-wider text-black text-center'>{{spanishLang ? question.questionES: question.questionEN}}</span>
          <el-select v-model="responses['aditional_' + (k+1)]" filterable :placeholder="spanishLang ? 'Seleccionar opcion' : 'Select option'" class='mt-2'>
            <el-option
              v-for="category in getCategories(question)"
              :key="category.nameES"
              :label="spanishLang ? category.nameES : category.nameEN"
              :value="category.nameES">
            </el-option>
          </el-select>
        </div> 
      </div>
      <div class="w-full flex flex-row justify-between border-t pt-4">
        <button 
          class='rounded bg-gray-500 py-1 px-6 uppercase text-sm text-white font-semibold' 
          v-if="questionNumber > 0"
          @click="prev(questionNumber)">Atrás</button>
        <button 
          class='rounded bg-green-500 py-1 px-6 uppercase text-sm text-white font-semibold' 
          v-if="questionNumber < totalQuestions"
          @click="next(questionNumber)">Continuar</button>
        <button 
          class='rounded bg-blue-500 py-1 px-6 uppercase text-sm text-white font-semibold' 
          v-if="questionNumber == totalQuestions"
          @click="generate(responses)">GENERAR CODIGO</button>
      </div>
      {{generatedCode}}
    </div>
  </div>
</div>