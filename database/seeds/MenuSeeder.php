<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Menu;
use App\Permission;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    	$this->command->info('Delete semua tabel menu');
    	Model::unguard();
    	Menu::truncate();
    	$this->menuHome();
    	$this->menuAcl();
    }

    private function menuHome()
    {
    	$this->command->info('Menu Home Seeder');
    	$permission = Permission::firstOrNew(array(
    		'name'=>'read-home-menu'
    	));
    	$permission->display_name = 'Read Home Menus';
    	$permission->save();
    	$menu = Menu::firstOrNew(array(
    		'name'=>'menu.homepage',
    		'permission_id'=>$permission->id,
    		'ordinal'=>1,
    		'parent_status'=>'N',
    		'url'=>'home',
    	));
    	$menu->icon = 'si-home';
    	$menu->save();
    }

    private function menuAcl(){
    	$this->command->info('Menu ACL Seeder');
    	$permission = Permission::firstOrNew(array(
    		'name'=>'read-acl-menu'
    	));
    	$permission->display_name = 'Read ACL Menus';
    	$permission->save();
    	$menu = Menu::firstOrNew(array(
    		'name'=>'menu.acl',
    		'permission_id'=>$permission->id,
    		'ordinal'=>1,
    		'parent_status'=>'Y'
    	));
    	$menu->icon = 'si-settings';
    	$menu->save();

          //create SUBMENU master
    	$permission = Permission::firstOrNew(array(
    		'name'=>'read-user',
    	));
    	$permission->display_name = 'Read Users';
    	$permission->save();

    	$submenu = Menu::firstOrNew(array(
    		'name'=>'menu.user_management',
    		'parent_id'=>$menu->id,
    		'permission_id'=>$permission->id,
    		'ordinal'=>2,
    		'parent_status'=>'N',
    		'url'=>'user',
    	)
    );
    	$submenu->save();

    	$permission = Permission::firstOrNew(array(
    		'name'=>'read-permission',
    	));
    	$permission->display_name = 'Read Permissions';
    	$permission->save();

    	$submenu = Menu::firstOrNew(array(
    		'name'=>'menu.permission_management',
    		'parent_id'=>$menu->id,
    		'permission_id'=>$permission->id,
    		'ordinal'=>2,
    		'parent_status'=>'N',
    		'url'=>'permission',
    	)
    );
    	$submenu->save();


    	$permission = Permission::firstOrNew(array(
    		'name' => 'read-role',
    	));
    	$permission->display_name = 'Read Roles';
    	$permission->save();

    	$submenu = Menu::firstOrNew(array(
    		'name' => 'menu.roles_management',
    		'parent_id' => $menu->id,
    		'permission_id' => $permission->id,
    		'ordinal' => 2,
    		'parent_status' => 'N',
    		'url' => 'role',
    	)
    );
    	$submenu->save();
    }

}
