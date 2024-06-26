<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("counselorReservationRequests");
$calendar = new CalendarComponent();
// $reservationTable = new reservationTable();
?>


<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>
    <div class="main-grid flex">
        <div class="left">
            <div class="threeCardDiv">
                <div class="cardTotalUsers">
                    <?php if ($data["count_accepted_reservations"] !== null) : ?>
                        <div class="divUsersContainor">
                            <?= $data["count_accepted_reservations"] ?> Total Accepted Reservations
                        </div>
                    <?php endif; ?>
                </div>
                <div class="cardActiveUsers">
                    <?php if ($data["count_free_timeslots"] !== null) : ?>
                        <div class="divUsersContainor">
                            <?= $data["count_free_timeslots"] ?> Free Time Slots
                        </div>
                    <?php endif; ?>
                </div>
                <div class="cardNewUsers">
                    <?php if ($data["count_requests"] !== null) : ?>
                        <div class="divUsersContainor">
                            <?= $data["count_requests"] ?> Total Requests
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- ===VIRAJITH=== -->


            <div class="main-container">
                <div class="container1">
                <?php
                // Check if there are reservation requests
                if (empty($data["reservation_requests"])) {
                    echo "<p>NO RESERVATION REQUESTS</p>";
                } else {
                    foreach ($data["reservation_requests"] as $reservation_request) {
                        $img_src = USER_IMG_PATH . "default_avatar.jpg";
                        if ($reservation_request["profile_img"] != null || $reservation_request["profile_img"] != "") {
                            $img_src = USER_IMG_PATH . $reservation_request["profile_img"];
                        }

                ?>
                </div>
                        <div class="wrapper">
                            <div class="card">
                                <div class="content">
                                    <div class="img"><img src="<?= $img_src ?>"></div>
                                    <div class="details">
                                        <span class="name"><?= $reservation_request["name"] ?></span>
                                        <?php
                                        // Assuming $reservation_request["year"] contains the year value (e.g., 1, 2, 3, ...)
                                        $year = $reservation_request["year"];

                                        // Define an array of suffixes
                                        $suffixes = array("st", "nd", "rd");
                                        // Determine the suffix based on the year value
                                        if ($year >= 1 && $year <= 3) {
                                            $suffix = $suffixes[$year - 1];
                                        } else {
                                            $suffix = "th";
                                        }

                                        // Output the formatted string
                                        echo "<p>{$year}{$suffix} year Undergraduate</p>";
                                        ?>
                                    </div>
                                </div>
                                <div id="popup-button">
                                    <a href="#" class="view-button" data-reservation-id="<?= $reservation_request['id'] ?>">View <i class='bx bx-task'></i></a>
                                </div>
                                <!-- <a href="#divone" class="view-button">View</a> -->
                            </div>
                        </div>
                <?php }
                } ?>
            </div>
        </div>
        <div class="new">
            <div class="overlay" id="divone"></div>
            <div class="overlay" id="divtwo"></div>
        </div>

    </div>
</div>
<style>
    .iconModule {
        width: 50px;
        height: 50px;
        background-color: #bdd2f1;
    }

    .divActiveCoursesHeaderPart {
        width: 30%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .divActiveCoursesHeader {
        width: 100%;
        height: 50px;
        display: flex;
        justify-content: space-evenly;
        padding-top: 15px;
    }

    .divActiveCoursesHeader select {
        height: 20px;
        ;
        font-size: 14px;
        border: none;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);

    }

    .todo_flex_wrap {
        display: flex;
        flex-direction: column;
        flex-wrap: wrap;
        justify-content: space-between;
        padding: 20px;
    }

    .todo_item {
        text-decoration: none;
        color: initial;

        width: 31%;
        min-width: 1000px;
        padding: 1rem;
        margin: 1rem;
        margin-left: 0;
        margin-top: 0;
        border-radius: 10px;
        border: 1px solid #d0d0d0;
        /* background-color: #f5f5f5; */

        transition: all 0.3s ease-in-out;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    .todo_item:hover {
        transform: scale(1.025);
        background-color: #f5f5f5;
        background-color: #eeecec;
        background-color: #bdd2f138;
    }

    .todo_item .todo_item_date {
        width: 4.5rem;
        height: 4.5rem;
        border-radius: 50%;
        border: 5px solid #bdd2f1;
        font-size: 2rem;
        font-weight: 500;
    }

    .todo_item .todo_item_text {
        margin-left: 1.5rem;
    }

    .todo_item .todo_item_text>div {
        margin-bottom: 0.25rem;
    }

    .profileButton {
        width: 100px;
        height: 20px;
        background-color: #2684FF;
        border-radius: 5px;
        color: white;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
        border: none;
        font-size: 14px;

    }

    .profileButton:hover {
        cursor: pointer;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    }
</style>


<style>
    .main-grid .left {
        width: 75% !important;
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
        /* margin-bottom: -50px; */
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

    .approveDivContainor {
        width: 100%;
        height: 500px;
    }

    .approveDivContainor h3 {
        text-align: center;
    }

    .main-grid .left {
        width: 100%;
        height: 1150px;
    }

    .main-grid .right {
        flex-grow: 1;
        height: 1000px;
    }
</style>

<style>
    .main-grid {}

    .main-grid .left {
        width: 100%;
        /* background-color: yellowgreen; */
        height: 150vh;
        padding: 2rem;
    }

    .main-grid .right {
        flex-grow: 1;
        background-color: yellowgreen;
        height: 150vh;
    }

    .onsite_alert {
        text-decoration: none;
        width: 100%;
        padding: 0.75rem 1rem;
        padding-right: 0;
        background-color: #e5f9e5;
        border-radius: 10px;
        margin-bottom: 1rem;
    }

    .onsite_alert .close_btn {
        margin-left: auto;
        cursor: pointer;
        font-size: var(--rv-1-25);
        padding: 0 1rem;
    }

    .onsite_alert .close_btn:hover {
        color: red;
    }

    .onsite_alert.alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
    }
</style>

<style>
    .wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        /* height: 100vh;
            z-index: +5;
            margin-top: -100px; */
    }

    .wrapper .card {
        background: #eeecec;
        width: 80%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px;
        position: relative;
        margin-bottom: 20px;
        border-radius: 20px 20px 20px 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
    }

    .card .content {
        display: flex;
        align-items: center;

    }

    .wrapper .card .img {
        height: 90px;
        width: 90px;
        position: absolute;
        left: 2px;
        background: #fff;
        border-radius: 50%;
        padding: 5px;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
    }

    .card .img img {
        height: 100%;
        width: 100%;
        border-radius: 50%;
        object-fit: cover;
    }

    .card .details {
        margin-left: 80px;
    }

    .details span {
        font-weight: 600;
        font-size: 18px;
    }

    .card a {
        text-decoration: none;
        padding: 7px 18px;
        border-radius: 25px;
        color: #fff;
        background: linear-gradient(to bottom, #bea2e7 0%, #86b7e7 100%);
    }

    .card a:hover {
        /* background: linear-gradient(to bottom, #86b7e7 0%, #bea2e7 100%); */
        background: #2684FF;
    }
    .container1 p{
        text-align: center;
        font-size: 20px;
        font-weight: 600;
        color: #333;
        /* justify-self: center; */
        /* justify-content: center; */
    }
</style>
<style>
    .overlay {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.8);
        transition: opacity 500ms;
        visibility: hidden;
        opacity: 0;
        z-index: 9999;
    }

    .overlay:target {
        visibility: visible;
        opacity: 1;
    }
