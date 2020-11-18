$(document).ready(function () {
    $(".dat_edit_bt").click(function () {
        var obj = $(this).closest(".dap_lo").find(".dat_edit");
        obj.dialog({
            modal: true,
            width: 650,
            height: 200,
            title: "Comment Modify"
        });
    });
});