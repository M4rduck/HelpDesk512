var hosting = '/HelpDesk512/public';
$('#method-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: hosting+'/general/method/getData',
    columns: [
        {data: 'Controlador', name: 'name'},
        {data: 'name_function', name: 'name_function'},
        {data: 'url', name: 'url'},
        {data: 'verbName', name: 'verbName'},
        {data: 'name', name: 'controller.name'},
        {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
});