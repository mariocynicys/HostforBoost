function triggerClick2(e) {
    document.querySelector('#gameImage').click();
}
function displayImage2(e) {
    if (e.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            document.querySelector('#gameDisplay').setAttribute('src', e.target.result);
        }
        reader.readAsDataURL(e.files[0]);
    }
}