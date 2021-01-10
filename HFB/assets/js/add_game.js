$(document).ready(function () {

    $("form#add_game_form").submit(function(e){
        e.preventDefault();    
        var formData = new FormData(this);

        $.ajax({
            type :'POST',
            url  :"../../assets/php/add_game.php", 
            data :formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(res){
                $('.modal-body').html(res);
                $('#exampleModal').modal('show'); 
            },
            async: false,
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError);
            }
        });

    });


});