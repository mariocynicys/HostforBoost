function triggerClick3(e) {
    document.querySelector('#programImage').click();
}
function displayImage3(e) {
    if (e.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            document.querySelector('#programDisplay').setAttribute('src', e.target.result);
        }
        reader.readAsDataURL(e.files[0]);
    }
}