<div id="app">
  <?php $this->load->view('admin/pages/dialogs/usersNew')  ?>
  <el-row :gutter='15' class='mb-4' type='flex' justify='space-between'>
    <el-col :span='6'>
      <el-input placeholder="Buscar" size='small' v-model="searchValue" prefix-icon='el-icon-search' clearable />
    </el-col>
    <el-col :span='4'>
      <el-button 
      class='w-full'
        type="success" 
        icon="el-icon-plus" 
        size='small'
        @click='createUser'>
        Nuevo Usuario
      </el-button>
    </el-col>
  </el-row>
  <el-row :gutter='15'>
    <el-col :span='24'>
      <el-table :data="filteredUsers" class="w-full" stripe size='mini' empty-text='No hay datos'>
        <el-table-column prop="index" min-width="25"></el-table-column>
        <el-table-column label="Nombres" min-width="100">
          <template slot-scope="scope">
            <span>{{ scope.row.names }}</span>
          </template>
        </el-table-column>
        <el-table-column label="Apellidos" min-width="100">
          <template slot-scope="scope">
            <span>{{ scope.row.lastnames }}</span>
          </template>
        </el-table-column>
        <el-table-column label="Codigo" min-width="100">
          <template slot-scope="scope">
            <span>{{ scope.row.code }}</span>
          </template>
        </el-table-column>
        <el-table-column label="Email" min-width="200">
          <template slot-scope="scope">
            <span>{{ scope.row.email }}</span>
          </template>
        </el-table-column>
        <el-table-column label="Perfil" min-width="100">
          <template slot-scope="scope">
            <span>{{ scope.row.profile }}</span>
          </template>
        </el-table-column>
        <el-table-column min-width="220"></el-table-column>
   
        <el-table-column min-width='60'>
          <template slot-scope="scope">
            <el-dropdown trigger="click" class='my-1'>
              <span class="border border-gray-400 px-4 py-1 bg-white hover:bg-gray-100 rounded">
                <i class="el-icon-more"></i>
              </span>
            <el-dropdown-menu slot="dropdown">
              <el-dropdown-item @click.native="editUser(scope.row)">
                  <i class="el-icon-edit-outline"></i> Editar usuario
                </el-dropdown-item>
                <el-dropdown-item @click.native="changeStatus(scope.row.id, scope.row.active)">
                  <span v-if="scope.row.active == '1'">
                    <i class="el-icon-close"></i> Desactivar
                  </span>
                  <span v-else>
                    <i class="el-icon-check"></i> Activar
                  </span>
                  usuario
                </el-dropdown-item>
                <el-dropdown-item divided class='font-semibold' @click.native="deleteUser(scope.row.id)">
                  <span class='text-red-500 tracking-wide'>
                    <i class="el-icon-delete"></i> Eliminar usuario
                  </span>
                </el-dropdown-item>
              </el-dropdown-menu>
            </el-dropdown>
          </template>
        </el-table-column>
      </el-table>
    </el-col>
  </el-row>
</div>