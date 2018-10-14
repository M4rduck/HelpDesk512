var host = '/HelpDesk512/public';
$('#enterprise-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: host+'/area-empresa/getEnterprises',
    columns: [
        {data: 'business_name', name: 'business_name'},
        {data: 'address', name: 'address'},
        {data: 'legal_representative', name: 'legal_representative'},
        {data: 'phones', name: 'phones.name'},
        {data: 'city', name: 'city.name'},
        {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
});