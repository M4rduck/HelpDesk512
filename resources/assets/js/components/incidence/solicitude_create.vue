<template>
    <div class="modal-content">
        <form @submit.prevent="submit" id="form_solicitude" method="post">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Nueva Solicitud</h4>
            </div>
            <div class="modal-body">
                <div v-if="form_errors" class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" v-on:click="set_form_values" aria-hidden="true">&times;</button>
                    <ul>
                        <li v-bind:key="error[0]" v-for="error in form_errors">
                            {{ error[0] }}
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="solicitude_area">Area:</label>
                            <v-select :options="area_options" v-model="solicitude.area" id="solicitude_area" name="solicitude_area"></v-select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="solicitude_title">Titulo</label>
                            <input class="form-control" v-model="solicitude.title" type="text" name="solicitude_title" id="solicitude_title">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="solicitude_description">Descripcion</label>
                            <textarea style="width: 100%;" v-model="solicitude.description" tabindex="-1" class="form-control" name="solicitude_description" id="solicitude_description"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="solicitude_evidence">Evidencia</label>
                            <input type="file" style="width: 100%;" v-on:change="handle_upload" ref="evidence" tabindex="-1" class="form-control" name="solicitude_evidence" id="solicitude_evidence">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button v-on:click="set_form_values" class = "btn btn-danger pull-left" data-dismiss = "modal">Cerrar</button>
                <button type = "submit" class = "btn btn-success pull-right"><vue-element-loading :active="loading"  spinner="bar-fade-scale" color="#FF6700"/>Guardar</button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props: {
            submit_route: String,
            areas_route: String
        },

        created(){
            /*
            axios.get(this.incidence_states_route)
                .then(response => {
                    console.log(response);
                    this.incidence_state_options = response.data;
                });
            */
           axios.get(this.areas_route)
                .then(response => {
                    console.log(response);
                    this.area_options = response.data;
                });
        },

        data() {
            return {

                form_errors: false,

                loading: false,

                solicitude_created: false,

                area_options: [],

                solicitude: {

                    area: null,
                    title: '',
                    description: '',
                    evidence: new File([''], '')
                },

            }
        },

        methods: {

            submit() {

                let form_data = new FormData();

                form_data.append('evidence', this.solicitude.evidence);
                if(this.solicitude.area !== null){
                    form_data.append('area', this.solicitude.area.value);
                }
                form_data.append('title', this.solicitude.title);
                form_data.append('description', this.solicitude.description);

                for (var value of form_data.values()) {
                    console.log(value); 
                }

                this.loading = true;

                axios.post(this.submit_route, form_data, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(response => {
                    console.log(response.data);
                    this.loading = false;
                    if(response.data.estado){
                        
                        this.$root.$emit('solicitude_created', true);

                        swal(
                            'Exito',
                            response.data.mensaje,
                            'success'
                        );

                        this.set_form_values();

                    }
                }).catch(error => {
                    console.log(error.response);
                    if(error.response.status === 422){
                        this.form_errors = error.response.data.errors;
                    }else{
                        this.form_errors = false;
                    }
                    this.loading = false;
                });

            },

            set_form_values() {

                this.solicitude = {
                    area: null,
                    title: '',
                    description: '',
                    evidence: new File([''], '')
                };

                this.form_errors = false;

                this.solicitude_created = false;

            },

            handle_upload(){

                this.solicitude.evidence = this.$refs.evidence.files[0];
            }

        },

    }
</script>

