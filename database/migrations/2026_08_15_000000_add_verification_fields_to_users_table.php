<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Only adds what's genuinely missing: uniqueness on ICN/Telephone, and an
 * audit trail for who verified whom and when.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('Users', function (Blueprint $table) {
            // Only add ->unique() if these aren't already unique in your
            // schema — check first with `SHOW INDEX FROM Users;` in your
            // DB. If either already has a unique index, remove that line.
            $table->unique('ICN');
            $table->unique('Telephone');

            $table->timestamp('VerifiedAt')->nullable()->after('IsVerified');
            $table->unsignedInteger('VerifiedBy')->nullable()->after('VerifiedAt');
            $table->foreign('VerifiedBy')->references('IdUser')->on('Users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('Users', function (Blueprint $table) {
            $table->dropForeign(['VerifiedBy']);
            $table->dropColumn(['VerifiedAt', 'VerifiedBy']);
            $table->dropUnique(['ICN']);
            $table->dropUnique(['Telephone']);
        });
    }
};
