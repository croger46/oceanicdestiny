<?php

// post/register.php
// register a new user

// reCaptcha checking
$resp = recaptcha_check_answer ('6LfgtPkSAAAAAN1geOO_i9zhn03xxlenfLGY7uKM',
                              $_SERVER["REMOTE_ADDR"],
                              $_POST["recaptcha_challenge_field"],
                              $_POST["recaptcha_response_field"]);
// check the response
if (!$resp->is_valid) {

  // recatpcha NOT passed
  $data['messageStyle'] = 'danger';
  $data['messageTitle'] = 'ERROR: Anti-Spambot Test Failed';
  $data['message'] = 'The incorrect answer was provided to the anti-spambot test.';

} else {
  $errorMsg = null;

  if($user->create($_POST, $errorMsg)) {
    // recatpcha NOT passed
    $data['messageStyle'] = 'success';
    $data['messageTitle'] = 'SUCCESS: Your account was made!';
    $data['message'] = 'Great, '.$_POST['gamerid'].'! You now have an account with Oceanic Destiny and can login right away!';
  } else {
    $data['messageStyle'] = 'danger';
    $data['messageTitle'] = 'ERROR: Something went wrong!';
    $data['message'] = 'We couldn\'t create your account for you, please try again! ' . $errorMsg;
  }

}