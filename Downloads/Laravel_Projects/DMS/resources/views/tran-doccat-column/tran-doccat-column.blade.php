@extends('layouts.master')

@section('body')
<div class="wrapper">

<div id="content">
 <?php
    
        $table_name = $table_name[0]->doc_category_name;
        $string = strtolower($table_name);
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
        $string = preg_replace("/[\s-]+/", " ", $string);
        $table_name1 = preg_replace("/[\s_]/", "_", $string);
    ?>
     
      
<div class="row justify-content-center">
  <div class="col-md-12 viewList">
    <div class="card">
    <div class="card-header" style="text-align:left;">Document Category : <b>{{$table_name}}</b></div>

<div class="card-body viewList categoryColumn">
    
  
@include('flash-message')

 <form method="post" action="{{url('/add-columns')}}/{{$table_name1}}">
  @csrf

<input type="text" class="form-control hidden" value="{{$table}}" name="name_id"  placeholder="Enter Caption for document category" required="">
    <div class="form-group row">
        <div class="col-sm-2">
            <label for="doc_category_caption">Column Caption : </label>
        </div>
        <div class="col-sm-4">
            <input type="text" class="form-control" name="col_caption"  placeholder="Enter Caption for document category" required="">
        </div> 
        
         <div class="col-sm-2">
            <label for="doc_category_name">Column Name : </label>
        </div>
        <div class="col-sm-4">
            <input type="text" class="form-control" name="col_name" placeholder="Enter Name of document category" required="">
        </div>
        
    </div>        

    <div class="form-group row">
        <div class="col-sm-2">
            <label for="doc_category_type">Column Type : </label>
        </div>
        <div class="col-sm-2">
            <select class='form-control doc_width' name="data_type"  id="data-type" class="required-entry" required="">
                                                <option value="">Select Data Type</option>
                                                <option value="text">TEXT</option>
                                                <option value="string">STRING</option>
                                                <option value="char">VARCHAR</option>
                                                <option value="boolean">BOOLEAN</option>
                                                <option value="char">CHAR</option>
                                                <option value="integer">Numeric</option>
                                                <option value="integer">INT </option>
                                                <option value="date">DATE </option>
                                                <option value="dateTime">DATETIME </option>
                                                <option value="timestamp">TIMESTAMP </option>
                                                <option value="time">TIME </option>
                                                <option value="char">CHAR</option>
                                                <option value="tinyText">TINYTEXT </option>
                                                <option value="mediumText">MEDIUMTEXT </option>
                                                <option value="longText">LONGTEXT </option>
                                                <option value="enum">ENUM  </option>
                                                <option value="float">FLOAT </option>
                                                <option value="double">DOUBLE </option>
                                                <option value="decimal">DECIMAL </option>

            </select>
        </div>
        <div class="col-sm-2">
            <label for="datacontrol">Data control :</label>
        </div>
        <div id="datacontrol" class="col-sm-2">
         <select class='form-control doc_width' required=""></select>
        </div>
        
         <div class="col-sm-2">
             <label for="doc_category_type">Length :</label>
        </div>
        <div id="datacontrol" class="col-sm-2">
         <input type="number" name="data_length" id="" class="form-control required-entry" required="">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-2">
            <label for="special-char">Special Character :</label>
        </div>
        <div class="col-sm-2">
            <select name="special_char_status" id="" class="form-control doc_width">
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
        </div>
        <div class="col-sm-2">
             <label for="doc_category_type">Mandatory :</label>
        </div>     
        <div class="col-sm-2">
            <select name="mandatory_status" id="" class="form-control doc_width">
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
        </div>
         <div class="col-sm-2">
            <label for="int_between_val">Between value :</label>
        </div>
        <div class="col-sm-2">
            <select name="int_between_val" class="form-control doc_width" id="type_value">
                <option>Select</option>
                <option value="yes">Yes</option>
				<option value="no">No</option>
            </select>
        </div>
    </div>    
 
    <div class="form-group row" id="other_value">

        <div class="col-sm-2">
            <label for="doc_category_type">Min Value :</label>
        </div>
        <div class="col-sm-2">
            <input type="text" class="form-control doc_width" name="min_value" placeholder="Min value">
        </div>
        <div class="col-sm-2">
            <label for="doc_category_type">Max Value :</label>
        </div>
        <div class="col-sm-2">
            <input type="text" class="form-control doc_width" name="max_value" placeholder="Max value">   
        </div>
    </div>    
    
   <div class="form-group row mb-0">
     <div class="col-md-6 offset-md-5">
         <button type="submit" class="btn btn-primary"> Add Column</button>
            <button type="btn" class="btn btn-primary" data-dismiss="modal"><a style="color:white;" href="{{url('/doc-category-index')}}">Close</a></button>
            </div>
  </form>
 </div>
 </div>
