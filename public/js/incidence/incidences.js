$(function(){

    var form_incidence = {

        element: document.getElementById('form_incidence'),
        
        init: function(){

            this.method = this.element.method;
            //this.action = this.element.action;
            this.enctype = this.element.enctype;
            this.$agent = $(this.element.elements['agent']);
            this.$contact = $(this.element.elements['contact']);
            this.theme = this.element.elements['theme'];
            this.description = this.element.elements['description'];
            this.evidence = new File([''], '');
            this.$label = $(this.element.elements['label']);
            this.state = this.element.elements['state'];
            this.priority = this.element.elements['priority'];

            this.render();

        },

        render: function(){

            this.$agent.select2();
            this.$contact.select2();
            this.$label.select2({
                tags: true
            });

        }

    };

    var table_incidences = {

        init: function(){

            this.parent_element = document.getElementById('table_container');
            this.element = document.getElementById('incidences_table');
            this.solicitudes_route = document.getElementById('incidences_route').value;
            this.datatable = null;
            this.render();

        },

        update: function(){

            var data = null;
            var self = this;
            
            $.getJSON({
                url: this.solicitudes_route,
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

            if(initial_incidences){

                self.datatable = $(self.element).DataTable({
                    columns: [
                        {data: 'id'},
                        {data: 'theme'},
                        {data: 'description'},
                        {data: 'id_incidence_state'},
                        {data: 'agent.name'},
                        {
                            data: null,
                            defaultContent: '<a href="#">jojo</a>'
                        }
                        
                    ],
                    data: initial_incidences
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
   
    };

    form_incidence.init();
    table_incidences.init();

});