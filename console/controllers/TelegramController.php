<?php

namespace console\controllers;


use common\components\LightShopImportXML;

use Yii;
use yii\console\Controller;
use yii\db\Expression;

use common\models\Word;
use common\models\Link;

use TelegramBot\Api\BotApi;

use \DateTime;
use backend\models\Countsmoking;
use common\models\TodoForm;

class TelegramController extends Controller
{
    public function actionNotice()
    {
        $today = date('Y-m-d');
        $last_element = Countsmoking::find()->where(['between', 'data', $today . " 00:00:01", $today . " 23:59:59"])->orderBy(['data' => SORT_DESC])->one();
        if ($last_element != null) {
            $latest_date_time = strtotime($last_element->data);
            $latest_date_time = date('Y-m-d H:i:s', $latest_date_time);
            $datetime1 = new DateTime($latest_date_time);

            $interval = $datetime1->diff(new DateTime())->format("%d days, %h hours and %i minuts");
        } else {
            $interval = 'Нет данных';
        }

        $statisticDay = TodoForm::find()->andWhere('last_update >= CURDATE()')
            ->andWhere(['=', 'done', '1'])
            ->asArray()->all();

        $messageText = "" . $interval ."\n Выполнено задач = " . count($statisticDay);

        $chatId = '-471687689';

        $bot = new BotApi('1555682911:AAEAbiv_R4cZat6zHuHHxnbilMHJlta07VE');
        // Set webhook

        //$bot->setProxy('root:6zd4{k879B8$@195.161.41.150:3128');
        $bot->sendMessage($chatId, $messageText, 'HTML');
    }
}
