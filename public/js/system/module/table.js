const host = '/HelpDesk512/public';
const template = Handlebars.compile($("#details-template").html());
const host = '/HelpDesk512/public';
const table = $('#module-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: host+'/general/module/getData',
                columns: [
                    {
                        orderable:      false,
                        searchable:     false,
                        data:           function (data) {
                            return data.modules.length === 0 ? null : '<button class="btn btn-success details-control">+</button>';
                        }
                    },
                    {data: 'text', name: 'text'},
                    {data: 'icon', name: 'icon'},
                    {data: 'metodo', name: 'method.name'},
                    {data: 'modulo', name: 'module.text'},
                    {data: 'icon_color', name: 'icon_color'},
                    {data: 'label', name: 'label'},
                    {data: 'label_color', name: 'label_color'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });

$('#module-table tbody').on('click', 'td .details-control', function () {
    const tr = $(this).closest('tr');
    const row = table.row( tr );

    if ( row.child.isShown() ) {
        row.child.hide();
        tr.removeClass('shown');
    }
    else {
        row.child( template(row.data()) ).show();
        tr.addClass('shown');
    }
});
