<el-dialog :title="action" :visible.sync="showNewMethod" width=600px>
  <el-form label-position="top" label-width="100px" :model="newMethodForm">
    <el-row :gutter='15'>
      <el-col :span='12' class='border-r'>
        <el-row :gutter='15' class='mb-4'>
          <el-col :span='24'>
            <el-alert title="DATOS VERSION EN ESPAÑOL" size='small' type="info" :closable='false' show-icon />
          </el-col>
        </el-row>
        <el-form-item label="Nombre:">
          <el-input 
          placeholder="Nombre de metodo" 
          size='small' 
          v-model="newMethodForm.nameES"
          maxlength="80"
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
          placeholder="Methods's name" 
          size='small' 
          v-model="newMethodForm.nameEN"
          maxlength="80"
          show-word-limit
          clearable/>
        </el-form-item>
      </el-col>
    </el-row>
  </el-form>
  <span slot="footer" class="dialog-footer">
    <el-button @click="showNewMethod = false" size='small'>Cancelar</el-button>
    <el-button type="success" @click="saveMethod(newMethodForm)" size='small'>Guardar</el-button>
  </span>
</el-dialog>