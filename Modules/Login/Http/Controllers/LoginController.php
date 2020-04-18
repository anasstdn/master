<?php

namespace Modules\Login\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->username=$this->findUsername();
    }

    public function findUsername()
    {
        $login=request()->input('login');
        $fieldType=filter_var($login,FILTER_VALIDATE_EMAIL)?'email':'username';
        request()->merge([$fieldType=>$login]);
        return $fieldType;
    }

    public function username()
    {
        return $this->username;
    }

    public function authenticated(Request $request)
    {
        // $this->logLoginDetails($user);
        dd($request->all());
        if(!$user->verified)
        {
            auth()->logout();
            return back()->with('warning','You need to confirm your account. We have sent you an activation code, please check your email.');
        }
        return redirect()->intended($this->redirectPath());
    }

    public function logout(Request $request)
    {
        // $this->logLogoutDetails(Auth::user());
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/');
    }

    public function index()
    {
        return view('login::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('login::create');
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
        return view('login::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('login::edit');
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
