document.addEventListener("DOMContentLoaded", function () {

    console.log("CRUD aplikacija pokrenuta.");

    const form = document.querySelector("form");

    if (form) {
        form.addEventListener("submit", function (e) {

            const email = document.querySelector("input[type='email']").value;

            if (!email.includes("@")) {
                e.preventDefault();
                alert("Unesi validan email!");
            }

        });
    }

});