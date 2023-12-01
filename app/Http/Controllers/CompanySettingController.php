<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCompanySetting;
use App\Models\CompanySetting;
use Illuminate\Http\Request;

class CompanySettingController extends Controller
{
    public function show($id)
    {
        if (
            !auth()
                ->user()
                ->can('view_company_setting')
        ) {
            abort(403);
        }

        $setting = CompanySetting::findOrFail($id);
        return view('company-setting.show', compact('setting'));
    }

    public function edit($id)
    {
        if (
            !auth()
                ->user()
                ->can('edit_company_setting')
        ) {
            abort(403);
        }

        $setting = CompanySetting::findOrFail($id);
        return view('company-setting.edit', compact('setting'));
    }

    public function update(UpdateCompanySetting $request, $id)
    {
        $setting = CompanySetting::findOrFail($id);
        $setting->company_name = $request->company_name;
        $setting->company_email = $request->company_email;
        $setting->company_phone = $request->company_phone;
        $setting->company_address = $request->company_address;
        $setting->office_start_time = $request->office_start_time;
        $setting->office_end_time = $request->office_end_time;
        $setting->break_start_time = $request->break_start_time;
        $setting->break_end_time = $request->break_end_time;
        $setting->update();

        return redirect()
            ->route('company-setting.show', 1)
            ->with('create', 'Company setting update successfully');
    }
}
