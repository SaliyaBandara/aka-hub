<?php

class WelcomeSearch
{

    public function __construct()
    {
        if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == true)
            $user_name = $_SESSION["user_name"];
?>
        <div class="welcome-back fixed noprint">
            <div class="flex flex_container">
                <div class="flex_item">
                    <div class="title pb-0-5">Welcome back</div>
                    <div class="text-muted">Hi <?= "$user_name" ?></div>
                </div>
                <div class="flex_item search_flex">
                    <form class="flex w-100" action="" method="get">
                        <button class="btn" type="submit">
                            <i class='bx bx-search'></i>
                        </button>
                        <input class="form-group" type="text" name="q" id="global-search" placeholder="Search" autocomplete="new-password" />
                        <div class="resultBox" id="global-search-results">
                            <li><i class='bx bx-chat'></i> Blogger</li>
                            <li><i class='bx bxs-graduation'></i> Blogger</li>
                            <li><i class='bx bxs-calendar-star'></i> Blogger</li>
                            <li><i class='bx bxs-book'></i> Blogger</li>
                        </div>
                    </form>
                </div>

                <style>
                    .welcome-back .flex_item.search_flex {
                        overflow: unset;
                    }

                    .search_flex form {
                        position: relative;
                    }

                    .search_flex form .resultBox {
                        position: absolute;
                        top: 100%;
                        left: 0;
                        width: 100%;
                        background: #ffffff;
                        border-radius: 5px;
                        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
                        display: none;
                        z-index: 1000;

                        /* display: block; */
                        margin-top: 0.5rem;
                    }

                    .search_flex form .resultBox.active {
                        display: block;
                    }

                    /* .search_flex .resultBox {
                        padding: 0;
                        opacity: 0;
                        pointer-events: none;
                        max-height: 280px;
                        overflow-y: auto;
                    } */

                    /* .search_flex.active .resultBox {
                        padding: 10px 8px;
                        opacity: 1;
                        pointer-events: auto;
                    } */

                    .resultBox li {
                        list-style: none;
                        padding: 0.75em 1rem;
                        font-size: var(--rv-1);
                        /* display: none; */
                        width: 100%;
                        cursor: default;
                        border-radius: 3px;
                        cursor: pointer;

                        display: flex;
                        align-items: center;
                    }

                    .resultBox li i {
                        margin-right: 0.75rem;
                        color: var(--secondary-color-faded);
                        opacity: 0.8;
                    }

                    .search_flex.active .resultBox li {
                        display: block;
                    }

                    .resultBox li:hover {
                        background: #efefef;
                    }

                    .search_flex .icon {
                        position: absolute;
                        right: 0px;
                        top: 0px;
                        height: 55px;
                        width: 55px;
                        text-align: center;
                        line-height: 55px;
                        font-size: 20px;
                        color: #644bff;
                        cursor: pointer;
                    }
                </style>


                <div class="flex_item">
                    <div class="flex justify-center items-center">
                        <div class="notification-bell">
                            <i class='bx bx-bell'></i>
                            <div class="red-dot"></div>

                            <div class="list__wrapper">

                                <div class="notification-header flex justify-between">
                                    <div>Notifications</div>
                                    <div class="clear-all-btn">Clear All</div>
                                </div>


