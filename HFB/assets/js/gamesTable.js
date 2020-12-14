function detailFormatter(index, row){
    
    let gameTrailer;
    
    $.ajax({
        url  :"assets/php/game_trailer.php", 
        data :{"GID": row._data['gid']},
        type :'GET',
        contentType: "application/json; charset=utf-8",
        dataType: "text",
        success: function(res){
            gameTrailer = res;
        },
        async: false,
        error: function(xhr, ajaxOptions, thrownError) {
            console.log(thrownError);
        }
    });

    let joinButton = `<button type="button" class="btn btn-primary btn-lg">Play Now</button>`;
    let leaveButton = `<button type="button" class="btn btn-danger btn-lg">Leave</button>`;

    if(gameTrailer != ""){
        let trailerVideo = `<iframe width="560" height="315" src="https://www.youtube.com/embed/${gameTrailer}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;
        return `<div class="container-fluid"><div class="row"> <div class="col-sm" style="text-align: center;">${trailerVideo}</div><div class="col-sm" style="text-align: center;"> <br><br><br><br><br><br>${joinButton} ${leaveButton}</div></div></div>`;
    }else{
        return `<div class="container-fluid"><div class="row"><div class="col-sm" style="text-align: center;"> <br><br><br><br><br><br>${joinButton} ${leaveButton}</div></div></div>`;
    }
}

