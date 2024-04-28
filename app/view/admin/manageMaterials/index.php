<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("manageMaterials");
$calendar = new CalendarComponent();
?>

<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>

    <div class="main-grid flex">
        <div class="left w-100">

            <!-- section header -->
            <section>
                <div class="section_header mb-1 flex">
                    <div class="title font-1-5 font-semibold flex align-center">
                        <i class='bx bxs-calendar-check me-0-5'></i> Manage Materials
                    </div>
                    <div class="approveRepresentativesButtonsLine">
                        <div class="mb-1 form-group right_side">
                            <a href="<?= BASE_URL ?>/manageMaterials/courses" class="btn btn-primary">
                                <i class='bx bxs-book'></i> Manage Courses
                            </a>
                        </div>
                    </div>
                </div>
                <div class="table-container">
                    <div class="table-responsive">
                        <table class="table table-centered w-100 dt-responsive nowrap data-table" id="products-datatable">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Course Code</th>
                                    <th>Subject</th>
                                    <th>Year</th>
                                    <th>Semester</th>
                                    <th>User</th>
                                    <th>Reg Number</th>
                                    <th>Preview</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                if (isset($data["materials"])) {
                                    $i = 1;
                                    foreach ($data["materials"] as $material) {
                                ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $material["course_code"] ?></td>
                                            <td><?= $material["course_name"] ?></td>
                                            <td><?= $material["year"] ?></td>
                                            <td><?= $material["semester"] ?></td>
                                            <td><?= $material["user_name"] ?></td>
                                            <td><?= $material["student_id"] ?></td>
                                            <td>
                                                <a href="<?= BASE_URL ?>/manageMaterials/view/<?php echo $material['material_ID']; ?>"><i class='bx bx-show icons text-secondary'></i></a>
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
                    .section_header {
                        width: 100%;
                        display: flex;
                        justify-content: space-between;
                    }

                    .approveRepresentativesButtonsLine {
                        display: flex;
                        justify-content: right;
                        align-items: center;
                        width: 350px;
                    }

                    .btn-blue {
                        background-color: #2d7bf4;
                        color: white !important;
                    }

                    .table .table-img-preview {
                        width: 70px;
                        cursor: pointer;
                    }

                    /* .table .action-list a {
                        color: inherit;
                        font-size: 24px;
                        margin-right: 5px;
                    } */

                    .icons {
                        font-size: 24px;
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
                pageLength: 5,
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
        });
    </script>
    <script>

    </script>