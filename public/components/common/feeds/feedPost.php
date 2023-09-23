<?php

class FeedPost
{

    public function render()
    {

?>
        <div class="feed-post">
            <div class="feed-text-div">
                <img class="eventPost" src="<?= BASE_URL ?>/public/assets/user_uploads/ClubEventFeed/sample post 1.jpg" alt="">
                <p>Gratitude should be paid where it's due…</br>

                    Our sense of obligation extends towards our distinguished member speakers and the wonderful audience in making this event, a grand success.</br>

                    We sincerely thank the participants for valuing our efforts and for having been a great audience.</br>

                    Until we meet again, au revoir…</br>

                    #ACM #UCSC #ACMSCUCSC</p>
                <div class="editDeleteButton">
                    <div class="repEdit">
                        <img src="<?= BASE_URL ?>/public/assets/img/icons/edit.png" alt="">
                    </div>
                    <div class="repDecline">
                        <img src="<?= BASE_URL ?>/public/assets/img/icons/delete.png" alt="">
                        <!-- <img src="https://cdn-icons-png.flaticon.com/512/5508/5508714.png" alt=""> -->
                    </div>
                </div>
            </div>

        </div>
        <style>
            .repEdit {
                display: flex;
                justify-content: center;
                align-items: center;
                width: 50px;
            }

            .repDecline {
                display: flex;
                justify-content: center;
                align-items: center;
                width: 50px;
            }

            .repEdit img {
                width: 35px;
                height: 35px;
            }

            .repDecline img {
                width: 35px;
                height: 35px;
            }

            .repEdit img:hover {
                width: 67px;
                height: 67px;
                cursor: pointer;
            }

            .repDecline img:hover {
                width: 37px;
                height: 37px;
                cursor: pointer;
            }

            .editDeleteButton {
                width: 100%;
                height: 50px;
                display: flex;
                justify-content: right;
                align-items: center;
            }

            .eventPost {
                width: 100%;
                height: 600px;
            }

            .feed-post {
                background-color: white;
                width: 100%;
                height: 850px;
                border-radius: 5px;
                justify-content: center;
                display: flex;
                margin: 0 0 100px 0;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            }

            .feed-text-div {
                text-align: center;
            }

            .feed-text-div p {
                text-align: justify;
                padding: 20px;
            }
        </style>

        <script>

        </script>

<?php

    }
}
