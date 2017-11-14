// document.addEventListener('DOMContentLoaded', function() {
//     var username = document.getElementById('nameInput'),
//         userLastName = document.getElementById('lastNameInput'),
//         pswd = document.getElementById('InputPassword2'),
//         userEditForm = document.getElementsByClassName('user-edit-form')[0],
//         pswdEditForm = document.getElementsByClassName('pswd-edit-form')[0];
//
//     userEditForm.addEventListener('submit', nameFormValidate);
//
//     function nameFormValidate() {
//         !isCorrectName(username) ? addMistake(username, "Min 2 chars, max 16 chars"): removeMistake(username);
//         !isCorrectName(userLastName) ? addMistake(userLastName, "Min 2 chars, max 16 chars"): removeMistake(userLastName);
//     }
//     function isCorrectName(element){
//         if (element.value.length > 0)
//             return element.value.length > 1 && element.value.length < 17;
//         else
//             return true;
//     }
//     function addMistake(element, error){
//         element.nextElementSibling.innerHTML = error;
//         event.preventDefault()
//     }
//     function removeMistake(element) {
//         element.nextElementSibling.innerHTML = "";
//     }
//
//     pswdEditForm.addEventListener('submit', pswdFormValidate);
//     function pswdFormValidate() {
//         !isCorrectPswd(pswd) ? addMistake(pswd, "Min 6 chars, max 16 chars"): removeMistake(pswd);
//     }
//
//     function isCorrectPswd() {
//         return pswd.value.length > 5 && pswd.value.length < 17;
//     }
//
//
//     var fileInput = document.getElementById('file2'),
//         avatarForm = document.getElementsByClassName('avatar-edit-form')[0],
//         error = avatarForm.getElementsByClassName('invalid-feedback')[0];
//
//
//     avatarForm.addEventListener('submit', checkAvatar);
//     function checkAvatar(){
//         if (getFileSize() > 2000){
//             error.innerHTML = "Image size should be less than 2Mb";
//             event.preventDefault();
//         }
//         else if (!checkFileExtension()){
//             error.innerHTML = "Upload only PNG or JPG";
//             event.preventDefault();
//         }
//         else{
//             error.innerHTML = "";
//         }
//     }
//     function getFileSize() {
//         if (typeof (fileInput.files) !== "undefined") {
//             return parseFloat(fileInput.files[0].size / 1024).toFixed(2);
//         } else {
//             return false;
//         }
//     }
//
//     function checkFileExtension(){
//         return fileInput.value.match(/^.*\.(jpg|JPG|png|PNG)$/);
//     }
//
//
// });
//
