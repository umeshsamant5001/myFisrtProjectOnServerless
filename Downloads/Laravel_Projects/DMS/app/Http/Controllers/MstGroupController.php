<?php

namespace App\Http\Controllers;

use App\mst_group;
use Illuminate\Http\Request;
use DB;
use distinct;

class MstGroupController extends Controller
{
   
    public function index(Request $request)
    {
       $group = DB::table('mst_groups')->orderBy("group_name")->get();

       $users = DB::table('mst_users')->where('role_id', 3)->get();
             
       return view('groups.group-index', ['group'=>$group, 'users'=> $users]);
       
    }
 
    public function groupCreate()
    {
        return view('groups.group-create');
    }

    public function groupstore(Request $request)
    {
        $user = auth()->user();

        $request->validate([
              'group_name' => 'required|regex:/^[a-zA-Z\s]*$/|unique:mst_groups|max:150',
        ]);

        $group = new mst_group();
        $group->group_name = $request->input('group_name');
        $group->created_by  = $user->user_id;
        $group->created_date = date("Y-m-d");
        $group->created_time = date("H:i:s");
        $group->updated_by = $user->user_id;
        $group->updated_date = date("Y-m-d");
        $group->updated_time = date("H:i:s");  
        $group->save();

        //DB::table('mst_groups')->insert($group);

        return redirect('/group-index')->with('success', 'Group Added Successfully!!');
    }

    public function groupshow($id)
    {
        $group_show = DB::table('mst_groups')
        ->select('*')
        ->join('mst_users', 'mst_users.user_id', '=', 'mst_groups.created_by')
        ->where('group_id', $id)->get();

        return view('groups.group-show', ['group_show'=> $group_show]);
    }


    public function groupEdit($id)
    {
        $group_edit = DB::table('mst_groups')->where('group_id', $id)->get();

        return view('groups.group-edit', ['group_edit'=>$group_edit]);
    }

    public function groupUpdate(Request $request, $id)
    {
        $user = auth()->user();
    
        $request->validate([
            'group_name'=> 'required|regex:/^[a-zA-Z\s]*$/|max:150|unique:mst_groups,group_name,'.$id.',group_id',
        ]);
   
        $group_update = [

            'group_name'=> $request->input('group_name'),
            'updated_by' => $user->user_id,
            'updated_date'=> date("Y-m-d"),
            'updated_time'=> date("H:i:s"),

        ];

        DB::table('mst_groups')->where('group_id', $id)->update($group_update);

        return redirect('/group-index')->with('success', 'Group Updated Successfully!!');
    }

    public function groupDelete($id)
    {
        DB::table('mst_groups')->where('group_id', $id)->delete();

        return redirect('/group-index')->with('danger', 'Group Deleted Successfully!!');
    }

    public function groupData(Request $request, $id){
        
        $data = DB::table('mst_groups')->where('group_id', $id)->get();

        return $data;
    }

    public function addUsers(Request $request, $id){

        $user_add = $request->adduser;
        
        if($user_add) {

        $user_id = implode(',' ,$user_add);
        $userFound = false;

    //     $data = [ 'group_id' => $id,];
 
    //    $data = DB::table('mst_users')->whereIn('user_id', $user_add)->update($data);
           
        for($i = 0; $i < count($request->adduser) && !$userFound ; $i++){
      
        
            // Added code to get $userCount for the userId of the member to be added in the group.
            // BT Issue - 0000025: Same user can assign to same group multiple time - Umeshs
            
            $userCount = DB::table('mst_group_member')->where('user_id', $request->adduser[$i])->where('group_id', $id)->get()->count();
                 
            $user = auth()->user();
        
            $data = [
                'group_id' => $id,
                'user_id' =>    $request->adduser[$i],
                'created_by' => $user->user_id,
                'created_time' => date("H:i:s"),
                'created_date' => date("Y-m-d"),
                'updated_by' => $user->user_id,
                'updated_time'=> date("H:i:s"), 
                'updated_date' => date("Y-m-d"),
        
            ];
            if($user->user_id )
            {
                            
                if($userCount > 0 )
                    {
                        $userFound = true;
                        return redirect()->back()->with('Danger', 'Member already exists in a group!!');
                        
                    }
                    else{
                        DB::table('mst_group_member')->insert($data);
                    }
                
              
          
         } 
     } 
    }
    else {
        return redirect()->back()->with('Danger', 'Member Not Selected!!');
     }
  
       return redirect()->back()->with('success', 'Member add in Group Successfully!!');
    
    }

     public function groupList(){
        
        $data = DB::table('mst_group_member')->get();

        dd($data);
    }

    public function groupMember($id){

        $users_list = DB::table('mst_users')->where('role_id', 3)->get();
       
        $group_name = DB::table('mst_groups')->where('group_id', $id)->get();
  
        $group_name = $group_name[0]->group_name;
        
        $user_data = DB::table('mst_group_member') 
        ->select('*')
        ->join('mst_users','mst_users.user_id', '=', 'mst_group_member.user_id')
        ->where('mst_group_member.group_id', $id)
        ->where('mst_group_member.flag', 'Show')
        ->get();
     
        return view('groups.group-member-list', ['id'=>$id,'users_list'=>$users_list,'user_data'=>$user_data, 'group_name'=>$group_name]); 
    }

    public function removeMember($id){
      
         $data = ['flag' => 'remove'];

         DB::table('mst_group_member')->where('group_member_id', $id)->update($data);

       return redirect()->back()->with('Success', 'Member Remove from Group Successfully!!');
    }

}
