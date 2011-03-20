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
 * A result location.
 */
class PeekYou_API_Result_Location
{

    const COUNTRY = 'country';
    const REGION = 'region';
    const CITY = 'city';

    private $_data;

    /**
     * Creates a new location object.
     *
     * @param array $data The location data.
     */
    public function __construct(array $data)
    {
        $this->_data = $data;
    }

    /**
     * Helper to retrieve info from the data array.
     *
     * Null is returned when the key doesn't even exists.
     *
     * @param string $key The array key.
     */
    private function _get($key) {
        return isset($this->_data[$key]) ? $this->_data[$key] : null;
    }

    /**
     * Returns the location's country.
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->_get(self::COUNTRY);
    }

    /**
     * Returns the location's region.
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->_get(self::REGION);
    }

    /**
     * Returns the location's city.
     *
     * @return string
     */
    public function getCity()
    {
        return $this->_get(self::CITY);
    }

}