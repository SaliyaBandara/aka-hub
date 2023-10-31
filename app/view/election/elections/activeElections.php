<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("activeElection");
$candidateCard = new CandidateCard();
?>

<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch("Saliya", "Bandara"); ?>
    <div class="main-grid flex">
        <div class="left">
            <div id="activeElection">
                <div id="electionDetails" class="text-center">University of Colombo School of Computing <br />
                    Student Union Selection <br />
                    2024
                </div>
                <div id="electionTime" class="text-muted text-center">Election ends in : 1hr 30min 4sec</div>
                <div class="text-left" id="question">Candidates</div>
                <div class="justify-between flex flex-wrap">
                    <?php echo $candidateCard->render();
                    echo $candidateCard->render();
                    echo $candidateCard->render();
                    echo $candidateCard->render();
                    echo $candidateCard->render();
                    echo $candidateCard->render();
                    echo $candidateCard->render();
                    echo $candidateCard->render();
                    ?>
                </div>
                
                <div class="overlay" onclick="closePopup()"></div>

                <div class="popup" id="popup">
                    <div><p class="popupDetails"><b>Candidate's Name :</b> Binura Hasarindu</p></div>
                    <div><p class="popupDetails"><b>Candidate's Degree :</b> Computer Science</p></div>
                    <div><p class="popupDetails"><b>Candidate's Extra Curricular :</b> Athletics</p></div>
                    <button onclick="closePopup()" class="candidateButton" id="popupButton">Close</button>
                </div>

                <!-- <div class="text-left" id="question">Positional Votes</div>-->
            </div>
        </div>
    </div>

    <style>
        .candidateCard {
            height: 300px;
            border-radius: 10px;
            background: white;
            padding: 20px;
            margin: 20px;
            width: calc(25% - 2 * 20px);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);

        }

        .candidateImage img {
            border-radius: 100px;
            width: 120px;
            height: 120px;
            /* margin-left: 20px; */
            margin: 0 auto;
            margin-bottom: 20px;
        }

        h5 {
            display: inline;
            margin: 0;
            padding: 0;
            font-weight: 500;
        }

        .candidateName,
        .candidateIndex {
            text-align: center;
            font-size: 18px;
        }

        .candidateDetails a {
            text-decoration: none;
            color: rgba(0, 0, 0, 0.75);
            font-size: 10px;
            font-style: italic;
            text-decoration-line: underline;
        }

        .candidateDetails {
            text-align: center;
        }

        .candidateVote {
            margin: 0 auto;
            display: flex;
        }

        .candidateButton {
            border-radius: 20px;
            background: #2684FF;
            color: white;
            border: none;
            font-size: 12px;
            height: 20px;
            
            width: 60%;
            margin: 0 auto;
            margin-top: 10px;
        }

        #popupButton{
            width: 80px;
            margin-left:120px;
        }

        .candidateButton:hover {
            cursor: pointer;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);

        }

        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            z-index: 9999;
            box-shadow: 0 0 15px rgba(38, 132, 255, 0.2);
        }

        .popupDetails{
            color: black;
        }

        /* Overlay to cover the entire page behind the pop-up */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 9998;
            backdrop-filter: blur(5px); /* Apply background blur */
        }


    </style>

    <style>
        .main-grid {}

        .main-grid .left {
            width: 100%;
            height: 130vh;
            margin: 20px;
        }

        #electionDetails {
            text-align: center;
            font-weight: bold;
        }

        #activeElection {
            padding: 20px;
        }

        #electionTime {
            margin-top: 5px;
            font-size: 14px;
            font-style: italic;
        }

        #question {
            font-weight: 600;
            margin-top: 20px;
        }
    </style>

</div>

<script>
        function openPopup() {
            document.getElementById("popup").style.display = "block";
            document.querySelector('.overlay').style.display = 'block';
        }

        function closePopup() {
            document.getElementById("popup").style.display = "none";
            document.querySelector('.overlay').style.display = 'none';
        }
</script>