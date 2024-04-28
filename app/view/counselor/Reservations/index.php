<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("counselorReservations");
$calendar = new CalendarComponent();
// $reservationTable = new reservationTable();
?>


<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>
    <div class="main-grid flex">
        <div class="left">
           
            <!-- ===VIRAJITH=== -->
            <div class="main-container">
                <?php
                if (empty($data["reservation_requests"])) {
                    echo "<p>NO RESERVATIONS AVAILABLE</p>";
                } else {
                        //sorting function to sort reservation requests by date and time
                        function sortByDateTime($a, $b) {
                            // Compare reservation dates
                            $dateComparison = strcmp($a["date"], $b["date"]);
                            if ($dateComparison != 0) {
                                return $dateComparison;
                            }
                            
                            // If reservation dates are equal, compare start times
                            return strcmp($a["start_time"], $b["start_time"]);
                        }
        
                        // Sort the reservation requests array using the custom sorting function
                        usort($data["reservation_requests"], 'sortByDateTime');
                        
                        foreach ($data["reservation_requests"] as $reservation_requests) {
                            $img_src = USER_IMG_PATH . "default_avatar.jpg";
                            if ($reservation_requests["profile_img"] != null || $reservation_requests["profile_img"] != "") {
                                $img_src = USER_IMG_PATH . $reservation_requests["profile_img"];
                            }
                        
                ?>
                    
                    <div class="card-content">
                        <div class="card">
                            <div class="image-content">
                                <span class="overlay1"></span>

                                <div class="card-image">
                                    <img src="<?= $img_src ?>" alt="" class="card-img">
                                </div>
                            </div>
                            <div class="card-content">
                                <h2 class="name"><?= $reservation_requests["name"] ?></h2>
                                <label class="description">Date: <?= date("Y/m/d", strtotime($reservation_requests["date"])) ?></label>
                                <label class="description">Time Slot: <?= date("H:i", strtotime($reservation_requests["start_time"])) ?> to <?= date("H:i", strtotime($reservation_requests["end_time"])) ?></label>
                                <button class="button button-completed" data-id="<?= $reservation_requests["id"] ?>">Completed <i class='bx bxs-user-check'></i></button>
                                <button class="button button-cancel" data-id="<?= $reservation_requests["id"] ?>">Cancel <i class='bx bxs-user-x'></i></button>
                            </div>
                        </div>
                    </div>
                   
                <?php }} ?>
            </div>
            <div class="new">
                <div class="overlay" id="divone"></div>
            </div>
            

            
        </div>
    </div>
    <style>
        .iconModule{
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
            justify-content : space-evenly;
            padding-top: 15px;
        }

        .divActiveCoursesHeader select{
            height : 20px;;
            font-size : 14px;
            border : none;
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

        .profileButton{
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
            border : none;
            font-size : 14px;

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

        .main-grid {}

        .main-grid .left {
            width: 100%;
            height: 1150px;
        }

        /* .main-grid .right{
            flex-grow: 1;
            height: 1000px;
        } */
      
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
        .main-container {
            min-height: 100vh;
            /* display: flex;
            flex-wrap: wrap; */
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 20px; 
            /* align-items: center; */
            /* justify-content: center; */
        }
        .card-content{
            margin: 10px 30px;
        }
        .card{
            width: 290px;
            border-radius: 25px;
            background: #eeecec;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        }
        .image-content,
        .card-content{
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 10px 14px;

        }
        .image-content{
            position: relative;
            row-gap: 5px;
        }
        .overlay1{
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 100%;
            background-color: #4070F4;
            border-radius: 25px 25px 0 25px;
        }
        .card-image{
            position: relative;
            height: 120px;
            width: 120px;
            border-radius: 50%;
            background: #FFF;
            padding: 3px;
        }
        .card-image .card-img{
            height: 100;
            width: 100%;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #4070F4;
        }
        .name{
            font-size: 16px;
            font-weight: 600;
            color: #333;
        }
        .description{
            font-size: 16px;
            color: #333;
            text-align: center;
        }
        .button-cancel{
            border: none;
            font-size: 16px;
            color: #FFF;
            padding: 8px 16px;
            background-color: #ff2b2b;
            border-radius: 6px;
            margin: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 0;
            min-width: 142px;
            min-height: 40px;
        }
        .button-cancel:hover{
            background-color: #b30b0b;
        }
        .button-completed{
            border: none;
            font-size: 16px;
            color: #FFF;
            padding: 8px 16px;
            background-color: #4070F4;
            border-radius: 6px;
            margin: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 0;
            min-width: 142px;
            min-height: 40px;
        }
        .button-completed:hover{
            background-color: #265df2;
        }
        .main-container p{
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

</div>

<?php $HTMLFooter = new HTMLFooter(); ?>
<script>
    let BASE_URL = "<?= BASE_URL ?>";
</script>
<script>
    $(document).on("click", ".button-completed", function(event) {
        event.preventDefault(); 
        let id = $(this).attr("data-id");  

        $.ajax({
            url: `${BASE_URL}/counselorReservations/completedReservation/${id}`, 
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

    // $(document).on("click", ".button-cancel", function(event) {
    //     event.preventDefault(); 
    //     let id = $(this).attr("data-id");
        
    //     // confirm cancellation
    //     if (!confirm("Are you sure you want to cancel this Reservation?"))
    //             return;


    //     $.ajax({
    //         url: `${BASE_URL}/counselorReservations/cancelledReservation/${id}`, 
    //         type: 'POST',
    //         data: {
    //             id: id
    //         },
    //         dataType: 'json',
    //         success: function(response) {
    //             if (response.status === 200) {
    //                 alertUser("success", response['desc'])
    //                 setTimeout(() => {
    //                     location.reload();
    //                 }, 1000);
            
    //             } else {
    //                 alertUser("warning", response['desc'])
    //             }
    //         },
    //         error: function(ajaxContext) {
    //             alertUser("danger", "Something Went Wrong")       
    //         }
    //     });
    // });

    $(document).on("click", ".button-cancel", function(event) {
        event.preventDefault();
        let id = $(this).attr("data-id");
        console.log(id);

        if (!confirm("Are you sure you want to Cancel this Reservation?"))
            return;

        $.ajax({
            url: `${BASE_URL}/counselorReservations/cancelledReservation/${id}`,
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

    function loadPopupForm(reservationId) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', BASE_URL + '/counselorReservations/sendEmail/' + reservationId, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = xhr.responseText;
                // Load popup form with email input
                document.getElementById('divone').innerHTML = response; 
                // set opacity to default
                document.getElementById('divone').style.opacity = 1;
                // set visibility to visible
                document.getElementById('divone').style.visibility = 'visible';
            }
        };
        xhr.send();
    }
</script>
