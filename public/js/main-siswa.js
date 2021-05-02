$(document).ready(function() {

    data_detail_siswa();

    function data_detail_siswa(kategori = '') {
        var table = $('#infopoin').DataTable({
            ordering: false,
            scrollX: true,
            processing: true,
            searching: false,
            info: false,
            serverSide: false,
            pagingType: "full",
            dom: '<"top"if>rt<"bottom">"<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"p>>"',
            pageLength: 10,
            lengthMenu: [10, 20, 30, 50],
            language: {
                "lengthMenu": "Menampilkan _MENU_ data poin.",
                "zeroRecords": "Tidak terdapat data poin.",
                "infoEmpty": "Tidak ada data.",
                "loadingRecords": "Mohon tunggu...",
                "processing": "Mohon tunggu...",
                "paginate": {
                    "previous": "<",
                    "next": ">",
                    "last": "Terakhir",
                    "first": "Pertama"
                },
                "info": "Menampilkan _START_ hingga _END_ poin dari total _TOTAL_ poin.",
                "search": "Cari: ",
                "infoFiltered": "(Menampilkan hasil dari _MAX_ total poin)."
            },
            fixedHeader: {
                footer: true,
                header: false
            },
            ajax: {
                url: path_info_poin,
                data: {
                    kategori: kategori,
                    id: $('#id').val()
                }
            },
            order: [
                [1, 'asc']
            ],
            columns: [
                {
                    data: "",
                    defaultContent: "",
                    searchable: false,
                    orderable: false,
                    targets: 0
                },
                {
                    data: 'tanggal',
                    name: 'tanggal'
                },
                {
                    data: 'jenis_pelanggaran',
                    name: 'jenis_pelanggaran'
                },
                {
                    data: 'kategori',
                    name: 'kategori'
                },
                {
                    data: 'poin',
                    name: 'poin'
                }
            ],
            "footerCallback": function(row, data, start, end, display) {
                var api = this.api();

                var intVal = function(i) {
                        return typeof i === 'string' ?
                            i.replace(/[, Rs]|(\.\d{2})/g, '') * 1 :
                            typeof i === 'number' ?
                            i : 0;
                    }
             
                total = api.column(4, {search: 'applied'}).data().reduce( function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
  
                pageTotal = api.column(4, {page: 'current'}).data().reduce( function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
  
                $(api.column(4).footer()).html(
                    total
                );
            }        
        });

        table.on( 'draw.dt order.dt search.dt', function () {
            table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();
    };

    $('#kategori').change(function() {
        var kategori = $('#kategori').val();
        if (kategori != '') {
            $('#infopoin').DataTable().destroy();
            data_detail_siswa(kategori);
        }
    });

    $(".pw-baru").on('click',function() {
        var $pwd = $("#password_baru");
        if ($pwd.attr('type') === 'password') {
            $('#mata-baru').removeClass( "fa-eye" );
            $('#mata-baru').addClass( "fa-eye-slash" );
            $pwd.attr('type', 'text');
        } else {
            $('#mata-baru').removeClass( "fa-eye-slash" );
            $('#mata-baru').addClass( "fa-eye" );
            $pwd.attr('type', 'password');
        }
    });
      
    $(".pw-konfir").on('click',function() {
        var $pwd = $("#konfirmasi_password");
        if ($pwd.attr('type') === 'password') {
            $('#mata-konfir').removeClass( "fa-eye" );
            $('#mata-konfir').addClass( "fa-eye-slash" );
            $pwd.attr('type', 'text');
        } else {
            $('#mata-konfir').removeClass( "fa-eye-slash" );
            $('#mata-konfir').addClass( "fa-eye" );
            $pwd.attr('type', 'password');
        }
    });
});