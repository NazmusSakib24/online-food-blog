function login() {
  let name = document.getElementById("name").value;
  let password = document.getElementById("password").value;

  let user = {
    name: name,
    password: password,
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
        if (response.role === "admin") {
          window.location.href = "../view/dashboard.php";
        } else if (response.role === "member") {
          window.location.href = "../view/memberPage.php";
        }
      } else {
        document.getElementById("msg").innerHTML = response.message;
      }
    }
  };

  xhttp.send("type=login&user=" + encodeURIComponent(data));
}
