<?php
$HTMLHead = new HTMLHead($data['title']);
$header = new header();
?>

<div class="fixed-overlay-model fixed-model forgot-password-model" style="display: none;">
    <div class="container auth__section">
        <div class="close-btn">
            <i class='bx bx-x'></i>
        </div>

        <form class="form" id="reset-password" action="" method="post">
            <div class="title">Forgot Your Password?</div>
            <div class="form-desc mb-1-5">
                Enter your email address and we'll send you a link to reset your password
            </div>

            <div class="form-group" style="">
                <label>
                    <input type="email" name="email" placeholder=" ">
                    <p>Email address <span class="text-gold">*</span></p>
                </label>
            </div>

            <div class="form-group" style="">
                <button class="w-100 btn btn--secondary" type="submit">Reset Password</button>
            </div>
        </form>

    </div>
    <div class="bg"></div>
</div>

<div class="fixed-overlay-model fixed-model notice-model" style="display: none;">
    <div class="container auth__section">
        <div class="close-btn close-model-btn">
            <i class='bx bx-x'></i>
        </div>

        <form class="form" id="reset-password" action="" method="post">
            <div class="title">Confirm Your Email Address</div>
            <div class="form-desc mb-1-5">
                We have sent you an email with a link to confirm your email address
                <strong>{{email}}</strong>. Please check your email and click on the link to confirm your email address.
            </div>

            <div class="form-group" style="">
                <button class="w-100 btn btn--secondary close-model-btn" type="submit">Okay</button>
            </div>
        </form>

    </div>
    <div class="bg"></div>
</div>

<?php if (isset($data["email_verified"])) { ?>
    <div class="fixed-overlay-model fixed-model notice-success-model" style="display: flex;">
        <div class="container auth__section">
            <div class="close-btn close-model-btn">
                <i class='bx bx-x'></i>
            </div>

            <form class="form" id="reset-password" action="" method="post">
                <div class="title"><?= $data["email_verified"] == 1 ? "Email Verified Successfully" : "Email Verification Failed" ?></div>
                <div class="form-desc mb-1-5">
                    <?= $data["email_verified"] == 1 ? "Your email has been verified successfully. You can now login to your account and enjoy the features of Aka Hub." : "Your email verification failed. Invalid or expired verification link." ?>
                </div>
                <div class="form-group" style="">
                    <button class="w-100 btn btn--secondary close-model-btn" type="submit">Okay</button>
                </div>
            </form>

        </div>
        <div class="bg"></div>
    </div>
<?php } ?>

<?php if (isset($data["reset_password"]) && $data["reset_password"] == 1) { ?>
    <div class="fixed-overlay-model fixed-model reset-password-model" style="display: flex;">
        <div class="container auth__section">
            <div class="close-btn close-model-btn">
                <i class='bx bx-x'></i>
            </div>

            <form class="form" id="reset-password-save" action="" method="post">
                <div class="title">Reset Your Password</div>
                <div class="form-desc mb-1-5">
                    Please enter your new password
                </div>

                <div class="form-group flex-column">
                    <label>
                        <input type="password" name="password" placeholder=" ">
                        <p>New Password <span class="text-gold">*</span></p>
                    </label>
                    <label>
                        <input type="password" name="confirm_password" placeholder=" ">
                        <p>Confirm Password <span class="text-gold">*</span></p>
                    </label>
                </div>

                <div class="form-group" style="">
                    <button class="w-100 btn btn--secondary" type="submit">Reset Password</button>
                </div>
            </form>

        </div>
        <div class="bg"></div>
    </div>
<?php } ?>

