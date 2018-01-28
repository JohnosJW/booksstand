<?php

namespace app\modules\books\models;

/**
 * @property Books[] $books
 */
class Authors extends \app\models\Authors
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Books::className(), ['id' => 'book_id'])->viaTable('author_book_assn', ['author_id' => 'id']);
    }

    /**
     * @inheritdoc
     */
//    public function getAuthorsRating($date_min, $date_max)
//    {
//        $this->getBooks()->where(['between', 'edition', $date_min, $date_max])->count();
//    }

    /**
     * @return array
     *
     * Возвращает массив созданных полных имен авторов с ключами $author['id']
     */
    public static function getAuthorsArray()
    {
        $authors = self::find()->asArray()->all();
        $authors_result = [];
        foreach ($authors as $author) {
            $authors_result[$author['id']] = $author['first_name'] . ' ' . $author['last_name'];
        }
        return $authors_result;
    }

    /**
     * @param $id
     *
     * @return string
     *
     * Возвращает полное имя автора по его $id
     */
    public static function getAuthorById($id)
    {
        $author = self::find()->where(['id' => $id])->one();
        return $author->first_name . ' ' . $author->last_name;
    }
}
