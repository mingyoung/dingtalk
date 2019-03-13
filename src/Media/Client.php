<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Media;

use EasyDingTalk\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 上传图片
     *
     * @param mixed $media
     *
     * @return mixed
     */
    public function uploadImage($media)
    {
        return $this->upload('image', $media);
    }

    /**
     * 上传语音
     *
     * @param mixed $media
     *
     * @return mixed
     */
    public function uploadVoice($media)
    {
        return $this->upload('voice', $media);
    }

    /**
     * 上传普通文件
     *
     * @param mixed $media
     *
     * @return mixed
     */
    public function uploadFile($media)
    {
        return $this->upload('file', $media);
    }

    /**
     * 上传媒体文件
     *
     * @param string $type
     * @param mixed  $media
     *
     * @return mixed
     */
    public function upload($type, $media)
    {
        return $this->client->upload('media/upload', ['media' => $media], compact('type'));
    }
}
