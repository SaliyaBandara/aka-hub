<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("manageMaterials");
// print_r($data);
?>

<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>
    <div class="my-2 mx-2">
        <h3 class="text-muted"><?= $data["id"] == 0 ? "Add New Course Materials" : "Edit Course Materials" ?></h3>


        <form action="" method="post" class="form">
            <?php

            foreach ($data["data_template"] as $key => $value) {
                if (isset($value["skip"]) && $value["skip"] == true)
                    continue;
            ?>
                <div class="mb-1 form-group">
                    <label for="name" class="form-label"><?= $value["label"] ?></label>
                    <input type="<?= $value["type"] ?>" id="<?= $key ?>" name="<?= $key ?>" placeholder="Enter <?= $value["label"] ?>" value="<?= $data["material"][$key] ?>" <?= $value["validation"] == "required" ? "data-validation='required'" : "" ?> class="form-control">
                </div>
            <?php
            }
            ?>

            <!-- input group -->
            <div class="mb-1 block-group form-group" id="kuppi_video">
                <div class="block-title">Kuppi Video Links</div>
                <!-- <div class='primary-group input-group mb-1'>
                    <div class="flex mb-0-5">
                        <input name='module_name[]' type='text' class='form-control' placeholder='Module Name' value=''>
                        <button class='mx-0-25 btn btn-primary btn-add-duplicate' type='button'>+</button>
                        <button class='btn btn-danger btn-remove-duplicate' type='button'> - </button>
                    </div>
                    <div class="form-group">
                        <div class='input-group flex mb-0-5 ms-1'>
                            <input name='video_links[]' type="url" class='form-control' placeholder='YouTube Link' value=''>
                            <button class='mx-0-25 btn btn-primary btn-add-duplicate' type='button'>+</button>
                            <button class='btn btn-danger btn-remove-duplicate' type='button'> - </button>
                        </div>
                    </div>
                </div> -->

                <?php

                if ($data['id'] != 0 && !empty($data['material']['video_links'])) {
                    $video_links = json_decode($data['material']['video_links'], true);
                    foreach ($video_links as $key => $value) {
                        $module_name = $value[0];
                        $video_links = $value[1];

                        echo "<div class='primary-group input-group mb-1'>
                            <div class='flex mb-0-5'>
                                <input name='module_name[]' type='text' class='form-control' placeholder='Module Name' value='$value[0]'>
                                <button class='mx-0-25 btn btn-primary btn-add-duplicate' type='button'>+</button>
                                <button class='btn btn-danger btn-remove-duplicate' type='button'> - </button>
                            </div>
                            <div class='form-group'>";

                        foreach ($video_links as $key => $value) {

                            echo "
                                <div class='input-group flex mb-0-5 ms-1'>
                                    <input name='video_links[]' type='url' class='form-control' placeholder='YouTube Link' value='$value'>
                                    <button class='mx-0-25 btn btn-primary btn-add-duplicate' type='button'>+</button>
                                    <button class='btn btn-danger btn-remove-duplicate' type='button'> - </button>
                                </div>";
                        }

                        echo "</div>
                        </div>";
                    }
                } else {
                ?>

                    <div class='primary-group input-group mb-1'>
                        <div class="flex mb-0-5">
                            <input name='module_name[]' type='text' class='form-control' placeholder='Module Name' value=''>
                            <button class='mx-0-25 btn btn-primary btn-add-duplicate' type='button'>+</button>
                            <button class='btn btn-danger btn-remove-duplicate' type='button'> - </button>
                        </div>
                        <div class="form-group">
                            <div class='input-group flex mb-0-5 ms-1'>
                                <input name='video_links[]' type="url" class='form-control' placeholder='YouTube Link' value=''>
                                <button class='mx-0-25 btn btn-primary btn-add-duplicate' type='button'>+</button>
                                <button class='btn btn-danger btn-remove-duplicate' type='button'> - </button>
                            </div>
                        </div>
                    </div>

                <?php } ?>

            </div>

            <style>
                .block-group {
                    /* padding: 1rem; */
                    border: 1px solid var(--secondary-color-faded);
                    border-radius: 15px;
                }

                .block-group .block-title {
                    padding: 0.75rem;
                    border-bottom: 1px solid var(--secondary-color-faded);
                }

                .block-group .primary-group {
                    padding: 0.75rem;
                    margin: 0.75rem;
                    border-radius: 7px;
                    border: 1px solid var(--secondary-color-faded);
                }
            </style>

            <div class="mb-1">
                <label class="form-label">Course Materials</label>
                <p class="text-muted font-14">
                    Upload course materials (Maximum 10 file) (PDF)
                </p>
                <div action="/uploadFiles/pdf/course_materials" data-name="course_materials" data-maxFiles="10" class="dropzone imgDropZone"></div>
            </div>

            <div class="mb-1">
                <div class="table-responsive">
                    <table <?= (($data['id'] == 0 || empty($data['material']['short_notes'])) ? 'style="display: none;"' : "") ?> data-name="course_materials" class="table table-custom2 custom-table table-borderless image-preview-table sortableTable" width="100%" cellspacing="0">
                        <thead class="cent">
                            <tr>
                                <th class="text-center py-1">File</th>
                                <th class="text-center py-1">Action</th>
                            </tr>
                        </thead>
                        <tfoot class="cent">
                            <tr>
                                <th class="text-center py-1">File</th>
                                <th class="text-center py-1">Action</th>
                            </tr>
                        </tfoot>
                        <tbody class="ui-sortable">
                            <?php

                            if ($data['id'] != 0 && !empty($data['material']['short_notes'])) {
                                $short_notes = json_decode($data['material']['short_notes'], true);
                                foreach ($short_notes as $key => $value) {
                                    $img = ASSETS_PATH . "img/common/pdf.png";
                                    $file = USER_PDF_PATH . $value;
                            ?>
                                    <tr class='ui-sortable-handle'>
                                        <td>
                                            <a class='preview-img preview-img-small' data-filename='<?= $value ?>' href='<?= $file ?>' target="_blank">
                                                <img src='<?= $img ?>' class='' alt='..'>
                                            </a>
                                        </td>
                                        <td>
                                            <div title='Delete Image' target='_blank' class='action-icon custom-action-btn delete-preview-btn text-danger font-14'> <i class='mdi mdi-delete'></i> Delete</div>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-1-5 form-group">
                <a href="<?= BASE_URL ?>/manageMaterials" class="btn btn-info">Back</a>
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
                maxFilesize: 10,
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

                    // if pdf show pdf icon
                    let filePath = "";
                    if (response['filename'].split('.').pop() == 'pdf') {
                        // imgPath = `./assets/img/components/pdf.png`
                        // filePath = `./assets/user_uploads_public/`

                        imgPath = `${BASE_URL}/public/assets/img/common/pdf.png`
                        filePath = `${BASE_URL}/public/assets/user_uploads/pdf/`
                    }

                    append_preview_table(table, imgPath, response['filename'], filePath)
                }
            });
        })

        $(document).on("click", ".btn-add-duplicate", function(event) {

            let parent = $(this).closest(".input-group");
            let clone = parent.clone();

            // if the parent of parent has class duplicate_group
            if (parent.closest(".flex").hasClass("secondary-group"))
                clone.find("select").prop('selectedIndex', 0);
            else
                clone.find("input").val("");

            // clone.find(".btn-add-duplicate").remove();

            parent.closest(".form-group").append(clone);
        });

        // btn-remove-duplicate
        $(document).on("click", ".btn-remove-duplicate", function(event) {
            let parent = $(this).closest(".input-group");

            if (parent.closest(".form-group").find("> .input-group").length <= 1)
                return alertUser("warning", `At least one field is required`);

            if (parent.siblings().length > 1 || parent.closest(".form-group").find("> .input-group").length > 1)
                parent.remove();
            else
                alertUser("warning", `At least one field is required`)
        });

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

            let kuppi_video = [];
            $("#kuppi_video>.input-group").each(function() {
                let module_name = $(this).find("input[name='module_name[]']").val();


                let video_links = [];
                $(this).find("input[name='video_links[]']").each(function() {
                    var regex = /(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/watch\?v=|youtu.be\/)([a-zA-Z0-9_-]+)/;
                    var matches = $(this).val().match(regex);
                    console.log(matches);
                    console.log(module_name)
                    console.log(module_name.length)
                    if ($(this).val() != "" && !matches) {
                        empty_fields.push($(this));
                        return alertUser("warning", `Please enter a valid youtube link`);
                    }

                    // if empty
                    if (module_name.length > 0 && $(this).val() == "") {
                        empty_fields.push($(this));
                        return alertUser("warning", `Please enter a youtube link`);
                    }
                    if (matches && $(this).val() != "")
                        video_links.push($(this).val());
                });

                if (video_links.length >= 1 && module_name == "") {
                    console.log(module_name);
                    alertUser("warning", `Please enter a module name`);
                    empty_fields.push($(this));
                }

                if (video_links.length > 0)
                    kuppi_video.push([module_name, video_links]);
            });
            values["kuppi_video"] = kuppi_video;

            if (empty_fields.length > 0) {
                for (let i = 0; i < empty_fields.length; i++) {
                    empty_fields[i].addClass("border-danger");
                }

                empty_fields[0].focus();
                return
            }

            let completed = 0;
            let tables = ["course_materials"];
            $.each(tables, function(i, name) {
                let table = $(`.table-responsive .image-preview-table[data-name='${name}'] tbody`)
                let images = get_preview_imgs(table)
                // if (images.length <= 0) {
                //     alertUser("warning", `Please upload at least one image for ${name.split('_').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ')}`)
                //     return false
                // }
                values[`${name}`] = images;
                completed++;
            });

            if (completed < tables.length)
                return;

            console.log(values["course_materials"].length, values["kuppi_video"].length)
            // if both course_materials and kuppi_video are empty
            if (values["course_materials"].length <= 0 && values["kuppi_video"].length <= 0)
                return alertUser("warning", `Please upload at least one course material or add at least one kuppi video`);
            // console.log(values);
            // return;

            $.ajax({
                //url: url,
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