<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

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
		message(true,__('alert.save'),__('alert.not_save'));

		return redirect()->back();
	}
}
