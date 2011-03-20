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
 * A result username.
 */
class PeekYou_API_Result_Username
{

    const USERNAME = 'username';
    const SOURCE = 'source';

    private $_data;

    /**
     * Creates a new result username.
     *
     * @param array $data The username data.
     */
    public function __construct(array $data)
    {
        $this->_data = $data;
    }

    /**
     * Returns the username source.
     *
     * @return string
     */
    public function getSource()
    {
        return $this->_data[self::SOURCE];
    }

    /**
     * Returns the username value.
     *
     * @return string
     */
    public function getValue()
    {
        return $this->_data[self::USERNAME];
    }

}