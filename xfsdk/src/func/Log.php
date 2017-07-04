<?php
namespace xfsdk\func;
class Log
{
    /**
     * [write 写日志]
     * @desc
     * @author limx
     * @param string $content 日志内容 Arr 或 String
     * @param string $code 标识
     * @param string $root 根目录
     * @param string $file 文件名
     */
    public static function write($content = '', $code = 'LOG', $root = '', $file = '')
    {
        empty($root) && $root = 'log/' . date('Ym') . '/';
        substr($root, -1) != '/' && $root .= '/';
        empty($file) && $file = date('Ymd');
        $file .= '.log';
        if (!is_dir($root)) {
            mkdir($root, 0777, true);
        }

        $msg[] = date('Y-m-d H:i:s');
        $msg[] = strtoupper($code);
        $msg[] = is_array($content) ? json_encode($content) : $content;

        $info = implode('|', $msg);
        file_put_contents($root . $file, $info . "\n", FILE_APPEND);
    }
}