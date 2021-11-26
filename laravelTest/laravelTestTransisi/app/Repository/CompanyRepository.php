<?php

namespace App\Repository;

use App\Http\Requests\CompanyRequest;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Support\Facades\Storage;

class CompanyRepository
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function index_companies()
    {
        $data = Company::orderBy('id','DESC')->paginate(5);

        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function store_companies($request)
    {
        $upload_folder = 'company/';
        if ($logo = $request->file('logo'))
            {
                $time = filter_var(microtime(true), FILTER_SANITIZE_NUMBER_INT);
                $fileName = $time . '.' . $logo->getClientOriginalExtension();
                Storage::put($upload_folder . $fileName, file_get_contents($logo));
                $is_upload_success = Storage::exists($upload_folder . $fileName);
                if (!$is_upload_success) {
                    return 'gambar gagal diupload';
                }
            }

        $company = new Company;
        $company->name = $request->name;
        $company->email = $request->email;
        $company->logo = $fileName;
        $company->website = $request->website;
        $company->save();

        return $company;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function show_company($id)
    {
        $company = Company::find($id);

        return $company;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);

        return $company;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function update_companies(CompanyRequest $request, $id)
    {
        $find_logo = Company::where('id', $id)->first();

        // return $find_logo;
        $upload_folder = 'company/';
        if ($request->hasFile('logo')) {
            if ($find_logo->logo !== null) {
                $name_logo = $find_logo->getRawOriginal('logo');
                Storage::delete($upload_folder . $name_logo);
            }
        }

        if ($request->file('logo')) {
            $update_logo = $request->file("logo");
            $name_logo = filter_var(microtime(true), FILTER_SANITIZE_NUMBER_INT) . $update_logo->getClientOriginalExtension();
            Storage::put($upload_folder . $name_logo, file_get_contents($update_logo));
            $is_upload_success = Storage::exists($upload_folder . $name_logo);
            if (!$is_upload_success) {
                return 'upload gambar front gagal';
            }
        }

        $find_logo->name = $request->name ? $request->name : $find_logo->name;
        $find_logo->email = $request->email ? $request->email : $find_logo->email;
        $find_logo->logo = $request->file('logo') ? $name_logo : $find_logo->logo;
        $find_logo->website = $request->website ? $request->website : $find_logo->website;
        $find_logo->update();

        return $find_logo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function destroy_company($id)
    {
        $delete_company = Company::find($id)->delete();
        $delete_employee = Employee::where('company_id', $id)->delete();

        return [
            'delete_company' => $delete_company,
            'delete_employee' => $delete_employee
        ];
    }
}
