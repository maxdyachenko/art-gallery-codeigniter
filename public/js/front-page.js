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

    signinForm.addEventListener('submit', validateAuthForm);

    function validateAuthForm() {
        if (!isCorrectEmail(authEmail)){
            addMistake(authEmail, "Invalid email");
            event.preventDefault();
        } else{
            removeMistake(authEmail);
        }
    }

    var errorsCount = 0;
    signupForm.addEventListener('submit', validateRegForm);
    function validateRegForm() {
        errorsCount =  0;
        !isCorrectEmail(regEmail)? addMistake(regEmail, 'Invalid email'): removeMistake(regEmail);
        !isCorrectPswd() ? addMistake(regPswd, 'Min 6 chars, max 16 chars'): removeMistake(regPswd);
        !isConfirmedPswd() ? addMistake(regPswd2, 'Passwords not equal'): removeMistake(regPswd2);
        !isCorrectName(regName) ? addMistake(regName, 'Min 2 chars, max 16 chars'): removeMistake(regName);
        !isCorrectName(regLastName) ? addMistake(regLastName, 'Min 2 chars, max 16 chars'): removeMistake(regLastName);

        if (errorsCount !== -5){
            event.preventDefault();
        }
    }


    function addMistake(element, mistake) {
        element.nextElementSibling.innerHTML = mistake;
        errorsCount++;
    }

    function removeMistake(element) {
        element.nextElementSibling.innerHTML = '';
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

