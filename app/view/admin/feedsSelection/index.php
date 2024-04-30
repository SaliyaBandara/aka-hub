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
                <a href="<?= BASE_URL ?>/eventFeed/index" class="mwb-form-submit-btn tile">
                    <div class="divTile">
                        Club Event Feed
                    </div>
                </a>
                <a href="<?= BASE_URL ?>/counselorFeed/index" class="mwb-form-submit-btn tile">
                    <div class="divTile">
                        Counselor Feed
                    </div>
                </a>
            </div>
        </div>
    </div>

    <style>
        .main-grid {}

        .divTile {
            text-align: center;
            color: white;
        }
        .divTile a {
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
            margin-left: 25px;
        }

        .tile {
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
            color: inherit;
            opacity: 0.7;
            text-decoration: none;
            background-color: #1264ab;
        }

        .tile:hover {
            width: 25%;
            height: 175px;
            transform: scale(1.025);
            background-color: #1264aba9;
            margin: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            font-size: 18px;
            text-decoration: none;
            color: inherit;
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