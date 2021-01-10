$(document).ready(function () {
    $(".updateGame").click(function () {

        var request, PID = this.id, programObj = null;

        request = $.ajax({
            type: "GET",
            url: "../../assets/php/program_info.php",
            data: { "PID": PID },
            dataType: "json"
        });
        request.done(function (msg) {
            programObj = { ...msg };
            var modalbody = `<div class="form-row text-center">\
                                    <div class="col">\
                                        <img class="img-thumbnail" width="300" height="400" src="../../assets/img/programs/${programObj.PPoster}" onClick="triggerClick3()" id="programDisplay" title="Upload a program poster or logo">\
                                        <input type="file" name="programImage" onChange="displayImage3(this)" id="programImage" class="form-control" style="display: none;" title="Upload a program poster or logo">\
                                    </div>\
                                </div>\
                                <br>`;

            modalbody += `<div class="form-row">\
                            <div class="col">`;

            modalbody += `<div class="form-row">\
                            <div class="col">\
                                <div class="form-group">\
                                    <label for="pname"><strong>Name</strong></label>\
                                    <input type="text" class="form-control" placeholder="Adobe" name="pname" autocomplete="off" required maxlength="20" pattern="^[A-Za-z0-9,  ]{1,20}$" title="Program name can be up to 20 letters and numbers" value=${programObj.PName} />
                                </div>\
                            </div>\
                        </div>`;

            let dateNumbers = programObj.PReleasedDate.split("-");
            let year = dateNumbers[0];
            let month = dateNumbers[1];
            let day = dateNumbers[2];
            let newDateFormat = `${year}-${month}-${day}`;

            modalbody += `<div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="preleased_date"><strong>Released Date</strong></label>
                                    <input class="form-control" placeholder="yyyy-mm-dd" name="preleased_date" autocomplete="off" required maxlength="10" type="date" value=${newDateFormat} />
                                </div>
                            </div>
                        </div>`;

            modalbody += `<div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="ppublisher"><strong>Publisher</strong></label>
                                    <input type="text" class="form-control" placeholder="comapny_x" name="ppublisher" autocomplete="off" required maxlength="80" pattern="^[A-Za-z0-9,]{1,20}$" title="Game publisher can be up to 80 letters and numbers" value=${programObj.PPublisher} />
                                </div>
                            </div>
                        </div>`;

            modalbody += `</div>\
                        </div>`;

            $('#modal_content').html(modalbody);
            $('#exampleModal').modal('show');
            $("form#update_program_form").submit(function (e) {
                e.preventDefault();
                let formData = new FormData(this);
                formData.append("PID", PID);
                $.ajax({
                    type: 'POST',
                    url:  "../../assets/php/update_program.php", 
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