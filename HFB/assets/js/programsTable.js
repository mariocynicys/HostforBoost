function detailFormatter2(index, row){
    
    let rpid = row._data['pid'];
    let curUser = row._data['curuser'];

    let joinButton = `<button onclick="javascript:useProgram(${rpid}, '${curUser}')" type="button" class="btn btn-primary btn-lg">Use Now</button>`;
    let leaveButton = `<button onclick="javascript:leaveProgram(${rpid}, '${curUser}')" type="button" class="btn btn-danger btn-lg">Leave</button>`;
    
    return `<div class="container-fluid"><div class="row"><div class="col-sm" style="text-align: right;">${joinButton} ${leaveButton}</div></div></div>`;
}


function useProgram(rpid, curUser){

    $.ajax({
        type :'POST',
        url  :"../../assets/php/use_program.php", 
        data :{"pid": rpid, "username": curUser},
        dataType: "text",
        success: function(res){
            $('.modal-body').html(res);
            $('#exampleModal').modal('show'); 
        },
        async: false,
        error: function(xhr, ajaxOptions, thrownError) {
            console.log(thrownError);
        }
    });

}

function leaveProgram(rpid, curUser){

    $.ajax({
        type :'POST',
        url  :"../../assets/php/leave_program.php", 
        data :{"pid": rpid, "username": curUser},
        dataType: "text",
        success: function(res){
            $('.modal-body').html(res);
            $('#exampleModal').modal('show'); 
        },
        async: false,
        error: function(xhr, ajaxOptions, thrownError) {
            console.log(thrownError);
        }
    });

}


