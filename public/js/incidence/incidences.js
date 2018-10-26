$(function(){

    var form_incidence = {

        element: document.getElementById('form_incidence'),

        set_form_values: function(){

            this.$agent.val("").trigger('change');
            this.$contact.val("").trigger('change');
            this.theme.value = "";
            this.description.value = "";
            document.getElementById('evidence').value = "";
            console.log("set_form_values", this.$label.val());
            this.$label.val([]).trigger('change');
            this.state.value = 4;
            this.priority.value = "";

        },
        
        init: function(){

            this.method = this.element.method;
            this.action = this.element.action;
            this.enctype = this.element.enctype;
            this.$agent = $(this.element.elements['agent']);
            this.$contact = $(this.element.elements['contact']);
            this.theme = this.element.elements['theme'];
            this.description = this.element.elements['description'];
            this.evidence = new File([''], '');
            this.$label = $(this.element.elements['label']);
            this.state = this.element.elements['state'];
            this.priority = this.element.elements['priority'];

            this.btn_submit = document.getElementById('btn_submit');
            this.id_solicitude = document.getElementById('solicitude_id');

            this.$parsley_form = $(this.element).parsley({
                
                errorClass: 'has-error',
                successClass: '',
                classHandler: function (ParsleyField) {
                    return ParsleyField.$element.parents('.form-group');
                },
                errorsContainer: function (ParsleyField) {
                    return ParsleyField.$element.parents('.form-group');
                },
                errorsWrapper: '<span class="help-block">',
                errorTemplate: '<div></div>'

            });

            this.render();

        },

        render: function(){

            let _this = this;

            this.$agent.select2({
                placeholder: 'Seleccione un agente',
                allowClear: true
            });
            this.$contact.select2({
                placeholder: 'Seleccione un contacto',
                allowClear: true
            });
            this.$label.select2({
                tags: true
            });

            this.element.elements['evidence'].addEventListener('change', function(){
                console.log(this);
                _this.evidence = this.files[0];
                console.log('nueva_evidencia', _this.evidence);
            });

            this.element.addEventListener('submit', function(e){
                
                e.preventDefault();

                console.log(_this, _this.$parsley_form);

                if(_this.$parsley_form.validate()){

                    var form_data = new FormData();
                    form_data.append('contact', _this.$contact.val());
                    form_data.append('id_solicitude', _this.id_solicitude.value);
                    form_data.append('theme', _this.theme.value);
                    form_data.append('description', _this.description.value);
                    form_data.append('incidence_evidence', _this.evidence);
                    form_data.append('labels', _this.$label.val());
                    form_data.append('agent', _this.$agent.val());
                    form_data.append('incidence_state', _this.state.value);
                    form_data.append('priority', _this.priority.value);

                    for (var value of form_data.values()) {
                        console.log(value); 
                    }

                    _this.btn_submit.innerHTML = "Cargando&nbsp;&nbsp;<i class='fa fa-spinner fa-spin'></i>";

                    $.ajax({

                        processData: false,
                        contentType: false,
                        cache: false,
                        url: _this.action,
                        data: form_data,
                        method: _this.method,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response){
                            console.log('success', response);
                            if(response.estado){

                                _this.set_form_values();
        
                                swal(
                                    'Exito',
                                    response.mensaje,
                                    'success'
                                );
                                
                                /*
                                table_solicitudes.datatable.destroy();
                                table_solicitudes.render();
                                */
                                table_incidences.update();
        
                            }
                        },
                        complete: function(response){
                            console.log('complete', response);
                            _this.btn_submit.innerHTML = "Guardar";
                        },
                        error: function(response){
                            console.log('error', response.responseText);
                        }

                    });
                }

            });

            $('#incidence_create_modal').on('hidden.bs.modal', function(){
                
                _this.$parsley_form.reset();
                _this.set_form_values();

            });

        }

    };

    var table_incidences = {

        init: function(){

            this.parent_element = document.getElementById('table_container');
            this.element = document.getElementById('incidences_table');
            this.incidences_route = document.getElementById('incidences_route').value;
            this.show_incidence_route = document.getElementById('show_incidence_route') ? document.getElementById('show_incidence_route').value : "";
            this.show_diagnosis_route = document.getElementById('show_diagnosis_route') ? document.getElementById('show_diagnosis_route').value : "";
            this.datatable = null;
            this.render();

        },

        update: function(){

            var data = null;
            var self = this;
            
            $.getJSON({
                url: this.incidences_route,
                success: function(response){
                    console.log(response);
                    data = response;
                },
                complete: function(){
                    self.datatable.clear();
                    self.datatable.rows.add(data);
                    self.datatable.draw();
                }
            });

        },

        render: function(){

            var data = null;
            var self = this;

            if(typeof initial_incidences !== 'undefined' && Array.isArray(initial_incidences)){

                self.datatable = $(self.element).DataTable({
                    columns: [
                        {data: 'id'},
                        {
                            data: 'theme',
                            visible: false
                        },
                        {data: 'description'},
                        {data: 'incidence_state.name'},
                        {data: 'agent.name'},
                        {
                            data: null,
                            //defaultContent: '<a class="btn btn-default btn-block" href=""><i class="fa fa-bars" aria-hidden="true"></i></a>',
                            render: function(data, type, row){
                                console.log('datatable', row);
                                return `<a class="btn btn-default btn-block" title="Dar Diagnostico" href="${self.show_diagnosis_route}/${row.id}"><i class="fa fa-file-text-o" aria-hidden="true"></i></a>
                                        <a class="btn btn-default btn-block" href="${self.show_incidence_route}/${row.id}"><i class="fa fa-bars" aria-hidden="true"></i></a>`;
                            }
                        }
                        
                    ],
                    data: initial_incidences
                });

            }
            //console.log(self.datatable);
        }
    };

    var options_group = {

        init: function(){

            this.btn_delete = document.getElementById('btn_delete');
            this.btn_edit = document.getElementById('btn_edit');
            this.btn_guardar = document.getElementById('btn_guardar');
            this.select_area = document.getElementById('area');
            this.select_encuesta = document.getElementById('encuesta');
            this.$select_categorias = $('#categories');
            this.descripcion = document.getElementById('solicitude_description')

            this.render();

        },

        render: function(){

            console.log(this.select_area, this.btn_delete);

            this.$select_categorias.select2();

            if(this.btn_guardar !== null){

                _this = this;

                this.btn_guardar.onclick = function(){

                    $.post({
                        url: document.getElementById('update_solicitude_route').value,
                        data: {
                            area: _this.select_area.value,
                            encuesta: _this.select_encuesta.value,
                            categorias: _this.$select_categorias.val(),
                            descripcion: _this.descripcion.value
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            console.log(response);

                            swal(
                                'Exito',
                                "Los cambios se han aplicado con exito",
                                'success'
                            );

                        },
                        error: function(response) {
                            console.log('error', response);
                        }
                    });

                }

            }

            /*

            this.select_area.onchange = function(){

                _this = this;

                $.post({
                    url: document.getElementById('update_solicitude_route').value,
                    data: {
                        value: _this.value,
                        column: 'area'
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });

            };

            this.select_encuesta.onchange = function(){

                _this = this;

                $.post({
                    url: document.getElementById('update_solicitude_route').value,
                    data: {
                        value: _this.value,
                        column: 'default_poll'
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(response) {
                        console.log('error', response);
                    }
                });

            };

            this.$select_categorias.on('change', function(){

                _this = $(this);

                $.post({
                    url: document.getElementById('update_solicitude_route').value,
                    data: {
                        value: _this.val(),
                        column: 'categories'
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(response) {
                        console.log('error', response);
                    }
                });

            });

            */
            
            if(this.btn_delete !== null){

                this.btn_delete.onclick = function(e){

                    e.preventDefault();
    
                    _this = this;
                    
                    swal({
                        title: '¿Esta seguro de eliminar esta solicitud?',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'SI',
                        cancelButtonText: 'NO',
                        
                    }).then(function(isConfirm){
                        
                        if(isConfirm.value){
    
                            //return;
    
                            $.ajax({
    
                                url: _this.href,
                                type: 'DELETE',
                                data: {
                                    _method: 'delete',
                                    _token: $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response){
                                    window.location = 'http://www.helpdesk.local/incidence/solicitudes';
                                },
                                error: function(response){
                                    console.log(response);
                                }
            
                            });
    
                        }
    
                    });
    
                };

            }

        }

    };

    form_incidence.init();
    table_incidences.init();
    options_group.init();

});