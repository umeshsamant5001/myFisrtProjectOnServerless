<?php

namespace App\Http\Controllers;

use App\tran_doc_cat_column;
use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class TableController extends Controller
{
    
    public function index($id)
    {
        $data_type = DB::table('data_type_table')->get();
        
        $table_name = DB::table('mst_doc_category')->where('doc_category_id', $id)->get();
  
        $table  =  $table_name[0]->doc_category_id;
        
        $table12  =  $table_name[0]->doc_category_name;
    
        $table1 = $table12;
        $string = strtolower($table1);
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
        $string = preg_replace("/[\s-]+/", " ", $string);
        $table12 = preg_replace("/[\s_]/", "_", $string);
       
        $columns = DB::getSchemaBuilder()->getColumnListing($table12);
       
        
        $col_frm_table = DB::table('tran_doc_cat_columns')->where('doc_category_id', $id)->get();
         
    
        return view('tran-doccat-column.tran-doccat-column', ['data_type'=>$data_type, 'table'=>$table, 'table_name'=>$table_name, 'columns'=>$columns, ' table12'=> $table12, 'col_frm_table'=>$col_frm_table]);
    
    }
    

    public function createTable($table_name, $fields = [])
    {
        
        // check if table is not already exists
        if (!Schema::hasTable($table_name)) {
            Schema::create($table_name, function (Blueprint $table) use ($fields, $table_name) {
                $table->increments('id');
               
                $table->timestamps();
            });

            return redirect('/tran-doc-cat-index')->with('success', 'Given table has been successfully created!');   
        }

        return redirect('/tran-doc-cat-index')->with('success', 'Given table is already exist.');
    }


    public function operate(request $request)
    {
        // set dynamic table name according to your requirements

        $table_name =  Session::get('cart');
        
        $validatedData = $request->validate([

            'table_name' => 'required|max:255',
            // 'name' => 'required'
        ]);


        // $request->validate([

        //     'table_name' => 'required|max:250|unique:mst_doc_category',
        //     'name' => 'required|max:250|unique:mst_doc_category',
        //     'size' => 'required',
         
        // ]);

    // $fields = ['name' => $name, 'type' => $type];

     for($i = 0; $i < count($request->name); $i++){
  
        $fields[$i]['name']=$request->name[$i];
        $fields[$i]['type']=$request->type[$i];
        $fields[$i]['size']=$request->size[$i];
        }

        //Insert data table_info


        $validatedData = $request->validate([

            'table_name' => 'required|max:255',
            // 'name' => 'required',
            // 'control_type' => 'required',
            // 'display_name' => 'required'
        ]);


         // $request->validate([

        //     'table_name' => 'required|max:250|unique:mst_doc_category',
        //     'name' => 'required|max:250|unique:mst_doc_category',
        //     'size' => 'required',
         
        // ]);

        // $user = auth()->user();
 

        // $input = $request->input();
        // unset($input['_token']);
        // dd($input);
        
    //  for($i=0; $i<count($input['name']); $i++){

    //         $dd = DB::table('tran_doc_cat_columns')->insert([

    //             "doc_category_id" => 1,
    //             "col_caption" => "Sonali",
    //             "col_name" => $input['name'][$i],
    //             "data_type" => $input['type'][$i],
    //             "data_length" => $input['size'][$i],
    //             "data_control" => $input['control_type'][$i],
    //             "mandatory_status" => 1,
    //             "special_char_status" => 0,
    //             "int_between_val" => '255',
    //             "min_value" => 11,
    //             "max_value" => 255,
    //             // "display_name" => $input['display_name'][$i],
    //             "created_by" => $user->user_id,
    //             "created_date" => date("Y-m-d"),
    //             "created_time" => date("H:i:s"),
    //             "updated_by" => $user->user_id,
    //             "updated_date" => date("Y-m-d"),
    //             "updated_time" =>  date("H:i:s"),
    
    //         ]);          
    //  }   

       // table name validation
        $string = strtolower($table_name);
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
        $string = preg_replace("/[\s-]+/", " ", $string);
        $table_name = preg_replace("/[\s_]/", "_", $string);
        

        return $this->createTable($table_name, $fields);
         
    }

    public function getInputType(request $request)
    {
     
      $states = DB::table("input_type_table")
                  ->where("data_type_id", $request->data_type_id)
                  ->pluck("input_type_name","id");
                  
      return response()->json($states);

    }

    public function addColumns(Request $request, $id){
       
        // for($i = 0; $i < $request->col_name; $i++){
         
        //     $fields[$i]['col_name']=$request->col_name[$i];
        //     $fields[$i]['data_type']=$request->data_type[$i];
        //     $fields[$i]['data_length']=$request->data_length[$i];
        // }  
        
        
        $request->validate([

            'col_caption' => 'required|regex:/^[\pL\s\-]+$/u|max:250',
            'col_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'data_type' => 'required',
            'data_length' => 'required|min:2|max:11',
            
        ]);

             $user = auth()->user();

                $data = new tran_doc_cat_column();
                $data->doc_category_id = $request->input('name_id');
                $data->col_caption = $request->input('col_caption');
                $data->col_name = $request->input('col_name');
                $data->data_type = $request->input('data_type');
                $data->data_length = $request->input('data_length');
                $data->data_control = $request->input('data_control');
                $data->mandatory_status = $request->input('mandatory_status');
                $data->special_char_status = $request->input('special_char_status');
                $data->int_between_val = $request->input('special_char_status');
                $data->min_value =  $request->input('min_value');
                $data->max_value =  $request->input('max_value');
                // $data->display_name = $input('display_name');
                $data->created_by = $user->user_id;
                $data->created_date = date("Y-m-d");
                $data->created_time = date("H:i:s");
                $data->updated_by = $user->user_id;
                $data->updated_date = date("Y-m-d");
                $data->updated_time =  date("H:i:s");
                $data->save();
            
            //dd($data);
      
         //DB::table('tran_doc_cat_columns')->insert($data);
        
         Schema::table($id, function(Blueprint $table) use ($data, $id){
              
         $table->{$data['data_type']}($data['col_name'])->length($data['data_length'])->after('id');

        });
        

      return redirect('/doc-category-index')->with('success', 'Given table Columns successfully created!');      
    }
    
    public function dropColumn($table,$col){
        
        Schema::table($table, function (Blueprint $table)  use ($col) {
             $table->dropColumn($col);
        });
        
        DB::table('tran_doc_cat_columns')->where('col_name', $col)->delete();
        
        return redirect()->back()->with('danger', 'Column Deleted Successfully!');  
        
    }
}
