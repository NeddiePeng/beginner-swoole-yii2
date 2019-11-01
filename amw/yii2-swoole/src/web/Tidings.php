<?php
/**
 * Created by PhpStorm.
 * @author: pf <576970513@qq.com>
 * Date: 2019/10/31
 * Time: 10:52
 */
declare(strict_types = 1);

namespace amw\web;

use yii\base\Component;

class Tidings extends Component {

    public function send(string $data) {
        $data = json_decode($data, true);
        if(!$data) {
            return false;
        }
        $send_data = [
            'type' => $data['type'],
            'uid' => $data['to_uid'] ?: 0,
            'from_uid' => $data['uid'],
            'message' => $data['message']
        ];
        return json_encode($send_data, JSON_UNESCAPED_UNICODE);
    }
}