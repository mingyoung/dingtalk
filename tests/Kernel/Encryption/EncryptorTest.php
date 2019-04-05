<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Tests\Kernel\Encryption;

use EasyDingTalk\Kernel\Encryption\Encryptor;
use EasyDingTalk\Tests\TestCase;

class EncryptorTest extends TestCase
{
    /**
     * @return \EasyDingTalk\Kernel\Encryption\Encryptor
     */
    public function makeEncryptor()
    {
        return new Encryptor('suite4xxxxxxxxxxxxxxx', '123456', '4g5j64qlyl3zvetqxz5jiocdr586fn2zvjpa8zls3ij');
    }

    /** @test */
    public function encrypt()
    {
        $encryptor = $this->makeEncryptor();
        $result = json_decode($encryptor->encrypt('{"EventType":"check_create_suite_url","Random":"LPIdSnlF","TestSuiteKey":"suite4xxxxxxxxxxxxxxx"}'), true);

        $result = $encryptor->decrypt(
            $result['encrypt'], $result['msg_signature'], $result['nonce'], $result['timeStamp']
        );

        $this->assertSameDecryptedData($result);
    }

    /** @test */
    public function decrypt()
    {
        $encryptor = $this->makeEncryptor();

        $result = $encryptor->decrypt(
            '1a3NBxmCFwkCJvfoQ7WhJHB+iX3qHPsc9JbaDznE1i03peOk1LaOQoRz3+nlyGNhwmwJ3vDMG+OzrHMeiZI7gTRWVdUBmfxjZ8Ej23JVYa9VrYeJ5as7XM/ZpulX8NEQis44w53h1qAgnC3PRzM7Zc/D6Ibr0rgUathB6zRHP8PYrfgnNOS9PhSBdHlegK+AGGanfwjXuQ9+0pZcy0w9lQ==',
            '5a65ceeef9aab2d149439f82dc191dd6c5cbe2c0',
            'nEXhMP4r',
            '1445827045067'
        );

        $this->assertSameDecryptedData($result);
    }

    protected function assertSameDecryptedData($result)
    {
        $this->assertSame('{"EventType":"check_create_suite_url","Random":"LPIdSnlF","TestSuiteKey":"suite4xxxxxxxxxxxxxxx"}', $result);
    }
}
