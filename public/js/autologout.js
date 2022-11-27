/**
 * Script for automatic logout after the inactivity timeout expiration.
 */

/*
 * The following document is taken from the following source on 2022-11-20.
 * Source: https://laracasts.com/discuss/channels/laravel/auto-logout-if-no-activity-in-given-time?page=1&replyId=484851
 * Author: lorenlang
 */
$(document).ready(function () {
    const timeout = 600000;  // 600000 ms = 10 minutes
    var idleTimer = null;

    $('*').bind('mousemove click mouseup mousedown keydown keypress keyup submit change mouseenter scroll resize dblclick', function () {
        clearTimeout(idleTimer);

        idleTimer = setTimeout(function () {
            document.getElementById('logout-form').submit();
        }, timeout);
    });
    $("body").trigger("mousemove");
});
