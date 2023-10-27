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
            <div class="divTileRow">
                <div class="divTile">
                    <a href="<?= BASE_URL ?>/clubEventFeed/index" class="mwb-form-submit-btn">Club Event Feed</a>
                </div>
                <div class="divTile">
                    <a href="<?= BASE_URL ?>/counselorFeed/index" class="mwb-form-submit-btn">Counselor Feed</a>
                </div>

            </div>
        </div>
    </div>

    <style>
        .main-grid {}
        .divTile a{
            text-decoration: none;
            color: white;
        }
        .divTileRow {
            width: 100%;
            height: 200px;
            display: flex;
            padding: 15px;
            justify-content: left;
            align-items: center;
            margin-bottom: 30px;
        }

        .divTile {
            width: 25%;
            height: 175px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            margin: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 10px;
            transition: all 0.3s ease-in-out;
            color: white;
            background-image: linear-gradient(45deg, #ff9b2d, #ff5755);
            opacity: 0.7;
        }

        .divTile:hover {
            width: 25%;
            height: 175px;
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.5);
            margin: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            font-size: 20px;
            text-decoration: none;
            color: white;
        }

        .main-grid .left {
            width: 100%;
            height: 82vh;
        }

        /* .main-grid .right{
            flex-grow: 1;
            background-color: red;
            height: 50vh;
        } */
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