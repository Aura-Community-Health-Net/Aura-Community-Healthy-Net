<?php

namespace app\core;

use SendinBlue\Client\Api\TransactionalEmailsApi;
use SendinBlue\Client\ApiException;
use SendinBlue\Client\Configuration;
use SendinBlue\Client\Model\SendSmtpEmail;
use SendinBlue\Client\Model\SendSmtpEmailSender;
use SendinBlue\Client\Model\SendSmtpEmailTo;
use GuzzleHttp\Client;


class EmailSender
{
    private static EmailSender $instance;
    private static TransactionalEmailsApi $api;

    final private function __construct()
    {
        var_dump($_ENV["SENDINBLUE_KEY"]);
        //constructing the configuration for sendinblue api
        $config = Configuration::getDefaultConfiguration()->setApiKey(
                "api-key",
                $_ENV['SENDINBLUE_KEY']
        );

        //creating an instance of email api
        self::$api = new TransactionalEmailsApi(
            client: new Client(),       //setting the http client as Guzzle http
            config: $config
        );
    }


    /**
     * @throws ApiException
     */
    private function _sendEmail($receiverEmail, $receiverName = "", $subject = "", $htmlContent = "", $senderEmail = "auracommunityhealthnet@gmail.com
", $params = [], $templateId = 2): void
    {
        $sendEmailObject = new SendSmtpEmail();   //create email object and set the subject of email
        $sendEmailObject->setSubject($subject);
        if ($htmlContent !== "") {
            $sendEmailObject->setHtmlContent($htmlContent);
        }
        $sendEmailObject->setSender(new SendSmtpEmailSender(["email" => $senderEmail, "name" => "Aura Community Health Net"]));
        $sendEmailObject->setTo([new SendSmtpEmailTo(["email" => $receiverEmail, "name" => $receiverName])]);
        $sendEmailObject->setParams($params);
//        set template id
        $sendEmailObject->setTemplateId(templateId: $templateId);

        self::$api->sendTransacEmail($sendEmailObject);

    }

    private static function getInstance(): EmailSender
    {
        if (!isset(self::$instance)) {
            self::$instance = new EmailSender();
        }
        return self::$instance;
    }


    /**
     * @throws ApiException
     */
    public static function sendEmail($receiverEmail, $receiverName = "", $subject = "", $htmlContent = "", $senderEmail = "auracommunityhealthnet@gmail.com", $params = [], $templateId = 2): void
    {
        self::getInstance()->_sendEmail($receiverEmail, $receiverName, $subject, $htmlContent, $senderEmail, $params, $templateId);
    }
}