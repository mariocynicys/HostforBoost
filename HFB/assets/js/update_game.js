$(document).ready(function () {
    $(".updateGame").click(function () {

        var request, GID = this.id, gameObj = null;

        request = $.ajax({
            type: "GET",
            url: "../../assets/php/game_info.php",
            data: { "GID": GID },
            dataType: "json"
        });
        request.done(function (msg) {
            gameObj = { ...msg };
            var modalbody = `<div class="form-row text-center">\
                                    <div class="col">\
                                        <img class="img-thumbnail" width="300" height="400" src="../../assets/img/games/${gameObj.GPoster}" onClick="triggerClick2()" id="gameDisplay" title="Upload a game poster">\
                                        <input type="file" name="gameImage" onChange="displayImage2(this)" id="gameImage" class="form-control" style="display: none;" title="Upload a game poster">\
                                    </div>\
                                </div>\
                                <br>`;

            modalbody += `<div class="form-row">\
                            <div class="col">`;

            modalbody += `<div class="form-row">\
                            <div class="col">\
                                <div class="form-group">\
                                    <label for="gname"><strong>Name</strong></label>\
                                    <input type="text" class="form-control" placeholder="pbg" name="gname" autocomplete="off" required maxlength="20" pattern="^[A-Za-z0-9, ]{1,20}$" title="Game name can be up to 20 letters and numbers" value="${gameObj.GName}" />\
                                </div>\
                            </div>\
                            <div class="col">\
                                <div class="form-group">\
                                    <label for="ggenre"><strong>Genre</strong></label>\
                                    <input type="text" class="form-control" placeholder="action" name="ggenre" autocomplete="off"" maxlength=" 80" required pattern="^[A-Za-z0-9, ]{1,20}$" title="Game genre can be up to 80 letters and numbers" value="${gameObj.GGenre}" />\
                                </div>\
                            </div>\
                        </div>`;

            let dateNumbers = gameObj.GReleasedDate.split("-");
            let year = dateNumbers[0];
            let month = dateNumbers[1];
            let day = dateNumbers[2];
            let newDateFormat = `${year}-${month}-${day}`;

            modalbody += `<div class="form-row">\
                            <div class="col">\
                                <div class="form-group">\
                                    <label for="grate"><strong>Rate</strong></label>\
                                    <input type="number" class="form-control" placeholder="8.5" name="grate" autocomplete="off" required maxlength="10" min="0" max="10" step="0.1" value=${gameObj.GRate} />\
                                </div>\
                            </div>\
                            <div class="col">\
                                <div class="form-group">\
                                    <label for="greleased_date"><strong>Released Date</strong></label>\
                                    <input class="form-control" placeholder="yyyy-mm-dd" name="greleased_date" autocomplete="off" required maxlength="10" type="date" value=${newDateFormat} />\
                                </div>\
                            </div>\
                        </div>`;

            modalbody += `<div class="form-row">\
                            <div class="col">\
                                <div class="form-group">\
                                    <label for="gpublisher"><strong>Publisher</strong></label>\
                                    <input type="text" class="form-control" placeholder="comapny_x" name="gpublisher" autocomplete="off" required maxlength="50" pattern="^[A-Za-z0-9,  ]{1,20}$" title="Game publisher can be up to 50 letters and numbers" value="${gameObj.GPublisher}" />\
                                </div>\
                            </div>\
                            <div class="col">\
                                <div class="form-group">\
                                    <label for="usertype"><strong>Trailer URL</strong></label>\
                                    <input type="url" class="form-control" placeholder="https://www.youtube.com/watch?v=${gameObj.GTrailer}" name="gtrailer" autocomplete="off" required maxlength="43" minlength="43" value="https://www.youtube.com/watch?v=${gameObj.GTrailer}" />\
                                </div>\
                            </div>\
                        </div>`;

            modalbody += `</div>\
                        </div>`;

            $('#modal_content').html(modalbody);
            $('#exampleModal').modal('show');
            $("form#update_game_form").submit(function (e) {
                e.preventDefault();
                let formData = new FormData(this);
                formData.append("GID", GID);
                $.ajax({
                    type: 'POST',
                    url:  "../../assets/php/update_game.php", 
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function(res){
                        $("#modal_alert_content").html(res);
                        $("#modal_alert").show();
                    },
                    async: false,
                    error: function(xhr, ajaxOptions, thrownError) {
                        console.log(thrownError);
                    }
                });

            });
        });

        request.fail(function (jqXHR, textStatus) {
            console.log("Failed to make a follow request! " + textStatus);
        });

    });


    $(document).on('click', '.alert_close', function() {
        $(this).parent().hide();
    })

});