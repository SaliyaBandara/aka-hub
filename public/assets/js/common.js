function isMobile() {
    if (window.innerHeight > window.innerWidth)
        return true;
    return false;
}

function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

function eraseCookie(name) {
    document.cookie = name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

function GetURLParameter(sParam) {
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++) {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam)
            return decodeURIComponent(sParameterName[1]);
    }
}

function alertUser(type, desc) {
    var $div = $("<div>", {
        class: "custom-alert " + type + "-alert"
    });
    $div.append("<div class='alert-text'>" + desc + "</div\>")

    var count = $(".custom-alert").length;
    $(".custom-alert").fadeOut(function () {
        $(this).remove();
    });

    $div.hide().delay(count * 200).appendTo("body").fadeIn(function () {
        setTimeout(function () {
            $div.fadeOut(function () {
                $div.remove();
            });
        }, 3000);
    });

    // $('.custom-alert').remove();
    // $("body").prepend($div);
    // $(".custom-alert").delay(3000).fadeOut()
}

const getHostname = (url) => {
    try {
        url = new URL(url);
    } catch (_) {
        return false;
    }
    return new URL(url).hostname;
}

function getBaseURL() {
    var currentURL = window.location.href;
    var url = new URL(currentURL);
    var baseURL = url.origin + url.pathname;
    return baseURL;
}

function formatDate(date) {
    return new Date(date.replace(/-/g, "/"))
}

function countPreviewImgs(table) {
    let images = [];
    let imgDelay = [];

    table.find("tr").length

    values["image"] = null;
    table.find("tr").each(function () {
        if ($(this).hasClass("d-none"))
            return;

        let image = $(this).find(".preview-img").attr("href");
        let fileName = image.split("/").pop();

        // let isChecked = $(this).find("input[type='radio']").is(":checked");
        // if (isChecked)
        //     values["image"] = fileName;

        let delay = $(this).find("span.delay-value").html();
        images.push(fileName);
        imgDelay.push([fileName, delay]);

    });
}

function append_preview_table(table, imgPath, fileName, filePath = "") {
    let img_template_base = `<tr class='ui-sortable-handle'>
                                <td>
                                    <div class='preview-img preview-img-small' data-fancybox='group' href=''>
                                        <img src='' class='' alt='...'>
                                    </div>
                                </td>
                                <td>
                                    <div title='Delete Image' target='_blank' class='action-icon custom-action-btn delete-preview-btn text-danger font-14'> <i class='bx bx-trash'></i> Delete</div>
                                </td>
                            </tr>`;

    let img_template = `<div class ='preview-img preview-img-small' data-filename='${fileName}' data-fancybox='group' href='${imgPath}'>
                <img src='${imgPath}' class='' alt='..'></div>`;
    if (fileName.split(".").pop() == "pdf")
        img_template = `<a href='${filePath + fileName}' target='_blank' class ='preview-img preview-img-small' data-filename='${fileName}'>
                            <img src='${imgPath}' class='' alt='..'></a>`;

    table.append(img_template_base);
    table.find('tr:last').find('td:nth-child(1)').html(img_template);

    table.fadeIn(200);
}

function get_preview_imgs(table) {
    // let table = $(".image-preview-table tbody");
    let images = [];
    table.find("tr").each(function () {
        if ($(this).hasClass("d-none"))
            return;
        let image = $(this).find(".preview-img").attr("data-filename");
        images.push(image.split("/").pop());
    });

    return (images)
}

function isInternalLink(url) {
    if (url.startsWith("./") || url.startsWith("../"))
        return true;

    var currentDomain = window.location.hostname;
    return url.indexOf(currentDomain) !== -1;
}
// function isInternalLink(url) {
//     var currentDomain = window.location.hostname;
//     console.log(url.indexOf(currentDomain));
//     console.log(currentDomain);
//     console.log(url);
//     return url.indexOf(currentDomain) !== -1;
// }

function arraysEqual(a1, a2) {
    return JSON.stringify(a1) == JSON.stringify(a2);
}

