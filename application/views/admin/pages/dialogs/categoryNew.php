<el-dialog :title="action" :visible.sync="showNewCategory" width=600px>
  <el-form label-position="top" label-width="100px" :model="newCategoryForm">
    <el-row :gutter='15'>
      <el-col :span='12' class='border-r'>
        <el-row :gutter='15' class='mb-4'>
          <el-col :span='24'>
            <el-alert title="DATOS VERSION EN ESPAÑOL" size='small' type="info" :closable='false' show-icon />
          </el-col>
        </el-row>
        <el-form-item label="Nombre:">
          <el-input 
          placeholder="Nombre de categoria" 
          size='small' 
          v-model="newCategoryForm.nameES"
          maxlength="50"
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
          placeholder="Categorie's name" 
          size='small' 
          v-model="newCategoryForm.nameEN"
          maxlength="50"
          show-word-limit
          clearable/>
        </el-form-item>
      </el-col>
    </el-row>
    <el-row :gutter='15'>
      <el-col :span='24' class='flex flex-col items-center justify-center'>
        <el-alert title="Formato PNG, menores a 200KB, de preferencia cuadrado" size='small' type="info" :closable='false' show-icon></el-alert>
        <input type='file' name='image' class='my-2' ref='image' @change='beforeUpload'/>
        <img src="https://via.placeholder.com/250" class='w-64 h-64 rounded border bg-gray-100' ref='imagePreview'>
      </el-col>
    </el-row>
  </el-form>
  <span slot="footer" class="dialog-footer">
    <el-button @click="showNewCategory = false" size='small'>Cancelar</el-button>
    <el-button type="success" @click="saveCategory(newCategoryForm)" size='small'>Guardar</el-button>
  </span>
</el-dialog>