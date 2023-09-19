<?php

class Notifications
{

    public function render()
    {
        $notificationCard = new NotificationCard();
?>
        <div class="notificationContainor">
            <h3>Notifications</h3>
            <?php echo $notificationCard->render(); ?>
            <?php echo $notificationCard->render(); ?>
            <?php echo $notificationCard->render(); ?>
            <?php echo $notificationCard->render(); ?>
            <?php echo $notificationCard->render(); ?>
        </div>
        <style>
            .notificationContainor {
                width: 95%;
                height: 400px;
                margin: 50px 0 50px 0;
                padding-left: 30px;
                justify-content: center;
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
