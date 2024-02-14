<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("elections");
$calendar = new Calendar();
?>

<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>

    <div class="main-grid flex">
        <div class="left w-100">

            <!-- section header -->
            <section>

                <?php if ($data["student_rep"]) { ?>
                    <div class="mb-1 form-group">
                        <a href="<?= BASE_URL ?>/elections/add_edit/0/create" class="btn btn-primary">
                            <i class='bx bx-plus'></i> Add Election
                        </a>
                    </div>
                <?php } ?>

                <div class="section_header mb-1 flex">
                    <div class="title font-1-5 font-semibold flex align-center">
                        <i class='bx bxs-calendar-check me-0-5'></i> Elections List
                    </div>
                </div>

                <?php
                // CREATE TABLE elections (
                //     id INT AUTO_INCREMENT PRIMARY KEY,
                //     user_id INT NOT NULL,
                //     name VARCHAR(255) NOT NULL,
                //     start_date DATETIME NOT NULL,
                //     end_date DATETIME NOT NULL,
                //     cover_img VARCHAR(255) DEFAULT NULL,
                //     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                //     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                //     FOREIGN KEY (user_id) REFERENCES user(id)
                // );
                ?>

                <div class="table-container">
                    <div class="table-responsive">
                        <table class="table table-centered w-100 dt-responsive nowrap data-table" id="products-datatable">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Cover Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                if (isset($data["items"])) {
                                    $i = 1;
                                    foreach ($data["items"] as $election) {
                                        $election["start_date"] = date("d M Y H:i", strtotime($election["start_date"]));
                                        $election["end_date"] = date("d M Y H:i", strtotime($election["end_date"]));
                                ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $election["name"] ?></td>
                                            <td><?= $election["start_date"] ?></td>
                                            <td><?= $election["end_date"] ?></td>
                                            <td>
                                                <div class='table-img-preview preview-img preview-img-small' data-filename='<?= $election["cover_img"] ?>' data-fancybox='group' href='<?= USER_IMG_PATH . $election["cover_img"] ?>'>
                                                    <img src='<?= USER_IMG_PATH . $election["cover_img"] ?>' class='' alt='..'>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="action-list">
                                                    <a title="View Election" class="dropdown-item text-secondary" href="<?= BASE_URL ?>/elections/view/<?= $election["id"] ?>"><i class='bx bx-show'></i></a>
                                                    <a title="Modify Election" class="dropdown-item text-muted" href="<?= BASE_URL ?>/elections/modify/<?= $election["id"] ?>"><i class='bx bx-cog'></i></a>
                                                    <a title="Edit Election" class="dropdown-item" href="<?= BASE_URL ?>/elections/add_edit/<?= $election["id"] ?>/edit"><i class='bx bx-edit'></i></a>
                                                    <a title="Delete Election" class="dropdown-item delete-item text-danger" data-id="<?= $election["id"] ?>" href="javascript: void(0);"><i class='bx bx-trash'></i></a>
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
                    url: `${BASE_URL}/elections/delete/${id}`,
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