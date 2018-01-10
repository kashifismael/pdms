$(document).ready(function () {
    // all custom jQuery will go here
    $("[data-toggle=popover]").popover({
        html: true,
        content: function () {
            return $('#popover-content').html();
            //return $('#newDelModal').html();
        }
    });
});

$(document).ready(function () {
    $('time.timeago').timeago();
});
