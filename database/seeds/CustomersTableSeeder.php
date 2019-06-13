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
                'display_name_singular' => __('customer'),
                'display_name_plural'   => __('customers'),
                'icon'                  => 'voyager-user',
                'model_name'            => 'App\\Customer',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }
		
		//Data Rows
		$pageDataType = DataType::where('slug', 'customers')->firstOrFail();
		foreach (array("first_name"=>"Prénom","last_name"=>"Nom","phone"=>"Téléphone","email"=>"Email","grade"=>"Fonction","company"=>"Société") as $field=>$name){			
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
