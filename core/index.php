<?php
//include require files
require '../require/modules.php';

//get update commands and files
require 'update-query.php';

//end of update commands
//response after update activity
$access_url = DOMAIN;

//response code
if ($UpdateQueryResponse == true) {
 echo "<code>
 <b>>></b> Update Query is running...<br>
 <b>>></b> Checking Query Status...<br>
<br>
 <b>Response:</b> Update Query is completed successfully!</code>
 <br><br>
 <a href='" . DOMAIN . "'>Back to Home</a>
 ";
} else {
 echo "<code>
<b>>></b> Update Query is running...<br>
<b>>></b> Checking Query Status...<br>
<br>
 <b>Response:</b> Update Query Failed!
 <br>
 </code><br>
 <a href=''>Try Again</a>";
}
