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

        $this->createTable('face_user', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'email' => $this->string()->notNull()->unique(),
            'cumpleaños' => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP",
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP",
            'updated_at' => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
        ], $tableOptions);

        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),

            'role_id' => "int(11) NOT NULL",
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP",
            'updated_at' => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
        ], $tableOptions);

        $this->createIndex('ix_email_user_face', 'face_user', 'email');
        $this->createIndex('ix_email_user', 'user', 'email');

        $this->execute("INSERT INTO `user` (`role_id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES (1, 'Root', 'UrxuVHzmZiJYpUtT04DQuXMGH3g0cb36', '$2y$13$0MZxKx/Wh3msVbnuNw8SM.5AXKhnjVRmf6ckiIvByjUKFC9CbOhzy', NULL, 'capsxii@gmail.com', '10', '2018-10-12 01:31:27', '2018-10-12 01:40:34');");
    }

    public function down()
    {
        $this->dropTable('face_user');
        $this->dropTable('user');
    }
}
