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
        postDiv.innerHTML += "<h2>Post for: " + posts[i].type + "</h2>";
        postDiv.innerHTML += "<h3>" + posts[i].title + " <span style='font-size:12px; color:black;'>[ " + posts[i].username + " | " + posts[i].created_at + " ]</span></h3>";
        postDiv.innerHTML += "<p>" + posts[i].content + "</p>";

        if (role == "admin" || posts[i].user_id == user_id) {
          postDiv.innerHTML += '<button onclick="editPost(' + posts[i].id + ')">Edit</button>';
          postDiv.innerHTML += '<button onclick="deletePost(' + posts[i].id +')">Delete</button><br><br>';
        }
        if (user_id) {
          postDiv.innerHTML += `<div> 
                                 <input type="text" id="comment_${posts[i].id}" placeholder="Write comment">
                                 <button onclick="addComment(${posts[i].id})">Comment</button>
                                </div>`;
        } else {
          postDiv.innerHTML += `<div> <input type="text" placeholder="Write comment" disabled> <button onclick="goToLogin()">Comment</button> </div> `;
        }
        postDiv.innerHTML += `<div id="commentDiv_${posts[i].id}"></div>`;
        loadComments(posts[i].id);
      }
      postDiv.innerHTML += "<hr>";
    }
  };

  xhttp.send("type=loadPost");
}

function addPost() {
  let title = document.getElementById("title").value;
  let content = document.getElementById("content").value;
  let type = document.getElementById("type").value;

  let post = {
    title: title,
    content: content,
    type: type,
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
        document.getElementById("title").value = "";
        document.getElementById("content").value = "";
        document.getElementById("type").value = "";
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

function addComment(post_id) {
  let commentText = document.getElementById("comment_" + post_id).value;

  let comment = {
    post_id: post_id,
    comment: commentText,
  };

  let data = JSON.stringify(comment);

  let xhttp = new XMLHttpRequest();

  xhttp.open("POST", "../controller/postController.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let response = JSON.parse(this.responseText);

      if (response.status) {
        loadComments(post_id);
        document.getElementById("comment_" + post_id).value = "";
      } else {
        alert(response.message);
      }
    }
  };

  xhttp.send("type=addComment&comment=" + encodeURIComponent(data));
}

function loadComments(post_id) {
  let xhttp = new XMLHttpRequest();

  xhttp.open("POST", "../controller/postController.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let response = JSON.parse(this.responseText);
      let comments = response.comments || [];

      let commentDiv = document.getElementById("commentDiv_" + post_id);
      commentDiv.innerHTML = "<h4>Comments:</h4>";

      for (let i = 0; i < comments.length; i++) {
        commentDiv.innerHTML += "<p>" + comments[i].comment + " <span style='font-size:12px; color:black;'>[ " + comments[i].username + " | " + comments[i].created_at + " ]</span></p>";
       

        if (role == "admin" || comments[i].user_id == user_id) {
          commentDiv.innerHTML += '<button onclick="editComment(\'' + comments[i].id + '\', \'' + comments[i].comment + '\', ' + post_id + ')">Edit</button>';
          commentDiv.innerHTML += '<button onclick="deleteComment(' + comments[i].id + ', ' + post_id + ')">Delete</button>';
        }
      }
      commentDiv.innerHTML += "<hr>";
    }
  };

  xhttp.send("type=loadComments&post_id=" + post_id);
}

function deleteComment(id, post_id) {
  let confirmDelete = confirm("Delete this comment?");

  if (!confirmDelete) return;

  let xhttp = new XMLHttpRequest();

  xhttp.open("POST", "../controller/postController.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let response = JSON.parse(this.responseText);

      if (response.status) {
        loadComments(post_id);
      } else {
        alert(response.message);
      }
    }
  };

  xhttp.send("type=deleteComment&id=" + id);
}

function editComment(id, oldComment, post_id) {
  let newComment = prompt("Edit your comment:", oldComment);

  if (newComment == null) {
    return;
  }

  let comment = {
    id: id,
    comment: newComment,
  };

  let data = JSON.stringify(comment);

  let xhttp = new XMLHttpRequest();

  xhttp.open("POST", "../controller/postController.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let response = JSON.parse(this.responseText);
      if (response.status) {
        loadComments(post_id);
      } else {
        alert(response.message);
      }
    }
  };
  xhttp.send("type=editComment&comment=" + encodeURIComponent(data));
}
function goToLogin() {
  window.location.href = "login.php";
}
