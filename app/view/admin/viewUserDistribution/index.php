<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("viewUserDistribution");
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
                        <i class='bx bxs-calendar-check me-0-5'></i> Users in Platform
                    </div>
                </div>

                <div class="table-container">
                    <div class="table-responsive">
                        <table class="table table-centered w-100 dt-responsive nowrap data-table" id="products-datatable">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Reg Number</th>
                                    <th>Preview</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                if (isset($data["users"])) {
                                    $i = 1;
                                    foreach ($data["users"] as $user) {
                                        if ($user["role"] == 1) {
                                            $user["role"] = "Admin";
                                        } else if ($user["role"] == 3) {
                                            $user["role"] = "SuperAdmin";
                                        } else if ($user["role"] == 5) {
                                            $user["role"] = "Counselor";
                                        }
                                ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $user["name"] ?></td>
                                            <td><?= $user["email"] ?></td>
                                            <?php
                                            if ($user["student_id"] == null) {
                                                $user["student_id"] = $user["role"];
                                            } else {
                                                $user["student_id"] = $user["student_id"];
                                            }
                                            ?>
                                            <td><?= $user["student_id"] ?></td>
                                            <td>
                                                <a href="<?= BASE_URL ?>/viewUserDistribution/previewUser/<?php echo $user['id']; ?>"><i class='bx bx-show icons text-secondary'></i></a>
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
                    .btn-blue {
                        background-color: #2d7bf4;
                        color: white !important;
                    }

                    .table .table-img-preview {
                        width: 70px;
                        cursor: pointer;
                    }

                    .table .action-list a {
                        color: inherit;
                        margin-right: 5px;
                    }

                    .icons {
                        font-size: 24px !important;
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