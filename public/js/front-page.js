document.addEventListener('DOMContentLoaded', function() {
    var html = document.getElementsByTagName('html')[0],
        signupButton = document.getElementById('signup-button'),
        signinButton = document.getElementById('signin-button'),
        signupForm = document.getElementsByClassName('sign-up')[0],
        registerButton = document.getElementById('registerButton'),
        authEmail = document.getElementById('authEmail'),
        regEmail = document.getElementById('regEmail'),
        regPswd = document.getElementById('regPswd'),
        regPswd2 = document.getElementById('regPswd2'),
        regName = document.getElementById('regName'),
        regLastName = document.getElementById('regLastName'),
        signinForm = document.getElementsByClassName('sign-in')[0];


    html.classList.add('height-custom');//hack for this page to make flex work correct

    //activate animation
    signupButton.addEventListener('click', function () {
        event.preventDefault();
        signinForm.classList.add('disable');
        signupForm.classList.add('active');
    });

    signinButton.addEventListener('click', validateAuthForm);

    function validateAuthForm() {
        if (!isCorrectEmail(authEmail)){
            addMistakeClass(authEmail);
            return;
        } else{
            removeMistakeClass(authEmail);
        }
        sendAuth();
    }
    function sendAuth() {
        var data = $('.sign-in').serialize();

        $.ajax({
            type: "POST",
            url: "/auth",
            data: data,
            success: function (data) {
                if (data === "No errors") {
                    window.location.href = '/main';
                } else{
                    $('.alert-danger').html(data).addClass('visible');
                    $('.sign-in')[0].reset();
                }
            }
        })
    }

    var errorsCount = 0;
    registerButton.addEventListener('click', validateRegForm);
    function validateRegForm() {
        errorsCount =  0;
        !isCorrectEmail(regEmail)? addMistakeClass(regEmail): removeMistakeClass(regEmail);
        !isCorrectPswd() ? addMistakeClass(regPswd): removeMistakeClass(regPswd);
        !isConfirmedPswd() ? addMistakeClass(regPswd2): removeMistakeClass(regPswd2);
        !isCorrectName(regName) ? addMistakeClass(regName): removeMistakeClass(regName);
        !isCorrectName(regLastName) ? addMistakeClass(regLastName): removeMistakeClass(regLastName);

        if (errorsCount === -5){
            sendRegister();
        }
    }

    function sendRegister() {
        var data = $('.sign-up').serialize();
        var response;
        $.ajax({
            type: "POST",
            url: "/register",
            data: data,
            success: function (data) {
                if (data && Object.keys(JSON.parse(data)).length > 0)
                    outputErrors(JSON.parse(data));
                else{
                    window.location.href = '/activate-email';
                }
            }
        });
    }

    function outputErrors(errors) {
        for (var property in errors) {
            if (errors.hasOwnProperty(property)) {
                switch (property){
                    case 'mail':
                        regEmail.nextElementSibling.innerHTML = errors[property];
                        regEmail.nextElementSibling.classList.add('visible');
                        break;
                    case 'name':
                        regName.nextElementSibling.innerHTML = errors[property];
                        regEmail.nextElementSibling.classList.add('visible');
                        break;
                    case 'lastName':
                        regLastNameName.nextElementSibling.innerHTML = errors[property];
                        regEmail.nextElementSibling.classList.add('visible');
                        break;
                    case 'pswd':
                        regPswd.nextElementSibling.innerHTML = errors[property];
                        regEmail.nextElementSibling.classList.add('visible');
                        break;
                    case 'pswd2':
                        regPswd2.nextElementSibling.innerHTML = errors[property];
                        regEmail.nextElementSibling.classList.add('visible');
                        break;
                }
            }
        }
    }

    function addMistakeClass(element) {
        element.nextElementSibling.classList.add('visible');
        errorsCount++;
    }

    function removeMistakeClass(element) {
        element.nextElementSibling.classList.remove('visible');
        errorsCount--;
    }

    function isCorrectPswd() {
        return regPswd.value.length > 5 && regPswd.value.length < 17;
    }

    function isCorrectName(element){
        return element.value.length > 1 && element.value.length < 17;
    }
    function isConfirmedPswd() {
        return regPswd.value === regPswd2.value;
    }

    function isCorrectEmail(email) {
        var regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return regex.test(email.value);
    }
});

