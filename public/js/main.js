$(document).ready(function() {
    $("#edit").click(function() {
        if ($("#textarea").prop('disabled') == true && $("#simpan").prop('disabled') == true) {
            $("#textarea").prop('disabled', false);
            $("#simpan").prop('disabled', false);
            $("#edit").html("Cancel");
            $("#edit").removeClass("btn-warning");
            $(this).addClass("btn-secondary");
        } else if ($("#textarea").prop('disabled') == false && $("#simpan").prop('disabled') == false) {
            $("#textarea").prop('disabled', true);
            $("#simpan").prop('disabled', true);
            $("#edit").html("Edit");
            $("#edit").removeClass("btn-secondary");
            $(this).addClass("btn-warning");
        }
    });

    data_fillable();
    
    function data_fillable(kelas = '') {
        var table = $('#datatabel').DataTable({
            ordering: false,
            scrollX: true,
            processing: true,
            serverSide: false,
            pagingType: "full",
            pageLength: 20,
            lengthMenu: [20, 35, 70, 100, 200],
            language: {
                "lengthMenu": "Menampilkan _MENU_ data siswa.",
                "zeroRecords": "Tidak terdapat data siswa.",
                "infoEmpty": "Tidak ada data.",
                "loadingRecords": "Mohon tunggu...",
                "processing": "Mohon tunggu...",
                "paginate": {
                    "previous": "<",
                    "next": ">",
                    "last": "Terakhir",
                    "first": "Pertama"
                },
                "info": "Menampilkan _START_ hingga _END_ siswa dari total _TOTAL_ siswa.",
                "search": '<i class="fa fa-search" aria-hidden="true"></i>',
                "searchPlaceholder": 'Cari Siswa...',
                "infoFiltered": "(Menampilkan hasil dari _MAX_ total siswa)."
            },
            ajax: {
                url: path_home,
                data: {
                    kelas: kelas
                }
            },
            columns: [
                {
                    data: "",
                    defaultContent: "",
                    searchable: false,
                    orderable: false,
                    targets: 0
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'kelas',
                    name: 'kelas'
                },
                {
                    data: 'total_poin',
                    name: 'total_poin'
                },
                {
                    data: 'opsi',
                    name: 'opsi',
                    orderable: true,
                    searchable: true
                }
            ]
        });

        table.on( 'draw.dt order.dt search.dt', function () {
            table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();
    };

    $('.filter-select').change(function() {
        var kelas = $('#kelas').val();
        if (kelas != '') {
            $('#datatabel').DataTable().destroy();
            data_fillable(kelas);
        }
    });
    
    $('#tingkat').change(function(){
        if($('#tingkat').val() != 0){
            $("#kelas").prop('disabled', false);
            getKelas();
        }
        else if ($('#tingkat').val() == 0){
            $("#kelas").prop('disabled', true);
            $('#kelas').html('<option value="0">Pilih tingkat terlebih dahulu</option>');
            $('#datatabel').DataTable().destroy();
            data_fillable();
        };
    });

    function getKelas(){
        var tingkat = $('#tingkat').val();
        $.ajax({
            type: "GET",
            url: '/data_kelas/' + tingkat
        }).done(function(val){
            var option = [];
            $.each(val, function( key, value ) {
                option[key] = '<option value="'+ value['id'] +'">'+ value['tingkat'] + ' ' + value['kelas'] +'</option>';
            });
            $('#datatabel').DataTable().destroy();
            data_fillable(val[0]['id']);
            $('#kelas').html(option);
        });
    };

    $.fn.datepicker.dates['id'] = {
        days: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
        daysShort: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
        daysMin: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
        months: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
        monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
        today: 'Hari Ini',
        clear: 'Clear',
        format: 'yyyy-mm-dd',
        titleFormat: 'MM yyyy', /* Leverages same syntax as ‘format’ */
        weekStart: 0
    };

    $('.date').datepicker({
        autoclose: true,
        todayHighlight: true,
        locale: 'id',
        format: 'dd-mm-yyyy',
        endDate: '0d',
        language: 'id'
    });

    $('.date').datepicker("setDate", "today");

    $('.date_edit').datepicker({
        autoclose: true,
        todayHighlight: true,
        locale: 'id',
        format: 'dd-mm-yyyy',
        endDate: '0d',
        language: 'id'
    });

    $('.date_edit').datepicker("setDate", $('#tanggal_edit').val());

    data_detail();

    function data_detail(kategori = '') {
        var table = $('#tabeldetail').DataTable({
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
                url: path_detail,
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
                },
                {
                    data: 'id',
                    name: 'opsi',
                    render: function (id) {
                        return '<a href="/siswa/detail/edit_poin/'+id+'" class="btn btn-warning text-light edit" id="edit" value="'+ id +'"><i class="fas fa-pen" style="color: white;"></i></a> | '
                        + '<button type="button" class="btn btn-danger text-light hapus" id="'+ id +'" value="'+ id +'" data-toggle="modal" data-target="#myModal_hapus"><i class="fas fa-times" style="color: white;"></i></button>'
                    },
                    orderable: true,
                    searchable: true
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

    $(document).on('click', 'button.hapus', function(){
        $('a.submit_hapus').val($(this).val());
    });

    $(document).on('click', 'a.submit_hapus',function(){
        var val = $('a.submit_hapus').val();
        $("a#submit_hapus").attr("href", "/siswa/detail/hapus_poin/"+val);
     });
    
    $('#kategori').change(function() {
        var kategori = $('#kategori').val();
        if (kategori != '') {
            $('#tabeldetail').DataTable().destroy();
            data_detail(kategori);
        };
    });

    data_kelas();
    
    function data_kelas() {
        var table = $('#tabelkelas').DataTable({
            ordering: false,
            scrollX: true,
            processing: true,
            serverSide: false,
            pagingType: "full",
            pageLength: 10,
            lengthMenu: [10, 15, 20],
            language: {
                "lengthMenu": "Menampilkan _MENU_ data siswa.",
                "zeroRecords": "Tidak terdapat data siswa.",
                "infoEmpty": "Tidak ada data.",
                "loadingRecords": "Mohon tunggu...",
                "processing": "Mohon tunggu...",
                "paginate": {
                    "previous": "<",
                    "next": ">",
                    "last": "Terakhir",
                    "first": "Pertama"
                },
                "info": "Menampilkan _START_ hingga _END_ siswa dari total _TOTAL_ siswa.",
                "search": '<i class="fa fa-search" aria-hidden="true"></i>',
                "searchPlaceholder": 'Cari Siswa...',
                "infoFiltered": "(Menampilkan hasil dari _MAX_ total siswa)."
            },
            ajax: {
                url: path_kelas
            },
            columns: [
                {
                    data: "",
                    defaultContent: "",
                    searchable: false,
                    orderable: false,
                    targets: 0
                },
                {
                    data: 'jurusan',
                    name: 'jurusan',
                    className: "text-left"
                },
                {
                    data: 'angkatan',
                    name: 'angkatan'
                },
                {
                    data: 'status',
                    name: 'status',
                    // className: "bolded"
                },
                {
                    data: 'id',
                    name: 'opsi',
                    render: function (id) {
                        return '<button type="button" class="btn btn-primary text-light updatekelas" id="'+ id +'" value="'+ id +'" data-toggle="modal" data-target="#myModal_updatekelas"><i class="fas fa-arrow-up" style="color: white;"></i>  Naikkan</a>'
                    },
                    orderable: true,
                    searchable: true
                }
            ]
        });

        table.on( 'draw.dt order.dt search.dt', function () {
            table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();
    };

    $(document).on('click', 'button.updatekelas', function(){
        $('a.submit_updatekelas').val($(this).val());
    });

    $(document).on('click', 'a.submit_updatekelas',function(){
        var val = $('a.submit_updatekelas').val();
        $("a#submit_updatekelas").attr("href", "/update_kelas/proses_update/"+val);
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