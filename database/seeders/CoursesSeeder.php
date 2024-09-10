<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;

class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Course::insert([
            ['course_name' => 'Análise e Desenvolvimento de Software', 'course_abbreviation' => 'ADS'],
            ['course_name' => 'Administração', 'course_abbreviation' => 'ADM'],
            ['course_name' => 'Arquitetura e Urbanismo', 'course_abbreviation' => 'ARQ'],
            ['course_name' => 'Ciências Contábeis', 'course_abbreviation' => 'CCO'],
            ['course_name' => 'Engenharia Civil', 'course_abbreviation' => 'CIV'],
            ['course_name' => 'Direito', 'course_abbreviation' => 'DIR'],
            ['course_name' => 'Engenharia Ambiental', 'course_abbreviation' => 'EAM'],
            ['course_name' => 'Engenharia da Computação', 'course_abbreviation' => 'ECO'],
            ['course_name' => 'Engenharia da Computação', 'course_abbreviation' => 'ENF'],
            ['course_name' => 'Engenharia Química', 'course_abbreviation' => 'ENQ'],
            ['course_name' => 'Farmácia', 'course_abbreviation' => 'FAR'],
            ['course_name' => 'Fisioterapia', 'course_abbreviation' => 'FISIO'],
            ['course_name' => 'Nutrição', 'course_abbreviation' => 'NUT'],
            ['course_name' => 'Odontologia', 'course_abbreviation' => 'ODO'],
            ['course_name' => 'Psicologia', 'course_abbreviation' => 'PSI'],
            ['course_name' => 'Medicina Veterinária', 'course_abbreviation' => 'VET'],
            ]);
    }
}
