<?php
$HTMLHead = new HTMLHead($data['title']);
$sidebar = new Sidebar("calendar");
?>

<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>
    <div class="my-2 mx-2">
        <h3 class="text-muted"><?= $data["action"] == "create" ? "Create New Calendar Event" : "Edit Calendar Event" ?></h3>


        <form action="" method="post" class="form">
            <?php

            foreach ($data["item_template"] as $key => $value) {
                if (isset($value["skip"]) && $value["skip"] == true)
                    continue;
            ?>
                <div class="mb-1 form-group">
                    <label for="name" class="form-label"><?= $value["label"] ?></label>
                    <input type="<?= $value["type"] ?>" id="<?= $key ?>" name="<?= $key ?>" placeholder="Enter <?= $value["label"] ?>" value="<?= $data["item"][$key] ?>" <?= $value["validation"] == "required" ? "data-validation='required'" : "" ?> class="form-control">
                </div>
            <?php
            }
            ?>

            <div class="mb-1 form-group">
                <label class="form-label">Target Audience</label>
                <select name="target" class="form-control" data-validation="required">
                    <option value="5" <?= $data["item"]["target"] == 5 ? "selected" : "" ?>>All Students</option>
                    <option value="1" <?= $data["item"]["target"] == 1 ? "selected" : "" ?>>Student - 1st Year</option>
                    <option value="2" <?= $data["item"]["target"] == 2 ? "selected" : "" ?>>Student - 2nd Year</option>
                    <option value="3" <?= $data["item"]["target"] == 3 ? "selected" : "" ?>>Student - 3rd Year</option>
                    <option value="4" <?= $data["item"]["target"] == 4 ? "selected" : "" ?>>Student - 4th Year</option>
                </select>
            </div>

            <div class="mb-1 form-group">
                <label class="form-label">Event Type</label>
                <select name="type" class="form-control" data-validation="required">
                    <option value="2" <?= $data["item"]["type"] == 2 && $_SESSION["student_rep"] == 1 ? "selected" : "" ?>>Course Event</option>
                    <option value="1" <?= $data["item"]["type"] == 1 && $_SESSION["student_rep"] == 1 ? "selected" : "" ?>>Exam</option>
                    <option value="3" <?= $data["item"]["type"] == 3 ? "selected" : "" ?>>Club Event</option>
                    <option value="4" <?= $data["item"]["type"] == 4 && $_SESSION["student_rep"] == 1 ? "selected" : "" ?>>Counsellor Event</option>
                </select>
            </div>

            <div class="mb-1 form-group">
                <label class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" placeholder="Enter Description" data-validation="required"><?= $data["item"]["description"] ?></textarea>
            </div>

            <div class="mt-1-5 form-group">
                <a href="<?= BASE_URL ?>/calendar/" class="btn btn-info">Back</a>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>

        </form>

    </div>
</div>

<?php $HTMLFooter = new HTMLFooter(); ?>
<script>
    let BASE_URL = "<?= BASE_URL ?>";
</script>
<script>
    $(document).ready(function() {

        $('form').submit(function(event) {
            event.preventDefault();
            var input = $(this);
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