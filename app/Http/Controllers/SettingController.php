<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Session;

class SettingController extends Controller
{
    //
	public function index()
	{
		return view('setting.index');
	}

	public function store(Request $request)
	{
		$rules = Setting::getValidationRules();
		$data = $this->validate($request, $rules);

		$validSettings = array_keys($rules);

		foreach ($data as $key => $val) {
			if (in_array($key, $validSettings)) {
				Setting::add($key, $val, Setting::getDataType($key));
			}
		}
		if(setting('language_setting')!==null)
        {
            Session::put('locale', setting('language_setting'));
        }
		message(true,__('alert.save'),__('alert.not_save'));
		return redirect()->back();
	}
}
