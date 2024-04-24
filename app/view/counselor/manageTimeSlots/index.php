<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("counselorManageTimeSlots");
$calendar = new Calendar();
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
                        <p class="p1"><input type="date"> to <input type="date"></p>
                    </div>
                    <div class="manage-time-slots">
                        <a href="#" class="filter-dates">Manage Time Slots</a>
                    </div>
                </div>
            </div>
        </div>    
            

        </div>
        <div class="right">
        </div>
    </div>

    <style>
        .main-grid .left {
            width: 75%;
            height: 150vh;

        }

        .main-grid .right {
            flex-grow: 1;
            height: 150vh;
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
    #sidebar-active {

        margin: 1rem 1rem 1rem calc(var(--sidebar-width-actual) + 0.75rem);
        /* background-color: yellowgreen; */
        width: (100vw - var(--sidebar-width-actual));
        /* height: 50vh; */

        /* border: 2px solid red; */


        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        border-radius: 10px;
        overflow: hidden;
    }
</style>

<?php $HTMLFooter = new HTMLFooter(); ?>
<script>
    let BASE_URL = "<?= BASE_URL ?>";
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get references to the elements
        var startDateInput = document.querySelector('.date-range input[type="date"]:first-child');
        var endDateInput = document.querySelector('.date-range input[type="date"]:last-child');
        var manageTimeSlotsButton = document.querySelector('.filter-dates');

        // Disable the button initially
        manageTimeSlotsButton.disabled = true;

        // Function to check if both dates are selected
        function checkDatesSelected() {
            return startDateInput.value && endDateInput.value;
        }

        // // Function to handle button click
        // function handleManageTimeSlotsClick(event) {
        //     event.preventDefault();

        //     // Redirect only if both dates are selected
        //     if (checkDatesSelected()) {
        //         var startDate = startDateInput.value;
        //         var endDate = endDateInput.value;

        //         // Redirect to the "manageTimeSlots/addTimeSlots" page with dates as parameters
        //         window.location.href = BASE_URL + '/manageTimeSlots/addTimeSlots?start_date=' + startDate + '&end_date=' + endDate;
        //     }
        // }

        // // Event listeners
        // startDateInput.addEventListener('change', function() {
        //     manageTimeSlotsButton.disabled = !checkDatesSelected();
        // });

        // endDateInput.addEventListener('change', function() {
        //     manageTimeSlotsButton.disabled = !checkDatesSelected();
        // });

        // // manageTimeSlotsButton.addEventListener('click', handleManageTimeSlotsClick);

        var filterDates = document.querySelectorAll('.filter-dates');

        filterDates.forEach(function(button) {
            // button.addEventListener('click', function(event) {
            button.addEventListener('click', function(event) {    
                event.preventDefault();
                // Redirect only if both dates are selected
                if (checkDatesSelected()) {
                    var startDate = startDateInput.value;
                    var endDate = endDateInput.value;

                    // Redirect to the "manageTimeSlots/addTimeSlots" page with dates as parameters
                    // window.location.href = BASE_URL + '/manageTimeSlots/addTimeSlots?start_date=' + startDate + '&end_date=' + endDate;
                }
                startDateInput.addEventListener('change', function() {
                    manageTimeSlotsButton.disabled = !checkDatesSelected();
                });

                endDateInput.addEventListener('change', function() {
                    manageTimeSlotsButton.disabled = !checkDatesSelected();
                });

                // var user_id = button.getAttribute('user-id');
                // console.log(startDateInput);
                var xhr = new XMLHttpRequest();
                xhr.open('GET', BASE_URL + '/counselorManageTimeSlots/filterDates' + startDate&endDate, true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        window.location.href = BASE_URL + '/counselorManageTimeSlots/addTimeSlots?start_date=' + startDate + '&end_date=' + endDate;
                    }
                };
                xhr.send();
            });
        });
    });   
</script>