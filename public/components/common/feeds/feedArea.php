<?php

class FeedArea
{

    public function render()
    {
        $feedPost = new FeedPost();
?>
        <div class="feedContainor">
            <?php echo $feedPost->render(); ?>
            <?php echo $feedPost->render(); ?>
            <?php echo $feedPost->render(); ?>
        </div>
        <style>
            .feedContainor {
                width: 100%;
                height: 100%;
                justify-content: center;
            }

            /* .feedContainor h3 {
                text-align: center;
                width: 92%;
            } */
        </style>

        <script>

        </script>

<?php

    }
}
