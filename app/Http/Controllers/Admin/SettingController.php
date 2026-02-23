<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use App\Traits\HandleImageUpload;

class SettingController extends Controller
{
    use HandleImageUpload;

    public function index(Request $request)
    {
        $query = SiteSetting::query();
        
        if ($request->has('group')) {
            $query->where('group', $request->group);
        }

        $settings = $query->orderBy('group')->orderBy('key')->paginate(20);
        return view('admin.settings.index', compact('settings'));
    }

    public function create()
    {
        return view('admin.settings.edit');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'key' => 'required|string|unique:site_settings,key|max:255',
            'label' => 'required|string|max:255',
            'value' => 'nullable|string',
            'type' => 'required|string|in:text,textarea,file,number,email,url',
            'group' => 'required|string|max:255',
        ]);

        if ($validated['type'] === 'file' && $request->hasFile('value')) {
            $validated['value'] = $this->uploadAndConvertToWebp($request->file('value'), 'settings');
        }

        SiteSetting::create($validated);

        return redirect()->route('admin.settings.index')
            ->with('success', 'Setting created successfully.');
    }

    public function edit(SiteSetting $setting)
    {
        return view('admin.settings.edit', compact('setting'));
    }

    public function update(Request $request, SiteSetting $setting)
    {
        $validated = $request->validate([
            'key' => 'required|string|max:255|unique:site_settings,key,' . $setting->id,
            'label' => 'required|string|max:255',
            'value' => 'nullable',
            'type' => 'required|string|in:text,textarea,file,number,email,url',
            'group' => 'required|string|max:255',
        ]);

        if ($setting->type === 'file' && $request->hasFile('value')) {
            $this->deleteImage($setting->value);
            $validated['value'] = $this->uploadAndConvertToWebp($request->file('value'), 'settings');
        }

        $setting->update($validated);

        return redirect()->route('admin.settings.index')
            ->with('success', 'Setting updated successfully.');
    }

    public function destroy(SiteSetting $setting)
    {
        if ($setting->type === 'file') {
            $this->deleteImage($setting->value);
        }
        $setting->delete();
        return redirect()->route('admin.settings.index')
            ->with('success', 'Setting deleted successfully.');
    }
}
