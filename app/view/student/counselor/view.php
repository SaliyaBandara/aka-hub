<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("existingCounselors");
?>

<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>

    <div class="main-grid flex">
        <div class="leftContent">
            <div class = "counselorArticlesPanel">
                <div class = "panelTitle">
                    <h4 class = "text-center"> Published Articles </h4>
                </div>
                <?php 
                if (is_array($data["posts"])) {
                        foreach ($data["posts"] as $posts) {
                        $img_src = USER_IMG_PATH . $posts["post_image"];
                    ?>
                    <a class = "articleCard" href = "#">
                        <div class = "articleImage">
                            <img src="<?= $img_src ?>" alt="">
                        </div>
                        <div class = "articleTitle"> <?= $posts["title"] ?></div> 
                        <div class="articleDescription"><?= substr($posts["description"], 0, 50) . (strlen($posts["description"]) > 100 ? '...' : '') ?></div>

                    </a>
                <?php }
                }else{
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
                    <div class = "profileImageContainor">
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
                    <div href="#" class = "chatButtonContainer">
                        <div class = "btn btn-primary mb-1 form form-group chatButton justify-center align-center">
                            Chat Now
                        </div>
                    </div>
                    <div class = "chatButtonContainer">
                        <div class = "btn btn-primary mb-1 form form-group chatButton justify-center align-center load-timeslots" href="#" user-id="<?= $counselor['id'] ?>">
                            Book an appointment
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

        .counselorArticlesPanel{
            width: 100%;
            /* border: 1px solid var(--secondary-color-faded); */
            /* box-shadow: 0 0 5px rgba(0, 0, 0, 0.2); */
            /* height: 500px; */
            display: flex;
            flex-wrap: wrap;
            border-radius: 10px;
            /* border : 1px solid red; */

        }

        .panelTitle{
            width: 100%;
        }

        .articleCard {
            width: 30%;
            min-width: 150px;
            height: 100%;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            margin: 25px;
            border-radius : 10px;
            /* border: 1px solid red; */
            text-decoration : none;
            color : black;
        }

        .articleImage {
            display: flex;
            width: 100%;
            justify-content: center;
            align-items: center;
        }
        
        .articleImage img{
            width: 150px;
            height: 150px;
            margin : 0.5rem;
        }

        .articleTitle{
            text-align : center;
            margin : 0.5rem;
            font-size: 12px;
            font-weight: bold;
            text-decoration : none;
            /* border: 1px solid red; */
        }

        .articleDescription{
            text-align : center;
            margin : 0.5rem;
            font-size: 10px;
            /* border: 1px solid red; */
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