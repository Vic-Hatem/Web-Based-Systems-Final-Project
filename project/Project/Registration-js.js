

users = [];
var name;
document.getElementById("addUsers").addEventListener("click", addUser);


function addUser() {


    let email = document.querySelector("#email").value;
    let confirm1 = document.querySelector("#secondEmail").value;
    let password = document.querySelector("#password").value;
    let confirm2 = document.querySelector("#pass3").value;
    let username = document.querySelector("#username").value;

    if (email == confirm1) {

        if (password == confirm2) {
            users.push({ "Email": email, "Confirm Email": confirm1, "Password": password, "Confirm Password": confirm2, "Username": username });
            alert("Added Succecfully!!!!")
        }
        else {
            alert("Make sure your passwords match")
        }

    }
    else {
        alert("Make sure your emails match")
    }
}

function myUsers() {
    return users;
}

