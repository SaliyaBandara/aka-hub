<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("home");
?>

<div id="sidebar-active" class="hideScrollbar">
    <div class="welcome-back fixed">
        <div class="flex flex_container">
            <div class="flex_item">
                <div class="title pb-0-5">Welcome back</div>
                <div class="text-muted">Hi Saliya Bandara</div>
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
                <div class="text-muted">Hi Saliya Bandara</div>
            </div>
        </div>
    </div>
    <div class="welcome-back opacity-0 pointer-events-none	">
        <div class="flex flex_container">
            <div class="flex_item">
                <div class="title pb-0-5">Welcome back</div>
                <div class="text-muted">Hi Saliya Bandara</div>
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
                <div class="text-muted">Hi Saliya Bandara</div>
            </div>
        </div>
    </div>

    <style>
        .welcome-back {
            width: calc(100vw - (var(--sidebar-width-actual) + 1.75rem));
            padding: 0.5rem 1rem;
            background-color: var(--off-white);
            border-radius: 10px 10px 0 0;

            /* border bottom */
            border-bottom: 1px solid #e5e5e5;
        }

        .welcome-back:not(.opacity-0) {
            /* box shadow to bottom */
            z-index: 10;
            /* box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1); */
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
            border: 1px solid #e5e5e5;
            border-radius: 10px;
            overflow: hidden;
        }

        .welcome-back .flex_item.search_flex button.btn {
            /* width: 20%; */
            padding: 1rem 1.25rem;
            /* padding-right: 0; */
            margin: 0;

            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f5f5f5;
            border-radius: 10px 0 0 10px;
        }

        .welcome-back .flex_item.search_flex button.btn:hover {
            background-color: #e5e5e5;
            color: var(--primary-color);
        }

        .welcome-back .flex_item.search_flex .form-group {
            width: 100%;
            /* margin-left: 1rem; */
            border: none;
            border-radius: 0 10px 10px 0;
            padding: 1rem 1.25rem;
            padding-left: 0.5rem;
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
            <div class="buttonAddMaterials">
                <h4>Add Material</h4>
            </div>
            <div class="divSearchAndDisplayProducts">
                <div class="divDisplayProductsPart">
                    <div class="H4Holder">
                        <h4>Display</h4>
                    </div>
                    <div class="noOfProductsToDisplay"></div>
                    <div class="H4Holder">
                        <h4>Products</h4>
                    </div>
                </div>
                <div class="divSearchPart">
                    <div class="searchBarContainor">
                        <h4>Search</h4>
                        <div class="searchBar">
                            <input class="searchText" type="text" name="search" id="search">
                        </div>
                    </div>
                </div>
            </div>
            <div class="tableArea">
                <div class="divTableView">
                    <div class="tableContainor">
                        <div class="cardContainor">
                            <div class="div-tableHeader">
                                <div class="tableHeaderItem">
                                    ID
                                </div>
                                <div class="tableHeaderItem">
                                    Type
                                </div>
                                <div class="tableHeaderItem">
                                    Year
                                </div>
                                <div class="tableHeaderItem">
                                    Subject
                                </div>
                                <div class="tableHeaderItem">
                                    Content
                                </div>
                                <div class="tableHeaderItem">
                                    Status
                                </div>
                                <div class="tableHeaderItem">
                                    Action
                                </div>
                            </div>
                            <div class="materialCard">
                                <div class="tableItem">
                                    01
                                </div>
                                <div class="tableItem">
                                    ShortNote
                                </div>
                                <div class="tableItem">
                                    Y1S1
                                </div>
                                <div class="tableItem">
                                    DSA
                                </div>
                                <div class="tableItem">
                                    defafafafa
                                </div>
                                <div class="tableItem">
                                    Active
                                </div>
                                <div class="tableItem">
                                    <div class="acceptButton">Accept</div>
                                    <div class="declineButton">Decline</div>
                                </div>
                            </div>
                            <div class="materialCard">
                                <div class="tableItem">
                                    01
                                </div>
                                <div class="tableItem">
                                    ShortNote
                                </div>
                                <div class="tableItem">
                                    Y1S1
                                </div>
                                <div class="tableItem">
                                    DSA
                                </div>
                                <div class="tableItem">
                                    defafafafa
                                </div>
                                <div class="tableItem">
                                    Active
                                </div>
                                <div class="tableItem">
                                    <div class="acceptButton">Accept</div>
                                    <div class="declineButton">Decline</div>
                                </div>
                            </div>
                            <div class="materialCard">
                                <div class="tableItem">
                                    01
                                </div>
                                <div class="tableItem">
                                    ShortNote
                                </div>
                                <div class="tableItem">
                                    Y1S1
                                </div>
                                <div class="tableItem">
                                    DSA
                                </div>
                                <div class="tableItem">
                                    defafafafa
                                </div>
                                <div class="tableItem">
                                    Active
                                </div>
                                <div class="tableItem">
                                    <div class="acceptButton">Accept</div>
                                    <div class="declineButton">Decline</div>
                                </div>
                            </div>
                            <div class="materialCard">
                                <div class="tableItem">
                                    01
                                </div>
                                <div class="tableItem">
                                    ShortNote
                                </div>
                                <div class="tableItem">
                                    Y1S1
                                </div>
                                <div class="tableItem">
                                    DSA
                                </div>
                                <div class="tableItem">
                                    defafafafa
                                </div>
                                <div class="tableItem">
                                    Active
                                </div>
                                <div class="tableItem">
                                    <div class="acceptButton">Accept</div>
                                    <div class="declineButton">Decline</div>
                                </div>
                            </div>
                            <div class="materialCard">
                                <div class="tableItem">
                                    01
                                </div>
                                <div class="tableItem">
                                    ShortNote
                                </div>
                                <div class="tableItem">
                                    Y1S1
                                </div>
                                <div class="tableItem">
                                    DSA
                                </div>
                                <div class="tableItem">
                                    defafafafa
                                </div>
                                <div class="tableItem">
                                    Active
                                </div>
                                <div class="tableItem">
                                    <div class="acceptButton">Accept</div>
                                    <div class="declineButton">Decline</div>
                                </div>
                            </div>
                            <!--<div class="materialCard">
                                <div class="tableItem">
                                    01
                                </div>
                                <div class="tableItem">
                                    ShortNote
                                </div>
                                <div class="tableItem">
                                    Y1S1
                                </div>
                                <div class="tableItem">
                                    DSA
                                </div>
                                <div class="tableItem">
                                    defafafafa
                                </div>
                                <div class="tableItem">
                                    Active
                                </div>
                                <div class="tableItem">
                                    <div class="acceptButton">Accept</div>
                                    <div class="declineButton">Decline</div>
                                </div>
                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="tableFoot">
                <div class="tableFootLeft">
                    Showing Products 1 to 5 of 352
                </div>
                <div class="tableFootRight">
                    
                </div>
            </div>
        </div>
        <div class="right"></div>
    </div>

    <style>
        .tableFootLeft{
            width: 50%;
            height: 100%;
            
        }
        .tableFootRight{
            width: 50%;
            height: 100%;
        }
        .tableFoot{
            width: 100%;
            height: 50px;
            margin-top: 10px;
            display: flex;
        }
        .tableArea{
            width: 100%;
            height: 80%;
            display: flex;
            justify-content: center;
        }
        .acceptButton {
            width: 48%;
            height: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0px 0px 5px 0px #2684FF;
            border-radius: 5px;
            margin: 5px;
        }

        .declineButton {
            width: 48%;
            height: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0px 0px 5px 0px #ff9b2d;
            border-radius : 5px;
            margin: 5px;
        }

        .acceptButton:hover {
            background-color: #2684FF;
            opacity: 1;
            cursor: pointer;
            color: white;
            font-size: 17.5px;
        }

        .declineButton:hover {
            background-color: #ff9b2d;
            opacity: 1;
            cursor: pointer;
            color: white;
            font-size: 17.5px;
        }

        .tableItem {
            width: 14.28%;
            height: 100%;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .acceptIcon {
            width: 65px;
            height: 65px;
            margin: 2px;
        }

        .declineIcon {
            width: 35px;
            height: 35px;
        }

        .acceptIcon:hover {
            width: 67px;
            height: 67px;
            cursor: pointer;
        }

        .declineIcon:hover {
            width: 37px;
            height: 37px;
            cursor: pointer;
        }

        .materialCard {
            background-color: white;
            width: 100%;
            height: 75px;
            justify-content: space-between;
            align-items: center;
            display: flex;
        }





        .main-grid {}

        .h3-RepApprove {
            text-align: center;
            margin-bottom: 20px;
            width: 90%;
        }

        .tableHeaderItem {
            width: 14.28%;
            height: 65px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .tableContainor {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .searchText {
            width: 100%;
            height: 100%;
            border: none;
            outline: none;
            border-radius: 10px;
            padding: 1rem 1.25rem;
            font-size: 0.6rem;
            font-weight: 500;
            background-color: #f1f1f1;
        }

        .searchBar {
            height: 30px;
            margin-left: 5px;
        }

        .searchBarContainor {
            width: 100%;
            height: 30px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-bottom: 15px;
            padding-right: 95px;
        }

        .div-tableHeader {
            width: 100%;
            height: 65px;
            background-color: #2684FF;
            opacity: 1;
            display: flex;
        }

        .cardContainor {
            width: 100%;
            height: 100%;
            margin: 50px 0 50px 0;
            justify-content: center;
            align-items: center;
        }

        .containorForcardArea {
            display: flex;
            width: 100%;
            justify-content: center;
            align-items: center;
        }

        .notificationContainor h3 {
            text-align: center;
            width: 92%;
        }

        .divTableView {
            margin-top: 15px;
            width: 90%;
            height: 60%;
        }

        .noOfProductsToDisplay {
            margin-top: 8px;
            width: 50px;
            height: 80%;
            border: 0.5px solid black;
            margin-right: 8px;
            margin-left: 8px;
        }

        .searchText {
            width: 100%;
            height: 100%;
            border: none;
            outline: none;
            border-radius: 10px;
            padding: 1rem 1.25rem;
            font-size: 0.6rem;
            font-weight: 500;
            background-color: #f1f1f1;
        }

        .searchBar {
            height: 30px;
            margin-left: 5px;
        }

        .searchBarContainor {
            width: 100%;
            height: 30px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-bottom: 15px;
            padding-right: 95px;
        }

        .main-grid .left {
            width: 100%;
            /* background-color: yellowgreen; */
            height: 110vh;
            padding: 2rem;
        }

        .buttonAddMaterials {
            width: 200px;
            height: 40px;
            background-color: #2684FF;
            border-radius: 5px;
            color: white;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
        }

        .buttonAddMaterials:hover {
            cursor: pointer;
            background-color: #1E6FF2;
        }

        .divSearchAndDisplayProducts {
            margin-top: 20px;
            width: 100%;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .divSearchPart {
            padding: 10px;
            width: 50%;
            height: 100%;
        }

        .divDisplayProductsPart {
            padding-left: 100px;
            width: 50%;
            height: 100%;
            display: flex;
        }
    </style>

</div>

<style>
    #sidebar-active {
        color: #0e1111;

        margin: 1rem 1rem 1rem calc(var(--sidebar-width-actual) + 0.75rem);
        /* background-color: yellowgreen; */
        width: (100vw - var(--sidebar-width-actual));
        /* height: 50vh; */

        /* border: 2px solid red; */


        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        border-radius: 10px;
        overflow: hidden;

        max-height: calc(100vh - 2rem);
        overflow: auto;
        /* overflow-y: auto; */

        background-color: var(--off-white);

    }
</style>

<?php $HTMLFooter = new HTMLFooter(); ?>

<script>
    $(document).ready(function() {

        $(document).on("click", ".forget-password", function(event) {
            event.preventDefault();
            $('.fixed-model').fadeIn();
            $('body').css('overflow', 'hidden');
        });

        // on click onsite_alert close_btn
        $(document).on("click", ".onsite_alert .close_btn", function(event) {
            event.preventDefault();

            $(this).parent().animate({
                opacity: 0
            }, 300, function() {
                $(this).slideUp(250, function() {
                    $(this).remove();
                });
            });


        });

    });
</script>