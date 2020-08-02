
const USER_CAN_CREATE = $('meta[name="can-create"]').length > 0 ? $('meta[name="can-create"]').attr('content') : 0;
const USER_CAN_UPDATE = $('meta[name="can-update"]').length > 0 ? $('meta[name="can-update"]').attr('content') : 0;
const USER_CAN_VIEW = $('meta[name="can-view"]').length > 0 ? $('meta[name="can-view"]').attr('content') : 0;
const USER_CAN_DELETE = $('meta[name="can-delete"]').length > 0 ? $('meta[name="can-delete"]').attr('content') : 0;
// moment.locale($("html").attr("lang"));


jQuery.browser = {};
(function () {
    jQuery.browser.msie = false;
    jQuery.browser.version = 0;
    if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
        jQuery.browser.msie = true;
        jQuery.browser.version = RegExp.$1;
    }
})();

function getFormattedDate(date) {
    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear().toString().slice(2);
    return day + '-' + month + '-' + year;
}

var randomColor = function(){
    return '#'+(Math.random()*0xFFFFFF<<0).toString(16);
}

var browser = function () {
    var ua = navigator.userAgent,
    tem, M = ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || [];
    if (/trident/i.test(M[1])) {
        tem = /\brv[ :]+(\d+)/g.exec(ua) || [];
        return {
            name: 'IE',
            version: (tem[1] || '')
        };
    }
    if (M[1] === 'Chrome') {
        tem = ua.match(/\bOPR|Edge\/(\d+)/)
        if (tem != null) {
            return {
                name: 'Opera',
                version: tem[1]
            };
        }
    }
    M = M[2] ? [M[1], M[2]] : [navigator.appName, navigator.appVersion, '-?'];
    if ((tem = ua.match(/version\/(\d+)/i)) != null) {
        M.splice(1, 1, tem[1]);
    }
    return {
        name: M[0],
        version: M[1]
    };
}

