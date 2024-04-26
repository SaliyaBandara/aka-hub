<?php

class WelcomeSearch
{

    public function __construct()
    {
        if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == true)
            $user_name = $_SESSION["user_name"];
?>
        <div class="welcome-back fixed">
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
                        <input class="form-group" type="text" name="q" id="" placeholder="Search" />
                    </form>
                </div>
                <div class="flex_item">
                    <div class="flex justify-center items-center">
                        <div class="notification-bell">
                            <i class='bx bx-bell'></i>
                            <div class="red-dot"></div>

                            <div class="list__wrapper">
                                <ul>
                                    <li><a href="<?= BASE_URL ?>/dashboard">You have 3 upcoming events</a></li>
                                    <li><a href="<?= BASE_URL ?>/dashboard">PDC01: LSEG Tech Talk Session: "Market Surveillance in Financial Markets and AI applications in the domain</a></li>
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
                            $dashboardController = "";
                            $profile = "";
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
                                    <li><a href="<?= BASE_URL ?><?php $dashboardController ?>">Dashboard</a></li>
                                    <li><a href="<?= BASE_URL ?><?php $profile ?>">Profile</a></li>
                                    <li><a href="<?= BASE_URL ?>/logout">Logout</a></li>
                                </ul>
                            </div><?php
                                    $dashboardController = "";
                                    $profile = "";
                                    if ($_SESSION["user_role"] == 1) {
                                        $dashboardController = "adminpanel";
                                        $profile = "adminProfileAndSettings";
                                    } else if ($_SESSION["user_role"] == 3) {
                                        $dashboardController = "adminpanel";
                                        $profile = "superAdminProfileAndSettings";
                                    } else if ($_SESSION["user_role"] == 5) {
                                        $dashboardController = "counselorPanel";
                                        $profile = "counselorSettings";
                                    } else {
                                        $dashboardController = "dashboard";
                                        $profile = "studentProfile";
                                    }
                                    ?>
                            <div class="list__wrapper">
                                <ul>
                                    <li><a href="<?= BASE_URL ?>/<?= $dashboardController ?>">Dashboard</a></li>
                                    <li><a href="<?= BASE_URL ?>/<?= $profile ?>">Profile</a></li>
                                    <li><a href="<?= BASE_URL ?>/logout">Logout</a></li>
                                </ul>
                            </div>

                        </div>
                    </div>

                    <style>
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
                            border-radius: 5px;
                            margin: 1rem 0;
                            padding: 0;
                            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                        }

                        .notification-bell:hover .list__wrapper {
                            display: block;
                            width: 200px;
                        }

                        .notification-bell ul li a {
                            padding: 0.75rem 1rem;
                            font-size: 14px;
                            font-weight: 500;
                            color: #000000;
                            cursor: pointer;
                        }

                        .notification-bell ul li a:hover {
                            background: #f5f5f5;
                        }

                        .notification-bell ul li a {
                            display: block;
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

        <div class="welcome-back opacity-0 pointer-events-none">
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
