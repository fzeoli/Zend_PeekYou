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
 * A result work.
 */
class PeekYou_API_Result_Work
{

    const CATEGORY = 'category';
    const WORK = 'work';

    private $_data;

    /**
     * Creates a new user work.
     *
     * @param array $data The work data.
     */
    public function __construct(array $data)
    {
        $this->_data = $data;
    }

    /**
     * Returns the work category.
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->_data[self::CATEGORY];
    }

    /**
     * Returns the work itself.
     *
     * @return string
     */
    public function getWork()
    {
        return $this->_data[self::WORK];
    }

}