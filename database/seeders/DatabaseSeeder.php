<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->command->info("Таблица пользователей загружена данными!\n");

        $this->call(StatusTableSeeder::class);
        $this->command->info("Таблица статусов задач загружена данными!\n");
        
        $this->call(TaskTableSeeder::class);
        $this->command->info("Таблица задач загружена данными!\n");

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
