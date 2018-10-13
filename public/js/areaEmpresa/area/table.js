const host = '/HelpDesk512/public';
let id = $('#area-id').val();
$('#area-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: host+'/area-empresa/show/'+id,
    columns: [
        {data: 'Controlador', name: 'name'},
        {data: 'name_function', name: 'name_function'},
        {data: 'url', name: 'url'},
        {data: 'verbName', name: 'verbName'},
        {data: 'name', name: 'controller.name'},
        {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
});