<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "books".
 *
 * @property int $id
 * @property string $name
 * @property int $edition
 * @property string $description
 * @property string $isbn
 * @property string $image
 * @property string $date_create
 * @property string $date_update
 *
 * @property AuthorBookAssn[] $authorBookAssns
 */
class Books extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['edition', 'isbn'], 'required'],
            [['edition'], 'integer'],
            [['description'], 'string'],
            [['date_create', 'date_update'], 'safe'],
            [['name', 'isbn'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'edition' => 'Edition',
            'description' => 'Description',
            'isbn' => 'Isbn',
            'image' => 'Image',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
        ];
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorBookAssns()
    {
        return $this->hasMany(AuthorBookAssn::className(), ['book_id' => 'id']);
    }
}
