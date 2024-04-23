<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("feedsSelection");
?>

<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>


    <div class="main-grid flex">
        <div class="left">
            <div class="divTileRow">
                <div class="divTile">
                    <a href="<?= BASE_URL ?>/eventFeed/index" class="mwb-form-submit-btn">Club Event Feed</a>
                </div>
                <div class="divTile">
                    <a href="<?= BASE_URL ?>/counselorFeed/index" class="mwb-form-submit-btn">Counselor Feed</a>
                </div>

            </div>
        </div>
    </div>

    <style>
        .main-grid {}

        .divTile a {
            text-decoration: none;
            color: black;
        }

        .divTileRow {
            width: 100%;
            height: 200px;
            display: flex;
            padding: 15px;
            justify-content: left;
            align-items: center;
            margin-bottom: 30px;
            margin-left: 25px;
        }

        .divTile {
            width: 25%;
            height: 175px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border: 1px solid #d0d0d0;
            margin: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 10px;
            transition: all 0.3s ease-in-out;
            color: black;
            /* background-image: linear-gradient(45deg, #ff9b2d, #ff5755); */
            opacity: 0.7;
            /* background-image: url('http://127.0.0.1/aka-hub/public/assets/img/common/elections.jpg');
            background-size: cover; */
        }

        .divTile:hover {
            width: 25%;
            height: 175px;
            transform: scale(1.025);
            background-color: #f5f5f5;
            background-color: #eeecec;
            background-color: #bdd2f138;
            margin: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            font-size: 18px;
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