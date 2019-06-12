<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Line;

class LinesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        if (Line::count() == 0) {            
            for ($i = 1; $i<=6; $i++){
				Line::create([
					'title'           => '1-Prestation intervention',
					'description'          => 'Profil '.$i,
					'points'       => (11+$i)
				]);
			}
			
			for ($i = 1; $i<=6; $i++){
				Line::create([
					'title'           => '2-ES Prestation à distance',
					'description'          => 'Opération '.$i,
					'points'       => (14+$i)
				]);
			}
			
			for ($i = 1; $i<=2; $i++){
				Line::create([
					'title'           => '3-ES Supervision à distance',
					'description'          => 'Supervision '.$i,
					'points'       => (11+$i)
				]);
			}
			
			for ($i = 1; $i<=2; $i++){
				Line::create([
					'title'           => '4-ES Support N2',
					'description'          => 'Support n2 '.$i,
					'points'       => (13+$i)
				]);
			}
			
			Line::create([
				'title'           => '5-ES Support UDesk',
				'description'          => 'Support u1',
				'points'       => (16)
			]);

			
			for ($i = 1; $i<=4; $i++){
				Line::create([
					'title'           => 'Gestion de proximité',
					'description'          => 'Gouv '.$i,
					'points'       => (9+$i)
				]);
			}
			
			for ($i = 1; $i<=4; $i++){
				Line::create([
					'title'           => 'Sécurité',
					'description'          => 'Sécu '.$i,
					'points'       => (11+$i)
				]);
			}
			
			for ($i = 1; $i<=4; $i++){
				Line::create([
					'title'           => 'Mise en place',
					'description'          => 'Mep '.$i,
					'points'       => (11+$i)
				]);
			}
        }
    }
}
