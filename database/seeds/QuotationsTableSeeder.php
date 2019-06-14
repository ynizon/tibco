<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataRow;
use TCG\Voyager\Models\DataType;
use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;
use TCG\Voyager\Models\Permission;
use App\Quotation;

class QuotationsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        //Data Type
        $dataType = $this->dataType('slug', 'quotations');
        if (!$dataType->exists) {
            $dataType->fill([
				'slug'                  => 'quotations',
                'name'                  => 'quotations',
                'display_name_singular' => __('Devis'),
                'display_name_plural'   => __('Devis'),
                'icon'                  => 'voyager-news',
                'model_name'            => 'App\\Quotation',
                'controller'            => '',
                'generate_permissions'  => 1,
				'server_side'  => 1,
                'description'           => '',
				'details'=>array(
					"order_column"=>"",
					"order_display_column"=>"",
					"order_direction"=>"desc",
					"default_search_key"=>"customer_id",
					"scope"=>""
				),
            ])->save();
        }

        //Data Rows
        $postDataType = DataType::where('slug', 'quotations')->firstOrFail();
        $dataRow = $this->dataRow($postDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => __('voyager::seeders.data_rows.id'),
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($postDataType, 'user_id');
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

        $dataRow = $this->dataRow($postDataType, 'customer_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('Client'),
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'order'        => 3,
            ])->save();
        }

		$dataRow = $this->dataRow($postDataType, 'note');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => __('Note'),
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 5,
            ])->save();
        }
		
        $dataRow = $this->dataRow($postDataType, 'details');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => __('Details'),
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 5,
            ])->save();
        }

		$dataRow = $this->dataRow($postDataType, 'signature');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('Signature'),
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 8,
            ])->save();
        }

        $dataRow = $this->dataRow($postDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.created_at'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 12,
            ])->save();
        }

        $dataRow = $this->dataRow($postDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.updated_at'),
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 13,
            ])->save();
        }


		$dataRow = $this->dataRow($postDataType, 'quotation_belongsto_customer_relationship');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'relationship',
                'display_name' => 'Client',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => [
                    'model'       => 'App\\Customer',
                    'table'       => 'customers',
                    'type'        => 'belongsTo',
                    'column'      => 'customer_id',
                    'key'         => 'id',
                    'label'       => 'company',
                    'pivot_table' => 'categories',
                    'pivot'       => '0',
                    'taggable'    => '0',
                ],
                'order'        => 6,
            ])->save();
        }
		
		$dataRow = $this->dataRow($postDataType, 'quotation_belongsto_user_relationship');
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
        Permission::generateFor('quotations');

    }

    /**
     * [post description].
     *
     * @param [type] $slug [description]
     *
     * @return [type] [description]
     */
    protected function findPost($slug)
    {
        return Post::firstOrNew(['slug' => $slug]);
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
