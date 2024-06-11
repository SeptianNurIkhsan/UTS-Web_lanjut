<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class AlterNews extends Migration
{
    public function up()
    {
        // Get the database connection
        $db = \Config\Database::connect();

        // Check if the column already exists
        $fields = $db->getFieldData('news');
        $exists = false;

        foreach ($fields as $field)
        {
            if ($field->name == 'slug')
            {
                $exists = true;
                break;
            }
        }

        // Add the column if it does not exist
        if (!$exists)
        {
            $this->forge->addColumn('news', [
                'slug' => [
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                    'unique' => true,
                ],
            ]);
        }
    }

    public function down()
    {
        // Drop the column if it exists
        $db = \Config\Database::connect();
        $fields = $db->getFieldData('news');
        $exists = false;

        foreach ($fields as $field)
        {
            if ($field->name == 'slug')
            {
                $exists = true;
                break;
            }
        }

        if ($exists)
        {
            $this->forge->dropColumn('news', 'slug');
        }
    }
}