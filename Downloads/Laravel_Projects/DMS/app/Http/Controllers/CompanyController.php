<?php

namespace App\Http\Controllers;

use App\company;
use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Validator;
use Datatables;
use Session;
use Illuminate\Support\Arr;
            
class CompanyController extends Controller
{
    
    public function index()
    {  
        $edit_data = DB::table('mst_comp_setup')->get(); 

        return view('company.company-index', ['edit_data'=>$edit_data]);
    }


    public function companysList()
    {
        $comp = DB::table('mst_comp_setup')->select('*');
        return datatables()->of($comp)
            ->make(true);
    }

   
    public function companyCreate()
    {
        $data = DB::table('mst_comp_setup')->get(); 
   
        return view('company.company-create', ['data'=>$data]);
    }

    public function companyStore(Request $request)
    {
        
        $request->validate([
            
            'comp_name'=>'required|Regex:/^[\D]+$/i|max:150',
            'contact_no'=>'required|size:10',
            'email_id'=>'required|email|max:150|unique:mst_comp_setup',
            'address' => 'required|regex:/([- ,\/0-9a-zA-Z]+)/',
            'app_name' => 'required|regex:/([- ,\/0-9a-zA-Z]+)/',
            'db_name' => 'required'
      
        ]);
    
        $user = auth()->user();
  
        $company = new Company();

        $company->comp_name = $request->input('comp_name');
        $company->contact_no = $request->input('contact_no');
        $company->email_id = $request->input('email_id');
        $company->address = $request->input('address');
        // 'password_reset = Session::put('password', $request->input('password_reset1'));
       $company->password_reset = $request->input('password_reset');
       $company->after_no_of_days = $request->input('after_no_of_days');
       $company->app_name = $request->input('app_name');
       $company->db_name = $request->input('db_name');
       $company->created_by = $user->user_id;
       $company->updated_by = $user->user_id;
       $company->save();
        
       //DB::table('mst_comp_setup')->insert($company);
       
       return redirect('/company-setup-index')->with('success', 'Company Information added Successfully!');
    }

    public function companyShow($id)
    {
        $show_data = DB::table('mst_comp_setup')->where('comp_id',$id)->get();
       
        return view('company.company-show', ['show_data'=>$show_data]);
    
    }

    public function companyEdit($id)
    {
       
        $edit_data = DB::table('mst_comp_setup')->where('comp_id',$id)->get();
       
        return view('company.company-edit', ['edit_data'=>$edit_data]);

    }


    public function companyUpdate(Request $request, $id)
    {  
  
        $request->validate([
            'comp_name'=>'required|Regex:/^[\D]+$/i|max:150',
            'contact_no'=>'required|size:10',
            'email_id'=>'required|email|max:150|unique:mst_comp_setup,email_id,'.$id. ',comp_id',
            'address' => 'required|regex:/([- ,\/0-9a-zA-Z]+)/',
            'app_name' => 'required|regex:/([- ,\/0-9a-zA-Z]+)/',
            'db_name' => 'required'
        ]);
   
            $user = auth()->user();
        
            // $company = Company::find($id);
            // //dd($company);
            // $company->comp_name = $request->input('comp_name');
            // dd($company->comp_name);
            // $company->contact_no = $request->input('contact_no');
            // $company->email_id = $request->input('email_id');
            // $company->address = $request->input('address');
            // $company->password_reset = $request->input('password_reset');
            // $company->after_no_of_days = $request->input('after_no_of_days');
            // $company->app_name = $request->input('app_name');
            // $company->db_name = $request->input('db_name');
            // // 'created_by' = $user->user_id;
            // $company->updated_by = $user->user_id;
            // $company->save();
            
          
        
    Company::whereId($id)->update($request->all());
        
        DB::table('mst_comp_setup')->where('comp_id', $id)->update($company);

           return redirect('/company-setup-index')->with('success', 'Company Information Updated Successfully!');
           
    }

    public function companyDelete($id)
    {
       DB::table('mst_comp_setup')->where('comp_id',$id)->delete();

       return redirect('/company-setup-index')->with('danger', 'Company Information Deleted Successfully!');
    }
}
