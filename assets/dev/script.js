var idioma=

            {
                "sProcessing":     "Processing...",
                "sLengthMenu":     "Show _MENU_ records",
                "sZeroRecords":    "No results found",
                "sEmptyTable":     "No data available in this table",
                "sInfo":           "Showing records from _START_ to _END_ out of a total of _TOTAL_ records",
                "sInfoEmpty":      "Showing records from 0 to 0 out of a total of 0 records",
                "sInfoFiltered":   "(filtered from a total of _MAX_ records)",
                "sInfoPostFix":    "",
                "sSearch":         "Search:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Loading...",
                "oPaginate": {
                    "sFirst":    "First",
                    "sLast":     "Last",
                    "sNext":     "Next",
                    "sPrevious": "Previous"
                },
                "oAria": {
                    "sSortAscending":  ": Activate to sort the column ascending",
                    "sSortDescending": ": Activate to sort the column descending"
                },
                "buttons": {
                    "copyTitle": 'Information copied',
                    "copyKeys": 'Use your keyboard or menu to select the copy command',
                    "copySuccess": {
                        "_": '%d rows copied to clipboard',
                        "1": '1 row copied to clipboard'
                    },
            
                    "pageLength": {
                        "_": "Show %d rows",
                        "-1": "Show All"
                    }
                }
            };

$(document).ready(function() {
  
  
  var table = $('#ejemplo').DataTable( {
    
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": true,
    "language": idioma,
    "lengthMenu": [[10,20,50, -1],[10,20,50,"Show All"]],
    dom: 'Bfrt<"col-md-6 inline"i> <"col-md-6 inline"p>',
    
    
    buttons: {
          dom: {
            container:{
              tag:'div',
              className:'flexcontent'
            },
            buttonLiner: {
              tag: null
            }
          },
          
          
          
          
          buttons: [


                    // {
                    //     extend:    'copyHtml5',
                    //     text:      '<i class="fa fa-clipboard"></i>Copiar',
                    //     title:'Titulo de tabla copiada',
                    //     titleAttr: 'Copiar',
                    //     className: 'btn btn-app export barras',
                    //     exportOptions: {
                    //         columns: [ 0, 1 ]
                    //     }
                    // },

                    {
                        extend:    'print',
                        text:      '<i class="fa fa-print"></i>Imprimir',
                        orientation: 'landscape',
                        title:'Historique des opérations Equipement',
                        titleAttr: 'Imprimir',
                        className: 'btn btn-app export imprimir',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                        }
                    },

                    
                    {
                        extend:    'pdfHtml5',
                        text:      '<i class="fa fa-file-pdf-o"></i>PDF',
                        orientation: 'landscape',
                        title:'Historique des opérations Equipement',
                        titleAttr: 'PDF',
                        className: 'btn btn-app export pdf',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                        },
                        customize:function(doc) {

                            doc.styles.title = {
                                color: '#4c8aa0',
                                fontSize: '20',
                                alignment: 'center'
                            }
                            doc.styles['td:nth-child(2)'] = { 
                                width: '100px',
                                'max-width': '100px',
                                whiteSpace: 'nowrap'
                            },
                            doc.styles.tableHeader = {
                                fillColor:'#4c8aa0',
                                color:'white',
                                alignment:'center',
                                whiteSpace: 'nowrap'
                            },
                            doc.content[1].margin = [ 100, 0, 100, 0 ]

                        }

                    },

                    {
                        extend:    'excelHtml5',
                        text:      '<i class="fa fa-file-excel-o"></i>Excel',
                        title:'Historique des opérations Equipement',
                        titleAttr: 'Excel',
                        className: 'btn btn-app export excel',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                        },
                    },

                    {
                        extend:    'pageLength',
                        titleAttr: 'Registros a mostrar',
                        className: 'selectTable'
                    }
                ]
          
          
        }
  
    });

  
} );