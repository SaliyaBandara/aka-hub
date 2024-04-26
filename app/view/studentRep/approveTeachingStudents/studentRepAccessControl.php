<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("approveTeachingStudents");
$calendar = new Calendar();
?>

<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>

    <div class="main-grid flex">
        <div class="left w-100">

            <!-- section header -->
            <section>
                <div class="section_header mb-1 flex title_bar">
                    <div class="title font-1-5 font-semibold left_side">
                        <i class='bx bxs-calendar-check me-0-5'></i> Access Control of Users and Roles
                    </div>
                </div>

                <div class="table-container">
                    <div class="table-responsive">
                        <table class="table table-centered w-100 dt-responsive nowrap data-table" id="products-datatable">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Uni Email</th>
                                    <th>Reg Number</th>
                                    <th>Rep Type</th>
                                    <th>Action</th>
                                    <th>Preview</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                if (isset($data["accessUsers"])) {
                                    $i = 1;
                                    foreach ($data["accessUsers"] as $card) {

                                        if ($card["teaching_student"] == 1) {
                                        ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td><?= $card["name"] ?></td>
                                                <td><?= $card["email"] ?></td>
                                                <td><?= $card["student_id"] ?></td>
                                                <td>Teaching Student</td>
                                                <td>
                                                    <div class="action-list">
                                                        <a href="<?= BASE_URL ?>/approveRepresentatives/removeAccess/<?= $card["id"] ?>/Teaching_Student" class="removeAccessButtonTeachingStudent"><i class='bx bxs-user-x icons text-danger'></i></a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="<?= BASE_URL ?>/approveRepresentatives/previewAdminAccessControl/<?php echo $card['id']; ?>"><i class='bx bx-show icons text-secondary'></i></a>
                                                </td>
                                            </tr>
                                <?php
                                        }
                                    }
                                }

                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mt-1-5 form-group">
                        <!-- <a href="<?= BASE_URL ?>/clubs" class="btn btn-info">Back</a> -->
                        <a href="<?= BASE_URL ?>/approveTeachingStudents" class="btn btn-info">Back</a>
                    </div>
                <style>
                    .editImageButton a {
                        text-decoration: none;
                    }

                    .editImageButton a input {
                        margin-top: 30px;
                        background-color: #2d7bf4 !important;
                        color: white;
                        border: none;
                        width: 150px;
                        height: 30px;
                        border-radius: 5px;
                        cursor: pointer;
                    }

                    .editImageButton a input:hover {
                        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
                    }
                    .btn-blue {
                        background-color: #2d7bf4;
                        color: white !important;
                    }

                    .btn-orange {
                        background-color: #ff9b2d;
                        color: white !important;
                    }

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

                    .title_bar {
                        flex-direction: row;
                        /* border: 1px solid red; */
                    }

                    .left_side {
                        width: 70%;
                        /* border: 1px solid red; */
                    }

                    .right_side {
                        width: 30%;
                        /* justify-content: center;
                        border: 1px solid red; */
                    }

                    .icons {
                        font-size: 24px;
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

            $(document).on("click", ".removeAccessButtonTeachingStudent", function(event) {
                event.preventDefault();
                let button = $(this);
                let urlParts = $(this).attr("href").split('/');
                let id = urlParts[urlParts.length - 2];
                
                if (!confirm("Are you sure you want to remove access from this user?"))
                    return;

                $.ajax({
                    url: `${BASE_URL}/approveTeachingStudents/removeAccess/${id}/teaching_student`,
                    type: 'post',
                    dataType: 'json',
                    success: function(response) {
                        if (response['status'] == 200) {
                            alertUser("success", `Removed Access successfully.`);
                            button.closest("tr").remove();
                        } else {
                            alertUser("warning", response['desc']);
                        }
                    },
                    error: function(ajaxContext) {
                        alertUser("danger", "Something Went Wrong");
                    }
                });
            });
        });
    </script>
    <script>

    </script>