<?php

/*
 * This file is part of the mingyoung/dingtalk.
 *
 * (c) cyril chan <cxhforever@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyDingTalk\Extcontact;

use EasyDingTalk\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author cyril chan <cxhforever@gmail.com>
 */
class Client extends BaseClient
{
    /**
     * 获取外部联系人标签列表
     * 
     * @param int $size   
     * @param int $offset
     *
     * @return array
     */
    public function listLabelGroups(int $size = 20, int $offset = 0)
    {
        return $this->httpPostJson('topapi/extcontact/listlabelgroups',['size' => $size ,'offset' => $offset]);
    }

    /**
     * 获取外部联系人列表.
     *
     * @param int $size   
     * @param int $offset
     *
     * @return array
     */
    public function list(int $size = 20, int $offset = 0)
    {
        return $this->httpPostJson('topapi/extcontact/list', ['size' => $size ,'offset' => $offset]);
    }

    /**
     * 获取企业外部联系人详情.
     *
     * @param string $user_id
     *
     * @return array
     */
    public function get(string $user_id)
    {
        return $this->httpPostJson('topapi/extcontact/get', ['user_id' => $user_id]);
    }

    /**
     * 添加外部联系人.
     *
     * @param array $params
     *
     * @return array
     */
    public function create(array $params)
    {
        return $this->httpPostJson('topapi/extcontact/create', $params);
    }

    /**
     * 更新外部联系人.
     *
     * @param array $params
     *
     * @return array
     */
    public function update(array $params)
    {
        return $this->httpPostJson('topapi/extcontact/update', $params);
    }

    /**
     * 删除外部联系人.
     *
     * @param string $user_id
     *
     * @return array
     */
    public function delete(string $user_id)
    {
        return $this->httpPostJson('topapi/extcontact/delete', ['user_id' => $user_id]);
    }
   
}