<table class="table">
<thead>
  <tr>
   <th style="text-align:center;">Sr. No.</th>
   <th style="text-align:center;">Column Name</th>
   <th style="text-align:center;">Column Caption</th>
   <th style="text-align:center;">Type</th>
   <th style="text-align:center;">Data Control</th>
   <th style="text-align:center;">Special Char.</th>
   <!--<th style="text-align:center;">Mandatory Field</th>-->
   <th style="text-align:center;">Action</th>
  </tr>
  </thead>
  <tbody>
       @foreach($col_frm_table as $colv)
   
      <?php  $name = $colv->col_name; ?>
       
       @foreach($columns as $col)
        <tr>
          
          @if($col == $name)
        
          @if($col == 'id' || 'created_at' || 'updated_at')
         <td>{{$loop->index+1}}</td>
          <td class="hidden">{{$col}}</td>
          <td class="hidden"><a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')" href="{{url('drop-column')}}/{{$table_name1}}/{{$col}}"><i class="fas fa-trash" aria-hidden="true"></i></a></td>  
         
          @endif
        
          
           
          @if($colv->mandatory_status == 'yes')
          <td>{{$col}}<b style="color:red;"> *</b></td>
          @else
          <td>{{$col}}</td>
          @endif
          <td>{{$colv->col_caption}}</td>
          <td>{{$colv->data_type}}</td>
          <td>{{$colv->data_control}}</td>
          
          @if($colv->special_char_status == 'yes')
          <td><i class="fa fa-check-circle" style="color:green;" aria-hidden="true"></i></td>
          @else 
           <td><i class="fa fa-times-circle" style="color:red;" aria-hidden="true"></i></td>
          @endif
          
          
          <td><a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')" href="{{url('drop-column')}}/{{$table_name1}}/{{$col}}"><i class="fas fa-trash" aria-hidden="true"></i></a></td>  
         
          @endif
  </tr>
   @endforeach
    @endforeach
  </tbody>
  </table>
</div>
</div>


