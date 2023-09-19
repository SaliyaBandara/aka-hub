<?php

class NotificationCard
{

    public function render()
    {

?>
        <div class="notification-card">
            <div class="notification-text-div">
                Sample Notification
            </div>
        </div>
        <style>
            .notification-card {
                background-color: white;
                width: 90%;
                height: 50px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
                justify-content: center;
                align-items: center;
                display: flex;
                margin: 10px 0 10px 3px;
            }

            .notification-text-div {
                text-align: center;
            }
        </style>

        <script>

        </script>

<?php

    }
}
