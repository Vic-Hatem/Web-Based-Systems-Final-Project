
document.getElementById("addUsers").addEventListener("click", addUser);


function addUser() {


    let email = document.querySelector("#email").value;
    let confirm1 = document.querySelector("#secondEmail").value;
    let password = document.querySelector("#password").value;
    let confirm2 = document.querySelector("#pass3").value;
    let username = document.querySelector("#username").value;

    if (email == confirm1) {

        if (password == confirm2) {
        }
        else {
            alert("Make sure your passwords match")
        }

    }
    else {
        alert("Make sure your emails match")
    }
}


