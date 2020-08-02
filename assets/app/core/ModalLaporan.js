$(function(){
    $('.input-daterange').datepicker({
        todayBtn:'linked',
        format: "yyyy-mm-dd",
        autoclose: true,
    });

    $('#search').click(function(){
        var start = $('#start').val();
        var end = $('#end').val();
        if(start != '' && end !='') {
            LoadDateL();
        } else {
            alert("Tanggal keduanya harus di isi!");
        }
    });

    function reload_table_kar() {
        DatatableKar.ajax.reload(null,false); //reload datatable ajax
    }
});

function closeModal(){
    $('#modal_form_kar').modal('hide');
}

function tutup() {
    $('#modalLap').modal('hide');
    reload_table();
}

function reload_table_kar() {
    DatatableKar.ajax.reload(null,false); //reload datatable ajax
}

$("#hide").click(function(){
    $(".hiden").addClass("hide");
});

$("#show").click(function(){
    $(".hiden").removeClass("hide");
});

function tutupModal() {
    $("#modalLap").modal("hide");
}