<?php if (isset($data["reset_password"]) && $data["reset_password"] == 2) { ?>
    <div class="fixed-overlay-model fixed-model reset-password-model" style="display: flex;">
        <div class="container auth__section">
            <div class="close-btn close-model-btn">
                <i class='bx bx-x'></i>
            </div>

            <form class="form" id="reset-password-save" action="" method="post">
                <div class="title">Invalid Password Reset Link</div>
                <div class="form-desc mb-1-5">
                    The password reset link is invalid or expired. Please request a new password reset link.
                </div>

                <div class="form-group" style="">
                    <button class="w-100 btn btn--secondary close-model-btn" type="submit">Okay</button>
                </div>
            </form>
        </div>
        <div class="bg"></div>
    </div>
<?php } ?>



<style>
    .fixed-overlay-model {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        /* background-color: rgba(0, 0, 0, 0.5); */
        z-index: 999;

        display: flex;
        align-items: center;
        justify-content: center;
    }

    .fixed-overlay-model .container .close-btn {
        position: absolute;
        top: 0;
        right: 0;
        padding: 0.75rem;
        cursor: pointer;
        font-size: var(--rv-1-5);
    }

    .fixed-overlay-model .container .close-btn:hover {
        color: var(--primary-color);
    }

    .fixed-overlay-model .title {
        text-align: center;
        font-size: var(--rv-1-5);
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .fixed-overlay-model .flex__div {
        display: flex;
        flex-direction: column;
    }

    .fixed-overlay-model .flex__row {
        display: flex;
        justify-content: space-between;
        margin-bottom: var(--rv-0-5);
    }

    /* secdon child */
    .fixed-overlay-model .flex__row div:nth-child(2) {
        text-align: end;
        font-weight: bold;
    }

    .fixed-overlay-model .container {
        position: relative;
        width: 40vw;
        width: clamp(400px, 40vw, 500px);
        max-width: 92vw;
        background-color: #fff;
        padding: 2rem;
        border-radius: 15px;
        font-size: var(--rv-1-new);

        max-height: calc(100vh - 2rem);
        margin: 1rem 0;
        overflow: auto;
    }

    .fixed-overlay-model .btn--secondary {
        padding: var(--rv-1) var(--rv-2);
        border-radius: 40px;
        font-size: clamp(12px, 0.9vw, 18px);
    }

    .fixed-overlay-model .bg {
        position: absolute;
        inset: 0;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: -1;
        cursor: pointer;
    }
</style>

<div id="root">

    <section class="default__section auth__section pt-0">
        <div class="flex__container">

            <div class="left m--none">
                <div class="lucky-cat-stars">
                    <img src="<?= BASE_URL ?>/public/assets/img/common/auth_bg.png" alt="">
                </div>
            </div>

            <div class="right">

                <div class="form-title mb-1">
                    Hello There Wanderer! <br />
                    Welcome to <div class="text-logo"><img src="<?= BASE_URL ?>/public/assets/img/logo/logo_text.png" alt=""></div>
                    <!-- <span class="text--primary">Aka Hub</span> -->
                </div>

                <style>
                    .auth__section .text-logo {
                        display: inline-block;
                        width: 120px;
                        width: clamp(80px, 6vw, 120px);
                        /* width: 6vw; */
                        margin-bottom: -10px;
                    }
                </style>

                <div class="form-selector">
                    <div class="selection active" data-form="login">Login</div>
                    <div class="selection " data-form="registration">Register</div>

                    <div class="indicator">
                        <div class="inner">Login</div>
                    </div>
                </div>

                <form class="form registration-form" id="registration-form" action="" method="post" style="display: none;">

                    <div class="form-desc mb-1-5">
                        Please complete the registration process with correct information
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>
                                <input type="text" name="fname" placeholder=" ">
                                <p>First Name <span class="text-gold">*</span></p>
                            </label>
                        </div>
                        <div class="form-group">
                            <label>
                                <input type="text" name="lname" placeholder=" ">
                                <p>Last Name <span class="text-gold">*</span></p>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>
                            <input type="text" name="student_id" placeholder=" ">
                            <p>Registration Number <span class="text-gold">*</span></p>
                        </label>
                    </div>
                    <div class="form-group">
                        <label>
                            <input type="email" name="email" placeholder=" ">
                            <p>Email address <span class="text-gold">*</span></p>
                        </label>
                    </div>

                    <div class="form-group form-password">
                        <label>
                            <input type="password" name="password" placeholder=" ">
                            <p>Password <span class="text-gold">*</span></p>

                            <div class="password-icon">
                                <i data-feather="eye"></i>
                                <i data-feather="eye-off"></i>
                            </div>
                        </label>
                    </div>
                    <div class="form-group">
                        <button class="w-100 btn btn--secondary" type="submit">Register Now</button>
                    </div>

                    <!-- Already a user?  Login -->
                    <!-- <div class="form-footer">
                        <div class="form-footer-text">
                            Already a user ? <a href="login.php" class="nostyle text--primary switch-form">Login</a>
                        </div>
                    </div> -->

                </form>

                <form class="form" id="login-form" action="" method="post">
                    <div class="form-desc mb-1-5">
                        Please complete the login process with correct information
                    </div>

                    <div class="form-group">
                        <label>
                            <input type="email" name="email" placeholder=" ">
                            <p>Email address <span class="text-gold">*</span></p>
                        </label>
                    </div>

                    <div class="form-group form-password">
                        <label>
                            <input type="password" name="password" placeholder=" ">
                            <p>Password <span class="text-gold">*</span></p>

                            <div class="password-icon">
                                <i data-feather="eye"></i>
                                <i data-feather="eye-off"></i>
                            </div>
                        </label>
                    </div>

                    <div class="form-group justify-end font-1">
                        <div class="flex-item">
                            <a href="#" class="nostyle text--primary forget-password">Forgot Password?</a>
                        </div>
                    </div>

                    <div class="form-group">
                        <button class="w-100 btn btn--secondary" type="submit">Login</button>
                    </div>

                    <!-- Already a user?  Login -->
                    <!-- <div class="form-footer">
                        <div class="form-footer-text">
                            New to platform ? <a href="login.php" class="nostyle text--primary switch-form">Register</a>
                        </div>
                    </div> -->

                </form>
            </div>

        </div>
        <div class="bg-robot-img m--only"></div>
        <div class="bg_ribbon"></div>
        <div class="bg__layer"></div>
    </section>

</div>


<?php
$HTMLFooter = new HTMLFooter();
?>

<script src="https://unpkg.com/feather-icons"></script>
<script>
    feather.replace();
    let BASE_URL_ALT = "<?= BASE_URL ?>";
    var hostname = "<?= "$_SERVER[HTTP_HOST]"; ?>";
</script>

<script>
    let animateDuration = 600,
        opacityDuration = 400;

    function animateForms(form1, form2) {
        if ($(form1).is(":animated") || $(form2).is(":animated"))
            return;

        $(form1).animate({
            opacity: 0
        }, opacityDuration, function() {
            $(form1).slideUp(animateDuration);
            $(form2).css("opacity", "0");
            $(form2).slideDown(animateDuration, function() {
                $(form2).animate({
                    opacity: 1
                }, opacityDuration);
            });
        });

        let url = new URL(window.location.href);
        let redir = url.searchParams.get("redir");
        let redir_str = "";
        if (redir != null)
            redir_str = "&redir=" + encodeURIComponent(redir);

        // preserve redir get params
        if (form2 == "#login-form")
            window.history.pushState("", "", "?action=login" + redir_str);
        else
            window.history.pushState("", "", "?action=register" + redir_str);

        //     window.history.pushState("", "", "?action=login");
        //     window.history.pushState("", "", "?action=register");

        if (form2 == "#login-form")
            $(".auth__section .form-selector .indicator .inner").css({
                transform: "translateX(0%)"
            });
        else
            $(".auth__section .form-selector .indicator .inner").css({
                transform: "translateX(100%)"
            });

        let activeSelector = $(".form-selector .selection.active")
        $(activeSelector).removeClass("active");
        $(activeSelector).siblings(".selection").addClass("active");

    }


    $(document).ready(function() {

        $(document).on("click", ".forget-password", function(event) {
            event.preventDefault();
            $('.fixed-model.forgot-password-model').fadeIn();
            $('body').css('overflow', 'hidden');
        });

        $(document).on("click", ".fixed-model .bg,.fixed-model .close-btn, .fixed-model .close-model-btn", function(event) {
            event.preventDefault();
            $(this).closest('.fixed-model').fadeOut();
            $('body').css('overflow', 'auto');
        });

        // check if action is register or login
        let url = new URL(window.location.href);
        let action = url.searchParams.get("action");

        if (action == "register")
            animateForms("#login-form", "#registration-form");

        // on click form-selector selection without class active
        $(document).on("click", ".form-selector .selection:not(.active)", function() {
            let form = $(this).attr("data-form");
            let formToShow = "#" + form + "-form";
            let formToHide = $(this).siblings(".selection").attr("data-form");
            formToHide = "#" + formToHide + "-form";

            animateForms(formToHide, formToShow);
            // animateForms(formToShow, formToHide);
        });

        // document onclick eye icon
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

        $(document).on("click", ".switch-form", function() {
            event.preventDefault();
            let parentForm = $(this).parents("form").attr("id");

            if (parentForm == "login-form") {
                animateForms("#login-form", "#registration-form");
            } else {
                animateForms("#registration-form", "#login-form");
            }

        });

        $('form').submit(function(event) {
            event.preventDefault();
            var input = $(this);
            // var $inputs = $('form :input');
            var $inputs = $(this).find(':input');

            var values = {};
            $inputs.each(function() {
                values[this.name] = $(this).val();
            });

            // check if form is login or register
            let formId = $(this).attr("id");
            let action = "login";
            if (formId == "registration-form")
                action = "register";
            else if (formId == "reset-password")
                action = "reset_password";
            else if (formId == "reset-password-save")
                action = "reset_password";

            // var url = getBaseURL() + "/" + action;
            var url = BASE_URL_ALT + "/auth/" + action;

            if (formId == "reset-password-save") {
                action = "reset_password_save";
                let token = window.location.href.split("/").pop();
                url += "/" + token;
            }

            // console.log(baseURL);
            console.log(values);
            // return;

            $.ajax({
                url: url,
                type: 'post',
                data: {
                    action: action,
                    data: values
                },
                dataType: 'json',
                success: function(response) {
                    if (response['status'] == 200) {

                        alertUser("success", response['desc'])

                        if (formId == "reset-password") {
                            return;
                        }

                        if (formId == "reset-password-save") {
                            $('.fixed-model').fadeOut();
                            $('body').css('overflow', 'auto');
                            return;
                        }

                        if (response['register'] == 1) {
                            // open modal
                            $('.fixed-model.notice-model .form-desc')
                                .html($('.fixed-model.notice-model .form-desc')
                                    .html().replace("{{email}}", values["email"]));
                            $('.fixed-model.notice-model').fadeIn();
                            $('body').css('overflow', 'hidden');

                        } else {

                            var redirUrl = GetURLParameter('redir');
                            let customRedir = 0;
                            if (redirUrl != null) {
                                redirUrl = decodeURI(redirUrl);
                                if (getHostname(redirUrl) == hostname) {
                                    customRedir = 1;
                                    setTimeout(function() {
                                        window.location.replace(redirUrl)
                                    }, 2000);
                                    return;
                                }
                            }

                            setTimeout(function() {
                                window.location.replace(response["redirect"]);
                            }, 2000);
                        }

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

        // NiceSelect.bind(document.getElementById("js-select"), {
        //     searchable: false,
        //     placeholder: "EN"
        // });
    });
</script>