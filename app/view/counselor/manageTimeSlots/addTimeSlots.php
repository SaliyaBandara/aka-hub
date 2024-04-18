
<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("manageTimeSlots");
$calendar = new Calendar();
?>

<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>

    <div class="main-grid flex">
        <div class="left">
            
             <!-- ===VIRAJITH=== -->

            <div class="main-div">
                <div class="header-topic">
                    <h1>Manage Time Slots</h1>
                </div>
                <div class="date-range">
                    <p class="p2">From<input type="date"> to <input type="date"><a href="#" class="button-select">Show</a></p>
                    <p class="p1">Please add your available time slots here</p>
                </div>
                <div class="custom-button-div">
                    <a href="#divone" class="button-custom">Create a Custom time slot</a>
                </div>

                <div class="wrapper">
                      
                    <?php
                    if (empty($data["timeslots"])) {
                        echo "NO TIME SLOTS AVAILABLE";
                    } else {
                            foreach ($data["timeslots"] as $timeslot) {
                            // $img_src = USER_IMG_PATH . $reservation_request["cover_img"];
                    ?>
                    
                        <div class="card card-not-added" >
                                <div class="content">
                                    <div class="details">
                                        <i class='bx bxs-time'></i>
                                        <span class="name"><?= date("Y.m.d", strtotime($timeslot["date"])) ?> - <?= date("H:i", strtotime($timeslot["start_time"])) ?> to <?= date("H:i", strtotime($timeslot["end_time"])) ?></span>
                                    </div>
                                </div>
                                <div class="buttons">
                                    <a href="#" class="button-add">Add</a>
                                    <a href="#" class="button-delete">Delete</a>
                                </div>
                                <!-- <div class="card card-not-added" >
                                        <div class="content">
                                            <div class="details">
                                                <i class='bx bxs-time'></i>
                                                <span class="name">8am - 10am</span>
                                            </div>
                                        </div>
                                        <div class="buttons">
                                            <a href="google.com" class="button-add">Add</a>
                                            <a href="google.com" class="button-delete">Delete</a>
                                        </div>   
                                </div>
                                <div class="card card-added" >
                                        <div class="content">
                                            <div class="details">
                                                <i class='bx bxs-time'></i>
                                                <span class="name">10am - 12pm</span>
                                            </div>
                                        </div>
                                        <div class="buttons">
                                            <a href="google.com" class="button-remove">Remove</a>
                                            <a href="google.com" class="button-delete">Delete</a>
                                        </div>   
                                </div>       -->
                        </div> 
                        <!-- <div class="card card-not-added" >
                                <div class="content">
                                    <div class="details">
                                        <i class='bx bxs-time'></i>
                                        <span class="name">8am - 10am</span>
                                    </div>
                                </div>
                                <div class="buttons">
                                    <a href="google.com" class="button-add">Add</a>
                                    <a href="google.com" class="button-delete">Delete</a>
                                </div>   
                        </div>
                        <div class="card card-added" >
                                <div class="content">
                                    <div class="details">
                                        <i class='bx bxs-time'></i>
                                        <span class="name">10am - 12pm</span>
                                    </div>
                                </div>
                                <div class="buttons">
                                    <a href="google.com" class="button-remove">Remove</a>
                                    <a href="google.com" class="button-delete">Delete</a>
                                </div>   
                        </div>
                        <div class="card card-not-added" >
                                <div class="content">
                                    <div class="details">
                                        <i class='bx bxs-time'></i>
                                        <span class="name">12pm - 01pm</span>
                                    </div>
                                </div>
                                <div class="buttons">
                                    <a href="google.com" class="button-add">Add</a>
                                    <a href="google.com" class="button-delete">Delete</a>
                                </div>   
                        </div>
                        <div class="card card-not-added" >
                                <div class="content">
                                    <div class="details">
                                        <i class='bx bxs-time'></i>
                                        <span class="name">01pm - 03pm</span>
                                    </div>
                                </div>
                                <div class="buttons">
                                    <a href="google.com" class="button-add">Add</a>
                                    <a href="google.com" class="button-delete">Delete</a>
                                </div>   
                        </div>
                        <div class="card card-not-added" >
                                <div class="content">
                                    <div class="details">
                                        <i class='bx bxs-time'></i>
                                        <span class="name">03pm - 05pm</span>
                                    </div>
                                </div>
                                <div class="buttons">
                                    <a href="google.com" class="button-add">Add</a>
                                    <a href="google.com" class="button-delete">Delete</a>
                                </div>   
                        </div> -->
                    <?php }} ?>
                </div> 
                <div class="new">
                    <div class="overlay" id="divone">
                        <div class="wrapper1 popup-form">
                            <h2>Create Custom  Time  Slot</h2>
                            <a href="" class="close">&times;</a>
                            <div class="content">
                                <div class="container">
                                    <form class="form" action="" method="post">

                                        <?php
                                            foreach ($data["timeSlot_template"] as $key => $value) {
                                                if (isset($value["skip"]) && $value["skip"] == true)
                                                    continue;
                                            ?>
                                                <div class="fields-container">
                                                    <label for="name" class="form-label"><?= $value["label"] ?></label>
                                                    <input type="<?= $value["type"] ?>" id="<?= $key ?>" name="<?= $key ?>" placeholder="Enter <?= $value["label"] ?>" value="<?= $data["timeSlot"][$key] ?>" <?= $value["validation"] == "required" ? "data-validation='required'" : "" ?> class="form-control">
                                                </div>
                                            <?php
                                            }
                                        ?>
                                            <!-- <div class="fields-container">
                                                <div class="form-line">
                                                    <label class="form-input3">Date :</label>
                                                    <input type="date" name="end_time"><br />
                                                </div> 
                                                <div class="form-line">
                                                    <label class="form-input1">Start Time :</label>
                                                    <input type="time" name="start_time">
                                                </div>
                                                <div class="form-line">
                                                    <label class="form-input2">End Time :</label>
                                                    <input type="time" name="end_time"><br />
                                                </div>    
                                            </div> -->
                                            <div class="submit-form">
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </div>
                                            
                                    </form>

                                     
                                </div>
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
    .one{

    }
    .main-grid .left {
        width: 75%;
        height: 150vh;

    }

    .main-grid .right {
        flex-grow: 1;
        height: 150vh;
    }

    .threeCardDiv {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        height: 175px;
        width: 100%;
        z-index: +5;
        color: white;
        padding: 25px;
    }

    .cardTotalUsers {
        width: 27%;
        height: 100%;
        background-color: #2684FF;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        padding: 1rem;
        justify-content: center;
        align-items: center;
        text-align: center;
        display: flex;
        margin-left: 50px;
    }

    .cardTotalUsers:hover {
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
    }

    .cardActiveUsers {
        width: 27%;
        height: 100%;
        background-color: #ff9b2d;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        padding: 1rem;
        justify-content: center;
        align-items: center;
        display: flex;
    }

    .cardActiveUsers:hover {
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
    }

    .cardNewUsers {
        width: 27%;
        height: 100%;
        background-color: #2684FF;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        padding: 1rem;
        justify-content: center;
        align-items: center;
        margin-right: 50px;
        display: flex;
    }

    .cardNewUsers:hover {
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
    }

    .divUsersContainor {
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

</style>

<style>
    .wrapper{
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        /* height: 100vh; */
        /* min-height: 100vh; */
        /* z-index: +5; */
        /* margin-top: -200px; */
    }

    .wrapper .card{
        
        width: 80%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px;
        position:relative;
        margin-bottom: 20px;
        border-radius: 20px 20px 20px 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
    }

    .card-not-added{
        background: #eeecec;
    }
    .card-added{
        background: #ff9b2d;
    }
    .card .content{
        display: flex;
        align-items: center;

    }

    .card .details {
        margin-left: 80px;
    }

    .details span{
        font-weight: 600;
        font-size: 18px;
    }
    .details i{
        margin-right: 30px;
        margin-left: -50px;
        font-size: 24px;
    }
    .card a{
        text-decoration: none;
        display: inline-block;
        padding: 10px 20px;
        border-radius: 25px;
        color: #fff;
        /* background: linear-gradient(to bottom, #bea2e7 0%, #86b7e7 100%); */
    }

    .date-range{
        text-align: center;
    }
    .date-range input{
        margin-right: 10px;
        margin-left: 10px;
        width: 20%;
        padding: 8px;
        border-radius: 8px;
        border-style: groove;
        background-color: #fff;
    }
    .button-add{
        background: #2684FF;
        width: 100px;
        text-align: center;
    }
    .button-delete{
        background: red;
        width: 100px;
        text-align: center;
    }
    .button-remove{
        background: #2684FF;
        width: 100px;
        text-align: center;
    }
    .header-topic{
        text-align: center;
    }
    .button-select{
        text-decoration: none;
        display: inline-block;
        padding: 10px 20px;
        border-radius: 25px;
        color: #fff;
        background: #2684FF;
    }
    .p1{
        font-size: 20px;
        font-weight: 700;
    }
    .p2{
        font-size: 18px;
        font-weight: 700;
    }
    .button-custom{
        text-decoration: none;
        display: inline-block;
        padding: 10px 20px;
        border-radius: 25px;
        color: #fff;
        background: #2684FF;
        align-items: center;
    }
    .custom-button-div{
        margin-bottom:40px;
        text-align: center;
    }
</style>

<style>
    .overlay{
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.8);
        transition: opacity 500ms;
        visibility: hidden;
        opacity: 0;
        z-index: 1001;
    }
    .overlay:target{
        visibility: visible;
        opacity: 1;
    }
    .wrapper1{
        margin: 70px auto;
        padding: 20px;
        background: #e7e7e7;
        border-radius: 5px;
        width: 30%;
        position: relative;
        transition: all 5s ease-in-out;
        margin-top: 300px;
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
    }
    form label{
        text-transform: uppercase;
        font-weight: 500;
        letter-spacing: 3px;
    }
    .container input[type="text"]{
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        margin-top: 6px;
        margin-bottom: 16px;
        resize: vertical;
    }
    .container input[type="submit"]{
        background-color: #2684FF;
        color: #fff;
        padding: 15px 50px;
        border: none;
        border-radius: 50px;
        cursor: pointer;
        font-size: 15px;
        text-transform: uppercase;
        letter-spacing: 3px;
    }
    .popup-form{
        width: 23%;
        padding: 8px;
        border-radius: 8px;
        border-style: groove;
        background-color: #fff; 
    }
    .form-1{
        text-align: center;
    }
   
    .submit-form{
        margin-top: 20px;
    }

    .form-1 input[type="time"]{
        margin: 0 auto; /* Center horizontally */
        margin-right: 10px;
        margin-left: -15px;
        width: 150px;
        padding: 5px;
        border-radius: 8px;
        /* border-style: groove; */
        /* background-color: #fff; */
    }
    .form-1 input[type="date"]{
        margin: 0 auto; /* Center horizontally */
        margin-right: 10px;
        margin-left: -15px;
        width: 150px;
        padding: 5px;
        border-radius: 8px;
        /* border-style: groove; */
        /* background-color: #fff; */
    }

    .wrapper1 h2{
        text-align: center;
    }
    .form-input1{
        margin-right: 26px;
    }
    .form-input2{
        margin-right: 50px ;
    }
    .form-input3{
        margin-right: 93px ;
    }
    .form-line{
        margin-bottom: 20px;
    }
    .fields-container {
        text-align: left;
        align-items: center;
    }
