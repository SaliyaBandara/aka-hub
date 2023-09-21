<?php

class ApproveArea
{

    public function render()
    {
        $approveCard = new ApproveCards();
?>
        <div class="cardContainor">
            
            <?php echo $approveCard->render(); ?>
            <?php echo $approveCard->render(); ?>
            <?php echo $approveCard->render(); ?>
            <?php echo $approveCard->render(); ?>
            <?php echo $approveCard->render(); ?>
            <?php echo $approveCard->render(); ?>
            <?php echo $approveCard->render(); ?>
            <?php echo $approveCard->render(); ?>
            <?php echo $approveCard->render(); ?>
            <?php echo $approveCard->render(); ?>
        </div>
        <style>
            .cardContainor {
                width: 100%;
                height: 800px;
                margin: 50px 0 50px 0;
                padding-left: 100px;
                justify-content: center;
                align-items: center;
            }

            .notificationContainor h3 {
                text-align: center;
                width: 92%;
            }
        </style>

        <script>

        </script>

<?php

    }
}
