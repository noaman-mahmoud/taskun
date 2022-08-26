
    
  var dataListView = $('.data-list-view').DataTable( {
    dom: '<"top"<"actions action-btns"B><"action-filters"lf>><"clear">rt<"bottom"<"actions">p>',
    aLengthMenu: [[20, 50, 100], [20, 50, 100]],
    order: false,
    buttons: [
        {
            extend: 'copyHtml5',
            exportOptions: {
                columns: [ 0, ':visible' ]
            }
        },
        // {
        //     extend: 'pdfHtml5',
        //     exportOptions: {
        //         columns: ':visible'
        //     }
        // },
        {
            text: 'JSON',
            action: function ( e, dt, button, config ) {
                var data = dt.buttons.exportData();

                $.fn.dataTable.fileSave(
                    new Blob( [ JSON.stringify( data ) ] ),
                    'Export.json'
                );
            }
        },
        {
            extend: 'print',
            exportOptions: {
                columns: ':visible'
            }
        }
    ]
});


