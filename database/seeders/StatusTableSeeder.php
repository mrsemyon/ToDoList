<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([
            [ 'code' => 'pending', 'name' => 'В ожидании'],
            [ 'code' => 'in_developing', 'name' => 'В разработке'],
            [ 'code' => 'on_testing', 'name' => 'На тестировании'],
            [ 'code' => 'on_checking', 'name' => 'На проверке'],
            [ 'code' => 'done', 'name' => 'Выполнено'],
        ]);
    }
}
