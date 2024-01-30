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
                'electionDashboard' => ['Elections', 'bxs-check-square'],
                'studentProfile' => ['Settings', 'bxs-cog'],
            ];
        } else if ($role == 1) { //admin
            $pages = [
                'adminpanel' => ['Dashboard', 'bxs-dashboard'],
                'approveRepresentatives' => ['Approvals', 'bxs-home'],
                'existingCounselors' => ['Counselor Acc', 'bx-body'],
                'viewlogs' => ['User Logs', 'bxs-dashboard'],
                'manageMaterials' => ['Materials', 'bxs-book'],
                'electionsAndPolls' => ['Elections & Polls', 'bxs-pie-chart-alt-2'],
                'feedsSelection' => ['Feeds', 'bxs-dock-left'],
                'forum' => ['Forum', 'bxs-cog'],
                'viewUserDistribution' => ['User Distribution', 'bxs-user-circle'],
            ];
        } else if ($role == 3) { //superadmin
            $pages = [
                'superadminpanel' => ['Dashboard', 'bxs-dashboard'],
                'adminAccount' => ['Admin Account', 'bxs-home'],
                'commonProfile' => ['Admin Profile', 'bxs-home'],
            ];
        } else if ($role == 4) { //student-rep
            $pages = [
                'dashboard' => ['Dashboard', 'bxs-dashboard'],
                'courses' => ['Courses', 'bxs-book'],
                'chat' => ['Chat', 'bxs-chat'],
                'electionsAndPolls' => ['Elections & Polls', 'bxs-chat'],
                'commonProfile' => ['Settings', 'bxs-cog'],
                'approveTeachingStudents' => ['Approve Kuppi', 'bxs-home'],
                'manageMaterials' => ['Materials', 'bxs-book'],

            ];
        } else if ($role == 5) { //counselor
            $pages = [
                'counselorPanel' => ['Counselor Panel', 'bxs-home'],
                'upcomingReservations' => ['Upcoming Reservation', 'bxs-dashboard'],
                'reservationRequests' => ['Reservation Requests', 'bxs-user-pin'],
                'manageTimeSlots' => ['Manage Time Slots', 'bxs-time-five'],
                'counselorFeed' => ['Counselor Feed', 'bxs-photo-album'],
            ];
        } else if ($role == 6) { //ClubRep
            $pages = [
                'dashboard' => ['Dashboard', 'bxs-dashboard'],
                'courses' => ['Courses', 'bxs-book'],
                'chat' => ['Chat', 'bxs-chat'],
                'electionsAndPolls' => ['Elections & Polls', 'bxs-chat'],
                'commonProfile' => ['Settings', 'bxs-cog'],
                'clubEventFeed' => ['Club Event Feed', 'bxs-home'],
                'addClubEventsToCalendar' => ['Events to Calendar', 'bxs-home'],
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
                Click <a href= "<?= BASE_URL ?>/existingCounselors">here</a>
                to talk with a counselor.
            </div>

            <div class="fixed__bottom">
                <a class="logout" href="./logout">Logout <i class='bx bx-log-out'></i> </a>
            </div>

        </div>

<?php

    }
}
