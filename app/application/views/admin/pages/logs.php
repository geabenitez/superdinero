<div id='app'>
  <div>
    <el-row :gutter='15'>
      <el-col span="5">
        <el-select v-model="filter.agent" placeholder="Agente" size="small" filterable clearable class="w-full">
          <el-option
            v-for="agent in agents"
            :key="agent.id"
            :label="`${agent.names} ${agent.lastnames}`"
            :value="agent.id">
          </el-option>
        </el-select>
      </el-col>
      <el-col span="6">
        <el-input
          placeholder="Search"
          prefix-icon="el-icon-search"
          v-model="filter.search"
          size="small"
          clearable>
        </el-input>
      </el-col>
    </el-row>
    <el-row :gutter='15'>
      <el-col :span='24'>
        <el-table :data="filtered" class="w-full" stripe size='mini' empty-text='No hay datos' v-loading="loading">
          <el-table-column prop="index" min-width="25"></el-table-column>
          <el-table-column prop="codigo" label="Código" min-width="80"></el-table-column>
          <el-table-column prop="name" label="Nombre" min-width="200"></el-table-column>
          <el-table-column prop="email" label="Correo" min-width="280"></el-table-column>
          <el-table-column prop="phone" label="Telefono" min-width="100"></el-table-column>
          <el-table-column prop="type" label="Tipo" min-width="90"></el-table-column>
          <el-table-column label="Agente" min-width="150">
            <template slot-scope='scope'>
              <span>{{ findName(scope.row.agent) }}</span>
            </template>
          </el-table-column>
          <el-table-column prop="date" label="Fecha" min-width="150"></el-table-column>
        </el-table>
      </el-col>
    </el-row>
  </div>
</div>