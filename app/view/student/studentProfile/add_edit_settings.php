<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("studentProfile");
// print_r($data);
?>

<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch("Saliya", "Bandara"); ?>
    <div class="my-2 mx-2">
        <h3 class="text-muted">Edit Notification Settings</h3>
        <?php
            $settings = $data["settings"][0];
        ?>

        <h4 class="text-muted font-medium text-danger" >If you don't want to receive any notification, keep the checkboxes unchecked.</h4>

        <form class="form form-group my-2">
            <div class = "mb-1 checkboxInput">
                <?php 
                    $exam_notify = json_decode($settings['exam_notify'], true);
                    
                    $onsiteExamSelected = ($exam_notify[0][1] == 1) ? "checked" : "";
                    $emailExamSelected = ($exam_notify[1][1] == 1) ? "checked" : "";
                ?>
                    <label for="type" class="optionLabel">
                        Preferred option for receiving exam notifications:
                    </label>
                
                    <input type="checkbox" id="onsiteExam"  name="onsiteExam" value="1" <?= $onsiteExamSelected ?>>
                    <label for= "onsiteExam" class = "checkboxLabel"> Onsite Notifications </label>

                    <input type="checkbox" id="emailExam"  name="emailExam" value="1" <?= $emailExamSelected ?>>
                    <label for= "emailExam" class = "checkboxLabel"> Email Notifications </label>
            </div>

            <div class = "mb-1 checkboxInput">
                <?php 
                    $reminder_notify = json_decode($settings['reminder_notify'], true);
                    
                    $onsiteReminderSelected = ($reminder_notify[0][1] == 1) ? "checked" : "";
                    $emailReminderSelected = ($reminder_notify[1][1] == 1) ? "checked" : "";
                ?>
                    <label for="type" class="optionLabel">
                        Preferred option for receiving reminders:
                    </label>
                
                    <input type="checkbox" id="onsiteReminder"  name="onsiteReminder" value="1" <?= $onsiteReminderSelected ?>>
                    <label for= "onsiteReminder" class = "checkboxLabel"> Onsite Notifications </label>

                    <input type="checkbox" id="emailReminder"  name="emailReminder" value="1" <?= $emailReminderSelected ?>>
                    <label for= "emailReminder" class = "checkboxLabel"> Email Notifications </label>
            </div>

            <div class = "mb-1 checkboxInput">
                <?php 
                    $event_notify = json_decode($settings['events_notify'], true);
                    
                    $onsiteEventSelected = ($event_notify[0][1] == 1) ? "checked" : "";
                    $emailEventSelected = ($event_notify[1][1] == 1) ? "checked" : "";
                ?>
                    <label for="type" class="optionLabel">
                        Preferred option for receiving event notifications: 
                    </label>
                
                    <input type="checkbox" id="onsiteEvent"  name="onsiteEvent" value="1" <?= $onsiteEventSelected ?>>
                    <label for= "onsiteEvent" class = "checkboxLabel"> Onsite Notifications </label>

                    <input type="checkbox" id="emailEvent"  name="emailEvent" value="1" <?= $emailEventSelected ?>>
                    <label for= "emailEvent" class = "checkboxLabel"> Email Notifications </label>
            </div>

            <div class = "mb-1 checkboxInput">
                <?php 
                    $material_notify = json_decode($settings['materials_notify'], true);
                    
                    $onsiteMaterialelected = ($material_notify[0][1] == 1) ? "checked" : "";
                    $emailMaterialSelected = ($material_notify[1][1] == 1) ? "checked" : "";
                ?>
                    <label for="type" class="optionLabel">
                        Preferred option for receiving material upload notifications:
                    </label>
                
                    <input type="checkbox" id="onsiteMaterial"  name="onsiteMaterial" value="1" <?= $onsiteMaterialelected ?>>
                    <label for= "onsiteMaterial" class = "checkboxLabel"> Onsite Notifications </label>

                    <input type="checkbox" id="emailMaterial"  name="emailMaterial" value="1" <?= $emailMaterialSelected ?>>
                    <label for= "emailMaterial" class = "checkboxLabel"> Email Notifications </label>
            </div>

            <?php
                $emailSelected = ($settings["preferred_email"] == 1) ? "selected" : "";
                $altEmailSelected = ($settings["preferred_email"] == 2) ? "selected" : "";
            ?>
            <div class="mb-1 form-group">
                <label for="type" class="form-label">
                    Preferred Email Address for receiving notifications:
                </label>
                <select id="email" name="email" placeholder="Select preferred email" data-validation="required" class="form-control">
                    <option value='1' class='font-medium text-muted' id = "emailSelect" <?= $emailSelected ?>><?= $settings["email"]?></option>
                    <option value='2' class='font-medium text-muted' <?= $altEmailSelected ?>><?= $settings["alt_email"]?></option>
                </select>
            </div>

            <?php
                $week2Selected = ($settings["notify_duration"] == 1) ? "selected" : "";
                $week1Selected = ($settings["notify_duration"] == 2) ? "selected" : "";
                $day1Selected = ($settings["notify_duration"] == 3) ? "selected" : "";
            ?>

            <div class="mb-1 form-group">
                <label for="type" class="form-label">
                    Send Reminder Notifications (No. of days before):
                </label>
                <select id="days" name="days" placeholder="Select Duration" data-validation="required" class="form-control">
                    <option value='1' class='font-medium text-muted' id = "week2" <?= $week2Selected ?>>Before 2 Weeks</option>
                    <option value='2' class='font-medium text-muted' id = "week1" <?= $week1Selected ?>>Before 1 Week</option>
                    <option value='3' class='font-medium text-muted' id = "day1" <?= $day1Selected ?>>Before 1 Day</option>
                </select>
            </div>

            <div class="mt-1-5 form-group">
                <a href="<?= BASE_URL ?>/studentProfile" class="btn btn-info">Back</a>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>

        </form>

    </div>
