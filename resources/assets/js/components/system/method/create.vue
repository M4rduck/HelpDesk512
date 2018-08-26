<template>
<div>
    <form v-bind:action="route" method="post" @submit.prevent="onSubmit">
                <div class="modal-header bg-warning">                    
                    <button class = "close" data-dismiss = "modal">&times;</button>
                    <h4 class="modal-title">Registrar</h4>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <!-- Controlador & Url -->
                        <div class="col-lg-6 col-sm-12">
                            <!-- Controlador -->
                            <div class="form-group" :class="{'has-error': $v.form.controller_id.$error}">
                                <label for = "controller_id">Controlador</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-cog"></i>
                                    </span>
                                    <v-select label="name" :options="controllers" v-model="$v.form.controller_id.$model"></v-select>
                                </div>
                                <span class="help-block" v-if="$v.form.controller_id.$error">Debes seleccionar un controlador</span>
                            </div>
                            <!-- /Controlador -->

                            <!-- Url -->
                            <div class="form-group" :class="{ 'has-error': $v.form.url.$error }">                                
                                <label for = "url">Url</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-link"></i>
                                    </span>
                                    <input type = "text" name = "methods[url]" class = "form-control" title = "Url del método" placeholder = "/url" id = "url" @input="$v.form.url.$touch()"  v-model.trim="$v.form.url.$model"/>
                                </div>
                                <span class="help-block" v-if="!$v.form.url.required">Debes poner la url</span>
                                <span class="help-block" v-if="!$v.form.url.minLength">LA url debe tener al menos {{ $v.form.url.$params.minLength.min }} caracteres. </span>
                            </div>
                            <!-- /Verbo -->
                        </div>
                        <!-- /Controlador & Url -->

                        <!-- Verbo & Nombre de Funcion -->
                        <div class="col-lg-6 col-sm-12">
                            <!-- Verbo -->
                            <div class="form-group" :class="{ 'has-error': $v.form.verbName.$error}">
                                <label for = "verbName">Verbo</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-object-group"></i>
                                    </span>
                                    <v-select label="value" :options="form.verbNameOptions" v-model="$v.form.verbName.$model"></v-select>
                                </div>
                                <span class="help-block" v-if="$v.form.verbName.$error">Debes seleccionar un verbo</span>
                            </div>
                            <!-- /Verbo -->

                            <!-- Nombre de Funcion -->
                            <div class="form-group ">
                                <label for = "name_function" >Funcion</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-object-group"></i>
                                    </span>
                                    <input type = "text" name = "methods[name_function]" class = "form-control" title = "Nombre de la función del método" placeholder = "index" id = "name_function" v-model="form.name_function" />                                                                        
                                </div>                                
                            </div>
                            <!-- /Nombre de Funcion -->
                        </div>
                        <!-- /Verbo & Nombre de Funcion -->
                    </div>

                    <div class="row">
                        <!-- Nombre del método-->
                        <div class="col-lg-6 col-sm-12">
                            <!-- Nombre del método-->
                            <div class="form-group">
                                <label for= "name">Nombre</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-object-group"></i>
                                    </span>
                                    <input name="methods[name]" type = "text" value = "" class ="form-control" title = "Nombre de la ruta" placeholder = "general.index" id = "name" v-model="form.name">
                                </div>
                            </div>
                            <!-- /Nombre del método-->
                        </div>
                        <!-- /Nombre del método-->
                    </div>
                </div>
                <div class="modal-footer">
                    <button class = "btn btn-danger pull-left" data-dismiss = "modal">Cerrar</button>
                    <button type = "submit" :disabled="$v.$invalid" class = "btn btn-success pull-right"><vue-element-loading :active="form.isLoading"  spinner="bar-fade-scale" color="#FF6700"/>Guardar</button>
                </div>
    </form>
</div>
</template>

<script>
import { required, minLength, helpers } from 'vuelidate/lib/validators';
const must_be_controller = (value) => value.id != 0 && value != null
const must_be_verb = (value) => (value.id.indexOf('post') >= 0 || value.id.indexOf('get') >= 0 || value.id.indexOf('put') >= 0 || value.id.indexOf('patch') >= 0 || value.id.indexOf('delete') >= 0 || value.id.indexOf('resource') >= 0) && value != null



export default {
    props: {
        controllers: Array,
        route: String
    },
    data(){
        return{
            form:{
                name_function: '',                
                verbNameOptions:[
                    {id: 'select', value: 'Elige un verbo'},
                    {id: 'post', value:'POST'},
                    {id: 'get', value: 'GET'},
                    {id: 'put', value: 'PUT'},
                    {id: 'patch', value: 'PATCH'},
                    {id: 'delete', value: 'DELETE'},
                    {id: 'resource', value: 'RESOURCE'}
                ],
                verbName: {id: 'select', value: 'Elige un verbo'},
                controller_id: {id: 0, name: 'Elige un controlador'},
                url: '',
                name: '',
                isLoading: false
                
            }
            
        }
    },
    validations:{
        form:{
            url: {
             required,
             minLength: minLength(5)
            },
            verbName: {
                must_be_verb
            },
            controller_id: {
                must_be_controller
            }
        }
         
    },
    methods: {
        onSubmit(){
            if(!this.$v.$invalid) {
                const user = { 
                    methods: {
                        controller_id: this.form.controller_id.id,
                        verbName: this.form.verbName.id,
                        url: this.form.url,
                        name_function: this.form.name_function,
                        name: this.form.name
                    }                    
                }
                let form = this.form;
                form.isLoading = true;
                axios.post(this.route, user)
                     .then(function (response) {
                         let answer = response.data;
                         let typeMsg = '';
                         form.isLoading = false;
                         console.log(answer);
                         if(answer.success && !answer.error && !answer.warning){
                             typeMsg= 'success';
                         }else if(answer.success && !answer.error && answer.warning){
                             typeMsg = 'warning';
                         }else{
                             typeMsg = 'error';                             
                         }

                         swal(
                                 answer.title,
                                 answer.msg,
                                 typeMsg
                             )
                     }).catch(function (error) {
                         form.isLoading = false;
                         console.log(error);
                     });
            }    
        }
    },
    mounted(){
    }
}
</script>