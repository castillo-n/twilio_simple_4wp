<?php
/**
 * Created by PhpStorm.
 * User: nelson_castillo
 * Date: 1/3/17
 * Time: 17:29
 */

namespace Pbc\PBC_Twilio;
require_once dirname(dirname(dirname(dirname(dirname(__DIR__))))) .'/vendor/autoload.php';
/**
 * Class GetMail
 * @package Pbc\Mail
 */
class PBC_Twilio
{

    /**
     * @var string
     */
    private $client = '';
    /**
     * @return string
     */
    private function getClient()
    {

        return $this->client;
    }
    /**
     * @param string
     */
    private function setClient()
    {

        $this->client = new Twilio\Rest\Client($this->getSID(), $this->getToken());
    }
    /**
     * @var string
     */
    private $sid = '';
    /**
     * @return string
     */
    private function getSID()
    {
        return $this->sid;
    }
    /**
     * @param string $SID
     */
    public function setSID($SID)
    {
        return $this->sid = $SID;
    }
    /**
     * @var string
     */
    private $token = '';
    /**
     * @return string
     */
    private function getToken()
    {
        return $this->token;
    }
    /**
     * @param string $token
     */
    public function setToken($token)
    {
        return $this->token = $token;
    }
    /**
     * @var string
     */
    private $from_number = '';
    /**
     * @return string
     */
    private function getFromNumber()
    {
        return $this->from_number;
    }
    /**
     * @param string $from_number
     */
    public function setFromNumber($from_number)
    {
        return $this->from_number = $from_number;
    }

    /**
     * @construct
     */
    function __construct() {

        $this->dotenv = new \Dotenv\Dotenv(dirname(__DIR__));
        $this->dotenv->load();

        $this->sid = getenv('TWILIO_SID');
        $this->token = getenv('TWILIO_TOKEN');
        $this->from_number = getenv('TWILIO_NUMBER');

        $this->client = new Twilio\Rest\Client($this->getSID(), $this->getToken());
    }
    /**
     * @string $to_number ;
     * @string $message ;
     *  $to_number = "218 766 ..."; // Your Auth Token from www.twilio.com/console
     *  $message = "Hi, this is working!"; // Your Auth Token from www.twilio.com/console
     */
    function sendASms($to_number, $message)
    {
        $message = $this->client->messages->create(
            $to_number, // Text this number
            array(
                'from' => $this->getFromNumber(), // From a valid Twilio number
                'body' => $message
            )
        );
        return $message->sid;
    }

    /**
     * @string $to_number ;
     * @string $message ;
     *  $to_number = "218 766 ..."; // Your Auth Token from www.twilio.com/console
     *  $message = "Hi, this is working!"; // Your Auth Token from www.twilio.com/console
     */
    function sendMultipleSms($to_number, $message)
    {
        $message = $this->client->messages->create(
            $to_number, // Text this number
            array(
                'from' => $this->getFromNumber(), // From a valid Twilio number
                'body' => $message
            )
        );
        return $message->sid;
    }

    /**
     * @string $to_number ;
     *  $to_number = "218 766 ..."; // Your Auth Token from www.twilio.com/console
     */
    function call($to_number)
    {
        $message = $this->client->calls->create(
            $to_number, // Call this number
            $this->getFromNumber(),// From a valid Twilio number
            array(
                'url' => 'http://twimlets.com/holdmusic?Bucket=com.twilio.music.ambient'
            )
        );
    }

    /**
     * @var $message
     * @return $response
     *  $message = "Hi, this is working!"; // Your Auth Token from www.twilio.com/console
     */
    function TwiML($message)
    {
        $response = new Twilio\Twiml();
        $response->say($message);
        $response->play('https://api.twilio.com/cowbell.mp3', array("loop" => 5));
        return $response;
    }
}