</div>

<style>
    .checkboxLabel{
        display: inline !important;
        font-weight: 400 !important;
    }

    .optionLabel{
        display: block;
        font-size: var(--rv-1-new);
        color: #6c757d;
        font-weight: 600;
        margin-bottom: 0.5rem;
        padding-left: 0.2rem;
        padding-right: 1rem;
    }

    .checkboxInput input[type="checkbox"] {
        margin: 1rem 0.5rem 1rem 0.5rem;
        width: 1rem;
        height: 1rem;

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

            var emailValue = $('#emailSelect').is(':selected') ? 1 : 2;

            values['preferred_email'] = emailValue;

            if ($('#week2').is(':selected')){
                var daysValue = 1;
            }
            else if($('#week1').is(':selected')){
                var daysValue = 2;
            }
            else if($('#day1').is(':selected')){
                var daysValue = 3;
            }

            values['notify_duration'] = daysValue;

            var onsiteExamValue = $('#onsiteExam').is(':checked') ? 1 : 0;
            var emailExamValue = $('#emailExam').is(':checked') ? 1 : 0;

            // Construct the array with the updated values
            var examNotifyArray = [
                ["Onsite", onsiteExamValue],
                ["Email", emailExamValue]
            ];

            values['exam_notify'] = examNotifyArray;

            var onsiteReminderValue = $('#onsiteReminder').is(':checked') ? 1 : 0;
            var emailReminderValue = $('#emailReminder').is(':checked') ? 1 : 0;

            // Construct the array with the updated values
            var reminderNotifyArray = [
                ["Onsite", onsiteReminderValue],
                ["Email", emailReminderValue]
            ];

            values['reminder_notify'] = reminderNotifyArray;

            var onsiteEventValue = $('#onsiteEvent').is(':checked') ? 1 : 0;
            var emailEventValue = $('#emailEvent').is(':checked') ? 1 : 0;

            // Construct the array with the updated values
            var eventNotifyArray = [
                ["Onsite", onsiteEventValue],
                ["Email", emailEventValue]
            ];

            values['events_notify'] = eventNotifyArray;

            var onsiteMaterialValue = $('#onsiteMaterial').is(':checked') ? 1 : 0;
            var emailMaterialValue = $('#emailMaterial').is(':checked') ? 1 : 0;

            // Construct the array with the updated values
            var materialNotifyArray = [
                ["Onsite", onsiteMaterialValue],
                ["Email", emailMaterialValue]
            ];

            values['materials_notify'] = materialNotifyArray;

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