<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Conversation;

use EasyDingTalk\Kernel\BaseClient;
use function EasyDingTalk\tap;

class Client extends BaseClient
{
    /**
     * 发送普通消息
     *
     * @param string $sender
     * @param string $cid
     * @param array  $message
     *
     * @return mixed
     */
    public function sendGeneralMessage($sender, $cid, $message)
    {
        return $this->client->postJson('message/send_to_conversation', [
            'sender' => $sender, 'cid' => $cid, 'msg' => $message,
        ]);
    }

    /**
     * 发送工作通知消息
     *
     * @param array $params
     *
     * @return mixed
     */
    public function sendCorporationMessage($params)
    {
        return $this->client->postJson('topapi/message/corpconversation/asyncsend_v2', $params);
    }

    /**
     * @param int $taskId
     *
     * @return mixed
     */
    public function corporationMessage($taskId)
    {
        $client = new class($this->app) extends BaseClient {
            /**
             * 任务 ID
             *
             * @var int
             */
            protected $taskId;

            /**
             * @param int
             */
            public function setTaskId($taskId)
            {
                $this->taskId = $taskId;

                return $this;
            }

            /**
             * 查询工作通知消息的发送进度
             *
             * @return mixed
             */
            public function progress()
            {
                return $this->client->postJson('topapi/message/corpconversation/getsendprogress', [
                    'agent_id' => $this->app['config']['agent_id'], 'task_id' => $this->taskId,
                ]);
            }

            /**
             * 查询工作通知消息的发送结果
             *
             * @return mixed
             */
            public function result()
            {
                return $this->client->postJson('topapi/message/corpconversation/getsendresult', [
                    'agent_id' => $this->app['config']['agent_id'], 'task_id' => $this->taskId,
                ]);
            }
        };

        return tap($client, function ($client) use ($taskId) {
            $client->setTaskId($taskId);
        });
    }
}