</style>

<?php $HTMLFooter = new HTMLFooter(); ?>
<script>
    let BASE_URL = "<?= BASE_URL ?>";
</script>
<script>
    $(document).ready(function() {
        $('form').submit(function(event) {
                event.preventDefault();
                var input = $(this);
                // var $inputs = $('form :input');
                var $inputs = $(this).find(':input');

                var values = {};
                let empty_fields = []
                $inputs.each(function() {
                    values[this.name] = $(this).val();
                    if ($(this).attr("data-validation") != undefined && $(this).is("input") && $(this).val() === "" ||
                        $(this).is("select") && $(this).val() === "0") {
                        empty_fields.push($(this));
                        $(this).addClass("border-danger");
                    } else {
                        $(this).removeClass("border-danger");
                    }
                });

                setTimeout(() => {
                    empty_fields.forEach(element => element.removeClass("border-danger"));
                }, 6000);

                if (empty_fields.length > 0) {
                    empty_fields[0].focus();
                    return alertUser("warning", `Please fill all the fields`);
                }

                $.ajax({
                    // url: url,
                    type: 'post',
                    data: {
                        addtimeslots: values //methana ******
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response['status'] == 200) {
                            alertUser("success", response['desc'])
                            setTimeout(function() {
                                history.go(-1);
                                window.close();
                            }, 2000);

                        } else if (response['status'] == 403)
                            alertUser("danger", response['desc'])
                        else
                            alertUser("warning", response['desc'])
                    },
                    error: function(ajaxContext) {
                        alertUser("danger", "Something Went Wrong")
                    }
                });
            });        
    });    
</script>





