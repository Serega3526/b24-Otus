<?php

namespace Events;

use Bitrix\Crm\ItemIdentifier;
use Bitrix\Crm\Service\Container;
use Bitrix\Main\EventManager;
use Bitrix\Main\Loader;
use Bitrix\Main\Event;
use Bitrix\Im\Bot;

class ReportHandler
{
    // ID чата, куда будет отправляться сообщение
    const CHAT_ID = 1; // Замените на ID вашего чата

    // Обработчик события OnAfterTimemanReportAdd
    public static function OnAfterTMReportAdd($arFields)
    {
        // Получаем данные отчета
        $reportId = $arFields->getParameter('ID');
        $reportData = $arFields->getParameter('FIELDS');

        if ($reportId && $reportData) {
            // Получаем информацию о сотруднике
            $userId = $reportData['USER_ID'];
            $userName = self::GetUserName($userId);

            // Формируем сообщение
            $message = "Добавлен новый отчет в учете времени!\n\n";
            $message .= "Сотрудник: {$userName}\n";
            $message .= "Дата отчета: {$reportData['DATE']}\n";
            $message .= "Комментарий: {$reportData['COMMENT']}";

            // Отправляем сообщение в чат
            self::SendMessageToChat($message);
        }
    }

    // Функция для получения имени сотрудника
    private static function GetUserName($userId)
    {
        if (Loader::includeModule('main')) {
            $user = \Bitrix\Main\UserTable::getById($userId)->fetch();
            return $user ? $user['NAME'] . ' ' . $user['LAST_NAME'] : 'Неизвестный сотрудник';
        }
        return 'Неизвестный сотрудник';
    }

    // Функция для отправки сообщения в чат
    private static function SendMessageToChat($message)
    {
        if (Loader::includeModule('im')) {
            Bot::addMessage([
                'DIALOG_ID' => self::CHAT_ID,
                'MESSAGE' => $message,
            ]);
        }
    }
}
