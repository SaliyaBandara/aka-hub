<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("manageMaterials");
?>


<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>

    <div class="main-grid flex">
        <div class="leftManageMaterials">
            <div class="addMaterialDiv">
                <a href="<?= BASE_URL ?>/Courses/material">
                    <div class="buttonAddMaterials">
                        <h4>Add Material</h4>
                    </div>
                </a>
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
                                    Course Code
                                </div>
                                <div class="tableHeaderItem">
                                    Subject
                                </div>
                                <div class="tableHeaderItem">
                                    Year
                                </div>
                                <div class="tableHeaderItem">
                                    Semester
                                </div>
                                <div class="tableHeaderItem">
                                    User
                                </div>
                                <div class="tableHeaderItem">
                                    Reg Number
                                </div>
                                <div class="tableHeaderItem">
                                    Action
                                </div>
                            </div>

                            <div class="scrollableContainer">
                                <?php
                                foreach ($data["materials"] as $material) {
                                ?>
                                    <div class="materialCard">
                                        <div class="tableItem">
                                            <?php echo $material['course_code']; ?>
                                        </div>
                                        <div class="tableItem">
                                            <?php echo $material['course_name']; ?>
                                        </div>
                                        <div class="tableItem">
                                            <?php echo $material['year']; ?> year
                                        </div>
                                        <div class="tableItem">
                                            SEM <?php echo $material['semester']; ?>
                                        </div>
                                        <div class="tableItem">
                                            <?php echo $material['user_name']; ?>
                                        </div>
                                        <div class="tableItem">
                                            <?php echo $material['student_id']; ?>
                                        </div>
                                        <div class="tableItem">
                                            <div class="acceptButton" href="">View</div>
                                            <div class="declineButton">Delete</div>
                                        </div>
                                    </div>

                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
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
<style>
    .scrollableContainer {
        height: 550px;
        overflow-y: auto;
        overflow-x: hidden;
    }

    .addMaterialDiv {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: left;
    }

    .tableFootLeft {
        width: 50%;
        height: 100%;
    }

    .tableFootRight {
        width: 50%;
        height: 100%;
    }

    .tableFoot {
        width: 100%;
        height: 50px;
        margin-top: 10px;
        display: flex;
    }

    .tableArea {
        width: 100%;
        height: auto;
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
        background-color: #2684FF;
        color: white;
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
        background-color: #ff9b2d;
        color: white;
        border-radius: 5px;
        margin: 5px;
    }

    .acceptButton:hover {
        background-color: #2684FF;
        opacity: 1;
        cursor: pointer;
        color: white;
    }

    .declineButton:hover {
        background-color: #ff9b2d;
        opacity: 1;
        cursor: pointer;
        color: white;
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
        height: 55px;
        justify-content: space-between;
        align-items: center;
        display: flex;
    }





    .main-grid {}

    .h3-RepApprove {
        text-align: center;
        margin-bottom: 20px;
        width: 100%;
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
        padding: 0 130px 0 130px;
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
        width: 100%;
        height: auto;
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

    .main-grid .leftManageMaterials {
        width: 100%;
        /* background-color: yellowgreen; */
        height: auto;
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

    .leftManageMaterials {
        width: 100%;
        height: auto;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: center;
    }
</style>

</div>

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