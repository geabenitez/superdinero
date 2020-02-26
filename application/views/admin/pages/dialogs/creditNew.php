<el-dialog :title="action" :visible.sync="showNewCredit" width=600px>
  <el-form label-position="top" label-width="100px" :model="newCreditForm">
    <el-row :gutter='15'>
      <el-col :span='12' class='border-r'>
        <el-row :gutter='15' class='mb-4'>
          <el-col :span='24'>
            <el-alert title="DATOS VERSION EN ESPAÑOL" size='small' type="info" :closable='false' show-icon />
          </el-col>
        </el-row>
        <el-form-item label="Nombre:">
          <el-input 
          placeholder="Nombre del tipo de credito" 
          size='small' 
          v-model="newCreditForm.nameES"
          maxlength="50"
          show-word-limit
          clearable/>
        </el-form-item>
        <el-form-item label="Slug:">
          <el-input 
          placeholder="Nombre de slug (para URL)" 
          size='small' 
          v-model="newCreditForm.slug"
          maxlength="100"
          show-word-limit
          clearable/>
        </el-form-item>
        <el-form-item label="Cantidad máxima:">
          <el-input 
          type='number'
          placeholder="Cantidad máxima" 
          size='small' 
          v-model="newCreditForm.maxAmount"
          min="0.01"
          step='0.01'
          show-word-limit
          clearable/>
        </el-form-item>
        <el-form-item label="Categorias">
          <el-select 
            class='w-full' 
            v-model="newCreditForm.categories" 
            multiple 
            placeholder="Seleccionar" 
            size='small'
            clearable
            filterable
            default-first-option >
            <el-option
                v-for='category in categories'
                :key="category.id"
                :label="category.nameES"
                :value="category.id">
            </el-option>
          </el-select>
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
          placeholder="Credit type name" 
          size='small' 
          v-model="newCreditForm.nameEN"
          maxlength="50"
          show-word-limit
          clearable/>
        </el-form-item>
        <el-form-item label="Slug:">
          <el-input 
          placeholder="Slug's name (for URL)" 
          size='small' 
          v-model="newCreditForm.slug"
          maxlength="100"
          show-word-limit
          clearable/>
        </el-form-item>
        <el-form-item label="Max amount:">
          <el-input 
          type='number'
          placeholder="Max amount" 
          size='small' 
          v-model="newCreditForm.maxAmount"
          min="0.01"
          step='0.01'
          show-word-limit
          clearable/>
        </el-form-item>
        <el-form-item label="Categories">
          <el-select 
            class='w-full' 
            v-model="newCreditForm.categories" 
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
      </el-col>
    </el-row>
  </el-form>
  <span slot="footer" class="dialog-footer">
    <el-button @click="showNewCredit = false" size='small'>Cancelar</el-button>
    <el-button type="success" @click="saveCredit(newCreditForm)" size='small'>Guardar</el-button>
  </span>
</el-dialog>