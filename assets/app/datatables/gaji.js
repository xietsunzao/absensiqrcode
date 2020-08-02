let table;


$(document).ready(function () {
    table = $("#gaji").addClass('nowrap').DataTable({
        initComplete: function () {
            let api = this.api();
            $('#presensi_filter input')
                .off('.DT')
                .on('keyup.DT', function (e) {
                    api.search(this.value).draw();
                });
        },
        responsive: true,
        processing: true,
        serverSide: true,
        colReorder: true,
        oLanguage: {
            sProcessing: "loading..."
        },
        lengthMenu: [
            [10, 25, 50, -1],
            ['10', '25', '50', 'Show all']
        ],
        "order": [[0, 'asc']],
        ajax: {
            "url": base_url + "gaji/data/" + segment,
            "type": "POST",
        },
        columns:
            [
                { 'data': 'id_gj', defaultContent: '' },
                { "data": "nama_karyawan" },
                { "data": "nama_jabatan" },
                { "data": "nama_gedung" },
                { "data": "nominal" },
                {
                    "data": "tgl",
                    "render": function (data) {
                        var date = new Date(data);
                        var tanggal = date.getMonth(data);
                        let months = new Array(data);
                        months[0] = "Januari";
                        months[1] = "Februari";
                        months[2] = "Maret";
                        months[3] = "April";
                        months[4] = "Mei";
                        months[5] = "Juni";
                        months[6] = "Juli";
                        months[7] = "Agustus";
                        months[8] = "September";
                        months[9] = "Oktober";
                        months[10] = "November";
                        months[11] = "Desember";
                        console.log(months[tanggal]);
                        let month = date.getMonth() + 1;
                        return months[tanggal] + " " + date.getFullYear();
                    }
                },
                { "data": "total_khd" },
                { "data": "id_sg" },
                { "data": null },
            ],
        "columnDefs": [
            {
                "data": {
                    "id_gj": "id_gj",
                    "sts_gj": "sts_gj",
                    "total_khd": "total_khd",
                },
                "targets": 8,
                "orderable": false,
                "searchable": false,
                "render": function (data, type, row, meta) {
                    if (data.total_khd <= 10) {
                        return `
                        <a href="${base_url}gaji/detail/${data.id_gj}" title="detail" class="btn btn-md btn-info btn3d btn-view-data">
                        <i class="fa fa-eye"></i> Lihat
                        </a>
                        <a href="${base_url}gaji/proses/${data.id_gj}" title="detail" class="btn btn-md btn-default btn3d disabled btn-create-data">
                        <i class="fa fa-check"></i> Konfirmasi
                        </a>
                        <a href="${base_url}gaji/delete/${data.id_gj}" title="hapus" class="btn btn-md btn-danger btn3d btn-remove-data">
                        <i class="fa fa-trash"></i> Hapus
                        </a>`;
                    }
                    else {
                        if (data.sts_gj == 1) {
                            return `
                            <a href="${base_url}gaji/detail/${data.id_gj}" title="detail" class="btn btn-md btn-info btn3d btn-view-data">
                            <i class="fa fa-eye"></i> Lihat
                            </a>
                            <a href="${base_url}gaji/proses/${data.id_gj}" title="detail" class="btn btn-md btn-success btn3d btn-create-data">
                            <i class="fa fa-check"></i> Konfirmasi
                            </a>
                            <a href="${base_url}gaji/delete/${data.id_gj}" title="hapus" class="btn btn-md btn-danger btn3d btn-remove-data">
                            <i class="fa fa-trash"></i> Hapus
                            </a>`;
                        }
                        else if (data.sts_gj == 2) {
                            return `
                            <a href="${base_url}gaji/detail/${data.id_gj}" title="detail" class="btn btn-md btn-info btn3d btn-view-data">
                            <i class="fa fa-eye"></i> Lihat
                            </a>
                            <a href="${base_url}gaji/read/${segment}#" title="detail" class="btn btn-md btn-primary btn3d btn-view-data" onclick="gaji(${data.id_gj})">
                            <i class="fa fa-print"></i> Cetak Slip 
                            </a>
                            <a href="${base_url}gaji/delete/${data.id_gj}" title="hapus" class="btn btn-md btn-danger btn3d btn-remove-data">
                            <i class="fa fa-trash"></i> Hapus
                            </a>`;
                        }
                    }
                }
            },
        ],
        "createdRow": function (row, data, index) {
            if (data.id_sg == 1) {
                $('td', row).eq(7).html('<span class="label label-warning">' + data.nama_sg + '</span>');
            }
            else {
                $('td', row).eq(7).html('<span class="label label-success">' + data.nama_sg + '</span>');
            }
        },
        dom: 'Blfrtip',
        buttons: [
            'colvis',
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 7],
                },
            },
            {
                extend: 'excel',
                title: 'DATA GAJI ANGGOTA ' + gedung,
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 7],
                },
            },
            {
                extend: 'copy',
                title: 'DATA GAJI ANGGOTA ' + gedung,
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 7],
                },
            },
            {
                extend: 'pdf',
                oriented: 'portrait',
                pageSize: 'legal',
                title: 'DATA GAJI ANGGOTA ' + gedung,
                download: 'open',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 7],
                },
                customize: function (doc) {
                    doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                    doc.styles.tableBodyEven.alignment = 'center';
                    doc.styles.tableBodyOdd.alignment = 'center';
                },
            },
            {
                extend: 'print',
                oriented: 'portrait',
                pageSize: 'A4',
                title: 'DATA GAJI ANGGOTA ' + gedung,
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 7],
                },
            },
        ],
        initComplete: function () {
            var $buttons = $('.dt-buttons').hide();
            $('#exportLink').on('change', function () {
                var btnClass = $(this).find(":selected")[0].id
                    ? '.buttons-' + $(this).find(":selected")[0].id
                    : null;
                if (btnClass) $buttons.find(btnClass).click();
            })
        },
        rowId: function (a) {
            return a;
        },
        rowCallback: function (row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
        },
    });
    table.on('order.dt search.dt', function () {
        table.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
            table.cell(cell).invalidate('dom');
        });
    }).draw();
});