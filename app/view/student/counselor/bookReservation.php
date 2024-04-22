<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("Settings");
?>

<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>

    <div class="main-grid flex">
        <div class="left">
            <div class="main-div">
                <div class="wrapper">
                <?php
                    if (empty($data["timeslots"])) {
                        echo "NO TIME SLOTS AVAILABLE FOR THIS COUNSELOR";
                    } else {
                            foreach ($data["timeslots"] as $timeslot) {
                            // $img_src = USER_IMG_PATH . $reservation_request["cover_img"];
                            // echo($data["timeslots"])
                    ?>
                    
                        <div class="card card-not-added" data-timeslot-id="<?= $timeslot['id'] ?>">
                                <div class="content">
                                    <div class="details">
                                        <i class='bx bxs-time'></i>
                                        <span class="name"><?= date("Y.m.d", strtotime($timeslot["date"])) ?> - <?= date("H:i", strtotime($timeslot["start_time"])) ?> to <?= date("H:i", strtotime($timeslot["end_time"])) ?></span>
                                    </div>
                                </div>
                                <div class="buttons">
                                    <a href="#" class="button-bookNow" data-timeslot-id="<?= $timeslot['id'] ?>">Book Now</a>
                                </div>
                        </div> 
                    <?php }} ?>
                    <!-- <div class="card card-not-added" >
                            <div class="content">
                                <div class="details">
                                    <i class='bx bxs-time'></i>
                                    <span class="name">12pm - 01pm</span>
                                </div>
                            </div>
                            <div class="buttons">
                                <a href="#" class="button-bookNow">Book Now</a>
                            </div>   
                    </div> -->
                </div>
            </div>
        </div>
        <div class = "right">
        
        </div>
    </div>

    <style>
        .main-grid .left{
            width: 80% !important;
            height: 700px;
            /* border: 1px solid red; */
            justify-content: center;
            align-items:center;
        }

        .counselorArticlesPanel{
            width: 100%;
            /* border: 1px solid var(--secondary-color-faded); */
            /* box-shadow: 0 0 5px rgba(0, 0, 0, 0.2); */
            /* height: 500px; */
            display: flex;
            flex-wrap: wrap;
            border-radius: 10px;
            /* border : 1px solid red; */

        }

        .panelTitle{
            width: 100%;
        }

        .articleCard {
            width: 30%;
            min-width: 150px;
            height: 100%;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            margin: 25px;
            border-radius : 10px;
            /* border: 1px solid red; */
            text-decoration : none;
            color : black;
        }

        .articleImage {
            display: flex;
            width: 100%;
            justify-content: center;
            align-items: center;
        }
        
        .articleImage img{
            width: 150px;
            height: 150px;
            margin : 0.5rem;
        }

        .articleTitle{
            text-align : center;
            margin : 0.5rem;
            font-size: 12px;
            font-weight: bold;
            text-decoration : none;
            /* border: 1px solid red; */
        }

        .articleDescription{
            text-align : center;
            margin : 0.5rem;
            font-size: 10px;
            /* border: 1px solid red; */
        }


        .main-grid .right{
            margin-right:2rem;
            /* border: 1px solid red; */
            padding: 2rem;
        }

        .profileDescriptionPanel{
            width: 100%;
            /* border: 1px solid var(--secondary-color-faded); */
            /* box-shadow: 0 0 5px rgba(0, 0, 0, 0.2); */
            /* height: 500px; */
            display: flex;
            flex-wrap: wrap;
            border-radius: 10px;
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

        /* .chatButton{
            border: 1px solid #2684ff;
            background-color: var(--secondary-color);
            color: white;
            width: 100%;
            text-align:center;
        } */

        .chatButtonContainer{
            width: 100%;
            /* border: 1px solid red; */
            justify-content: left ;
            align-items: left ;
            display:flex;
            margin: 1rem 0 0 1rem;
        }
        .bookingButtonContainer{
            width: 100%;
            /* border: 1px solid red; */
            justify-content: left ;
            align-items: left ;
            display:flex;
            margin: 1rem 0 0 1rem;
        }

    </style>
    <style>
        .wrapper{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            /* height: 100vh; */
            /* min-height: 100vh; */
            /* z-index: +5; */
            /* margin-top: -200px; */
        }

        .wrapper .card{
            
            width: 80%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
            position:relative;
            margin-bottom: 20px;
            border-radius: 20px 20px 20px 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        }

        .card-not-added{
            background: #eeecec;
        }
        /* .card-added{
            background: #ff9b2d;
        } */
        .card .content{
            display: flex;
            align-items: center;

        }

        .card .details {
            margin-left: 80px;
        }

        .details span{
            font-weight: 600;
            font-size: 18px;
        }
        .details i{
            margin-right: 30px;
            margin-left: -50px;
            font-size: 24px;
        }
        .card a{
            text-decoration: none;
            display: inline-block;
            padding: 10px 20px;
            border-radius: 25px;
            color: #fff;
            /* background: linear-gradient(to bottom, #bea2e7 0%, #86b7e7 100%); */
        }

        .date-range{
            text-align: center;
        }
        .date-range input{
            margin-right: 10px;
            margin-left: 10px;
            width: 20%;
            padding: 8px;
            border-radius: 8px;
            border-style: groove;
            background-color: #fff;
        }
        .button-bookNow{
            background: #2684FF;
            width: 120px;
            text-align: center;
        }
        .header-topic{
            text-align: center;
        }
        .button-select{
            text-decoration: none;
            display: inline-block;
            padding: 10px 20px;
            border-radius: 25px;
            color: #fff;
            background: #2684FF;
        }
        .p1{
            font-size: 20px;
            font-weight: 700;
        }
        .p2{
            font-size: 18px;
            font-weight: 700;
        }
        .button-custom{
            text-decoration: none;
            display: inline-block;
            padding: 10px 20px;
            border-radius: 25px;
            color: #fff;
            background: #2684FF;
            align-items: center;
        }
        .custom-button-div{
            margin-bottom:40px;
            text-align: center;
        }
    </style>


</div>

<?php $HTMLFooter = new HTMLFooter(); ?>
<script>
    let BASE_URL = "<?= BASE_URL ?>";
</script>
<script>
    $(document).ready(function() {
        $(".button-bookNow").click(function(e) {
            e.preventDefault();
            var timeslotId = $(this).data("timeslot-id");
            // console.log(timeslotId);
            $.ajax({
                url:`<?= BASE_URL ?>/counselorView/bookReservation/${timeslotId}`,
                type: 'post',
                dataType: 'json',
                data: {
                    timeslot_id: timeslotId
                },
                success: function(response) {
                    if (response['status'] == 200) {
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
    });
</script>