<?php

//SMS GATEWAYS FOR sending sms or msg
function SMS($MSG, $PHONE)
{
   global $SMS_KEY;

   //sms status
   if (CONTROL_SMS == true) {
      $curl = curl_init();
      curl_setopt_array($curl, array(
         CURLOPT_URL => "https://www.fast2sms.com/dev/bulk?authorization=" . SMS_API_KEY . "&sender_id=&message=" . urlencode("
$MSG") . "&language=english&route=p&numbers=" . urlencode("$PHONE"),
         CURLOPT_RETURNTRANSFER => true,
         CURLOPT_ENCODING => "",
         CURLOPT_MAXREDIRS => 10,
         CURLOPT_TIMEOUT => 30,
         CURLOPT_SSL_VERIFYHOST => 0,
         CURLOPT_SSL_VERIFYPEER => 0,
         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
         CURLOPT_CUSTOMREQUEST => "GET",
         CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache"
         ),
      ));
      $response = curl_exec($curl);
      $err = curl_error($curl);
      curl_close($curl);

      //sms are not enabled
   } else {
      if (CONTROL_SMS_ALERT == true) {
         echo "SMS Sending are not Enabled in <b>config.php</b>";
      } else {
      }
   }
}
