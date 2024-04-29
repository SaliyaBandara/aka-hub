<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("calendar");
$calendar = new CalendarComponent();
?>

<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>

    <div class="main-grid flex">
        <div class="left">

            <!-- section header -->
            <section>

                <div class="section_header mb-1">
                    <!-- <div class="title font-1-5 font-semibold flex align-center mb-2">
                        <i class='bx bxs-calendar-check me-0-5'></i> Calendar Events List
                    </div> -->

                    <div class="title font-2 date-title font-semibold text-center">
                        <?= $data["date"] ?>
                    </div>

                    <style>
                        .main-grid .left {
                            width: 80% !important;
                            /* background-color: yellowgreen; */
                            height: 50vh;
                            padding: 2rem;
                        }

                        .main-grid .right {
                            width: 40% !important;
                        }

                        section {
                            /* max-width: 600px; */
                        }

                        .date-title {
                            font-size: var(--rv-2);
                        }
                    </style>

                    <div class="events-list">
                        <!-- <div class="event">
                            <div class="event-title font-semibold mb-1"><i class="bx bxs-bookmarks me-0-5"></i>
                                Assignment 01
                                is due</div>
                            <div><i class="bx bx-time me-0-5"></i> Wednesday, 10 April, 12:00 AM</div>
                            <div><i class="bx bx-calendar me-0-5"></i> Course Event</div>
                            <div><i class="bx bxs-graduation me-0-5"></i> SCS2017 - Database II</div>
                        </div> -->

                        <?php

                        // print_r($data["items"]);
                        // $data["items"]
                        
                        foreach ($data["items"] as $item) {
                            $date = date_create($item["date"]);
                            $date = date_format($date, "l, d F, h:i A");

                        ?>

                            <div class="event">
                                <div class="event-title font-semibold mb-1"><i class="bx bxs-bookmarks me-0-5"></i>
                                    <?= $item["title"] ?></div>
                                <div><i class="bx bx-time me-0-5"></i> <?= $date ?></div>
                                <div><i class="bx bx-calendar me-0-5"></i> <?= $item["module"] ?></div>
                                <div><i class="bx bxs-graduation me-0-5"></i> <?= $item["description"] ?></div>
                            </div>

                        <?php
                        }

                        ?>

                    </div>

                    <style>
                        .events-list {
                            margin-top: 1.5rem;
                        }

                        .event {
                            /* padding: 1rem; */
                            border: 1px solid #ccc;
                            border-radius: 5px;
                            margin-bottom: 1rem;
                        }

                        .event .event-title {
                            font-size: var(--rv-1-25);
                            background-color: #1264ab47;
                            padding: 1rem;
                        }

                        .event div:not(.event-title) {
                            padding: 0 1rem;
                            margin-top: 0.5rem;
                            font-size: var(--rv-1);
                        }

                        .event div:not(.event-title):last-child {
                            margin-bottom: 1rem;
                        }
                    </style>

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

            </section>

        </div>

        <div class="right flex flex-column align-end">
            <?= $calendar->render(); ?>
        </div>

    </div>

    <?php $HTMLFooter = new HTMLFooter(); ?>
    <script>
        let BASE_URL = "<?= BASE_URL ?>";
    </script>
    <script>
        $(document).ready(function() {

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