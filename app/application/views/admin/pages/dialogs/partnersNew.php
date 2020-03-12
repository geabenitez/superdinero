<el-dialog :title="action" :visible.sync="showNewPartner" width=1200px>
  <el-form label-position="top" label-width="100px" :model="newAsociateForm">
    <el-row :gutter='15'>
      <el-col :span='12' class='border-r'>
        <el-row :gutter='15' class='mb-4'>
          <el-col :span='24'>
            <el-alert title="DATOS VERSION EN ESPAÑOL" size='small' type="info" :closable='false' show-icon />
          </el-col>
        </el-row>
        <el-form-item label="Nombre:">
          <el-input 
          placeholder="Nombre de asociado" 
          size='small' 
          v-model="newAsociateForm.nameES"
          maxlength="50"
          show-word-limit
          clearable/>
        </el-form-item>
        <el-form-item label="Caracteristicas">
          <el-row :gutter='15'>
            <el-col :span='12'>
              <el-input 
                size='small' 
                v-model="newAsociateForm.characteristicsES[0]"
                maxlength="100"
                show-word-limit
                clearable/>
              </el-col>
            <el-col :span='12'>
              <el-input 
                size='small' 
                v-model="newAsociateForm.characteristicsES[1]"
                maxlength="100"
                show-word-limit
                clearable/>
              </el-col>
            </el-row>
            <el-row :gutter='15'>
            <el-col :span='12'>
              <el-input 
                size='small' 
                v-model="newAsociateForm.characteristicsES[2]"
                maxlength="100"
                show-word-limit
                clearable/>
              </el-col>
            <el-col :span='12'>
              <el-input 
                size='small' 
                v-model="newAsociateForm.characteristicsES[3]"
                maxlength="100"
                show-word-limit
                clearable/>
              </el-col>
            </el-row>
        </el-form-item>
        <el-form-item label="Documentos requeridos">
          <el-select 
            class='w-full' 
            v-model="newAsociateForm.documents" 
            multiple 
            placeholder="Seleccionar" 
            size='small'
            clearable
            filterable
            default-first-option >
            <el-option
                v-for='document in documents'
                :key="document.id"
                :label="document.nameES"
                :value="document.id">
            </el-option>
          </el-select>
        </el-form-item>
        <el-form-item label="Estados">
          <el-select 
            class='w-full' 
            v-model="newAsociateForm.states" 
            multiple 
            placeholder="Seleccionar" 
            size='small'
            clearable
            filterable
            default-first-option >
            <el-option
                v-for='state in states'
                :key="state.id"
                :label="state.nameES"
                :value="state.id">
            </el-option>
          </el-select>
        </el-form-item>
        <el-row :gutter='15'>
          <el-col :span="8">
            <el-form-item label="¿Mostrar solo al agente?">
              <el-radio :label="false" v-model='newAsociateForm.onlyAgent'>No</el-radio>
              <el-radio :label="true" v-model='newAsociateForm.onlyAgent'>Sí</el-radio>
            </el-form-item>
          </el-col>
          <el-col :span="8">
            <el-form-item label="¿Requiere carro?">
              <el-radio :label="false" v-model='newAsociateForm.requiresCar'>No</el-radio>
              <el-radio :label="true" v-model='newAsociateForm.requiresCar'>Sí</el-radio>
            </el-form-item>
          </el-col>
          <el-col :span="8">
            <el-form-item label="¿Requiere casa?">
              <el-radio :label="false" v-model='newAsociateForm.requiresHouse'>No</el-radio>
              <el-radio :label="true" v-model='newAsociateForm.requiresHouse'>Sí</el-radio>
            </el-form-item>
          </el-col>
        </el-row>
        <el-form-item label="Creditos">
          <el-select 
            class='w-full' 
            v-model="newAsociateForm.credits" 
            multiple 
            placeholder="Seleccionar" 
            size='small'
            clearable
            filterable
            default-first-option >
            <el-option
                v-for='credit in credits'
                :key="credit.id"
                :label="credit.nameES"
                :value="credit.id">
            </el-option>
          </el-select>
        </el-form-item>
        <el-form-item label="Categorias">
          <el-select 
            class='w-full' 
            v-model="newAsociateForm.categories" 
            multiple 
            placeholder="Seleccionar" 
            size='small'
            clearable
            filterable
            default-first-option >
            <el-option-group
              v-for="credit in filteredCategories"
              :key="credit.nameES"
              :label="credit.nameES">
              <el-option
                v-for="category in credit.categories"
                :key="category.id"
                :label="category.nameES"
                :value="category.id">
              </el-option>
            </el-option-group>
          </el-select>
        </el-form-item>
        <el-form-item label="Records crediticios aceptados">
          <el-select 
            class='w-full' 
            v-model="newAsociateForm.records" 
            multiple 
            placeholder="Seleccionar" 
            size='small'
            clearable
            filterable
            default-first-option >
            <el-option
                v-for='record in records'
                :key="record.id"
                :label="record.nameES"
                :value="record.id">
            </el-option>
          </el-select>
        </el-form-item>
        <el-form-item label="Cantidades">
          <el-select 
            class='w-full' 
            v-model="newAsociateForm.amounts" 
            multiple 
            placeholder="Seleccionar" 
            size='small'
            clearable
            filterable
            default-first-option >
            <el-option
                v-for='amount in amounts'
                :key="amount.id"
                :label="`${formatMoney(amount.from)} - ${formatMoney(amount.until)}`"
                :value="amount.id">
            </el-option>
          </el-select>
        </el-form-item>
        <el-form-item label='Calificación'>
          <div class="flex flex-row items-center ">
            <div class='w-1/4 mr-5'>
              <el-input 
                type='number'
                size='small' 
                step='0.25'
                min='0'
                max='5'
                v-model="newAsociateForm.rate"/>
            </div>
            <div class='w-1/3'>
              <el-rate v-model="newAsociateForm.rate" allow-half disabled />
            </div>
          </div>
        </el-form-item>
        <el-form-item label="URL de destino:">
          <el-input 
            placeholder="URL de destino" 
            size='small' 
            v-model="newAsociateForm.url"
            maxlength="500"
            show-word-limit
            clearable/>
        </el-form-item>
      </el-col>
      <el-col :span='12'>
        <el-row :gutter='15' class='mb-4'>
          <el-col :span='24'>
            <el-alert title="DATOS VERSION EN INGLES" size='small' type="info" :closable='false' show-icon> 
          </el-col>
        </el-row>
        <el-form-item label="Name:">
          <el-input 
          placeholder="Partner's name" 
          size='small' 
          v-model="newAsociateForm.nameEN"
          maxlength="50"
          show-word-limit
          clearable/>
        </el-form-item>
        <el-form-item label="Characteristics">
          <el-row :gutter='15'>
            <el-col :span='12'>
              <el-input 
                size='small' 
                v-model="newAsociateForm.characteristicsEN[0]"
                maxlength="100"
                show-word-limit
                clearable/>
              </el-col>
            <el-col :span='12'>
              <el-input 
                size='small' 
                v-model="newAsociateForm.characteristicsEN[1]"
                maxlength="100"
                show-word-limit
                clearable/>
              </el-col>
            </el-row>
            <el-row :gutter='15'>
            <el-col :span='12'>
              <el-input 
                size='small' 
                v-model="newAsociateForm.characteristicsEN[2]"
                maxlength="100"
                show-word-limit
                clearable/>
              </el-col>
            <el-col :span='12'>
              <el-input 
                size='small' 
                v-model="newAsociateForm.characteristicsEN[3]"
                maxlength="100"
                show-word-limit
                clearable/>
              </el-col>
            </el-row>
        </el-form-item>
        <el-form-item label="Required documents">
          <el-select 
            class='w-full' 
            v-model="newAsociateForm.documents" 
            multiple 
            placeholder="Seleccionar" 
            size='small'
            clearable
            filterable 
            default-first-option >
            <el-option
                v-for='document in documents'
                :key="document.id"
                :label="document.nameEN"
                :value="document.id">
            </el-option>
          </el-select>
        </el-form-item>
        <el-form-item label="States">
          <el-select 
            class='w-full' 
            v-model="newAsociateForm.states" 
            multiple 
            placeholder="Seleccionar" 
            size='small'
            clearable
            filterable 
            default-first-option >
            <el-option
                v-for='state in states'
                :key="state.id"
                :label="state.nameEN"
                :value="state.id">
            </el-option>
          </el-select>
        </el-form-item>
        <el-row :gutter='15'>
          <el-col :span="8">
            <el-form-item label="Show to agent only?">
              <el-radio :label="false" v-model='newAsociateForm.onlyAgent'>No</el-radio>
              <el-radio :label="true" v-model='newAsociateForm.onlyAgent'>Yes</el-radio>
            </el-form-item>
          </el-col>
          <el-col :span="8">
            <el-form-item label="Requires car?">
              <el-radio :label="false" v-model='newAsociateForm.requiresCar'>No</el-radio>
              <el-radio :label="true" v-model='newAsociateForm.requiresCar'>Yes</el-radio>
            </el-form-item>
          </el-col>
          <el-col :span="8">
            <el-form-item label="Requires house?">
              <el-radio :label="false" v-model='newAsociateForm.requiresHouse'>No</el-radio>
              <el-radio :label="true" v-model='newAsociateForm.requiresHouse'>Yes</el-radio>
            </el-form-item>
          </el-col>
        </el-row>
        <el-form-item label="Credits">
          <el-select 
            class='w-full' 
            v-model="newAsociateForm.credits" 
            multiple 
            placeholder="Seleccionar" 
            size='small'
            clearable
            filterable
            default-first-option >
            <el-option
                v-for='credit in credits'
                :key="credit.id"
                :label="credit.nameEN"
                :value="credit.id">
            </el-option>
          </el-select>
        </el-form-item>
        <el-form-item label="Categories">
          <el-select 
            class='w-full' 
            v-model="newAsociateForm.categories" 
            multiple 
            placeholder="Seleccionar" 
            size='small'
            clearable
            filterable
            default-first-option >
            <el-option
                v-for='category in categories'
                :key="category.id"
                :label="category.nameEN"
                :value="category.id">
            </el-option>
          </el-select>
        </el-form-item>
        <el-form-item label="Required credit records">
          <el-select 
            class='w-full' 
            v-model="newAsociateForm.records" 
            multiple 
            placeholder="Seleccionar" 
            size='small'
            clearable
            filterable
            default-first-option >
            <el-option
                v-for='record in records'
                :key="record.id"
                :label="record.nameEN"
                :value="record.id">
            </el-option>
          </el-select>
        </el-form-item>
        <el-form-item label="Amounts">
          <el-select 
            class='w-full' 
            v-model="newAsociateForm.amounts" 
            multiple 
            placeholder="Seleccionar" 
            size='small'
            clearable
            filterable
            default-first-option >
            <el-option
                v-for='amount in amounts'
                :key="amount.id"
                :label="`${formatMoney(amount.from)} - ${formatMoney(amount.until)}`"
                :value="amount.id">
            </el-option>
          </el-select>
        </el-form-item>
        <el-form-item label='Rate'>
          <div class="flex flex-row items-center ">
            <div class='w-1/4 mr-5'>
              <el-input 
                type='number'
                size='small' 
                step='0.25'
                min='0'
                max='5'
                v-model="newAsociateForm.rate"/>
            </div>
            <div class='w-1/3'>
              <el-rate v-model="newAsociateForm.rate" allow-half disabled />
            </div>
          </div>
        </el-form-item>
        <el-form-item label="final URL:">
          <el-input 
            placeholder="final URL" 
            size='small' 
            v-model="newAsociateForm.url"
            maxlength="500"
            show-word-limit
            clearable/>
        </el-form-item>
      </el-col>
    </el-row>
  </el-form>
  <span slot="footer" class="dialog-footer">
    <el-button @click="showNewPartner = false" size='small'>Cancelar</el-button>
    <el-button type="success" @click="savePartner(newAsociateForm)" size='small'>Guardar</el-button>
  </span>
</el-dialog>