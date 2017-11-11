document.addEventListener('DOMContentLoaded', function() {
    var formCreate = document.getElementsByClassName('create-gallery-form')[0],
        buttonCreate = document.getElementById('create-gallery-btn'),
        fileInput = document.getElementById('file2'),
        galleryName = document.getElementById('galleryName'),
        fileError = document.getElementById('fileError'),
        limitError = document.getElementById('limitError');

    buttonCreate.addEventListener('click', validateCreateForm);

    function validateCreateForm() {
        var data = new FormData();

        if (checkAvatar(fileError) && checkName()){
            data.append('file', fileInput.files[0],fileInput.files[0].name);
            data.append('name', galleryName.value);
        }
        else {
            return false;
        }
        $.ajax({
            type: "POST",
            url: "/create-gallery-form",
            data: data,
            processData: false,
            contentType: false,
            success: function (data) {
                $('.create-gallery-form')[0].reset();
                var obj = data ? JSON.parse(data) : false;
                if (obj && Object.keys(obj).length > 0) {
                    if (obj.name) {
                        showError(galleryName.nextElementSibling, obj.name);
                    }
                    else if(obj.img) {
                        showError(fileError, obj.img);
                    }
                    else if(obj.limit) {
                        showError(limitError, obj.limit);
                    }
                } else{
                    window.location.href = '/gallery-list';
                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        })
    }
    function checkName() {
        if (galleryName.value.length > 0){
            galleryName.nextElementSibling.classList.remove('visible');
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
            error.classList.remove('visible');
            error.innerHTML = "";
            return true;
        }
    }
    function showError(error, text) {
        error.classList.add('visible');
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