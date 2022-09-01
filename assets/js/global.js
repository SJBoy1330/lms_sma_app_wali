
// const unreload = (event) => {
//     event = event || window.event;
//     event.preventDefault();
//     window.history.pushState({}, "", event.target.href);
//     handleLocation(event.target.href);
// };

// const handleLocation = async (root) => {
//     const route = root + '?routing=true' || routes[404];
//     const html = await fetch(route).then((data) => data.text());
//     document.getElementById("reload-content").innerHTML = html;
// };

// window.onpopstate = handleLocation;
// window.route = route;


// handleLocation();



// Javascript Pribadi

function password_show_hide() {

    var x = document.getElementById("kata_sandi");

    var show_eye = document.getElementById("show_eye");

    var hide_eye = document.getElementById("hide_eye");

    hide_eye.classList.remove("d-none");

    if (x.type === "password") {

        x.type = "text";

        show_eye.style.display = "none";

        hide_eye.style.display = "block";

    } else {

        x.type = "password";

        show_eye.style.display = "block";

        hide_eye.style.display = "none";

    }

}

