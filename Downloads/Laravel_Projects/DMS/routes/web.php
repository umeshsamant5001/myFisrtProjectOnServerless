<?php

Auth::routes();
Route::get('/', function(){
    return view('auth.login');
});
Route::post('/login', 'Auth\LoginController@login');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/password-change/{id}', 'HomeController@changePassword');


Route::group(['middleware' => 'superadmin'], function()
{
// mst_comp_setup
//Route::get('/company-setup-list', 'CompanyController@companysList');
Route::get('/company-setup-index', 'CompanyController@index');
Route::get('/company-setup-create', 'CompanyController@companyCreate');
Route::post('/company-setup-store', 'CompanyController@companyStore');
Route::get('/company-setup-show/{id}', 'CompanyController@companyShow');
Route::get('/company-setup-edit/{id}', 'CompanyController@companyEdit');
Route::post('/company-setup-update/{id}', 'CompanyController@companyUpdate');
Route::get('/company-setup-delete/{id}', 'CompanyController@companyDelete');

// mst_users for admin
Route::get('/admindetails/{adminid}', 'MstAdminController@adminData');
Route::get('/admin-index', 'MstAdminController@index');
Route::get('/admin-create', 'MstAdminController@adminCreate');
Route::post('/admin-store', 'MstAdminController@adminStore');
Route::get('/admin-show/{id}', 'MstAdminController@adminShow');
Route::get('/admin-edit/{id}', 'MstAdminController@adminEdit');
Route::post('/admin-update/{id}', 'MstAdminController@adminUpdate');
Route::get('/admin-delete/{id}', 'MstAdminController@adminDelete');

// mst_rights
Route::get('/right-index', 'MstRightController@index');
Route::get('/right-create', 'MstRightController@rightCreate');
Route::post('/right-store', 'MstRightController@rightStore');
Route::get('/right-show/{id}', 'MstRightController@rightShow');
Route::get('/right-edit/{id}', 'MstRightController@rightEdit');
Route::post('/right-update/{id}', 'MstRightController@rightUpdate');
Route::get('/right-delete/{id}', 'MstRightController@rightDelete');

});

 Route::group(['middleware' => 'admin'], function()
{

// mst_designations
Route::get('desidetails/{id}', 'MstDesignationController@desiData');
Route::get('/designation-index', 'MstDesignationController@index');
Route::get('/designation-create', 'MstDesignationController@designationCreate');
Route::post('/designation-store', 'MstDesignationController@designationStore');
Route::get('/designation-show/{id}', 'MstDesignationController@designationShow');
Route::get('/designation-edit/{id}', 'MstDesignationController@designationEdit');
Route::post('/designation-update/{id}', 'MstDesignationController@designationUpdate');
Route::get('/designation-delete/{id}', 'MstDesignationController@designationDelete');

// mst_users
Route::get('details/{userid}', 'MstAdminController@userData');   
Route::get('/user-index', 'MstUserController@index');
Route::get('/user-create', 'MstUserController@userCreate');
Route::post('/user-store', 'MstUserController@userStore');
Route::get('/user-show/{id}', 'MstUserController@userShow');
Route::get('/user-edit/{id}', 'MstUserController@userEdit');
Route::post('/user-update/{id}', 'MstUserController@userUpdate');
Route::get('/user-delete/{id}', 'MstUserController@userDelete');

// mst_groups
Route::get('/group-member-list/{id}', 'MstGroupController@groupMember');
Route::post('/add-member/{id}', 'MstGroupController@addUsers');
Route::get('/delete-group-member/{id}','MstGroupController@removeMember');

Route::get('/groupdetails/{groupid}', 'MstGroupController@groupData');
Route::get('/group-index', 'MstGroupController@index');
Route::get('/group-create', 'MstGroupController@groupCreate');
Route::post('/group-store', 'MstGroupController@groupStore');
Route::get('/group-show/{id}', 'MstGroupController@groupShow');
Route::get('/group-edit/{id}', 'MstGroupController@groupEdit');
Route::post('/group-update/{id}', 'MstGroupController@groupUpdate');
Route::get('/group-delete/{id}', 'MstGroupController@groupDelete');

// mst_doc_category
Route::get('/doccatdetails/{doccatid}', 'MstDocCategoryController@doccatData');
Route::get('/doc-category-index', 'MstDocCategoryController@index');
Route::get('/doc-category-create', 'MstDocCategoryController@doccategoryCreate');
Route::post('/doc-category-store', 'MstDocCategoryController@doccategoryStore');
Route::get('/doc-category-show/{id}', 'MstDocCategoryController@doccategoryShow');
Route::get('/doc-category-edit/{id}', 'MstDocCategoryController@doccategoryEdit');
Route::post('/doc-category-update/{id}', 'MstDocCategoryController@doccategoryUpdate');
Route::get('/doc-category-delete/{id}', 'MstDocCategoryController@doccategoryDelete');
Route::get('/doccategorylist','FileUploadController@categories');

//assign group to doc-category
//Route::get('/allcabinets','MstDocCategoryController@allCabinets');
Route::get('/assign-group-index/{id}', 'MstDocCategoryController@assignGroup');
Route::post('/store-group-category/{id}', 'MstDocCategoryController@storeGroupdDoc');

//assign group to doc-category
Route::get('/assign-folder-index/{id}', 'MstDocCategoryController@assignFolder');
Route::post('/store-folder-category', 'MstDocCategoryController@storeFolderDoc');

// mst_cabinets
Route::get('/cabinetdetails/{cabinetid}', 'MstCabinetController@cabinetData');
Route::get('/cabinet-index', 'MstCabinetController@loadCabinets');
Route::get('/cabinet-create', 'MstCabinetController@cabinetCreate');
Route::post('/cabinet-store', 'MstCabinetController@cabinetStore');
Route::get('/cabinet-show/{id}', 'MstCabinetController@cabinetShow');
Route::get('/cabinet-edit/{id}', 'MstCabinetController@cabinetEdit');
Route::post('/cabinet-update/{id}', 'MstCabinetController@cabinetUpdate');
Route::get('cabinet-delete/{id}', 'MstCabinetController@cabinetDelete');


//sub folder

Route::get('/folder-listadmin', 'MstCabinetController@assignedFolders');
Route::get('/folderlist/{cabinetid}','MstCabinetController@folders');
Route::get('/foldertree','MstCabinetController@loadCabinets');
Route::get('/allcabinets','MstCabinetController@allCabinets');
Route::get('/folderdetails/{foldernm}', 'MstCabinetController@folderData');
Route::get('/subfolder/{cabinet}','MstCabinetController@cabinetId');
Route::post('/subfolder-create/{id}', 'MstCabinetController@createSubfolder');
Route::get('/subfolder-delete/{id}', 'MstCabinetController@deleteFolder');

//file uploading
Route::post('/upload-file', 'FileUploadController@uploadFile');
Route::get('/viewfile', 'FileUploadController@pdfview');

// tran_doc_cat_column 
Route::get('get-input-type', 'TableController@getInputType');
Route::get('/tran-doc-cat-index/{id}', 'TableController@index');
Route::post('/add-columns/{table_name}', 'TableController@addColumns');
Route::get('/drop-column/{table}/{column}', 'TableController@dropColumn');

});

