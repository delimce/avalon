<?php


class Email
{

    //clase para el tratamiento de envío de emails

    private $fromEmail;
    private $fromName;
    private $toEmail;
    private $toName;
    private $subject;
    private $htmlMessage;
    private $textmessage;
    private $mandrillCode = '8O4CkeraFHcYJhPFKD0YuA';
    
    public function __construct($mensajehtml, $mensajetexto, $asunto, $nombreremitente,
                          $emailremitente, $nombredestinatario, $emaildestinatario)
    {
        $this->setHtmlMessage($mensajehtml);
        $this->setTextmessage($mensajetexto);
        $this->setSubject($asunto);
        $this->setFromName($nombreremitente);
        $this->setFromEmail($emailremitente);
        $this->setToName($nombredestinatario);
        $this->setToEmail($emaildestinatario);

    }

    /**
     * @return mixed
     */
    public function getHtmlMessage()
    {
        return $this->htmlMessage;
    }

    /**
     * @param mixed $htmlMessage
     */
    public function setHtmlMessage($htmlMessage)
    {
        $this->htmlMessage = $htmlMessage;
    }

    /**
     * @return mixed
     */
    public function getTextmessage()
    {
        return $this->textmessage;
    }

    /**
     * @param mixed $textmessage
     */
    public function setTextmessage($textmessage)
    {
        $this->textmessage = $textmessage;
    }

    /**
     * @return mixed
     */
    public function getFromEmail()
    {
        return $this->fromEmail;
    }

    /**
     * @param mixed $fromEmail
     */
    public function setFromEmail($fromEmail)
    {
        $this->fromEmail = $fromEmail;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return mixed
     */
    public function getFromName()
    {
        return $this->fromName;
    }

    /**
     * @param mixed $fromName
     */
    public function setFromName($fromName)
    {
        $this->fromName = $fromName;
    }

    /**
     * @return mixed
     */
    public function getToEmail()
    {
        return $this->toEmail;
    }

    /**
     * @param mixed $toEmail
     */
    public function setToEmail($toEmail)
    {
        $this->toEmail = $toEmail;
    }

    /**
     * @return mixed
     */
    public function getToName()
    {
        return $this->toName;
    }

    /**
     * @param mixed $toName
     */
    public function setToName($toName)
    {
        $this->toName = $toName;
    }


    public function send()
    {

        ////enviando correo con mandrill
        require_once(__DIR__ . "/mandrill/src/Mandrill.php");

        try {

            //Aquí se debe colocar la API generada en MandrillApp
            $mandrill = new Mandrill($this->mandrillCode);
            $message = array(
                'html' => $this->getHtmlMessage(),
                'text' => $this->getTextmessage(),
                'subject' => $this->getSubject(),
                'from_email' => $this->getFromEmail(),
                'from_name' => $this->getFromName(),
                'to' => array(
                    array(
                        'email' => $this->getToEmail(),
                        'name' => $this->getToName(),
                        'type' => 'to'
                    )
                ),
                'headers' => array('Reply-To' => $this->getFromEmail()),
                'important' => false,
                'track_opens' => null,
                'track_clicks' => null,
                'auto_text' => null,
                'auto_html' => null,
                'inline_css' => null,
                'url_strip_qs' => null,
                'preserve_recipients' => null,
                'view_content_link' => null,
                'bcc_address' => null,
                'tracking_domain' => null,
                'signing_domain' => null,
                'return_path_domain' => null,
                'merge' => true,
                'merge_language' => 'mailchimp',
                'global_merge_vars' => array(
                    array(
                        'name' => 'merge1',
                        'content' => 'merge1 content'
                    )
                ),
                'merge_vars' => array(
                    array(
                        'rcpt' => 'recipient.email@example.com',
                        'vars' => array(
                            array(
                                'name' => 'merge2',
                                'content' => 'merge2 content'
                            )
                        )
                    )
                )
            );
            $async = false;
            $ip_pool = 'Main Pool';
            $send_at = 'example send_at';
            $result = $mandrill->messages->send($message, $async);

        } catch (Mandrill_Error $e) {
            // Mandrill errors are thrown as exceptions
            echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
            // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
            throw $e;
        }

        return $result[0][status];

    }


}

?>