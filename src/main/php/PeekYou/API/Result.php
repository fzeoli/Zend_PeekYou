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
class PeekYou_API_Result
{

    const PROFILE_ID = 'profile_id';
    const FIRST_NAME = 'first_name';
    const LAST_NAME = 'last_name';
    const SEX = 'sex';
    const AGE_RANGE = 'age_range';
    const LOCATIONS = 'locations';
    const ESTIMATED_INCOME = 'estimated_income';
    const IS_PRIMARY = 'is_primary';
    const USERNAMES = 'usernames';
    const WORK = 'work';
    const BIO = 'bio';
    const LINKS = 'links';
    const TYPE = 'type';
    const TWITTER_FOLLOWER_COUNT = 'twitter_follower_count';
    const COUNT = 'count';
    const TWITTER_FOLLOWING_COUNT = 'twitter_following_count';
    const THUMBNAIL = 'thumbnail';
    const ZODIAC = 'zodiac';
    const ZIPCODE = 'zipcode';
    const SCHOOLS = 'schools';
    const INTERESTS = 'interests';

    /**
     * Creates a new PeekYou result.
     *
     * @param array $data The result's data.
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
     * Returns the result's thumbnail.
     *
     * @return string
     */
    public function getThumbnail()
    {
        return $this->_get(self::THUMBNAIL);
    }

    /**
     * Returns the user's zodiac sign.
     *
     * @return string
     */
    public function getZodiac()
    {
        return $this->_get(self::ZODIAC);
    }

	/**
     * Returns the user's zodiac sign.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->_get(self::FIRST_NAME);
    }

	/**
     * Returns the user's last name.
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->_get(self::LAST_NAME);
    }

	/**
     * Returns the user's sex. No, this will not get you laid.
     *
     * @return string
     */
    public function getSex()
    {
        return $this->_get(self::SEX);
    }

	/**
     * Returns the user's age range.
     *
     * @return string
     */
    public function getAgeRange()
    {
        return $this->_get(self::AGE_RANGE);
    }

	/**
     * Returns the user's locations.
     *
     * @return array|null
     */
    public function getLocations()
    {
        $locations = $this->_get(self::LOCATIONS);

        if (!$locations) {
            return null;
        }

        $ret = array();

        foreach ($locations as $location) {
            $ret[] = new PeekYou_API_Result_Location($location);
        }

        return $ret;
    }

    /**
     * Returns the user's addresses' zipcodes.
     *
     * @return array|null
     */
    public function getAddresses()
    {
        $addresses = $this->_get(self::ADDRESSES);

        if (!$addresses) {
            return null;
        }

        $ret = array();

        foreach ($addresses as $address) {
            $ret[] = $address[self::ZIPCODE];
        }

        return $ret;
    }

    /**
     * Returns the user's works.
     *
     * @return array|null
     */
    public function getUsernames()
    {
        $usernames = $this->_get(self::USERNAMES);

        if (!$usernames) {
            return null;
        }

        $ret = array();

        foreach ($usernames as $username) {
            $ret[] = new PeekYou_API_Result_Username($username);
        }

        return $ret;
    }

    /**
     * Returns the user's bio.
     *
     * @return string
     */
    public function getBio()
    {
        return $this->_get(self::BIO);
    }

    /**
     * Returns the user's work.
     *
     * @return array|null
     */
    public function getWork()
    {
        $work = $this->_get(self::WORK);

        if (!$work) {
            return null;
        }

        $ret = array();

        foreach ($work as $job) {
            $ret[] = new PeekYou_API_Result_Work($job);
        }

        return $ret;
    }

    /**
     * Returns the user's schools.
     *
     * @return array|null
     */
    public function getSchools()
    {
        $schools = $this->_get(self::WORK);

        if (!$schools) {
            return null;
        }

        $ret = array();

        foreach ($schools as $school) {
            // TODO: Not sure of this one.. the doc is unclear.
            $ret[] = $school[self::SCHOOL];
        }

        return $ret;
    }

    /**
     * Returns the user's interests.
     *
     * @return array|null
     */
    public function getInterests()
    {
        $interests = $this->_get(self::INTERESTS);

        if (!$interests) {
            return null;
        }


        $ret = array();

        foreach ($interests as $interest) {
            $ret[] = new PeekYou_API_Result_Interest($interest);
        }

        return $ret;
    }

    /**
     * Returns the user's links.
     *
     * @return array|null
     */
    public function getLinks()
    {
        $links = $this->_get(self::LINKS);

        if (!$links) {
            return null;
        }


        $ret = array();

        foreach ($links as $link) {
            $ret[] = new PeekYou_API_Result_Link($link);
        }

        return $ret;
    }

    /**
     * Returns the user's Twitter bio.
     *
     * @return string|null
     */
    public function getTwitterBio()
    {
        return $this->_get(self::TWITTER_BIO);
    }

    /**
     * Returns the user's Twitter location.
     *
     * @return string
     */
    public function getTwitterLocation()
    {
        return $this->_get(self::TWITTER_LOCATION);
    }

    /**
     * Returns the user's Twitter followers count.
     *
     * @return string
     */
    public function getTwitterFollowersCount()
    {
        $val = $this->_get(self::TWITTER_FOLLOWER_COUNT);

        return $val[self::COUNT];
    }

    /**
     * Returns the user's Twitter following count.
     *
     * @return string
     */
    public function getTwitterFollowingCount()
    {
        $val = $this->_get(self::TWITTER_FOLLOWING_COUNT);

        return $val[self::COUNT];
    }

    /**
     * Returns the user's Linkedin bio.
     *
     * @return string
     */
    public function getLinkedinBio()
    {
        return $this->_get(self::LINKEDIN_BIO);
    }

    /**
     * Returns the user's Linkedin connection count.
     *
     * @return string
     */
    public function getLinkedinConnectionCount()
    {
        $val = $this->_get(self::LINKEDIN_CONNECTION_COUNT);

        return $val[self::COUNT];
    }

    /**
     * Returns the user's peekscore.
     *
     * @return string
     */
    public function getPeekScore()
    {
        return $this->_get(self::PEEKSCORE);
    }

    /**
     * Returns the user's Klout score.
     *
     * @return string
     */
    public function getKloutScore()
    {
        return $this->_get(self::KLOUT_SCORE);
    }

}