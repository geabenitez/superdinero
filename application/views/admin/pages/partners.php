<div id="app">
  <?php $this->load->view('admin/pages/dialogs/partnersNew')  ?>
  <el-row :gutter='15' class='mb-4' type='flex' justify='space-between'>
    <el-col :span='6'>
      <el-input placeholder="Buscar" size='small' v-model="searchValue" prefix-icon='el-icon-search' clearable />
    </el-col>
    <el-col :span='3'>
      <el-button 
        type="success" 
        icon="el-icon-plus" 
        size='small'
        @click='showNewPartner = true'>
        Nuevo asociado
      </el-button>
    </el-col>
  </el-row>
  <el-row :gutter='15'>
    <el-col :span='24'>
      <el-table :data="partners" class="w-full" stripe size='mini' empty-text='No hay datos'>
        <el-table-column prop="nameES" label="Nombre ES" min-width="180"></el-table-column>
        <el-table-column prop="nameEN" label="Nombre EN" min-width="180"></el-table-column>
        <el-table-column label="Estados" min-width='80' align='center'>
          <template slot-scope='scope'>
            <span class='underline text-blue-500 cursor-pointer'>{{ scope.row.states.length }}</span>
          </template>
        </el-table-column>
        <el-table-column label="¿Sólo agente?" min-width='80' align='center'>
          <template slot-scope='scope'>
            <span>{{ scope.row.onlyAgent ? 'Si' : 'No' }}</span>
          </template>
        </el-table-column>
        <el-table-column label="Categorias" min-width='80' align='center'>
          <template slot-scope='scope'>
            <span class='underline text-blue-500 cursor-pointer'>{{ scope.row.categories.length }}</span>
          </template>
        </el-table-column>
        <el-table-column prop='rate' label="Calificación" min-width='80' align='center'>
        </el-table-column>
        <el-table-column label="Estado" min-width='80'>
          <template slot-scope='scope'>
            <span v-if='scope.row.active' class='text-green-500 font-semibold'>Activo</span>
            <span v-else class='text-gray-500 font-semibold'>Inactivo</span>
          </template>
        </el-table-column>
        <el-table-column min-width='60'>
        </el-table-column>
      </el-table>
    </el-col>
</div>