<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CreateRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('description');
        });

        Schema::create('role_user', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('role_id');
        });

        Schema::create('permission', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::create('role_permission', function (Blueprint $table){
            $table->id();
            $table->integer('role_id');
            $table->integer('permission_id');
        });

        DB::table('role')->insert([
            [
                'id' => 1,
                'name' => 'admin',
                'description' => 'This is admin'
            ],
            [
                'id' => 2,
                'name' => 'draw_diagram',
                'description' => 'This is description',
            ]
        ]);

        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Quach Hoai Nam',
                'email' => 'qhnam.67@gmail.com',
                'password' => Hash::make('nam631996')
            ],
            [
                'id' => 2,
                'name' => 'Quach Hoai Nam 2',
                'email' => 'qhnam.2@gmail.com',
                'password' => Hash::make('nam631996')
            ],
            [
                'id' => 3,
                'name' => 'Quach Hoai Nan',
                'email' => 'qhnam.3@gmail.com',
                'password' => Hash::make('nam631996')
            ]
        ]);

        DB::table('role_user')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'role_id' => 1,
            ],
            [
                'id' => 2,
                'user_id' => 2,
                'role_id' => 1,
            ],
            [
                'id' => 3,
                'user_id' => 3,
                'role_id' => 2,
            ]
        ]);

        $permissionData = [];
        $rolePermissionData = [];
        foreach (\App\Models\Permission::allKey() as $key => $item)
        {
            $permissionData[] = [
                'id' => $key+1,
                'name' => $item
            ];

            $rolePermissionData[] = [
                'permission_id' => $key+1,
                'role_id' => 1,
            ];
        }

        DB::table('permission')->insert($permissionData);

        DB::table('role_permission')->insert($rolePermissionData);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role');
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('role_permission');
        Schema::dropIfExists('permission');
    }
}
