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
        Schema::create('source_code_claims', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->string('whatsapp_number');
            $table->string('platform'); // direct_transfer, mayar, lynk_id, codecanyon, fastwork, shopee, tokopedia, other
            $table->string('platform_other')->nullable();
            $table->string('order_id')->nullable(); // Invoice / Transaction ID
            $table->date('purchase_date')->nullable();
            $table->unsignedBigInteger('price_paid')->nullable();
            $table->string('proof_file'); // Path to proof receipt
            $table->tinyInteger('rating')->default(5);
            $table->string('position')->nullable(); // Jabatan / Profesi
            $table->string('company')->nullable(); // Usaha / Perusahaan
            $table->text('testimonial_content');
            $table->string('avatar')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('admin_note')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->foreignId('testimonial_id')->nullable()->constrained('testimonials')->onDelete('set null');
            $table->string('license_key')->nullable()->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('source_code_claims');
    }
};
