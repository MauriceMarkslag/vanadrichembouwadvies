<?php
    // declare PHP variables of the form input
    $assignmentchoice = $_POST['assignmentchoice'];
    $projectchoice = $_POST['projectchoice'];
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $address = $_POST['address'];
    $zipcode = $_POST['zipcode'];
    $visitor_message = $_POST['visitor_message'];
    $email_body = "<html><body><div>";

    // Formats the form input in $email_body
    if(isset($_POST['assignmentchoice'])) {
        $visitor_name = filter_var($_POST['assignmentchoice'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>Opdracht:</b></label>&nbsp;<span>".$assignmentchoice."</span>
                        </div>";
    }

    if(isset($_POST['projectchoice'])) {
        $visitor_name = filter_var($_POST['projectchoice'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>Project:</b></label>&nbsp;<span>".$projectchoice."</span>
                        </div>";
    }

    if(isset($_POST['name'])) {
        $visitor_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>Naam:</b></label>&nbsp;<span>".$name."</span>
                        </div>";
    }

    if(isset($_POST['lastname'])) {
        $visitor_name = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>Achternaam:</b></label>&nbsp;<span>".$lastname."</span>
                        </div>";
    }
    
    if(isset($_POST['email'])) {
        $visitor_email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['email']);
        $visitor_email = filter_var($email, FILTER_VALIDATE_EMAIL);
        $email_body .= "<div>
                           <label><b>Email:</b></label>&nbsp;<span>".$visitor_email."</span>
                        </div>";
    }

    if(isset($_POST['phonenumber'])) {
        $visitor_name = filter_var($_POST['phonenumber'], FILTER_SANITIZE_NUMBER_INT);
        $email_body .= "<div>
                           <label><b>Telefoonnummer:</b></label>&nbsp;<span>".$phonenumber."</span>
                        </div>";
    }
      
    if(isset($_POST['address'])) {
        $visitor_name = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>Adres:</b></label>&nbsp;<span>".$address."</span>
                        </div>";
    }
      
    if(isset($_POST['zipcode'])) {
        $visitor_name = filter_var($_POST['zipcode'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>Postcode:</b></label>&nbsp;<span>".$zipcode."</span>
                        </div>";
    }

    if(isset($_POST['visitor_message'])) {
        $visitor_message = htmlspecialchars($_POST['visitor_message']);
        $email_body .= "<div>
                           <label><b>Bericht:</b></label>
                           <div>".$visitor_message."</div>
                        </div>";
    }

    function isValid() {
        try {

            $url = 'https://www.google.com/recaptcha/api/siteverify';
            $data = ['secret'   => 'SECRET_KEY',
                    'response' => $_POST['g-recaptcha-response']];
                    
            $options = [
                'http' => [
                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method'  => 'POST',
                    'content' => http_build_query($data) 
                ]
            ];
    
            $context  = stream_context_create($options);
            $result = file_get_contents($url, false, $context);
            return json_decode($result)->success;
        }
            catch (Exception $e) {
                return null;
            }
        }

    $email_body .= "</div></body></html>";

    // Adds the e-mail headers
    $from = "no-reply@vanadrichembouwadvies.nl";
    $to = "info@vanadrichembouwadvies.nl";
    $subject = "U heeft een nieuw bericht!";
    $message = $email_body;

    $additional_headers = "From:" . $from . "\r\n";
    $additional_headers .= 'MIME-Version: 1.0' . "\r\n";
    $additional_headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    mail($to, $subject, $message, $additional_headers);
?>
