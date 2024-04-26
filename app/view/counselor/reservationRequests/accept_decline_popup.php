<?php
    // $HTMLHead = new HTMLHead($data['title']);
    // print_r($data["reservationRequest"]);
?>

<div class="wrapper1 popup-form">
    <h2>Reservation Details</h2>
    <a href="" class="close">&times;</a>
    <div class="content">
        <div class="container">
            <?php
                $reservation_request = $data["reservationRequest"];
                
                $img_src = USER_IMG_PATH . "default_avatar.jpg";
                if ($reservation_request["profile_img"] != null || $reservation_request["profile_img"] != "") {
                    $img_src = USER_IMG_PATH . $reservation_request["profile_img"];
                }
            ?>
            <div class="img1"><img src="<?= $img_src ?>" class="center-top"></div>
            <form class="form-1">
                <div class="label-container">
                    <div class="f1">
                        <label>Name:</label>
                        <label><?= $reservation_request["name"] ?> </label><br/>
                    </div>
                    
                    <div class="f1">
                        <label>Academic Year:</label>
                        <label>
                        <div style="display: inline-block;">
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
                                    echo "<label>{$year}{$suffix} year</label>";
                                ?>
                        </div> 
                    </div>
                    <div class="f1">
                        <label>Reservation Date:</label>
                        <label><?php echo $reservation_request['date']; ?></label><br/>
                    </div>
                    <div class="f1">
                        <label>Time Slot:</label>
                        <label><?php echo date('H.i', strtotime($reservation_request['start_time'])); ?> to <?php echo date('H.i', strtotime($reservation_request['end_time'])); ?></label><br/>
                    </div>
                    
                </div>
                
                <div class="input-buttons">
                    <a href="#" class="accept accept-request" data-id="<?= $reservation_request['id'] ?>">Accept</a>
                    <a href="#" class="decline decline-request" data-id="<?= $reservation_request['id'] ?>">Decline</a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
        .wrapper1{
            margin: 70px auto;
            padding: 20px;
            background: #e7e7e7;
            border-radius: 5px;
            width: 30% !important;
            position: relative;
            transition: all 5s ease-in-out;
            margin-top: 300px;
            /* z-index: 9999; */
        }
        .wrapper1 h2{
            margin-top: 0;
            color: #333;
        }
        .wrapper1 .close{
            position: absolute;
            top: 20px;
            right: 30px;
            transition: all 200ms;
            font-weight: bold;
            text-decoration: none;
            color: #333;
        }
        .wrapper1 .content{
            max-height: 30%;
            overflow: auto;
        }

        /* form design */

        .container{
            border-radius: 10px;
            background-color: #e7e7e7;
            padding: 20px 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
        }
        form label{
            /* text-transform: uppercase; */
            font-weight: 600;
            letter-spacing: 2px;
        }
        .input-buttons{
            margin-top: 30px !important;
            margin-bottom: 20px !important;
        }
        .input-buttons .accept{
            text-decoration: none;
            background-color: #2684FF;
            color: #fff;
            padding: 15px 50px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-size: 15px;
        }
        .input-buttons .accept:hover{
            background-color: #4070F4;
        }
        .input-buttons .decline{
            text-decoration: none;
            background-color: #ff2b2b;
            color: #fff;
            padding: 15px 50px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-size: 15px;
        }
        .input-buttons .decline:hover{
            background-color: #b30b0b;
        }
        .popup-form{
            width: 40%;
            padding: 8px;
            border-radius: 8px;
            border-style: groove;
            background-color: #fff; 
        }
       
        .form-1 {
            text-align: left;
        }

        .form-1 input[type="submit"] {
            margin: 0 auto; /* Center horizontally */
        }

        .wrapper1 h2{
            text-align: center;
        }
        .container .img1{
            height: 90px;
            width: 90px;
            background: #4070F4;
            border-radius: 50%;
            padding:5px;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
            text-align: center;
        }

        .container .img1 img{
            height: 100%;
            width:100%;
            border-radius: 50%;
            object-fit: cover;
        }
        .input-buttons{
            margin-top: 20px;
        }
        .label-container{
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .f1{
            margin-bottom: 10px;
        }
</style>

