
$(() => {
    $(document.getElementsByClassName('input-daterange')).datepicker({
        todayBtn: 'linked',
        format: "yyyy-mm-dd",
        autoclose: true,
    });

    $(document.getElementById('search')).click(() => {
        var start = $(document.getElementById('start')).val();
        var end = $(document.getElementById('end')).val();
        if (start != '' && end != '') {
            LoadDate(id);
        } else {
            alert("Tanggal keduanya harus di isi!");
        }
    });

});

const LoadData = (_id, _id2, id3) => {
    var kar = $(this).data('id_karyawan');
    var d = new Date();
    d.setDate(1);
    var month = '' + (d.getMonth() + 1);
    var month2 = '' + (d.getMonth() + 1);
    var day = '' + d.getDate();
    var year = d.getFullYear();
    if (month.length < 2) month = '0' + month;
    if (month2.length < 2) month2 = '0' + month2;
    if (day.length < 2) day = '0' + day;
    var url = "rekap/ajax_list_modal/" + id3;
    $.ajax({
        url: url,
        type: "GET",
        data: {
            start: year + month + day,
            end: year + month2 + '31',
        },
        success: function (data) {
            $(document.getElementById('datakar')).html(data);
        },
        error: function (_jqXHR, _textStatus, _errorThrown) {
            alert('Error adding / update data');
        }
    });
};

// buat nambah data ketidakhadiran


const save = () => {
    var id = $(document.getElementById('id')).val();
    var id_khd = $(document.getElementById('id_khd')).val();
    var id2 = $(document.getElementById('id_karyawan')).val();
    var ket = $(document.getElementById('ket')).val();
    var id3 = $(document.getElementById('id3')).val();
    var url = "rekap/addkhd/";
    $.ajax({
        url: url,
        type: "GET",
        data: {
            tgl: id,
            id_khd: id_khd,
            id_karyawan: id2,
            ket: ket,
            id3: id3,
        },
        success: _data => {
            $(document.getElementById('sep')).modal("hide");
            LoadData(id, id2, id3);
            $(document.getElementsByClassName('modal-backdrop')).remove();
        },
        error: (_jqXHR, _textStatus, _errorThrown) => {
            alert('Akses ditolak!, silahkan hubungi admin');
        }
    });
};

function tutup() {
    $(document.getElementById('khd')).val("");
    $(document.getElementById('sep')).modal("hide");
    $(document.getElementsByClassName('modal-backdrop')).remove();
}

const reload_table_kar = () => {
    DatatableKar.ajax.reload(null, false); //reload datatable ajax
};
