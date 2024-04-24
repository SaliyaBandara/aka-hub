<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("courses");
$calendar = new Calendar();
?>

<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>

    <div class="main-grid flex">
        <div class="left">

            <!-- section header -->
            <section>

                <?php if (($data["teaching_student"] == 1)||($data["student_rep"])) { ?>
                    <div class="mb-1 form-group">
                        <a href="<?= BASE_URL ?>/courses/add_edit/0/create" class="btn btn-primary">
                            <i class='bx bx-plus'></i> Add Course
                        </a>
                    </div>
                <?php } ?>

                <div class="section_header mb-1 flex">
                    <div class="title font-1-5 font-semibold flex align-center">
                        <i class='bx bxs-calendar-check me-0-5'></i> Courses List
                    </div>
                </div>


                <!-- todo flex wrap -->
                <div class="todo_flex_wrap flex flex-wrap">

                    <!-- <a href="#" class="todo_item flex align-center">
                        <div>
                            <div class="todo_item_date flex align-center justify-center">15</div>
                        </div>
                        <div class="todo_item_text">
                            <div class="font-1-25 font-semibold">Computer Networks</div>
                            <div class="font-1 font-medium text-muted">Take Home Assignment</div>
                            <div class="font-0-8 text-muted">Deadline : Tuesday, 10 June</div>
                        </div>
                    </a> -->

                    <?php

                    // (
                    //     [0] => Array
                    //         (
                    //             [id] => 1
                    //             [name] => Computer Networks
                    //             [code] => SCS2206
                    //             [description] => Test Desc
                    //             [cover_img] => course_cover_2023103110401565408c3737aa102280080016987290157030.jpg
                    //             [year] => 2
                    //             [semester] => 1
                    //             [created_at] => 2023-10-31 05:24:24
                    //             [updated_at] => 2023-10-31 05:24:24
                    //         ) 

                    foreach ($data["courses"] as $course) {
                        $img_src = USER_IMG_PATH . $course["cover_img"];
                    ?>

                        <div href="./courses/view/<?= $course["id"] ?>" class="js-link todo_item flex align-center">
                            <div>
                                <div class="todo_item_date flex align-center justify-center">
                                    <img src="<?= $img_src ?>" alt="">
                                </div>
                            </div>
                            <div class="todo_item_text">
                                <div class="font-1-25 font-semibold"><?= $course["name"] ?></div>
                                <div class="font-1 font-medium text-muted"><?= $course["code"] ?></div>
                                <div class="font-0-8 text-muted">Year <?= $course["year"] ?> Semester <?= $course["semester"] ?></div>
                            </div>

                            <?php
                            if (($data["teaching_student"] == 1)||($data["student_rep"])) {
                            ?>

                                <div class="todo_item_actions">
                                    <a href="<?= BASE_URL ?>/courses/add_edit/<?= $course["id"] ?>/edit" class="btn d-block m-1"> <i class='bx bx-edit'></i></a>
                                    <div class="btn delete-item" data-id="<?= $course["id"] ?>">
                                        <i class='bx bx-trash text-danger'></i>
                                    </div>
                                </div>

                            <?php } ?>

                        </div>

                    <?php } ?>

                </div>

                <style>
                    .todo_flex_wrap {
                        /* display: flex;
                        flex-wrap: wrap;
                        justify-content: space-between; */
                    }

                    .todo_item {
                        text-decoration: none;
                        color: initial;

                        width: calc(40% - 2rem);
                        min-width: 300px;
                        padding: 1rem;
                        margin: 1rem;
                        margin-left: 0;
                        margin-top: 0;
                        border-radius: 10px;
                        border: 1px solid #d0d0d0;
                        /* background-color: #f5f5f5; */

                        transition: all 0.3s ease-in-out;
                        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
                    }

                    .todo_item:hover {
                        transform: scale(1.025);
                        background-color: #f5f5f5;
                        background-color: #eeecec;
                        background-color: #bdd2f138;
                    }

                    .todo_item .todo_item_date {
                        width: 4.5rem;
                        height: 4.5rem;
                        border-radius: 50%;
                        border: 5px solid #bdd2f1;
                        font-size: 2rem;
                        font-weight: 500;
                    }

                    .todo_item .todo_item_date img {
                        object-fit: cover;
                        border-radius: 50%;
                    }

                    .todo_item .todo_item_actions {
                        margin-left: 0.5rem;
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        justify-content: center;
                    }

                    .todo_item .todo_item_actions .btn {
                        padding: 0.5rem;
                    }

                    .todo_item .todo_item_text {
                        margin-left: 1.5rem;
                        flex-grow: 1;
                    }

                    .todo_item .todo_item_text>div {
                        margin-bottom: 0.25rem;
                    }
                </style>


            </section>

        </div>

        <div class="right">

            <div class = "flex-column justify-center align-center divButtonSection">
                <div class = "title font-1-5 font-bold flex align-center justify-center requestDescription">
                    Send your request now to join our "Teaching Army" !
                </div>
                <div href="<?= BASE_URL ?>/Courses/clickToBeRole/teaching_student">
                    <div class = "btn btn-primary mb-1 form form-group teachingRequestButton justify-center align-center">
                        Send Request
                    </div>
                </a>
            </div>
        </div>
    </div>

    <style>
        .main-grid {}

        .main-grid .left {
            width: 80% !important;
            /* background-color: yellowgreen; */
            height: 50vh;
            padding: 2rem;
        }

        .main-grid .right {
            width: 40%;
            flex-grow: 1;
            /* background-color: red; */
            height: 150vh;
            /* box-shadow: 0 0 15px rgba(0, 0, 0, 0.1); */
            
        }

        .divButtonSection{
            border-radius: 10px;
            margin:1rem;
            /* border: 1px solid red; */
            justify-content: center;
            padding:1rem;
        }


        .teachingRequestButton{
            border: 1px solid #2684ff;
            background-color: var(--secondary-color);
            color: white;
            width: 100%;
            text-align:center;
            text-decoration: none !important;
        }

        .divButtonSection a{
            text-decoration: none !important;
        }
      
        .requestDescription{
            text-align: center;
            width : 100%;
            /* border:1px solid red; */
            padding-bottom: 1rem;
            color: black;
        }

        .onsite_alert {
            text-decoration: none;
            width: 100%;
            padding: 0.75rem 1rem;
            padding-right: 0;
            background-color: #e5f9e5;
            border-radius: 10px;
            margin-bottom: 1rem;
        }

        .onsite_alert .close_btn {
            margin-left: auto;
            cursor: pointer;
            font-size: var(--rv-1-25);
            padding: 0 1rem;
        }

        .onsite_alert .close_btn:hover {
            color: red;
        }

        .onsite_alert.alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
    </style>

</div>

<?php $HTMLFooter = new HTMLFooter(); ?>
<script>
    let BASE_URL = "<?= BASE_URL ?>";
</script>
<script>
    $(document).ready(function() {
        $(document).on("click", ".delete-item", function() {
            let id = $(this).attr("data-id");
            let $this = $(this);

            // confirm delete
            if (!confirm("Are you sure you want to delete this course?"))
                return;

            $.ajax({
                url: `${BASE_URL}/courses/delete/${id}`,
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