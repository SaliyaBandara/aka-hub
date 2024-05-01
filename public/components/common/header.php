<?php

class Header
{

    public function __construct($active_page = null)
    {

        $pages = [
            // 'home' => 'Home',
            // 'profile' => 'Profile',
            // 'about' => 'About Us',
            // 'contact' => 'Contact Us',
        ];

?>

        <header class="m--none">
            <div class="container">
                <div class="header__logo">
                    <a href="<?= BASE_URL ?>/">
                        <img src="<?= BASE_URL ?>/public/assets/img/logo/logo.png" alt="logo">
                    </a>
                </div>
                <div class="header__list">
                    <ul>
                        <?php
                        foreach ($pages as $key => $value) {
                            $active = "";
                            if ($key == $active_page)
                                $active = "active";
                            if ($key == "home")
                                $key = "";

                            echo "<li class='$active'><a href='" . BASE_URL . "/$key'>$value</a></li>";
                        }
                        ?>
                    </ul>
                </div>
                <div class="header__login">
                    <?php
                    // TODO: Check logged in
                    /*
                     if () { ?>
                        <div class="profile__pill">
                            <span><?= $_SESSION['fname'] . "." . substr($_SESSION['lname'], 0, 1) ?></span>
                            <div class="profile__img">
                                <img src="<?= BASE_URL ?>/public/assets/img/common/user_default.jpg" alt="">
                            </div>
                            <div class="list__wrapper">
                                <ul>
                                    <li><a href="<?= BASE_URL ?>/profile">Profile</a></li>
                                    <li><a href="<?= BASE_URL ?>/logout">Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    <?php
                 } else { ?>
                        <a href="<?= BASE_URL ?>/auth" class="btn btn--primary">Login</a>
                    <?php } ?>

                    */
                    ?>
                    <a href="<?= BASE_URL ?>/auth?action=register" class="btn btn--primary me-1">Register</a>
                    <a href="<?= BASE_URL ?>/auth" class="btn btn--secondary">Log In</a>
                </div>
            </div>
        </header>

        <header class="m--only">
            <div class="container">
                <div class="header__logo">
                    <a href="<?= BASE_URL ?>./.">
                        <img src="<?= BASE_URL ?>/public/assets/img/logo/logo.png" alt="logo">
                    </a>
                </div>

                <div class="hamburger">
                    <label class="checkboxLabel noSelect" for="check">
                        <input type="checkbox" id="check" autocomplete='off'>
                        <span></span>
                        <span></span>
                        <span></span>
                    </label>
                </div>
            </div>

            <!-- <div class="mobile__menu">
                <a class="active" href="<?= BASE_URL ?>/">Home</a>
                <a href="<?= BASE_URL ?>/profile">Profile</a>
                <a href="<?= BASE_URL ?>/contact">Contact Us</a>
                <a class="text--primary" href="<?= BASE_URL ?>/auth">+ Sign In</a>
            </div> -->
        </header>

        <div class="sidebar__mask m--only"></div>
        <div class="header__spacer m--only"></div>

<?php

    }
}
