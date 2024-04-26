<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("Settings");
?>

<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>

    <div class="main-grid flex">
        <div class="leftContent">
            <div class="main-div">
                <div class="section_header mb-1 flex flex-column">
                    <div class="title font-1-5 font-semibold flex align-center">
                        <i class='bx bxs-calendar-check me-0-5'></i> Book timeslots to meet a counselor
                    </div>
                    <div class="title font-1 font-semibold flex align-center text-muted my-2" >
                        Available timeslots of counselor <?= $data["counselor"][0]["name"] ?>
                    </div>
                    <div>
                        <a href="<?= BASE_URL ?>/counselorView/viewBookings/<?=$data["counselor"][0]["id"]?>" class="btn btn-info mb-1 form form-group justify-center align-center text-center" style = "max-width: 230px !important;"> Manage My Appointments </a>
                    </div>
                </div>
                
                <div class="wrapper">
                <?php
                    if (empty($data["timeslots"])) {
                        echo "<div class='font-meidum text-muted'>No timeslots are available for this counselor for now!</div>";
                    } else {
                            foreach ($data["timeslots"] as $timeslot) {
                    ?>
                        <div class=" card-not-added todo_item flex flex-row justify-between"  data-timeslot-id="<?= $timeslot['id'] ?>">
                                <div class="content flex flex-column">
                                    <div class="my-0-5">
                                        <i class='bx bxs-calendar me-1'></i> Date : <?= date("Y.m.d", strtotime($timeslot["date"])) ?>
                                    </div>
                                    
                                    <div class="my-0-5">
                                        <i class='bx bxs-time me-1'></i> Time : <?= date("H:i", strtotime($timeslot["start_time"])) ?> to <?= date("H:i", strtotime($timeslot["end_time"])) ?>
                                    </div>
                                </div>
                                <div class="buttons my-1 mx-2 ">
                                    <div href="#" class="button-bookNow btn btn-primary mb-1 form form-group justify-center align-center" style = "max-width: 100px !important;" data-timeslot-id="<?= $timeslot['id'] ?>">Book Now</div>
                                </div>
                        </div> 
                    <?php }} ?>
                </div>
            </div>
        </div>
        <div class = "rightContent">
            <div class = "profileDescriptionPanel">
                <?php 
                    foreach ($data["counselor"] as $counselor) {
                    $img_src = USER_IMG_PATH . $counselor["profile_img"];
                ?>
                <div class = "descriptionPanelLeft">
                    <div class = "profileImageContainor">
                        <img src="<?= $img_src ?>" alt="">
                    </div>
                </div>
                <div class = "profileDetailsContainer">
                    <div class = "font-1-25 font-semibold ms-1 mt-2"><?= $counselor["name"] ?></div>
                    <div>
                    <?php
                        
                        if ($counselor["type"] == 1) {
                                echo '<div class = "font-1 font-meidum text-muted ms-1 mt-0-5">Professional Counselor</div>';
                        } else {
                            echo '<div class = "font-1 font-meidum text-muted ms-1 mt-0-5">Student Counselor</div>';
                        }
                        ?>

                    </div>
                    <div class = "font-1 text-muted ms-1 mt-0-5">You can now talk with the professional counselors to reserve a date for your appointment</div>
                    <div href="#" class = "chatButtonContainer">
                        <div class = "btn btn-primary mb-1 form form-group chatButton justify-center align-center">
                            Chat Now
                        </div>
                    </div>
                </div>
                <?php  } ?>
            </div>
            <div class="wrapper flex flex-column justify-center mx-2">
                <?php
                    
                    if (empty($data["latestReservation"])) {
                        echo "<div class='font-medium text-muted my-2'>There are no upcoming reservatios for you!</div>";
                    } else {
                        $latestReservation = $data["latestReservation"][0];
                    ?>
                        <div>
                            <div class='font-medium text-secondary font-1-5 my-2'>Your Latest Appointment</div>
                        </div>
                        <div class=" latest todo_item flex flex-row justify-between">
                                <div class="content flex flex-column">
                                    <div class="my-0-5">
                                        <i class='bx bxs-calendar me-1'></i> Date : <?= date("Y.m.d", strtotime($latestReservation["date"])) ?>
                                    </div>
                                    
                                    <div class="my-0-5">
                                        <i class='bx bxs-time me-1'></i> Time : <?= date("H:i", strtotime($latestReservation["start_time"])) ?> to <?= date("H:i", strtotime($latestReservation["end_time"])) ?>
                                    </div>
                                </div>
                        </div> 
                    <?php } ?>
                </div>
            
        </div>
    </div>

    <style>
        .main-grid .leftContent{
            width: 50%;
            height: 700px;
            /* border: 1px solid red; */
            justify-content: center;
            align-items:center;

            height: auto !important;
            min-height: calc(100vh - var(--header-height) - 5rem);
            padding: 2rem;
        }

        .main-grid .rightContent{
            width: 50%;
            /* border: 1px solid red; */
            justify-content: flex-start;
            display: flex;
            flex-direction: column; 

            flex-grow: 1;
            height: auto !important;
            margin-right: 0.75rem;
            
        }

        .profileDescriptionPanel{
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            border-radius: 10px;
            margin-right: 3rem !important;
            /* border: 1px solid red; */
        }

        .descriptionPanelLeft{
            width:40%;
            display:flex;
            /* border: 1px solid red; */
            justify-content:center;
            align-items:center;
            /* margin: 2rem; */
        }

        .profileImageContainor{
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            border: 5px solid #bdd2f1;
            width: 8rem;
            height: 8rem;
            /* margin : 2rem; */
        }

        .profileImageContainor img{
            width: 7rem;
            height: 7rem;
            /* margin : 0.5rem; */
            border-radius: 50%;
        }

        .profileDetailsContainer{
            justify-content: center;
            align-items: center;
            /* border: 1px solid red; */
            width: 60%;
            /* margin: 2rem; */
        }

        .chatButtonContainer{
            width: 100%;
            /* border: 1px solid red; */
            justify-content: left ;
            align-items: left ;
            display:flex;
            margin: 1rem 0 0 1rem;
        }

        .button-bookNow{
            min-width: 120px;
            text-align: center;
        }

    </style>
    <style>

        .todo_item {
            text-decoration: none;
            color: initial;

            width: 80%;
            min-width: 300px;
            padding: 1rem;
            margin: 1rem;
            margin-left: 0;
            margin-top: 0;
            border-radius: 10px;
            border: 1px solid #d0d0d0;
            /* background-color: #f5f5f5; */

            transition: all 0.3s ease-in-out;
            /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
        }

        .todo_item:hover {
            transform: scale(1.025);
            background-color: #f5f5f5;
            background-color: #eeecec;
            background-color: #bdd2f138;
        }

        .latest{
            width: 50%!important ;
        }

    </style>


