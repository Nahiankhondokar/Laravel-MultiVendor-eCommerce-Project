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
                url: "/admin/update-password",
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
    });
})(jQuery);
