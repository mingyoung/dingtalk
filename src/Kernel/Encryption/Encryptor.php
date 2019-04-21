<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Kernel\Encryption;

use function EasyDingTalk\str_random;

class Encryptor
{
    /**
     * @var string
     */
    protected $key;

    /**
     * @var string
     */
    protected $token;

    /**
     * @var string
     */
    protected $aesKey;

    /**
     * @var int
     */
    protected $blockSize = 32;

    /**
     * Encryptor Constructor.
     *
     * @param string $key
     * @param string $token
     * @param string $aesKey
     */
    public function __construct($key, $token, $aesKey)
    {
        $this->key = $key;
        $this->token = $token;
        $this->aesKey = base64_decode($aesKey.'=', true);
    }

    /**
     * Encrypt the data.
     *
     * @param string $data
     * @param string $nonce
     * @param int    $timestamp
     *
     * @return string
     */
    public function encrypt($data, $nonce = null, $timestamp = null)
    {
        $string = str_random().pack('N', strlen($data)).$data.$this->key;

        $result = base64_encode(
            openssl_encrypt($this->pkcs7Pad($string), 'AES-256-CBC', $this->aesKey, OPENSSL_NO_PADDING, substr($this->aesKey, 0, 16))
        );

        !is_null($nonce) || $nonce = uniqid();
        !is_null($timestamp) || $timestamp = time();

        return json_encode([
            'msg_signature' => $this->signature($this->token, $nonce, $timestamp, $result),
            'timeStamp' => $timestamp,
            'nonce' => $nonce,
            'encrypt' => $result,
        ]);
    }

    /**
     * Decrypt the data.
     *
     * @param string $data
     * @param string $signature
     * @param string $nonce
     * @param int    $timestamp
     *
     * @return string
     */
    public function decrypt($data, $signature, $nonce, $timestamp)
    {
        if ($signature !== $this->signature($this->token, $nonce, $timestamp, $data)) {
            throw new \RuntimeException('Invalid Signature.');
        }

        $decrypted = openssl_decrypt(
            base64_decode($data, true), 'AES-256-CBC', $this->aesKey, OPENSSL_NO_PADDING, substr($this->aesKey, 0, 16)
        );

        $result = $this->pkcs7Unpad($decrypted);

        $data = substr($result, 16, strlen($result));

        $contentLen = unpack('N', substr($data, 0, 4))[1];

        if (substr($data, $contentLen + 4) !== $this->key) {
            throw new \RuntimeException('Invalid CorpId.');
        }

        return substr($data, 4, $contentLen);
    }

    /**
     * Get SHA1.
     *
     * @return string
     */
    public function signature()
    {
        $array = func_get_args();
        sort($array, SORT_STRING);

        return sha1(implode($array));
    }

    /**
     * PKCS#7 pad.
     *
     * @param string $text
     *
     * @return string
     */
    public function pkcs7Pad(string $text)
    {
        $padding = $this->blockSize - (strlen($text) % $this->blockSize);
        $pattern = chr($padding);

        return $text.str_repeat($pattern, $padding);
    }

    /**
     * PKCS#7 unpad.
     *
     * @param string $text
     *
     * @return string
     */
    public function pkcs7Unpad(string $text)
    {
        $pad = ord(substr($text, -1));
        if ($pad < 1 || $pad > $this->blockSize) {
            $pad = 0;
        }

        return substr($text, 0, (strlen($text) - $pad));
    }
}