</div>

<?php $HTMLFooter = new HTMLFooter(); ?>
<script>
    let BASE_URL = "<?= BASE_URL ?>";
</script>
<script>
    // $(document).ready(function() {
    //     $(".button-bookNow").click(function(e) {
    //         e.preventDefault();
    //         var timeslotId = $(this).data("timeslot-id");
    //         // console.log(timeslotId);          

    //         if (!confirm("Are you sure you want to make this Reservation?"))
    //             return;

    //         $.ajax({
    //             url:`<?= BASE_URL ?>/counselorView/bookReservation/${timeslotId}`,
    //             type: 'post',
    //             dataType: 'json',
    //             data: {
    //                 timeslot_id: timeslotId
    //             },
    //             success: function(response) {
    //                 if (response['status'] == 200) {
    //                     alertUser("success", response['desc']);
    //                     setTimeout(function() {
    //                         location.reload();
    //                     }, 500);

    //                 } else {
    //                     alertUser("warning", response['desc']);
    //                 }
    //             },
    //             error: function(ajaxContext) {
    //                 alertUser("danger", "Something Went Wrong");
    //             }
    //         });
    //     });
    // });

    $(document).ready(function() {
        $(".button-bookNow").click(function(e) {
            e.preventDefault();
            var timeslotId = $(this).data("timeslot-id");
            // console.log(timeslotId);

            if (!confirm("Are you sure you want to make this Reservation?"))
                return;


            // Check if there are any reservations
            $.ajax({
                url: `<?= BASE_URL ?>/counselorView/checkExistingReservations`, // Replace with the actual URL to fetch reservations data
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    // if (response.status == 200 && response.reservations.length === 0) {
                    if (response.status == 200) {    
                        // No reservations found, proceed with making a new reservation
                        alertUser("warning", response.desc);
                        // makeReservation(timeslotId);
                    } else {
                        // alertUser("warning", "There are existing reservations. Cannot make a new reservation.");
                        // alertUser("warning", response.desc);
                        makeReservation(timeslotId);
                    }
                },
                error: function(ajaxContext) {
                    alertUser("danger", "Failed to fetch existing reservations data.");
                }
            });
        });
    });

    function makeReservation(timeslotId) {
        $.ajax({
            url: '<?= BASE_URL ?>/counselorView/bookReservation/' + timeslotId ,
            type: 'post',
            dataType: 'json',
            data: {
                timeslot_id: timeslotId
            },
            success: function(response) {
                if (response.status == 200) {
                    alertUser("success", response.desc);
                    setTimeout(function() {
                        location.reload();
                    }, 500);

                } else {
                    alertUser("warning", response.desc);
                }
            },
            error: function(ajaxContext) {
                alertUser("danger", "Something Went Wrong");
            }
        });
    }
</script>