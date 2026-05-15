<h1>Food Experience</h1>

<h3>Create Post</h3>

<input type="text" id="title" placeholder="Title"><br><br>
<textarea id="content" placeholder="Write experience"></textarea><br><br>
<input type="button" onclick="addPost()" value="Post">

<p id="msg"></p>

<hr>

<div id="postDiv"></div>
<script>
    let role = <?php echo json_encode($_SESSION['user']['role'] ?? 'guest'); ?>;
    let user_id = <?php echo json_encode($_SESSION['user']['id'] ?? 0); ?>;
</script>

<script src="../asset/post.js"></script>