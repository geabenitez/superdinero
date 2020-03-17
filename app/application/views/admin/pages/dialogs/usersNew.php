<el-dialog :title="action" :visible.sync="showNewUser" width=700px>
  <el-form label-position="top" label-width="100px" :model="newUserForm">
    <el-row :gutter='15'>
      <el-col :span='8'>
        <el-form-item label="Nombres:">
          <el-input 
            placeholder="Ingresa los nombres" 
            size='small' 
            v-model="newUserForm.names"
            type='text'
            clearable/>
        </el-form-item>
      </el-col>
      <el-col :span='8'>
        <el-form-item label="Apellidos">
          <el-input 
            placeholder="Ingresa los apellidos" 
            size='small' 
            v-model="newUserForm.lastnames"
            type='text'
            clearable/>
        </el-form-item>
      </el-col>
      <el-col :span='8'>
        <el-form-item label="Codigo">
          <el-input 
            placeholder="Agrega el codigo" 
            size='small' 
            v-model="newUserForm.code"
            type='text'
            clearable/>
        </el-form-item>
      </el-col>
    </el-row>
    <el-row :gutter='15'>
      <el-col :span='8'>
        <el-form-item label="Email:">
          <el-input 
            placeholder="Ingrese el email" 
            size='small' 
            v-model="newUserForm.email"
            type='text'
            clearable/>
        </el-form-item>
      </el-col>
      <el-col :span='8'>
        <el-form-item label="Password">
          <el-input 
            placeholder="Ingresa el password" 
            size='small' 
            v-model="newUserForm.password"
            type='text'
            clearable/>
        </el-form-item>
      </el-col>
      <el-col :span='8'>
        <el-form-item label="Perfil">
          <el-select v-model="newUserForm.profile" placeholder="Seleccionar opcion">
            <el-option label="Administrador" value="1"></el-option>
            <el-option label="Agente" value="2"></el-option>
          </el-select>
        </el-form-item>
      </el-col>
    </el-row>
  </el-form>
  <span slot="footer" class="dialog-footer">
    <el-button @click="showNewUser = false" size='small'>Cancelar</el-button>
    <el-button type="success" @click="saveUser(newUserForm)" size='small'>Guardar</el-button>
  </span>
</el-dialog>