<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("elections");
$calendar = new CalendarComponent();
?>

<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>

    <div class="main-grid flex">
        <div class="solo">

            <div>
                <?php if ($data["edit_access"]) { ?>
                    <div class="mx-2 mt-1 form-group">
                        <a href="<?= BASE_URL ?>/elections/dashboard" class="btn btn-primary">
                            <i class='bx bx-show'></i> Election Dashboard
                        </a>
                    </div>
                <?php } ?>
            </div>

            <div class="elections-grid">

                <!-- <a href="./" class="election-item cat_2">
                    <div class="img">
                        <img src="<?= BASE_URL ?>/public/assets/user_uploads/img/election_cover_2024020419363765bf99ed2168e01368490017070555971790.png" alt="">
                    </div>
                    <div class="meta">
                        <div> <i class="bx bx-grid-alt text--primary"></i> Student Union </div>
                        <div> <i class="bx bx-time-five text--primary"></i> 48 Hours </div>
                    </div>
                    <div class="title">Student Union Representative Election</div>
                    <div class="desc">Election for the selection of student union representative for the academic year 2022-2023</div>
                    <div class="end-date">
                        <i class="bx bx-calendar text--primary"></i> 2022-02-28
                    </div>
                </a> -->

                <?php

                if (isset($data["items"]) && is_array($data["items"])) {
                    foreach ($data["items"] as $election) {
                        $election["start_date"] = date("d M Y H:i", strtotime($election["start_date"]));
                        $election["end_date"] = date("d M Y H:i", strtotime($election["end_date"]));

                        // time until end date
                        $time_until_end = strtotime($election["end_date"]) - time();
                        $time_until_end = floor($time_until_end / (60 * 60 * 24)) . " Days " . floor(($time_until_end % (60 * 60 * 24)) / (60 * 60)) . " Hours ";

                        $category = "Club";
                        if ($election["type"] == 1)
                            $category = "Student Union";


                        $end_date = date("jS F Y H:i", strtotime($election["end_date"]));

                ?>

                        <a href="<?= BASE_URL ?>/elections/view/<?= $election["id"] ?>" class="election-item cat_<?= $election["type"] ?>">
                            <div class="img">
                                <img src="<?= BASE_URL ?>/public/assets/user_uploads/img/<?= $election["cover_img"] ?>" alt="">
                            </div>
                            <div class="meta">
                                <div> <i class="bx bx-grid-alt text--primary"></i> <?= $category ?> </div>
                                <div> <i class="bx bx-time-five text--primary"></i> <?= $time_until_end ?> </div>
                            </div>
                            <div class="title"><?= $election["name"] ?></div>
                            <div class="desc"><?= $election["description"] ?></div>
                            <div class="end-date">
                                <i class="bx bx-calendar text--primary"></i> <?= $end_date ?>
                            </div>
                        </a>

                <?php
                    }
                }

                ?>

            </div>

            <style>
                .elections-grid {
                    padding: var(--rv-1);
                    padding-top: var(--rv-0-5);

                    display: flex;
                    flex-wrap: wrap;
                }

                .elections-grid .election-item {
                    position: relative;
                    display: block;
                    text-decoration: none;

                    width: 23%;
                    margin: 1rem 0.5rem;
                    width: calc(25% - (0.5rem * 2));
                    padding: 1.5rem;
                    padding: 1.2vw;

                    /* margin-bottom: 2rem; */
                    border-radius: 20px;
                    overflow: hidden;
                    box-shadow: 0px 18.83px 47.08px rgba(47, 50, 125, 0.1);
                    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
                    transition: all 0.3s ease-in-out;

                    font-size: clamp(12px, 0.9vw, 18px);
                    color: #19191b;
                }

                .elections-grid .election-item>div:not(:last-child) {
                    margin-bottom: var(--rv-0-75);
                }

                .elections-grid .election-item:hover {
                    transform: translateY(-10px);
                }

                .elections-grid .election-item .img {
                    height: 230px;
                    height: clamp(170px, 24vh, 240px);
                    margin-bottom: 1rem;
                }

                .elections-grid .election-item .img img {
                    object-fit: cover;
                    border-radius: 15px;
                }

                .elections-grid .election-item .meta {
                    display: flex;
                    justify-content: space-between;

                    font-size: clamp(11px, 0.8vw, 14px);
                    font-weight: 500;
                }

                .elections-grid .election-item .meta div {
                    display: flex;
                    align-items: center;
                }

                .elections-grid .election-item .meta div i {
                    margin-right: 0.5rem;
                }

                .elections-grid .election-item .title {
                    font-size: clamp(14px, 1.1vw, 20px);
                    font-weight: 600;
                }

                .elections-grid .election-item .desc {
                    display: -webkit-box;
                    -webkit-line-clamp: 4;
                    -webkit-box-orient: vertical;
                    overflow: hidden;
                }
            </style>


        </div>
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