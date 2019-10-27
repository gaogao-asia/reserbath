<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_menu')->insert([
        [
            'id'        => 1,
            'parent_id' => 0,
            'title'     => 'Dashboard',
            'icon'      => 'fa-bar-chart',
            'uri'       => '/',
        ],
        [
            'id'        => 2,
            'parent_id' => 0,
            'title'     => 'Admin',
            'icon'      => 'fa-tasks',
            'uri'       => '',
        ],
        [
            'id'        => 3,
            'parent_id' => 2,
            'title'     => 'Users',
            'icon'      => 'fa-users',
            'uri'       => 'auth/users',
        ],
        [
            'id'        => 4,
            'parent_id' => 2,
            'title'     => 'Roles',
            'icon'      => 'fa-user',
            'uri'       => 'auth/roles',
        ],
        [
            'id'        => 5,
            'parent_id' => 2,
            'title'     => 'Permission',
            'icon'      => 'fa-ban',
            'uri'       => 'auth/permissions',
        ],
        [
            'id'        => 6,
            'parent_id' => 2,
            'title'     => 'Menu',
            'icon'      => 'fa-bars',
            'uri'       => 'auth/menu',
        ],
        [
            'id'        => 7,
            'parent_id' => 2,
            'title'     => 'Operation log',
            'icon'      => 'fa-history',
            'uri'       => 'auth/logs',
        ],
      ]);

      DB::table('admin_permissions')->insert([
        [
            'name'        => 'All permission',
            'slug'        => '*',
            'http_method' => '',
            'http_path'   => '*',
        ],
        [
            'name'        => 'Dashboard',
            'slug'        => 'dashboard',
            'http_method' => 'GET',
            'http_path'   => '/',
        ],
        [
            'name'        => 'Login',
            'slug'        => 'auth.login',
            'http_method' => '',
            'http_path'   => '/auth/login
/auth/logout',
        ],
        [
            'name'        => 'User setting',
            'slug'        => 'auth.setting',
            'http_method' => 'GET,PUT',
            'http_path'   => '/auth/setting',
        ],
        [
            'name'        => 'Auth management',
            'slug'        => 'auth.management',
            'http_method' => '',
            'http_path'   => '/auth/roles
/auth/permissions
/auth/menu
/auth/logs',
        ],
      ]);

        DB::table('admin_users')->insert([
        [
            'username' => 'admin',
            'password' => Hash::make('adminadmin'),
            'name'     => 'Administrator',
        ],
      ]);

        DB::table('admin_roles')->insert([
        [
          'name'     => 'Administrator',
          'slug'     => 'administrator',
        ],
      ]);

        DB::table('admin_role_users')->insert([
        [
          'role_id' => 1,
          'user_id' => 1,
        ],
      ]);

        DB::table('admin_role_menu')->insert([
        [
          'role_id' => 1,
          'menu_id' => 2,
        ],
      ]);

        DB::table('admin_role_permissions')->insert([
        [
          'role_id'       => 1,
          'permission_id' => 1,
        ],
      ]);
    }
}
