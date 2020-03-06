<el-dialog :title="action" :visible.sync="showNewUser" width=500px>
  <el-form label-position="top" label-width="100px" :model="newUserForm">
    <el-row :gutter='15'>
      <el-col :span='12'>
        <el-form-item label="Desde:">
          <el-input 
            placeholder="Ingresa monto" 
            size='small' 
            v-model="newUserForm.names"
            type='number'
            min='0.01'
            step='0.25'
            clearable/>
        </el-form-item>
      </el-col>
      <el-col :span='12'>
        <el-form-item label="Hasta:">
          <el-input 
            placeholder="Ingresa monto" 
            size='small' 
            v-model="newUserForm.lastnames"
            type='number'
            min='0.01'
            step='0.25'
            clearable/>
        </el-form-item>
      </el-col>
    </el-row>
  </el-form>
  <span slot="footer" class="dialog-footer">
    <el-button @click="showNewUser = false" size='small'>Cancelar</el-button>
    <el-button type="success" @click="saveUser(newUserForm)" size='small'>Guardar</el-button>
  </span>
</el-dialog>