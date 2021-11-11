<?php namespace LearnKit\Entree\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateLearnkitEntreeLoginLogs extends Migration
{
    public function up()
    {
        Schema::table('learnkit_entree_login_logs', function($table)
        {
            $table->renameColumn('attributes', 'login_attributes');
        });
    }
    
    public function down()
    {
        Schema::table('learnkit_entree_login_logs', function($table)
        {
            $table->renameColumn('login_attributes', 'attributes');
        });
    }
}
