<template>
    <div class="container">
        <div class="form-group">
          <label for="search">Buscar:</label>
          &nbsp;
          <input id="search" type="text" v-model="query" />
        </div>
        <div class="table-responsive">
          <table id="solicitude_list" ref="solicitude_list" class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Area</th>
                <th>Titulo</th>
                <th>Descripcion</th>
                <th>Detalles</th>
              </tr>
            </thead>
            <tbody>
              <tr v-bind:key="registro.solicitude.id" v-for="registro in paginated('solicitudes')">
                <td>{{registro.solicitude.id}}</td>
                <td>{{ registro.area[0].name }}</td>
                <td>{{ registro.solicitude.title }}</td>
                <td>{{ registro.solicitude.description }}</td>
                <th>{{ 'boton hacia ruta detalles' }}</th>
              </tr>
            </tbody>
          </table>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        details_route: String,
        solicitudes_route: String
    },

    created() {
        this.get_solicitudes();
    },

    data() {
        return {
            solicitudes: [],

            query: '',

            paginate: ['solicitudes'],

        }
    },

    computed: {
        filtered_solicitudes() {
            return this.solicitudes.filter(solicitude => {
                return solicitude.area[0].name.toLowerCase().indexOf(this.query.toLowerCase()) > -1 ||
                    solicitude.solicitude.description.toLowerCase().indexOf(this.query.toLowerCase()) > -1;
            })
        }
    },

    methods: {

        get_solicitudes() {
            axios.get(this.solicitudes_route)
            .then(response => {
                console.log(response);
                this.solicitudes = response.data;
            })
            .catch(response => {
                console.log(response);
            });
        },

    },

    mounted() {

        this.$root.$on('solicitude_created', tmp => {
            this.get_solicitudes();
        });

    }




}
</script>
