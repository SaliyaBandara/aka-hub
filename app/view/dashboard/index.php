<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("dashboard");
?>

<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch("Saliya", "Bandara"); ?>

    <div class="main-grid flex">
        <div class="left">
            <a href="" class="onsite_alert alert-success flex align-center">
                <div>The union election is ongoing......</div>
                <div class="close_btn">
                    <i class='bx bx-x'></i>
                </div>
            </a>


            <!-- section header -->
            <section>
                <div class="section_header mb-1 flex">
                    <div class="title font-1-5 font-semibold flex align-center">
                        <i class='bx bxs-calendar-check me-0-5'></i> To Do List
                    </div>
                </div>

                <!-- todo flex wrap -->
                <div class="todo_flex_wrap flex flex-wrap">

                    <a href="#" class="todo_item flex align-center">
                        <div>
                            <div class="todo_item_date flex align-center justify-center">15</div>
                        </div>
                        <div class="todo_item_text">
                            <div class="font-1-25 font-semibold">Computer Networks</div>
                            <div class="font-1 font-medium text-muted">Take Home Assignment</div>
                            <div class="font-0-8 text-muted">Deadline : Tuesday, 10 June</div>
                        </div>
                    </a>
                    <a href="#" class="todo_item flex align-center">
                        <div>
                            <div class="todo_item_date flex align-center justify-center">15</div>
                        </div>
                        <div class="todo_item_text">
                            <div class="font-1-25 font-semibold">Computer Networks</div>
                            <div class="font-1 font-medium text-muted">Take Home Assignment</div>
                            <div class="font-0-8 text-muted">Deadline : Tuesday, 10 June</div>
                        </div>
                    </a>
                    <a href="#" class="todo_item flex align-center">
                        <div>
                            <div class="todo_item_date flex align-center justify-center">15</div>
                        </div>
                        <div class="todo_item_text">
                            <div class="font-1-25 font-semibold">Computer Networks</div>
                            <div class="font-1 font-medium text-muted">Take Home Assignment</div>
                            <div class="font-0-8 text-muted">Deadline : Tuesday, 10 June</div>
                        </div>
                    </a>

                </div>

                <style>
                    .todo_flex_wrap {
                        /* display: flex;
                        flex-wrap: wrap;
                        justify-content: space-between; */
                    }

                    .todo_item {
                        text-decoration: none;
                        color: initial;

                        width: calc(40% - 2rem);
                        min-width: 300px;
                        padding: 1rem;
                        margin: 1rem;
                        margin-left: 0;
                        margin-top: 0;
                        border-radius: 10px;
                        border: 1px solid #d0d0d0;
                        /* background-color: #f5f5f5; */

                        transition: all 0.3s ease-in-out;
                        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
                    }

                    .todo_item:hover {
                        transform: scale(1.025);
                        background-color: #f5f5f5;
                        background-color: #eeecec;
                        background-color: #bdd2f138;
                    }

                    .todo_item .todo_item_date {
                        width: 4.5rem;
                        height: 4.5rem;
                        border-radius: 50%;
                        border: 5px solid #bdd2f1;
                        font-size: 2rem;
                        font-weight: 500;
                    }

                    .todo_item .todo_item_text {
                        margin-left: 1.5rem;
                    }

                    .todo_item .todo_item_text>div {
                        margin-bottom: 0.25rem;
                    }
                </style>


            </section>

        </div>
        <div class="right"></div>
    </div>

    <style>
        .main-grid {}

        .main-grid .left {
            width: 70%;
            /* background-color: yellowgreen; */
            height: 50vh;
            padding: 2rem;
        }

        .main-grid .right {
            flex-grow: 1;
            background-color: yellowgreen;
            height: 150vh;
        }

        .onsite_alert {
            text-decoration: none;
            width: 100%;
            padding: 0.75rem 1rem;
            padding-right: 0;
            background-color: #e5f9e5;
            border-radius: 10px;
            margin-bottom: 1rem;
        }

        .onsite_alert .close_btn {
            margin-left: auto;
            cursor: pointer;
            font-size: var(--rv-1-25);
            padding: 0 1rem;
        }

        .onsite_alert .close_btn:hover {
            color: red;
        }

        .onsite_alert.alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
    </style>

</div>


<?php $HTMLFooter = new HTMLFooter(); ?>

<script>
    $(document).ready(function () {

        $(document).on("click", ".forget-password", function (event) {
            event.preventDefault();
            $('.fixed-model').fadeIn();
            $('body').css('overflow', 'hidden');
        });

        // on click onsite_alert close_btn
        $(document).on("click", ".onsite_alert .close_btn", function (event) {
            event.preventDefault();

            $(this).parent().animate({
                opacity: 0
            }, 300, function () {
                $(this).slideUp(250, function () {
                    $(this).remove();
                });
            });


        });

    });
</script>