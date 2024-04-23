<?php
$HTMLHead = new HTMLHead($data['title']);
$sidebar = new Sidebar("elections");
?>

<div id="sidebar-active" class="hideScrollbar">
    <?php $welcomeSearch = new WelcomeSearch(); ?>

    <div class="main-grid flex">
        <div class="solo">

            <div class="election-main">
                <div class="tab-selector">
                    <div class="selector active" data-tab="results">
                        <i class='bx bx-show'></i> View Results
                    </div>
                    <div class="selector" data-tab="vote">
                        <i class='bx bx-selection'></i> Cast Vote
                    </div>
                </div>
                <div class="tabs">
                    <div class="tab" id="results">
                    </div>
                    <div class="tab active" id="vote">

                        <div class="questions">

                            <!-- <div class="question_item">
                                <div class="text">Nesciunt eos possimus quaerat optio quasi facilis.</div>
                                <div class="options img_select">
                                    <ul>
                                        <li><input type="radio" name="test" id="cb1" />
                                            <label for="cb1">
                                                <img src="<?= BASE_URL ?>/public/assets/user_uploads/img/election_cover_2024020419363765bf99ed2168e01368490017070555971790.png" />
                                                <div class="title font-1">Chamodh Henderson</div>
                                            </label>
                                        </li>
                                        <li><input type="radio" name="test" id="cb2" />
                                            <label for="cb2"><img src="<?= BASE_URL ?>/public/assets/user_uploads/img/election_cover_2024020419363765bf99ed2168e01368490017070555971790.png" /></label>
                                        </li>
                                        <li><input type="radio" name="test" id="cb3" />
                                            <label for="cb3"><img src="<?= BASE_URL ?>/public/assets/user_uploads/img/election_cover_2024020419363765bf99ed2168e01368490017070555971790.png" /></label>
                                        </li>
                                        <li><input type="radio" name="test" id="cb4" />
                                            <label for="cb4"><img src="<?= BASE_URL ?>/public/assets/user_uploads/img/election_cover_2024020419363765bf99ed2168e01368490017070555971790.png" /></label>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="question_item">
                                <div class="text">Nesciunt eos possimus quaerat optio quasi facilis.</div>
                                <div class="options plain_options">

                                    <p>
                                        <input type="radio" id="test1" name="radio-group" checked>
                                        <label for="test1">Apple</label>
                                    </p>
                                    <p>
                                        <input type="radio" id="test2" name="radio-group">
                                        <label for="test2">Peach</label>
                                    </p>
                                    <p>
                                        <input type="radio" id="test3" name="radio-group">
                                        <label for="test3">Orange</label>
                                    </p>

                                </div>
                            </div>

                            <div class="question_item">
                                <div class="text">Nesciunt eos possimus quaerat optio quasi facilis.</div>
                                <div class="options plain_options">

                                    <p>
                                        <input type="checkbox" id="c11" name="radio-group" checked>
                                        <label for="c11">Apple</label>
                                    </p>
                                    <p>
                                        <input type="checkbox" id="c12" name="radio-group">
                                        <label for="c12">Peach</label>
                                    </p>
                                    <p>
                                        <input type="checkbox" id="c13" name="radio-group">
                                        <label for="c13">Orange</label>
                                    </p>

                                </div>
                            </div>

                            <div class="question_item">
                                <div class="text">Nesciunt eos possimus quaerat optio quasi facilis.</div>
                                <div class="options plain_select">
                                    <div class="mt-1 mb-1 form-group">
                                        <select name="cars" id="cars" class="form-control">
                                            <option value="volvo">Volvo</option>
                                            <option value="saab">Saab</option>
                                            <option value="mercedes">Mercedes</option>
                                            <option value="audi">Audi</option>
                                        </select>
                                    </div>
                                </div>
                            </div> -->

                            <?php
                            // print_r($data["questions"]);

                            if (isset($data["questions"])) {
                                $question_no = 0;
                                foreach ($data["questions"] as $question) {
                                    $question_no++;
                                    echo '<div class="question_item" data-id="' . $question["id"] . '" data-type="' . $question["question_type"] . '">';
                                    echo '<div class="text">' . $question["question"] . '</div>';

                                    $question["question_options"] = json_decode($question["question_options"], true);
                                    // check if question has images
                                    $has_images = false;
                                    foreach ($question["question_options"] as $option) {
                                        if (isset($option["cover_img"])) {
                                            $has_images = true;
                                            break;
                                        }
                                    }

                                    if ($question["question_type"] == 1) {
                                        continue;
                                    } else if ($question["question_type"] == 2 || $question["question_type"] == 3) {
                                        if ($has_images) {
                            ?>

                                            <div class="options img_select">
                                                <ul>

                                                    <?php
                                                    $option_no = 0;
                                                    foreach ($question["question_options"] as $option) {
                                                        $option_no++;
                                                        $cover_img = isset($option["cover_img"]) ? $option["cover_img"] : "";
                                                        $cover_img = USER_IMG_PATH . $cover_img;

                                                    ?>

                                                        <li><input type="<?= $question["question_type"] == 2 ? "radio" : "checkbox" ?>" name="test" id="cb<?= $question_no . $option_no ?>" />
                                                            <label for="cb<?= $question_no . $option_no ?>">
                                                                <img src="<?= $cover_img ?>" />
                                                                <div class="title font-1"><?= $option["option"] ?></div>
                                                            </label>
                                                        </li>

                                                    <?php
                                                    }

                                                    ?>

                                                </ul>
                                            </div>

                                            <?php

                                        } else {

                                            echo '<div class="options plain_options">';

                                            $option_no = 0;
                                            foreach ($question["question_options"] as $option) {
                                                $option_no++;
                                            ?>

                                                <p>
                                                    <input type="<?= $question["question_type"] == 2 ? "radio" : "checkbox" ?>" id="c<?= $question_no . $option_no ?>" name="radio-group">
                                                    <label for="c<?= $question_no . $option_no ?>"><?= $option["option"] ?></label>
                                                </p>

                            <?php
                                            }

                                            echo '</div>';
                                        }
                                    } else if ($question["question_type"] == 4) {

                                        echo '<div class="options plain_select">';
                                        echo '<div class="mt-1 mb-1 form-group">';
                                        echo '<select name="select_input" id="select_input" class="form-control">';

                                        $option_no = 0;
                                        foreach ($question["question_options"] as $option) {
                                            $option_no++;
                                            // remove white spaces from the option
                                            $option_value = str_replace(' ', '', $option["option"]);
                                            echo "<option value='$option_value'>" . $option["option"] . '</option>';
                                        }

                                        echo '</select>';
                                        echo '</div>';
                                        echo '</div>';
                                    }

                                    // 1 - short answer
                                    // 2 - radio
                                    // 3 - checkbox
                                    // 4 - dropdown

                                    // print_r($question);

                                    echo '</div>';
                                }
                            }

                            ?>

                            <style>
                                .question_item:not(:last-child) {
                                    border-bottom: 1px solid #ddd;
                                    padding-bottom: 0.25rem;
                                    margin-bottom: 1.25rem;
                                }

                                .question_item .plain_select select {
                                    max-width: 300px;
                                }
                            </style>
                            <style>
                                /* plain radio buttons and checkboxes */
                                .question_item .plain_options input+label {
                                    font-size: var(--rv-1);
                                }

                                .question_item .plain_options input:checked,
                                .question_item .plain_options input:not(:checked) {
                                    position: absolute;
                                    left: -9999px;
                                }

                                .question_item .plain_options input:checked+label,
                                .question_item .plain_options input:not(:checked)+label {
                                    position: relative;
                                    padding-left: 28px;
                                    cursor: pointer;
                                    line-height: 20px;
                                    display: inline-block;
                                    color: #666;
                                }

                                .question_item .plain_options input:checked+label:before,
                                .question_item .plain_options input:not(:checked)+label:before {
                                    content: "";
                                    position: absolute;
                                    left: 0;
                                    top: 0;
                                    width: 18px;
                                    height: 18px;
                                    border: 1px solid #ddd;
                                    border-radius: 100%;
                                    background: #fff;
                                }

                                .question_item .plain_options input:checked+label:after,
                                .question_item .plain_options input:not(:checked)+label:after {
                                    content: "";
                                    width: 12px;
                                    height: 12px;
                                    background: #1264aba9;
                                    position: absolute;
                                    top: 4px;
                                    left: 4px;
                                    border-radius: 100%;
                                    -webkit-transition: all 0.2s ease;
                                    transition: all 0.2s ease;
                                }

                                .question_item .plain_options [type="checkbox"]:checked+label:before,
                                .question_item .plain_options [type="checkbox"]:not(:checked)+label:before,
                                .question_item .plain_options [type="checkbox"]:checked+label:after,
                                .question_item .plain_options [type="checkbox"]:not(:checked)+label:after {
                                    border-radius: unset;
                                }

                                .question_item .plain_options input:not(:checked)+label:after {
                                    opacity: 0;
                                    -webkit-transform: scale(0);
                                    transform: scale(0);
                                }

                                .question_item .plain_options input:checked+label:after {
                                    opacity: 1;
                                    -webkit-transform: scale(1);
                                    transform: scale(1);
                                }
                            </style>
                            <style>
                                /* questions with images */
                                .question_item .options.img_select ul {
                                    list-style-type: none;
                                    padding: 0;
                                    margin: 0;
                                }

                                .question_item .options.img_select li {
                                    display: inline-block;
                                }

                                .question_item .options.img_select input[type="radio"][id^="cb"],
                                .question_item .options.img_select input[type="checkbox"][id^="cb"] {
                                    display: none;
                                }

                                .question_item .options.img_select label {
                                    border: 1px solid #fff;
                                    padding: 10px;
                                    display: block;
                                    position: relative;
                                    margin: 10px;
                                    cursor: pointer;
                                    text-align: center;
                                }

                                .question_item .options.img_select label:before {
                                    background-color: white;
                                    color: white;
                                    content: " ";
                                    display: block;
                                    border-radius: 50%;
                                    border: 1px solid grey;
                                    position: absolute;
                                    top: -5px;
                                    left: -5px;
                                    width: 25px;
                                    height: 25px;
                                    text-align: center;
                                    line-height: 28px;
                                    transition-duration: 0.4s;
                                    transform: scale(0);
                                }

                                .question_item .options.img_select label img {
                                    height: 12vw;
                                    width: 12vw;
                                    transition-duration: 0.2s;
                                    transform-origin: 50% 50%;
                                }

                                .question_item .options.img_select label .title {
                                    margin-top: 0.5rem;
                                    max-width: 12vw;
                                }

                                .question_item .options.img_select :checked+label {
                                    border-color: #ddd;
                                    border-radius: 8px;
                                }

                                .question_item .options.img_select :checked+label:before {
                                    content: "✓";
                                    background-color: grey;
                                    transform: scale(1);
                                }

                                .question_item .options.img_select :checked+label img {
                                    transform: scale(0.9);
                                    /* box-shadow: 0 0 5px #333; */
                                    z-index: -1;
                                }
                            </style>



                        </div>

                        <div class="mt-1-5 form-group">
                            <a href="<?= BASE_URL ?>/elections" class="btn btn-danger">Back</a>
                            <button type="submit" class="btn btn-primary vote-btn">Cast Vote</button>
                        </div>

                    </div>
                </div>
            </div>

            <style>
                .election-main {
                    margin: 1rem;
                }

                .tab-selector {
                    display: flex;
                    /* justify-content: center; */
                }

                .selector {
                    cursor: pointer;
                    line-height: 1.25rem;
                    font-size: var(--rv-1);
                    letter-spacing: .0178571429em;
                    font-weight: 500;
                    border-radius: 24px;
                    border: 1px solid rgb(218, 220, 224);
                    color: rgb(60, 64, 67);
                    padding: 10px 20px;
                    margin-right: 8px;

                    display: flex;
                    align-items: center;
                }

                .selector .bx {
                    margin-right: 0.5rem;
                }

                .selector.active {
                    border: 1px solid transparent;
                    background: rgb(232, 240, 254);
                    color: rgb(25, 103, 210);
                }

                .selector:not(.active):hover {
                    background: rgb(241, 243, 244);
                }

                .tabs {
                    display: flex;
                    flex-direction: column;
                    border-top: none;
                    border-radius: 0 0 0.5rem 0.5rem;
                }

                .tab {
                    display: none;
                    padding: 1rem;
                    margin-top: 1rem;
                }

                .tab.active {
                    /* background: red; */
                    /* height: 50vh; */
                    display: block;
                }
            </style>


        </div>
    </div>
