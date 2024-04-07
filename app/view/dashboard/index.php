<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("dashboard");
$calendar = new Calendar();
?>

<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>

    <div class="main-grid flex">
        <div class="left">
            <a href="<?= BASE_URL ?>/activeElection/index" class="onsite_alert alert-success flex align-center">
                <div>The union election is ongoing......</div>
                <div class="close_btn">
                    <i class='bx bx-x'></i>
                </div>
            </a>


            <!-- section header -->
            <section>
                <div class="section_header mb-1 flex">
                    <div class="title font-1-5 font-semibold flex align-center">
                        <i class='bx bxs-calendar-check me-0-5'></i> To Do List
                    </div>
                </div>

                <!-- todo flex wrap -->
                <div class="todo_flex_wrap flex flex-wrap">

                <?php 
                    foreach ($data["main_events"] as $main_events) {
                    ?>

                    <a href="#" class="todo_item flex align-center">
                    <div>
                        <?php
                        $currentDate = new DateTime();
                        $endDate = new DateTime($main_events["end_date"]);

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
                            }else{
                                echo '<div class="todo_item_date_red flex align-center justify-center">' . $daysRemaining . '</div>';
                            }
                        }

                        
                        // echo ($currentDate <= $endDate && $daysRemaining > 0) ? '<div class="todo_item_date flex align-center justify-center">' . $daysRemaining . '</div>' 
                        //                             : '<div class="todo_item_date_red flex align-center justify-center">' . $daysRemaining . '</div>';

                        ?>
                    </div>

                        <div class="todo_item_text">
                            <div class="font-1-25 font-semibold"><?= $main_events["name"] ?></div>
                            <div class="font-1 font-meidum text-muted"><?= $main_events["title"] ?></div>
                            <div class="font-1 text-muted">Deadline: <?= $main_events["end_date"] ?> </div>
                        </div>
                    </a>
                    <?php } ?>

                </div>

                <style>
                    a{
                        text-decoration: none;
                    }
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

                    .todo_item_date_red {
                        width: 4.5rem;
                        height: 4.5rem;
                        border-radius: 50%;
                        border: 5px solid #FF2400;
                        font-size: 2rem;
                        font-weight: 500;
                    }

                    .todo_item .todo_item_text {
                        margin-left: 1.5rem;
                    }

                    .todo_item .todo_item_text>div {
                        margin-bottom: 0.25rem;
                    }
                </style>


            </section>

        </div>
        <div class="right">
            <div class="calendarContainor">
                <?php echo $calendar->render(); ?>
            </div>
            <div class = "flex-column justify-center align-center divButtonSection">
                <div class = "title font-1-5 font-bold flex align-center justify-center requestDescription">
                    Are you a responsible student representative?
                </div>
                <div href="<?= BASE_URL ?>/Courses/clickToBeRole/student_rep">
                    <div class = "btn btn-primary mb-1 form form-group repRequestButton justify-center align-center">
                        Send Request
                    </div>
                </div>
            </div>
        </div>
        <style>
                    .divButtonSection{
                        border-radius: 10px;
                        margin:1rem;
                        /* border: 1px solid red; */
                        justify-content: center;
                        padding:1rem;
                    }

                    .divButtonSection a{
                        text-decoration:none;
                    }


                    .repRequestButton{
                        border: 1px solid #2684ff;
                        background-color: var(--secondary-color);
                        color: white;
                        width: 100%;
                        text-align:center;
                    }

                    .requestDescription{
                        text-align: center;
                        width : 100%;
                        /* border:1px solid red; */
                        padding-bottom: 1rem;
                        color: black;
                    }
        </style>

    </div>

</div>


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

        $(document).on("click", ".repRequestButton", function() {
            $.ajax({
                url: `${BASE_URL}/Courses/clickToBeRole/student_rep`,
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