<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //insert user
      DB::table('users')->insert([
         'name' => 'Admin',
         'email' => 'admin@admin.com',
         'password' => bcrypt('admin123'),
     ]);

     //insert satuans
     DB::table('satuans')->insert([
       ['name' => 'TABLET',],
       ['name' => 'KAPSUL',],
       ['name' => 'BOTOL',],
       ['name' => 'AMPU',],
       ['name' => 'TUBE',],
       ['name' => 'KOTAK',],
       ['name' => 'KAPLET',],
       ['name' => 'BUNGKUS',],
  ]);

  DB::table('jenis')->insert([
    ['name' => 'OBAT',],
    ['name' => 'SIRUP/LARUTAN',],
    ['name' => 'NAFZA',],
    ['name' => 'INJEKSI',],
    ['name' => 'OBAT LUAR',],
    ['name' => 'OBAT GIGI',],
]);




    }
}
