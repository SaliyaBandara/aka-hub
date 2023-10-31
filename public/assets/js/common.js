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

$(document).ready(function () {

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
