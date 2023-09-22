<?php

class CandidateCard
{

    public function render($active_page = null)
    {

?>

    <div id = "candidateCard">
        <div id = "candidateImage"><img src="<?= BASE_URL ?>/public/assets/img/common/candidateImage.jpg" alt=""></div>
        <div id = "candidateName"><h5>Binura Hasarindu</h5></div>
        <div id = "candidateIndex"><h5>21001548</h5></div>
        <div id = "candidateDetails"><a href="http://" target="_blank" rel="noopener noreferrer">View Details</a></div>
        <div id = "candidateVote"><input type = "button" value = "VOTE!!"></div>
    </div>


        <style>
            #candidateCard {
                width: 200px;
                height: 300px;
                border-radius: 10px;
                background: white;
                padding : 20px;
                margin : 20px;
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
                
            }

            #candidateImage img{
                border-radius : 100px;
                width : 120px;
                height : 120px;
                margin-left : 20px;
                margin-bottom : 20px;
            }

            h5 {
                display : inline;
                margin : 0;
                padding : 0;
            }

            #candidateName , #candidateIndex  {
                font-weight : 700px;
                text-align : center;
                font-size : 18px;
            }

            #candidateDetails a {
                text-decoration : none;
                color : rgba(0, 0, 0, 0.75);
                font-size : 10px;
                font-style : italic;
                text-decoration-line: underline;
            }

            #candidateDetails {
                text-align : center;
            }

            #candidateVote input {
                border-radius: 20px;
                background: #2684FF;
                color : white;
                border : none;
                font-size : 12px;
                width: 75px;
                height: 20px;
                margin : 30px 0px 0px 43px;
            }

            #candidateVote input:hover{
                cursor: pointer;
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
                
            }

        </style>

<?php

    }
}
