<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    private $setting;

    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }

    public function index()
    {
        $setting = $this->setting->getSettings();
        return view("admin.settings", compact("setting"));
    }

    public function update(Request $request)
    {
        $setting = $this->setting->getSettings();

        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'bgcolor' => ['required', 'string', 'max:255', 'regex:/#[A-Z0-9]{6}/i'],
            'textcolor' => ['required', 'string', 'max:255', 'regex:/#[A-Z0-9]{6}/i'],
        ];

        $request->validate($rules);

        $data = $request->only(["title", "subtitle", "email", "bgcolor", "textcolor"]);

        $this->setting->updateSetting($data);

        return redirect()->back()
            ->withSuccess('Configurações atualizadas com sucesso');
    }
}