<script type="text/javascript">
      $(document).ready(function () {      
        $('#data-type').change(function () {
            var value = $(this).val(); var toAppend = '';
            if (value == 'text') {
                toAppend = "<select class='form-control doc_width' name='data_control'><option value='textbox'>Textbox</option><option value='textarea'>Textarea</option><option value='selectbox'>SelectBox</option></select>"; $("#datacontrol").html(toAppend); return;
            }
            if (value == 'string') {
                toAppend = "<select class='form-control doc_width' name='data_control'><option value='textbox'>Textbox</option><option value='textarea'>Textarea</option><option value='selectbox'>SelectBox</option></select>"; $("#datacontrol").html(toAppend); return;
            }
            if (value == 'string') {
                toAppend = "<select class='form-control doc_width' name='data_control'><option value='textbox'>Textbox</option><option value='textarea'>Textarea</option><option value='selectbox'>SelectBox</option></select>"; $("#datacontrol").html(toAppend); return;

            }
			 if (value == 'boolean') {
				 toAppend = "<select class='form-control doc_width' name='data_control'><option value='checkbox'>Checkbox</option><option value='radio'>Radio</option><option value='selectbox'>SelectBox</option></select>"; $("#datacontrol").html(toAppend); return;
            }
			if (value == 'char') {
				 toAppend = "<select class='form-control doc_width' name='data_control'><option value='textbox'>Textbox</option><option value='textarea'>Textarea</option><option value='selectbox'>SelectBox</option></select>"; $("#datacontrol").html(toAppend); return;
            }
			if (value == 'integer') {
				 toAppend = "<select class='form-control doc_width' name='data_control'><option value='number'>Number</option><option value='textbox'>Textbox</option><option value='textarea'>Textarea</option></select>"; $("#datacontrol").html(toAppend); return;
            }
			if (value == 'integer') {
				 toAppend = "<select class='form-control doc_width' name='data_control'><option value='number'>Number</option><option value='textbox'>Textbox</option><option value='textarea'>Textarea</option></select>"; $("#datacontrol").html(toAppend); return;
            }
			if (value == 'dateTime') {
				 toAppend = "<select class='form-control doc_width' name='data_control'><option value='date'>Date</option><option value='textbox'>Textbox</option></select>"; $("#datacontrol").html(toAppend); return;
            }
			if (value == 'timestamp') {
				 toAppend = "<select class='form-control doc_width' name='data_control'><option value='date'>Date</option><option value='textbox'>Textbox</option><option value='time'>Time</option></select>"; $("#datacontrol").html(toAppend); return;
            }
			if (value == 'date') {
				 toAppend = "<select class='form-control doc_width' name='data_control'><option value='date'>Date</option><option value='textbox'>Textbox</option><option value='time'>Time</option></select>"; $("#datacontrol").html(toAppend); return;
            }
			if (value == 'time') {
				 toAppend = "<select class='form-control doc_width' name='data_control'><option value='time'>Time</option><option value='textbox'>Textbox</option></select>"; $("#datacontrol").html(toAppend); return;
            }
			if (value == 'char') {
				 toAppend = "<select class='form-control doc_width' name='data_control'><option value='char'>Char</option><option value='textbox'>Textbox</option></select>"; $("#datacontrol").html(toAppend); return;
            }
			if (value == 'tinyText') {
				 toAppend = "<select class='form-control doc_width' name='data_control'><option value='textbox'>Textbox</option></select>"; $("#datacontrol").html(toAppend); return;
            }
			if (value == 'mediumText') {
				 toAppend = "<select class='form-control doc_width' name='data_control'><option value='textbox'>Textbox</option><option value='textarea'>Textarea</option></select>"; $("#datacontrol").html(toAppend); return;
            }
			if (value == 'longText') {
				 toAppend = "<select class='form-control doc_width' name='data_control'><option value='textbox'>Textbox</option><option value='textarea'>Textarea</option></select>"; $("#datacontrol").html(toAppend); return;
            }
			if (value == 'enum') {
				 toAppend = "<select class='form-control doc_width' name='data_control'><option value='number'>Number</option><option value='textbox'>Textbox</option></select>"; $("#datacontrol").html(toAppend); return;
            }
			if (value == 'float') {
				 toAppend = "<select class='form-control doc_width' name='data_control'><option value='number'>Number</option><option value='textbox'>Textbox</option></select>"; $("#datacontrol").html(toAppend); return;
            }
			if (value == 'double') {
				 toAppend = "<select class='form-control doc_width' name='data_control'><option value='number'>Number</option><option value='textbox'>Textbox</option></select>"; $("#datacontrol").html(toAppend); return;
            }
			if (value = 'decimal') {
				 toAppend = "<select class='form-control doc_width' name='data_control'><option value='number'>Number</option><option value='textbox'>Textbox</option></select>"; $("#datacontrol").html(toAppend); return;
            }

        });

    });
     </script>
    
@endsection
