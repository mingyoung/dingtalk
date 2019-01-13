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
    public function send($sender, $cid, $message)
    {
        return $this->app['client']->postJson('message/send_to_conversation', [
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
    public function sendViaCorporation($params)
    {
        return $this->app['client']->postJson('topapi/message/corpconversation/asyncsend_v2', $params);
    }

    /**
     * 查询工作通知消息的发送进度
     *
     * @param int $agentId
     * @param int $taskId
     *
     * @return mixed
     */
    public function getProgress($agentId, $taskId)
    {
        return $this->app['client']->postJson('topapi/message/corpconversation/getsendprogress', [
            'agent_id' => $agentId, 'task_id' => $taskId,
        ]);
    }

    /**
     * 查询工作通知消息的发送结果
     *
     * @param int $agentId
     * @param int $taskId
     *
     * @return mixed
     */
    public function getResult($agentId, $taskId)
    {
        return $this->app['client']->postJson('topapi/message/corpconversation/getsendresult', [
            'agent_id' => $agentId, 'task_id' => $taskId,
        ]);
    }

    /**
     * @return \EasyDingTalk\Conversation\SendViaCorporation
     */
    public function viaCorporation()
    {
        return new SendViaCorporation($this);
    }
}
