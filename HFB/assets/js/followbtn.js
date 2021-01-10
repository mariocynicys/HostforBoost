$(document).ready(function () {
    $(".followbtn").click(function () {

        username = this.id.split("-")[0];
        friendname = this.id.split("-")[1];

        var request = $.ajax({
            type: "POST",
            url: "../../assets/php/make_follow.php",
            data: { username: username, friendname: friendname },
            dataType: "html"
        });

        request.done(function (msg) {
            console.log("Response: " + msg);
        });

        request.fail(function (jqXHR, textStatus) {
            console.log("Failed to make a follow request! " + textStatus);
        });


        $("#" + this.id).parent().parent().parent().parent().fadeOut();
        $("#" + this.id).parent().parent().parent().parent().parent().append("<div class='col col-sm-3'></div>");

    });
});