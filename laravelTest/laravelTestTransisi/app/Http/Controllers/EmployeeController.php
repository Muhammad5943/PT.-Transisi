<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Imports\EmployeeImport;
use App\Models\Employee;
use App\Repository\CompanyRepository;
use App\Repository\EmployeeRepository;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = EmployeeRepository::index_employees();
        $companies = CompanyRepository::index_companies();

        return view('home', [
            'employees' => $employees,
            'companies' => $companies
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function import_excel(Request $request)
    {
		$request->validate([
			'file' => 'required|mimes:csv,xls,xlsx'
		]);

        $file = $request->file('file');
		$filename = rand().$file->getClientOriginalName();
		$file->move('storage/file_employee',$filename);
		Excel::import(new EmployeeImport, public_path('/storage/file_employee/'.$filename));
		Session::flash('success','Employee data imported!');

        return redirect()->back()->withStatus('Excel file imported successfully');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdf_downloader(Employee $employee)
    {
        $employees = Employee::get();

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('template.variable', [
            'employees' => $employees
        ]);
        return $pdf->stream();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        EmployeeRepository::store_employee($request);

        return redirect()->route('posts.all')
                        ->with('success','Employee created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = EmployeeRepository::show_employee($id);

        return view('employee.show',[
            'employee' => $employee
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tambah_employee()
    {
        return view('employee.add');
        // return $get_employee;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, $id)
    {
        EmployeeRepository::update_employee($request, $id);

        return redirect()->route('posts.all')
                        ->with('success','Employee updated successfully');
        // return [
        //     'employee' => $update_employee
        // ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        EmployeeRepository::destroy_employee($id);

        return redirect()->back()
                ->with('delete','Employee deleted successfully');
        // return [
        //     'destroy_employee' => $destroy_employee
        // ];
    }
}
