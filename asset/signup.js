function signup() {
  let username = document.getElementById("name").value;
  let password = document.getElementById("password").value;
  let email = document.getElementById("email").value;
  let role = document.getElementById("role").value;

  let user = {
    name: username,
    password: password,
    email: email,
    role: role,
  };

  let data = JSON.stringify(user);

  let xhttp = new XMLHttpRequest();

  xhttp.open("POST", "../controller/auth.php", true);

  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);
      let response = JSON.parse(this.responseText);
      if (response.status) {
        window.location.href = "../view/login.php";
      } else {
        document.getElementById("msg").innerHTML = response.message;
      }
    }
  };

  xhttp.send("type=signup&user=" + data);
}
