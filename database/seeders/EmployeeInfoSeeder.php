<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FormInput;
class EmployeeInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        $formStructure =  array(
            'name' => 'employee_infos',
            'input_field' => array(
                
             
                array(
                    'name' => 'name',
                    'type' => 'text',
                    'class' => 'form-control',
                    'id' => null,
                    'label' => 'Name',
                    'placeholder' => 'Name',
                    'value' => null,
                    'required' => null,
                    'tableshow' => true,
                    'inputShow' => true,
                    'unique' => false,
                    'validation' => 'required|max:100|min:2',
                ),
                array(
                    'name' => 'designation',
                    'type' => 'text',
                    'class' => 'form-control',
                    'id' => null,
                    'label' => 'Designation',
                    'placeholder' => 'Designation',
                    'value' => null,
                    'required' => null,
                    'tableshow' => true,
                    'inputShow' => true,
                    'unique' => false,
                    'validation' => 'nullable|max:100',
                ),
                array(
                    'name' => 'district',
                    'type' => 'text',
                    'class' => 'form-control',
                    'id' => null,
                    'label' => 'District',
                    'placeholder' => 'District',
                    'value' => null,
                    'required' => null,
                    'tableshow' => true,
                    'inputShow' => true,
                    'unique' => false,
                    'validation' => 'nullable|max:100',
                ),
                array(
                    'name' => 'thana',
                    'type' => 'text',
                    'class' => 'form-control',
                    'id' => null,
                    'label' => 'Thana',
                    'placeholder' => 'Thana',
                    'value' => null,
                    'required' => null,
                    'tableshow' => true,
                    'inputShow' => true,
                    'unique' => false,
                    'validation' => 'nullable|max:100',
                ),
                array(
                    'name' => 'phone',
                    'type' => 'text',
                    'class' => 'form-control',
                    'id' => null,
                    'label' => 'Phone',
                    'placeholder' => 'Phone',
                    'value' => null,
                    'table' => 'employee_infos',
                    'unique' => true,
                    'required' => null,
                    'tableshow' => true,
                    'inputShow' => true,
                    'validation' => 'required',
                ),
                array(
                    'name' => 'nid',
                    'type' => 'text',
                    'class' => 'form-control',
                    'id' => null,
                    'label' => 'Nid',
                    'placeholder' => 'Nid',
                    'value' => null,
                    'required' => null,
                    'tableshow' => true,
                    'inputShow' => true,
                    'unique' => false,
                    'validation' => 'nullable|max:100',
                ),
                array(
                    'name' => 'status',
                    'type' => 'select',
                    'class' => 'form-control select2',
                    'id' => null,
                    'label' => 'Status',
                    'placeholder' => 'Select Status',
                    'value' => null,
                    'required' => null,
                    'unique' => false,
                    'tableshow' => true,
                    'inputShow' => true,
                    'foreignTable' => 'statuses',
                    'customMethod' => null,
                    'validation' => 'nullable',

                ),
            )
        );
        $formInfo = new FormInput();
        $formInfo->navigation_id = null;
        $formInfo->table = $formStructure['name'];
        $formInfo->input = json_encode($formStructure['input_field']);
        $formInfo->save();
    }
}
