<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Users', function (Blueprint $table) {
            $table->bigIncrements('IdUser');
            $table->string('Username', 250)->nullable();
            $table->string('FirstName', 250)->nullable();
            $table->string('LastName', 250)->nullable();
            $table->string('BirthDate', 50)->nullable();
            $table->string('Gender', 250)->nullable();
            $table->string('Email', 250)->nullable();
            $table->string('ICN', 250)->nullable();
            $table->string('Telephone', 50)->nullable();
            $table->text('Password')->nullable();
            $table->integer('IdRole')->nullable();
            $table->text('FacebookId')->nullable();
            $table->text('GoogleId')->nullable();
            $table->text('RefreshToken')->nullable();
            $table->text('ProfilePicture')->nullable();
            $table->string('CreationDate', 50)->nullable();
            $table->integer('IsVerified')->nullable();
            $table->integer('IsPremuim')->nullable();
            $table->date('PremiumExpiry')->nullable();
            $table->text('IdentityPicture')->nullable();
            $table->integer('IsBusinessAccount')->nullable();
            $table->string('ICNBusiness', 250)->nullable();
            $table->text('BusinessVerificationPicture')->nullable();
            $table->unsignedBigInteger('IdState')->nullable();
            $table->unsignedBigInteger('IdCountry')->nullable();
            $table->text('Location')->nullable();
            $table->date('LastConnection')->nullable();
            $table->integer('Active')->nullable();
            $table->string('City', 100)->nullable();
            $table->boolean('EmailConfirmed')->default(true);
            $table->longText('RecentlyViewed')->nullable();

            $table->index('IdState', 'FK_Users_States');
            $table->index('IdCountry', 'FK_Users_Countries');
            $table->index('IdRole', 'FK_Users_Role');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Users');
    }
};