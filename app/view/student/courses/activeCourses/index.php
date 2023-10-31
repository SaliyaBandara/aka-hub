<?php
$HTMLHead = new HTMLHead($data['title']);
// $header = new header();
$sidebar = new Sidebar("home");
?>

<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch("Samudi", "Perera"); ?>
    <div class="main-grid flex">
        <div class="left">
            <!-- section header -->
            <section>
                <div class="divActiveCoursesHeader">
                    <select id="status" name="status">
                        <option value="active" selected>Active Courses</option>
                        <option value="archieved" >Archived Courses</option>
                    </select>
                    <select id="year" name="year">
                        <option value="year 1">Year 1</option>
                        <option value="year 2" selected>Year 2</option>
                        <option value="year 3" >Year 3</option>
                        <option value="year 4" >Year 4</option>

                    </select>
                    <select id="semester" name="semester">
                        <option value="sem1"selected>Semester 1</option>
                        <option value="sem2" >Semester 2</option>
                    </select>
                    <input type = "button" name = "saveFilters" value = "Filter" class = "profileButton"/>
                </div>

                <!-- todo flex wrap -->
                <div class="todo_flex_wrap flex flex-wrap">
                    <a href="#" class="todo_item flex align-center">
                        <div class="iconModule">

                        </div>
                        <div class="todo_item_text">
                            <div class="font-1-25 font-semibold">Computer Networks</div>
                            <div class="font-1 font-medium text-muted">Sem I</div>
                        </div>
                    </a>
                    <a href="#" class="todo_item flex align-center">
                        <div class="iconModule">

                        </div>
                        <div class="todo_item_text">
                            <div class="font-1-25 font-semibold">RAD</div>
                            <div class="font-1 font-medium text-muted">Sem I</div>
                        </div>
                    </a>
                    <a href="#" class="todo_item flex align-center">
                        <div class="iconModule">

                        </div>
                        <div class="todo_item_text">
                            <div class="font-1-25 font-semibold">DSA III</div>
                            <div class="font-1 font-medium text-muted">Sem I</div>
                        </div>
                    </a>
                    <a href="#" class="todo_item flex align-center">

                        <div class="iconModule">

                        </div>
                        <div class="todo_item_text">
                            <div class="font-1-25 font-semibold">SE III</div>
                            <div class="font-1 font-medium text-muted">Sem I</div>
                        </div>
                    </a>
                    <a href="#" class="todo_item flex align-center">

                        <div class="iconModule">

                        </div>
                        <div class="todo_item_text">
                            <div class="font-1-25 font-semibold">Scala</div>
                            <div class="font-1 font-medium text-muted">Sem I</div>
                        </div>
                    </a>
                    <a href="#" class="todo_item flex align-center">
                        <div class="iconModule">

                        </div>
                        <div class="todo_item_text">
                            <div class="font-1-25 font-semibold">MM</div>
                            <div class="font-1 font-medium text-muted">Sem I</div>
                        </div>
                    </a>
                    <a href="#" class="todo_item flex align-center">
                        <div class="iconModule">

                        </div>
                        <div class="todo_item_text">
                            <div class="font-1-25 font-semibold">PLC</div>
                            <div class="font-1 font-medium text-muted">Sem I</div>
                        </div>
                    </a>
                </div>

                <style>
                    .iconModule{
                        width: 50px;
                        height: 50px;
                        background-color: #bdd2f1;
                    }
                    .divActiveCoursesHeaderPart {
                        width: 30%;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                    }

                    .divActiveCoursesHeader {
                        width: 100%;
                        height: 50px;
                        display: flex;
                        justify-content : space-evenly;
                        padding-top: 15px;
                    }

                    .divActiveCoursesHeader select{
                        height : 20px;;
                        font-size : 14px;
                        border : none;
                        box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);

                    }

                    .todo_flex_wrap {
                        display: flex;
                        flex-wrap: wrap;
                        justify-content: space-between;
                        padding: 20px;
                    }

                    .todo_item {
                        text-decoration: none;
                        color: initial;

                        width: 31%;
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

                    .profileButton{
                        width: 100px;
                        height: 20px;
                        background-color: #2684FF;
                        border-radius: 5px;
                        color: white;
                        text-align: center;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
                        border : none;
                        font-size : 14px;

                    }

                    .profileButton:hover {
                        cursor: pointer;
                        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
                    }


                </style>


            </section>

        </div>
        <div class="right"></div>
    </div>

    <style>
        .main-grid {}

        .main-grid .left {
            width: 100%;
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
    $(document).ready(function() {

        $(document).on("click", ".forget-password", function(event) {
            event.preventDefault();
            $('.fixed-model').fadeIn();
            $('body').css('overflow', 'hidden');
        });

        // on click onsite_alert close_btn
        $(document).on("click", ".onsite_alert .close_btn", function(event) {
            event.preventDefault();

            $(this).parent().animate({
                opacity: 0
            }, 300, function() {
                $(this).slideUp(250, function() {
                    $(this).remove();
                });
            });


        });

    });
</script>