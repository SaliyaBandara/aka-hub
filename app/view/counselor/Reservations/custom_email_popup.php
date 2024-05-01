<?php
    // $HTMLHead = new HTMLHead($data['title']);
    // print_r($data["reservationRequest"]);
?>

<div class="wrapper1 popup-form">
    <h2>Send Custom Email</h2>
    <a href="" class="close">&times;</a>
    <div class="content">
        <div class="container">
            <form class="form-1">
                <?php
                    $user = $data["user"];
                ?>
                <div class="label-container">
                    <form action="" class="contact-left">
                        <label for="email">Sends to: <?= $user["email"] ?></label>
                        <textarea name="message" placeholder="Enter message" class="contact-textarea" required></textarea>
                        <div class="input-buttons">
                            <a href="#" class="email send-email">Send Email <i class='bx bx-envelope'></i></a>
                        </div>
                    </form>
                    
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
            text-align: center;
        }
        .input-buttons .email i{
            vertical-align: middle;
            font-size: 18px;
        }
        .input-buttons .email{
            text-decoration: none;
            background-color: #2684FF;
            color: #fff;
            padding: 15px 50px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-size: 15px;
        }
        .input-buttons .email:hover{
            background-color: #4070F4;
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
        .input-buttons a{
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
        .contact-inputs{
            width: 400px;
            height: 40px;
            border: 1px solid #686868;
            outline: none;
            font-weight: 500;
            border-radius: 10px;
        }
        .contact-textarea{
            width: 400px;
            height: 140px;
            border: 1px solid #686868;
            outline: none;
            padding-top: 15px;
            font-weight: 500;
            border-radius: 20px;
            margin-top: 20px;
        }
</style>

