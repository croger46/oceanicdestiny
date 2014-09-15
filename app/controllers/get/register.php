<?php

// recaptcha
$data['recaptcha'] = recaptcha_get_html('6LfgtPkSAAAAADDDOsXG2mFZA5b4Az0k-u5nft34');
$data["register"] = true;

echo $m->render('public/register',$data);

?>