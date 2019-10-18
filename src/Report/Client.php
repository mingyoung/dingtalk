<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) 张铭阳 <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Report;

use EasyDingTalk\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 获取用户日志数据
     *
     * @param array $params
     *
     * @return mixed
     */
    public function list($params)
    {
        return $this->client->postJson('topapi/report/list', $params);
    }

    /**
     * 获取用户可见的日志模板
     *
     * @param string|null $userId
     * @param int $offset
     * @param int $size
     *
     * @return mixed
     */
    public function templates($userId = null, $offset = 0, $size = 100)
    {
        return $this->client->postJson('topapi/report/template/listbyuserid', [
            'userid' => $userId, 'offset' => $offset, 'size' => $size,
        ]);
    }

    /**
     * 获取用户日志未读数
     *
     * @param string $userid
     *
     * @return mixed
     */
    public function unreadCount($userid)
    {
        return $this->client->postJson('topapi/report/getunreadcount', compact('userid'));
    }

    /**
     * 获取日志的已读人数、评论条数、评论人数、点赞人数。
     *
     * @param $report_id
     *
     * @return mixed
     */
    public function statistics($report_id)
    {
        return $this->client->postJson('topapi/report/statistics', compact('report_id'));
    }

    /**
     * 获取日志相关人员列表，包括已读人员列表、评论人员列表、点赞人员列表
     *
     * @param string $report_id
     * @param int $type
     * @param int $offset
     * @param int $size
     *
     * @return mixed
     */
    public function statisticsByType($report_id, $type, $offset = 0, $size = 100)
    {
        return $this->client->postJson('topapi/report/statistics/listbytype', [
            'report_id' => $report_id, 'type' => $type, 'offset' => $offset, 'size' => $size
        ]);
    }

    /**
     * 获取日志接收人员列表
     *
     * @param string $report_id
     * @param int $offset
     * @param int $size
     *
     * @return mixed
     */
    public function getReceivers($report_id, $offset = 0, $size = 100)
    {
        return $this->client->postJson('topapi/report/receiver/list', [
            'report_id' => $report_id, 'offset' => $offset, 'size' => $size
        ]);
    }

    /**
     * 获取日志评论详情，包括评论人userid、评论内容、评论时间
     *
     * @param string $report_id
     * @param int $offset
     * @param int $size
     *
     * @return mixed
     */
    public function getComments($report_id, $offset = 0, $size = 100)
    {
        return $this->client->postJson('topapi/report/comment/list', [
            'report_id' => $report_id, 'offset' => $offset, 'size' => $size
        ]);
    }

}
