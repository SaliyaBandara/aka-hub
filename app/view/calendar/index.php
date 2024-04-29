<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("calendar");
$calendar = new CalendarComponent();
?>

<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>

    <div class="main-grid flex">
        <div class="left w-100">

            <!-- section header -->
            <section>

                <div class="mb-1 form-group">
                    <a href="<?= BASE_URL ?>/calendar/add_edit/0/" class="btn btn-primary">
                        <i class='bx bx-plus'></i> Add Calendar Event
                    </a>
                    <a href="<?= BASE_URL ?>/calendar/parse_timetable" class="btn btn-primary">
                        <i class='bx bx-upload'></i> Upload Exam Timetable
                    </a>
                </div>

                <div class="section_header mb-1 flex">
                    <div class="title font-1-5 font-semibold flex align-center">
                        <i class='bx bxs-calendar-check me-0-5'></i> Calendar Events List
                    </div>
                </div>

                <?php
                // -- calendar table

                // -- is_broadcast
                // --     0 - Personal
                // --     1 - Broadcast

                // -- target
                // --    0 - All
                // --    5 - All Students
                // --      1 - Student - 1st Year
                // --      2 - Student - 2nd Year
                // --      3 - Student - 3rd Year
                // --      4 - Student - 4th Year
                // --    6 - Counsellor

                // CREATE TABLE calendar (
                //     id INT AUTO_INCREMENT PRIMARY KEY,
                //     user_id INT DEFAULT NULL,
                //     is_broadcast TINYINT(1) NOT NULL DEFAULT 0,
                //     target TINYINT(1) NOT NULL DEFAULT 0,
                //     title VARCHAR(255) NOT NULL,
                //     module VARCHAR(255) DEFAULT NULL,
                //     description TEXT DEFAULT NULL,
                //     date DATETIME NOT NULL,
                //     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                //     FOREIGN KEY (user_id) REFERENCES user(id)
                // );
                ?>

                <div class="table-container">
                    <div class="table-responsive">
                        <table class="table table-centered w-100 dt-responsive nowrap data-table" id="products-datatable">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Module</th>
                                    <th>Date</th>
                                    <th>Target</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                if (isset($data["items"]) && is_array($data["items"])) {
                                    $i = 1;
                                    foreach ($data["items"] as $event) {
                                        $event["date"] = date("d M Y H:i", strtotime($event["date"]));
                                        $target = $event["target"];
                                        if ($event["target"] > 0 && $event["target"] < 5)
                                            $target = $target . ['th', 'st', 'nd', 'rd', "th"][$target] . " Year";
                                        if ($event["target"] == 5) $target = "All Students";

                                ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $event["title"] ?></td>
                                            <td><?= $event["module"] ?></td>
                                            <td><?= $event["date"] ?></td>
                                            <td><?= $target ?></td>
                                            <td>
                                                <div class="action-list">
                                                    <!-- <a title="View Event" class="dropdown-item text-secondary" href="<?= BASE_URL ?>/elections/view/<?= $event["id"] ?>"><i class='bx bx-show'></i></a> -->
                                                    <a title="Edit Event" class="dropdown-item" href="<?= BASE_URL ?>/calendar/add_edit/<?= $event["id"] ?>/edit"><i class='bx bx-edit'></i></a>
                                                    <a title="Delete Event" class="dropdown-item delete-item text-danger" data-id="<?= $event["id"] ?>" href="javascript: void(0);"><i class='bx bx-trash'></i></a>
                                                </div>
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

                <style>
                    .table .table-img-preview {
                        width: 70px;
                        cursor: pointer;
                    }

                    .table .action-list a {
                        color: inherit;
                        font-size: 1rem;
                        margin-right: 5px;
                    }

                    .table .action-list {
                        text-align: center;
                    }
                </style>


            </section>

        </div>

        <!-- <div class="right">
            <div style="width: 30vh;"></div>
        </div> -->

    </div>

    <?php $HTMLFooter = new HTMLFooter(); ?>

    <!-- //cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css -->
    <!-- //cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js -->

    <!-- <script src="<?= BASE_URL ?>/public/assets/js/jquery.dataTables.min.js"></script>
    <script src="<?= BASE_URL ?>/public/assets/js/dataTables.js"></script> -->
    <!-- <script src="<?= BASE_URL ?>/public/assets/js/dataTables.responsive.min.js"></script> -->

    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="<?= BASE_URL ?>/public/assets/js/dataTables.responsive.min.js"></script>

    <script>
        let BASE_URL = "<?= BASE_URL ?>";
    </script>
    <script>
        $(document).ready(function() {

            let col_count = $("#products-datatable thead th").length;
            $("#products-datatable").DataTable({
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

            $(document).on("click", ".delete-item", function() {
                let id = $(this).attr("data-id");
                let $this = $(this);

                // confirm delete
                if (!confirm("Are you sure you want to delete this item?"))
                    return;

                $.ajax({
                    url: `${BASE_URL}/calendar/delete/${id}`,
                    type: 'post',
                    data: {
                        delete: true
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response['status'] == 200) {
                            alertUser("success", response['desc'])
                            $this.closest(".todo_item").remove();
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

            $(document).on("click", ".teachingRequestButton", function() {
                $.ajax({
                    url: `${BASE_URL}/Courses/clickToBeRole/teaching_student`,
                    type: 'post',
                    data: {
                        request: true
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response['status'] == 200) {
                            alertUser("success", response['desc'])
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
    <script>

    </script>