<template>
  <div>
    <code>query: {{ query }}</code>
    <datatable v-bind="$data" />
  </div>
</template>
<script>
import mockData from '../_mockData'
export default {
  data: () => ({
    columns: [
      { title: 'Controlador', field: 'uid', sortable: true },
      { title: 'Función', field: 'name' },
      { title: 'Url', field: 'age', sortable: true },
      { title: 'Verbo', field: 'email' },
      { title: 'Nombre', field: 'country' }
    ],
    data: [],
    total: 0,
    query: {}
  }),
  watch: {
    query: {
      handler (query) {
        mockData(query).then(({ rows, total }) => {
          this.data = rows
          this.total = total
        })
      },
      deep: true
    }
  }
}
</script>