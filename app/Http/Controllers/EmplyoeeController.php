<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmplyoeeController extends Controller
{
    public function index()
    {
        // $companies =Company::get();
        $employees = Employee::with('companyname')->orderBy('id', 'desc')->paginate(10);
        if (session()->has('user')) {

            // return view('admin.addcompany');
            return view('admin.employee', ['employees' => $employees]);
        }
        return redirect('/admin_login');
    }

    public function addemployee()
    {
        $companies = Company::get();
        if (session()->has('user')) {

            // return view('admin.addcompany');
            return view('admin.addemplyoee', compact('companies'));
        }
        return redirect('/admin_login');
    }


    public function addemployeedata(Request $request)
    {
        $this->validate($request, [
            'First_name' => 'required',
            'last_name' => 'required',

        ]);


        $add = new Employee;
        $add->First_name = $request->First_name;
        $add->last_name = $request->last_name;
        $add->email = $request->email;
        $add->company_id = $request->company_id;
        $add->phone = $request->phone;
        $add->save();

        return redirect()->back()->with('success', 'Emplyoee Added Successfully');
    }

    public function editemployee($id)
    {
        $companies = Company::get();

        $employee = Employee::find($id);
        if (session()->has('user')) {

            // return view('admin.addcompany');
            return view('admin.editemplyoee', ['employee' => $employee, 'companies' => $companies]);
        }
        return redirect('/admin_login');
    }

    public function editemployeedata(Request $request)
    {

        $this->validate($request, [
            'First_name' => 'required',
            'last_name' => 'required',

        ]);


        $edit = Employee::find($request->id);
        $edit->First_name = ucfirst($request->First_name);
        $edit->last_name = $request->last_name;
        $edit->email = $request->email;
        $edit->company_id = $request->company_id;
        $edit->phone = $request->phone;

        $edit->save();

        return redirect()->back()->with('success', 'emplyoee Updated Successfully');
    }
    public function deleteemployee(Request $request)
    {
        $id = $request->id;
        $emplyoee = Employee::find($id);
        $emplyoee->delete();
        if (session()->has('user')) {

            return redirect()->back()->with('succecc', 'Employee Deleted.');
            // return view('admin.addcompany');
        }
        return redirect('/admin_login');
    }
}
