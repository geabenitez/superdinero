<div id="app">
  <?php $this->load->view('admin/pages/dialogs/creditNew')  ?>
  <el-dialog title="Update the image" :visible.sync="showImageChange" width=400px>
    <input type='file' ref="imgFile" @change='previewImage()' />
    <div class='flex flex-col items-center justify-center mt-2'>
      <img class='bg-gray-200 broder rounded w-64 h-64' ref="imgPreview" :src="newCreditForm.image" />
      <span class='text-xs'>Tamaño recomendado 256x256 pixeles</span>
    </div>
    <span slot="footer" class="dialog-footer">
      <el-button @click="showImageChange = false" size='small'>Cancelar</el-button>
      <el-button type="success" @click="updateImage(newCreditForm.image, newCreditForm.id)" size='small'>Actualizar</el-button>
    </span>
  </el-dialog>
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
        @click='createCredit'>
        Nueva Crédito
      </el-button>
    </el-col>
  </el-row>
  <el-row :gutter='15'>
    <el-col :span='24'>
      <el-table :data="filteredCredits" class="w-full" stripe size='mini' empty-text='No hay datos' v-loading="loading">
        <el-table-column prop="index" min-width="25"></el-table-column>
        <el-table-column prop="nameES" label="Nombre ES" min-width="100"></el-table-column>
        <el-table-column prop="nameEN" label="Nombre EN" min-width="100"></el-table-column>
        <el-table-column label="Categorias" min-width="100">
          <template slot-scope='scope'>
            <span>{{scope.row.categories.length}}</span>
          </template>
        </el-table-column>
        <el-table-column prop="slug" label="Slug" min-width="100"></el-table-column>
        <el-table-column label="Cantidad Mínima" min-width="100">
          <template slot-scope='scope'>
            <span>{{formatMoney(scope.row.minAmount)}}</span>
          </template>
        </el-table-column>
        <el-table-column label="Cantidad Máxima" min-width="100">
          <template slot-scope='scope'>
            <span>{{formatMoney(scope.row.maxAmount)}}</span>
          </template>
        </el-table-column>
        <el-table-column min-width="160"></el-table-column>
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
                <el-dropdown-item @click.native="openUpdateImage(scope.row)">
                  <i class="el-icon-picture"></i> Cambiar imagen
                </el-dropdown-item>
                <el-dropdown-item @click.native="editCredit(scope.row)">
                  <i class="el-icon-edit-outline"></i> Editar crédito
                </el-dropdown-item>
                <el-dropdown-item @click.native="changeStatus(scope.row.id, scope.row.active)">
                  <span v-if="scope.row.active == '1'">
                    <i class="el-icon-close"></i> Desactivar
                  </span>
                  <span v-else>
                    <i class="el-icon-check"></i> Activar
                  </span>
                  crédito
                </el-dropdown-item>
                <el-dropdown-item divided class='font-semibold' @click.native="deleteCredit(scope.row.id)">
                  <span class='text-red-500 tracking-wide'>
                    <i class="el-icon-delete"></i> Eliminar crédito
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