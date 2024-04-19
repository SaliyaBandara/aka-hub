<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("adminAccount");
?>

<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>


    <div class="main-grid flex">
        <div class="left">
            <form action="" method="post" class="form">
                <h3 class="text-muted"><?= $data["id"] == 0 ? "Create New Admin" : "Edit Admin Data" ?></h3>

                <?php

                $data["user"]["password"] = "";
                foreach ($data["user_template"] as $key => $value) {
                    if (isset($value["skip"]) && $value["skip"] == true)
                        continue;
                ?>
                    <div class="mb-1 form-group">
                        <label for="name" class="form-label">
                            <?= $value["label"] ?>
                            <?= $key == "password" ? "<span class='text-small text-muted'>(Leave blank if you don't want to change)</span>" : "" ?>
                        </label>
                        <input type="<?= $value["type"] ?>" id="<?= $key ?>" name="<?= $key ?>" placeholder="Enter <?= $value["label"] ?>" value="<?= $data["user"][$key] ?>" <?= $value["validation"] == "required" ? "data-validation='required'" : "" ?> class="form-control">
                    </div>
                <?php
                }

                foreach ($data["admin_template"] as $key => $value) {
                    if (isset($value["skip"]) && $value["skip"] == true)
                        continue;
                ?>
                    <div class="mb-1 form-group">
                        <label for="name" class="form-label">
                            <?= $value["label"] ?>
                            <?= $key == "password" ? "<span class='text-small text-muted'>(Leave blank if you don't want to change)</span>" : "" ?>
                        </label>
                        <input type="<?= $value["type"] ?>" id="<?= $key ?>" name="<?= $key ?>" placeholder="Enter <?= $value["label"] ?>" value="<?= $data["admin"][$key] ?>" <?= $value["validation"] == "required" ? "data-validation='required'" : "" ?> class="form-control">
                    </div>
                <?php
                }
                ?>


                <div class="mt-1-5 form-group">
                    <a href="<?= BASE_URL ?>/" class="btn btn-info">Back</a>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
                
            </form>
        </div>
    </div>

    <style>
        .mwb-form-main-wrapper {
            font-family: 'Lato', sans-serif;
            line-height: 1.5;
            padding: 20px;
            width: 100%;
        }

        .mwb-form-main-container {
            /* background-color: #fff; */
            color: #7b7878;
            /* margin: 0 auto; */
            max-width: 85%;
            max-width: 700px;
        }

        .mwb-form-main-container form {
            padding: 20px;
        }

        .mwb-form-main-container h1 {
            background-color: #26A69A;
            color: #ffffff;
            font-size: 30px;
            font-weight: 500;
            margin: 0 0 10px 0;
            padding: 22px 15px;
            text-align: center;
        }

        .mwb-form-group {
            font-size: 14px;
            margin-bottom: 30px;
            position: relative;
        }

        .mwb-form-text-label {
            left: 10px;
            position: absolute;
            top: 12px;
            transition: 0.2s linear all;
        }

        .mwb-form-group.focus-input .mwb-form-text-label {
            background-color: #ffffff;
            padding: 0 2px;
            top: -11px;
            transition: 0.2s linear all;
        }

        .mwb-form-control {
            background-color: #ffffff;
            border-radius: 4px;
            border: 2px solid #dddddd;
            font-size: 14px;
            padding: 13px;
            width: 100%;
        }

        .mwb-form-submit-btn {
            background-color: #2684FF;
            border-radius: 4px;
            border: none;
            color: #ffffff;
            cursor: pointer;
            display: inline-block;
            font-size: 14px;
            min-width: 200px;
            padding: 16px 10px;
        }

        .mwb-form-submit-btn :hover {
            background-color: white;
            border-radius: 4px;
            border: none;
            color: black;
            cursor: pointer;
            display: inline-block;
            font-size: 14px;
            min-width: 200px;
            padding: 16px 10px;
        }

        .mwb-form-radio {
            display: inline-block;
            margin-right: 15px;
            position: relative;
        }

        .mwb-form-radio input[type="radio"]~label {
            padding-left: 10px;
            cursor: pointer;
        }

        .mwb-form-radio input[type="radio"] {
            margin: 0;
            cursor: pointer;
            width: 20px;
            height: 20px;
            opacity: 0;
        }

        .mwb-form-radio input[type="radio"]+label::before {
            background-color: #dddddd;
            border-radius: 50%;
            content: "";
            cursor: pointer;
            height: 20px;
            left: 0;
            position: absolute;
            top: 6px;
            width: 20px;
        }

        .mwb-form-radio input[type="radio"]+label::after {
            background-color: #2684FF;
            border-radius: 50%;
            content: "";
            height: 10px;
            left: 5px;
            opacity: 0;
            position: absolute;
            top: 11px;
            transform: scale(0);
            transition: 0.3s linear all;
            visibility: hidden;
            width: 10px;
        }

        .mwb-form-radio input[type="radio"]:checked+label::after {
            opacity: 1;
            transform: scale(1);
            transition: 0.3s linear all;
            visibility: visible;
        }

        .mwb-form-error {
            color: #f52626;
            display: none;
            font-size: 12px;
            padding-top: 2px;
        }


        .divFormContainor {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
        }

        .divCounselorDetails {
            width: 100%;
            height: 80%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .divAddCounselors h3 {
            /* text-align: center; */
        }

        .divAddCounselors {
            width: 100%;
            height: 100%;
        }
    </style>

</div>

<script>
    jQuery(document).ready(function($) {
        $(".mwb-form-control").focus(function() {
            var tmpThis = $(this).val();
            if (tmpThis == '') {
                $(this).parent(".mwb-form-group").addClass("focus-input");
            } else if (tmpThis != '') {
                $(this).parent(".mwb-form-group").addClass("focus-input");
            }
        });
        $(".mwb-form-control").blur(function() {
            var tmpThis = $(this).val();
            if (tmpThis == '') {
                $(this).parent(".mwb-form-group").removeClass("focus-input");
                $(this).siblings('.mwb-form-error').slideDown("3000");
            } else if (tmpThis != '') {
                $(this).parent(".mwb-form-group").addClass("focus-input");
                $(this).siblings('.mwb-form-error').slideUp("3000");

            }
        });

    });
</script>

<?php $HTMLFooter = new HTMLFooter(); ?>
<script>
    let BASE_URL = "<?= BASE_URL ?>";
</script>
<script>
    $(document).ready(function() {

        $('form').submit(function(event) {
            event.preventDefault();
            var input = $(this);
            // var $inputs = $('form :input');
            var $inputs = $(this).find(':input');

            var values = {};
            let empty_fields = []
            $inputs.each(function() {
                values[this.name] = $(this).val();
                if ($(this).attr("data-validation") != undefined && $(this).is("input") && $(this).val() === "" ||
                    $(this).is("select") && $(this).val() === "0") {
                    empty_fields.push($(this));
                    $(this).addClass("border-danger");
                } else {
                    $(this).removeClass("border-danger");
                }
            });

            setTimeout(() => {
                empty_fields.forEach(element => element.removeClass("border-danger"));
            }, 6000);

            if (empty_fields.length > 0) {
                empty_fields[0].focus();
                return alertUser("warning", `Please fill all the fields`);
            }

            $.ajax({
                // url: url,
                type: 'post',
                data: {
                    add_edit: values
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
    });
</script>