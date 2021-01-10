function detailFormatter(index, row){
    
    let gameTrailer;
    let rgid = row._data['gid'];
    let curUser = row._data['curuser'];
    
    $.ajax({
        url  :"../../assets/php/game_trailer.php", 
        data :{"GID": rgid},
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

    if(gameTrailer != ""){
        let trailerVideo = `<iframe width="560" height="315" src="https://www.youtube.com/embed/${gameTrailer}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;
        return `<div class="container-fluid"><div class="row"> <div class="col-sm" style="text-align: center;">${trailerVideo}</div></div></div>`;
    }
}