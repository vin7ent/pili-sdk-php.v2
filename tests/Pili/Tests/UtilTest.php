<?php

namespace Vin7ent\Pili
{
    function time()
    {
        return isset($_SERVER['override_qiniu_auth_time'])
            ? 1234567890
            : \time();
    }
}

namespace Pili\Tests
{
    use \Vin7ent\Pili\Utils;

    class Base64Test extends \PHPUnit_Framework_TestCase
    {
        public function testUrlSafe()
        {
            $a = '你好';
            $b = Utils::base64UrlEncode($a);
            $this->assertEquals($a, Utils::base64UrlDecode($b));
        }
    }

    class HubTest extends \PHPUnit_Framework_TestCase
    {
        public function testPublishUrl()
        {
            $_SERVER['override_qiniu_auth_time'] = true;
            $a = \Vin7ent\Pili\RTMPPublishURL("publish-rtmp.test.com", "thub", "tkey", 3600, "123", "abc");
            $this->assertEquals($a, "rtmp://publish-rtmp.test.com/thub/tkey?e=1234571490&token=123:qXis9DxDwd1ZUej6Fh6f47goib4=");
            unset($_SERVER['override_qiniu_auth_time']);
        }
    }
}
