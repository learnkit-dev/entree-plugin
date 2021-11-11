<?php namespace LearnKit\Entree\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateLearnkitEntreeLoginLogs extends Migration
{
    public function up()
    {
        Schema::create('learnkit_entree_login_logs', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->text('attributes')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('learnkit_entree_login_logs');
    }
}
