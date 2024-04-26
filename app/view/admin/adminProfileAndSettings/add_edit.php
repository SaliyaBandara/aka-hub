<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("adminProfileAndSettings");
// print_r($data);
?>

<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch();
    ?>
    <div class="my-2 mx-2">
        <h3 class="text-muted">Edit Profile</h3>
        <form action="" method="post" class="form">
            <div class="mb-1 form-group">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="<?= $data["user"]["name"] ?>" placeholder="Enter Name">
            </div>
            <div class="mb-1 form-group">
                <label for="name" class="form-label">Email Address</label>
                <input type="text" id="email" name="email" class="form-control" value="<?= $data["user"]["email"] ?>" disabled placeholder="Enter Email">
            </div>
            <div class="mb-1 form-group">
                <label for="name" class="form-label">Alternative Email Address</label>
                <input type="text" id="alt_email" name="alt_email" class="form-control" value="<?= $data["user"]["alt_email"] ?>" placeholder="Enter Alternative Email">
            </div>
            <?php
            foreach ($data["admin_profile_template"] as $key => $value) {
                if (isset($value["skip"]) && $value["skip"] == true)
                    continue;
            ?>
                <div class="mb-1 form-group">
                    <label for="name" class="form-label"><?= $value["label"] ?></label>
                    <input type="<?= $value["type"] ?>" id="<?= $key ?>" name="<?= $key ?>" placeholder="Enter <?= $value["label"] ?>" value="<?= $data["admin_profile"][$key] ?>" <?= $value["validation"] == "required" ? "data-validation='required'" : "" ?> class="form-control">
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
            <div class="mt-1-5 form-group">
                <a href="<?= BASE_URL ?>/adminProfileAndSettings" class="btn btn-info">Back</a>
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