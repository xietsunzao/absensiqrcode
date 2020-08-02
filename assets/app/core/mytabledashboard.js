$(document).ready(function () {
    $("#mytable")
        .addClass('nowrap')
        .dataTable({
            responsive: true,
            deferRender: true,
            scrollY: 200,
            scrollCollapse: true,
            scroller: true,
            columnDefs: [
                { targets: [-1, -4], className: 'dt-responsive' }
            ]
        });

    $("#mytable2")
        .addClass('nowrap')
        .dataTable({
            responsive: true,
            deferRender: true,
            scrollY: 200,
            scrollCollapse: true,
            scroller: true,
            columnDefs: [
                { targets: [-1, -4], className: 'dt-responsive' }
            ]
        });
});
