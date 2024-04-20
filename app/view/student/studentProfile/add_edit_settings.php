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

            <div class="mb-1 form-group">
                <label for="name" class="form-label">Preferred Email Address to receive Notifications</label>
                <select id="emailAddress" name="emailAddress" class = "form-control">
                    <option value="21cs1234@ucsc.amb.ac.lk" selected>21cs1234@ucsc.amb.ac.lk</option>
                    <option value="samudi@gmail.com">samudi@gmail.com</option>
                </select>
            </div>
            
            <div class="mb-1 form-group">
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
            </div>


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

            if (values["year"] != 1 && values["year"] != 2 && values["year"] != 3 && values["year"] != 4) {
                empty_fields.push($("#year"));
                $("#year").addClass("border-danger");
                return alertUser("warning", `Year should be 1, 2, 3 or 4`);
            }

            let completed = 0;
            let tables = ["profile_img"];
            $.each(tables, function(i, name) {
                let table = $(`.table-responsive .image-preview-table[data-name='${name}'] tbody`)
                let images = get_preview_imgs(table)
                if (images.length <= 0) {
                    alertUser("warning", `Please upload at least one image for ${name.split('_').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ')}`)
                    return false
                }
                values[`${name}`] = images;
                completed++;
            });

            if (completed < tables.length)
                return;

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