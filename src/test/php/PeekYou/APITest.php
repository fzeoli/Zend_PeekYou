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
 * Main API class test.
 */
class PeekYou_APITest extends PHPUnit_Framework_TestCase
{

    private $_testResponse;

    /**
     * Sets up the test.
     *
     * @return void
     */
    public function setUp()
    {
        $this->_testResponse = file_get_contents(
        	'src/test/resources/output.json'
        );
    }

    /**
     * Tests the search method.
     *
     * @return void
     */
    public function testSearch()
    {
        $apiKey= 'abcd123';
        $adapter = new Zend_Http_Client_Adapter_Test();

        $response = new Zend_Http_Response(200, array(), $this->_testResponse);
        $adapter->setResponse($response);

        $client = new Zend_Http_Client(
            null,
            array(
            	'adapter' => $adapter
            )
        );

        $api = new PeekYou_API($apiKey, $client);

        $search = 'justatest';

        $ret = $api->search($search);

        $url = 'http://www.peekyou.com:80/api/api.php?key=' . $apiKey . '&url='
        	. $search . '&output=json';

        $this->assertEquals($url, $client->getUri()->getUri());
        $this->assertTrue($ret instanceof PeekYou_API_Result);

        $this->assertEquals($ret->getFirstName(), 'Michael');
        $this->assertEquals($ret->getLastName(), 'Hussey');

        $locations = $ret->getLocations();

        $this->assertTrue(is_array($locations));
        $this->assertEquals(5, count($locations));

        $this->assertEquals('USA', $locations[0]->getCountry());
        $this->assertEquals('Maine', $locations[0]->getRegion());

        $this->assertNull($ret->getInterests());

        $usernames = $ret->getUsernames();

        $this->assertEquals(5, count($usernames));

        $this->assertEquals('flickr', $usernames[1]->getSource());
        $this->assertEquals('popcontest', $usernames[1]->getValue());

        $links = $ret->getLinks();

        $this->assertEquals(25, count($links));

        $this->assertEquals('http://michaelhussey.com/', $links[0]->getLink());
        $this->assertEquals(
            PeekYou_API_Result_Link::LINK_PERSONAL, $links[0]->getType()
        );

        $this->assertNull($ret->getWork());

        var_dump($ret->getAddresses());
    }

    public function testRareResultStates()
    {
        $apiKey= 'abcd123';
        $content = '{"results":{"total_found":0,"status":-3,"request_id":1325307}}';

        $adapter = new Zend_Http_Client_Adapter_Test();

        $response = new Zend_Http_Response(200, array(), $content);
        $adapter->setResponse($response);

        $client = new Zend_Http_Client(
            null,
            array(
            	'adapter' => $adapter
            )
        );

        $api = new PeekYou_API($apiKey, $client);

        $search = 'justatest';

        $this->assertNull($api->search($search));

    }

}