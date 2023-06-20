<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiteSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.setting.site_setting.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {
            if ($request->hasFile('homepage_file') || $request->hasFile('admin_panel_file') || $request->hasFile('admin_panel_mobile_file') || isset($request->homepageHeader) || isset($request->homepageSubHeader)) {
                $parameters = '{' . (isset($request->homepageHeader) ? '"homepageHeader":"' . $request->homepageHeader . '"' : null) . ',
                ' . (isset($request->homepageSubHeader) ? '"homepageSubHeader":"' . $request->homepageSubHeader . '"' : null) . '
                ' . ($request->hasFile('homepage_file') ? '"homepage_logo":"' . self::uploadPhoto($request->homepage_file) . '"' : null) . '
                ' . ($request->hasFile('admin_panel_file') ? '"admin_panel_logo":"' . self::uploadPhoto($request->admin_panel_file) . '"' : null) . '
                ' . ($request->hasFile('admin_panel_mobile_file') ? '"admin_panel_mobile_logo":"' . self::uploadPhoto($request->admin_panel_mobile_file) . '"' : null) . '}';
                $setting = new SiteSetting([
                    'name' => 'Site Setting',
                    'json' => $parameters
                ]);
                if ($setting->save()) return 1;
                return 0;
            }
        } else {
            return "Sadece AJAX sorgular için";
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        if ($request->ajax()) return SiteSetting::get();
        return "Sadece AJAX sorgular için";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->ajax()) {
            $setting = SiteSetting::first();
            $setting_json = json_decode($setting->json, true);

            $setting->json = '{' . (isset($request->homepageHeader) ? '"homepageHeader":"' . $request->homepageHeader . '"' : null) . ',
                ' . (isset($request->homepageSubHeader) ? '"homepageSubHeader":"' . $request->homepageSubHeader . '"' : null) . '
                ' . ($request->hasFile('homepage_file') ? '"homepage_logo":"' . self::uploadPhoto($request->homepage_file, $setting_json->homepage_logo) . '"' : null) . '
                ' . ($request->hasFile('admin_panel_file') ? '"admin_panel_logo":"' . self::uploadPhoto($request->admin_panel_file, $setting_json->admin_panel_logo) . '"' : null) . '
                ' . ($request->hasFile('admin_panel_mobile_file') ? '"admin_panel_mobile_logo":"' . self::uploadPhoto($request->admin_panel_mobile_file, $setting_json->admin_panel_mobile_logo) . '"' : null) . '}';
        } else {
            return "Sadece AJAX sorgular için";
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Create or Update the specified resource in storage.
     */
    public function save(Request $request)
    {
        if ($request->ajax()) {
            if (count(SiteSetting::get()) > 0) $this->update($request);
            $this->store($request);
        }
    }

    public static function uploadPhoto($file = null, $oldFile = null)
    {
        if ($file != null) {
            $fileName = 'logo_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = "media/photos/logo/";
            $oldFile = $path . ($oldFile != null ? $oldFile : $fileName);
            if ($file->move(public_path($path), $fileName)) {
                switch ($file->getClientOriginalExtension()) {
                    case "jpeg":
                        $image = imagecreatefromjpeg(public_path($path . $fileName));
                        break;
                    case "jpg":
                        $image = imagecreatefromjpeg(public_path($path . $fileName));
                        break;
                }
                $sizes = getimagesize(public_path($path . $fileName));
                $imageRate = 400 / $sizes[0];
                $imageHeight = $imageRate * $sizes[1];
                $newImage = imagecreatetruecolor('400', $imageHeight);
                imagecopyresampled($newImage, $image, 0, 0, 0, 0, '400', $imageHeight, $sizes[0], $sizes[1]);
                $fileName = 'logo_' . uniqid() . '.' . $file->getClientOriginalExtension();

                switch ($file->getClientOriginalExtension()) {
                    case "jpeg" || "jpg":
                        imagejpeg($newImage, public_path($path . $fileName), 100);
                        break;
                    case "png":
                        imagepng($newImage, public_path($path . $fileName), 100);
                        break;
                }
                chmod(public_path($path . $fileName), 0755);
                if (file_exists($oldFile)) {
                    @unlink(public_path($oldFile));
                }
            }
            return $fileName;
        }
        return null;
    }
}
