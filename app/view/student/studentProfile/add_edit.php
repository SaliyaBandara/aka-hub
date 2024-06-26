<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("settings");
// print_r($data);
?>

<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>
    <div class="my-2 mx-2">
        <h3 class="text-muted">Edit Profile</h3>


        <form action="" method="post" class="form">
            <div class="mb-1 form-group">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="<?= $data["user"]["name"] ?>">
            </div>
            <div class="mb-1 form-group">
                <label for="name" class="form-label">Email Address</label>
                <input type="text" id="email" name="email" class="form-control" value="<?= $data["user"]["email"] ?>" disabled>
            </div>
            <div class="mb-1 form-group">
                <label for="name" class="form-label">Registration Number</label>
                <input type="text" id="student_id" name="student_id" class="form-control" value="<?= $data["user"]["student_id"] ?>" disabled>
            </div>
            <div class="mb-1 form-group">
                <label for="name" class="form-label">Alternative Email Address</label>
                <input type="text" id="alt_email" name="alt_email" class="form-control" value="<?= $data["user"]["alt_email"] ?>">
            </div>

            <div class="mb-1 form-group">
                <label for="name" class="form-label">Student ID</label>
                <input type="text" id="index_number" name="index_number" class="form-control" value="<?= $data["student_profile"]["index_number"] ?>">
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

            <div class="mb-1">
                <label class="form-label">Profile Image</label>
                <p class="text-muted font-14">
                    Upload profile image (Maximum 1 image)
                </p>
                <div action="/uploadFiles/img/profile_img" data-name="profile_img" data-maxFiles="1" class="dropzone imgDropZone"></div>
            </div>

            <div class="mb-1">
                <div class="table-responsive">
                    <table <?= ($data["user"]['id'] == 0 ? 'style="display: none;"' : "") ?> data-name="profile_img" class="table table-custom2 custom-table table-borderless image-preview-table sortableTable" width="100%" cellspacing="0">
                        <thead class="cent">
                            <tr>
                                <th class="text-center py-1">Image</th>
                                <th class="text-center py-1">Action</th>
                            </tr>
                        </thead>
                        <tfoot class="cent">
                            <tr>
                                <th class="text-center py-1">Image</th>
                                <th class="text-center py-1">Action</th>
                            </tr>
                        </tfoot>
                        <tbody class="ui-sortable">
                            <?php
                            if ($data["user"]['id'] != 0 && !empty($data["user"]['profile_img'])) {
                                $img_src = USER_IMG_PATH . $data["user"]["profile_img"];
                            ?>
                                <tr class='ui-sortable-handle'>
                                    <td>
                                        <div class='preview-img preview-img-small' data-filename='<?= $data["user"]['profile_img'] ?>' data-fancybox='group' href='<?= $img_src ?>'>
                                            <img src='<?= $img_src ?>' class='' alt='..'>
                                        </div>
                                    </td>
                                    <td>
                                        <div title='Delete Image' target='_blank' class='action-icon custom-action-btn delete-preview-btn text-danger font-14'> <i class='mdi mdi-delete'></i> Delete</div>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

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
        let imgCount = 0;
        let dropZoneImgsArr = [];
        $('.dropzone.imgDropZone').each(function() {
            let dropZonePath = $(this).attr('action')
            let maxFiles = $(this).attr('data-maxFiles')
            let name = $(this).attr('data-name')
            let table = $(`.table-responsive .image-preview-table[data-name='${name}']`)

            dropZoneImgsArr[name] = [];
            dropZonePath = `${BASE_URL}${dropZonePath}`

            let myDropzone = new Dropzone(this, {
                url: dropZonePath,
                parallelUploads: 1,
                thumbnailHeight: 120,
                thumbnailWidth: 120,
                maxFilesize: 3,
                // maxFiles: 3,
                filesizeBase: 1000,
                addRemoveLinks: true,
                init: function() {
                    this.on('addedfile', function(file) {
                        if (++table.find("tbody tr").length > maxFiles) {
                            alertUser("danger", `Only ${maxFiles} file(s) are allowed`)
                            this.removeFile(this.files[0]);
                        }

                    });
                },
                success: function(file, response) {
                    myDropzone.removeFile(file);
                    if (++table.find("tbody tr").length > maxFiles)
                        return (alertUser("danger", `Maximum number of files reached`));

                    imgCount++;
                    // dropzoneImgs.push([response['filename'], file.name])
                    dropZoneImgsArr[name].push([response['filename'], file.name])
                    let imgPath = `${BASE_URL}/public/assets/user_uploads/img/${response['filename']}`

                    append_preview_table(table, imgPath, response['filename'])
                }
            });
        })


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

            var digitsRegex = /^\d+$/;
            if (!digitsRegex.test(values["index_number"])) {
                $("#index_number").addClass("border-danger");
                return alertUser("warning", "Index number can only contain digits");
            }

            if(values["index_number"].length > 8){
                $("#index_number").addClass("border-danger");
                alertUser("warning", `Index number cannot be more than 8 digits`);
                return;
            }

            if(values["index_number"] == ""){
                $("#index_number").addClass("border-danger");
                alertUser("warning", `Index number cannot be blank`);
                return;
            }

            var indexDigits = values["index_number"].substring(4, 7);

            var regNumber = values["student_id"];
            var lastDigits = regNumber.substring(regNumber.lastIndexOf("/") + 1);

            if (indexDigits !== lastDigits) {
                $("#index_number").addClass("border-danger");
                return alertUser("warning", "The index number should match with the registration number");
                $("#index_number").removeClass("border-danger"); 
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