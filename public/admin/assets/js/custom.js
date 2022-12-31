(function ($) {
    $(document).ready(function () {
        // =============== CSRF TOKEN ==============
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        // =============== Admin Update Password ==============
        $(document).on("keyup", "#current_pass", function () {
            const current_pass = $(this).val();
            // console.log(current_pass);

            $.ajax({
                url: "/admin/check/current-password",
                type: "post",
                data: { current_pass },
                success: function (res) {
                    if (res.status) {
                        $("#error_current_pass").html(
                            `<span class="text-${res.type}"><b>${res.message}</b></span>`
                        );
                    } else {
                        $("#error_current_pass").html(
                            `<span class="text-${res.type}"><b>${res.message}</b></span>`
                        );
                    }
                },
            });
        });

        // =============== Admin / Vendor Update Status ==============
        $(document).on("click", ".adminStatusUpdate", function () {
            const admin_id = $(this).attr("admin_id");
            const status = $(this).children("span").attr("status");
            // console.log(admin_id);
            // return false;
            $.ajax({
                url: "/admin/status/update/" + admin_id,
                type: "get",
                data: { status },
                success: function (res) {
                    if (res == "active") {
                        $("#admin-" + admin_id).html(
                            `<span status="1" class="badge badge-success">Active</span>`
                        );
                    } else {
                        $("#admin-" + admin_id).html(
                            `<span status="0" class="badge badge-danger">Inactive</span>`
                        );
                    }
                    // alert(res);
                },
            });
        });
    });
})(jQuery);
