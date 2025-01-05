<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeColumnInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $users = User::where('is_client', false)->get();

        Schema::table('users', function (Blueprint $table) {
            $table->string('type')->after('password')->default(User::TYPE_CLIENT);
            $table->dropColumn('is_client');
        });

        foreach ($users as $user) {
            $user->update(['type' => User::TYPE_ADMIN]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $users = User::where('type', User::TYPE_ADMIN)->get();

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->boolean('is_client')->default(true)->after('password');
        });

        foreach ($users as $user) {
            $user->update(['is_client' => false]);
        }
    }
}
