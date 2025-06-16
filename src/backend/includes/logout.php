<?php
  session_start();
  $_SESSION = [];
  session_unset();
  session_destroy();

  echo "
    <script>
      location.href=('/src/pages/login.php')
    </script>
  ";
