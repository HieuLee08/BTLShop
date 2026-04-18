<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // --- CÁC BẢNG ĐỘC LẬP (TẠO TRƯỚC) ---
        Schema::create('tbl_admin', function (Blueprint $table) {
            $table->integer('adminId')->autoIncrement();
            $table->string('adminName', 255);
            $table->string('adminEmail', 255);
            $table->string('adminUser', 255);
            $table->string('adminPass', 255);
            $table->integer('level');
        });

        Schema::create('tbl_customer', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('name', 335);
            $table->string('email', 355);
            $table->string('password', 355);
            $table->string('phone', 30);
            $table->string('address', 355);
        });

        Schema::create('tbl_category', function (Blueprint $table) {
            $table->integer('catId')->autoIncrement();
            $table->string('catName', 255);
            $table->integer('type');
        });

        Schema::create('tbl_nhacungcap', function (Blueprint $table) {
            $table->integer('nccId')->autoIncrement();
            $table->string('nccName', 255);
        });

        Schema::create('tbl_tacgia', function (Blueprint $table) {
            $table->integer('tacgiaId')->autoIncrement();
            $table->string('tacgiaName', 255);
        });

        Schema::create('tbl_slides', function (Blueprint $table) {
            $table->integer('slId')->autoIncrement();
            $table->string('slTitle', 255);
            $table->string('slLink', 355);
            $table->string('slImage', 255);
            $table->integer('slActive');
            $table->string('slTarget', 255);
        });

        // --- CÁC BẢNG PHỤ THUỘC (CÓ KHÓA NGOẠI) ---

        Schema::create('tbl_attributes', function (Blueprint $table) {
            $table->integer('atbId')->autoIncrement();
            $table->string('atbName', 255);
            $table->integer('type');
            $table->integer('catId');
            $table->foreign('catId')->references('catId')->on('tbl_category');
        });

        Schema::create('tbl_products', function (Blueprint $table) {
            $table->integer('proId')->autoIncrement();
            $table->string('proName', 255);
            $table->string('proImage', 255);
            $table->integer('proPrice');
            $table->text('proContent');
            $table->integer('proSale');
            $table->integer('proNewBook');
            $table->integer('proFeatured');
            $table->integer('catId');
            $table->integer('nccId');
            $table->integer('tacgiaId');
            
            $table->foreign('catId')->references('catId')->on('tbl_category');
            $table->foreign('nccId')->references('nccId')->on('tbl_nhacungcap');
            $table->foreign('tacgiaId')->references('tacgiaId')->on('tbl_tacgia');
        });

        Schema::create('tbl_products_images', function (Blueprint $table) {
            $table->integer('piId')->autoIncrement();
            $table->string('piImage', 255);
            $table->integer('proId');
            $table->foreign('proId')->references('proId')->on('tbl_products');
        });

        Schema::create('tbl_products_attributes', function (Blueprint $table) {
            $table->integer('paId')->autoIncrement();
            $table->integer('proId');
            $table->integer('atbId');
            $table->foreign('proId')->references('proId')->on('tbl_products');
            $table->foreign('atbId')->references('atbId')->on('tbl_attributes');
        });

        Schema::create('tbl_transactions', function (Blueprint $table) {
            $table->integer('tstId')->autoIncrement();
            $table->integer('cusId');
            $table->integer('tstTotalMoney');
            $table->string('tstNote', 355);
            $table->foreign('cusId')->references('id')->on('tbl_customer');
        });

        Schema::create('tbl_orders', function (Blueprint $table) {
            $table->integer('odId')->autoIncrement();
            $table->integer('tstId');
            $table->integer('proId');
            $table->integer('odQuantity');
            $table->integer('odPrice');
            $table->foreign('tstId')->references('tstId')->on('tbl_transactions');
            $table->foreign('proId')->references('proId')->on('tbl_products');
        });

        Schema::create('tbl_inbox', function (Blueprint $table) {
            $table->integer('ibId')->autoIncrement();
            $table->integer('tstId');
            $table->integer('cusId');
            $table->timestamp('ibDate')->useCurrent();
            $table->integer('ibQuantity');
            $table->integer('ibPrice');
            $table->string('cusName', 255);
            $table->string('cusAddress', 355);
            $table->integer('cusPhone');
            $table->string('ibStatus', 255);
            $table->foreign('cusId')->references('id')->on('tbl_customer');
        });

        Schema::create('tbl_detail_inbox', function (Blueprint $table) {
            $table->integer('diId')->autoIncrement();
            $table->integer('proId');
            $table->integer('odQuantity');
            $table->integer('cusId');
            $table->integer('ibId');
            $table->foreign('proId')->references('proId')->on('tbl_products');
            $table->foreign('cusId')->references('id')->on('tbl_customer');
        });
    }

    public function down()
    {
        // Xóa bảng theo thứ tự ngược lại để không bị lỗi khóa ngoại
        Schema::dropIfExists('tbl_detail_inbox');
        Schema::dropIfExists('tbl_inbox');
        Schema::dropIfExists('tbl_orders');
        Schema::dropIfExists('tbl_transactions');
        Schema::dropIfExists('tbl_products_attributes');
        Schema::dropIfExists('tbl_products_images');
        Schema::dropIfExists('tbl_products');
        Schema::dropIfExists('tbl_attributes');
        Schema::dropIfExists('tbl_slides');
        Schema::dropIfExists('tbl_tacgia');
        Schema::dropIfExists('tbl_nhacungcap');
        Schema::dropIfExists('tbl_category');
        Schema::dropIfExists('tbl_customer');
        Schema::dropIfExists('tbl_admin');
    }
};