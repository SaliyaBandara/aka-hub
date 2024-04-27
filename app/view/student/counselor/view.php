<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("existingCounselors");
?>

<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>

    <div class="main-grid flex">
        <div class="leftContent">
            <div class = "counselorArticlesPanel flex flex-column">
                    <div class="section_header mb-1 flex">
                        <div class="title font-1-5 font-semibold flex align-center">
                            <i class='bx bxs-donate-heart me-0-5'></i> Published Articles
                        </div>
                    </div>
                    <div class="flex flex-row elections-grid">
                <?php 
                if (is_array($data["posts"])) {
                        foreach ($data["posts"] as $posts) {
                        $img_src = USER_IMG_PATH . $posts["post_image"];
                    ?>
                    
                        <a class = "election-item" href = "<?= BASE_URL?>/counselorFeed/postView/<?=$posts["id"]?>">
                            <div class = "img">
                                <img src="<?= $img_src ?>" alt="">
                            </div>
                            <div class = "title"> <?= $posts["title"] ?></div> 
                            <div class="desc"><?= substr($posts["description"], 0, 50) . (strlen($posts["description"]) > 100 ? '...' : '') ?></div>

                        </a>
                <?php } ?>
                    </div>
                <?php }else{
                    echo "<div class='font-meidum text-muted'>No articles are published by this counselor</div>";
                }
                ?>
                
            </div>
        </div>
        <div class = "rightContent">
            <div class = "profileDescriptionPanel">
                <?php 
                    foreach ($data["counselor"] as $counselor) {
                    $img_src = USER_IMG_PATH . $counselor["profile_img"];
                ?>
                <div class = "descriptionPanelLeft">
                    <div class = "profileImageContainor img">
                        <img src="<?= $img_src ?>" alt="">
                    </div>
                </div>
                <div class = "profileDetailsContainer">
                    <div class = "font-1-25 font-semibold ms-1 mt-2"><?= $counselor["name"] ?></div>
                    <div>
                    <?php
                        
                        if ($counselor["type"] == 1) {
                                echo '<div class = "font-1 font-meidum text-muted ms-1 mt-0-5">Professional Counselor</div>';
                        } else {
                            echo '<div class = "font-1 font-meidum text-muted ms-1 mt-0-5">Student Counselor</div>';
                        }
                        ?>

                    </div>
                    <div class = "font-1 text-muted ms-1 mt-0-5">You can now talk with the professional counselors to reserve a date for your appointment</div>
                    <div class="flex flex-row">
                        <div href="#" class = "me-1 mt-1 ms-1">
                            <div class = "btn btn-primary mb-1 form form-group chatButton justify-center align-center">
                                Chat Now
                            </div>
                        </div>
                        <div class = "mt-1">
                            <div class = "btn btn-primary mb-1 form form-group chatButton justify-center align-center load-timeslots" href="#" user-id="<?= $counselor['id'] ?>">
                                Book an appointment
                            </div>
                        </div>
                    </div>
                </div>
                <?php  } ?>
            </div>
        </div>
    </div>

    <style>
        .main-grid .leftContent{
            width: 50%;
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
            /* border: 1px solid var(--secondary-color-faded); */
            /* box-shadow: 0 0 5px rgba(0, 0, 0, 0.2); */
            /* height: 500px; */
            display: flex;
            flex-wrap: wrap;
            border-radius: 10px;
            margin-right: 3rem !important;
            margin-top: 3rem;
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

        /* .chatButton{
            border: 1px solid #2684ff;
            background-color: var(--secondary-color);
            color: white;
            width: 100%;
            text-align:center;
        } */

        .chatButtonContainer{
            width: 100%;
            /* border: 1px solid red; */
            justify-content: left ;
            align-items: left ;
            display:flex;
            margin: 1rem 0 0 1rem;
        }

        .elections-grid {
            padding: var(--rv-1);
            padding-top: var(--rv-0-5);

            display: flex;
            flex-wrap: wrap;
        }

        .elections-grid .election-item {
            position: relative;
            display: block;
            text-decoration: none;

            margin: 1rem 0.5rem;
            width: calc(50% - (0.5rem * 2));
            padding: 1.5rem;
            padding: 1.2vw;

            /* margin-bottom: 2rem; */
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0px 18.83px 47.08px rgba(47, 50, 125, 0.1);
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;

            font-size: clamp(12px, 0.9vw, 18px);
            color: #19191b;
        }

        .elections-grid .election-item>div:not(:last-child) {
            margin-bottom: var(--rv-0-75);
        }

        .elections-grid .election-item:hover {
            transform: translateY(-10px);
        }

        .elections-grid .election-item .img {
            height: 230px;
            height: clamp(170px, 24vh, 240px);
            margin-bottom: 1rem;
        }

        .elections-grid .election-item .img img {
            object-fit: cover;
            border-radius: 15px;
        }

        .elections-grid .election-item .title {
            font-size: clamp(14px, 1.1vw, 20px);
            font-weight: 600;
        }

        .elections-grid .election-item .desc {
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }


    </style>


</div>

<?php $HTMLFooter = new HTMLFooter(); ?>
<script>
    let BASE_URL = "<?= BASE_URL ?>";
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var BookApoinment = document.querySelectorAll('.load-timeslots');

        BookApoinment.forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                var user_id = button.getAttribute('user-id');
                console.log(user_id);
                var xhr = new XMLHttpRequest();
                xhr.open('GET', BASE_URL + '/counselorView/bookReservation/' + user_id, true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        window.location.href = BASE_URL + '/counselorView/bookReservation/' + user_id;
                    }
                };
                xhr.send();
            });
        });
    });     
</script>