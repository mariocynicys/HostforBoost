$(document).ready(function () {
    $(".profileLeavebtn").click(function () {
        
        idData = this.id.split("-");
        username = idData[0];
        type = idData[1];
        typeID = idData[2];
        var request;

        if(type === "Game"){
            request = $.ajax({
                type: "POST",
                url: "../../assets/php/leave_game.php",
                data: { username: username, "gid": typeID },
                dataType: "text"
            });
        }else if(type === "Program"){
            request = $.ajax({
                type: "POST",
                url: "../../assets/php/leave_program.php",
                data: { username: username, "pid": typeID },
                dataType: "text"
            });
        }

        request.done(function (msg) {
            $('.modal-body').html(msg);
            $('#exampleModal').modal('show');
        });

        request.fail(function (jqXHR, textStatus) {
            console.log("Failed to make a follow request! " + textStatus);
        });

    });
    
    $('#exampleModal').on('hidden.bs.modal', function () { 
        window.location.href = "../../views/normal/profile.php";
    });

});