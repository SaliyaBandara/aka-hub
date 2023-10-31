<?php

class Sidebar
{

    public function __construct($active_page = null, $role = 0)
    {

        if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == true)
            $role = $_SESSION["user_role"];

        if ($role == 0) { //student
            $pages = [
                'dashboard' => ['Dashboard', 'bxs-dashboard'],
                'courses' => ['Courses', 'bxs-book'],
                'chat' => ['Chat', 'bxs-chat'],
                'electionDashboard' => ['Elections', 'bxs-chat'],
                'settings' => ['Settings', 'bxs-cog'],
                'electionsAndPolls' => ['Elections & Polls', 'bxs-pie-chart-alt-2'],
            ];
        } else if ($role == 1) { //admin
            $pages = [
                'adminpanel' => ['Dashboard', 'bxs-dashboard'],
                'approveRepresentatives' => ['Approvals', 'bxs-home'],
                'existingCounselors' => ['Counselor Acc', 'bxs-dashboard'],
                'viewlogs' => ['User Logs', 'bxs-dashboard'],
                'manageStudyMaterials' => ['Materials', 'bxs-book'],
                'electionsAndPolls' => ['Elections & Polls', 'bxs-pie-chart-alt-2'],
                'feedsSelection' => ['Feeds', 'bxs-cog'],
                'forum' => ['Forum', 'bxs-cog'],
                'viewUserDistribution' => ['User Distribution', 'bxs-cog'],
            ];
        } else if ($role == 3) { //superadmin
            $pages = [
                'superadminpanel' => ['Dashboard', 'bxs-dashboard'],
                'adminAccount' => ['Admin Account', 'bxs-home'],
            ];
        } else if ($role == 4) { //student-rep
            $pages = [
                'home' => ['Home', 'bxs-home'],
                'about' => ['About', 'bxs-home'],
            ];
        } else if ($role == 5) { //counselor
            $pages = [
                'dashboard' => ['Dashboard', 'bxs-dashboard'],
                'upcomingReservations' => ['Upcoming Reservation', 'bxs-home'],
                'reservationRequests' => ['Reservation Requests', 'bxs-dashboard'],
                'manageTimeSlots' => ['Time Slots', 'bxs-dashboard'],
                'posts' => ['Posts', 'bxs-dashboard'],
            ];
        }

?>

        <div id="sidebar">
            <div class="sidebar__logo">
                <a href="<?= BASE_URL ?>/">
                    <img src="<?= BASE_URL ?>/public/assets/img/logo/logo.png" alt="logo">
                </a>
            </div>
            <div class="sidebar__list">
                <ul>

                    <!-- <li class="active"><a href="<?= BASE_URL ?>/">
                            <i class='bx bxs-home'></i> Home</a></li>
                    <li><a href="<?= BASE_URL ?>/dashboard">
                            <i class='bx bxs-dashboard'></i> Dashboard</a></li> -->

                    <?php
                    foreach ($pages as $key => $value) {
                        $active = "";
                        if ($key == $active_page)
                            $active = "active";
                        if ($key == "home")
                            $key = "";

                        echo "<li class='$active'><a href='" . BASE_URL . "/$key'><i class='bx " . $value[1] . "'></i> $value[0]</a></li>";
                    }

                    ?>


                </ul>
            </div>

            <div class="spacer">

            </div>

            <div class="fixed__bottom">
                Do you need counselor support?
                <a href="" target="_blank" rel="noopener noreferrer">Click</a>
                here to talk with a counselor.
            </div>

        </div>

<?php

    }
}
