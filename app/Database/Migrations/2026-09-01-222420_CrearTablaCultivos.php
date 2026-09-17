<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use PHPUnit\Framework\Constraint\Constraint;

class CrearTablaCultivos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'=>[
                'type'=>'INT',
                'constraint'=>11,
                'unsigned'=>true,
                'auto_increment'=>true,
            ],
            'nombre_planta'=>[
                'type'=>'varchar',
                'constraint'=>100,
            ],
            'variedad'=>[
                'type'=>'varchar',
                'Constraint'=>100,
                'null'=>true,
            ],
            'fecha_siembra'=>[
                'type'=>'date'
            ],
            'dias_cosecha_estimados'=>[
                'type'=>'int',
                'constraint'=>11,
            ],
            'frecuencia_riego_dias'=>[
                'type'=>'INT',
                'constraint'=>11,
            ],
            'ultimo_riego'=>[
                'type'=>'DATETIME',
                'null'=>true,
            ],
            'estado'=>[
                'type'=>'VARCHAR',
                'constraint'=>50,
            ],
            'created_at'=>[
                'type'=>'DATETIME',
                'null'=>true,
            ],
            'updated_at'=>[
                'type'=>'DATETIME',
                'null'=>true,
            ],
        ]);
        $this->forge->addKey('id',true);
        $this->forge->createTable('cultivos');
    }

    public function down()
    {
        $this->forge->dropTable('cultivos');
    }
}
