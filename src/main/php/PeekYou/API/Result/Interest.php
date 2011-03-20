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
 * A result object representation.
 */
class PeekYou_API_Result_Interest
{
    const CATEGORY = 'category';
    const INTEREST = 'interest';

    private $_data;

    /**
     * Creates a new interest object.
     *
     * @param array $data The interest data.
     */
    public function __construct(array $data)
    {
        $this->_data = $data;
    }

    /**
     * Returns the interest's category.
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->_data[self::CATEGORY];
    }

    /**
     * Returns the interest itself.
     *
     * @return string
     */
    public function getInterest()
    {
        return $this->_data[self::INTEREST];
    }

}