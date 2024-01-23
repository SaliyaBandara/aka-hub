<?php

class WelcomeSearch
{

    public function __construct()
    {
        if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == true)
            $user_name = $_SESSION["user_name"];
?>
        <div class="welcome-back fixed">
            <div class="flex flex_container">
                <div class="flex_item">
                    <div class="title pb-0-5">Welcome back</div>
                    <div class="text-muted">Hi <?= "$user_name" ?></div>
                </div>
                <div class="flex_item search_flex">
                    <form class="flex w-100" action="" method="get">
                        <button class="btn" type="submit">
                            <i class='bx bx-search'></i>
                        </button>
                        <input class="form-group" type="text" name="q" id="" placeholder="Search" />
                    </form>
                </div>
                <div class="flex_item">
                    <div class="title">Notifications</div>
                    <div class="text-muted">Hi <?= "$user_name" ?></div>
                </div>
            </div>
        </div>

        <div class="welcome-back opacity-0 pointer-events-none">
            <div class="flex flex_container">
                <div class="flex_item">
                    <div class="title pb-0-5"></div>
                    <div class="text-muted"></div>
                </div>
                <div class="flex_item search_flex">
                    <form class="flex w-100" action="" method="get">
                        <button class="btn" type="submit">
                            <i class='bx bx-search'></i>
                        </button>
                        <input class="form-group" type="text" name="q" id="" placeholder="Search" />
                    </form>
                </div>
                <div class="flex_item">
                    <div class="title"></div>
                    <div class="text-muted"></div>
                </div>
            </div>
        </div>

<?php
    }
}
