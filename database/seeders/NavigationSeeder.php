<?php

namespace Database\Seeders;

use App\Models\CompanyCategory;
use App\Models\CompanyResource;
use App\Models\FormInput;
use App\Models\Navigation;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\UserRole;
use App\Models\RoleAccess;

class NavigationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        Navigation::truncate();
        $parent_menu = array(

    

            (object) array(
                'label' => 'Employee Information',
                'route' => null,
                'icon' => 'fa fa-user-secret',
                'parent_id' => 0,
                'submenu' => (object) array(
                    (object) array(
                        'label' => 'Employee',
                        'route' => null,
                        'icon' => 'fa fa-home',
                        'parent_id' => null,
                        'table' => 'employee_infos',
                        'childMenu' => (object) array(
                            (object) array('label' => 'All Supplier Group', 'route' => 'inventorySetup.supplierGroup.index', 'icon' => 'fa fa-dashboard', 'navigate_status' => 1),
                            (object) array('label' => 'Add New Supplier Group', 'route' => 'inventorySetup.supplierGroup.create', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Supplier Group', 'route' => 'inventorySetup.supplierGroup.dataProcessingSupplierGroup', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Destroy Supplier Group', 'route' => 'inventorySetup.supplierGroup.destroy', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                        )
                    ),

                    
                   
                )
            ),

           

        );


        $parentMenu = array();
        $childMenu = array();

        foreach ((object) $parent_menu as $key => $each_parent) :
            //dd($each_parent->label);
            $navigation = new Navigation();
            $navigation->parent_id = $each_parent->parent_id;
            $navigation->label = $each_parent->label;
            $navigation->company_id = 1;
            $navigation->route = '';
            $navigation->icon = $each_parent->icon;
            $navigation->object_class = '';
            $navigation->extra_attribute = '';
            $navigation->active = "1";
            $navigation->orderBy = "1";
            $navigation->updated_by = 1;
            $navigation->created_by = 1;
            $navigation->deleted_by = null;
            $navigation->save();
            if (!empty($each_parent->submenu))
                foreach ($each_parent->submenu as $key => $each_child) :
                    $navigation_submenu = new Navigation();
                    $navigation_submenu->parent_id = $navigation->id;
                    $navigation_submenu->label = $each_child->label;
                    $navigation_submenu->route = '';
                    $navigation_submenu->company_id = 1;
                    $navigation_submenu->icon = $each_child->icon;
                    $navigation_submenu->table = $each_child->table;
                    $navigation_submenu->object_class = '';
                    $navigation_submenu->extra_attribute = '';
                    $navigation_submenu->active = "1";
                    $navigation_submenu->orderBy = "1";
                    $navigation_submenu->updated_by = 1;
                    $navigation_submenu->created_by = 1;
                    $navigation_submenu->deleted_by = null;
                    $navigation_submenu->save();
                    $formInfput = FormInput::where('table', $each_child->table)->first();
                    if (!empty($formInfput)) :
                        $formInfput->navigation_id = $navigation_submenu->id ?? 600;
                        $formInfput->save();
                    endif;
                    array_push($parentMenu, $navigation_submenu->id);
                    foreach ($each_child->childMenu as $key => $each_menu) :
                        $navigation_child = new Navigation();
                        $navigation_child->parent_id = $navigation_submenu->id;
                        $navigation_child->label = $each_menu->label;
                        $navigation_child->route = $each_menu->route;
                        $navigation_child->company_id = 1;
                        $navigation_child->navigate_status = $each_menu->navigate_status;
                        $navigation_child->icon = $each_menu->icon;
                        $navigation_child->object_class = '';
                        $navigation_child->extra_attribute = '';
                        $navigation_child->active = "1";
                        $navigation_child->orderBy = "1";
                        $navigation_child->updated_by = 1;
                        $navigation_child->created_by = 1;
                        $navigation_child->deleted_by = null;
                        $navigation_child->save();
                        array_push($childMenu, $navigation_child->id);
                    endforeach;
                endforeach;
        endforeach;

        $userRole = new UserRole();
        $userRole->company_id = 1;
        $userRole->name = 'Nptl Admin';
        $userRole->parent_id = implode(",", $parentMenu);
        $userRole->navigation_id = implode(",", $childMenu);
        $userRole->branch_id = implode(",", array(1, 2, 3, 4, 5, 6));
        $userRole->status = 'Approved';
        $userRole->save();
        $roleAccess =  new RoleAccess();
        $roleAccess->role_id = 1;
        $roleAccess->user_id = 1;
        $roleAccess->company_id = 1;
        $roleAccess->save();


        
        $formInput = FormInput::get();
        foreach($formInput as $key => $value): 
           $navigationInfo =  Navigation::where('table',$value->table)->first();
           if(!empty($navigationInfo)):
           $formInfput1 = FormInput::where('table',$value->table)->first();
           $formInfput1->navigation_id = $navigationInfo->id;
           $formInfput1->save();
           endif;
        endforeach;
        $formInput2 = FormInput::get();
        $subModules=array();
        foreach ($formInput2 as $key => $value) :
          $resourceInfo =   CompanyResource::where('table',$value->table)->first();

          if(!empty($resourceInfo)){
            $resourceInfo->navigation_id = $value->navigation_id;
            $resourceInfo->save();
          }
          if(!is_null($value->navigation_id))
           array_push($subModules,$value->navigation_id);
        endforeach;

        $companyInfo = CompanyCategory::find(1);
        $companyInfo->module_details = implode(",",$subModules);
        $companyInfo->save();




    }
}