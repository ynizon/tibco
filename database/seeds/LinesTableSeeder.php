<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use TCG\Voyager\Models\DataRow;
use TCG\Voyager\Models\DataType;
use TCG\Voyager\Models\Permission;
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
		//Data Type
		$dataType = $this->dataType('slug', 'lines');		
		if (!$dataType->exists) {
            $dataType->fill([
				'slug'                  => 'lines',
                'name'                  => 'lines',
                'display_name_singular' => __('line'),
                'display_name_plural'   => __('Lines'),
                'icon'                  => 'voyager-wand',
                'model_name'            => 'App\\Line',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }
		
		//Data Rows
		$pageDataType = DataType::where('slug', 'lines')->firstOrFail();
        $dataRow = $this->dataRow($pageDataType, 'title');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('Titre'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 1,
            ])->save();
        }
		
		$dataRow = $this->dataRow($pageDataType, 'description');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('Description'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 2,
            ])->save();
        }
		
		$dataRow = $this->dataRow($pageDataType, 'points');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('Points'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 3,
            ])->save();
        }
		
		 //Permissions
        Permission::generateFor('lines');
		
        if (Line::count() == 0) {            
            for ($i = 1; $i<=6; $i++){
				Line::create([
					'title'           => 'Prestation intervention',
					'description'          => 'Profil '.$i,
					'points'       => (11+$i),
					'order'=>(100+$i)
				]);
			}
			
			for ($i = 1; $i<=6; $i++){
				Line::create([
					'title'           => 'ES Prestation à distance',
					'description'          => 'Opération '.$i,
					'points'       => (14+$i),
					'order'=>(200+$i)
				]);
			}
			
			for ($i = 1; $i<=2; $i++){
				Line::create([
					'title'           => 'ES Supervision à distance',
					'description'          => 'Supervision '.$i,
					'points'       => (11+$i),
					'order'=>(300+$i)
				]);
			}
			
			for ($i = 1; $i<=2; $i++){
				Line::create([
					'title'           => 'ES Support N2',
					'description'          => 'Support n2 '.$i,
					'points'       => (13+$i),
					'order'=>(400+$i)
				]);
			}
			
			Line::create([
				'title'           => 'ES Support UDesk',
				'description'          => 'Support u1',
				'points'       => (16),
				'order'=>(500+$i)
			]);

			
			for ($i = 1; $i<=4; $i++){
				Line::create([
					'title'           => 'Gestion de proximité',
					'description'          => 'Gouv '.$i,
					'points'       => (9+$i),
					'order'=>(600+$i)
				]);
			}
			
			for ($i = 1; $i<=4; $i++){
				Line::create([
					'title'           => 'Gouvernance',
					'description'          => 'Gouvernance '.$i,
					'points'       => (11+$i),
					'order'=>(700+$i)
				]);
			}
			
			for ($i = 1; $i<=4; $i++){
				Line::create([
					'title'           => 'SécuTG',
					'description'          => 'Sécu '.$i,
					'points'       => (11+$i),
					'order'=>(800+$i)
				]);
			}
			
			for ($i = 1; $i<=4; $i++){
				Line::create([
					'title'           => 'Mise en place du contrat',
					'description'          => 'Mep '.$i,
					'points'       => (11+$i),
					'order'=>(900+$i)
				]);
			}
        }
    }
	
	
    /**
     * [dataRow description].
     *
     * @param [type] $type  [description]
     * @param [type] $field [description]
     *
     * @return [type] [description]
     */
    protected function dataRow($type, $field)
    {
        return DataRow::firstOrNew([
                'data_type_id' => $type->id,
                'field'        => $field,
            ]);
    }

    /**
     * [dataType description].
     *
     * @param [type] $field [description]
     * @param [type] $for   [description]
     *
     * @return [type] [description]
     */
    protected function dataType($field, $for)
    {
        return DataType::firstOrNew([$field => $for]);
    }
}
