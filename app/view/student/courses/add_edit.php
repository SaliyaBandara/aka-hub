<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("courses");
// print_r($data);
?>

<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch("Saliya", "Bandara"); ?>
    <div class="my-2 mx-2">
        <h3 class="text-muted"><?= $data["action"] == "create" ? "Create New Course" : "Edit Course" ?></h3>


        <form action="" method="post" class="form">
            <?php

            foreach ($data["course_template"] as $key => $value) {
            ?>
                <div class="mb-1 form-group">
                    <label for="name" class="form-label"><?= $value["label"] ?></label>
                    <input type="<?= $value["type"] ?>" id="<?= $key ?>" name="<?= $key ?>" placeholder="Enter <?= $value["label"] ?>" value="<?= $data["course"][$key] ?>" <?= $value["validation"] == "required" ? "data-validation='required'" : "" ?> class="form-control">
                </div>
            <?php
            }
            ?>

            <div class="mt-1-5 form-group">
                <a href="<?= BASE_URL ?>/courses" class="btn btn-info">Back</a>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>

        </form>

    </div>
</div>

<?php $HTMLFooter = new HTMLFooter(); ?>

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

            if (values["semester"] != 1 && values["semester"] != 2) {
                empty_fields.push($("#semester"));
                $("#semester").addClass("border-danger");
                return alertUser("warning", `Semester should be 1 or 2`);
            }

            if (values["year"] != 1 && values["year"] != 2 && values["year"] != 3 && values["year"] != 4) {
                empty_fields.push($("#year"));
                $("#year").addClass("border-danger");
                return alertUser("warning", `Year should be 1, 2, 3 or 4`);
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