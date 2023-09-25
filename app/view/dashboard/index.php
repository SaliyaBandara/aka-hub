<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("home");
?>

<div id="sidebar-active" class="hideScrollbar">
    <div class="welcome-back fixed">
        <div class="flex flex_container">
            <div class="flex_item">
                <div class="title pb-0-5">Welcome back</div>
                <div class="text-muted">Hi Saliya Bandara</div>
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
                <div class="text-muted">Hi Saliya Bandara</div>
            </div>
        </div>
    </div>
    <div class="welcome-back opacity-0 pointer-events-none	">
        <div class="flex flex_container">
            <div class="flex_item">
                <div class="title pb-0-5">Welcome back</div>
                <div class="text-muted">Hi Saliya Bandara</div>
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
                <div class="text-muted">Hi Saliya Bandara</div>
            </div>
        </div>
    </div>

    <style>
        .welcome-back {
            width: calc(100vw - (var(--sidebar-width-actual) + 1.75rem));
            padding: 0.5rem 1rem;
            background-color: var(--off-white);
            border-radius: 10px 10px 0 0;

            /* border bottom */
            border-bottom: 1px solid #e5e5e5;
        }

        .welcome-back:not(.opacity-0) {
            /* box shadow to bottom */
            z-index: 10;
            /* box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1); */
        }

        .welcome-back .flex_container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
        }

        .welcome-back .flex_item {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
        }

        .welcome-back .flex_item.search_flex {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            width: 50%;
            border: 1px solid #e5e5e5;
            border-radius: 10px;
            overflow: hidden;
        }

        .welcome-back .flex_item.search_flex button.btn {
            /* width: 20%; */
            padding: 1rem 1.25rem;
            /* padding-right: 0; */
            margin: 0;

            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f5f5f5;
            border-radius: 10px 0 0 10px;
        }

        .welcome-back .flex_item.search_flex button.btn:hover {
            background-color: #e5e5e5;
            color: var(--primary-color);
        }

        .welcome-back .flex_item.search_flex .form-group {
            width: 100%;
            /* margin-left: 1rem; */
            border: none;
            border-radius: 0 10px 10px 0;
            padding: 1rem 1.25rem;
            padding-left: 0.5rem;
            font-size: 1rem;
            font-weight: 500;
            background-color: #f5f5f5;

            outline: none;
        }

        .welcome-back .flex_item .title {
            font-size: 1.5rem;
            font-weight: 600;
        }
    </style>


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

<style>
    #sidebar-active {
        color: #0e1111;

        margin: 1rem 1rem 1rem calc(var(--sidebar-width-actual) + 0.75rem);
        /* background-color: yellowgreen; */
        width: (100vw - var(--sidebar-width-actual));
        /* height: 50vh; */

        /* border: 2px solid red; */


        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        border-radius: 10px;
        overflow: hidden;

        max-height: calc(100vh - 2rem);
        overflow: auto;
        /* overflow-y: auto; */

        background-color: var(--off-white);

    }
</style>

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