<div id="app">
  <?php $this->load->view('admin/pages/dialogs/recordNew')  ?>
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
        @click='createRecord'>
        Nueva record
      </el-button>
    </el-col>
  </el-row>
  <el-row :gutter='15'>
    <el-col :span='24'>
      <el-table :data="filteredRecords" class="w-full" stripe size='mini' empty-text='No hay datos' v-loading="loading">
        <el-table-column prop="index" min-width="25"></el-table-column>
        <el-table-column prop="nameES" label="Nombre ES" min-width="220"></el-table-column>
        <el-table-column prop="nameEN" label="Nombre EN" min-width="220"></el-table-column>
        <el-table-column min-width="200"></el-table-column>
        <el-table-column label="Estado" min-width='60'>
          <template slot-scope='scope'>
            <span v-if="scope.row.active == '1'" class='text-green-500 font-semibold'>Activo</span>
            <span v-else class='text-gray-500 font-semibold'>Inactivo</span>
          </template>
        </el-table-column>
        <el-table-column min-width='60'>
          <template slot-scope="scope">
            <el-dropdown trigger="click" class='my-1'>
              <span class="border border-gray-400 px-4 py-1 bg-white hover:bg-gray-100 rounded">
                <i class="el-icon-more"></i>
              </span>
              <el-dropdown-menu slot="dropdown">
                <el-dropdown-item @click.native="editRecord(scope.row)">
                  <i class="el-icon-edit-outline"></i> Editar record
                </el-dropdown-item>
                <el-dropdown-item @click.native="changeStatus(scope.row.id, scope.row.active)">
                  <span v-if="scope.row.active == '1'">
                    <i class="el-icon-close"></i> Desactivar
                  </span>
                  <span v-else>
                    <i class="el-icon-check"></i> Activar
                  </span>
                  record
                </el-dropdown-item>
                <el-dropdown-item divided class='font-semibold' @click.native="deleteRecord(scope.row.id)">
                  <span class='text-red-500 tracking-wide'>
                    <i class="el-icon-delete"></i> Eliminar record
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