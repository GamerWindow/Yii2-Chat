<?php

namespace app\models;

use yii\db\ActiveRecord;

class Message extends ActiveRecord
{
    public function rules()
    {
        return [
            [['name', 'inhalt'], 'required'],
            [['name', 'inhalt'], 'safe'],
        ];
    }
}
