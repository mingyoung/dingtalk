<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Chat;

use EasyDingTalk\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 发送群消息
     *
     * @param string $chatId
     * @param string $message
     *
     * @return mixed
     */
    public function send($chatId, $message)
    {
        return $this->client->postJson('chat/send', [
            'chatid' => $chatId, 'msg' => $message,
        ]);
    }

    /**
     * 查询群消息已读人员列表
     *
     * @param string $messageId
     * @param int    $cursor
     * @param int    $size
     *
     * @return mixed
     */
    public function result($messageId, $cursor, $size)
    {
        return $this->client->get('chat/getReadList', [
            'messageId' => $messageId, 'cursor' => $cursor, 'size' => $size,
        ]);
    }

    /**
     * 创建会话
     *
     * @param array $params
     *
     * @return mixed
     */
    public function create($params)
    {
        return $this->client->postJson('chat/create', $params);
    }

    /**
     * 修改会话
     *
     * @param string $chatId
     * @param array  $params
     *
     * @return mixed
     */
    public function update($chatId, $params)
    {
        return $this->client->postJson('chat/update', ['chatid' => $chatId] + $params);
    }

    /**
     * 获取会话
     *
     * @param string $chatId
     *
     * @return mixed
     */
    public function get($chatId)
    {
        return $this->client->get('chat/get', ['chatid' => $chatId]);
    }
}
