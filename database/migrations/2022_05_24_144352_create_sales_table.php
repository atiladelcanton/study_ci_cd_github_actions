<?php

use App\Models\Client;
use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->enum('status', [
                'open',
                'paid',
                'canceled'
            ])->default('open')->nullable();
            $table->foreignIdFor(Client::class)->constrained();
            $table->foreignIdFor(Product::class)->constrained();
            $table->integer('quantity')->default(1);
            $table->double('amount', 10, 2);
            $table->date('date_requested')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
};
