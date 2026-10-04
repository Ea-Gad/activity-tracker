<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_updates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activity_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained();
            $table->string('performed_by_name');
            $table->string('performed_by_role');
            $table->enum('status', ['pending', 'done'])->default('pending');
            $table->text('remark')->nullable();
            $table->date('activity_date');
            $table->timestamp('performed_at')->useCurrent();
            $table->timestamps();

            $table->index(['activity_id', 'activity_date']);
            $table->index(['user_id', 'performed_at']);
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_updates');
    }
};