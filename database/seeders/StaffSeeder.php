<?php

namespace Database\Seeders;

use App\Models\Staff;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        |--------------------------------------------------------------------------
        | Create Staff Teams
        |--------------------------------------------------------------------------
        */
        $seniorTeam = Team::create([
            'name' => 'Dirección',
            'description' => 'Staff Responsable de los diferentes equipos dentro de la división.',
        ]);

        $atcTeam = Team::create([
            'name' => 'Operaciones ATC',
            'description' => 'Responsables de la gestión de servicios de tráfico aereo, incluyendo publicaciones, sectores y procedimientos.',
        ]);

        $eventos = Team::create([
            'name' => 'Entrenamiento',
            'description' => 'Responsables del entrenamiento de los controladores de tráfico aero y material didáctico.',
        ]);

        $eventos = Team::create([
            'name' => 'Eventos',
            'description' => 'Responsables de la gestión y promoción de eventos en la red.',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Create Staff Roles for Default Users
        |--------------------------------------------------------------------------
        */
        $vatmex1 = new Staff;
        $vatmex1->position = 'Director de División';
        $vatmex1->shortcode = 'VATMEX1';
        $vatmex1->description = 'A cargo de todas las actividades relacionadas con la operación de la división, así como su correcto funcionamiento dentro de la red VATSIM.';
        $vatmex1->email = 'mauricio@vatmex.com.mx';
        $seniorTeam->staff()->save($vatmex1);

        $vatmex2 = new Staff;
        $vatmex2->position = 'Subdirector de División';
        $vatmex2->shortcode = 'VATMEX2';
        $vatmex2->description = 'Asiste al director de división y mantendrá contacto activo con la comunidad en general asistiendo a todos los miembros.';
        $vatmex2->email = 'lucio@vatmex.com.mx';
        $seniorTeam->staff()->save($vatmex2);

        $vatmex3 = new Staff;
        $vatmex3->position = 'Director de Operaciones CTA';
        $vatmex3->shortcode = 'VATMEX3';
        $vatmex3->description = 'Responsable de las operaciones CTA, supervisa la correcta aplicación de los procedimientos dentro del espacio aéreo mexicano. Está a cargo de la operación y actualización del programa radar Vatsys dentro del espacio aéreo mexicano.';
        $vatmex3->email = 'gustavo@vatmex.com.mx';
        $seniorTeam->staff()->save($vatmex3);

        $vatmex4 = new Staff;
        $vatmex4->position = 'Director de Adiestramiento';
        $vatmex4->shortcode = 'VATMEX4';
        $vatmex4->description = 'Responsable del adiestramiento a controladores. Supervisa la aplicación del programa de entrenamiento a controladores y está a cargo de la asignación de instructores.';
        $vatmex4->email = 'adiestramiento@vatmex.com.mx';
        $seniorTeam->staff()->save($vatmex4);

        /*
        |--------------------------------------------------------------------------
        | Assign Default Staff
        |--------------------------------------------------------------------------
        */
        #$liveUser = User::where('cid', 1303345)->firstOrFail();
        #$vatmex3->user()->associate($liveUser);
        #$vatmex3->save();
    }
}
