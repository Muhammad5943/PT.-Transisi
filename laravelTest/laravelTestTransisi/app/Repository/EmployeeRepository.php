<?php

namespace App\Repository;

use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class EmployeeRepository
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function index_employees()
    {
        $data = Employee::with('company')->orderBy('id','DESC')->paginate(5);

        return $data;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        // dd($roles);
        // return view('home', [
        //     'roles' => $roles]
        // );

        return [
            "user" => $roles
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_role(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'guard_name' => 'required'
        ]);

        $input = $request->all();
        $roles = Role::create($input);
        // dd($roles);
        // return view('home', [
        //     'roles' => $roles]
        // );

        return [
            "user" => $roles
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function store_employee($request)
    {
        $input = $request->all();
        $user = Employee::create($input);
        $user->assignRole($request->input('roles'));

        // return redirect()->route('users.index')
        //                 ->with('success','User created successfully');

        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function show_employee($id)
    {
        $employee = Employee::where('id', $id)->first();

        return $employee;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('users.edit',compact('user','roles','userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function update_employee(EmployeeRequest $request, $id)
    {
        $input = $request->all();
        $employee = Employee::find($id);
        $employee->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $employee->assignRole($request->input('roles'));
        // return redirect()->route('users.index')
        //                 ->with('success','User updated successfully');

        return $employee;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function destroy_employee($id)
    {
        $delete_employee = Employee::find($id)->delete();
        // return redirect()->route('users.index')
        //                 ->with('success','User deleted successfully');

        return $delete_employee;
    }
}