var jsonToString = function (data) {
    var encoded = JSON.stringify(data);
    encoded = encoded.replace(/\\"/g, '"')
    .replace(/([\{|:|,])(?:[\s]*)(")/g, "$1'")
    .replace(/(?:[\s]*)(?:")([\}|,|:])/g, "'$1")
    .replace(/([^\{|:|,])(?:')([^\}|,|:])/g, "$1\\'$2");
    return encoded;
};

var stringToJson = function (input) {
    var result = [];

    //replace leading and trailing [], if present
    input = input.replace(/^\[/, '');
    input = input.replace(/\]$/, '');

    //change the delimiter to
    input = input.replace(/},{/g, '};;;{');

    // preserve newlines, etc - use valid JSON
    //https://stackoverflow.com/questions/14432165/uncaught-syntaxerror-unexpected-token-with-json-parse
    input = input.replace(/\\n/g, "\\n")
    .replace(/\\'/g, "\\'")
    .replace(/\\"/g, '\\"')
    .replace(/\\&/g, "\\&")
    .replace(/\\r/g, "\\r")
    .replace(/\\t/g, "\\t")
    .replace(/\\b/g, "\\b")
    .replace(/\\f/g, "\\f");
    // remove non-printable and other non-valid JSON chars
    input = input.replace(/[\u0000-\u0019]+/g, "");

    input = input.split(';;;');

    input.forEach(function (element) {
        // console.log(JSON.stringify(element));

        result.push(JSON.parse(element));
    }, this);

    return result;
}

var getRandomInt = function (min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

var arrayDistinct = function (arr) {
    let unique_array = []
    for (let i = 0; i < arr.length; i++) {
        if (unique_array.indexOf(arr[i]) == -1) {
            unique_array.push(arr[i])
        }
    }
    return unique_array
}

var timeStamp = function () {
    var timeStampInMs = window.performance && window.performance.now && window.performance.timing && window.performance.timing.navigationStart ? window.performance.now() + window.performance.timing.navigationStart : Date.now();
    return Math.floor(timeStampInMs);
}

var labelStatus = function (val) {
    if (parseInt(val) == 1) {
        return '<span class="label label-success">Aktif</span>';
    } else {
        return '<span class="label label-danger">Tidak Aktif</span>';
    }
}

var fileSizeInfo = function (bytes, si) {
    var thresh = si ? 1000 : 1024;
    if (Math.abs(bytes) < thresh) {
        return bytes + ' B';
    }
    var units = si ? ['kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'] : ['KiB', 'MiB', 'GiB', 'TiB', 'PiB', 'EiB', 'ZiB', 'YiB'];
    var u = -1;
    do {
        bytes /= thresh;
        ++u;
    } while (Math.abs(bytes) >= thresh && u < units.length - 1);
    return bytes.toFixed(1) + ' ' + units[u];
}

var headerRequest = function () {
    $.ajaxSetup({
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'Authorization': API_TOKEN,
        }
    });
}

var appDataTable = {
    "render": function (option) {
        var columnLength = option.column.length - 1;
        $(option.table).DataTable({
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "sAjaxSource": BASE_URL + "api/" + option.route + "/datatable",
            "fnServerData": function (sSource, aoData, fnCallback) {
                aoData.push({
                    name: CSRF_NAME,
                    value: CSRF_VALUE
                });
                headerRequest();
                $.ajax({
                    'dataType': 'json',
                    'type': option.request || "GET",
                    'url': sSource,
                    'data': aoData,
                    'success': fnCallback
                });
            },
            "columns": option.column,
            "order": option.order || [[columnLength, "desc"]],
            "rowCallback": option.rowCallback,
            "language": {
                "sEmptyTable": "Tidak ada data yang tersedia pada tabel ini",
                "sProcessing": "Sedang memproses...",
                "sLengthMenu": "Tampilkan _MENU_ entri",
                "sZeroRecords": "Tidak ditemukan data yang sesuai",
                "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                "sInfoPostFix": "",
                "sSearch": "Cari:",
                "sUrl": "",
                "oPaginate": {
                    "sFirst": "Pertama",
                    "sPrevious": "Sebelumnya",
                    "sNext": "Selanjutnya",
                    "sLast": "Terakhir"
                }
            }
        });

        $('.dataTables_length select').select2({
            minimumResultsForSearch: Infinity
        });

        $("body").on("click", ".btn-remove", function (e) {
            e.preventDefault();
            var targetUrl = $(this).attr("href");
            var id = $(this).attr("data-id");
            var message = 'Apakan anda yakin akan menghapus data ini ?'
            var notif = "Data berhasil dihapus !";
            swal({
                title: "Konfirmasi Hapus",
                text: message,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#f8b32d",
                confirmButtonText: "Ya",
                cancelButtonText: "Tidak",
                closeOnConfirm: false,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    var postData = {};
                    headerRequest();
                    postData["id"] = id;
                    postData[CSRF_NAME] = CSRF_VALUE;
                    $.post(targetUrl, postData, function (result) {
                        swal({
                            title: "Proses Sukses !",
                            text:  notif,
                            type: "success"
                        },
                        function () {
                            location.reload();
                        }
                    );
                });
            }
        });
        return false;
    });

    $("body").on("click", ".btn-remove-data", function (e) {
        e.preventDefault();
        var targetUrl = $(this).attr("href");
        var message = 'Apakan anda yakin akan menghapus data ini ?'
        swal({
            title: "Konfirmasi Hapus",
            text: message,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#f8b32d",
            confirmButtonText: "Ya",
            cancelButtonText: "Tidak",
            closeOnConfirm: false,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm) {
                window.location.href = targetUrl;
            }
        });
        return false;
    });

},
"action": function (option) {
    var edit = "<a href='" + BASE_URL + "" + option.area + "/" + option.route + "/edit/" + option.id + "' class='btn btn-sm btn-warning btn-edit'><i class='fa fa-edit'></i>&nbsp;Edit</a>";
    var detail = "<a href='" + BASE_URL + "" + option.area + "/" + option.route + "/show/" + option.id + "' class='btn btn-sm btn-success btn-detail'><i class='fa fa-search'></i>&nbsp;Lihat</a>";
    var deleted = "<a href='" + BASE_URL + "api/" + option.route + "/delete' data-id='" + option.id + "'  class='btn btn-sm btn-danger btn-remove'><i class='fa fa-trash'></i>&nbsp;Hapus</a>";


    if (parseInt(USER_CAN_VIEW) == 0) {
        detail = "";
    }

    if (parseInt(USER_CAN_DELETE) == 0) {
        deleted = "";
    }

    if (parseInt(USER_CAN_UPDATE) == 0) {
        edit = "";
    }

    return edit + " " + detail + " " + deleted;
}
};



$(document).ready(function () {

    var url = window.location;
    // Will only work if string in href matches with location
    $('.treeview-menu li a[href="' + url + '"]').parent().addClass('active');
    // Will also work for relative and absolute hrefs
    $('.treeview-menu li a').filter(function () {
        return this.href == url;
    }).parent().parent().parent().addClass('active');

    $('[data-toggle="tooltip"]').tooltip();

    if ($(".select2").length > 0) {
        $(".select2").select2();
    }

    if ($(".iradio").length) {
        $('input[type="radio"].iradio').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });
    }

    if ($(".icheck").length) {
        $('input[type="checkbox"].icheck').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });
    }

    if ($(".input-datepicker").length) {
        $(".input-datepicker").datepicker({
            autoclose: true,
            clearBtn: true,
            format: 'yyyy-mm-dd',
            language: "id"
        });
    }

    if ($(".datetime-picker").length) {
        $('.datetime-picker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            locale: "id"
        });
    }

    if ($(".file-input-image").length) {
        $(".file-input-image").fileinput({
            showUpload: false,
            allowedFileExtensions: ["jpg", "png", "gif"],
            maxFileCount: 1,
        });
    }

    if (parseInt(USER_CAN_CREATE) == 0) {
        $(".btn-create-data").hide();
    }

    if (parseInt(USER_CAN_VIEW) == 0) {
        $(".btn-detail").hide();
    }

    if (parseInt(USER_CAN_DELETE) == 0) {
        $(".btn-remove-data").hide();
    }

    if (parseInt(USER_CAN_UPDATE) == 0) {
        $(".btn-edit-data").hide();
    }

    if ($(".table-transaction").length) {
        $(".table-transaction").slimScroll();
    }

});
