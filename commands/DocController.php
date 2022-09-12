<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\console\ExitCode;

class DocController extends Controller
{

    public function actionBuild(): int
    {
        $source = Yii::getAlias('@app');
        $openApi = \OpenApi\Generator::scan([$source]);
        $file = Yii::getAlias('@app/web/documentation/swagger.yaml');
        $handle = fopen($file, 'wb');
        fwrite($handle, $openApi->toYaml());
        fclose($handle);
        echo $this->ansiFormat('Successfully created swagger file'.PHP_EOL);
        return ExitCode::OK;
    }
}