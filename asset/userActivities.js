function loadUserPosts() {
  let xhttp = new XMLHttpRequest();

  xhttp.open("POST", "../controller/userActivityController.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let response = JSON.parse(this.responseText);

      let div = document.getElementById("postDiv");
      div.innerHTML = "";

      if (!response.status) {
        document.getElementById("postMsg").innerHTML = response.message;
        return;
      }

      let posts = response.posts;

      div.innerHTML = "<h3>User Posts</h3>" + "<hr>";

      for (let i = 0; i < posts.length; i++) {
        div.innerHTML +=
          "<div>" +
          "<p><b>User Name:</b> " +
          posts[i].name +
          " | <b>Post ID:</b> "+
          posts[i].id +
          " | <b>Type:</b> " +
          posts[i].type +
          " | <b>Time:</b> " +
          posts[i].created_at +
          " | <b>Updated Time:</b> " +
          posts[i].updated_at +
          "</p>" +
          "<h3>" +
          posts[i].title +
          "</h3>" +
          "<p>" +
          posts[i].content +
          "</p>" +
          "<button onclick='editPost(" +
          posts[i].id +
          ")'>Edit</button>" +
          "<button onclick='deletePost(" +
          posts[i].id +
          ")'>Delete</button>" +
          "<hr>" +
          "</div><hr>";
      }
    }
  };

  xhttp.send("type=loadUserPosts&user_id=" + user_id);
}

function loadUserComments() {
  let xhttp = new XMLHttpRequest();

  xhttp.open("POST", "../controller/userActivityController.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let response = JSON.parse(this.responseText);

      if (!response.status) {
        document.getElementById("commentMsg").innerHTML = response.message;
        return;
      }

      let comments = response.comments;
      let div = document.getElementById("commentDiv");
      div.innerHTML = "<h3>User Comments</h3><hr>";

      for (let i = 0; i < comments.length; i++) {
        div.innerHTML +=
          "<div>" +
          "<p><b>User Name:</b> " +
          comments[i].name +
          " | <b>Comment ID:</b> " +
          comments[i].id +
          " | <b>Post ID:</b> " +
          comments[i].post_id +
          " | <b>Time:</b> " +
          comments[i].created_at +
          "<p>" +
          comments[i].comment +
          "</p>" +
          "</div>";
        div.innerHTML +=
          '<button onclick="editComment(' +
          comments[i].id +
          ", '" +
          comments[i].comment +
          "', " +
          comments[i].post_id +
          ')">Edit</button>';
        div.innerHTML +=
          '<button onclick="deleteComment(' +
          comments[i].id +
          ", " +
          comments[i].post_id +
          ')">Delete</button>';
      }
    }
  };
  xhttp.send("type=loadUserComments&user_id=" + user_id);
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

  xhttp.open("POST", "../controller/userActivityController.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let response = JSON.parse(this.responseText);

      if (response.status) {
        loadUserPosts();
        document.getElementById("postMsg").innerHTML = response.message;
      } else {
        document.getElementById("postMsg").innerHTML = response.message;
      }
    }
  };

  xhttp.send(
    "type=editPost&id=" + id + "&title=" + title + "&content=" + content,
  );
}

function deletePost(id) {
  let confirmDelete = confirm("Delete this post?");

  if (!confirmDelete) {
    return;
  }

  let xhttp = new XMLHttpRequest();

  xhttp.open("POST", "../controller/userActivityController.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let response = JSON.parse(this.responseText);
      if (response.status) {
        loadUserPosts();
        document.getElementById("postMsg").innerHTML = response.message;
      } else {
        document.getElementById("postMsg").innerHTML = response.message;
      }
    }
  };

  xhttp.send("type=deletePost&id=" + id);
}

function editComment(id, oldComment, post_id) {
  let newComment = prompt("Enter new comment:", oldComment);

  if (newComment == null) {
    return;
  }

  let comment = {
    id: id,
    comment: newComment,
    post_id: post_id,
  };

  let data = JSON.stringify(comment);

  let xhttp = new XMLHttpRequest();

  xhttp.open("POST", "../controller/userActivityController.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let response = JSON.parse(this.responseText);

      if (response.status) {
        loadUserComments();
        document.getElementById("commentMsg").innerHTML = response.message;
      } else {
        document.getElementById("commentMsg").innerHTML = response.message;
      }
    }
  };

  xhttp.send("type=editComment&comment=" + encodeURIComponent(data));
}

function deleteComment(id, post_id) {
  let confirmDelete = confirm("Delete this comment?");

  if (!confirmDelete) {
    return;
  }
  let xhttp = new XMLHttpRequest();

  xhttp.open("POST", "../controller/userActivityController.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let response = JSON.parse(this.responseText);
      if (response.status) {
        loadUserComments();
        document.getElementById("commentMsg").innerHTML = response.message;
      } else {
        document.getElementById("commentMsg").innerHTML = response.message;
      }
    }
  };
  xhttp.send("type=deleteComment&id=" + id);
}

window.onload = function () {
  loadUserPosts();
  loadUserComments();
};
