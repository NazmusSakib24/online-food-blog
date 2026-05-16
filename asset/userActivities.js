function loadUserPosts() {

    let xhttp = new XMLHttpRequest();

    xhttp.open("POST", "../controller/userActivityController.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhttp.onreadystatechange = function () {

        if (this.readyState == 4 && this.status == 200) {

            let response = JSON.parse(this.responseText);

            let posts = response.posts;

            let div = document.getElementById("postDiv");
            div.innerHTML = "<h3>User Posts</h3>";

            for (let i = 0; i < posts.length; i++) {
                div.innerHTML += `
                    <p>
                        <b>${posts[i].title}</b><br>
                        ${posts[i].content}
                    </p>
                    <hr>
                `;
            }
        }
    };

    xhttp.send("type=getUserPosts&user_id=" + user_id);
}

function loadUserComments() {

    let xhttp = new XMLHttpRequest();   

    xhttp.open("POST", "../controller/userActivityController.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhttp.onreadystatechange = function () {

        if (this.readyState == 4 && this.status == 200) {
            let response = JSON.parse(this.responseText);

            let comments = response.comments;
            let div = document.getElementById("commentDiv");
            div.innerHTML = "<h3>User Comments</h3>";
            for (let i = 0; i < comments.length; i++) {
                div.innerHTML += `
                    <p>
                        <b>On Post ID ${comments[i].post_id}:</b><br>
                        ${comments[i].content}  
                    </p>
                    <hr>
                `;  
            }
        }
    };
    xhttp.send("type=getUserComments&user_id=" + user_id);
}

window.onload = function () {
    loadUserPosts();
    loadUserComments();
}