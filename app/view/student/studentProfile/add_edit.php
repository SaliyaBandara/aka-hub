<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("settings");
// print_r($data);
?>

<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch("Saliya", "Bandara"); ?>
    <div class="my-2 mx-2">
        <h3 class="text-muted">Edit Profile</h3>


        <form action="" method="post" class="form">
            <div class="mb-1 form-group">
                    <label for="name" class="form-label">Student ID</label>
                    <input type="text" id="student_id" name="student_id" class="form-control" value = "<?= $data["student_profile"]["index_number"] ?>" disabled>
            </div>

            <?php

            foreach ($data["student_profile_template"] as $key => $value) {
                if (isset($value["skip"]) && $value["skip"] == true)
                    continue;
            ?>
                <div class="mb-1 form-group">
                    <label for="name" class="form-label"><?= $value["label"] ?></label>
                    <input type="<?= $value["type"] ?>" id="<?= $key ?>" name="<?= $key ?>" placeholder="Enter <?= $value["label"] ?>" value="<?= $data["student_profile"][$key] ?>" <?= $value["validation"] == "required" ? "data-validation='required'" : "" ?> class="form-control">
                </div>
            <?php
            }
            ?>

            <!-- <div class="mb-1 form-group">
                    <label for="name" class="form-label">Preferred Email Address to receive Notifications</label>
                    <select id="emailAddress" name="emailAddress" class = "form-control">
                                <option value="21cs1234@ucsc.amb.ac.lk" selected>21cs1234@ucsc.amb.ac.lk</option>
                                <option value="samudi@gmail.com">samudi@gmail.com</option>
                    </select>
            </div> -->
            
            <!-- <div class="mb-1 form-group">
                    <label for="name" class="form-label">Send Exam and Assignment Notifications</label>
                    <label for="type1">Onsite Notifications</label>
                    <input type="radio" name="notify_exam" value="0" class = "form-control">
                    <label for="type2">Emails</label>
                    <input type="radio" name="notify_exam" value="1" class = "form-control" checked>
                    <label for="type3">None</label>
                    <input type="radio" name="notify_exam" value="2" class = "form-control">
            </div>

            <div class="mb-1 form-group">
                    <label for="name" class="form-label">Send Reminder Notifications through</label>
                    <label for="type1">Onsite Notifications</label>
                    <input type="radio" name="notify_reminder" value="0" class = "form-control">
                    <label for="type2">Emails</label>
                    <input type="radio" name="notify_reminder" value="1" class = "form-control" checked>
                    <label for="type3">None</label>
                    <input type="radio" name="notify_reminder" value="2" class = "form-control">
            </div>

            <div class="mb-1 form-group">
                    <label for="name" class="form-label">Send New Club Event Post Notifications</label>
                    <label for="type1">Onsite Notifications</label>
                    <input type="radio" name="notify_event" value="0" class = "form-control">
                    <label for="type2">Emails</label>
                    <input type="radio" name="notify_event" value="1" class = "form-control" checked>
                    <label for="type3">None</label>
                    <input type="radio" name="notify_event" value="2" class = "form-control">
            </div>

            <div class="mb-1 form-group">
                    <label for="name" class="form-label">Send New Material update Notifications</label>
                    <label for="type1">Onsite Notifications</label>
                    <input type="radio" name="notify_material" value="0" class = "form-control">
                    <label for="type2">Emails</label>
                    <input type="radio" name="notify_material" value="1" class = "form-control" checked>
                    <label for="type3">None</label>
                    <input type="radio" name="notify_material" value="2" class = "form-control">
            </div>

            <div class="mb-1 form-group">
                    <label for="name" class="form-label">Send Reminder Notifications (No. of days before)</label>
                    <select id="days" name="days" class = "form-control">
                                <option value="0" selected>Before 2 weeks</option>
                                <option value="1">Before 1 week</option>
                                <option value="2">Before 1 day</option>
                    </select>
            </div> -->


            <div class="mt-1-5 form-group">
                <a href="<?= BASE_URL ?>/studentProfile" class="btn btn-info">Back</a>
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
    "use strict";
    Dropzone.autoDiscover = false;
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