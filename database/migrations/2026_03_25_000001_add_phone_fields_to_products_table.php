<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('brand')->after('name');
            $table->string('sku')->nullable()->unique()->after('brand');
            $table->string('color')->nullable()->after('sku');
            $table->string('ram')->nullable()->after('color');
            $table->string('rom')->nullable()->after('ram');
            $table->string('screen_size')->nullable()->after('rom');
            $table->string('battery')->nullable()->after('screen_size');
            $table->unsignedInteger('stock')->default(0)->after('battery');

            $table->index('brand');
            $table->index('color');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex(['brand']);
            $table->dropIndex(['color']);
            $table->dropUnique(['sku']);
            $table->dropColumn(['brand', 'sku', 'color', 'ram', 'rom', 'screen_size', 'battery', 'stock']);
        });
    }
};
