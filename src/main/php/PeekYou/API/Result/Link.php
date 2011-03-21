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
class PeekYou_API_Result_Link
{
    const LINK_PERSONAL = 1;
    const LINK_BUSINESS = 2;
    const LINK_SOCIAL = 3;
    const LINK_PRESS = 4;
    const LINK_PICTURES = 5;
    const LINK_MISC = 6;
    const LINK_FEEDS = 7;
    const LINK_ALBUMS_OR_VIDEOS = 8;

    const LINK = 'link';
    const TYPE = 'type';

    private $_data;

    /**
     * Creates a new user link.
     *
     * @param array $data The link data.
     */
    public function __construct(array $data)
    {
        $this->_data = $data;
    }

    /**
     * Returns the link's type.
     *
     * @return int
     */
    public function getType()
    {
        return $this->_data[self::TYPE];
    }

    /**
     * Returns the link itself.
     *
     * @return string
     */
    public function getLink()
    {
        return $this->_data[self::LINK];
    }

}