Route::group(['middleware' => 'user'], function()
{
    
Route::get('/folder-list', 'UserFolderListController@index');
Route::post('/upload-file/{folder}', 'UserFolderListController@uploadFile');
Route::get('/files/{filename}', 'UserFolderListController@downloadFile');
Route::get('/viewfile/{filename}', 'UserFolderListController@viewPdfFile');
Route::get('/delete/{filename}', 'UserFolderListController@deleteFile');

//folders
Route::get('/folder-listu', 'MstCabinetController@assignedFoldersUser');
Route::get('/folderdetailsu/{foldernm}', 'MstCabinetController@folderDataUser');
});


// table create as per doc category
Route::post('/doc-cat-table-store', 'TableController@operate');

// mail send for register new user
Route::get('/registration-new-user', 'RegisterNewUserController@index');
Route::post('/send-mail', 'RegisterNewUserController@mailsendNewUser');
Route::get('/new-user-registration', 'RegisterNewUserController@userRegistrationFrom');
Route::post('/new-user-store', 'RegisterNewUserController@registerNewUserStore');

// Trial
Route::get('/new-file', function(){ return view('userview.upload-file');});
Route::post('/new-file-upload', 'UserFolderListController@manually');
 
// no-captcha
Route::get('captcha-form', 'CaptchaController@captchForm');
Route::post('store-captcha-form', 'CaptchaController@storeCaptchaForm');

//Check route Action
Route::get('/route-check', 'MstRoleController@getIndex');

