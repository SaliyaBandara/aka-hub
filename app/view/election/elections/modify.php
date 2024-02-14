<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("courses");
// print_r($data);
?>

<div class="floating-modal floating-upload-modal" style="display: none;">
    <div class="wrapper">
        <div class="mb-1 upload-section">
            <label class="form-label">Insert Image</label>
            <p class="text-muted font-14">
                Upload Image for the option (Maximum 1 image)
            </p>
            <div action="/uploadFiles/img/election_question" data-name="cover_img" data-maxFiles="1" class="dropzone imgDropZone"></div>
        </div>
    </div>
    <div class="bg"></div>
</div>

<style>
    .floating-modal {
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1000;
        width: 100%;
        height: 100%;
        display: none;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .floating-modal .wrapper {
        width: 50%;
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.1);
    }

    .floating-modal .bg {
        cursor: pointer;
        position: fixed;
        top: 0;
        left: 0;
        z-index: -1;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
    }
</style>

<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>
    <div class="my-2 mx-2">
        <h3 class="text-muted">Modify Election</h3>

        <form action="" method="post" class="form">
            <div class="questions_list">
                <div class="question_item">

                    <div class="close-btn text-danger font-1-5">
                        <i class="bx bx-x"></i>
                    </div>


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
                        <label for="name" class="form-label">Question Type</label>
                        <select name="question_type" id="question_type" class="form-control" data-validation="required">
                            <option value="0" disabled>Select Question Type</option>
                            <option value="1" <?= $data["item"]["question_type"] == 1 ? "selected" : "" ?>>Short Answer</option>
                            <option value="2" <?= $data["item"]["question_type"] == 2 ? "selected" : "" ?>>Multiple Choice</option>
                            <option value="3" <?= $data["item"]["question_type"] == 3 ? "selected" : "" ?>>Checkboxes</option>
                            <option value="4" <?= $data["item"]["question_type"] == 4 ? "selected" : "" ?>>Dropdown</option>
                        </select>
                    </div>

                    <div class="mb-1 form-group options-group" style="display: none;">
                        <label for="name" class="form-label">Options</label>

                        <div class="mt-0-5 mb-1 form-group input-group">
                            <div class="form-wrapper flex justify-center align-center">
                                <!-- <label for="name" class="form-label mb-0 me-0-5">Option&nbsp;1</label> -->
                                <input type="text" id="option_1" name="option_1" placeholder="Enter Option 1" value="" class="form-control">
                                <div class="img-upload-btn mx-0-5" data-name="option_1" data-maxFiles="1" data-toggle="tooltip" data-placement="top" title="Upload Image">
                                    <i class="bx bx-image-add"></i>
                                </div>
                                <button class='mx-0-25 btn btn-primary btn-add-duplicate' type='button'>+</button>
                                <button class='btn btn-danger btn-remove-duplicate' type='button'> - </button>
                            </div>

                            <!-- <div class="img-preview w-100 my-0-5" data-fancybox='group' href='<?= BASE_URL ?>/public/assets/user_uploads/img/election_cover_2024020419363765bf99ed2168e01368490017070555971790.png'>
                                <img src="<?= BASE_URL ?>/public/assets/user_uploads/img/election_cover_2024020419363765bf99ed2168e01368490017070555971790.png" alt="..." class="w-100">
                            </div> -->


                            <div style="display: none;" class="preview-img w-100 my-0-5" data-filename="" data-fancybox="group" href="http://127.0.0.1/aka-hub/public/assets/user_uploads/img/election_cover_2024020419363765bf99ed2168e01368490017070555971790.png">
                                <img src="http://127.0.0.1/aka-hub/public/assets/user_uploads/img/election_cover_2024020419363765bf99ed2168e01368490017070555971790.png" class="" alt="..">
                            </div>

                            <!-- <div class="option-img-preview w-100 my-0-5 d-none" data-fancybox='group' href=''> -->
                            <!-- <div class='option-img-preview w-100 my-0-5 d-none' data-filename='' data-fancybox='group' href=''>
                                <img src="" alt="..." class="w-100">
                            </div> -->
                        </div>
                    </div>

                </div>

                <div class="pointer text-center text-muted add-question">+ Add Question</div>

                <style>
                    .question_item {
                        position: relative;
                        border: 1px solid #e0e0e0;
                        border-radius: 5px;
                        padding: 1rem;
                        margin-bottom: 1rem;
                        box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.1);
                    }

                    .question_item .img-upload-btn {
                        font-size: var(--rv-1-25);
                        cursor: pointer;
                    }

                    .question_item .preview-img {
                        width: 40%;
                        cursor: pointer;
                    }

                    .question_item .close-btn {
                        position: absolute;
                        top: 0.5rem;
                        right: 0.5rem;
                        cursor: pointer;
                    }
                </style>
            </div>

            <!-- <div class="mb-1">
                <label class="form-label">Cover Image</label>
                <p class="text-muted font-14">
                    Upload cover image (Maximum 1 image)
                </p>
                <div action="/uploadFiles/img/election_cover" data-name="cover_img" data-maxFiles="1" class="dropzone imgDropZone"></div>
            </div>

            <div class="mb-1">
                <div class="table-responsive">
                    <table <?= ($data['id'] == 0 ? 'style="display: none;"' : "") ?> data-name="cover_img" class="table table-custom2 custom-table table-borderless image-preview-table sortableTable" width="100%" cellspacing="0">
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
                            if ($data['id'] != 0 && !empty($data['item']['cover_img'])) {
                                $img = USER_IMG_PATH . $data['item']['cover_img'];
                            ?>
                                <tr class='ui-sortable-handle'>
                                    <td>
                                        <div class='preview-img preview-img-small' data-filename='<?= $data['item']['cover_img'] ?>' data-fancybox='group' href='<?= $img ?>'>
                                            <img src='<?= $img ?>' class='' alt='..'>
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
            </div> -->

            <div class="mt-1-5 form-group">
                <a href="<?= BASE_URL ?>/elections" class="btn btn-info">Back</a>
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
                    // after 300ms remove file from dropzone
                    setTimeout(() => {
                        myDropzone.removeFile(file);
                    }, 300);
                    // if (++table.find("tbody tr").length > maxFiles)
                    //     return (alertUser("danger", `Maximum number of files reached`));

                    imgCount++;
                    // dropzoneImgs.push([response['filename'], file.name])
                    // dropZoneImgsArr[name].push([response['filename'], file.name])
                    let imgPath = `${BASE_URL}/public/assets/user_uploads/img/${response['filename']}`

                    // append_preview_table(table, imgPath, response['filename'])

                    // get first .img-upload-btn.active find closest form-group and append img-preview
                    let imgPreview = $(`.img-upload-btn.active`).closest(".form-group").find(".preview-img").first()
                    imgPreview.css("display", "block")
                    imgPreview.find("img").attr("src", imgPath)
                    imgPreview.attr("href", imgPath)

                    $(".floating-modal").fadeOut(300);
                    $(".img-upload-btn").removeClass("active")

                    alertUser("success", "Image Uploaded Successfully")
                }
            });
        })

        // on change select[name="question_type"] hide .options-group if value is 1 else show
        $(document).on("change", "select[name='question_type']", function() {
            let value = $(this).val()
            let optionsGroup = $(this).closest(".question_item").find(".options-group")
            if (value == 1)
                optionsGroup.slideUp(200)
            else
                optionsGroup.slideDown(200)
        })

        // on click add-question
        $(document).on("click", ".add-question", function() {
            let questionItem = $(".questions_list .question_item").first().clone()
            questionItem.find("input").val("")
            questionItem.find("select").prop('selectedIndex', 0);
            questionItem.find(".preview-img").css("display", "none");
            questionItem.find(".options-group").css("display", "none");

            // append before .add-question
            $(this).before(questionItem)
        })

        // on click .close-btn remove .question_item
        $(document).on("click", ".close-btn", function() {
            let questionItem = $(this).closest(".question_item")
            if ($(".questions_list .question_item").length <= 1)
                return alertUser("warning", `At least one question is required`);

            questionItem.remove()
        })

        // onclick img-upload-btn open modal floating-upload-modal
        $(document).on("click", ".img-upload-btn", function() {
            let name = $(this).attr("data-name")
            let maxFiles = $(this).attr("data-maxFiles")
            let table = $(`.table-responsive .image-preview-table[data-name='${name}']`)
            let imgDropZone = $(`.floating-upload-modal .imgDropZone[data-name='${name}']`)

            // remove active from .img-upload-btn
            $(".img-upload-btn").removeClass("active")
            $(this).addClass("active")

            $(".floating-modal").fadeIn(300);
        })

        $(document).on("click", ".btn-add-duplicate", function(event) {

            let parent = $(this).closest(".input-group");
            let clone = parent.clone();

            // clear input value
            clone.find("input").val("");
            clone.find(".preview-img").css("display", "none");

            // if the parent of parent has class duplicate_group
            // if (parent.closest(".flex").hasClass("secondary-group"))
            //     clone.find("select").prop('selectedIndex', 0);
            // else
            //     clone.find("input").val("");

            // clone.find(".btn-add-duplicate").remove();

            parent.closest(".options-group").append(clone);
        });

        // btn-remove-duplicate
        $(document).on("click", ".btn-remove-duplicate", function(event) {
            let parent = $(this).closest(".input-group");

            if (parent.closest(".options-group").find("> .input-group").length <= 1)
                return alertUser("warning", `At least one field is required`);

            if (parent.siblings().length > 1 || parent.closest(".options-group").find("> .input-group").length > 1)
                parent.remove();
            else
                alertUser("warning", `At least one field is required`)
        });

        // onclick .floating-modal .bg close modal
        $(document).on("click", ".floating-modal .bg", function() {
            $(".floating-modal").fadeOut(300);
            $(".img-upload-btn").removeClass("active")
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

            if (empty_fields.length > 0) {
                empty_fields[0].focus();
                return alertUser("warning", `Please fill all the fields`);
            }

            let completed = 0;
            let tables = ["cover_img"];
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