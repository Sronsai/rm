<?php

namespace frontend\models;

use Yii;

/**
 * This is the ActiveQuery class for [[Risk]].
 *
 * @see Risk
 */
class RiskQuery extends \yii\db\ActiveQuery
{
    public function byLocationId()  // function map กับตาราง risk
    {
        $this->andWhere('location_riks_id=:id',[
            'id' => Yii::$app->user->identity->location_id,
        ]);
        return $this;
    }
    
     public function byUserId()
    {
        $this->andWhere('user_id=:id',[
            'id' => Yii::$app->user->id,
        ]);
        return $this;
    }

    /**
     * @inheritdoc
     * @return Risk[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Risk|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}