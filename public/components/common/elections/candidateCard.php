<?php

class CandidateCard
{

    public function render($active_page = null)
    {

?>

        <div class="candidateCard">
            <div class="candidateImage"><img src="<?= BASE_URL ?>/public/assets/img/common/candidateImage.jpg" alt=""></div>
            <div class="candidateName">
                <h5>Binura Hasarindu</h5>
            </div>
            <div class="candidateIndex">
                <h5>21001548</h5>
            </div>
            <div class="candidateDetails"><a href="#" onclick="openPopup()">View Details</a></div>
            <div class="candidateVote"><input type="button" value="VOTE!!" class="candidateButton"></div>

        </div>

<?php

    }
}
