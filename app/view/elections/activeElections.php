<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar();
$candidateCard = new CandidateCard();
?>

<div id="sidebar-active">

    <div class="welcome-back">
        <div class="flex flex_container">
            <div class="flex_item">
                <div class="title pb-0-5">Welcome back</div>
                <div class="text-muted">Hi Samudi Perera</div>
            </div>
            <div class="flex_item search_flex">
                <form class="flex w-100" action="" method="get">
                    <button class="btn" type="submit">
                        <i class='bx bx-search'></i>
                    </button>
                    <input class="form-group" type="text" name="q" id="" placeholder="Search" />
                </form>
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
                <div class="text-left" id="question">Positional Votes</div>
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

        .candidateVote input {
            border-radius: 20px;
            background: .2684FF;
            color: white;
            border: none;
            font-size: 12px;
            height: 20px;
            
            width: 60%;
            margin: 0 auto;
        }

        .candidateVote input:hover {
            cursor: pointer;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);

        }
    </style>

    <style>
        .main-grid {}

        .main-grid .left {
            width: 100%;
            height: 300vh;
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