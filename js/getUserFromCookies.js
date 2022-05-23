function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function getData() {
    let x = document.cookie;
    console.log(x);
    let email = document.querySelector("#email");
    let pswd = document.querySelector("#pwd");
    let formatEmail = getCookie("email");
    let formatPswd = getCookie("pswd");
    email.value = formatEmail.replace("%40", "@");
    pswd.value = formatPswd;
}
getData();