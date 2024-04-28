<?php

class CalendarComponent
{

    public function render()
    {

?>
        <div class="calendar-wrapper wrapper">
            <header>
                <p class="current-date"></p>
                <div class="icons">
                    <span id="prev">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                            <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z" />
                        </svg>
                    </span>

                    <span id="next">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                            <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                        </svg>
                    </span>
                </div>
            </header>

            <div class="calendar">
                <ul class="weeks">
                    <li>Sun</li>
                    <li>Mon</li>
                    <li>Tue</li>
                    <li>Wed</li>
                    <li>Thu</li>
                    <li>Fri</li>
                    <li>Sat</li>
                </ul>
                <ul class="days"></ul>
            </div>
        </div>


        <style>
            * {
                margin: 0;
                padding: 0;
                -webkit-box-sizing: border-box;
                box-sizing: border-box;
            }

            .wrapper {
                margin-top: 25px;
                width: 380px !important;
                height: 385px;
                width: 100%;
                min-height: 275px;
                background: #fff;
                border-radius: 10px;
                -webkit-box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            }

            .wrapper header {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-align: center;
                -ms-flex-align: center;
                align-items: center;
                padding: 25px 30px 10px;
                -webkit-box-pack: justify;
                -ms-flex-pack: justify;
                justify-content: space-between;
                background: #2684FF;
                border-radius: 10px 10px 0 0;
                z-index: auto;
            }

            .wrapper header p {
                color: #fff;
                font-size: 1.3rem;
                font-weight: 500;
            }

            .calendar-wrapper header .icons {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
            }

            .calendar-wrapper header .icons span {
                height: 38px;
                width: 38px;
                margin: 0 1px;
                cursor: pointer;
                color: #878787;
                text-align: center;
                font-size: 1.9rem;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                border-radius: 50%;
            }

            .icons span:last-child {
                margin-right: -10px;
            }

            .calendar-wrapper header .icons span:hover {
                background: #f2f2f2;
            }

            .calendar-wrapper header .current-date {
                font-size: 15px;
                font-weight: 500;
            }

            .calendar {
                padding: 20px;
            }

            .calendar ul {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -ms-flex-wrap: wrap;
                flex-wrap: wrap;
                list-style: none;
                text-align: center;
            }

            .calendar .days {
                margin-bottom: 20px;
            }

            .calendar li {
                color: #333;
                width: calc(100% / 7);
                font-size: 12px;
            }

            .calendar .weeks li {
                font-weight: 500;
                cursor: default;
            }

            .calendar .days li {
                /* z-index: 1; */
                cursor: pointer;
                position: relative;
                margin-top: 30px;
            }

            .days li.inactive {
                color: #aaa;
            }

            .days li.active {
                color: #fff;
            }



            .days li::before {
                position: absolute;
                content: "";
                left: 50%;
                top: 50%;
                height: 40px;
                width: 40px;
                /* z-index: -1; */
                border-radius: 50%;
                -webkit-transform: translate(-50%, -50%);
                -ms-transform: translate(-50%, -50%);
                transform: translate(-50%, -50%);
            }

            .days li.active::before {
                background: #1e90ff;
            }


            .calendar .days li span {
                z-index: 1;
                display: block;
                z-index: 66;
                position: relative;
            }

            .calendar .days li.inactive span {
                color: #aaa;
            }

            .calendar .days li.active span {
                color: #fff;
            }

            .days li:not(.active):hover::before {
                background: #f2f2f2;
            }

            .calendar .days li.active-event span {
                color: #fff;
            }

            .days li.active-event::before {
                background: #ff6b6b;
            }

            .days li.active-event:hover::before {
                background: #ff8787;
            }

            .calendar .days li.inactive-event span {
                color: #ffffffa6;
            }

            .days li.inactive-event::before {
                background: #ff9966;
            }

            .days li.inactive-event:hover::before {
                background: #ffaa80;
            }

            .days li {
                position: relative;
            }
        </style>

        <div class="popover-wrapper">
            <div class="title">{{date}} events</div>
            <div class="event_list">
                <div class="popover" role="tooltip"> Assignment 02</div>
            </div>
        </div>

        <style>
            .popover-wrapper {
                text-align: left;
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                left: 50%;
                transform: translate(-50%, 0%);
                z-index: +99;
                /* z-index: unset; */

                background: #fff;
                color: #333;
                border: 1px solid #f2f2f2;
                border-radius: 5px;
                padding: 10px;
                /* -webkit-box-shadow: 0 0 15px rgba(0, 0, 0, 0.3); */
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);

                width: 200px;
            }

            .popover-wrapper .title {
                font-size: var(--rv-0-6);
                padding-left: 5px;
                font-weight: 500;
                margin-bottom: 10px;
            }

            .popover-wrapper .event_list {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -ms-flex-wrap: wrap;
                flex-wrap: wrap;
            }

            .popover-wrapper .popover {
                color: #333;
                width: 100%;
                background: #f2f2f2;
                padding: 5px 10px;
                border-radius: 5px;
                margin-right: 5px;
                margin-bottom: 5px;
                cursor: pointer;
            }

            .popover-wrapper .popover:hover {
                background: #e6e6e6;
            }

            .days li.active-event:hover .popover-wrapper,
            .days li.inactive-event:hover .popover-wrapper {
                display: block;
            }
        </style>

        <script>
            // const daysTag = document.querySelector(".days");
            // const currentDate = document.querySelector(".current-date");
            // const prevNextIcon = document.querySelectorAll(".icons span");

            // let currYear = new Date().getFullYear();
            // let currMonth = new Date().getMonth();

            // const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

            // const renderCalendar = () => {
            //     const date = new Date(currYear, currMonth, 1);
            //     let firstDayofMonth = date.getDay();
            //     let lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate();
            //     let lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay();
            //     let lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate();

            //     let liTag = "";

            //     for (let i = firstDayofMonth; i > 0; i--) {
            //         liTag += `<li class="inactive">${lastDateofLastMonth - i + 1}</li>`;
            //     }

            //     for (let i = 1; i <= lastDateofMonth; i++) {
            //         let isToday = i === new Date().getDate() && currMonth === new Date().getMonth() && currYear === new Date().getFullYear() ? "active" : "";
            //         liTag += `<li class="${isToday}">${i}</li>`;
            //     }

            //     for (let i = lastDayofMonth; i < 6; i++) {
            //         liTag += `<li class="inactive">${i - lastDayofMonth + 1}</li>`
            //     }

            //     currentDate.innerText = `${months[currMonth]} ${currYear}`;
            //     daysTag.innerHTML = liTag;
            // };

            // renderCalendar();

            // prevNextIcon.forEach(icon => {
            //     icon.addEventListener("click", () => {
            //         currMonth = icon.id === "prev" ? currMonth - 1 : currMonth + 1;

            //         if (currMonth < 0 || currMonth > 11) {
            //             currYear = icon.id === "prev" ? currYear - 1 : currYear + 1;
            //             currMonth = currMonth < 0 ? 11 : 0;
            //         }

            //         renderCalendar();
            //     });
            // });
        </script>

<?php

    }
}
