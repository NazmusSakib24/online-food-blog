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
        document.getElementById("msg").innerHTML = response.message;
        return;
      }

      let members = response.members;

      for (let i = 0; i < members.length; i++) {
        div.innerHTML +=
          "<div>" +
          "<p><b>ID:</b> " +
          members[i].id +
          "</p>" +
          "<p><b>Name:</b> " +
          members[i].username +
          "</p>" +
          "<p><b>Email:</b> " +
          members[i].email +
          "</p>" +
          "<button onclick='deleteMember(" +
          members[i].id +
          ")'>Delete</button>" +
          "<button onclick='viewUserActivity(" +
          members[i].id +
          ")'>View Activities</button>" +
          "</div>" +
          "<hr>";
      }
    }
  };

  xhttp.send("type=loadMembers");
}

function deleteMember(id) {
  let confirmation = confirm("Are you sure you want to delete this member?");
  if (!confirmation) {
    return;
  }
  let xhttp = new XMLHttpRequest();

  xhttp.open("POST", "../controller/memberController.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let response = JSON.parse(this.responseText);

      if (response.status) {
        document.getElementById("msg").innerHTML = response.message;
        loadMembers();
      } else {
        document.getElementById("msg").innerHTML = response.message;
      }
    }
  };

  xhttp.send("type=deleteMember&id=" + id);
}
window.onload = loadMembers;

function viewUserActivity(user_id) {
  window.location.href = "userActivities.php?user_id=" + user_id;
}
