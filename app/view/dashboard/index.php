<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("dashboard");
$calendar = new CalendarComponent();
?>

<div id="sidebar-active" class="hideScrollbar">
    <?php
    $welcomeSearch = new WelcomeSearch();
    // if(empty($data["main_events"]))
    //     $empty =  true;
    ?>

    <div class="main-grid flex">
        <div class="left">
            <!-- <a href="<?= BASE_URL ?>/activeElection/index" class="onsite_alert alert-success flex align-center">
                <div>The union election is ongoing......</div>
                <div class="close_btn">
                    <i class='bx bx-x'></i>
                </div>
            </a> -->


            <!-- section header -->
            <section class="todo_list">
                <div class="section_header mb-1 flex">
                    <div class="title font-1-5 font-semibold flex align-center">
                        <i class='bx bxs-calendar-check bx-tada me-0-5' ></i> To Do List
                    </div>
                </div>

                <!-- todo flex wrap -->
                <div class="todo_flex_wrap flex flex-wrap">

                    <?php

                    if (empty($data["main_events"])) {
                        echo "<div class='font-medium text-muted'>You don't have any upcoming tasks!</div>";
                    } else {
                        foreach ($data["main_events"] as $main_events) {
                    ?>
                            <div href="" class="todo_item_event flex align-center" data-link=<?= $main_events["id"] ?>>
                                <div>
                                    <?php
                                    $currentDate = new DateTime();
                                    $endDate = new DateTime($main_events["date"]);

                                    $dateDiff = $currentDate->diff($endDate);
                                    $daysRemaining = $dateDiff->days;

                                    // if ($currentDate <= $endDate) {
                                    //     if ($daysRemaining > 0) {
                                    //         echo '<div class="todo_item_date flex align-center justify-center">' . $daysRemaining . '</div>';
                                    //     }
                                    // }
                                    // else {
                                    //     echo '<div class="todo_item_date_red flex align-center justify-center">' . $daysRemaining . '</div>';
                                    // }

                                    if ($currentDate <= $endDate) {
                                        if ($daysRemaining > 0) {
                                            echo '<div class="todo_item_date flex align-center justify-center">' . $daysRemaining . '</div>';
                                        } elseif ($daysRemaining == 0) {
                                            $hoursRemaining = $endDate->diff($currentDate)->h;
                                            echo '<div class="todo_item_date_red flex align-center justify-center">' . $hoursRemaining . 'h</div>';
                                        } else {
                                            echo '<div class="todo_item_date_red flex align-center justify-center">' . $daysRemaining . '</div>';
                                        }
                                    }


                                    // echo ($currentDate <= $endDate && $daysRemaining > 0) ? '<div class="todo_item_date flex align-center justify-center">' . $daysRemaining . '</div>' 
                                    //                             : '<div class="todo_item_date_red flex align-center justify-center">' . $daysRemaining . '</div>';

                                    ?>
                                </div>

                                <div class="todo_item_text">
                                    <div class="font-1-25 font-semibold"><?= $main_events["title"] ?></div>
                                    <div class="font-1 font-meidum text-muted"><?= $main_events["module"] ?></div>
                                    <div class="font-1 text-muted">Deadline: <?= $main_events["date"] ?> </div>
                                </div>
                            </div>
                    <?php }
                    } ?>

                </div>
            </section>
            <section class="recent_list">
                <div class="section_header mb-1 flex">
                    <div class="title font-1-5 font-semibold flex align-center">
                        <i class='bx bx-history bx-tada me-0-5' ></i> Recent Courses
                    </div>
                </div>

                <!-- todo flex wrap -->
                <div class="todo_flex_wrap flex flex-wrap">

                    <?php

                    if (empty($data["courses"])) {
                        echo "<div class='font-medium text-muted'>You don't have recent courses!</div>";
                    } else {
                        foreach ($data["courses"]as $recent) {
                        $img_src = USER_IMG_PATH . $recent["cover_img"];
                        $link = "./courses/view/";
                    ?>
                            <div href="<?= BASE_URL ?>/courses/view/<?=$recent["id"] ?>" class="todo_item_course flex align-center" data-link=<?= $recent["id"] ?>>
                                <div>
                                    <div class="todo_item_date flex align-center justify-center">
                                        <img src="<?= $img_src ?>" alt="">
                                    </div>
                                </div>
                                <div class="todo_item_text" data-id = <?= $link?>>
                                    <div class="font-1-25 font-semibold"><?= $recent["name"] ?></div>
                                    <div class="font-1 font-meidum text-muted"><?= $recent["code"] ?></div>
                                    <div class="font-1 text-muted">Year <?= $recent["year"] ?>  Semester <?= $recent["semester"] ?></div>
                                </div>
                            </div>
                    <?php }
                    } ?>

                </div>
            </section>
        </div>
        <div class="right flex flex-column align-end">

            <?= $calendar->render(); ?>

            <?php if ($_SESSION["user_role"] === 0 && !($_SESSION["student_rep"] === 1)) { ?>
                <div class="flex-column justify-center align-center divButtonSection">
                    <div class="title font-1-5 font-bold flex align-center justify-center requestDescription">
                        Are you a responsible student representative?
                    </div>
                    <div href="<?= BASE_URL ?>/Courses/clickToBeRole/student_rep">
                        <div class="btn btn-primary mb-1 form form-group repRequestButton justify-center align-center text-center">
                            Send Request
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<style>
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

    .todo_list, .recent_list{
        min-height: 200px;
    }

    a {
        text-decoration: none;
    }

    .todo_flex_wrap {
        /* display: flex;
        flex-wrap: wrap;
        justify-content: space-between; */
    }

    .todo_item_event {
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
        cursor: pointer;
    }

    .todo_item_event:hover {
        transform: scale(1.025);
        background-color: #f5f5f5;
        background-color: #eeecec;
        background-color: #bdd2f138;
    }

    .todo_item_event .todo_item_date {
        width: 4.5rem;
        height: 4.5rem;
        border-radius: 50%;
        border: 5px solid #bdd2f1;
        font-size: 2rem;
        font-weight: 500;
    }

    .todo_item_date_red {
        width: 4.5rem;
        height: 4.5rem;
        border-radius: 50%;
        border: 5px solid #FF2400;
        font-size: 2rem;
        font-weight: 500;
    }

    .todo_item_event .todo_item_text {
        margin-left: 1.5rem;
    }

    .todo_item_event .todo_item_text>div {
        margin-bottom: 0.25rem;
    }

    .todo_item_event .todo_item_date {
        width: 4.5rem;
        height: 4.5rem;
        border-radius: 50%;
        border: 5px solid #bdd2f1;
        font-size: 2rem;
        font-weight: 500;
    }

    .todo_item_event .todo_item_date img {
        object-fit: cover;
        border-radius: 50%;
    }

    .todo_item_course {
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
        cursor: pointer;
    }

    .todo_item_course:hover {
        transform: scale(1.025);
        background-color: #f5f5f5;
        background-color: #eeecec;
        background-color: #bdd2f138;
    }

    .todo_item_course .todo_item_date {
        width: 4.5rem;
        height: 4.5rem;
        border-radius: 50%;
        border: 5px solid #bdd2f1;
        font-size: 2rem;
        font-weight: 500;
    }

    .todo_item_date_red {
        width: 4.5rem;
        height: 4.5rem;
        border-radius: 50%;
        border: 5px solid #FF2400;
        font-size: 2rem;
        font-weight: 500;
    }

    .todo_item_course .todo_item_text {
        margin-left: 1.5rem;
    }

    .todo_item_course .todo_item_text>div {
        margin-bottom: 0.25rem;
    }

    .todo_item_course .todo_item_date {
        width: 4.5rem;
        height: 4.5rem;
        border-radius: 50%;
        border: 5px solid #bdd2f1;
        font-size: 2rem;
        font-weight: 500;
    }

    .todo_item_course .todo_item_date img {
        object-fit: cover;
        border-radius: 50%;
    }

    .divButtonSection {
        border-radius: 10px;
        margin: 1rem;
        /* border: 1px solid red; */
        justify-content: center;
        padding: 1rem;
    }

    .divButtonSection a {
        text-decoration: none;
    }

    .requestDescription {
        text-align: center;
        width: 100%;
        /* border:1px solid red; */
        padding-bottom: 1rem;
        color: black;
    }
</style>

<?php $HTMLFooter = new HTMLFooter(); ?>
<script>
    let BASE_URL = "<?= BASE_URL ?>";
</script>
<script>
    $(document).ready(function() {

        $(document).on("click", ".forget-password", function(event) {
            event.preventDefault();
            $('.fixed-model').fadeIn();
            $('body').css('overflow', 'hidden');
        });

        // on click onsite_alert close_btn
        $(document).on("click", ".onsite_alert .close_btn", function(event) {
            event.preventDefault();

            $(this).parent().animate({
                opacity: 0
            }, 300, function() {
                $(this).slideUp(250, function() {
                    $(this).remove();
                });
            });


        });

        $(document).on("click", ".repRequestButton", function(event) {
            event.preventDefault();

            if (!confirm("Are you sure you want to request this role?"))
                return;

            $.ajax({
                url: `${BASE_URL}/courses/clickToBeRole/student_rep`,
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

        $(document).on("click", ".todo_item_event", function() {
            let id = $(this).attr("data-link");
            // $date = strtotime(date);
            window.location.href = BASE_URL + "/dashboard/view/" + id;
        });

        $(document).on("click", ".todo_item_course", function(event) {
            event.preventDefault();

            let course_id = $(this).attr("data-link");
            let link = $('.todo_item_text').attr("data-id");

            $.ajax({
                url: `${BASE_URL}/courses/recentCourses`,
                type: 'post',
                data: {
                    course_id: course_id
                },
                success: function(data) {
                    window.location.href = '<?= $link ?>' + course_id;
                },
                error: function(ajaxContext) {
                    alertUser("danger", "Something Went Wrong");
                }
            });
        });

    });
</script>