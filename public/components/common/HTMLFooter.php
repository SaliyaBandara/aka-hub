<?php

class HTMLFooter
{
    public function __construct($options = [], $title = null, $desc = null)
    {

?>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
        <script src="<?= BASE_URL ?>/public/assets/libs/@fancyapps/fancybox/dist/jquery.fancybox.min.js"></script>
        <!-- <script src="<?= BASE_URL ?>/public/assets/libs/flickity/dist/flickity.pkgd.min.js"></script>
        <script src="<?= BASE_URL ?>/public/assets/libs/flickity-fade/flickity-fade.js"></script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script> -->

        <!-- if option set for chartjs -->
        <?php if (in_array('chartjs', $options)) { ?>
            <!-- <script src="<?= ASSETS_PATH ?>js/chart.js"></script> -->
        <?php } ?>
        
        <script src="<?= BASE_URL ?>/public/assets/js/common.js"></script>
<?php

    }

}
