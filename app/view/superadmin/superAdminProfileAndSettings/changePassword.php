<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("superAdminProfileAndSettings");
// print_r($data);
?>

<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>
    <div class="my-2 mx-2">
        <h3 class="text-muted">Change Password</h3>


        <form action="" method="post" class="form">
            <div class="mb-1 form-group">
                <label for="name" class="form-label">Old Password</label>
                <div class="flex flex-row passwordBox">
                    <input type="password" id="password" name="password" class="" value="">
                    <div class="showIcon" style="display: inline;">
                        <i class='bx bx-show feather-eye' style="cursor: pointer;"></i>
                        <i class='bx bx-hide feather-eye-off' style="display: none; cursor: pointer;"></i>
                    </div>
                </div>
            </div>
            <div class="mb-1 form-group">
                <label for="name" class="form-label">New Password</label>
                <div class="flex flex-row passwordBox">
                    <input type="password" id="passwordNew" name="passwordNew" class="" value="">
                    <div class="showIcon" style="display: inline;">
                        <i class='bx bx-show feather-eye-new' style="cursor: pointer;"></i>
                        <i class='bx bx-hide feather-eye-off-new' style="display: none; cursor: pointer;"></i>
                    </div>
                </div>
            </div>

            <div class="mt-1-5 form-group">
                <button class="btn btn-primary" id="changePassword">Change Password</button>
            </div>

        </form>

    </div>
</div>

<style>
    .passwordBox {
        display: block;
        width: 100%;
        height: calc(1.5em + 0.75rem + 2px);
        padding: 0.375rem 0.75rem;
        font-size: var(--rv-1-new);
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .passwordBox:focus-within {
        color: #495057;
        background-color: #fff;
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
    }

    .passwordBox input {
        outline: none;
        border: none;
        width: 95%;
    }

    .passwordBox input:focus {
        outline: none;
        border: none;
    }
</style>

<?php $HTMLFooter = new HTMLFooter(); ?>
<script>
    let BASE_URL = "<?= BASE_URL ?>";
</script>
<script>
    "use strict";
    Dropzone.autoDiscover = false;
    $(document).ready(function() {
        let imgCount = 0;
        let dropZoneImgsArr = [];

        $(document).on("click", "#changePassword", function(event) {

            event.preventDefault();
            var oldPassword = $('#password').val();
            var newPassword = $('#passwordNew').val();

            $.ajax({
                url: `${BASE_URL}/superAdminProfileAndSettings/changePassword`,
                type: 'post',
                data: {
                    oldPassword: oldPassword,
                    newPassword: newPassword,
                    changePassword: true
                },
                dataType: 'json',
                success: function(response) {
                    if (response['status'] == 200) {
                        alertUser("success", response['desc'])
                        setTimeout(function() {
                            history.go(-1);
                            window.close();
                        }, 2000);

                    } else if (response['status'] == 403)
                        alertUser("danger", response['desc'])
                    else
                        alertUser("warning", response['desc'])
                },
                error: function(ajaxContext) {
                    alertUser("danger", "Something Went Wrong")
                }
            });
        });

        $(document).on("click", ".feather-eye", function() {
            $(this).hide();
            $(this).siblings(".feather-eye-off").show();
            $(this).parent().siblings("input").attr("type", "text");
        });

        $(document).on("click", ".feather-eye-off", function() {
            $(this).hide();
            $(this).siblings(".feather-eye").show();
            $(this).parent().siblings("input").attr("type", "password");
        });

        $(document).on("click", ".feather-eye-new", function() {
            $(this).hide();
            $(this).siblings(".feather-eye-off-new").show();
            $(this).parent().siblings("input").attr("type", "text");
        });

        $(document).on("click", ".feather-eye-off-new", function() {
            $(this).hide();
            $(this).siblings(".feather-eye-new").show();
            $(this).parent().siblings("input").attr("type", "password");
        });

    });
</script>