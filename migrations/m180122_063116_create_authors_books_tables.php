<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m180122_063116_create_authors_books_tables
 */
class m180122_063116_create_authors_books_tables extends Migration
{
    private $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable( '{{%authors}}', [
            'id'         => Schema::TYPE_PK,
            'first_name' => Schema::TYPE_STRING,
            'last_name'  => Schema::TYPE_STRING,
        ], $this->tableOptions );

        $this->createTable( '{{%books}}', [
            'id'          => Schema::TYPE_PK,
            'name'        => Schema::TYPE_STRING,
            'edition'     => Schema::TYPE_INTEGER . '(4) NOT NULL',
            'description' => Schema::TYPE_TEXT,
            'isbn'        => Schema::TYPE_STRING . '(255) NOT NULL',
            'image'       => $this->string()->null()->defaultValue('/images/default.jpg'),
            'date_create' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'date_update' => $this->timestamp()->notNull()->defaultValue('0000-00-00 00:00:00'),
        ], $this->tableOptions );

        $this->createTable( 'author_book_assn', [
            'author_id'    => Schema::TYPE_INTEGER . '(10) NOT NULL',
            'book_id'      => Schema::TYPE_INTEGER . '(10) NOT NULL',
        ], $this->tableOptions );

        $this->createIndex('FK_books_name', '{{%books}}', 'name');

        $this->addForeignKey(
            'FK_authors_id', 'author_book_assn', 'author_id', '{{%authors}}', 'id'
        );
        $this->addForeignKey(
            'FK_books_id', 'author_book_assn', 'book_id', '{{%books}}', 'id'
        );

        $this->insertData();
    }

    private function insertData() {
        $this->insert('{{%authors}}', [
            'first_name' => 'Теодор',
            'last_name' => 'Драйзер'
        ]);

        $this->insert('{{%books}}', [
            'name' => 'Финансист',
            'edition' => '1912',
            'description'     => 'Герой романа «Финансист» – Фрэнк Каупервуд – не только удачливый бизнесмен и владелец огромного состояния.
                Он обладает особым магнетизмом, сверхъестественной властью как над мужчинами, так и над женщинами.',
            'isbn'        => '9780486818092',
            'image' => '/images/financist.jpg'
        ]);

        $this->insert('{{%books}}', [
            'name' => 'Титан',
            'edition' => '1914',
            'description'     => 'Когда Фрэнк Алджернон Каупервуд вышел из филадельфийской исправительной тюрьмы,
                он понял, что с прежней жизнью в родном городе покончено.',
            'isbn'        => '8890486818092',
            'image' => '/images/titan.jpg'
        ]);

        $this->insert('{{%books}}', [
            'name' => 'Стоик',
            'edition' => '1914',
            'description'     => 'Фрэнк Каупервуд во время своей длительной борьбы в Чикаго за возобновление концессии еще на пятьдесят лет – борьбы,
                которая, несмотря на все его усилия, кончилась для него полным крахом, – обнаружил на своем пути два труднопреодолимых препятствия.',
            'isbn'        => '8890486877792',
            'image' => '/images/stoik.jpg'
        ]);

        $this->insert('{{%authors}}', [
            'first_name' => 'Лев',
            'last_name' => 'Толстой'
        ]);

        $this->insert('{{%books}}', [
            'name' => 'Война и мир',
            'edition' => '1868',
            'description'     => 'Война и мир" – всемирно известный роман-эпопея Л.Н.Толстого – ни по своим масштабам,
                ни по своей структуре не похож на классический роман.',
            'isbn'        => '8890987818092',
            'image' => '/images/mir.jpg'
        ]);

        $this->insert('{{%books}}', [
            'name' => 'Анна Каренина',
            'edition' => '1878',
            'description'     => 'По словам Ф.М.Достоевского, «Анна Каренина» поразила современников «не только вседневностью содержания,
                но и огромной психологической разработкой души человеческой, страшной глубиной и силой',
            'isbn'        => '8891111818092',
            'image' => '/images/anna.jpg'
        ]);

        $this->insert('author_book_assn', [
            'author_id'    => 1,
            'book_id'      =>  1
        ]);

        $this->insert('author_book_assn', [
            'author_id'    => 1,
            'book_id'      =>  2
        ]);

        $this->insert('author_book_assn', [
            'author_id'    => 1,
            'book_id'      =>  3
        ]);

        $this->insert('author_book_assn', [
            'author_id'    => 2,
            'book_id'      =>  4
        ]);

        $this->insert('author_book_assn', [
            'author_id'    => 2,
            'book_id'      =>  5
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_authors_id', 'author_book_assn');
        $this->dropForeignKey('FK_books_id', 'author_book_assn');

        $this->dropTable( '{{%authors}}' );
        $this->dropTable( '{{%books}}' );
    }

}
