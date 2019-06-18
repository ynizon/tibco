<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use TCG\Voyager\Models\DataRow;
use TCG\Voyager\Models\DataType;
use TCG\Voyager\Models\Permission;
use App\Customer;

class CustomersTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
		//Data Type
		$dataType = $this->dataType('slug', 'customers');		
		 if (!$dataType->exists) {
            $dataType->fill([
				'slug'                  => 'customers',
                'name'                  => 'customers',
                'display_name_singular' => __('Contact'),
                'display_name_plural'   => __('Contacts'),
                'icon'                  => 'voyager-user',
                'model_name'            => 'App\\Customer',
                'controller'            => 'App\\Http\\Controllers\\AdminCustomersController',
                'generate_permissions'  => 1,
				'server_side'  => 1,
                'description'           => '',
            ])->save();
        }
		
		//Data Rows
		$pageDataType = DataType::where('slug', 'customers')->firstOrFail();
		
		$dataRow = $this->dataRow($pageDataType, 'user_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('voyager::seeders.data_rows.author'),
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 0,
                'delete'       => 1,
                'order'        => 2,
            ])->save();
        }

		
		foreach (array("first_name"=>"Prénom","last_name"=>"Nom","phone"=>"Téléphone","email"=>"Email","grade"=>"Fonction","company"=>"Société","margin"=>"Marge supplémentaire (%)" ) as $field=>$name){			
			$dataRow = $this->dataRow($pageDataType, $field);
			if (!$dataRow->exists) {
				$dataRow->fill([
					'type'         => 'text',
					'display_name' => $name,
					'required'     => 1,
					'browse'       => 1,
					'read'         => 1,
					'edit'         => 1,
					'add'          => 1,
					'delete'       => 1,
					'order'        => 1,
				])->save();
			}
		}
		
		$dataRow = $this->dataRow($pageDataType, 'customer_belongsto_user_relationship');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'relationship',
                'display_name' => 'Auteur',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => [
                    'model'       => 'App\\User',
                    'table'       => 'users',
                    'type'        => 'belongsTo',
                    'column'      => 'user_id',
                    'key'         => 'id',
                    'label'       => 'name',
                    'pivot_table' => 'categories',
                    'pivot'       => '0',
                    'taggable'    => '0',
                ],
                'order'        => 7,
            ])->save();
        }

		 //Permissions
        Permission::generateFor('customers');
		
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
