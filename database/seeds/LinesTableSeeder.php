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
					'title'           => '6-Gestion de proximité',
					'description'          => 'Gouv '.$i,
					'points'       => (9+$i)
				]);
			}
			
			for ($i = 1; $i<=4; $i++){
				Line::create([
					'title'           => '7-Sécurité',
					'description'          => 'Sécu '.$i,
					'points'       => (11+$i)
				]);
			}
			
			for ($i = 1; $i<=4; $i++){
				Line::create([
					'title'           => '8-Mise en place',
					'description'          => 'Mep '.$i,
					'points'       => (11+$i)
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
