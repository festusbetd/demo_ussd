<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class UssdController extends Controller
{
    public function onlineUssdMenu(Request $request)
    {
       $sessionId   = $request->get('sessionId');
       $serviceCode = $request->get('serviceCode');
       $phoneNumber = $request->get('phoneNumber');
       $text        = $request->get('text');
        // use explode to split the string text response from Africa's talking gateway into an array.
        $ussd_string_exploded = explode("*", $text);
        // Get ussd menu level number from the gateway
        $level = count($ussd_string_exploded);
        if ($text == "") {
            // first response when a user dials our ussd code
            $response  = "CON Welcome to MumTribe \n";
            $response .= "1. Register \n";
            $response .= "2. Login \n";
            $response .= "3. About MumTribe";
        }
        elseif ($text == "1") {
            // when use response with option django
            $response = "CON Please enter your first name";
        }
        elseif ($ussd_string_exploded[0] == 1 && $ussd_string_exploded[1] == 1 && $level == 3) {
            $response = "CON Please enter your last name";
        }
        elseif ($ussd_string_exploded[0] == 1 && $ussd_string_exploded[1] == 1 && $level == 4) {
            $response = "CON Please enter your email";
        }
        elseif ($ussd_string_exploded[0] == 1 && $ussd_string_exploded[1] == 1 && $level == 5) {
            // save data in the database
            $response = "END Your data has been captured successfully! Thank you for registering at MumTribe.";
        }
        elseif ($text == "2") {
         
            $response = " CON Kindly input your pin";
               }
        elseif ($text == "3") {
            // Our response a user respond with input 2 from our first level
            $response = "END Our innovation is designed around , helping mums, dads and their loved ones prepare for and welcome their little angels in the best ways possible and never alone!​.";
        }
      
        // send your response back to the API
        header('Content-type: text/plain');
        echo $response;
    }
}