<?php defined('BASEPATH') OR exit('No direct script access allowed');


class SendRegistrationMail {

        
        public function __construct()
        {

                 $this->load->library('email');
        }

        /* 
        * Using CI global variable without extra variable
        * 
        */
        public function __get($var)
        {
                return get_instance()->$var;
        }

         public function send($to, $data){
          
            $subject = 'Pendaftaran - Permata Network';

            // Get full html:
            $body =
            "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
            <html xmlns='http://www.w3.org/1999/xhtml'>
            <head>
                <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
                <title>".htmlspecialchars($subject, ENT_QUOTES, $this->email->charset)."</title>
                <style type='text/css'>
                    body {
                        font-family: Arial, Verdana, Helvetica, sans-serif;
                        font-size: 16px;
                    }
                </style>
            </head>
            <body>
            <h2>Permata Network</h2>
            <h4>Anda telah berhasil bergabung bersama Permata Network</h4><br>
            <p>
            berikut ini adalah data akun anda : <br>
            Username : $username <br>
            Password : $password <br>
            <br>
            harap di ingat dan di catat dengan baik, informasi lebih lanjut hubungi admin kami</p>
            <br>
            <hr>
            <br>
            <a href='permatanetwork.com'>Permata Network</a>
            </body>
            </html>";
            // Also, for getting full html you may use the following internal method:
            //$body = $this->email->full_html($subject, $message);

            $result = $this->email
                ->from('noreply@permatanetwork.com')   
                ->to( $to)
                ->subject($subject)
                ->message($body);
            
            
            $result = $result->send();    
            
            return true;
            
            exit;
        }

}