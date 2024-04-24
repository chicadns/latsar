<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeLdapClientCertsNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (Schema::hasColumn('settings', 'ldap_client_tls_cert')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->text('ldap_client_tls_cert')->nullable()->default(null)->change();
            });
        } else {
            Schema::table('settings', function (Blueprint $table) {
                $table->text('ldap_client_tls_cert')->nullable()->default(null);
            });
        }

        if (Schema::hasColumn('settings', 'ldap_client_tls_key')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->text('ldap_client_tls_key')->nullable()->default(null)->change();
            });
        } else {
            Schema::table('settings', function (Blueprint $table) {
                $table->text('ldap_client_tls_key')->nullable()->default(null);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('ldap_client_tls_cert');
            $table->dropColumn('ldap_client_tls_key');
        });
    }
}
