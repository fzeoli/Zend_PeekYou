<?php
/**
 * PeekYou API
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://github.com/canddi/Zend_RabbitMQ/blob/master/LICENSE.txt
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to hello@canddi.com so we can send you a copy immediately.
 *
 */

/**
 * PeekYou API implementation.
 */
class PeekYou_API
{

    const API_URL_FORMAT =
        'http://www.peekyou.com/api/api.php?key=%s&url=%s&output=json';

    const STATUS = 'status';
    const RESULT = 'result';
    const RESULTS = 'results';
    const TOTAL_FOUND = 'total_found';

    const STATUS_NOT_FOUND = 0;
    const STATUS_STILL_RUNNING = 1;
    const STATUS_OK = 2;
    const STATUS_OPTED_OUT = -3;
    const STATUS_NOT_RUN_SUCCESSFULLY = -5;

    const TRY_AGAIN_MESSAGE =
        'PeekYou\'s API either did not run successfully or it\'s still running';

    private $_apiKey;

    /**
     * Creates a new PeekYou API instance.
     *
     * @param string $apiKey The PeekYou API key to use.
     * @param Zend_Http_Client $client OPTIONAL. Http client to use.
     *                                           Meant for testing.
     */
    public function __construct($apiKey, Zend_Http_Client $client = null)
    {
        if (empty($apiKey)) {
            throw new PeekYou_API_Exception('The API key can\'t be null');
        }

        $this->_apiKey = $apiKey;
        $this->_client = $client ? $client : new Zend_Http_Client();
    }

    /**
     * Searchs the given url for information.
     *
     * @param string $url A public url.
     * @return PeekYou_API_Result|array The result object or an array of result
     * 									objects if more than one were found.
     */
    public function search($url)
    {
        $this->_client->setUri(
            sprintf(self::API_URL_FORMAT, $this->_apiKey, urlencode($url))
        );

        $res = Zend_Json::decode($this->_client->request()->getBody());
        return $res;
        $res = $res[self::RESULTS];

        if ($res[self::STATUS] != self::STATUS_OK) {

            switch ($res[self::STATUS]) {
                case self::STATUS_OPTED_OUT:
                case self::STATUS_NOT_FOUND:
                    return null;

                case self::STATUS_STILL_RUNNING:
                case self::STATUS_NOT_RUN_SUCCESSFULLY:
                    throw new PeekYou_API_Exception(self::TRY_AGAIN_MESSAGE);

            }
        }

        $ret = null;

        if ($res[self::TOTAL_FOUND] > 1) {
            $ret = array();

            foreach ($res[self::RESULT] as $result) {
                $ret[] = new PeekYou_API_Result($result);
            }
        } else {
            $ret = new PeekYou_API_Result($res[self::RESULT]);
        }

        return $ret;
    }
}