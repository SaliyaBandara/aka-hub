<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("electionsAndPolls");
?>

<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch("Saliya", "Bandara"); ?>
    <div class="main-grid flex">
        <div class="left">
            <div class="divCreatePolls">
                <h3>Create Polls</h3>
                <div class="divPollDetails">
                    <div class="divFormContainor">
                        <div class="mwb-form-main-wrapper">
                            <div class="mwb-form-main-container">
                                <form action="#">
                                    <div class="mwb-form-group">
                                        <input type="text" class="mwb-form-control" value="" id="name">
                                        <label for="name" class="mwb-form-text-label">Title*</label>
                                        <div class="mwb-form-error">This Field Required*</div>
                                    </div>
                                    <div class="mwb-form-group">
                                        <input type="email" class="mwb-form-control" id="email">
                                        <label for="email" class="mwb-form-text-label">Deadline Date*</label>
                                        <div class="mwb-form-error">This Field Required*</div>
                                    </div>
                                    <div class="mwb-form-group">
                                        <input type="text" class="mwb-form-control" value="" id="name">
                                        <label for="name" class="mwb-form-text-label">Deadline Time*</label>
                                        <div class="mwb-form-error">This Field Required*</div>
                                    </div>
                                    <div class="mwb-form-group">
                                        <input type="email" class="mwb-form-control" id="email">
                                        <label for="email" class="mwb-form-text-label">Eligible Voter Group*</label>
                                        <div class="mwb-form-error">This Field Required*</div>
                                    </div>
                                    <div class="mwb-form-group">
                                        <input type="text" class="mwb-form-control" value="" id="name">
                                        <label for="name" class="mwb-form-text-label">Created Date and Time*</label>
                                        <div class="mwb-form-error">This Field Required*</div>
                                    </div>
                                    <div class="mwb-form-group">
                                        <input type="email" class="mwb-form-control" id="email">
                                        <label for="email" class="mwb-form-text-label">Question 1 *</label>
                                        <div class="mwb-form-error">This Field Required*</div>
                                    </div>
                                    <div class="mwb-form-group">
                                        <input type="email" class="mwb-form-control" id="email">
                                        <label for="email" class="mwb-form-text-label">Question 2 *</label>
                                        <div class="mwb-form-error">This Field Required*</div>
                                    </div>
                                    <div class="mwb-form-group">
                                        <input type="email" class="mwb-form-control" id="email">
                                        <label for="email" class="mwb-form-text-label">Question 3 *</label>
                                        <div class="mwb-form-error">This Field Required*</div>
                                    </div>
                                    <div class="mwb-form-group">
                                        <input type="email" class="mwb-form-control" id="email">
                                        <label for="email" class="mwb-form-text-label">Question 4 *</label>
                                        <div class="mwb-form-error">This Field Required*</div>
                                    </div>
                                    <!-- <div class="mwb-form-group">
                                        <label>Enter Counselor Type : </label>
                                        <div class="mwb-form-radio">
                                            <input type="radio" name="radio-counselor-type" id="radio1">
                                            <label for="radio1">Professional Counselor</label>
                                        </div>
                                        <div class="mwb-form-radio">
                                            <input type="radio" name="radio-counselor-type" id="radio2">
                                            <label for="radio2">Student Counselor</label>
                                        </div>
                                    </div> -->
                                    <div class="mwb-form-group">
                                        <input type="email" class="mwb-form-control" id="email">
                                        <label for="email" class="mwb-form-text-label">Question 5 *</label>
                                        <div class="mwb-form-error">This Field Required*</div>
                                    </div>
                                    <div class="mwb-form-group">
                                        <input type="Submit" class="mwb-form-submit-btn" value="Publish Poll">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="right">
            
        </div> -->
    </div>

    <style>
        .main-grid {}


        .mwb-form-main-wrapper {
            font-family: 'Lato', sans-serif;
            line-height: 1.5;
            padding: 20px;
            width: 100%;
        }

        .mwb-form-main-container {
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            color: #7b7878;
            margin: 0 auto;
            max-width: 600px;
        }

        .mwb-form-main-container form {
            padding: 20px;
        }

        .mwb-form-main-container h1 {
            background-color: #26A69A;
            color: #ffffff;
            font-size: 30px;
            font-weight: 500;
            margin: 0 0 10px 0;
            padding: 22px 15px;
            text-align: center;
        }

        .mwb-form-group {
            font-size: 14px;
            margin-bottom: 30px;
            position: relative;
        }

        .mwb-form-text-label {
            left: 10px;
            position: absolute;
            top: 12px;
            transition: 0.2s linear all;
        }

        .mwb-form-group.focus-input .mwb-form-text-label {
            background-color: #ffffff;
            padding: 0 2px;
            top: -11px;
            transition: 0.2s linear all;
        }

        .mwb-form-control {
            background-color: #ffffff;
            border-radius: 4px;
            border: 2px solid #dddddd;
            font-size: 14px;
            padding: 13px;
            width: 100%;
        }

        .mwb-form-submit-btn {
            background-color: #2684FF;
            border-radius: 4px;
            border: none;
            color: #ffffff;
            cursor: pointer;
            display: inline-block;
            font-size: 14px;
            min-width: 200px;
            padding: 16px 10px;
        }
        .mwb-form-submit-btn :hover{
            background-color: white;
            border-radius: 4px;
            border: none;
            color: black;
            cursor: pointer;
            display: inline-block;
            font-size: 14px;
            min-width: 200px;
            padding: 16px 10px;
        }
        .mwb-form-radio {
            display: inline-block;
            margin-right: 15px;
            position: relative;
        }

        .mwb-form-radio input[type="radio"]~label {
            padding-left: 10px;
            cursor: pointer;
        }

        .mwb-form-radio input[type="radio"] {
            margin: 0;
            cursor: pointer;
            width: 20px;
            height: 20px;
            opacity: 0;
        }

        .mwb-form-radio input[type="radio"]+label::before {
            background-color: #dddddd;
            border-radius: 50%;
            content: "";
            cursor: pointer;
            height: 20px;
            left: 0;
            position: absolute;
            top: 6px;
            width: 20px;
        }

        .mwb-form-radio input[type="radio"]+label::after {
            background-color: #2684FF;
            border-radius: 50%;
            content: "";
            height: 10px;
            left: 5px;
            opacity: 0;
            position: absolute;
            top: 11px;
            transform: scale(0);
            transition: 0.3s linear all;
            visibility: hidden;
            width: 10px;
        }

        .mwb-form-radio input[type="radio"]:checked+label::after {
            opacity: 1;
            transform: scale(1);
            transition: 0.3s linear all;
            visibility: visible;
        }

        .mwb-form-error {
            color: #f52626;
            display: none;
            font-size: 12px;
            padding-top: 2px;
        }


        .divFormContainor {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
        }
        .divPollDetails {
            width: 100%;
            height: 80%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .divCreatePolls h3 {
            text-align: center;
        }

        .divCreatePolls {
            width: 100%;
            height: 100%;
        }

        .main-grid .left {
            width: 100%;
            height: 1200px;
        }

        /* .main-grid .right{
            flex-grow: 1;
            height: 1000px;
        } */
    </style>

</div>

<script>
    jQuery(document).ready(function($) {
        $(".mwb-form-control").focus(function() {
            var tmpThis = $(this).val();
            if (tmpThis == '') {
                $(this).parent(".mwb-form-group").addClass("focus-input");
            } else if (tmpThis != '') {
                $(this).parent(".mwb-form-group").addClass("focus-input");
            }
        });
        $(".mwb-form-control").blur(function() {
            var tmpThis = $(this).val();
            if (tmpThis == '') {
                $(this).parent(".mwb-form-group").removeClass("focus-input");
                $(this).siblings('.mwb-form-error').slideDown("3000");
            } else if (tmpThis != '') {
                $(this).parent(".mwb-form-group").addClass("focus-input");
                $(this).siblings('.mwb-form-error').slideUp("3000");

            }
        });

    });
</script>
