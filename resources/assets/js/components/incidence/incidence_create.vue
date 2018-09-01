<template>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Realizar {{ form.form_title[0] }}</h3>
                </div>
                <div style="margin: 2%;" class="box-body">
                    <!--
                    @if(session('msg')['estado'] == 's')
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ session('msg')['mensaje'] }}
                        </div>
                    @elseif(session('msg')['estado'] == 'w')
                        <div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ session('msg')['mensaje'] }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    -->
                    <form v-if="!solicitude_created" id="form_solicitude" action="" method="post">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="solicitude_area">Area:</label>
                                    <v-select :options="[]" id="solicitude_area" name="solicitude_area"></v-select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="solicitude_title">Titulo</label>
                                    <input class="form-control" type="text" name="solicitude_title" id="solicitude_title">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="solicitude_description">Descripcion</label>
                                    <textarea style="width: 100%;" tabindex="-1" class="form-control" name="solicitude_description" id="solicitude_description"></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form v-if="solicitude_created" id="form_incidence" v-bind:action="submit_route" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="incidence_contact">Contacto:</label>
                                    <select style="width: 100%;" tabindex="-1" class="form-control" id="incidence_contact" name="incidence_contact"></select>
                                </div>  
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="incidence_theme">Tema:</label>
                            <input type="text" class="form-control" id="incidence_theme" name="incidence_theme">
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado:</label>
                            <v-select v-model="form.selected_incidence_state" :options="incidence_state_options" id="incidence_state" name="incidence_state">
                            </v-select>
                        </div>
                        <div class="form-group">
                            <label for="incidence_priority">Prioridad:</label>
                            <v-select v-model="form.selected_priority" :options="priority_options" id="incidence_priority" name="incidence_priority">
                            </v-select>
                        </div>
                        <div class="form-group">
                            <label for="incidence_agent">Asignar a:</label>
                            <select class="form-control" id="incidence_agent" name="incidence_agent">
                                <option value="0" selected>Sin asignar</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="incidence_description">Descripción:</label>
                            <textarea rows="10" class="form-control" id="incidence_description" name="incidence_description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="incidence_evidence_route">Evidencia:</label>
                            <input type="file" id="incidence_evidence_route" name="incidence_evidence_route">
                        </div>
                    </form>
                </div>
                <div class="box-footer">
                    <div class="pull-right">
                        <button id="cancelar" type="button" class="btn btn-default">Cancelar</button>
                        <button id="crear" type="submit" class="btn btn-success">Crear</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            submit_route: String,
            incidence_states_route: String
        },

        created(){
            axios.get(this.incidence_states_route)
                .then(response => {
                    console.log(response);
                    this.incidence_state_options = response.data;
                });
        },

        data() {
            return {
                solicitude_created: false,

                incidence_state_options: [],

                priority_options: [
                    {label: 'Baja', value: 'low'},
                    {label: 'Media', value: 'Medium'},
                    {label: 'Alta', value: 'high'},
                    {label: 'Urgente', value: 'urgent'},
                ],

                form: {
                    
                    form_title: [
                    'Solicitud',
                    'Incidencia'
                    ],

                    selected_priority: {label: 'Media', value: 'Medium'},

                    selected_incidence_state: {label: 'Abierto', value: 1},

               },

            }
        },

        methods: {

            submit() {
                

            }

        }
    }
</script>

