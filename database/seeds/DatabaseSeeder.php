<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
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
         $this->call(CursoSeeder::class);
        

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
