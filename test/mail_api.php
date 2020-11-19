<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Headers: Content-Type');
$rest_json = file_get_contents("php://input");
$_POST = json_decode($rest_json, true);

$Query_String  = explode("&", explode("?", $_SERVER['HTTP_REFERER'])[1] );


if ( ! empty( $_POST['fname'] ) && ! empty( $_POST['lastname'] ) && 
     ! empty( $_POST['phonenumer'] ) && ! empty( $_POST['email'] ) && 
     ! empty( $_POST['street'] ) && ! empty( $_POST['homenum'] ) && ! empty( $_POST['city'] )){

    // set response code - 200 OK

	http_response_code(200);
	$subject = $_POST['fname'];
	$to = "tshulgin89@gmail.com";
	$from = $_POST['email'];

	// data

    $msg = "
    <table>
    <tr>
    <td>שם פרטי:</td>
    <td>". $_POST['fname'] ."</td>
    </tr>
    <tr>
    <td>שם משפחה:</td>
    <td>". $_POST['lastname'] ."</td>
    </tr>
    <tr>
    <td>טלפון:</td>
    <td>". $_POST['phonenumer'] ."</td>
    </tr>
    <tr>
    <td>אימייל:</td>
    <td>". $_POST['email'] ."</td>
    </tr>
    <tr>
    <td>רחוב:</td>
    <td>". $_POST['street'] ."</td>
    </tr>
    <tr>
    <td>מספר ביתr:</td>
    <td>". $_POST['homenum'] ."</td>
    </tr>
    <tr>
    <td>עיר:</td>
    <td>". $_POST['city'] ."</td>
    </tr>";

    if( isset( $_POST['postalcode'] ) && ! empty( $_POST['postalcode'] ) ){
        $msg.= "<tr><td>מיקוד:</td>". $_POST['postalcode'] ."<td></td></tr>";
    }

    if( ! empty( $Query_String ) ){
        foreach( $Query_String as $param ){
            $msg .= "<tr><td>".$param."</td></tr>";
        }
    }

    $msg .= "</table>";     

	// Headers

	$headers = "MIME-Version: 1.0\r\n";
	$headers.= "Content-type: text/html; charset=UTF-8\r\n";
	$headers.= "From: <" . $from . ">";
	mail($to, $subject, $msg, $headers);

	// echo json_encode( $_POST );

	echo json_encode(array(
        "sent" => true,
        "message" => 'great JOB!'
	));

   }else{
    echo json_encode(["sent" => false, "error" => "ERROR"]);
    // tell the user about error
    // echo json_encode(["sent" => true, "message" => "worked!"]);
}
    