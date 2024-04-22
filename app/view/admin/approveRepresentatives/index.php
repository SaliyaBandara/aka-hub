<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("approveRepresentatives");
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
                        <i class='bx bxs-calendar-check me-0-5'></i> Approve Student/Club Representatives
                    </div>
                    <div class="approveRepresentativesButtonsLine">
                        <div class="mb-1 form-group right_side">
                            <a href="<?= BASE_URL ?>/approveRepresentatives/adminAccessControlView" class="btn btn-primary">
                                <i class='bx bxs-lock-open'></i> Access Control
                            </a>
                        </div>
                        <div class="mb-1 form-group right_side">
                            <a href="<?= BASE_URL ?>/clubs/index" class="btn btn-primary">
                                <i class='bx bx-show'></i> View Clubs
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

                                if (isset($data["approveRequests"])) {
                                    $i = 1;
                                    foreach ($data["approveRequests"] as $card) {
                                        if ($card['student_rep'] == 2 && $card['club_rep'] == 2) {
                                ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td><?= $card["name"] ?></td>
                                                <td><?= $card["email"] ?></td>
                                                <td><?= $card["student_id"] ?></td>
                                                <td>Student Rep</td>
                                                <td>
                                                    <div class="action-list">
                                                        <a href="<?= BASE_URL ?>/approveRepresentatives/acceptRole/<?= $card["id"] ?>/Student_Rep" class=" repAcceptButonStudentRep"><i class='bx bxs-user-check icons text-success'></i></a>
                                                        <a href="<?= BASE_URL ?>/approveRepresentatives/declineRole/<?= $card["id"] ?>/Student_Rep" class="brepDeclineButonStudentRep"><i class='bx bxs-user-x icons text-danger'></i></a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="<?= BASE_URL ?>/approveRepresentatives/previewRepresentative/<?php echo $card['id']; ?>"><i class='bx bx-show icons text-secondary'></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td><?= $card["name"] ?></td>
                                                <td><?= $card["email"] ?></td>
                                                <td><?= $card["student_id"] ?></td>
                                                <td>Club Rep</td>
                                                <td>
                                                    <div class="action-list">
                                                        <a href="<?= BASE_URL ?>/approveRepresentatives/acceptRole/<?= $card["id"] ?>/Club_Rep" class="repAcceptButonClubRep"><i class='bx bxs-user-check icons text-success'></i></a>
                                                        <a href="<?= BASE_URL ?>/approveRepresentatives/declineRole/<?= $card["id"] ?>/Club_Rep" class="repDeclineButonClubRep"><i class='bx bxs-user-x icons text-danger'></i></a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="<?= BASE_URL ?>/approveRepresentatives/previewRepresentative/<?php echo $card['id']; ?>"><i class='bx bx-show icons text-secondary'></i></a>
                                                </td>
                                            </tr>
                                        <?php
                                        } else {
                                        ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td><?= $card["name"] ?></td>
                                                <td><?= $card["email"] ?></td>
                                                <td><?= $card["student_id"] ?></td>
                                                <td><?php
                                                    if (isset($card['student_rep']) && $card['student_rep'] == 2) {
                                                        echo 'Student Rep';
                                                    } elseif (isset($card['club_rep']) && $card['club_rep'] == 2) {
                                                        echo 'Club Rep';
                                                    }
                                                    ?></td>
                                                <td>
                                                    <div class="action-list">
                                                        <?php
                                                        if (isset($card['student_rep']) && $card['student_rep'] == 2) {
                                                        ?>
                                                            <a href="<?= BASE_URL ?>/approveRepresentatives/acceptRole/<?= $card["id"] ?>/Student_Rep" class="repAcceptButonStudentRep"><i class='bx bxs-user-check icons text-success'></i></a>
                                                        <?php
                                                        } elseif (isset($card['club_rep']) && $card['club_rep'] == 2) {
                                                        ?>
                                                            <a href="<?= BASE_URL ?>/approveRepresentatives/acceptRole/<?= $card["id"] ?>/Club_Rep" class="repAcceptButonClubRep"><i class='bx bxs-user-check icons text-success'></i></a>
                                                        <?php                                                                             } else {
                                                        ?>
                                                            <a href="<?= BASE_URL ?>/approveRepresentatives/acceptRole/<?= $card["id"] ?>/Student_Rep" class="repAcceptButonStudentRep"><i class='bx bxs-user-check icons text-success'></i></a>
                                                        <?php
                                                        }
                                                        if (isset($card['student_rep']) && $card['student_rep'] == 2) {
                                                        ?>
                                                            <a href="<?= BASE_URL ?>/approveRepresentatives/declineRole/<?= $card["id"] ?>/Student_Rep" class="repDeclineButonStudentRep"><i class='bx bxs-user-x icons text-danger'></i></a>
                                                        <?php
                                                        } elseif (isset($card['club_rep']) && $card['club_rep'] == 2) {
                                                        ?>
                                                            <a href="<?= BASE_URL ?>/approveRepresentatives/declineRole/<?= $card["id"] ?>/Club_Rep" class="repDeclineButonClubRep"><i class='bx bxs-user-x icons text-danger'></i></a>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <a href="<?= BASE_URL ?>/approveRepresentatives/declineRole/<?= $card["id"] ?>/Club_Rep" class="repDeclineButonClubRep"><i class='bx bxs-user-x icons text-danger'></i></a>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="<?= BASE_URL ?>/approveRepresentatives/previewRepresentative/<?php echo $card['id']; ?>"><i class='bx bx-show icons text-secondary'></i></a>
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

                    .form-group {
                        width: 45%;
                        display: flex;
                        align-items: center;
                        justify-content: right;
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
            $(document).on("click", ".repAcceptButonStudentRep", function(event) {
                event.preventDefault();
                let button = $(this);
                let urlParts = $(this).attr("href").split('/');
                let id = urlParts[urlParts.length - 2];
                $.ajax({
                    url: `${BASE_URL}/approveRepresentatives/acceptRole/${id}/student_rep`,
                    type: 'post',
                    dataType: 'json',
                    success: function(response) {
                        if (response['status'] == 200) {
                            alertUser("success", `Accepted successfully.`);
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

            $(document).on("click", ".repAcceptButonClubRep", function(event) {
                event.preventDefault();
                let button = $(this);
                let urlParts = $(this).attr("href").split('/');
                let id = urlParts[urlParts.length - 2];
                $.ajax({
                    url: `${BASE_URL}/approveRepresentatives/acceptRole/${id}/club_rep`,
                    type: 'post',
                    dataType: 'json',
                    success: function(response) {
                        if (response['status'] == 200) {
                            alertUser("success", `Accepted successfully.`);
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

            $(document).on("click", ".repDeclineButonStudentRep", function(event) {
                event.preventDefault();
                let button = $(this);
                let urlParts = $(this).attr("href").split('/');
                let id = urlParts[urlParts.length - 2];
                $.ajax({
                    url: `${BASE_URL}/approveRepresentatives/declineRole/${id}/student_rep`,
                    type: 'post',
                    dataType: 'json',
                    success: function(response) {
                        if (response['status'] == 200) {
                            alertUser("success", `Denied successfully.`);
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

            $(document).on("click", ".repDeclineButonClubRep", function(event) {
                event.preventDefault();
                let button = $(this);
                let urlParts = $(this).attr("href").split('/');
                let id = urlParts[urlParts.length - 2];
                $.ajax({
                    url: `${BASE_URL}/approveRepresentatives/declineRole/${id}/club_rep`,
                    type: 'post',
                    dataType: 'json',
                    success: function(response) {
                        if (response['status'] == 200) {
                            alertUser("success", `Denied successfully.`);
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