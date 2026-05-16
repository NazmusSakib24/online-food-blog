function loadPost() {
  let xhttp = new XMLHttpRequest();

  xhttp.open("POST", "../controller/postController.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let response = JSON.parse(this.responseText);
      let posts = response.posts;
      let postDiv = document.getElementById("postDiv");
      postDiv.innerHTML = "";
      for (let i = 0; i < posts.length; i++) {
        postDiv.innerHTML += "<h3>" + posts[i].title + "</h3>";
        postDiv.innerHTML += "<p>" + posts[i].content + "</p>";
        postDiv.innerHTML += "<p>By: " + posts[i].username + "</p>";
        postDiv.innerHTML += "<p>At: " + posts[i].created_at + "</p>";
        if (role == "admin" || posts[i].user_id == user_id) {
          postDiv.innerHTML +=
            '<button onclick="editPost(' + posts[i].id + ')">Edit</button>';
          postDiv.innerHTML +=
            '<button onclick="deletePost(' + posts[i].id + ')">Delete</button>';
        }
        postDiv.innerHTML += "<hr>";
      }
    }
  };

  xhttp.send("type=loadPost");
}

function addPost() {
  let title = document.getElementById("title").value;
  let content = document.getElementById("content").value;

  let post = {
    title: title,
    content: content,
  };

  let data = JSON.stringify(post);
  let xhttp = new XMLHttpRequest();

  xhttp.open("POST", "../controller/postController.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);
      let response = JSON.parse(this.responseText);
      if (response.status) {
        loadPost();
        document.getElementById("msg").innerHTML = response.message;
      } else {
        document.getElementById("msg").innerHTML = response.message;
      }
    }
  };

  xhttp.send("type=addPost&post=" + data);
}

function deletePost(id) {
  let confirmDelete = confirm("Are you sure you want to delete this post?");

  if (!confirmDelete) {
    return;
  }
  let xhttp = new XMLHttpRequest();

  xhttp.open("POST", "../controller/postController.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let response = JSON.parse(this.responseText);
      if (response.status) {
        loadPost();
        document.getElementById("msg").innerHTML = response.message;
      }
    }
  };
  xhttp.send("type=deletePost&id=" + id);
}

function editPost(id) {
  let title = prompt("Enter new title:");
  let content = prompt("Enter new content:");

  if (title == null || content == null) {
    return;
  }

  let post = {
    id: id,
    title: title,
    content: content,
  };

  let data = JSON.stringify(post);
  let xhttp = new XMLHttpRequest();

  xhttp.open("POST", "../controller/postController.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let response = JSON.parse(this.responseText);
      if (response.status) {
        loadPost();
        document.getElementById("msg").innerHTML = response.message;
      } else {
        document.getElementById("msg").innerHTML = response.message;
      }
    }
  };

  xhttp.send("type=editPost&post=" + encodeURIComponent(data));
}

window.onload = function () {
  loadPost();
};