// update notifications
let last_notifications;
let count_get_notifications = 0;
function updateNotifications() {

    // check if BASE_URL is defined
    if (typeof BASE_URL === 'undefined')
        return;

    count_get_notifications++;
    let notification_template = `<li><a href="{{notif_url}}">{{notif_desc}}</a></li>`

    // get notifications
    $.ajax({
        url: BASE_URL + '/notifications/get_notifications',
        type: 'post',
        data: {
            "get_notifications": "true"
        },
        dataType: 'json',
        success: function (response) {
            if (response['status'] == 200) {
                // console.log(response['notifications']);
                // console.log(`Count: ${count_get_notifications}`)

                if (count_get_notifications == 1) last_notifications = response['notifications'];
                if (arraysEqual(response['notifications'], last_notifications) == false && count_get_notifications > 1) {
                    // console.log("New notifications");
                    alertUser("warning", "You have new notifications")
                    last_notifications = response['notifications'];
                }

                if (response['notifications'].length > 0) {
                    $("#notification-list").empty();
                    response['notifications'].forEach(function (notif) {
                        let notif_html = notification_template;
                        notif_html = notif_html.replace("{{notif_url}}", notif['link']);
                        notif_html = notif_html.replace("{{notif_desc}}", notif['description']);
                        $("#notification-list").append(notif_html);
                    });
                }


            } else if (response['status'] == 403)
                alertUser("danger", response['desc'])
            else
                alertUser("warning", response['desc'])
        },
        error: function (ajaxContext) {
            alertUser("danger", "Error on retrieving notifications")
        }
    });
}

let calendar_events = [];

const daysTag = document.querySelector(".days");
const currentDate = document.querySelector(".current-date");
const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
const renderCalendar = () => {
    const date = new Date(currYear, currMonth, 1);
    let firstDayofMonth = date.getDay();
    let lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate();
    let lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay();
    let lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate();

    let liTag = "";

    for (let i = firstDayofMonth; i > 0; i--) {
        let eventClass = checkEvent(new Date(currYear, currMonth - 1, lastDateofLastMonth - i + 1), "inactive");
        // console.log(lastDateofLastMonth - i + 1);
        temp = lastDateofLastMonth - i + 1
        // console.log(new Date(currYear, currMonth - 1, temp));
        // console.log(new Date(2024, 3, 31));
        // console.log(currYear, currMonth, lastDateofLastMonth - i + 1);
        // liTag += `<li class="inactive ${eventClass}">${lastDateofLastMonth - i + 1}</li>`;
        liTag += `<li class="inactive ${eventClass[0]}"><span>${lastDateofLastMonth - i + 1}</span>${eventClass[1]}</li>`;
    }

    for (let i = 1; i <= lastDateofMonth; i++) {
        let isToday = i === new Date().getDate() && currMonth === new Date().getMonth() && currYear === new Date().getFullYear() ? "active" : "";
        let eventClass = checkEvent(new Date(currYear, currMonth, i), "active");
        // liTag += `<li class="${isToday} ${eventClass}">${i}</li>`;
        liTag += `<li class="${isToday} ${eventClass[0]}"><span>${i}</span>${eventClass[1]}</li>`;
    }

    for (let i = lastDayofMonth; i < 6; i++) {
        let eventClass = checkEvent(new Date(currYear, currMonth + 1, i - lastDayofMonth + 1), "inactive");
        // liTag += `<li class="inactive ${eventClass}">${i - lastDayofMonth + 1}</li>`;
        liTag += `<li class="inactive ${eventClass[0]}"><span>${i - lastDayofMonth + 1}</span>${eventClass[1]}</li>`;
    }

    currentDate.innerText = `${months[currMonth]} ${currYear}`;
    daysTag.innerHTML = liTag;
};

let popover_wrapper_template = `<div class="popover-wrapper" data-link='{{date}}'>
        <div class="title">{{date}} events</div><div class="event_list">{{popovers_list}}</div></div>`;
let popover_template = `<div class="popover" role="tooltip">{{content}}</div>`;
const checkEvent = (date, isActive) => {
    let return_class = "";
    // console.log(date);
    let popovers = "";
    for (let event of calendar_events) {
        let eventDate = new Date(event.date);
        if (eventDate.getFullYear() === date.getFullYear() && eventDate.getMonth() === date.getMonth() && eventDate.getDate() === date.getDate()) {
            // set popover content by replacing {{content}} with event.description
            popovers += popover_template.replace("{{content}}", event.title);
            return_class = isActive === "active" ? "active-event" : "inactive-event";
        }
    }

    if (popovers != "") {
        let date_str = new Date(date);
        let formattedDate = date_str.toLocaleDateString('en-US', { weekday: 'long', day: 'numeric', month: 'long' });
        popover_wrapper  = popover_wrapper_template.replace("{{date}}", Date.parse(date_str));
        popover_wrapper  = popover_wrapper.replace("{{date}}", formattedDate);
        return [return_class, popover_wrapper.replace("{{popovers_list}}", popovers)];
    }

    return [return_class, ""];

    // return "";
};