                                <ul class="pointer" id="notification-list">
                                    <li>
                                        <?php
                                        if (($_SESSION["user_role"] == 1) || ($_SESSION["user_role"] == 3)) {
                                        ?>
                                            <a href="<?= BASE_URL ?>/calendarAdminView">
                                            <?php
                                        } else {
                                            ?>
                                                <a href="<?= BASE_URL ?>/dashboard">
                                                <?php
                                            }
                                                ?>
                                                <span class="notif-icon">
                                                    <i class='bx bx-calendar'></i>
                                                </span>
                                                You have 3 upcoming events
                                                </a>
                                    </li>
                                    <?php
                                    if (($_SESSION["user_role"] == 1) || ($_SESSION["user_role"] == 3)) {
                                    ?>
                                        <li><a href="<?= BASE_URL ?>/calendarAdminView">PDC01: LSEG Tech Talk Session: "Market Surveillance in Financial Markets and AI applications in the domain</a></li>
                                    <?php
                                    } else {
                                    ?>
                                        <li><a href="<?= BASE_URL ?>/dashboard">PDC01: LSEG Tech Talk Session: "Market Surveillance in Financial Markets and AI applications in the domain</a></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div class="profile__pill">
                            <!-- <span>Saliya.B</span> -->

                            <?php
                            $name = $_SESSION["user_name"];
                            $name = explode(" ", $name);
                            $name = $name[0] . "." . (isset($name[1]) ? $name[1][0] : "");
                            ?>

                            <span><?= $name ?></span>


                            <div class="profile__img">
                                <img src="<?= USER_IMG_PATH ?><?= $_SESSION["user_img"] ?>" alt="student profile image">
                            </div>
                            <?php
                            $dashboardController = "dashboard";
                            $profile = "studentProfile";
                            if (($_SESSION["user_role"]) == 1) {
                                $dashboardController = "adminpanel";
                                $profile = "adminProfileAndSettings";
                            } else if (($_SESSION["user_role"]) == 3) {
                                $dashboardController = "adminpanel";
                                $profile = "superAdminProfileAndSettings";
                            } else if (($_SESSION["user_role"]) == 5) {
                                $dashboardController = "counselorPanel";
                                $profile = "counselorSettings";
                            } ?>
                            <div class="list__wrapper">
                                <ul>
                                    <li><a href="<?= BASE_URL . "/" . $dashboardController ?>">Dashboard</a></li>
                                    <li><a href="<?= BASE_URL . "/" . $profile ?>">Profile</a></li>
                                    <li><a href="<?= BASE_URL ?>/logout">Logout</a></li>
                                </ul>
                            </div>

                        </div>
                    </div>

                    <style>
                        .notification-header {
                            margin-top: 0.75rem;
                            padding: 0.75rem 1rem;
                            /* padding-bottom: 0;
                            margin-bottom: 1rem; */
                            color: var(--secondary-color-faded);
                            font-weight: 600;

                            background: #ffffff;
                            border-radius: 5px 5px 0 0;
                        }

                        .notification-header .clear-all-btn {
                            cursor: pointer;
                            text-decoration: underline;
                            font-size: var(--rv-0-75);
                        }

                        .items-center {
                            align-items: center;
                        }

                        .notification-bell {
                            position: relative;
                            cursor: pointer;
                            margin-right: 1rem;
                        }

                        .notification-bell i {
                            font-size: 1.5rem;
                        }

                        .red-dot {
                            position: absolute;
                            top: 1px;
                            right: 1px;
                            width: 10px;
                            height: 10px;
                            background-color: red;
                            border-radius: 50%;
                            border: 2px solid white;
                        }

                        .notification-bell .list__wrapper {
                            padding: 0;
                            margin: 0;
                            z-index: 1000;
                            position: absolute;
                            top: 100%;
                            /* right: 0; */
                            width: 100%;
                            display: none;

                            left: 50%;
                            transform: translate(-50%, 0%);
                        }

                        .notification-bell ul {
                            width: 100%;
                            list-style: none;
                            background: #ffffff;
                            border-radius: 0 0 5px 5px;
                            margin-top: 0 !important;
                            margin: 1rem 0;
                            padding: 0;
                            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
                            /* border: 1px solid #f5f5f5; */
                            /* box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); */
                        }

                        /* .notification-bell .list__wrapper {
                            display: block;
                            width: 320px;
                        } */

                        .notification-bell:hover .list__wrapper {
                            display: block;
                            width: 320px;
                        }

                        .notification-bell ul li a {
                            padding: 0.75rem 1rem;
                            font-size: 14px;
                            font-weight: 500;
                            color: #000000;
                            cursor: pointer;

                            display: flex;
                            align-items: center;
                        }

                        .notification-bell ul li a:hover {
                            background: #f5f5f5;
                        }

                        .notification-bell .notif-icon {
                            margin-right: 0.5rem;
                            display: none;
                        }

                        .notification-bell .notif-icon i {
                            font-size: var(--rv-1);
                        }

                        .notification-bell ul li a {
                            /* display: block; */
                            width: 100%;
                            color: #000000;
                            text-decoration: none;
                        }

                        .notification-bell ul li a:hover {
                            color: #000000;
                            text-decoration: none;
                        }
                    </style>

                </div>
            </div>
        </div>

        <div class="welcome-back opacity-0 pointer-events-none noprint">
            <div class="flex flex_container">
                <div class="flex_item">
                    <div class="title pb-0-5"></div>
                    <div class="text-muted"></div>
                </div>
                <div class="flex_item search_flex">
                    <form class="flex w-100" action="" method="get">
                        <button class="btn" type="submit">
                            <i class='bx bx-search'></i>
                        </button>
                        <input class="form-group" type="text" name="q" id="" placeholder="Search" />
                    </form>
                </div>
                <div class="flex_item">
                    <div class="title"></div>
                    <div class="text-muted"></div>
                </div>
            </div>
        </div>

<?php
    }
}
