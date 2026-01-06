<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('paket_id')->nullable()->constrained()->cascadeOnDelete();
            $table->enum('tipe_paket', ['kg', 'pcs'])->nullable();
            $table->integer('jumlah');
            $table->enum('pickup', ['antar_sendiri', 'dijemput']);
            $table->decimal('jarak_km', 5, 2)->nullable();
            $table->integer('ongkir')->default(0);
            $table->decimal('customer_latitude', 10, 7)->nullable();
            $table->decimal('customer_longitude', 10, 7)->nullable();
            $table->integer('total_harga');
            $table->integer('antrian');
            $table->enum('status', [
                'menunggu',
                'diproses',
                'selesai',
                'diambil',
            ])->default('menunggu');
            $table->enum('metode_pembayaran', ['cash', 'qris'])->default('cash');
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending');
            $table->string('payment_token')->nullable()->unique();
            $table->timestamp('payment_token_expires_at')->nullable();
            $table->string('qr_code_path')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
