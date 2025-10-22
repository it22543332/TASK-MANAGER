<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('tasks', function (Blueprint $table) {
        if (!Schema::hasColumn('tasks', 'status')) {
            $table->enum('status', ['pending','in_progress','done'])->default('pending');
        }
        if (!Schema::hasColumn('tasks', 'priority')) {
            $table->enum('priority', ['low','medium','high'])->default('medium');
        }
        if (!Schema::hasColumn('tasks', 'due_date')) {
            $table->date('due_date')->nullable();
        }
    });
}

public function down()
{
    Schema::table('tasks', function (Blueprint $table) {
        $table->dropColumn(['status','priority','due_date']);
    });
}

};
