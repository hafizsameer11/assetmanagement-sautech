<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('client_name')->nullable();
            $table->string('client_code')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('company_name');
            $table->string('contact_person');
            $table->string('email');
            $table->date('audit_start_date');
            $table->date('due_date');
            $table->enum('status', ['Planning', 'Proposal', 'In Progress', 'Completed']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
