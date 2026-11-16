<?php
/*
  Run this SQL once before using the page:

  CREATE DATABASE IF NOT EXISTS testdb;
  USE testdb;
  CREATE TABLE IF NOT EXISTS users (
      id INT AUTO_INCREMENT PRIMARY KEY,
      username VARCHAR(50) NOT NULL UNIQUE
  );
  INSERT INTO users (username) VALUES ('admin'), ('john'), ('jane');
*/

// Backend part: answers the AJAX request and stops.
if (isset($_GET['username'])) {
    $conn = new mysqli("localhost", "root", "", "testdb");

    $username = $_GET['username'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Username not available";
    } else {
        echo "Username available";
    }
    exit;
}
?>
<!DOCTYPE html>
<html>
<body>

Username: <input type="text" id="username" onkeyup="checkUsername()">
<p id="result"></p>

<script>
function checkUsername() {
  var username = document.getElementById("username").value;
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      document.getElementById("result").innerText = xhr.responseText;
    }
  };
  xhr.open("GET", "q13_username_check.php?username=" + encodeURIComponent(username), true);
  xhr.send();
}
</script>
</body>
</html>