</div>

<?php $HTMLFooter = new HTMLFooter(); ?>
<script>
    let BASE_URL = "<?= BASE_URL ?>";
</script>
<script>
    $(document).ready(function() {

        $(document).on("click", ".vote-btn", function(event) {
            event.preventDefault();

            // 1 - short answer
            // 2 - one
            // 3 - checkbox
            // 4 - dropdown

            // get all the questions
            let questions = $(".question_item");
            let values = [];
            let empty_fields = [];
            questions.each(function() {
                let question_id = $(this).data("id");
                let question_type = $(this).data("type");
                let question_options = [];
                let question_answers = [];

                // check for empty fields
                if (question_type == "2" || question_type == "3") {
                    if ($(this).find(".options input:checked").length == 0)
                        empty_fields.push($(this));
                } else if (question_type == "4") {
                    if ($(this).find(".options select").val() == "")
                        empty_fields.push($(this));
                }

                // get the index of the selected options
                if (question_type == "2") {
                    let selected_option = $(this).find(".options input:checked").parent().index() + 1;
                    question_answers.push(selected_option);
                } else if (question_type == "3") {
                    $(this).find(".options input:checked").each(function() {
                        question_options.push($(this).parent().find(".title").text());
                        question_answers.push($(this).parent().index() + 1);
                    });
                } else if (question_type == "4") {
                    let selected_option = $(this).find(".options select").prop("selectedIndex") + 1;
                    question_answers.push(selected_option);
                }

                values.push({
                    question_id: question_id,
                    question_type: question_type,
                    question_answer: question_answers
                });
            });

            // alert user if there are empty fields
            empty_fields.forEach(element => element.addClass("border-danger"));
            setTimeout(() => {
                empty_fields.forEach(element => element.removeClass("border-danger"));
            }, 6000);

            if (empty_fields.length > 0) {
                empty_fields[0].focus();
                return alertUser("warning", `Please fill all the fields`);
            }

            console.log(values);
            // return;

            $.ajax({
                // url: url,
                type: 'post',
                data: {
                    vote: values
                },
                dataType: 'json',
                success: function(response) {
                    if (response['status'] == 200) {
                        alertUser("success", response['desc'])
                        setTimeout(function() {
                            history.go(-1);
                            window.close();
                        }, 2000);

                    } else if (response['status'] == 403)
                        alertUser("danger", response['desc'])
                    else
                        alertUser("warning", response['desc'])
                },
                error: function(ajaxContext) {
                    alertUser("danger", "Something Went Wrong")
                }
            });
        });
    });
</script>