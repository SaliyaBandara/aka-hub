<?php
$HTMLHead = new HTMLHead($data['title']);
$header = new header();
?>

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
            $('.fixed-model').fadeIn();
            $('body').css('overflow', 'hidden');
        });

        $(document).on("click", ".fixed-model .bg,.fixed-model .close-btn", function(event) {
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
                action = "reset-password";

            var url = getBaseURL() + "/" + action;
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