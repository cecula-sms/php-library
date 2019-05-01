<?php
/**
 * Cecula
 * This library is manages all request to sending bulk A2P and P2P Message
 * 
 * @category  SMS
 * @package   Cecula_SMS
 * @author    Godwin Noah <godwin.noah@cecula.com>
 * @copyright 2019 Cecula Ltd.
 * @license   MIT https://cecula.com/license
 * @link      https://cecula.com
 */

 class Cecula{
    private $_host = 'https://api.cecula.com';

    // The API KEY Generated at the Cecula Developer Platform
    private $_apiKey = null;

    // Replace the <api key> string with API Key generated on the cecula developer platform.
    private $_header = [];

    /**
     * Constructor
     */
    public function __construct($apiKey)
    {
        $this->_apiKey = $apiKey;

        $this->_header = [
            "Authorization: Bearer {$this->_apiKey}",
            "Content-Type: application/json",
            "cache-control: no-cache"
        ];
    }

    /**
     * Send A2P SMS
     * This method is used for sending A2P SMS Message
     *
     * @param array $payload An array containing parameters of message to be sent
     * 
     * @return object
     */
    public function sendA2PSMS(Array $payload)
    {
        return $this->_makePostRequest('send/a2p', $payload);
    }

    /**
     * Send P2P SMS
     * This method is used to send P2P message using number managed on Cecula Sync Cloud
     * or Cecula Sync App
     *
     * @param array $payload Message Parameters: originator, message, recipients
     * 
     * @return object
     */
    public function sendP2PSMS(Array $payload)
    {
        return $this->_makePostRequest('send/p2p', $payload);
    }

    /**
     * Get A2P SMS Balance
     * This method is used to check A2P SMS Balance
     *
     * @return object
     */
    public function getA2PBalance()
    {
        return $this->_makeGetRequest('account/a2pbalance');
    }

    /**
     * Get Sync Cloud Balance
     * This method checks the balance on a number used on Cecula Sync Cloud
     * 
     * @param array $payload Sync Cloud identity to check balance on
     * 
     * @return object
     */
    public function getSyncCloudBalance(Array $payload)
    {
        return $this->_makeGetRequest(sprintf('account/scbalance?identity=%s', $payload['identity']));
    }

    /**
     * Make POST Request.
     * This is a private method that handles all http POST connection to Vereafy.
     *
     * @param string $endpoint The endpoint where request should be submitted to.
     * @param array  $payload  An array of data that will be submitted to Vereafy.
     * 
     * @return object
     */
    private function _makePostRequest($endpoint, $payload)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->_host.'/'.$endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->_header);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        $response = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        return $error ? $error : json_decode($response);
    }

    /**
     * Make GET Request
     * This is a private method that will handles all HTTP GET Request to Vereafy.
     *
     * @param string $endpoint The URL where request will be sent.
     * 
     * @return object
     */
    private function _makeGetRequest($endpoint)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->_host.'/'.$endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->_header);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        $response = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        return $error ? $error : json_decode($response);
    }
}