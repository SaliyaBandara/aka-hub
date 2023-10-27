<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar();
?>

<div id="sidebar-active">

    <div class="welcome-back">
        <div class="flex flex_container">
            <div class="flex_item">
                <div class="title pb-0-5">Welcome back</div>
                <div class="text-muted">Hi Kasun Udara</div>
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
                <div class="text-muted">Hi Kasun Udara</div>
            </div>
        </div>
    </div>

    <style>
        .welcome-back {
            width: 100%;
            padding: 0.5rem 1rem;
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
        }

        .welcome-back .flex_item.search_flex button {
            /* width: 20%; */
            padding: 1rem 1.25rem;
            padding-right: 0;
            margin: 0;

            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f5f5f5;
            border-radius: 10px 0 0 10px;
        }

        .welcome-back .flex_item.search_flex .form-group {
            width: 80%;
            /* margin-left: 1rem; */
            border: none;
            border-radius: 0 10px 10px 0;
            padding: 1rem 1.25rem;
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
            <div class="divAddCounselors">
                <h3>Admin Account Creation</h3>
                <div class="divCounselorDetails">
                    <div class="divFormContainor">
                        <div class="mwb-form-main-wrapper">
                            <div class="mwb-form-main-container">
                                <form action="#">
                                    <div class="mwb-form-group">
                                        <input type="text" class="mwb-form-control" value="" id="name" placeholder="Name*">
                                        <div class="mwb-form-error">This Field Required*</div>
                                    </div>
                                    <div class="mwb-form-group">
                                        <input type="email" class="mwb-form-control" id="email" placeholder="Email*">
                                        <div class="mwb-form-error">This Field Required*</div>
                                    </div>
                                    <div class="mwb-form-group">
                                        <input type="text" class="mwb-form-control" value="" id="name" placeholder="Password*">
                                        <div class="mwb-form-error">This Field Required*</div>
                                    </div>
                                    <div class="mwb-form-group">
                                        <input type="email" class="mwb-form-control" id="email" placeholder="Re Enter Password*">
                                        <div class="mwb-form-error">This Field Required*</div>
                                    </div>
                                    <div class="mwb-form-group">
                                        <input type="text" class="mwb-form-control" value="" id="name" placeholder="Alternative Email">
                                        <div class="mwb-form-error">This Field Required*</div>
                                    </div>
                                    <div class="mwb-form-group">
                                        <label>Gender : </label>
                                        <div class="mwb-form-radio">
                                            <input type="radio" name="radio-gender" id="radio3">
                                            <label for="radio3">Male</label>
                                        </div>
                                        <div class="mwb-form-radio">
                                            <input type="radio" name="radio-gender" id="radio4">
                                            <label for="radio4">Female</label>
                                        </div>
                                    </div>
                                    <div class="mwb-form-group">
                                        <input type="email" class="mwb-form-control" id="email" placeholder="Contact Number">
                                        <div class="mwb-form-error">This Field Required*</div>
                                    </div>
                                    <div class="mwb-form-group">
                                        <input type="email" class="mwb-form-control" id="email" placeholder="Enter More Details">
                                        <div class="mwb-form-error">This Field Required*</div>
                                    </div>
                                    <div class="mwb-form-group">
                                        <input type="Submit" class="mwb-form-submit-btn" value="Create Account">
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
            color: #7b7878;
            margin: 0 auto;
            max-width: 85%;
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
        .divCounselorDetails {
            width: 100%;
            height: 80%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .divAddCounselors h3 {
            text-align: center;
        }

        .divAddCounselors {
            width: 100%;
            height: 100%;
        }

        .main-grid .left {
            width: 100%;
            height: 900px;
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