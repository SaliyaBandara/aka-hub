<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("home");
$chartOne = new LiveResultsOne();
$chartTwo = new LiveResultsTwo();
?>

<div id="sidebar-active" class="hideScrollbar">
    <div class="welcome-back fixed">
        <div class="flex flex_container">
            <div class="flex_item">
                <div class="title pb-0-5">Welcome back</div>
                <div class="text-muted">Hi Saliya Bandara</div>
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
                <div class="title">Notifications</div>
                <div class="text-muted">Hi Saliya Bandara</div>
            </div>
        </div>
    </div>
    <div class="welcome-back opacity-0 pointer-events-none	">
        <div class="flex flex_container">
            <div class="flex_item">
                <div class="title pb-0-5">Welcome back</div>
                <div class="text-muted">Hi Saliya Bandara</div>
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
                <div class="title">Notifications</div>
                <div class="text-muted">Hi Saliya Bandara</div>
            </div>
        </div>
    </div>

    <style>
        .welcome-back {
            width: calc(100vw - (var(--sidebar-width-actual) + 1.75rem));
            padding: 0.5rem 1rem;
            background-color: var(--off-white);
            border-radius: 10px 10px 0 0;

            /* border bottom */
            border-bottom: 1px solid #e5e5e5;
        }

        .welcome-back:not(.opacity-0) {
            /* box shadow to bottom */
            z-index: 10;
            /* box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1); */
        }

        .welcome-back .flex_container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
        }

        .welcome-back .flex_item {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
        }

        .welcome-back .flex_item.search_flex {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            width: 50%;
            border: 1px solid #e5e5e5;
            border-radius: 10px;
            overflow: hidden;
        }

        .welcome-back .flex_item.search_flex button.btn {
            /* width: 20%; */
            padding: 1rem 1.25rem;
            /* padding-right: 0; */
            margin: 0;

            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f5f5f5;
            border-radius: 10px 0 0 10px;
        }

        .welcome-back .flex_item.search_flex button.btn:hover {
            background-color: #e5e5e5;
            color: var(--primary-color);
        }

        .welcome-back .flex_item.search_flex .form-group {
            width: 100%;
            /* margin-left: 1rem; */
            border: none;
            border-radius: 0 10px 10px 0;
            padding: 1rem 1.25rem;
            padding-left: 0.5rem;
            font-size: 1rem;
            font-weight: 500;
            background-color: #f5f5f5;

            outline: none;
        }

        .welcome-back .flex_item .title {
            font-size: 1.5rem;
            font-weight: 600;
        }
    </style>


    <div class="main-grid flex">
        <div class="left">
            <div id="electionDetails" class="text-center">University of Colombo School of Computing <br />
                Student Union Selection <br />
                2024
            </div>
            <div id="electionTime" class="text-muted text-center">Election ends in : 1hr 30min 4sec</div>

            <div class="threeCardDiv">
                <div class="cardTotalUsers">
                    <div class="divUsersContainor">
                        200 Votes
                    </div>
                </div>
                <div class="cardActiveUsers">
                    <div class="divUsersContainor">
                        350 Eligible Voters
                    </div>
                </div>
            </div>
            <div class="divChartContainor">
                <div class="divChart">
                    <?php echo $chartOne->render(); ?>
                </div>
                <div class="divChart">
                    <?php echo $chartTwo->render(); ?>
                </div>
            </div>
        </div>

        <div class="right"></div>
    </div>

    <style>
        .divChart {
            width: 50%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .main-grid {}

        .divChartContainor {
            width: 100%;
            height: 450px;
            display: flex;
        }

        .threeCardDiv {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 1rem;
            height: 175px;
            z-index: +5;
            color: white;
            padding: 25px;
        }

        .cardTotalUsers {
            width: 27%;
            height: 100%;
            background-color: #2684FF;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            padding: 1rem;
            justify-content: center;
            align-items: center;
            text-align: center;
            display: flex;
            margin-right: 50px;
        }

        .cardTotalUsers:hover {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }

        .cardActiveUsers {
            width: 27%;
            height: 100%;
            background-color: #ff9b2d;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            padding: 1rem;
            justify-content: center;
            align-items: center;
            display: flex;

        }

        .cardActiveUsers:hover {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }

        .cardNewUsers {
            width: 27%;
            height: 100%;
            background-color: #2684FF;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            padding: 1rem;
            justify-content: center;
            align-items: center;
            margin-right: 50px;
            display: flex;
        }

        .cardNewUsers:hover {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }

        .divUsersContainor {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }


        #electionDetails {
            text-align: center;
            font-weight: bold;
        }

        #activeElection {
            padding: 20px;
        }

        #electionTime {
            margin-top: 5px;
            font-size: 14px;
            font-style: italic;
        }

        .main-grid .left {
            width: 100%;
            /* background-color: yellowgreen; */
            height: 800px;
            padding: 2rem;
        }

        .main-grid .right {
            flex-grow: 1;
            background-color: yellowgreen;
            height: 150vh;
        }
    </style>

</div>

<style>
    #sidebar-active {
        color: #0e1111;

        margin: 1rem 1rem 1rem calc(var(--sidebar-width-actual) + 0.75rem);
        /* background-color: yellowgreen; */
        width: (100vw - var(--sidebar-width-actual));
        /* height: 50vh; */

        /* border: 2px solid red; */


        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        border-radius: 10px;
        overflow: hidden;

        max-height: calc(100vh - 2rem);
        overflow: auto;
        /* overflow-y: auto; */

        background-color: var(--off-white);

    }
</style>

<?php $HTMLFooter = new HTMLFooter(); ?>

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

    });
</script>