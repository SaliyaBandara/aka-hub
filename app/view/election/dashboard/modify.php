<?php
$HTMLHead = new HTMLHead($data['title']);
$sidebar = new Sidebar("elections");
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
                <?php

                if (count($data["questions"]) == 0)
                    $data["questions"] = [
                        [
                            "id" => 0,
                            "question" => "",
                            "question_type" => 1,
                            "question_options" => ""
                        ]
                    ];

                if (count($data["questions"]) > 0) {

                    // CREATE TABLE election_questions (
                    //     id INT AUTO_INCREMENT PRIMARY KEY,
                    //     election_id INT NOT NULL,
                    //     question VARCHAR(255) NOT NULL,
                    //     question_type VARCHAR(255) NOT NULL,
                    //     question_options VARCHAR(255) DEFAULT NULL,
                    //     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    //     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    //     FOREIGN KEY (election_id) REFERENCES elections(id)
                    // );

                    foreach ($data["questions"] as $key => $question) {
                        if ($question["question_type"] != 1)
                            $question["question_options"] = json_decode($question["question_options"], true);
                        else {
                            $question["question_options"] = [
                                ["option" => ""]
                            ];
                        }

                ?>

                        <div class="question_item" data-id="<?= $question["id"] ?>">
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
                                    <input type="<?= $value["type"] ?>" id="<?= $key ?>" name="<?= $key ?>" placeholder="Enter <?= $value["label"] ?>" value="<?= $question[$key] ?>" <?= $value["validation"] == "required" ? "data-validation='required'" : "" ?> class="form-control">
                                </div>
                            <?php
                            }
                            ?>

                            <div class="mb-1 form-group">
                                <label for="name" class="form-label">Question Type</label>
                                <select name="question_type" id="question_type" class="form-control" data-validation="required">
                                    <option value="0">Select Question Type</option>
                                    <!-- <option value="1" <?= $question["question_type"] == 1 ? "selected" : "" ?>>Short Answer</option> -->
                                    <option value="2" <?= $question["question_type"] == 2 ? "selected" : "" ?>>Multiple Choice</option>
                                    <option value="3" <?= $question["question_type"] == 3 ? "selected" : "" ?>>Checkboxes</option>
                                    <option value="4" <?= $question["question_type"] == 4 ? "selected" : "" ?>>Dropdown</option>
                                </select>
                            </div>

                            <div <?= $question["question_type"] == 1 ? "style='display: none;'" : "" ?> class="mb-1 form-group options-group">
                                <label for="name" class="form-label">Options</label>

                                <?php
                                foreach ($question["question_options"] as $key => $option) {
                                    // check if cover_img is set
                                    $is_cover_img = isset($option["cover_img"]) ? true : false;
                                    $cover_img = $is_cover_img ? $option["cover_img"] : "";
                                    if($question["question_type"] != 1 && $question["question_type"] != 4 && $is_cover_img)
                                        $cover_img = BASE_URL . "/public/assets/user_uploads/img/" . $option["cover_img"];

                                    // echo $option["cover_img"];
                                ?>
                                    <div class="mt-0-5 mb-1 form-group input-group">
                                        <div class="form-wrapper flex justify-center align-center">
                                            <input type="text" id="option_1" name="option_1" placeholder="Enter Option 1" value="<?= $option["option"] ?>" class="form-control option-text">
                                            <div class="img-upload-btn mx-0-5" data-name="option_1" data-maxFiles="1" data-toggle="tooltip" data-placement="top" title="Upload Image">
                                                <i class="bx bx-image-add"></i>
                                            </div>
                                            <button class='mx-0-25 btn btn-primary btn-add-duplicate' type='button'>+</button>
                                            <button class='btn btn-danger btn-remove-duplicate' type='button'> - </button>
                                        </div>

                                        <div <?= $is_cover_img ? "" : "style='display: none;'" ?>
                                         class="preview-img w-100 my-0-5 <?= $is_cover_img ? "active" : "" ?>"
                                          data-filename="<?= $is_cover_img ? $option["cover_img"] : "" ?>" 
                                          data-fancybox="group" href="<?= $cover_img ?>">
                                            <img src="<?= $cover_img ?>" class="" alt="..">
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>


                            </div>



                        </div>

                <?php
                    }
                }

                ?>

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

                    .question_item .preview-img:not(.active) {
                        display: none !important;
                    }

                    .question_item .close-btn {
                        position: absolute;
                        top: 0.5rem;
                        right: 0.5rem;
                        cursor: pointer;
                    }
                </style>
            </div>

            <div class="mt-1-5 form-group">
                <a href="<?= BASE_URL ?>/elections/dashboard" class="btn btn-info">Back</a>
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
                    imgPreview.addClass("active")
                    imgPreview.find("img").attr("src", imgPath)
                    imgPreview.attr("href", imgPath)
                    imgPreview.attr("data-filename", response['filename'])

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

            // if value == 4 hide .img-upload-btn
            if (value == 4) {
                $(this).closest(".question_item").find(".img-upload-btn").css("display", "none")
                // preview-img slideUp
                $(this).closest(".question_item").find(".preview-img").slideUp(200)
            } else {
                $(this).closest(".question_item").find(".img-upload-btn").css("display", "block")
                $(this).closest(".question_item").find(".preview-img").slideDown(200)

            }


            if (value == 1)
                optionsGroup.slideUp(200)
            else
                optionsGroup.slideDown(200)
        })

        // on click add-question
        $(document).on("click", ".add-question", function() {
            let questionItem = $(".questions_list .question_item").first().clone()
            let previewImg = questionItem.find(".preview-img")

            questionItem.find("input").val("")
            questionItem.find("select").prop('selectedIndex', 0);
            previewImg.css("display", "none");
            questionItem.find(".options-group").css("display", "none");

            // reset preview-img
            previewImg.removeClass("active");
            questionItem.find(".preview-img img").attr("src", "");
            previewImg.attr("data-filename", "");

            // reset options
            questionItem.find(".input-group").not(":first").remove();
            questionItem.attr("data-id", 0)

            // append before .add-question
            $(this).before(questionItem)
        })

        let removed_questions = [];
        // on click .close-btn remove .question_item
        $(document).on("click", ".close-btn", function() {
            let questionItem = $(this).closest(".question_item")
            if ($(".questions_list .question_item").length <= 1)
                return alertUser("warning", `At least one question is required`);

            if (questionItem.attr("data-id") != 0)
                removed_questions.push(questionItem.attr("data-id"))

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
            clone.find(".preview-img").removeClass("active");

            // clear img src and data-filename
            clone.find(".preview-img img").attr("src", "");
            clone.find(".preview-img").attr("data-filename", "");

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

            let is_empty = false;
            if (empty_fields.length > 0) {
                is_empty = true;
                empty_fields[0].focus();
                return alertUser("warning", `Please fill all the fields`);
            }

            let completed = 0;
            let tables = [];
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

            values = {};
            values["questions"] = [];
            let img_status = true;
            // foreach question_item in questions_list
            let questionItems = $(".questions_list .question_item");
            questionItems.each(function(index, questionItem) {
                let question = {};
                // get data-id
                question["id"] = $(questionItem).attr("data-id");
                question["question"] = $(questionItem).find("input[name='question']").val();
                question["question_type"] = $(questionItem).find("select[name='question_type']").val();

                // foreach option-group in question_item
                let optionsGroup = $(questionItem).find(".options-group");
                let options = [];
                optionsGroup.find(".input-group").each(function(index, optionGroup) {
                    let option = {};
                    option["option"] = $(optionGroup).find("input.option-text").val();

                    if (question["question_type"] != 4 && question["question_type"] != 1)
                        option["cover_img"] = $(optionGroup).find(".preview-img.active").attr("data-filename");

                    options.push(option);
                });

                // if question_type is not 1
                if (question["question_type"] != 1)
                    question["options"] = options;

                values["questions"].push(question);
            });

            // append removed_questions to values
            values["removed_questions"] = removed_questions;

            if (is_empty)
                return;

            console.log(values);
            // return;

            $.ajax({
                // url: url,
                type: 'post',
                data: {
                    modify: values
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