<?php
// database connection: username, password, database name
  $conn = new mysqli("localhost", "wetinde3_uedu", "olisrab@25", "wetinde3_olisrab");
  if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
  }
?>