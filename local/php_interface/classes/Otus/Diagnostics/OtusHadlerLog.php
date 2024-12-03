<?php
namespace Otus\Diagnostics;

use Bitrix\Main\Diag\FileExceptionHandlerLog;
use Bitrix\Main\Diag\ExceptionHandlerFormatter;

class OtusHadlerLog extends FileExceptionHandlerLog
{
    public function write($exception, $logType)
    {
        $text = ExceptionHandlerFormatter::format($exception, false, $this->level);

        $context = [
            'type' => static::logTypeToString($logType),
        ];

        $logLevel = static::logTypeToLevel($logType);

        $message = "{date} - Host: {host} - {type} - {$text}\n";

        $start = explode("\n", $message);

        foreach ($start as &$line) {
            $line = 'OTUS - ' . $line;
        }

        $message = implode("\n", $start);

        $this->logger->log($logLevel, $message, $context);
    }
};
