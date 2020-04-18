<?php

namespace Modules\ACL\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\User;
use App\Models\RoleUser;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
// date_default_timezone_set(setting('timezone'));
use Illuminate\Support\Facades\Auth;
// use App\Traits\ActivityTraits;
use Response;

class UserController extends Controller
{
    // use ActivityTraits;
    /**
     * Display a listing of the resource.
     * @return Response
     */
      public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:read-user', ['only' => ['index','loadData']]);
    }

    public function index()
    {
        $data = User::orderby('created_at','desc')->paginate(10);
        return view('acl::user.index',compact('data'));
    }

     public function getData(Request $request)
    {
        if($request->ajax())
        {
            $per_page=$request->input('per_page',null);
            $sort=$request->input('sort',null);
            $search=$request->input('search',null);

            $data=User::select('*')
            ->where(function($q) use($search){
                $q->where('name','like','%'.$search.'%')
                ->orWhere('username','like','%'.$search.'%')
                ->orWhere('email','like','%'.$search.'%');
            })
            ->orderby('created_at',empty($sort) ? 'desc' : $sort=='date_desc'?'desc':'asc')
            ->paginate(empty($per_page) ? 10 : $per_page);
            
            return view('acl::user.index-data',compact('data'))->render();
        } 
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $role=\App\Role::select(\DB::raw("*"))->get();
        return view('acl::user.form',compact('role'));
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
        return view('user::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
                //
        $user=User::find($id);
        $role=\App\Role::select(\DB::raw("*"))->get();
        // $this->menuAccess(Auth::user(),'User (Edit)');
        return view('acl::user.form',compact('user','role'));
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
           $user=User::find($kode);
           // $this->logDeletedActivity($user,'Delete data id='.$kode.'','Users','users');
           $act=false;
           try {
               $act=$user->forceDelete();
               $delRoleUser=RoleUser::where('user_id',$kode)->forceDelete();
           } catch (\Exception $e) {
               $user=User::find($user->pk());
               $act=$user->delete();
               $delRoleUser=RoleUser::where('user_id',$kode)->delete();
           }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($kode)
    {
        //
      $user=User::find($kode);
           // $this->logDeletedActivity($user,'Delete data id='.$kode.'','Users','users');
           $act=false;
           try {
               $act=$user->forceDelete();
               $delRoleUser=RoleUser::where('user_id',$kode)->forceDelete();
           } catch (\Exception $e) {
               $user=User::find($user->pk());
               $act=$user->delete();
               $delRoleUser=RoleUser::where('user_id',$kode)->delete();
           }
    }

      public function reset(Request $request, $kode)
   {
      $user=User::find($kode);
      // $this->menuAccess(Auth::user(),'User (Reset Password)');
      $act=false;
      try {
       $dat=array(
        'password'=>bcrypt('12345678'),
      );
       // $this->logUpdatedActivity(Auth::user(),$user->getAttributes(),$dat,'Users','users');
      $reset=$user->update($dat);
     } catch (\Exception $e) {
       $dat=array(
        'password'=>bcrypt('12345678'),
      );
       // $this->logUpdatedActivity(Auth::user(),$user->getAttributes(),$dat,'Users','users');
      $reset=$user->update($dat);
     }
   }

       public function sendData(Request $request)
   {
    $all_data=$request->all();
    // dd($all_data);
    DB::beginTransaction();
    try {
      switch($all_data['mode'])
      {
        case 'add':
            $data  = array(
             'name' =>$all_data['nama'] ,
             'username' =>$all_data['username'] ,
             'email' =>$all_data['email'] ,
             'password' =>bcrypt($all_data['password']) ,
                   // 'jenis_kelamin' =>isset($all_data['jenis_kelamin'])?$all_data['jenis_kelamin']:'' ,
             'verified'=>$all_data['verified']=='1'?true:false,
           );

            // $this->logCreatedActivity(Auth::user(),$data,'Users','users');
            $user=User::create($data);

            $role=array(
             'role_id'=>intval($all_data['roles']),
             'user_id'=>$user->id,
             'user_type'=>'App\User'
            );

            // dd($role);
            // $this->logCreatedActivity(Auth::user(),$role,'Users','role_user');
            $roleUser = DB::table('role_user')->insert($role);

            if($user==true && $roleUser==true)
            {
              $data=array(
                'status'=>true,
                'msg'=>__('alert.save')
              );
            }
            else
            {
               $data=array(
                'status'=>false,
                'msg'=>__('alert.not_save')
              );
            }
        break;
        case 'edit':
            $user=User::find($all_data['id']);
            // dd($all_data);
            if(!empty($all_data['password']))
            {
                $dataUser  = array(
                 'name' =>$all_data['nama'] ,
                 'username' =>$all_data['username'] ,
                 'email' =>$all_data['email'] ,
                 'password' =>bcrypt($all_data['password']) ,
                       // 'jenis_kelamin' =>isset($all_data['jenis_kelamin'])?$all_data['jenis_kelamin']:'' , ,
                 'verified'=>$all_data['verified']=='1'?true:false,
               );
            }
            else
            {
                $dataUser  = array(
                 'name' =>$all_data['nama'] ,
                 'username' =>$all_data['username'] ,
                 'email' =>$all_data['email'] ,
                 // 'password' =>bcrypt($all_data['password']) ,
                       // 'jenis_kelamin' =>isset($all_data['jenis_kelamin'])?$all_data['jenis_kelamin']:'' ,
                 'verified'=>$all_data['verified']=='1'?true:false,
               );
            }
            // $this->logUpdatedActivity(Auth::user(),$user->getAttributes(),$dataUser,'Users','users');

            $act=$user->update($dataUser);

            // $this->logDeletedActivity(RoleUser::where('user_id',$all_data['id'])->first(),'Delete data id='.$all_data['id'].' di menu Users','Users','role_user');
            $delRoleUser=RoleUser::where('user_id',$all_data['id'])->forceDelete();

            $role=array(
             'role_id'=>intval($all_data['roles']),
             'user_id'=>$user->id,
             'user_type'=>'App\User'
            );

            // dd($role);
            // $this->logCreatedActivity(Auth::user(),$role,'Users','role_user');
            $roleUser = DB::table('role_user')->insert($role);

            if($user==true && $roleUser==true)
            {
              $data=array(
                'status'=>true,
                'msg'=>__('alert.save')
              );
            }
            else
            {
               $data=array(
                'status'=>false,
                'msg'=>__('alert.not_save')
              );
            }
        break;
      }
     
    } catch (Exception $e) {
      echo 'Message' .$e->getMessage();
      DB::rollback();
    }
    DB::commit();
    return \Response::json($data);
  }

  public function checkUsername(Request $request)
  {
    $all_data = $request->all();
    switch($all_data['mode'])
    {
      case 'add':
      $cek=User::where('username','like','%'.$all_data['username'].'%')->first();
      break;
      case 'edit':
      $cek=User::where(function($q) use ($all_data){
        $q->where('username','like','%'.$all_data['username'].'%')
        ->where('id','<>',$all_data['id']);
      })
      ->first();
      break;
    }
     if($cek==true) {
        return Response::json(array('msg' => 'true'));
      }
     return Response::json(array('msg' => 'false'));  
  }

    public function checkEmail(Request $request)
  {
    $all_data = $request->all();
    switch($all_data['mode'])
    {
      case 'add':
      $cek=User::where('email','like','%'.$all_data['email'].'%')->first();
      break;
      case 'edit':
      $cek=User::where(function($q) use ($all_data){
        $q->where('email','like','%'.$all_data['email'].'%')
        ->where('id','<>',$all_data['id']);
      })
      ->first();
      break;
    }
     if($cek==true) {
        return Response::json(array('msg' => 'true'));
      }
     return Response::json(array('msg' => 'false'));  
  }
}
