<?php

namespace Modules\ACL\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\Role;
use App\Models\Permission;
use App\Http\Requests;
use App\Models\PermissionRole;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:read-role', ['only' => ['index','loadData']]);
        // $this->middleware('permission:create-role', ['only' => ['hakmenus','createpermissionrole']]);
        // $this->middleware('permission:update-role', ['only' => ['hakmenus','createpermissionrole']]);
    }

    public function index()
    {
        $data = Role::orderby('created_at','desc')->paginate(10);
        return view('acl::role.index',compact('data'));
    }

      public function getData(Request $request)
    {
        if($request->ajax())
        {
            $per_page=$request->input('per_page',null);
            $sort=$request->input('sort',null);
            $search=$request->input('search',null);

            $data=Role::select('*')
            ->where(function($q) use($search){
                $q->where('name','like','%'.$search.'%')
                ->orWhere('display_name','like','%'.$search.'%')
                ->orWhere('description','like','%'.$search.'%');
            })
            ->orderby('created_at',empty($sort) ? 'desc' : $sort=='date_desc'?'desc':'asc')
            ->paginate(empty($per_page) ? 10 : $per_page);
            
            return view('acl::role.index-data',compact('data'))->render();
        } 
    }

     public function hakmenus($role_id)
       {
        $send['role_id'] = $role_id;
        $send['role'] = new Role;

        // $pemesan=Stok::select(\DB::raw($selected_field));
        $send['permissionmenu']=$permissionmenu= Permission::select(\DB::raw('permissions.name as nama_perm,permissions.id as id_perm'))
        // ->where('menus.url','!=',null)
        // ->join('permission_role','permission_role.permission_id','=','permissions.id')
        ->get();

         return view('acl::role.form',$send);
       }

         public function createpermissionrole(Request $request )
       {
        // dd($request->all());
        $roleId = ($request->input('role_id'));
        // dd($roleId);
        $all_data = $request->all();
           // dd($all_data);
        $permisi =  \DB::table('permission_role')->where('role_id',$roleId)->delete();
     // dd($permisi);
        foreach ($all_data['role'] as $num => $row){
            if(isset($row['flag_aktif']) ){
                // $role = Role::find($roleId);
                $datarole = array(
                    'permission_id'=>$row['id_perm'],
                    'role_id'=>$roleId,

                );
            // dd($datarole);
                // $permissionmenu = PermissionRole::create($datarole);
                $permissionmenu = DB::table('permission_role')->insert($datarole);
              // dd($permissionmenu->role_id);
            }


        }
        \Artisan::call('cache:clear');

            // dd($all_data);
        message($permissionmenu,__('alert.save'),__('alert.not_save'));
        return redirect('role');
       }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('acl::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('acl::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('acl::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
