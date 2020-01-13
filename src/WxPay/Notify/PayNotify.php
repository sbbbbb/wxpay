<?php


namespace Xcrms\WxPay\Notify;


use Xcrms\WxPay\Notify;


/**
 * @todo 支付结果通知类
 * Class PayNotify
 * @package Inesadt\WxPay\Notify
 */
class PayNotify extends NotifyBase
{

    public function handle(){
        $xml = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : file_get_contents("php://input");
        $this->raw_xml = $xml;

        $this->logger->debug($xml);
        $result = Notify::handle($this->key, $xml, $data);
        $this->result = $result;

        if($result['code']==1)
        {
            Notify::replyOk();
        }else{
            Notify::replyFail($result['msg']);
        }
    }
}