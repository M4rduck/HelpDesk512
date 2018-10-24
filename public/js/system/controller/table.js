$('#controller-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: '/general/controller/getData',
    columns: [
        {data: 'name'},
        {data: 'containerName'},
        {data: 'prefix'},
        {data: 'status'},
        {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
});