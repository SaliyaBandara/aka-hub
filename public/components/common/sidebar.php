<?php

class Sidebar
{

    public function __construct($active_page = null, $role = 0)
    {

        if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == true) {
            $role = $_SESSION["user_role"];
          
            $student_rep = $_SESSION["student_rep"];
            $club_rep = $_SESSION["club_rep"];
            $teaching_student = $_SESSION["teaching_student"];

            $pages = [];
            if ($role == 0) { //student
                $studentPages = [
                    'dashboard' => ['Dashboard', 'bxs-dashboard'],
                    'courses' => ['Courses', 'bxs-book'],
                    'eventFeed' => ['Events', 'bxs-calendar-star'],
                    'counselorFeed' => ['Counselor Articles', 'bxs-donate-heart'],
                    'chat' => ['Forum', 'bxs-chat'],
                    'electionDashboard' => ['Elections', 'bxs-check-square'],
                    'studentProfile' => ['Settings', 'bxs-cog'],
                ];
                $pages = array_merge($pages, $studentPages);
            }

            if ($role == 1) { //admin
                $adminPages = [
                    'adminpanel' => ['Dashboard', 'bxs-dashboard'],
                    'approveRepresentatives' => ['Approvals', 'bxs-home'],
                    'existingCounselors' => ['Counselor Acc', 'bx-body'],
                    'viewlogs' => ['User Logs', 'bxs-dashboard'],
                    'manageMaterials' => ['Manage Materials', 'bxs-book'],
                    'electionsAndPolls' => ['Manage Elections', 'bxs-pie-chart-alt-2'],
                    'feedsSelection' => ['Feeds', 'bxs-dock-left'],
                    'forum' => ['Forum', 'bxs-cog'],
                    'viewUserDistribution' => ['User Distribution', 'bxs-user-circle'],
                    "adminAccesscontrol" => ["Access Control", "bxs-lock-open"],
                ];
                $pages = array_merge($pages, $adminPages);
            }

            if ($role == 3) { //superadmin
                $superAdminPages = [
                    // 'superadminpanel' => ['Dashboard', 'bxs-dashboard'],
                    'adminpanel' => ['Dashboard', 'bxs-dashboard'],
                    'adminAccount' => ['Admin Account', 'bxs-home'],
                    'commonProfile' => ['Admin Profile', 'bxs-home'],
                ];
                $pages = array_merge($pages, $superAdminPages);
            }

            if ($role == 5) { //counselor
                $counselorPages = [
                    'counselorPanel' => ['Counselor Panel', 'bxs-home'],
                    'upcomingReservations' => ['Upcoming Reservations', 'bxs-dashboard'],
                    'reservationRequests' => ['Reservation Requests', 'bxs-user-pin'],
                    'manageTimeSlots' => ['Manage Time Slots', 'bxs-time-five'],
                    'counselorChat' => ['Messages', 'bxs-chat'],
                    'counselorFeed' => ['Counselor Feed', 'bxs-photo-album'],
                ];

                $pages = array_merge($pages, $counselorPages);
            }

            if ($student_rep == 1) { //student-rep
                $studentrepPages = [
                    'elections' => ['Elections', 'bxs-chat'],
                    'approveTeachingStudents' => ['Teaching Students', 'bxs-pen'],
                    'manageMaterials' => ['Materials', 'bxs-book'],
                ];
                $pages = array_merge($pages, $studentrepPages);
            }

            if ($club_rep == 1) { //ClubRep
                $clubrepPages = [
                    'electionsAndPolls' => ['Manage Elections', 'bxs-chat'],
                    'addClubEventsToCalendar' => ['Events to Calendar', 'bxs-home'],
                ];
                $pages = array_merge($pages, $clubrepPages);
            }
            if ($teaching_student == 1) { //teaching student
                $teachingStudentPages = [
                    'manageMaterials' => ['Materials', 'bxs-book'],
                ];
                $pages = array_merge($pages, $teachingStudentPages);
            }
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
                Click <a href="<?= BASE_URL ?>/existingCounselors">here</a>
                to talk with a counselor.
            </div>

            <div class="fixed__bottom">
                <a class="logout" href="<?= BASE_URL ?>/logout">Logout <i class='bx bx-log-out'></i> </a>
            </div>

        </div>

<?php

    }
}
