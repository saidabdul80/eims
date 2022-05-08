<?php







use App\Pacodes;



use Illuminate\Support\Facades\Route;



use Illuminate\Support\Facades\Input;







/*



|--------------------------------------------------------------------------



| Web Routes



|--------------------------------------------------------------------------



|



| Here is where you can register web routes for your application. These



| routes are loaded by the RouteServiceProvider within a group which



| contains the "web" middleware group. Now create something great!



|



*/







Route::get('/', function () {



    return view('index');



})->name('login');







Route::get('dashboard', 'appsController@dashboard')->name('dashboards.general_dashboard'); 

Route::any('post-login', 'userController@postLogin');







Route::group(['middleware' => ['login.auth']], function() {

  Route::get('mgt_institution','appsController@indexInstitution' )->name('mgt_institution'); 
  Route::get('mgt_institutions/{institution_id?}/{session_id?}/{search?}', 'appsController@searchStudent')->name('mgt_institution_search'); 

  Route::get('mgt_institution_create', 'appsController@createInstitution')->name('create_institution'); 
  
  Route::get('mgt_institution_delete/{id}', 'appsController@deleteInstitution')->name('delete_institution'); 
  Route::post('mgt_institution_upload_student/', 'appsController@uploadStudents')->name('upload_students'); 
  Route::get('delete_student/', 'appsController@deleteStudent')->name('delete_student'); 
  Route::post('update_student/', 'appsController@updateStudent')->name('update_student');
  Route::get('session/', function () {return view('institution.session');})->name('session');
  Route::post('add_update_session/', 'appsController@addUpdateSession')->name('add_update_session'); 
  Route::get('set_session/', 'appsController@setSession')->name('set_session'); 
  Route::get('delete_session/', 'appsController@deleteSession')->name('delete_session');
  Route::post('students_inventory_checker/', 'appsController@studentsInventoryChecker')->name('students_inventory_checker');
  

  Route::get('assign_tpa/', 'appsController@indexAssignTpa')->name('assign_tpa'); 
  Route::get('tpas/{start}/{length}/{search?}', 'appsController@allTpas')->name('tpas'); 
  Route::get('assign_tpa_to_institution/{tpa_id}/{institution_id}', 'appsController@tpaToInstitution'); 
  Route::get('deassign_tpa_from_institution/{id}', 'appsController@tpaFromInstitution'); 

  Route::get('providers-institution/', 'appsController@indexAssignProviderToInstitution')->name('pToI'); 
  Route::get('providers/{start}/{length}/{search?}', 'appsController@allProviders'); 
  Route::get('assign_provider_to_institution/{provider_id}/{institution_id}', 'appsController@providerToInstitution'); 
  Route::get('deassign_provider_from_institution/{id}', 'appsController@providerFromInstitution'); 
  Route::get('pay', 'appsController@makePay'); 
  Route::get('payment/callback', 'appsController@makePayCallback'); 

  
  


   Route::get('home', 'appsController@index')->name('eims.home'); 

   // Route::get('home-test', 'appsController@index')->name('eims.home'); 

    

    Route::get('test-sms', 'appsController@sendSms')->name('testSms'); 

    



   



    Route::post('/fetch_chart', 'appsController@loadChart')->name('chart-load');



   



    /////////////////////  Enrollment///////////////////////////////////



    



    Route::get('/all-enrollees', 'enrolleeController@all_enrollees')->name('enrolment.all'); 



    Route::get('/enrollees-by-provider', 'enrolleeController@enrollees_by_provider')->name('enrolment.enrollees-by-provider'); 



    Route::post('/enrollees-by-provider', 'enrolleeController@enrollees_by_provider')->name('enrolment.enrollees-by-provider-post'); 



    Route::post('/load-enrollee-info', 'enrolleeController@load_enrollee_info')->name('enrolment.load-enrollee-info'); 



    Route::post('/load-enrollee-info-with-biometric', 'enrolleeController@load_enrollee_info_with_biometric')->name('enrolment.load-enrollee-info-with-biometric'); 



    Route::post('/load-edit-enrollee-info', 'enrolleeController@load_edit_enrollee_info')->name('enrolment.load-edit-enrollee-info'); 



    Route::post('/update-enrollee-info', 'enrolleeController@update_enrollee_info')->name('enrolment.update-enrollee-info'); 



    Route::get('/idcard/{id}', 'enrolleeController@idcard')->name('enrolment.idcard'); 



    Route::get('/idcard-by-provider', 'enrolleeController@idcard_by_provider')->name('enrolment.idcard-by-provider'); 



    Route::any('/print-id-by-provider', 'enrolleeController@print_idcard_by_provider')->name('enrolment.print-id-by-provider'); 



    Route::get('/render_idcard', 'enrolleeController@render_idcard')->name('enrolment.render_idcard');



    Route::get('/render_idcard_by_provider', 'enrolleeController@render_idcard_by_provider')->name('enrolment.render_idcard_by_provider');



    Route::get('/enrolment-approval', 'enrolleeController@enrolment_approval')->name('enrolment.enrolment-approval');



    Route::post('/approve-reject-enrolment', 'enrolleeController@approve_reject_enrolment')->name('enrolment.approve-reject-enrolment');



    



    Route::get('/enrolment-slip-print', 'enrolleeController@enrolment_slip_print')->name('enrolment.enrolment-slip-print');



    Route::post('/print-bulk-enrolment-slip', 'enrolleeController@print_bulk_enrolment_slip')->name('enrolment.print-bulk-enrolment-slip');



      Route::post('/move-enrollees-to-another-provider', 'enrolleeController@move_enrollees_to_another_provider')->name('enrolment.move-enrollees-to-another-provider');

      Route::get('/recapture_list', 'enrolleeController@recapture_list')->name('enrolment.recapture-list');

      Route::get('/bhcpf-enrollees', 'enrolleeController@bhcpf_enrollees')->name('enrolment.bhcpf-enrollees');

      Route::post('/bhcpf-enrollees', 'enrolleeController@get_bhcpf_enrollees')->name('enrolment.get-bhcpf-enrollees');



    



    ///////////////////////////////// SETTINGS /////////////////////////////////////////////



    Route::get('/configure-bed', 'settingsController@configure_bed')->name('settings.configure-bed');



    Route::post('/create-new-nicare-device', 'settingsController@create_new_nicare_device')->name('settings.create-new-nicare-device');



    Route::post('/execute-device-operation', 'settingsController@execute_device_operation')->name('settings.execute-device-operation');



    Route::post('/assign-lga-to-device', 'settingsController@assign_lga_to_device')->name('settings.assign-lga-to-device');



    Route::any('/make-device-lga-active/{id}', 'settingsController@make_device_lga_active')->name('settings.make-device-lga-active');



    Route::any('/make-device-lga-inactive/{id}', 'settingsController@make_device_lga_inactive')->name('settings.make-device-lga-inactive');



    



    Route::post('/assign-device-to-staff', 'settingsController@assign_device_to_staff')->name('settings.assign-device-to-staff');



    Route::post('/create-huwe-staff', 'settingsController@create_huwe_staff')->name('settings.create-huwe-staff');



    



    



      Route::post('/create-new-encounter-device', 'settingsController@create_new_encounter_device')->name('settings.create-new-encounter-device');







    //////////////////////////////// CAPITATION /////////////////////////////////////////////



    Route::get('/generate-capitation', 'capitationController@generate_capitation')->name('capitation.generate-capitation');



    Route::get('/generate-capitation/{id}', 'capitationController@generate_capitation_info')->name('capitation.generate-capitation-info');



    Route::any('/new-capitation-file', 'capitationController@new_capitation_file')->name('capitation.new-capitation-file');



    Route::any('/generate-new-capitation', 'capitationController@generate_new_capitation')->name('capitation.generate-new-capitation');



    Route::any('/load-cap-months', 'capitationController@load_cap_months')->name('capitation.load-cap-months');



    



    Route::get('/approve-capitation', 'capitationController@approve_capitation')->name('capitation.approve-capitation');



    Route::get('/approve-capitation/{id}', 'capitationController@approve_capitation_info')->name('capitation.approve-capitation-info');



    Route::any('/approve-selected-capitation', 'capitationController@approve_selected_capitation')->name('capitation.approve-selected-capitation');







    Route::get('/capitation-payment', 'capitationController@capitation_payment')->name('capitation.capitation-payment');



    Route::any('/pay-selected-capitation', 'capitationController@pay_selected_capitation')->name('capitation.pay-selected-capitation');



    



    ///////////////////////////////// Manage Users /////////////////////////////////////////////



    Route::get('/manage-users', 'manageUsers@index')->name('manage_users');



    Route::post('/new-users', 'manageUsers@add_user')->name('add_user');



    Route::get('/user_forms', 'manageUsers@user_forms')->name('user_forms');



    



      ///////////////////////// PRovider ////////////////////////



    Route::get('/manage-providers', 'manageProvider@index')->name('manage_providers');



    Route::get('/manage-providers/view/{code}', 'manageProvider@view')->name('provider.view');



    Route::get('/manage-providers/edit/{code}', 'manageProvider@edit')->name('provider.edit');



    Route::post('/update-provider', 'manageProvider@update')->name('provider.update');



    



     ///////////////////////// Premium ////////////////////////

     Route::get('/premium-reports', 'appsController@premium_reports')->name('premium.reports');

     Route::post('/premium-reports', 'appsController@send_reminder')->name('premium.sendSms');

     Route::get('/message-history', 'appsController@message_history')->name('premium.message_history');

     

    



    Route::get('/logout', 'appsController@logout')->name('logout');



   



});







Route::group(['middleware' => ['login.auth','pas.auth']], function() {



    Route::prefix('pas')->group(function () {



        Route::get('home', 'pacodeController@index')->name('pas.home');



    });



});