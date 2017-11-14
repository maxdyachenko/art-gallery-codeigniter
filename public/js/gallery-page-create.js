document.addEventListener('DOMContentLoaded', function() {
    var formCreate = document.getElementsByClassName('create-gallery-form')[0],
        buttonCreate = document.getElementById('create-gallery-btn'),
        fileInput = document.getElementById('file2'),
        galleryName = document.getElementById('galleryName'),
        fileError = document.getElementById('fileError'),
        limitError = document.getElementById('limitError');

    formCreate.addEventListener('submit', validateCreateForm);

    function validateCreateForm() {
        if (!checkAvatar(fileError) || !checkName()){
            event.preventDefault();
        }
    }
    function checkName() {
        if (galleryName.value.length > 0){
            return true;
        }
        else {
            showError(galleryName.nextElementSibling, "Should not be empty");
            return false;
        }
    }

    function checkAvatar(error){
        if (!checkEmptyFile()){
            showError(error, "Should not be empty");
            return false;
        }
        if (getFileSize() > 2000){
            showError(error, "Image size should be less than 2Mb");
            return false;
        }
        else if (!checkFileExtension()){
            showError(error, "Upload only PNG or JPG");
            return false;
        }
        else{
            error.innerHTML = "";
            return true;
        }
    }
    function showError(error, text) {
        error.innerHTML = text;
    }
    function checkEmptyFile() {
        return fileInput.files.length > 0;
    }
    function getFileSize() {
        if (typeof (fileInput.files) !== "undefined") {
            return parseFloat(fileInput.files[0].size / 1024).toFixed(2);
        } else {
            return false;
        }
    }

    function checkFileExtension(){
        return fileInput.value.match(/^.*\.(jpg|JPG|png|PNG)$/);
    }
});