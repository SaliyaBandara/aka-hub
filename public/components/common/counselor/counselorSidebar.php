<?php

class CounselorSidebar
{

    public function __construct($active_page = null)
    {

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
                            <i class='bx bxs-home'></i> Home</a></li> -->
                    <li><a href="<?= BASE_URL ?>/dashboard">
                            <i class='bx bxs-dashboard'></i> Dashboard</a></li>
                    <li><a href="<?= BASE_URL ?>/courses">
                            <i class='bx bxs-book'></i> Upcoming Reservations</a></li>
                    <li><a href="<?= BASE_URL ?>/chat">
                            <i class='bx bxs-book'></i> Reservation Requests</a></li>
                    <li><a href="<?= BASE_URL ?>/elections">
                            <i class='bx bxs-book'></i> Manage Time-slots</a></li>
                    <li><a href="<?= BASE_URL ?>/settings">
                        <i class='bx bxs-book'></i> Posts</a></li>
                        

                </ul>
            </div>

            <div class="spacer">

            </div>

            <!-- <div class="fixed__bottom">
                Do you need counselor support?
                <a href="http://" target="_blank" rel="noopener noreferrer">Click</a>
                here to talk with a counselor.
            </div> -->

        </div>

        <style>
            #sidebar {
                position: fixed;
                top: 0;
                left: 0;
                width: var(--sidebar-width);
                height: 100vh;
                background-color: #fff;
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
                z-index: 1000;
                padding: 2rem;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                
                margin: 1rem;
                height: calc(100vh - 2rem);
                border-radius: 10px;
            }

            #sidebar .sidebar__logo {
                padding: 0 1rem;
                /* margin-top: 60px; */
                margin-bottom: 1.5rem;
            }

            #sidebar .sidebar__logo img {
                width: 100%;
            }

            #sidebar .sidebar__list ul {
                list-style: none;
                padding: 0;
                margin: 0;
            }

            #sidebar .sidebar__list ul li {
                margin-bottom: 10px;
            }
            
            #sidebar .sidebar__list ul li a {
                display: block;
                color: #000;
                text-decoration: none;
                font-size: var(--rv-1-125);
                font-weight: 500;
                padding: 0.75rem 1.25rem;


                border-radius: 10px;
                transition: all 0.3s ease-in-out;

                /* display: flex;
                align-items: center; */
                
            }
            #sidebar .sidebar__list ul li i {
                margin-right: 0.5rem;
                
            }

            #sidebar .sidebar__list ul li.active a,
            #sidebar .sidebar__list ul li a:hover {
                color: #fff;
                background-color: yellowgreen;
                background-color: #2684FF;

                /* shadow bottom right */
                box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);
            }
            

            #sidebar .fixed__bottom {
                font-size: 0.8rem;
                color: #000;
                text-align: center;
            }

            #sidebar .fixed__bottom a {
                color: #000;
                text-decoration: underline;
            }

            #sidebar .fixed__bottom a:hover {
                color: #000;
            }

            #sidebar .spacer {
                flex-grow: 1;
            }
        </style>






<?php

    }
}
