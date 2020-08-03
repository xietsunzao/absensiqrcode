var save_method; //for save method string
var table;
$(document).ready(function () {
    table = $("#mytable")
        .addClass('nowrap')
        .dataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "responsive": true,
            "ajax": {
                "url": "rekap/ajax_list",
                "type": "POST"
            },
            "columnDefs": [
                { "targets": [-1], "className": 'dt-responsive', "orderable": false, },
            ],
        });
});

function LoadAjax(id) {

    var d = new Date();
    var d2 = new Date();
    d.setDate(1);
    var month = '' + (d.getMonth() + 1);
    var month2 = '' + (d.getMonth() + 1);
    var day = '' + d.getDate();
    var day2 = '' + d2.getDate();
    var year = d.getFullYear();
    if (month.length < 2) month = '0' + month;
    if (month2.length < 2) month2 = '0' + month2;
    if (day.length < 2) day = '0' + day;
    if (day2.length < 2) day2 = '0' + day2;
    var url = "rekap/ajax_list_modal/" + id + "/";
    $.ajax({
        url: url,
        type: "GET",
        async: true,
        data: {
            start: year + month + day,
            end: year + month2 + '31',
        },
        success: function (data) {
            $('#datakar').html(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error adding / update data');
        }
    });
}

function absen(id, id2) {
    $("#id").val(id);
    $("#id_karyawan").val(id2);
    $('#modalAbsen').modal("show");
    LoadAjax(id);
}

function loadLap(id) {
    var d = new Date();
    var d2 = new Date();
    d.setDate(1);
    var month = '' + (d.getMonth() + 1);
    var month2 = '' + (d.getMonth() + 1);
    var day = '' + d.getDate();
    var day2 = '' + d2.getDate();
    var year = d.getFullYear();
    if (month.length < 2) month = '0' + month;
    if (month2.length < 2) month2 = '0' + month2;
    if (day.length < 2) day = '0' + day;
    if (day2.length < 2) day2 = '0' + day2;
    var url = "rekap/ajax_list_laporan/" + id + "/";
    $.ajax({
        url: url,
        type: "GET",
        async: true,
        data: {
            start: year + month + day,
            end: year + month2 + '31',
        },
        success: function (data) {
            $('#dataLap').html(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error adding / update data');
        }
    });
}

const add_khd = (id, id2, id3) => {
    $(document.getElementById('id')).val(id);
    $(document.getElementById('id_karyawan')).val(id2);
    $(document.getElementById('id3')).val(id3);
    $(document.getElementById('sep')).modal("show");
};

function laporan(id) {
    $("#id").val(id);
    $('#ModalLaporan').modal("show");
    loadLap(id);
}

function reload_table() {
    table.ajax.reload(null, false); //reload datatable ajax
}