let currYear = new Date().getFullYear();
let currMonth = new Date().getMonth();
let calendar_active = false;
function updateCalendarEvents() {
    if (typeof BASE_URL === 'undefined')
        return;

    console.log("Updating calendar events")

    $.ajax({
        url: BASE_URL + '/calendar/get_events',
        type: 'post',
        data: {
            "get_events": "true"
        },
        dataType: 'json',
        success: function (response) {
            if (response['status'] == 200) {
                // console.log(response['events']);

                if (calendar_active == false)
                    return;

                calendar_events = response['events'];
                renderCalendar();
            } else if (response['status'] == 403)
                alertUser("danger", response['desc'])
            else
                alertUser("warning", response['desc'])
        },
        error: function (ajaxContext) {
            alertUser("danger", "Error on retrieving calendar events")
        }
    });
}

$(document).ready(function () {

    // update notifications for every 5 seconds
    updateNotifications();
    setInterval(updateNotifications, 5000);

    // check if .calendar-wrapper exists
    if ($(".calendar-wrapper").length > 0) {
        calendar_active = true;

        const prevNextIcon = document.querySelectorAll(".icons span");

        renderCalendar();

        prevNextIcon.forEach(icon => {
            icon.addEventListener("click", () => {
                currMonth = icon.id === "prev" ? currMonth - 1 : currMonth + 1;
                console.log(currMonth);

                if (currMonth < 0 || currMonth > 11) {
                    currYear = icon.id === "prev" ? currYear - 1 : currYear + 1;
                    currMonth = currMonth < 0 ? 11 : 0;
                }

                renderCalendar();
            });
        });

        updateCalendarEvents();
        setInterval(updateCalendarEvents, 10000);
    }

    // on click popover-wrapper
    $(document).on("click", ".popover-wrapper", function () {
        let date = $(this).attr("data-link");
        window.location.href = BASE_URL + "/calendar/view/" + date;
    });

    // sidebar menu
    $("#check").change(function () {
        if (this.checked)
            $('.mobile__menu').css('transform', 'none');
        else
            $('.mobile__menu').css('transform', 'translate(+100%, 0)');

        $('.sidebar__mask').fadeToggle(300);
        $('body').toggleClass('open');
    });

    $('.sidebar__mask').on('click', function () {
        $('#check').click();
    });

    $(document).on("click", ".image-preview-table .delete-preview-btn", function () {
        if (--$(this).closest(".image-preview-table tbody").find('tr').length == 0)
            $(this).closest(".image-preview-table").hide();
        $(this).closest("tr").remove();
    });

    // on click js-link 
    $(document).on("click", ".js-link", function (e) {
        e.preventDefault();
        var href = $(this).attr("href");
        if (href == "#")
            return;

        if (isInternalLink(href))
            window.location.href = href;
    });

    // if clicked on a inside js-link
    $(document).on("click", ".js-link a, .js-link .btn", function (e) {
        e.stopPropagation();
    });

    // on click sidebar-toggle-btn
    $(document).on("click", ".sidebar-toggle-btn", function () {
        // transform: translateX(0%);
        if ($(".sidebar").css("transform") == "matrix(1, 0, 0, 1, 0, 0)") {
            $(".sidebar").css("transform", "translateX(-100%)");

            // fadeout sidebar-bg
            // fadeout after delay
            setTimeout(function () {
                $(".sidebar-bg").fadeOut(200, function () {
                    $(this).remove();
                });
            }, 200);
            // $(".sidebar-toggle-btn").css("transform", "translateX(0%)");
        } else {
            $(".sidebar").css("transform", "translateX(0%)");

            // append sidebar-bg to body
            if ($(".sidebar-bg").length == 0)
                $("body").append("<div class='sidebar-bg'></div>");

            $(".sidebar-bg").fadeIn(200);

            // $(".sidebar-toggle-btn").css("transform", "translateX(100%)");
        }
    });

    $(document).on("click", ".sidebar-bg", function () {
        $(".sidebar-toggle-btn").click();
    });
});
