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

    form_incidence.init();

});