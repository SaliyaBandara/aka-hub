<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("Settings");
?>

<div id="sidebar-active" class="hideScrollbar">
    <?php 
        $welcomeSearch = new WelcomeSearch();
        if(empty($data["reservations"])){
            $counselor_id = "";
        }
        else{
            $counselor_id = $data["reservations"][0]["counselor_id"];
        }
    ?>

    <div class="main-grid flex">
        <div class="leftContent">
            <div class="main-div">
                <div class="section_header mb-1 flex flex-column">
                    <div class="title font-1-5 font-semibold flex align-center counselorID" id = <?=$counselor_id?>>
                        <i class='bx bxs-calendar-check me-0-5'></i> Manage your appointments
                    </div>
                    <select id="status" name="status" style = "width: 20%; " data-validation="required" class="form-control my-1">
                            <option value = 2 >All</option>
                            <option value = 0 >Pending</option>
                            <option value = 1 >Accepted</option>
                            <option value = 3 >Completed</option>
                    </select>
                </div>
                
                <div class="todo_flex_wrap flex flex-wrap" id="reservations">
                    <!-- //status = 0 => created
                    //status = 1 => accepted
                    //status = 2 => declined
                    //status = 3 => accepted and completed
                    //status = 4 => accepted and canceled -->
                    <?php
                    if (empty($data["reservations"])) {
                        echo "<div class='font-medium text-muted'>You have not booked any timeslot for this counselor!</div>";
                    } else {
                            foreach ($data["reservations"] as $reservation) {

                                if($reservation["reservation_status"] == 1){
                                    $class = "primary";
                                    $button = "Accepted";
                                }
                                else if($reservation["reservation_status"] == 3){
                                    $class = "orange";
                                    $button = "Completed";
                                }
                                else if($reservation["reservation_status"] == 0){
                                    $class = "info";
                                    $button = "Pending";
                                }
                    ?>
                        <div class=" card-not-added todo_item flex flex-row justify-between border-<?= $class?>">
                                <div class="content flex flex-column justify-center " style = "width: 70%;">
                                    <div class="my-0-5">
                                        <i class='bx bxs-calendar me-1'></i> Date : <?= date("Y.m.d", strtotime($reservation["date"])) ?>
                                    </div>
                                    
                                    <div class="my-0-5">
                                        <i class='bx bxs-time me-1'></i> Time : <?= date("H:i", strtotime($reservation["start_time"])) ?> to <?= date("H:i", strtotime($reservation["end_time"])) ?>
                                    </div>
                                </div>

                                <?php 
                                    if($reservation["reservation_status"] == 3){
                                        echo'
                                            <div class="buttons flex flex-column justify-center align-center" style = "width: 30%;">
                                                <div href="#" class=" btn btn-'.$class.' form form-group justify-center align-center text-center" style = "max-width: 120px !important;">'.$button.'</div>
                                            </div>';
                                    } 
                                    else{ 
                                        echo'
                                            <div class="buttons flex flex-column" style = "width: 30%; margin: 0 !important;">
                                                <div href="#" class=" btn btn-'.$class.' mb-1 form form-group justify-center align-center text-center" style = "max-width: 120px !important;">'.$button.'</div>
                                                <div href="#" class=" btn btn-danger form form-group justify-center align-center text-center" style = "max-width: 120px !important;">Cancel</div>
                                            </div>';
                                    }
                                ?>
                        </div> 
                    <?php }} ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>

    .wrapper{
        display: flex !important;
        flex-wrap: wrap !important;
        border: 1px solid red;
    }

    .main-grid .leftContent{
        width: 100%;
        height: 700px;
        /* border: 1px solid red; */
        justify-content: center;
        align-items:center;

        height: auto !important;
        min-height: calc(100vh - var(--header-height) - 5rem);
        padding: 2rem;
    }

    .main-grid .rightContent{
        width: 50%;
        /* border: 1px solid red; */
        justify-content: flex-start;
        display: flex;
        flex-direction: column; 

        flex-grow: 1;
        height: auto !important;
        margin-right: 0.75rem;
        
    }

    .profileDescriptionPanel{
        width: 100%;
        display: flex;
        flex-wrap: wrap;
        border-radius: 10px;
        margin-right: 3rem !important;
        /* border: 1px solid red; */
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

    .chatButtonContainer{
        width: 100%;
        /* border: 1px solid red; */
        justify-content: left ;
        align-items: left ;
        display:flex;
        margin: 1rem 0 0 1rem;
    }

    .button-bookNow{
        min-width: 120px;
        text-align: center;
    }

</style>
<style>

    .todo_item {
        text-decoration: none;
        color: initial;

        width: 30rem !important;
        min-width: 300px;
        padding: 1rem;
        margin: 1rem;
        margin-left: 0;
        margin-top: 0;
        border-radius: 10px;
        /* border: 1px solid #1264aba9; */
        /* background-color: #f5f5f5; */

        transition: all 0.3s ease-in-out;
        /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
    }

    .todo_item:hover {
        transform: scale(1.025);
        /* background-color: #f5f5f5;
        background-color: #eeecec;
        background-color: #bdd2f138; */
    }

    .btn-orange{
        background-color: #ff812d;
        color: #ffffff;
        border: none;
        font-size: var(--rv-1);
    }

    .btn-danger {
        font-size: var(--rv-1);
        background-color: #dc1414;
        color: #fff;
    }

    .border-primary{
        border: 1px solid #1264aba9 !important;
    }

    .border-orange{
        border: 1px solid #ff812d !important;
    }

    .border-info{
        border: 1px solid #6c757d !important;
    }

    .latest{
        width: 50%!important ;
    }

</style>

<?php $HTMLFooter = new HTMLFooter(); ?>
<script>
    let BASE_URL = "<?= BASE_URL ?>";
</script>
<script>
    $(document).ready(function() {
        $(document).on("change", "#status", function() {

            let selectedValue = $("#status").val();
            var counselorID = $('.counselorID').attr('id');


            $.ajax({
                url: `${BASE_URL}/counselorView/filter`,
                type: 'post',
                data: {
                    status: selectedValue,
                    counselor_id: counselorID
                },
                success: function(data) {
                    if (data) {
                        $('#reservations').html(data); // Update the content of .feedContainer
                    } else {
                        // Handle empty or invalid response
                        alertUser("warning", "No reservations found.");
                    }
                },
                error: function(ajaxContext) {
                    alertUser("danger", "Something Went Wrong");
                }
            });
        });
    });

</script>