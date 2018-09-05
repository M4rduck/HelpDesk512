<template>
    <div>
        <form method="post" :action="route" @submit.prevent="onSubmit">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <button class = "close" data-dismiss = "modal">&times;</button>
                    <h4 class="modal-title">Registrar</h4>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <!-- Controlador & Modulo -->
                        <div class="col-lg-6 col-sm-12">
                            <!-- Controlador -->
                            <div class="form-group">
                                <label for="method_id">Método</label>
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-cog"></i>
                                        </span> 
                                        <v-select label="name" :options="methods" v-model="$v.form.method_id.$model"></v-select>
                                </div>
                            </div>
                            <!-- /Controlador -->

                            <!-- Modulo -->
                            <div class="form-group">                                
                                <label for="module_id">Módulo</label>
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-link"></i>
                                        </span>
                                        <v-select label="text" :options="modules" :disabled="form.main" v-model="$v.form.module_id.$model"></v-select>
                                </div>
                            </div>
                            <!-- /Modulo -->
                        </div>
                        <!-- /Controlador & Modulo -->

                        <!-- Order & Nombre de Funcion -->
                        <div class="col-lg-6 col-sm-12">
                            <!-- Order -->
                            <div class="form-group" :class="{'has-error': $v.form.order.$error}">                                
                                <label for="order">Orden</label>
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-object-group"></i>
                                        </span>
                                        <input type="number" class="form-control" title="Orden en el cuál se vizualizara el módulo" placeholder="Ejemplo: 1" id="order" @input="$v.form.order.$touch()"  v-model.trim="$v.form.order.$model"/>                                        
                                </div>
                                <span class="help-block" v-if="$v.form.order.$error">Debes ingresar el orden del módulo</span>
                            </div>
                            <!-- /Order -->

                            <!-- Nombre de Funcion -->
                            <div class="form-group" :class="{'has-error': $v.form.text.$error}">                                
                                <label for="text">Nombre</label>
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-object-group"></i>
                                        </span>
                                        <input type="text" class="form-control" title = "Nombre del módulo" placeholder = "Incidencias" id = "text" @input="$v.form.text.$touch()" v-model.trim="$v.form.text.$model"/>                                                                            
                                </div>
                                <span class="help-block" v-if="$v.form.text.$error">Debes ingresar el nombre del módulo</span>
                            </div>
                            <!-- /Nombre de Funcion -->
                        </div>
                        <!-- /Order & Nombre de Funcion -->
                    </div>

                    <div class="row">
                        <!-- Nombre del método-->
                        <div class="col-lg-6 col-sm-12">
                            <!-- Nombre del método-->
                            <div class="form-group" :class="{'has-error': $v.form.icon.$error}">                                
                                <label for="icon">Icono</label>
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-object-group"></i>
                                        </span>
                                        <input type="text" class="form-control" title = "Nombre del icono que se mostrará con el módulo" placeholder = "fa-cogs, omitir fa, solo poner cogs" id = "icon" @input="$v.form.icon.$touch()" v-model.trim="$v.form.icon.$model"/>                                        
                                </div>
                                <span class="help-block" v-if="$v.form.icon.$error">Debes ingresar un icono para el módulo</span>
                            </div>
                            <!-- /Nombre del método-->
                        </div>
                        <!-- /Nombre del método-->

                        <!-- Nombre del método-->
                        <div class="col-lg-6 col-sm-12">
                            <!-- Nombre del método-->
                            <div class="form-group">
                                <label for="icon_color">Color Icono</label>
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-object-group"></i>
                                        </span>
                                        <input type="text" class = "form-control" title = "Color con el cuál se pintara el icono del modulo" placeholder = "Selecciona un color" id = "icon_color" v-model="form.icon_color"/>                                    
                                </div>
                            </div>
                            <!-- /Nombre del método-->
                        </div>
                        <!-- /Nombre del método-->
                    </div>

                    <div class="row">
                        <!-- Nombre del método-->
                        <div class="col-lg-6 col-sm-12">
                            <!-- Nombre del método-->
                            <div class="form-group">                                
                                <label for="label">Label</label>
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-object-group"></i>
                                        </span>
                                        <input type="text" class = "form-control" title = "Texto que se mostrara al lado del nombre del modulo, preferiblemente poner números" placeholder = "Indica número de incidencias: 4" id = "label" v-model="form.label"/>                                    
                                </div>
                            </div>
                            <!-- /Nombre del método-->
                        </div>
                        <!-- /Nombre del método-->

                        <!-- Nombre del método-->
                        <div class="col-lg-6 col-sm-12">
                            <!-- Nombre del método-->
                            <div class="form-group">
                                <label for="label_color">Color Label</label>
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-object-group"></i>
                                        </span>
                                        <input type="text" class = "form-control" title = "Color del label" placeholder = "Selecciona el color" id = "label_color" v-model="form.label_color"/>
                                </div>
                            </div>
                            <!-- /Nombre del método-->
                        </div>
                        <!-- /Nombre del método-->
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">                                
                                <label for="main">Principal</label>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="main" v-model="form.main" checked/> Sí
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class = "btn btn-danger pull-left" data-dismiss = "modal">Cerrar</button>
                    <button type = "submit" :disabled="$v.$invalid" class = "btn btn-success pull-right"><vue-element-loading :active="form.isLoading"  spinner="bar-fade-scale" color="#FF6700"/>Guardar</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import { required, minLength, numeric, helpers } from 'vuelidate/lib/validators';
