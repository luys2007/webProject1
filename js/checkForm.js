function validate_form() {

    var grecaptcha = document.querySelector('[name="captcha"]');

    const recaptcha_box_checked = (grecaptcha.getResponse()) ? true : false;

    if (recaptcha_box_checked) {
        return true;
    }
    else {
        alert("You must check the 'I am not a robot' box before you can start a game!");
        return false;
    }
}