<?php global $current_user;
      get_currentuserinfo();
 
      echo 'Username: ' . $current_user->user_login . "
";
      echo 'User email: ' . $current_user->user_email . "
";
      echo 'User first name: ' . $current_user->user_firstname . "
";
      echo 'User last name: ' . $current_user->user_lastname . "
";
      echo 'User display name: ' . $current_user->display_name . "
";
      echo 'User ID: ' . $current_user->ID . "
";
?>