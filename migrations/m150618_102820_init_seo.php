<?php

use yii\db\Schema;
use yii\db\Migration;

class m150618_102820_init_seo extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%Seo}}', [
            'id' => Schema::TYPE_PK,
            'url' => Schema::TYPE_STRING . '(255)',
            'urlRule' => Schema::TYPE_TEXT,

            'name' => Schema::TYPE_STRING . '(255)',
            'comment' => Schema::TYPE_TEXT,

            'metaTitle' => Schema::TYPE_TEXT,
            'metaDescription' => Schema::TYPE_TEXT,
            'metaKeywords' => Schema::TYPE_TEXT,
            'pageContent' => Schema::TYPE_TEXT,

            'status' => Schema::TYPE_SMALLINT,
            'categoryId' => Schema::TYPE_INTEGER,
            'seoPageClass' => Schema::TYPE_STRING . '(255)',
            'createdAt' => Schema::TYPE_INTEGER,
            'updatedAt' => Schema::TYPE_INTEGER,
        ], $tableOptions);

        $this->createTable('{{%SeoCategory}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . '(255)',

            'metaTitle' => Schema::TYPE_TEXT,
            'metaKeywords' => Schema::TYPE_TEXT,
            'metaDescription' => Schema::TYPE_TEXT,
            'pageContent' => Schema::TYPE_TEXT,

            'comment' => Schema::TYPE_TEXT,
            'status' => Schema::TYPE_SMALLINT,
            'position' => Schema::TYPE_INTEGER,
            'createdAt' => Schema::TYPE_INTEGER,
            'updatedAt' => Schema::TYPE_INTEGER,
        ], $tableOptions);

        $this->addForeignKey('fkSeoCategory', '{{%Seo}}', 'categoryId', '{{%SeoCategory}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%Seo}}');
        $this->dropTable('{{%SeoCategory}}');
    }
}
