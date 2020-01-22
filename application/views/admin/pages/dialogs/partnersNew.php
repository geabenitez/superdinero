<el-dialog title="Nuevo asociado" :visible.sync="showNewPartner" width=1200px>
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
                v-for='n in 52'
                :key="n"
                :label="`Estado N ${n}`"
                :value="n">
            </el-option>
          </el-select>
        </el-form-item>
        <el-form-item label="¿Mostrar solo al agente?">
            <el-radio :label="false" v-model='newAsociateForm.onlyAgent'>No</el-radio>
            <el-radio :label="true" v-model='newAsociateForm.onlyAgent'>Sí</el-radio>
        </el-form-item>
        <el-form-item label="Categorias">
          <el-checkbox-group v-model="newAsociateForm.categories">
            <el-checkbox v-for='n in 8' :label="`Categoria ${n}`" name="categories" size='small' />
          </el-checkbox-group>
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
                v-for='n in 52'
                :key="n"
                :label="`Estado N ${n}`"
                :value="n">
            </el-option>
          </el-select>
        </el-form-item>
        <el-form-item label="Show to agent only?">
            <el-radio :label="false" v-model='newAsociateForm.onlyAgent'>No</el-radio>
            <el-radio :label="true" v-model='newAsociateForm.onlyAgent'>Sí</el-radio>
        </el-form-item>
        <el-form-item label="Categories">
          <el-checkbox-group v-model="newAsociateForm.categories">
            <el-checkbox v-for='n in 8' :label="`Categoria ${n}`" name="categories" size='small' />
          </el-checkbox-group>
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
      </el-col>
    </el-row>
  </el-form>
  <span slot="footer" class="dialog-footer">
    <el-button @click="showNewPartner = false" size='small'>Cancelar</el-button>
    <el-button type="success" @click="showNewPartner = false" size='small'>Guardar</el-button>
  </span>
</el-dialog>