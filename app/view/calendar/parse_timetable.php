<?php
$HTMLHead = new HTMLHead($data['title']);
$sidebar = new Sidebar("calendar");
?>

<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>
    <div class="my-2 mx-2">
        <h3 class="text-muted">Automatically Parse Exam Timetable PDF</h3>


        <form action="" method="post" class="form">

            <div class="mb-1 form-element">
                <label class="form-label">Timetable PDF</label>
                <p class="text-muted font-14">
                    Upload the PDF file containing the exam timetable
                </p>
                <div action="/uploadFiles/pdf/exam_timetable" data-name="exam_timetable" data-maxFiles="1" class="dropzone imgDropZone"></div>
            </div>

            <div class="mb-1 form-element">
                <div class="table-responsive">
                    <table style="display: none;" data-name="exam_timetable" class="table table-custom2 custom-table table-borderless image-preview-table sortableTable" width="100%" cellspacing="0">
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
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="table-container" style="opacity: 0;">
                <div class="table-responsive">
                    <table class="table table-centered w-100 dt-responsive nowrap data-table" id="products-datatable">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Subject Name</th>
                                <th>Subject Code</th>
                                <th>Date & Time</th>
                                <th>Venue</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>


            <div class="mt-1-5 form-group form-element">
                <a href="<?= BASE_URL ?>/calendar/" class="btn btn-info">Back</a>
                <button type="submit" class="btn btn-primary">Parse Timetable</button>
            </div>

        </form>

        <style>
            form {
                max-width: unset !important;
            }

            .form-element {
                max-width: 600px;
            }
        </style>

    </div>
</div>

<?php $HTMLFooter = new HTMLFooter(); ?>

<script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="<?= BASE_URL ?>/public/assets/js/dataTables.responsive.min.js"></script>

<script>
    let BASE_URL = "<?= BASE_URL ?>";
</script>
<script>
    "use strict";
    Dropzone.autoDiscover = false;
    $(document).ready(function() {
        let col_count = $("#products-datatable thead th").length;
        let data_table = $("#products-datatable").DataTable({
            language: {
                paginate: {
                    previous: "<i class='mdi mdi-chevron-left'>",
                    next: "<i class='mdi mdi-chevron-right'>",
                },
                info: "Showing records _START_ to _END_ of _TOTAL_",
                lengthMenu: 'Display <select class=\'form-select form-select-sm\'><option value="5">5</option><option value="10">10</option><option value="20">20</option><option value="-1">All</option></select> records',
            },
            responsive: true,
            pageLength: 10,
            columns: Array(col_count).fill({
                orderable: !0
            }),
            select: {
                style: "multi"
            },
            order: [
                [0, "asc"]
            ],
            drawCallback: function() {
                $(".dataTables_paginate > .pagination").addClass("pagination-rounded"),
                    $("#products-datatable_length label").addClass("form-label");
            },
        });


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

        let parsed_table = 0;
        let parsed_data = [];
        $('form').submit(function(event) {
            event.preventDefault();
            var input = $(this);
            var $inputs = $(this).find(':input');


            // let empty_fields = []
            // $inputs.each(function() {
            //     values[this.name] = $(this).val();
            //     if ($(this).attr("data-validation") != undefined && $(this).is("input") && $(this).val() === "" ||
            //         $(this).is("select") && $(this).val() === "0") {
            //         empty_fields.push($(this));
            //         $(this).addClass("border-danger");
            //     } else {
            //         $(this).removeClass("border-danger");
            //     }
            // });

            var values = {};
            let completed = 0;
            let tables = ["exam_timetable"];
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

            if (parsed_table == 0) {
                if (values["exam_timetable"].length <= 0)
                    return alertUser("warning", `Please upload the exam timetable PDF`);

                alertUser("info", "Please wait while we process the PDF file")

                $.ajax({
                    // url: url,
                    type: 'post',
                    data: {
                        parse_pdf: values
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response['status'] == 200) {
                            alertUser("success", response['desc'])
                            parsed_table = 1;
                            parsed_data = response['output'];
                            // console.log(parsed_data)

                            // json parse the data
                            parsed_data = JSON.parse(parsed_data)
                            // console.log(parsed_data)

                            // show table
                            $(".table-container").css("opacity", 1)

                            // set data to table
                            let table = $("#products-datatable tbody")
                            table.empty()
                            $.each(parsed_data, function(i, data) {

                                // check if all the data is set
                                // Subject Name - Subject Code - Date - Time - Venue
                                let table_headers = ["Subject Name", "Subject Code", "Date", "Time", "Venue"]
                                if (Object.keys(data).length != table_headers.length) {
                                    // console.log("Data is missing")
                                    let count_errors = 0
                                    table_headers.forEach(header => {
                                        if (!data.hasOwnProperty(header)) {
                                            if (++count_errors > 1)
                                                return;
                                            data[header] = "-"
                                        }
                                    })

                                    if (count_errors > 1)
                                        return;
                                }

                                // if any val is undefined, set to empty string
                                // check for all header if any is undefined and set to empty string


                                // console.log(data)

                                // if any of the data is empty, skip
                                if (Object.values(data).some(val => val === ""))
                                    return;

                                table_headers.forEach(header => {
                                    if (data[header] == undefined || data[header] == "undefined")
                                        data[header] = ""
                                })

                                // if (data['Venue'] == undefined || data['Venue'] == "undefined")
                                //     data['Venue'] = ""

                                console.log(data['Subject Name'], data['Subject Code'], data['Date'], data['Time'], data['Venue'])

                                data_table.row.add([
                                    i + 1,
                                    data['Subject Name'],
                                    data['Subject Code'],
                                    `${data['Date']} ${data['Time']}`,
                                    data['Venue']
                                ]).draw(false);

                                // let row = `<tr>
                                //     <td>${i+1}</td>
                                //     <td>${data['Subject Name']}</td>
                                //     <td>${data['Subject Code']}</td>
                                //     <td>${data['Date']} ${data['Time']}</td>
                                //     <td>${data['Venue']}</td>
                                // </tr>`
                                // table.append(row)
                            })

                        } else if (response['status'] == 403)
                            alertUser("danger", response['desc'])
                        else
                            alertUser("warning", response['desc'])
                    },
                    error: function(ajaxContext) {
                        alertUser("danger", "Something Went Wrong")
                    }
                })

            } else {
                // alertUser("info", "Please wait while we process the PDF file")

                // send parsed data to server
                $.ajax({
                    // url: url,
                    type: 'post',
                    data: {
                        add_edit: parsed_data
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response['status'] == 200) {
                            alertUser("success", response['desc'])
                            setTimeout(function() {
                                window.location.href = `${BASE_URL}/calendar/`;
                            }, 2000);

                        } else if (response['status'] == 403)
                            alertUser("danger", response['desc'])
                        else
                            alertUser("warning", response['desc'])
                    },
                    error: function(ajaxContext) {
                        alertUser("danger", "Something Went Wrong")
                    }
                })

            }

        });

        // if delete button is clicked reset parsed_table to 0
        $(document).on('click', '.delete-preview-btn', function() {
            parsed_table = 0;
            parsed_data = [];
            // reset table
            data_table.clear().draw();
            $(".table-container").css("opacity", 0)
        })
    });
</script>