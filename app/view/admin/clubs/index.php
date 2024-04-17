<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("approveRepresentatives");
?>


<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>
    <div class="main-grid flex">
        <div class="left">
            <div class="table-container">
                <div class="section_header mb-1 flex title_bar">
                    <div class="title font-1-5 font-semibold left_side">
                        <i class='bx bxs-calendar-check me-0-5'></i> Clubs and Societies in UCSC
                    </div>
                </div>
                <!-- <div class="left" id="clubFormContainer" style="display: none;">
                    <form action="" method="post" class="form">
                        <h3 class="text-muted"><?= $data["id"] == 0 ? "Add a new Club/Society" : "Edit a Club/Society" ?></h3>
                        <?php
                        foreach ($data["club_template"] as $key => $value) {
                            if (isset($value["skip"]) && $value["skip"] == true)
                                continue;
                            // print_r($data["club"][$key]);
                        ?>
                            <div class="mb-1 form-group">
                                <label for="name" class="form-label">
                                    <?= $value["label"] ?>
                                </label>
                                <input type="<?= $value["type"] ?>" id="<?= $key ?>" name="<?= $key ?>" placeholder="Enter <?= $value["label"] ?>" value="<?= $data["club"][$key] ?>" <?= $value["validation"] == "required" ? "data-validation='required'" : "" ?> class="form-control">
                            </div>
                        <?php
                        }
                        ?>
                        <div class="mt-1-5 form-group">
                            <a href="<?= BASE_URL ?>/clubs" class="btn btn-info">Back</a>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div> -->
                <div class="table-responsive">
                    <table class="table table-centered w-100 dt-responsive nowrap data-table" id="products-datatable">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            if (isset($data["clubs"])) {
                                $i = 1;
                                foreach ($data["clubs"] as $club) {
                            ?>
                                    <tr class = "table_row">
                                        <td><?= $i++ ?></td>
                                        <td><?= $club["name"] ?></td>
                                        <td>
                                            <a class="btn btn-sm btn-blue" href="<?= BASE_URL ?>/clubs/add_edit/<?= $club['id'] ?>"><i class='bx bx-edit'></i></a>
                                            <a class="btn btn-sm btn-blue delete-item" data-id="<?= $club['id'] ?>"><i class='bx bx-trash text-danger'></i></a>
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
        </div>
        <div class="mb-1 form-group right">
            <!-- <a href="<?= BASE_URL ?>/clubs/add_edit/0/" class="btn btn-primary add_button" id="addClubBtn">
                <i class='bx bx-plus'></i>  Add a new Club/Society
            </a> -->
            <div class = "club_add_form">
                <form action="" method="post" class="form">
                    <div class="mb-1 form-group">
                        <label for="name" class="form-label">
                            Club Name
                        </label>
                        <!-- <input type="text" id="<?= $key ?>" name="<?= $key ?>" placeholder="Enter <?= $value["label"] ?>" value="<?= $data["club"][$key] ?>" <?= $value["validation"] == "required" ? "data-validation='required'" : "" ?> class="form-control"> -->
                        <input type="text" id="name" name="name" placeholder="Enter Club Name" value="" data-validation="required" class="form-control">
                    </div>

                    <div class="mt-1-5 form-group">
                        <!-- <a href="<?= BASE_URL ?>/clubs" class="btn btn-info">Back</a> -->
                        <button type="submit" class="btn btn-primary">Add New</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<style>
    .main-grid {
    }

    .main-grid .left {
        width: 70% !important;
        height: 3000px;
        /* border: 1px solid red; */
    }
    .title_bar{
        flex-direction: row;
        /* border: 1px solid red; */
    }

    .left_side{
        width: 50%;
        /* border: 1px solid red; */
    }

    .right{
        justify-content: center;
        /* border: 1px solid red; */
    }

    .right .club_add_form{
        margin: 2rem;
        margin-top: 4rem !important;
    }
</style>

<?php $HTMLFooter = new HTMLFooter(); ?>

<script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="<?= BASE_URL ?>/public/assets/js/dataTables.responsive.min.js"></script>

<script>
    let BASE_URL = "<?= BASE_URL ?>";
</script>

<!-- <script>
    document.getElementById('addClubBtn').addEventListener('click', function() {
        document.getElementById('clubFormContainer').style.display = 'block';
    });

    document.querySelector('#clubFormContainer form').addEventListener('submit', function() {
        document.getElementById('clubFormContainer').style.display = 'none';
    });

    document.querySelector('#clubFormContainer .btn-info').addEventListener('click', function() {
        document.getElementById('clubFormContainer').style.display = 'none';
    });
</script> -->
<!-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Select all elements with the class 'commentsToggle'
        const toggleButtons = document.querySelectorAll(".commentsToggle");

        // Iterate over each toggle button
        toggleButtons.forEach(function(toggleButton) {
            // Add click event listener to each toggle button
            toggleButton.addEventListener("click", function(event) {
                event.preventDefault();
                // Find the corresponding comments section based on the button's parent element
                const commentsSection = toggleButton.closest(".postDetails").nextElementSibling;
                // Toggle the display style of the comments section
                commentsSection.style.display = commentsSection.style.display === "none" ? "block" : "none";
            });
        });
    });

</script> -->
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
            if (!confirm("Are you sure you want to delete this club?"))
                return;

            $.ajax({
                url: `${BASE_URL}/clubs/delete/${id}`,
                type: 'post',
                data: {
                    delete: true
                },
                dataType: 'json',
                success: function(response) {
                    if (response['status'] == 200) {
                        alertUser("success", response['desc'])
                        $this.closest(".table_row").remove();
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

            $.ajax({
                url: `${BASE_URL}/clubs/add_edit/0`,
                type: 'post',
                data: {
                    add_edit: values
                },
                dataType: 'json',
                success: function(response) {
                    if (response['status'] == 200) {
                        alertUser("success", response['desc'])
                        setTimeout(function() {
                            location.reload();
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