</style>

<?php $HTMLFooter = new HTMLFooter(); ?>
<script>
    let BASE_URL = "<?= BASE_URL ?>";
</script>
<script>
    // JavaScript code to handle AJAX request
    document.addEventListener('DOMContentLoaded', function() {
        var viewButtons = document.querySelectorAll('.view-button');

        viewButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                var reservationId = button.getAttribute('data-reservation-id');
                var xhr = new XMLHttpRequest();
                xhr.open('GET', BASE_URL + '/counselorReservationRequests/view/' + reservationId, true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        var response = xhr.responseText;
                        document.getElementById('divone').innerHTML = response;
                        // set opacity to default
                        document.getElementById('divone').style.opacity = 1;
                        // set visibility to visible
                        document.getElementById('divone').style.visibility = 'visible';
                    }
                };
                xhr.send();
            });
        });
    });

    $(document).on("click", ".accept-request", function(event) {
        event.preventDefault();
        let id = $(this).attr("data-id");
        console.log(id);

        $.ajax({
            url: `${BASE_URL}/counselorReservationRequests/acceptReservation/${id}`,
            type: 'POST',
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 200) {
                    alertUser("success", response['desc'])
                    setTimeout(() => {
                        location.reload();
                    }, 1000);

                } else {
                    alertUser("warning", response['desc'])
                }
            },
            error: function(ajaxContext) {
                alertUser("danger", "Something Went Wrong")
            }
        });
    });

    $(document).on("click", ".decline-request", function(event) {
        event.preventDefault();
        let id = $(this).attr("data-id");
        // console.log(id);

        if (!confirm("Are you sure you want to Decline this Request?"))
            return;

        $.ajax({
            url: `${BASE_URL}/counselorReservationRequests/declineReservation/${id}`,
            type: 'POST',
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 200) {
                    // Load popup form
                    loadPopupForm(id);
                    // Display success message
                    alertUser("success", response['desc']);
                } else {
                    alertUser("warning", response['desc']);
                }
            },
            error: function(ajaxContext) {
                alertUser("danger", "Something Went Wrong");
            }
        });
    });

    let id = 0;

    function loadPopupForm(reservationId) {
        var xhr = new XMLHttpRequest();
        // console.log("reservationId", reservationId);
        xhr.open('GET', BASE_URL + '/counselorReservationRequests/emailPopup/' + reservationId, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = xhr.responseText;
                // console.log("Hello",response);
                id = reservationId;
                // set opacity to default
                document.getElementById('divone').style.opacity = 0;
                //set divone form visibility to hidden
                document.getElementById('divone').style.visibility = 'hidden';
                // Load popup form with email input
                document.getElementById('divtwo').innerHTML = response; 
                // set opacity to default
                document.getElementById('divtwo').style.opacity = 1;
                // set visibility to visible
                document.getElementById('divtwo').style.visibility = 'visible';
            }
        };
        xhr.send();
    }

    $(document).on("click", ".send-email", function(event) {
        event.preventDefault();
        // console.log(id);
        let message = $(".contact-textarea").val();
        console.log(id);

        $.ajax({
            url: `${BASE_URL}/counselorReservationRequests/sendEmail`,
            type: 'POST',
            data: {
                id: id,
                message: message                
            },
            dataType: 'json',
            success: function(response) {
                if (response.status == 200) {
                    // console.log("hello11", response);
                    // Display success message
                    alertUser("success", response['desc']);
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                } else {
                    // console.log("hello2552", response.status);
                    alertUser("warning", response['desc']);
                }
            },
            error: function(ajaxContext) {
                alertUser("danger", "Something Went Wrong");
            }
        });
    });
    
</script>
</div>