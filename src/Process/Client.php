<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) mingyoung <mingyoungcheung@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Process;

use EasyDingTalk\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author baijunyao <baijunyao@baijunyao.com>
 */
class Client extends BaseClient
{
    /**
     * 获取审批实例列表.
     *
     * @param string $processCode  流程模板唯一标识 可在oa后台编辑审批表单部分查询
     * @param int    $startTime    时间戳 可以传秒或者毫秒
     * @param int    $endTime      时间戳 可以传秒或者毫秒
     * @param array  $useridList   数组形式的用户列表
     * @param int    $cursor
     * @param int    $size
     *
     * @return array|\GuzzleHttp\Psr7\Response
     */
    public function list(string $processCode, int $startTime, int $endTime = 0, array $useridList = [], $cursor = 0, $size = 10)
    {
        // php 不方便生成毫秒数 如果传入秒 则自动补 3个0 成为毫秒
        $startTime = strlen($startTime) === 10 ? $startTime.'000' : $startTime;
        $endTime = strlen($endTime) === 10 ? $endTime.'000' : $endTime;
        // userid_list 需要是以 逗号分割的字符串
        $useridList = implode(',', $useridList);
        $params = [
            'process_code' => $processCode,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'userid_list' => $useridList,
            'size' => $size,
        ];
        // 过滤掉 end_time 、 useridList 、 size 这三项的空值
        $params = array_filter($params);
        $params['cursor'] = $cursor;

        return $this->httpGetMethod('dingtalk.smartwork.bpms.processinstance.list', $params);
    }
}
