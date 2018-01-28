<?php

namespace app\modules\books\models;

use app\models\AuthorBookAssn;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * @property Authors[] $authors
 */
class Books extends \app\models\Books
{
    public function behaviors()
    {
        return [
            'timestampBehavior' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['date_create', 'date_update'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'date_update',
                ]
            ],
        ];
    }

    public function beforeDelete()
    {
        if ($this->authorBookAssns) {
            foreach ($this->authorBookAssns as $item) {
                $item->delete();
            }
        }

        return parent::beforeDelete();
    }

    public function softCreate(Array $array) {

        foreach ( $array as $item) {
            $authorBookAssn = new AuthorBookAssn();
            $authorBookAssn->book_id = $this->id;
            $authorBookAssn->author_id = $item;
            $authorBookAssn->save();
        }

    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthors()
    {
        return $this->hasMany(Authors::className(), ['id' => 'author_id'])->viaTable('author_book_assn', ['book_id' => 'id']);
    }

}
