<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\mst_right;
use DB;

class UpdateMstRightRequest extends FormRequest
{
   
  
   
    public function rules()
    {
   
        return [

            'doc_category_limit' => 'required|max:11|unique:mst_rights,doc_category_limit,'.$id,
            // 'workflow_limit' => 'required|max:11|unique:mst_rights,workflow_limit,'.$id.',rights_id',
            // 'cabinet_limit' => 'required|max:11|unique:mst_rights,cabinet_limit,'.$id.',rights_id',
            // 'folders_limit' => 'required|max:11|unique:mst_rights,folders_limit,'.$id.',rights_id',
            // 'folder_structure_level' => 'required|max:11|unique:mst_rights,folder_structure_level,'.$id.',rights_id',

        ];
    }

    public function authorize()
    {
        return true;
    }

}
