$(function() {

    var form_solicitudes = {

        element: document.getElementById('form_solicitude'),

        set_form_values: function(){

            this.$area.val(null);
            this.title.value = null;
            this.description.value = null;
            this.evidence = new File([''], '');

        },

        get_areas_list: function(){

            var self = this;

            $.get({
                url: this.element.elements['temp_areas_route'].value,
                success: function(response){
                    response.forEach(function(element) {
                        console.log(element);
                        self.$area.append('<option value="'+ element.value +'">'+ element.label +'</option>');                    
                    });
                }
            });

        },

        init: function() {

            this.method = this.element.method;
            this.action = this.element.action;
            this.enctype = this.element.enctype;
            this.btn_submit = document.getElementById('btn_submit');
            //campos del formulario
            this.$area = $(this.element.elements['solicitude_area']);
            this.title = this.element.elements['solicitude_title'];
            this.description = this.element.elements['solicitude_description'];
            this.evidence = new File([''], '');//this.element.elements['solicitude_evidence'];
            //inicializar
            this.render();
        },

        render: function(){

            var self = this;

            this.get_areas_list();

            this.parsley_form = $(this.element).parsley({
                
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

            this.element.elements['solicitude_evidence'].addEventListener('change', function(){
                console.log(this);
                self.evidence = this.files[0];
            });
            
            this.element.addEventListener('submit', function(e){
                e.preventDefault();

                if(self.parsley_form.validate()){
                    
                    var form_data = new FormData();
                    form_data.append('area', self.$area.val());
                    form_data.append('title', self.title.value);
                    form_data.append('description', self.description.value);
                    form_data.append('evidence', self.evidence);

                    for (var value of form_data.values()) {
                        console.log(value); 
                    }

                    self.btn_submit.innerHTML = "<i class='fa fa-spinner fa-spin'></i>";
                    $.ajax({

                        processData: false,
                        contentType: false,
                        cache: false,
                        url: self.action,
                        data: form_data,
                        method: self.method,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response){
                            console.log('success', response);
                            if(response.estado){

                                self.set_form_values();
        
                                swal(
                                    'Exito',
                                    response.mensaje,
                                    'success'
                                );
                                
                                /*
                                table_solicitudes.datatable.destroy();
                                table_solicitudes.render();
                                */
                                table_solicitudes.update();
        
                            }
                        },
                        complete: function(response){
                            console.log('complete', response);
                            self.btn_submit.innerHTML = "Guardar";
                        },
                        error: function(response){
                            console.log('error', response.responseText);
                        }

                    });

                };
                console.log('form submit');
            });

            $('#solicitude_create_modal').on('hidden.bs.modal', function(){
                
                self.parsley_form.reset();
                self.set_form_values();

            });

        }
    }

    table_solicitudes = {

        init: function(){

            this.parent_element = document.getElementById('table_container');
            this.element = document.getElementById('solicitudes_table');
            this.solicitudes_route = document.getElementById('solicitudes_route').value;
            this.datatable = null;
            this.render();

        },

        update: function(){

        },

        render: function(){

            var data = null;
            var self = this;

            if(initial_solicitudes){

                self.datatable = $(self.element).DataTable({
                    columns: [
                        {data: 'id'},
                        {data: 'area'},
                        {data: 'title'},
                        {data: 'description'},
                        {data: 'details'}
                    ],
                    data: initial_solicitudes
                });

            }else{

                this.parent_element.style.display = 'none';

                $.getJSON({
                    url: this.solicitudes_route,
                    success: function(response){
                        console.log(response);
                        data = response;
                    },
                    complete: function(){
                        self.datatable = $(self.element).DataTable({
                            columns: [
                                {data: 'id'},
                                {data: 'area'},
                                {data: 'title'},
                                {data: 'description'},
                                {data: 'details'}
                            ],
                            data: data
                        });
                        self.parent_element.style.display = 'block';
                    }
                });

            }

            console.log(self.datatable);

        }
   
    }

    table_solicitudes.init();
    form_solicitudes.init();

});
