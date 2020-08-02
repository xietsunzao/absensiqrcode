const pindah = () => {
    $('#id').focus();
};

const ready = () => {
    var id = $('#id').val();
    var url = window.location;
    $.ajax({
        type: 'POST',
        url: url + '/showw',
        data: `id=${id}`,
        beforeSend: function () {
            $('#showR').html('<h1><i class="fa fa-spin fa-refresh" /></h1>');
        },
        success: msg => {
            $('#showR').html(msg);
            $('#id_karyawan').focus();
        }
    });
};
