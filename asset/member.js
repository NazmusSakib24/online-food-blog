function loadMembers() {

    let xhttp = new XMLHttpRequest();

    xhttp.open("POST", "../controller/memberController.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhttp.onreadystatechange = function () {

        if (this.readyState == 4 && this.status == 200) {

            let response = JSON.parse(this.responseText);

            let div = document.getElementById("memberDiv");
            div.innerHTML = "";

            if (!response.status) {
                div.innerHTML = response.message;
                return;
            }

            let members = response.members;

            if (members.length == 0) {
                div.innerHTML = "No members found";
                return;
            }

            for (let i = 0; i < members.length; i++) {

                div.innerHTML += `
                    <div style="border:1px solid black; padding:10px; margin:5px;">
                        <p><b>ID:</b> ${members[i].id}</p>
                        <p><b>Name:</b> ${members[i].username}</p>
                        <p><b>Email:</b> ${members[i].email}</p>

                        <button onclick="deleteMember(${members[i].id})">Delete</button>
                        <button onclick="viewUserActivity(${members[i].id})">View Activities</button>
                    </div>
                `;
            }
        }
    };

    xhttp.send("type=getMembers");
}

function deleteMember(id) {

    let xhttp = new XMLHttpRequest();

    xhttp.open("POST", "../controller/memberController.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhttp.onreadystatechange = function () {

        if (this.readyState == 4 && this.status == 200) {

            let response = JSON.parse(this.responseText);

            if (response.status) {
                document.getElementById('msg').innerHTML = response.message;
                loadMembers();
            } else {
                document.getElementById('msg').innerHTML = response.message;
            }
        }
    };

    xhttp.send("type=deleteMember&id=" + id);
}
window.onload = loadMembers;

function viewUserActivity(user_id) {
    window.location.href = "userActivities.php?user_id=" + user_id;
}