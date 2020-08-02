$(document).ready(function () {


    $("#checked-all").change(function (e) {
        e.preventDefault();
        $('input:checkbox').not(this).not(":disabled").prop('checked', this.checked);
        return false;
    });

    $("#checked-view").change(function (e) {
        e.preventDefault();
        $('input:checkbox.view').not(this).prop('checked', this.checked).change();
        return false;
    });

    $("#checked-create").change(function (e) {
        e.preventDefault();
        $('input:checkbox.create').not(this).prop('checked', this.checked).change();
        return false;
    });

    $("#checked-edit").change(function (e) {
        e.preventDefault();
        $('input:checkbox.edit').not(this).prop('checked', this.checked).change();
        return false;
    });

    $("#checked-delete").change(function (e) {
        e.preventDefault();
        $('input:checkbox.delete').not(this).prop('checked', this.checked).change();
        return false;
    });

    $(".checked-header").change(function (e) {
        e.preventDefault();
        var count = $('input:checkbox.checked-header:checked').length;
        if (count < 4) {
            $('input:checkbox.menu').prop('checked', true);
        }
        if (count == 0) {
            $('input:checkbox.menu').prop('checked', false);
            $('#checked-all').prop('checked', false);
        }
        if (count == 4) {
            $('#checked-all').prop('checked', true);
        }
        return false;
    });

    $("body").on("change", ".is_parent", function (e) {
        e.preventDefault();
        var is_parent = $(this).attr("data-parent-id");
        $('input:checkbox.is_child[data-parent-id="' + is_parent + '"]').not(this).not(":disabled").prop('checked', this.checked);
        $('input:checkbox.permission[data-parent-id="' + is_parent + '"]').not(this).not(":disabled").prop('checked', this.checked);
    });

    $("body").on("change", ".is_child", function (e) {
        e.preventDefault();
        var menu_id = $(this).val();
        var is_parent = $(this).attr("data-parent-id");
        $('input:checkbox.permission[data-menu-id="' + menu_id + '"]').not(this).not(":disabled").prop('checked', this.checked);
        $('input:checkbox.permission[data-parent-id="' + menu_id + '"]').not(this).not(":disabled").prop('checked', this.checked);

        var checkedParent = $('input:checkbox.is_parent[data-menu-id="' + is_parent + '"]:checked').length;
        var checkedChild = $('input:checkbox.is_child[data-parent-id="' + is_parent + '"]:checked').length;


        if (checkedParent == 0 && checkedChild > 0) {
            $('input:checkbox.is_parent[data-menu-id="' + is_parent + '"]').not(this).not(":disabled").prop('checked', true);
        }

        if (checkedParent > 0 && checkedChild == 0) {
            $('input:checkbox.is_parent[data-menu-id="' + is_parent + '"]').not(this).not(":disabled").prop('checked', false);
        }

    });

    $("body").on("change", ".permission", function (e) {
        e.preventDefault();
        var menu_id = $(this).attr("data-menu-id");
        var is_parent = $(this).attr("data-parent-id");
        var checked = $(this).is(":checked");

        var actionChecked = $('input:checkbox.permission[data-menu-id="' + menu_id + '"]:checked').length;
        if (actionChecked > 0) {
            $('input:checkbox.is_parent[data-menu-id="' + menu_id + '"]').prop('checked', true);
            $('input:checkbox.is_parent[data-parent-id="' + is_parent + '"]').prop('checked', true);
            $('input:checkbox.is_child[data-menu-id="' + menu_id + '"][data-parent-id="' + is_parent + '"]').prop('checked', true);
        } else {
            $('input:checkbox.is_parent[data-menu-id="' + menu_id + '"][data-parent-id="' + is_parent + '"]').prop('checked', false);
            var checkedMenu = $('input:checkbox.is_child[data-parent-id="' + is_parent + '"]:checked').not(".is_parent").length;
            var permissionChecked = $('input:checkbox.permission[data-menu-id="' + menu_id + '"][data-parent-id="' + is_parent + '"]:checked').length;
            if (permissionChecked == 0) {
                $('input:checkbox.is_child[data-menu-id="' + menu_id + '"][data-parent-id="' + is_parent + '"]').prop('checked', false).change();
            }
        }
        return false;
    });

    if ($("#table-show").length > 0) {
        $('.cr').css('display', 'none');
        var permissions = $("#permissions").val();
        var json = JSON.parse(permissions);
        json.forEach(function (row) {

            $("table #menu" + row.route_id).hide();

            if (parseInt(row.can_create) == 1) {
                $('input:checkbox.create[data-menu-id="' + row.route_id + '"]').prop('checked', true).replaceWith("<i class='fa fa-check'></i>&nbsp;");
            }

            if (parseInt(row.can_delete) == 1) {
                $('input:checkbox.delete[data-menu-id="' + row.route_id + '"]').prop('checked', true).replaceWith("<i class='fa fa-check'></i>&nbsp;");
            }

            if (parseInt(row.can_update) == 1) {
                $('input:checkbox.edit[data-menu-id="' + row.route_id + '"]').prop('checked', true).replaceWith("<i class='fa fa-check'></i>&nbsp;");
            }

            if (parseInt(row.can_view) == 1) {
                $('input:checkbox.view[data-menu-id="' + row.route_id + '"]').prop('checked', true).replaceWith("<i class='fa fa-check'></i>&nbsp;");
            }

        });

        $("#table-show input:checkbox:not(:checked).permission").replaceWith("<i class='fa fa-ban'></i>&nbsp;");
        $("#table-show input:checkbox:not(:checked).menu").replaceWith("");

    }

    if ($(".is_edit").length > 0) {
        var permissions = $("#permissions").val();
        var json = JSON.parse(permissions);
        json.forEach(function (row) {

            $("table #menu" + row.route_id).prop('checked', true);

            if (parseInt(row.can_create) == 1) {
                $('input:checkbox.create[data-menu-id="' + row.route_id + '"]').prop('checked', true);
            }

            if (parseInt(row.can_delete) == 1) {
                $('input:checkbox.delete[data-menu-id="' + row.route_id + '"]').prop('checked', true);
            }

            if (parseInt(row.can_update) == 1) {
                $('input:checkbox.edit[data-menu-id="' + row.route_id + '"]').prop('checked', true);
            }

            if (parseInt(row.can_view) == 1) {
                $('input:checkbox.view[data-menu-id="' + row.route_id + '"]').prop('checked', true);
            }

        });
    }

});
