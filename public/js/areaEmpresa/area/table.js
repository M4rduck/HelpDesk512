var hosting = '/HelpDesk512/public';
var idEmpresa = $('#area-id').val();
var areaTable = $('#area-table').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: hosting+'/area-empresa/getAreas/'+idEmpresa,
                        columns: [
                            {data: 'name', name: 'name'},
                            {data: 'extension', name: 'extension'},
                            {data: 'email', name: 'email'},
                            {data: 'description', name: 'description'},
                            {data: 'action', name: 'action', orderable: false, searchable: false}
                        ]
                    });