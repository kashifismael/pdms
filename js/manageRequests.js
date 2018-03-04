var deadlineResponses = {};
var deleteResponses = {};

$('.deadlineRadio').click(addToDeadlineResponse);
$('.deleteRadio').click(addToDeleteResponse);

$('#deadlineResponse').click(submitDeadlineResponse);
$('#deleteResponse').click(submitDeleteResponse);

function submitDeadlineResponse() {
    $("#processingModal").modal("show");
    var responseList = JSON.stringify(deadlineResponses);
    $.ajax({
        method: 'POST',
        url: "processDeadlineResponses",
        data: {
            responseObject: responseList,
        },
        success: function (data) {
            $("#processingModal").modal("hide");
            var deadlineReqNumber = Number(document.getElementById("deadlineReqNumber").innerHTML);
            var totalRequestNumber = Number(document.getElementById("totalReqs").innerHTML);
            var responded = JSON.parse(data);
            responded.forEach(function (element) {
                $("#request" + element).remove();
            });
            document.getElementById("deadlineReqNumber").innerHTML = deadlineReqNumber - responded.length;
            document.getElementById("totalReqs").innerHTML = totalRequestNumber - responded.length;
            $("#requestSuccessNotif").fadeIn("slow");
            deadlineResponses = {};
            $('#deadlineResponse').prop("disabled", true);
        }
    });
}

function submitDeleteResponse() {
    $("#processingModal").modal("show");
    var responseList = JSON.stringify(deleteResponses);
    $.ajax({
        method: 'POST',
        url: "processDeleteResponses",
        data: {
            responseObject: responseList,
        },
        success: function (data) {
            $("#processingModal").modal("hide");
            var deleteRequestNumber = Number(document.getElementById("deleteReqNumber").innerHTML);
            var totalRequestNumber = Number(document.getElementById("totalReqs").innerHTML);
            var responded = JSON.parse(data);
            responded.forEach(function (element) {
                $("#request" + element).remove();
            });
            document.getElementById("deleteReqNumber").innerHTML = deleteRequestNumber - responded.length;
            document.getElementById("totalReqs").innerHTML = totalRequestNumber - responded.length;
            $("#requestSuccessNotif").fadeIn("slow");
            deleteResponses = {};
            $('#deleteResponse').prop("disabled", true);
        }
    });
}

function addToDeadlineResponse(event) {
    $('#deadlineResponse').prop("disabled", false);
    var $element = $(event.target);
    var response = $element.val();
    var request = $element.closest('tr[data-request]').data('request');
    deadlineResponses[request] = response;
}
function addToDeleteResponse(event) {
    $('#deleteResponse').prop("disabled", false);
    var $element = $(event.target);
    var response = $element.val();
    var request = $element.closest('tr[data-request]').data('request');
    deleteResponses[request] = response;
}
