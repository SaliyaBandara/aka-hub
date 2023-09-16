<?php

class Calendar
{

    public function __construct($active_page = null)
    {

?>
        <main>
            <form>
                <div class="calendar">
                    <div class="top">
                        <label>
                            <select class="month" name="months" size="1">
                                <option class="mon" name="1">Januar</option>
                                <option class="mon" name="2">Februar</option>
                                <option class="mon" name="3">März</option>
                                <option class="mon" name="4">April</option>
                                <option class="mon" name="5">Mai</option>
                                <option class="mon" name="6">Juni</option>
                                <option class="mon" name="7">Juli</option>
                                <option class="mon" name="8">August</option>
                                <option class="mon" name="9">September</option>
                                <option class="mon" name="10">Oktober</option>
                                <option class="mon" name="11">November</option>
                                <option class="mon" name="12">Dezember</option>
                            </select>
                        </label>
                        <label>
                            <select class="year" name="years" size="1">
                                <option class="yer">2030</option>
                                <option class="yer">2029</option>
                                <option class="yer">2028</option>
                                <option class="yer">2027</option>
                                <option class="yer">2026</option>
                                <option class="yer">2025</option>
                                <option class="yer">2024</option>
                                <option class="yer">2023</option>
                                <option class="yer">2022</option>
                                <option class="yer">2021</option>
                                <option class="yer">2020</option>
                                <option class="yer">2019</option>
                                <option class="yer">2018</option>
                                <option class="yer">2017</option>
                                <option class="yer">2016</option>
                            </select>
                        </label>
                    </div>
                    <div class="week">
                        <div class="week__day">Mo</div>
                        <div class="week__day">Di</div>
                        <div class="week__day">Mi</div>
                        <div class="week__day">Do</div>
                        <div class="week__day">Fr</div>
                        <div class="week__day">Sa</div>
                        <div class="week__day">So</div>
                    </div>
                    <div class="date">
                        <div class="date__row">
                            <div class="date__number">1</div>
                            <div class="date__number">2</div>
                            <div class="date__number">3</div>
                            <div class="date__number">4</div>
                            <div class="date__number">5</div>
                            <div class="date__number">6</div>
                            <div class="date__number">7</div>
                        </div>
                        <div class="date__row">
                            <div class="date__number">8</div>
                            <div class="date__number">9</div>
                            <div class="date__number">10</div>
                            <div class="date__number">11</div>
                            <div class="date__number">12</div>
                            <div class="date__number">13</div>
                            <div class="date__number">14</div>
                        </div>
                        <div class="date__row">
                            <div class="date__number">15</div>
                            <div class="date__number">16</div>
                            <div class="date__number">17</div>
                            <div class="date__number">18</div>
                            <div class="date__number">19</div>
                            <div class="date__number">20</div>
                            <div class="date__number">21</div>
                        </div>
                        <div class="date__row">
                            <div class="date__number">22</div>
                            <div class="date__number">23</div>
                            <div class="date__number">24</div>
                            <div class="date__number">25</div>
                            <div class="date__number">26</div>
                            <div class="date__number">27</div>
                            <div class="date__number">28</div>
                        </div>
                        <div class="date__row">
                            <div class="date__number">29</div>
                            <div class="date__number">30</div>
                            <div class="date__number">31</div>
                            <div class="date__number"></div>
                            <div class="date__number"></div>
                            <div class="date__number"></div>
                            <div class="date__number"></div>
                        </div>
                    </div>
                </div>
                <div class="choosen"></div>
            </form>
        </main>


        <style>
            /* Global styles */
            * {
                margin: 0;
                padding: 0;
                font-family: Arial;
            }

            body {
                background-color: #189AB4;
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            /* Calendar styles */
            .calendar {
                padding: 20px;
                border-radius: 10px;
                background-color: #fff;
                font-size: 16px;
                box-shadow: 5px -5px 400px #fff;
            }

            .top {
                display: flex;
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
            }

            .month,
            .year {
                border: none;
                text-transform: uppercase;
                letter-spacing: 5px;
                font-weight: bold;
                font-size: 18px;
                cursor: pointer;
            }

            option {
                font-weight: normal;
                font-size: 16px;
                text-transform: none;
                letter-spacing: 0px;
            }

            .week {
                margin-top: 20px;
                display: flex;
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
                border-bottom: 1px solid gray;
            }

            .week__day {
                color: gray;
                margin: 5px;
                width: 35px;
                height: 35px;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 100px;
                text-transform: uppercase;
            }

            /* Date styles */
            .date__row {
                display: flex;
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
            }

            .date__number {
                margin: 5px;
                width: 35px;
                height: 35px;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 100px;
                transition: 0.5s ease;
            }

            .date__number:hover {
                cursor: pointer;
                background-color: #189AB4;
                color: #fff;
            }

            .date__number--true {
                background-color: #189AB4;
                color: #fff;
            }

            /* Choosen styles */
            .choosen {
                text-align: center;
                margin-top: 40px;
                color: gray;
            }
        </style>

        <script>

            $(document).ready(function() {

                $(".date__number").click(function() {
                    $(".date__number").removeClass("date__number--true");
                    $(this).addClass("date__number--true");
                });


                var date = new Date();
                var year = date.getFullYear();
                var month = date.getMonth() + 1;
                var day = date.getDate();

                $(".yer").each(function() {
                    if (Number($(this).text()) === (year)) {
                        $(this).prop("selected", true);
                    }
                });

                $(".mon").each(function() {
                    if ($(this).attr("name") === String(month)) {
                        $(this).prop("selected", true);
                    }
                });

                $(".date__number").each(function() {
                    if (Number($(this).text()) === day) {
                        $(this).addClass("date__number--true");
                    }
                });


                $(".choosen").text(day + '.' + month + '.' + year);


                $(".date").click(function() {

                    day = $(".date__number--true").text();
                    month = $(".month option:selected").attr("name");
                    year = $(".year option:selected").text();

                    $(".choosen").text(day + '.' + month + '.' + year);

                });
            });
            
        </script>

<?php

    }
}
