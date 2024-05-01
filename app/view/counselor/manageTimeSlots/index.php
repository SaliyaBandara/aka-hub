<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("counselorManageTimeSlots");
$calendar = new CalendarComponent();
?>

<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>

    <div class="main-grid flex">
        <div class="left">
            <div class="calender-main">
                <div class="calendarContainor">
                    <?php echo $calendar->render(); ?>
                </div>  
                <div class="date-range-picker">
                    <h2>Please select a Date or Date Range</h2>
                    <div class="date-range">
                        <p class="p1"><input type="date" class="start_date"> to <input type="date" class="end_date"></p>
                    </div>
                    <div class="manage-time-slots">
                        <a href="#" class="filter-dates">Manage Time Slots</a>
                    </div>
                </div>
            </div>
        </div>    
            
        <div class="right">
        </div>
    </div>

    <style>
        .main-grid .left {
            width: 85% !important;

        }

        .main-grid .right {
            flex-grow: 1;
        }

        .threeCardDiv {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            height: 175px;
            width: 100%;
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
            margin-left: 50px;
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

    </style>
    <style>
        .calendarContainor{
            justify-content: space-between;
            /* width: 30%; */
            height: 400px;
        }
        .calender-main{
            display: flex;
            justify-content: center;
            align-items: center;
            display: flex;
            flex-direction: column;
            text-align: center;
        }
        .date-range{
            margin-top: 20px;
        }
        .date-range input{
            margin-right: 10px;
            margin-left: 10px;
            width: 40%;
            padding: 8px;
            border-radius: 8px;
            border-style: groove;
            background-color: #fff;
        }
        .manage-time-slots{
            margin-top: 50px;
        }
        .manage-time-slots a{
            text-decoration: none;
            padding: 7px 18px;
            border-radius: 25px;
            color: #fff;
            /* background: linear-gradient(to bottom, #bea2e7 0%, #86b7e7 100%); */
            background-color: #ff9b2d;
        }
        .p1{
            font-size: 18px;
            font-weight: 700;
        }
        h2{
            margin-top: 40px;
        }
    </style>

</div>

<style>
    /* #sidebar-active {

        margin: 1rem 1rem 1rem calc(var(--sidebar-width-actual) + 0.75rem);
        background-color: yellowgreen;
        width: (100vw - var(--sidebar-width-actual));
        height: calc(100vh - 2rem); 
        overflow: hidden !important;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        border-radius: 10px;
    } */
</style>

<?php $HTMLFooter = new HTMLFooter(); ?>
<script>
    let BASE_URL = "<?= BASE_URL ?>";
</script>
<script>
    //this is the working one

    $(document).on("click", ".filter-dates", function() {
        let startDate = $(".start_date").val();
        let endDate = $(".end_date").val();

        if (startDate === "" || endDate === "") {
            alertUser("warning", "Please select both start and end dates");
            return;
        }

        if (startDate > endDate ) {
            alertUser("warning", "Start Date must be before End Date.");
            return;
        }

        // window.location.href = `${BASE_URL}/counselorManageTimeSlots/filterDates/${startDate}/${endDate}`;
        window.location.href = `${BASE_URL}/counselorManageTimeSlots/filterDates/${startDate}/${endDate}`;
    });
</script>