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
                    <div class="selector <?= $data["already_voted"] ? "active" : "" ?>" data-tab="results">
                        <i class='bx bx-show'></i> View Results
                    </div>
                    <div class="selector <?= $data["already_voted"] ? "" : "active" ?>" data-tab="vote">
                        <i class='bx bx-selection'></i> Cast Vote
                    </div>
                </div>
                <div class="tabs">
                    <div class="tab <?= $data["already_voted"] ? "active" : "" ?>" id="results">
                        <div class="general-stats flex">

                            <div class="stats-left">
                                <div class="stat-card">
                                    <div class="title">
                                        <div class="icon"> <i class='bx bx-user'></i> </div>
                                        <div class="title">Total Votes</div>
                                        <div class="value"><?= $data["analytics"]["vote_count"] ?></div>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <div class="title">
                                        <div class="icon"> <i class='bx bx-objects-horizontal-left'></i> </div>
                                        <div class="title">Eligible Voters</div>
                                        <div class="value"><?= $data["analytics"]["eligible_voters"] ?></div>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <div class="title">
                                        <!-- icon for turnout -->
                                        <div class="icon"> <i class='bx bxs-pie-chart-alt-2'></i> </div>
                                        <div class="title">Voter Turnout</div>
                                        <div class="value"><?= $data["analytics"]["percent_voted"] ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="stats-right">
                                <div id="vote-timeline"></div>
                            </div>

                            <style>
                                .general-stats {
                                    display: flex;
                                    /* flex-direction: column; */
                                    gap: 2rem;
                                }

                                .stats-right {
                                    flex-grow: 1;
                                    /* max-height: 300px; */
                                }

                                .stats-left {
                                    display: flex;
                                    flex-direction: column;
                                    align-items: center;
                                    justify-content: center;
                                }

                                #vote-timeline {
                                    width: 60%;
                                    /* margin: 0 auto; */
                                }

                                .apexcharts-canvas * {
                                    font-family: 'Poppins', sans-serif !important;
                                }


                                .stat-card {
                                    position: relative;

                                    /* display: flex; */
                                    justify-content: space-between;
                                    align-items: center;
                                    padding: 1rem;
                                    border-radius: 0.5rem;
                                    background: white;
                                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                                    margin-bottom: 1rem;
                                    width: 200px;
                                }

                                .stat-card .title {
                                    font-size: var(--rv-1);
                                    color: rgb(60, 64, 67, 0.7);
                                }

                                .stat-card .icon {
                                    position: absolute;
                                    top: 0.75rem;
                                    right: 0.75rem;

                                    padding: 0.5rem;
                                    border-radius: 0.5rem;
                                    color: #727cf5;
                                    background-color: rgba(114, 124, 245, .25);

                                    width: 40px;
                                    height: 40px;
                                    display: flex;
                                    justify-content: center;
                                    align-items: center;
                                }

                                .stat-card .value {
                                    font-size: 1.5rem;
                                    font-weight: 600;
                                    margin-top: 0.5rem;
                                }
                            </style>

                        </div>

                        <div class="chart-container">
                            <?php

                            // foreach question print canvas
                            $chart_no = 1;
                            foreach ($data["analytics"]["chart_data"] as $chart_data) {
                                echo '<div><div class="chart-title">' . $chart_data["question"] . '</div>';
                                echo '<div class="election_chart" id="election_chart_' . $chart_no . '"></div>';
                                echo '</div>';

                                $chart_no++;
                            }

                            ?>
                        </div>


                        <!-- <div>
                            <canvas id="election_chart_1"></canvas>
                        </div> -->

                        <style>
                            /* #election_chart_1 {
                                max-width: 20vw;
                                max-height: 300px;
                                background-color: whitesmoke;
                            } */
                            .election_chart {
                                max-width: 20vw;
                                /* height: 500px; */
                                /* background-color: whitesmoke; */
                            }

                            .chart-title {
                                font-size: var(--rv-1);
                                font-weight: 500;
                                margin-bottom: 1rem;
                                text-align: center;
                                width: 100%;
                            }

                            .chart-container {
                                display: flex;
                                flex-wrap: wrap;
                                gap: 1rem;
                                margin-top: 1rem;
                            }
                        </style>
                    </div>
                    <div class="tab <?= $data["already_voted"] ? "" : "active" ?>" id="vote">

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
                                    if (is_array($question["question_options"])) {
                                        foreach ($question["question_options"] as $option) {
                                            if (isset($option["cover_img"])) {
                                                $has_images = true;
                                                break;
                                            }
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

                        <div class="already-voted <?= $data["already_voted"] ? "active" : "" ?>">
                            <div class="alert alert-info">You have already voted for this election.</div>
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
                    position: relative;
                }

                .tab.active {
                    /* background: red; */
                    /* height: 50vh; */
                    display: block;
                }

                .tab .already-voted {
                    display: none;
                }

                .tab .already-voted.active {
                    display: block;
                    position: absolute;
                    inset: 1rem;
                    background: var(--off-white);
                    z-index: 100;
                    /* display: flex;
                    justify-content: center;
                    align-items: center; */
                }

                .tab .already-voted.active .alert {
                    margin: 0;
                    padding: 1rem;
                    color: #856404;
                    background: #fff3cd;
                    border: 1px solid #ffeeba;
                    border-radius: 0.25rem;
                    width: 30%;
                    text-align: center;
                }
            </style>


        </div>
    </div>
</div>

<?php $HTMLFooter = new HTMLFooter(['chartjs']); ?>
<script>
    let BASE_URL = "<?= BASE_URL ?>";
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script> -->

<script>
    $(document).ready(function() {
        let chart_data = <?= json_encode($data["analytics"]["chart_data"]) ?>;

        // for each chart data
        // const ctx = document.getElementById('election_chart_1').getContext('2d');
        // let bg_colors = ["#FF6633", "#FFB399", "#FF33FF", "#FFFF99", "#00B3E6",
        //     "#E6B333", "#3366E6", "#999966", "#99FF99", "#B34D4D",
        //     "#80B300", "#809900", "#E6B3B3", "#6680B3", "#66991A",
        //     "#FF99E6", "#CCFF1A", "#FF1A66", "#E6331A", "#33FFCC",
        //     "#66994D", "#B366CC", "#4D8000", "#B33300", "#CC80CC",
        //     "#66664D", "#991AFF", "#E666FF", "#4DB3FF", "#1AB399",
        //     "#E666B3", "#33991A", "#CC9999", "#B3B31A", "#00E680",
        //     "#4D8066", "#809980", "#E6FF80", "#1AFF33", "#999933",
        //     "#FF3380", "#CCCC00", "#66E64D", "#4D80CC", "#9900B3",
        //     "#E64D66", "#4DB380", "#FF4D4D", "#99E6E6", "#6666FF"
        // ];
        const plugin = {
            id: 'customCanvasBackgroundColor',
            beforeDraw: (chart, args, options) => {
                const {
                    ctx
                } = chart;
                ctx.save();
                ctx.globalCompositeOperation = 'destination-over';
                ctx.fillStyle = options.color || '#99ffff';
                ctx.fillRect(0, 0, chart.width, chart.height);
                ctx.restore();
            }
        };

        window.Apex = {
            chart: {
                parentHeightOffset: 0,
                toolbar: {
                    show: !1
                }
            },
            grid: {
                padding: {
                    left: 0,
                    right: 0
                }
            },
            colors: ["#727cf5", "#0acf97", "#fa5c7c", "#ffbc00"],
        };

        var lastWeek = ["0", "0", "0", "0", "0", "0", "0"];
        var thisWeek = [37, "0", 10, 20, "0", "0", "0"];

        var last_election = <?= json_encode($data["analytics"]["intervals"]["count"]) ?>;
        var this_election = <?= json_encode($data["analytics"]["intervals"]["count"]) ?>;

        var labels = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
        labels = <?= json_encode($data["analytics"]["intervals"]["labels"]) ?>


        var e = ["#727cf5", "#0acf97", "#fa5c7c", "#ffbc00"];
        var r = {
            chart: {
                height: 364,
                type: "line",
                dropShadow: {
                    enabled: !0,
                    opacity: 0.2,
                    blur: 7,
                    left: -7,
                    top: 7
                },
            },
            dataLabels: {
                enabled: !1
            },
            stroke: {
                curve: "smooth",
                width: 4
            },
            title: {
                text: 'Voter Turnout Over Time',
                align: 'left',
                style: {
                    fontSize: '16px',
                    color: '#666',
                    fontWeight: 500
                }
            },
            series: [
                // {
                //     name: "Last Vote Turnout",
                //     data: last_election
                // },
                {
                    name: "Voter Turnout",
                    data: this_election
                },
            ],
            colors: e,
            zoom: {
                enabled: !1
            },
            legend: {
                show: !1
            },
            xaxis: {
                type: "string",
                categories: labels,
                tooltip: {
                    enabled: !1
                },
                axisBorder: {
                    show: !1
                },
            },
            yaxis: {
                labels: {
                    formatter: function(e) {
                        return e;
                    },
                    offsetX: -15,
                },
                stepSize: 1,
                // tickAmount: "dataPoints",
                // tickAmount: 1
            },
        };

        new ApexCharts(document.querySelector("#vote-timeline"), r).render();

        // var options = {
        //     series: [44, 55, 41, 17, 15],
        //     chart: {
        //         type: 'donut',
        //     },
        //     responsive: [{
        //         breakpoint: 480,
        //         options: {
        //             chart: {
        //                 width: 200
        //             },
        //             legend: {
        //                 position: 'bottom'
        //             }
        //         }
        //     }]
        // };

        // var chart = new ApexCharts(document.querySelector(`#election_chart_1`), options);
        // chart.render();
        // console.log(chart);



        let chart_no = 1;
        chart_data.forEach(chart => {
            let chart_id = 'election_chart_' + chart_no;
            // let ctx = document.getElementById(chart_id).getContext('2d');
            // let ctx = document.getElementById(chart_id);

            // truncate labels to 2 words
            chart.labels = chart.labels.map(label => label.split(" ").slice(0, 2).join(" "));


            let data = {
                labels: chart.labels,
                datasets: [{
                    label: chart.title,
                    data: chart.count,
                    // backgroundColor: bg_colors,
                    borderWidth: 1
                }]
            };

            e = ["#727cf5", "#0acf97", "#fa5c7c", "#ffbc00"];
            // (t = o("#average-sales").data("colors")) && (e = t.split(","));
            // get current font family
            var o = document.body;
            var t = window.getComputedStyle(o, null).getPropertyValue('font-family');
            console.log(t);
            r = {
                chart: {
                    height: 208,
                    type: "donut",
                    fontFamily: t,
                },
                legend: {
                    show: !1
                },
                stroke: {
                    colors: ["transparent"]
                },
                series: chart.count,
                labels: chart.labels,
                colors: e,
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: "bottom"
                        }
                    },
                }, ],
            };

            // var options = {
            //     series: [44, 55, 41, 17, 15],
            //     chart: {
            //         type: 'donut',
            //     },
            //     responsive: [{
            //         breakpoint: 480,
            //         options: {
            //             chart: {
            //                 width: 200
            //             },
            //             legend: {
            //                 position: 'bottom'
            //             }
            //         }
            //     }]
            // };

            var chart = new ApexCharts(document.querySelector(`#${chart_id}`), r);
            chart.render();


            // new ApexCharts(document.querySelector(`#${chart_id}`), r).render();

            // data = {
            //     labels: ['A', 'B', 'C', 'D'],
            //     datasets: [{
            //         label: 'My Dataset',
            //         data: [25, 59, 80, 76],
            //         fill: false,
            //         backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(255, 159, 64, 0.2)', 'rgba(255, 205, 86, 0.2)', 'rgba(75, 192, 192, 0.2)'],
            //         borderColor: ['rgb(255, 99, 132)', 'rgb(255, 159, 64)', 'rgb(255, 205, 86)', 'rgb(75, 192, 192)', 'rgb(54, 162, 235)'],
            //         borderWidth: 1
            //     }]
            // };

            // let img1 = new Image();
            // img1.src = 'https://i.stack.imgur.com/9EMtU.png';
            // const barAvatar = {
            //     id: 'barAvatar',
            //     afterDatasetsDraw: (chart, args, options) => {
            //         const {
            //             ctx,
            //             chartArea: {
            //                 top,
            //                 bottom,
            //                 left,
            //                 right,
            //                 width,
            //                 height
            //             },
            //             scales: {
            //                 x,
            //                 y
            //             }
            //         } = chart;
            //         ctx.save();

            //         console.log(chart.data.datasets[0].data);
            //         console.log("barAvatar");

            //         ctx.drawImage(img1, x.getPixelForValue(0), y.getPixelForValue(18), 20, 20);
            //     }
            // };

            // new Chart(ctx, {
            //     type: 'bar',
            //     data: data,
            //     options: {
            //         // plugins: [barAvatar],
            //         plugins: {
            //             customCanvasBackgroundColor: {
            //                 color: 'rgba(255, 255, 255, 0.5)'
            //             },
            //             legend: {
            //                 display: false,
            //             },
            //             labels: {
            //                 render: 'image',
            //                 textMargin: 10,
            //                 images: [{
            //                         src: 'https://i.stack.imgur.com/9EMtU.png',
            //                         width: 20,
            //                         height: 20
            //                     },
            //                     null,
            //                     {
            //                         src: 'https://i.stack.imgur.com/9EMtU.png',
            //                         width: 20,
            //                         height: 20
            //                     },
            //                     null
            //                 ]
            //             }
            //         },
            //         layout: {
            //             padding: {
            //                 top: 30
            //             }
            //         },
            //         scales: {
            //             x: {
            //                 grid: {
            //                     display: false,
            //                     drawBorder: false,
            //                 }
            //             },
            //             y: {
            //                 beginAtZero: true,
            //                 ticks: {
            //                     stepSize: 1
            //                 },
            //                 grid: {
            //                     // display: false,
            //                     drawBorder: false,
            //                 }
            //             }
            //         }
            //     },
            //     plugins: [plugin]
            // });

            chart_no++;
        });


        // on click tab-selector selector
        $(document).on("click", ".selector", function() {
            let tab = $(this).data("tab");
            $(".selector").removeClass("active");
            $(this).addClass("active");

            $(".tab").removeClass("active");
            $("#" + tab).addClass("active");
        });

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
                        setTimeout(() => {
                            location.reload();
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