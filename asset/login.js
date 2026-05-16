function login(){

    let username = document.getElementById('username').value;
    let password = document.getElementById('password').value;
    let role = document.getElementById('role').value;

    let user = {
        'username': username,
        'password': password,
        'role': role
    };

    let data = JSON.stringify(user);

    let xhttp = new XMLHttpRequest();

    xhttp.open('POST', '../controller/auth.php', true);
    xhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');

    xhttp.onreadystatechange = function (){
        if(this.readyState == 4 && this.status == 200){

            let response = JSON.parse(this.responseText);

            if(response.status){
                window.location.href = "../view/homePage.php";
            }else{
                document.getElementById('msg').innerHTML = response.message;
            }
        }
    }

    xhttp.send('type=login&user=' + data);
}