const must_be_select = (param) => helpers.withParams(
    {type: 'contains', value: param },
    (value) => param ? true : value.id != 0 && value != null
)
const vuelidations = {
                        form:{
                                    order: {
                                        required,
                                        numeric,
                                        minLength: minLength(1)
                                    },
                                    text: {
                                        required
                                    },
                                    icon: {
                                        required
                                    }
                                }
                    }

export default {
    props:{
        route: String,
        methods: Array,
        modules: Array
    },
    data() {
        return {
            form: {
                method_id: {id: 0, name: 'Elige un método'},
                module_id: {id: 0, text: 'Elige un módulo'},
                label: '',
                label_color: '',
                icon: '',
                text: '',
                order: '',
                main: true,
                isLoading: false
            }
        }
    },
    validations() {
        const main = this.form.main;
        console.log(main);
        
        return {form:{
                                    order: {
                                        required,
                                        numeric,
                                        minLength: minLength(1)
                                    },
                                    text: {
                                        required
                                    },
                                    icon: {
                                        required
                                    },
                                    module_id:{
                                        validate_select: must_be_select(main)
                                    },
                                    method_id:{
                                        validate_select_one: must_be_select(main)
                                    }
                    }               
                 }        
    },
    methods: {
        onSubmit(){
            if(!this.$v.$invalid){
                let form = this.form;
                const user = {
                    module: {
                        method_id: form.method_id.id === 0 ? null : form.method_id.id,         
                        module_id: form.module_id.id === 0 ? null : form.module_id.id,
                        label: form.label,
                        label_color: form.label_color,
                        icon: form.icon,
                        text: form.text,
                        order: form.order,
                        main: form.main,
                    }
                }                   
                form.isLoading = true;
                axios.post(this.route, user)
                     .then((response)=> {
                         console.log(response);
                         let answer = response.data;
                         let typeMsg = '';
                         form.isLoading = false;                         
                         if(answer.success && !answer.error && !answer.warning){
                             typeMsg = 'success';
                         }else if(answer.success && !answer.error && answer.warning){
                             typeMsg = 'warning';
                         }else{
                             typeMsg = 'error';
                             if(typeof answer != 'object'){
                                 answer = {title: 'Error', body: 'Ha ocurrido un error al momento de crear el modulo'}
                             }
                         }    
                         swal(
                                 answer.title,
                                 answer.body,
                                 typeMsg
                             )                                            
                     })
                     .catch((error) => {
                         form.isLoading = false;
                         console.log(error);  
                     });          
            }            
        }
    },
}
</script>
