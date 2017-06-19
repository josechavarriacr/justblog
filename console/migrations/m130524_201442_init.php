<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            ], $tableOptions);

        $this->createTable('{{%tbl_post}}', [
            'id' => $this->primaryKey(),
            'titulo' => $this->string(128)->notNull(),
            'url' => $this->string(128)->notNull(),
            'descripcion' => $this->string(512)->notNull(),
            'keyword' => $this->string(128),
            'img' => $this->string(128),
            'text' => $this->text()->notNull(),
            'count' => $this->integer(),
            'created_at' => $this->integer(),
            'type' => "enum('post','about','privacy','ama')",
            'status' => $this->boolean(),
            ], $tableOptions);

        $this->createTable('{{%tbl_category}}',[
            'id' => $this->primaryKey(),
            'name' => $this->string(128)->notNull(),
            'description' => $this->string(512),
            'url' => $this->string(128)->notNull(),
            'img' => $this->string(128),
            ],$tableOptions); 

        $this->createTable('{{%tbl_tag}}',[
            'id' => $this->primaryKey(),
            'name' => $this->string(64)->notNull(),
            ],$tableOptions);

        $this->createTable('{{%tbl_post_category}}',[
            'id' => $this->primaryKey(),
            'id_post' => $this->integer(),
            'id_category' => $this->integer(),
            ],$tableOptions); 

        $this->createTable('{{%tbl_post_tag}}',[
            'id' => $this->primaryKey(),
            'id_post' => $this->integer(),
            'id_tag' => $this->integer(),
            ],$tableOptions); 

        $this->createTable('{{%tbl_logs}}',[
            'id' => $this->primaryKey(),
            'ip' => $this->string(64),
            'module' => $this->string(512),
            'referrer' => $this->string(512),
            'new' => $this->boolean(),
            'language' => $this->string(64),
            'method' => $this->string(64),
            'browser' => $this->string(64),
            'os' => $this->string(64),
            'device' => $this->string(64),
            'type' => $this->string(64),
            'csrfToken' => $this->string(512),
            'port' => $this->string(64),
            'user_agent' => $this->string(512),
            'time' => $this->integer(),
            ],$tableOptions); 

        $this->createTable('{{%tbl_metatag}}',[
            'id' => $this->primaryKey(),
            'id_user' => $this->integer(),
            'title' => $this->string(64),
            'url' => $this->string(64),
            'description' => $this->string(128),
            'keywords' => $this->string(128),
            'category' => $this->string(64),
            'icon' => $this->string(128),
            'image' => $this->string(128),
            ],$tableOptions); 

        $this->createTable('{{%tbl_profile}}',[
            'id' => $this->primaryKey(),
            'id_user' => $this->integer(),
            'name' => $this->string(64),
            'email' => $this->string(64),
            'ip' => $this->string(64),
            'image' => $this->string(128),
            'facebook' => $this->string(64),
            'twitter' => $this->string(64),
            'linkedin' => $this->string(64),
            'github' => $this->string(64),
            'description' => $this->text(),
            ],$tableOptions); 
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
        $this->dropTable('{{%tbl_post}}');
        $this->dropTable('{{%tbl_category}}');
        $this->dropTable('{{%tbl_tag}}');
        $this->dropTable('{{%tbl_post_category}}');
        $this->dropTable('{{%tbl_post_tag}}');
        $this->dropTable('{{%tbl_logs}}');
        $this->dropTable('{{%tbl_metatag}}');
        $this->dropTable('{{%tbl_profile}}');
    }
}
