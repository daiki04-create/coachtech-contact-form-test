<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
        $table->id();
        // foreignIdでcategoriesテーブルのidと紐付け（本番想定の整合性維持）
        $table->foreignId('category_id')->constrained()->cascadeOnDelete();
        $table->string('first_name', 255);
        $table->string('last_name', 255);
        $table->tinyInteger('gender')->comment('1:男性, 2:女性, 3:その他');
        $table->string('email', 255);
        $table->string('tell', 255);
        $table->string('address', 255);
        $table->string('building', 255)->nullable(); // 建物名は任意項目
        $table->text('detail'); // お問い合わせ内容は長文を想定しtext型
        $table->timestamp('created_at')->useCurrent();
        $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
