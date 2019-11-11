<?php

namespace Tests\Functional;

class HomepageTest extends BaseTestCase
{
    /**
     * Test that the index route returns a rendered response containing the text 'SlimFramework' but not a greeting
     */
    public function testGetHomepageWithoutName()
    {
        $response = $this->runApp('GET', '/');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('SlimFramework', (string)$response->getBody());
        $this->assertStringNotContainsString('Hello', (string)$response->getBody());
    }

    public function testNotEnoughParamsPin()
    {
        $response = $this->runApp('GET', '/pins/tomahawk/260');

        $this->assertEquals(404, $response->getStatusCode());
    }

    public function testParamsPin()
    {
        $response = $this->runApp('GET', '/pins/tomahawk/260/2w');

        $expectResponse = '[{"percent":1,"pin":260.1,"hwi":1.0620375590931914},{"percent":0.9000000000000004,"pin":229.70000000000013,"hwi":0.7515326566883439},{"percent":0.8000000000000007,"pin":200.50000000000023,"hwi":0.5443771176487763}]';

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString($expectResponse, (string)$response->getBody());
    }
}
