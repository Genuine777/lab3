<?php
// Backend part: handles the AJAX POST request and stops.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userid = $_POST['userid'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($userid === "admin" && $password === "admin123") {
        echo "success";
    } else {
        echo "fail";
    }
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Login (AJAX)</title>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>

<div id="loginBox">
  <form id="loginForm">
    Userid: <input type="text" id="userid"><br>
    Password: <input type="password" id="password"><br>
    <button type="submit">Login</button>
  </form>
</div>
<p id="message"></p>

<script>
$("#loginForm").submit(function (e) {
  e.preventDefault();
  $.ajax({
    url: "q10_login_ajax.php",
    method: "POST",
    data: {
      userid: $("#userid").val(),
      password: $("#password").val()
    },
    success: function (response) {
      if (response.trim() === "success") {
        $("#loginBox").hide();
        $("#message").text("Welcome!");
      } else {
        $("#message").text("Invalid credentials, try again.");
      }
    }
  });
});
</script>
</body>
</html>
