<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMapelToChatAi extends Migration
{
    public function up()
    {
        $this->forge->addColumn('chat_ai', [
            'mapel' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
                'after'      => 'user_id',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('chat_ai', 'mapel');
    }
}
