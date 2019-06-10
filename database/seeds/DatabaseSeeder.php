<?php

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
        $this->truncarTablas([
            'postulaciones_practicas',
            'practicasprofesionales',
            'users'
        ]);

        $this->call(UsersTableSeeder::class);
        $this->call(PracticasprofesionalesTableSeeder::class);
        $this->call(PostulacionPracticaSeeder::class);
    }

    protected function truncarTablas(array $tables)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
