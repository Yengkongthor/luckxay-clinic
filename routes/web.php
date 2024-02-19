<?php

use App\Events\AssignQueueToDoctor;
use App\Events\Examination;
use Illuminate\Support\Facades\Route;

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
    abort(404);
    // event(new Examination('payment'));
// return 'ok';
//   return view("welcome");
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('register', function () {
    abort(404);
})->name('register');


Route::namespace('Admin\Auth')->group(static function () {

    Route::get('/backend1112/login', 'LoginController@showLoginForm')->name('brackets/admin-auth::admin/login');
    Route::post('/admin/login', 'LoginController@login');

    Route::any('/admin/logout', 'LoginController@logout')->name('brackets/admin-auth::admin/logout');
});

Route::middleware(['shutdown', 'auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function () {
        Route::get('/', function () {
            return view('admin.dashboard.index');
        })->name('dashboard');

        // Route::get('/content',  'ContentController@index')->name('content');

        Route::get('/receptions', 'ReceptionController')->name('reception');
        Route::get('/general-consulation', 'GeneralConsulationController')->name('general-consulation');
        Route::get('/accounting', 'AccountingController')->name('accounting');
        Route::get('/pharmacy', 'PharmacyController')->name('pharmacy');
        Route::get('/lab-department', 'LabDepartment')->name('lab-department');

        Route::get('/test', function () {
            event(new AssignQueueToDoctor(14));
        });
    
        Route::get('/profile',                                      'ProfileController@editProfile')->name('edit-profile');
        Route::post('/profile',                                     'ProfileController@updateProfile')->name('update-profile');
        Route::get('/password',                                     'ProfileController@editPassword')->name('edit-password');
        Route::post('/password',                                    'ProfileController@updatePassword')->name('update-password');

        Route::post('/employee/status',                             'ProfileController@updateEmployeeStatus')->name('update-employee-status');
        Route::get('/profile/examination-class/{examinationClass}',                             'ProfileController@examinationClass')->name('update-employee-status');

        /* Shutdown */
        Route::get('/shutdown', 'ShutdownController@index');
        Route::post('/shutdown', 'ShutdownController@update');

        Route::prefix('content')->name('content')->group(static function () {
            Route::get('/',                                             'ContentController@index')->name('index');
            Route::get('/create',                                       'ContentController@create')->name('create');
            Route::post('/',                                            'ContentController@store')->name('store');
            Route::get('/{id}/show',                                    'ContentController@show')->name('show');
            Route::get('/{id}/edit',                                    'ContentController@edit')->name('edit');
            Route::post('/{id}',                                        'ContentController@update')->name('update');
            Route::post('/{id}/delete',                                      'ContentController@destroy')->name('destroy');
        });
        Route::prefix('admin-users')->name('admin-users/')->group(static function () {
            Route::get('/',                                             'AdminUsersController@index')->name('index');
            Route::get('/create',                                       'AdminUsersController@create')->name('create');
            Route::post('/',                                            'AdminUsersController@store')->name('store');
            Route::get('/{adminUser}/impersonal-login',                 'AdminUsersController@impersonalLogin')->name('impersonal-login');
            Route::get('/{adminUser}/edit',                             'AdminUsersController@edit')->name('edit');
            Route::post('/{adminUser}',                                 'AdminUsersController@update')->name('update');
            Route::delete('/{adminUser}',                               'AdminUsersController@destroy')->name('destroy');
            Route::get('/{adminUser}/resend-activation',                'AdminUsersController@resendActivationEmail')->name('resendActivationEmail');
        });

        Route::prefix('roles')->name('roles/')->group(static function () {
            Route::get('/',                                             'RolesController@index')->name('index');
            Route::get('/create',                                       'RolesController@create')->name('create');
            Route::post('/',                                            'RolesController@store')->name('store');
            Route::get('/{role}/edit',                                  'RolesController@edit')->name('edit');
            Route::post('/{role}',                                      'RolesController@update')->name('update');
            Route::delete('/{role}',                                    'RolesController@destroy')->name('destroy');
        });

        Route::prefix('permissions')->name('permissions/')->group(static function () {
            Route::get('/',                                             'PermissionsController@index')->name('index');
            Route::get('/create',                                       'PermissionsController@create')->name('create');
            Route::post('/',                                            'PermissionsController@store')->name('store');
            Route::get('/{permission}/edit',                            'PermissionsController@edit')->name('edit');
            Route::post('/{permission}',                                'PermissionsController@update')->name('update');
            Route::delete('/{permission}',                              'PermissionsController@destroy')->name('destroy');
        });

        Route::prefix('users')->name('users/')->group(static function () {
            Route::get('/',                                             'UsersController@index')->name('index');
            Route::get('/create',                                       'UsersController@create')->name('create');
            Route::post('/',                                            'UsersController@store')->name('store');
            Route::get('/{user}/edit',                                  'UsersController@edit')->name('edit');
            Route::post('/{user}',                                      'UsersController@update')->name('update');
            Route::delete('/{user}',                                    'UsersController@destroy')->name('destroy');
            Route::get('/{user}/resend-activation',                     'UsersController@resendActivationEmail')->name('resendActivationEmail');
        });

        Route::prefix('departments')->name('departments/')->group(static function () {
            Route::get('/',                                             'DepartmentsController@index')->name('index');
            Route::get('/create',                                       'DepartmentsController@create')->name('create');
            Route::post('/',                                            'DepartmentsController@store')->name('store');
            Route::get('/{department}/edit',                            'DepartmentsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'DepartmentsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{department}',                                'DepartmentsController@update')->name('update');
            Route::delete('/{department}',                              'DepartmentsController@destroy')->name('destroy');
        });

        Route::prefix('patient-histories')->name('patient-histories/')->group(static function () {
            Route::get('/{patientId}',                                  'PatientHistoriesController@getPatientHistory')->name('getPatientHistory');
            Route::get('/create',                                       'PatientHistoriesController@create')->name('create');
            Route::post('/',                                            'PatientHistoriesController@store')->name('store');
            Route::get('/{patientHistory}/edit',                        'PatientHistoriesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'PatientHistoriesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{patientHistory}',                            'PatientHistoriesController@update')->name('update');
            Route::delete('/{patientHistory}',                          'PatientHistoriesController@destroy')->name('destroy');
        });

        Route::prefix('queues')->name('queues/')->group(static function () {
            Route::get('/',                                             'QueuesController@index')->name('index');
            Route::get('/create',                                       'QueuesController@create')->name('create');
            Route::post('/',                                            'QueuesController@store')->name('store');
            Route::get('/{queue}/edit',                                 'QueuesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'QueuesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{queue}',                                     'QueuesController@update')->name('update');
            Route::delete('/{queue}',                                   'QueuesController@destroy')->name('destroy');

            Route::post('/change/status',                                      'QueuesController@changeStatus')->name('changeStatus');
        });

        Route::prefix('book-an-appointments')->name('book-an-appointments/')->group(static function () {
            Route::get('/',                                             'BookAnAppointmentsController@index')->name('index');
            Route::get('/create',                                       'BookAnAppointmentsController@create')->name('create');
            Route::post('/',                                            'BookAnAppointmentsController@store')->name('store');
            Route::get('/{bookAnAppointment}/edit',                     'BookAnAppointmentsController@edit')->name('edit');
            Route::post('/{bookAnAppointment}',                         'BookAnAppointmentsController@update')->name('update');
            Route::delete('/{bookAnAppointment}',                       'BookAnAppointmentsController@destroy')->name('destroy');
            Route::get('/times',                                        'BookAnAppointmentsController@getTimes');
        });

        Route::prefix('queues')->name('queues/')->group(static function () {
            Route::get('/',                                             'QueuesController@index')->name('index');
            Route::get('/employee/doctor',                              'QueuesController@getEmployeeDoctor')->name('getEmployeeDoctor');
            Route::get('/patient',                                      'QueuesController@getPatientQueue')->name('getPatientQueue');
            Route::get('/create',                                       'QueuesController@create')->name('create');
            Route::post('/',                                            'QueuesController@store')->name('store');
            Route::get('/{queue}/edit',                                 'QueuesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'QueuesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{queue}',                                     'QueuesController@update')->name('update');
            Route::delete('/{queue}',                                   'QueuesController@destroy')->name('destroy');
        });

        Route::prefix('medicines')->name('medicines/')->group(static function () {
            Route::get('/',                                             'MedicinesController@index')->name('index');
            Route::get('/create',                                       'MedicinesController@create')->name('create');
            Route::post('/',                                            'MedicinesController@store')->name('store');
            Route::get('/{medicine}/edit',                              'MedicinesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'MedicinesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{medicine}',                                  'MedicinesController@update')->name('update');
            Route::delete('/{medicine}',                                'MedicinesController@destroy')->name('destroy');
        });

        Route::prefix('examinations')->name('examinations/')->group(static function () {
            Route::get('/',                                             'ExaminationsController@index')->name('index');
            Route::get('/{status}',                                     'ExaminationsController@indexStatus')->name('indexStatus');
            Route::get('/patient-history',                              'ExaminationsController@getPatientHistory')->name('index');
            Route::get('/create',                                       'ExaminationsController@create')->name('create');
            Route::post('/',                                            'ExaminationsController@store')->name('store');
            Route::get('/{queue}/edit',                                 'ExaminationsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'ExaminationsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{examination}',                               'ExaminationsController@update')->name('update');
            Route::delete('/{examination}',                             'ExaminationsController@destroy')->name('destroy');
        });

        Route::prefix('departments')->name('departments/')->group(static function () {
            Route::get('/',                                             'DepartmentsController@index')->name('index');
            Route::get('/create',                                       'DepartmentsController@create')->name('create');
            Route::post('/',                                            'DepartmentsController@store')->name('store');
            Route::get('/{department}/edit',                            'DepartmentsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'DepartmentsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{department}',                                'DepartmentsController@update')->name('update');
            Route::delete('/{department}',                              'DepartmentsController@destroy')->name('destroy');
        });

        Route::prefix('booking-times')->name('booking-times/')->group(static function () {
            Route::get('/',                                             'BookingTimesController@index')->name('index');
            Route::get('/{status}',                               'BookingTimesController@indexStatus')->name('indexStatus');
            Route::get('/create',                                       'BookingTimesController@create')->name('create');
            Route::post('/',                                            'BookingTimesController@store')->name('store');
            Route::get('/{bookingTime}/edit',                           'BookingTimesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'BookingTimesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{bookingTime}',                               'BookingTimesController@update')->name('update');
            Route::delete('/{bookingTime}',                             'BookingTimesController@destroy')->name('destroy');
        });

        Route::prefix('employee-statuses')->name('employee-statuses/')->group(static function () {
            Route::get('/',                                             'EmployeeStatusesController@index')->name('index');
            Route::get('/create',                                       'EmployeeStatusesController@create')->name('create');
            Route::post('/',                                            'EmployeeStatusesController@store')->name('store');
            Route::get('/{employeeStatus}/edit',                        'EmployeeStatusesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'EmployeeStatusesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{employeeStatus}',                            'EmployeeStatusesController@update')->name('update');
            Route::delete('/{employeeStatus}',                          'EmployeeStatusesController@destroy')->name('destroy');


            Route::post('/assign/employee',                                        'EmployeeStatusesController@assign')->name('assign');
        });

        Route::prefix('labs')->name('labs/')->group(static function () {
            Route::get('/',                                             'LabsController@index')->name('index');
            Route::get('/create',                                       'LabsController@create')->name('create');
            Route::post('/',                                            'LabsController@store')->name('store');
            Route::get('/{lab}/edit',                                   'LabsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'LabsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{lab}',                                       'LabsController@update')->name('update');
            Route::delete('/{lab}',                                     'LabsController@destroy')->name('destroy');
        });

        Route::prefix('medicines')->name('medicines/')->group(static function () {
            Route::get('/',                                             'MedicinesController@index')->name('index');
            Route::get('/create',                                       'MedicinesController@create')->name('create');
            Route::post('/',                                            'MedicinesController@store')->name('store');
            Route::get('/{medicine}/edit',                              'MedicinesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'MedicinesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{medicine}',                                  'MedicinesController@update')->name('update');
            Route::delete('/{medicine}',                                'MedicinesController@destroy')->name('destroy');

            Route::get('/preview',                                       'MedicinesController@preview')->name('preview');
            Route::post('/preview/approved',                             'MedicinesController@updatePrice')->name('preview');
            Route::get('/stock/print/{typePrint}',                                   'MedicinesController@printStock')->name('printStock');
        });

        Route::prefix('lab-details')->name('lab-details/')->group(static function () {
            Route::get('/',                                             'LabDetailsController@index')->name('index');
            Route::get('/create',                                       'LabDetailsController@create')->name('create');
            Route::post('/',                                            'LabDetailsController@store')->name('store');
            Route::get('/{labDetail}/edit',                             'LabDetailsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'LabDetailsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{labDetail}',                                 'LabDetailsController@update')->name('update');
            Route::delete('/{labDetail}',                               'LabDetailsController@destroy')->name('destroy');
        });

        Route::prefix('services')->name('services/')->group(static function () {
            Route::get('/',                                             'ServicesController@index')->name('index');
            Route::get('/create',                                       'ServicesController@create')->name('create');
            Route::post('/',                                            'ServicesController@store')->name('store');
            Route::get('/{service}/edit',                               'ServicesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'ServicesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{service}',                                   'ServicesController@update')->name('update');
            Route::delete('/{service}',                                 'ServicesController@destroy')->name('destroy');
        });

        Route::prefix('exclude-dates')->name('exclude-dates/')->group(static function () {
            Route::get('/',                                             'ExcludeDatesController@index')->name('index');
            Route::get('/create',                                       'ExcludeDatesController@create')->name('create');
            Route::post('/',                                            'ExcludeDatesController@store')->name('store');
            Route::get('/{excludeDate}/edit',                           'ExcludeDatesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'ExcludeDatesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{excludeDate}',                               'ExcludeDatesController@update')->name('update');
            Route::delete('/{excludeDate}',                             'ExcludeDatesController@destroy')->name('destroy');
        });

        Route::prefix('booking-dates')->name('booking-dates/')->group(static function () {
            Route::get('/',                                             'BookingDatesController@index')->name('index');
            Route::get('/create',                                       'BookingDatesController@create')->name('create');
            Route::post('/',                                            'BookingDatesController@store')->name('store');
            Route::get('/{bookingDate}/edit',                           'BookingDatesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'BookingDatesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{bookingDate}',                               'BookingDatesController@update')->name('update');
            Route::delete('/{bookingDate}',                             'BookingDatesController@destroy')->name('destroy');
        });

        Route::prefix('branches')->name('branches/')->group(static function () {
            Route::get('/',                                             'BranchesController@index')->name('index');
            Route::get('/create',                                       'BranchesController@create')->name('create');
            Route::post('/',                                            'BranchesController@store')->name('store');
            Route::get('/{branch}/edit',                                'BranchesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'BranchesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{branch}',                                    'BranchesController@update')->name('update');
            Route::delete('/{branch}',                                  'BranchesController@destroy')->name('destroy');
        });

        Route::prefix('promotions')->name('promotions/')->group(static function () {
            Route::get('/',                                             'PromotionsController@index')->name('index');
            Route::get('/create',                                       'PromotionsController@create')->name('create');
            Route::post('/',                                            'PromotionsController@store')->name('store');
            Route::get('/{promotion}/edit',                             'PromotionsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'PromotionsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{promotion}',                                 'PromotionsController@update')->name('update');
            Route::delete('/{promotion}',                               'PromotionsController@destroy')->name('destroy');
        });

        Route::prefix('health-tips')->name('health-tips/')->group(static function () {
            Route::get('/',                                             'HealthTipsController@index')->name('index');
            Route::get('/create',                                       'HealthTipsController@create')->name('create');
            Route::post('/',                                            'HealthTipsController@store')->name('store');
            Route::get('/{healthTip}/edit',                             'HealthTipsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'HealthTipsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{healthTip}',                                 'HealthTipsController@update')->name('update');
            Route::delete('/{healthTip}',                               'HealthTipsController@destroy')->name('destroy');
        });

        Route::prefix('examination-services')->name('examination-services/')->group(static function () {
            Route::get('/',                                             'ExaminationServicesController@getPatientHistoryExamination')->name('index');
            Route::get('/{status}',                                     'ExaminationServicesController@getPateintExaminationService')->name('getQueue');
            Route::get('/create',                                       'ExaminationServicesController@create')->name('create');
            Route::post('/',                                            'ExaminationServicesController@store')->name('store');
            Route::get('/{examinationService}/edit',                    'ExaminationServicesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'ExaminationServicesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{examinationService}',                        'ExaminationServicesController@update')->name('update');
            Route::delete('/{examinationService}',                      'ExaminationServicesController@destroy')->name('destroy');


            Route::get('/view/{patientHistoryId}',                       'ExaminationServicesController@view')->name('view');
            Route::get('/load/examination-service',                      'ExaminationServicesController@getExaminationService')->name('getExaminationService');

            Route::post('/update/examination-service',                        'ExaminationServicesController@updateExaminationService')->name('updateExaminationService');
        });

        Route::prefix('basic-physical-examinations')->name('basic-physical-examinations/')->group(static function () {
            Route::get('/',                                             'BasicPhysicalExaminationsController@index')->name('index');
            Route::get('/create',                                       'BasicPhysicalExaminationsController@create')->name('create');
            Route::post('/',                                            'BasicPhysicalExaminationsController@store')->name('store');
            Route::get('/{basicPhysicalExamination}/edit',              'BasicPhysicalExaminationsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'BasicPhysicalExaminationsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{basicPhysicalExamination}',                  'BasicPhysicalExaminationsController@update')->name('update');
            Route::delete('/{basicPhysicalExamination}',                'BasicPhysicalExaminationsController@destroy')->name('destroy');
        });

        Route::prefix('uploads')->name('uploads/')->group(static function () {
            Route::get('/',                                             'UploadsController@index')->name('index');
            Route::get('/create',                                       'UploadsController@create')->name('create');
            Route::post('/',                                            'UploadsController@store')->name('store');
            Route::get('/{upload}/edit',                                'UploadsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'UploadsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{upload}',                                    'UploadsController@update')->name('update');
            Route::delete('/{upload}',                                  'UploadsController@destroy')->name('destroy');
        });

        Route::prefix('examination-results')->name('examination-results/')->group(static function () {
            Route::get('/',                                        'ExaminationResultController@index')->name('index');
            Route::get('/doctor-medicine/{patientHistoryId}',      'ExaminationResultController@indexDoctorMedicine')->name('indexDoctorMedicine');

            Route::post('/',                                        'ExaminationResultController@saveComment')->name('saveComment');
            Route::post('/input/again',                            'ExaminationResultController@inputAgain')->name('inputAgain');

            Route::get('/print',                                   'ExaminationResultController@printExaminationResult')->name('printExaminationResult');
            Route::get('/print/patient-info',                      'ExaminationResultController@printPatientInfo')->name('printPatientInfo');

            Route::get('/basic/physical/examination',              'ExaminationResultController@getBasicPhysicalExamination')->name('getBasicPhysicalExamination');
        });

        Route::prefix('medicine-histories')->name('medicine-histories/')->group(static function () {
            Route::get('/',                                             'MedicineHistoriesController@index')->name('index');
            Route::get('/create',                                       'MedicineHistoriesController@create')->name('create');
            Route::post('/',                                            'MedicineHistoriesController@store')->name('store');
            Route::get('/{medicineHistory}/edit',                       'MedicineHistoriesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'MedicineHistoriesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{medicineHistory}',                           'MedicineHistoriesController@update')->name('update');
            Route::delete('/{medicineHistory}',                         'MedicineHistoriesController@destroy')->name('destroy');
        });

        Route::prefix('prescribe-medicines')->name('prescribe-medicines/')->group(static function () {
            Route::get('/',                                             'PrescribeMedicinesController@index')->name('index');
            Route::get('/create',                                       'PrescribeMedicinesController@create')->name('create');
            Route::post('/',                                            'PrescribeMedicinesController@store')->name('store');
            Route::get('/{queue}/edit',                                 'PrescribeMedicinesController@edit')->name('edit');
            Route::get('/{examPackage}/edit/exam-package',              'PrescribeMedicinesController@editExamPackage')->name('edit');
            Route::post('/bulk-destroy',                                'PrescribeMedicinesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{prescribeMedicine}',                         'PrescribeMedicinesController@update')->name('update');
            Route::delete('/{prescribeMedicine}',                       'PrescribeMedicinesController@destroy')->name('destroy');

            Route::get('/medicines',                                    'PrescribeMedicinesController@getMedicine')->name('getMedicine');
            Route::get('/shopping-cart',                                'PrescribeMedicinesController@getShoppingCart')->name('getShoppingCart');
            Route::post('/shopping-cart/add',                           'PrescribeMedicinesController@addShoppingCart')->name('addShoppingCart');
            Route::post('/shopping-cart/remove',                        'PrescribeMedicinesController@remove')->name('remove');
            Route::post('/shopping-cart/add-amount',                        'PrescribeMedicinesController@addAmount')->name('addAmount');
            Route::post('/shopping-cart/confirm',                       'PrescribeMedicinesController@confirm')->name('confirm');
        });

        Route::prefix('shopping-carts')->name('shopping-carts/')->group(static function () {
            Route::get('/',                                             'ShoppingCartsController@index')->name('index');
            Route::get('/create',                                       'ShoppingCartsController@create')->name('create');
            Route::post('/',                                            'ShoppingCartsController@store')->name('store');
            Route::get('/{shoppingCart}/edit',                          'ShoppingCartsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'ShoppingCartsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{shoppingCart}',                              'ShoppingCartsController@update')->name('update');
            Route::delete('/{shoppingCart}',                            'ShoppingCartsController@destroy')->name('destroy');
        });

        Route::prefix('payments')->name('payments/')->group(static function () {
            Route::get('/',                                             'PaymentsController@index')->name('index');
            Route::get('/{status}',                                     'PaymentsController@indexStatus')->name('indexStatus');
            Route::get('/exam-package',                                 'PaymentsController@getPayPackage')->name('getPayPackage');
            Route::post('/pay',                                         'PaymentsController@pay')->name('pay');
            Route::get('/{queue}/edit',                                 'PaymentsController@edit')->name('edit');
            Route::get('/{examPackage}/edit-package',                   'PaymentsController@editPackage')->name('editPackage');

            Route::get('/print/bill',                                        'PaymentsController@print')->name('print');
        });

        Route::prefix('get-medicines')->name('get-medicines/')->group(static function () {
            Route::get('/',                                             'GetMedicinesController@index')->name('index');
            Route::get('/{status}',                                      'GetMedicinesController@indexStatus')->name('index');
            Route::post('/update',                                      'GetMedicinesController@update')->name('update');

            Route::get('/print/medicines',                               'GetMedicinesController@printMedicine')->name('printMedicine');
            Route::get('/print/medicines-7-5',                               'GetMedicinesController@printMedicine75')->name('printMedicine75');
            Route::get('/print/medicines-10-15',                               'GetMedicinesController@printMedicine1015')->name('printMedicine1015');

            Route::get('/print/exam-package',                           'GetMedicinesController@printMedicinePackage')->name('printMedicinePackage');
        });

        Route::prefix('packages')->name('packages/')->group(static function () {
            Route::get('/',                                             'PackagesController@index')->name('index');
            Route::get('/create',                                       'PackagesController@create')->name('create');
            Route::post('/',                                            'PackagesController@store')->name('store');
            Route::get('/{package}/edit',                               'PackagesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'PackagesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{package}',                                   'PackagesController@update')->name('update');
            Route::delete('/{package}',                                 'PackagesController@destroy')->name('destroy');

            Route::post('/exam/package',                                'PackagesController@packageExamination')->name('packageExamination');
        });

        Route::prefix('summaries')->name('summaries/')->group(static function () {
            Route::get('/',                                             'SummariesController@index')->name('index');
            Route::get('/create',                                       'SummariesController@create')->name('create');
            Route::post('/',                                            'SummariesController@store')->name('store');
            Route::get('/{summary}/edit',                               'SummariesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'SummariesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{summary}',                                   'SummariesController@update')->name('update');
            Route::delete('/{summary}',                                 'SummariesController@destroy')->name('destroy');

            Route::get('/print',                                        'SummariesController@print')->name('print');
        });

        Route::prefix('suppliers')->name('suppliers/')->group(static function () {
            Route::get('/',                                             'SuppliersController@index')->name('index');
            Route::get('/create',                                       'SuppliersController@create')->name('create');
            Route::post('/',                                            'SuppliersController@store')->name('store');
            Route::get('/{supplier}/edit',                              'SuppliersController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'SuppliersController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{supplier}',                                  'SuppliersController@update')->name('update');
            Route::delete('/{supplier}',                                'SuppliersController@destroy')->name('destroy');
        });

        Route::prefix('doctor-medicines')->name('doctor-medicines/')->group(static function () {
            Route::get('/',                                             'DoctorMedicinesController@index')->name('index');
            Route::get('/create',                                       'DoctorMedicinesController@create')->name('create');
            Route::post('/',                                            'DoctorMedicinesController@store')->name('store');
            Route::get('/{doctorMedicine}/edit',                        'DoctorMedicinesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'DoctorMedicinesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{doctorMedicine}',                            'DoctorMedicinesController@update')->name('update');
            Route::delete('/{doctorMedicine}',                          'DoctorMedicinesController@destroy')->name('destroy');
        });

        Route::prefix('brands')->name('brands/')->group(static function () {
            Route::get('/',                                             'BrandsController@index')->name('index');
            Route::get('/create',                                       'BrandsController@create')->name('create');
            Route::post('/',                                            'BrandsController@store')->name('store');
            Route::get('/{brand}/edit',                                 'BrandsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'BrandsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{brand}',                                     'BrandsController@update')->name('update');
            Route::delete('/{brand}',                                   'BrandsController@destroy')->name('destroy');
        });

        Route::prefix('categories')->name('categories/')->group(static function () {
            Route::get('/',                                             'CategoriesController@index')->name('index');
            Route::get('/create',                                       'CategoriesController@create')->name('create');
            Route::post('/',                                            'CategoriesController@store')->name('store');
            Route::get('/{category}/edit',                              'CategoriesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'CategoriesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{category}',                                  'CategoriesController@update')->name('update');
            Route::delete('/{category}',                                'CategoriesController@destroy')->name('destroy');
        });

        Route::prefix('medicine-pricings')->name('medicine-pricings/')->group(static function () {
            Route::get('/',                                             'MedicinePricingController@index')->name('index');
            Route::get('/create',                                       'MedicinePricingController@create')->name('create');
            Route::post('/',                                            'MedicinePricingController@store')->name('store');
            Route::get('/{medicinePricing}/edit',                       'MedicinePricingController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'MedicinePricingController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{medicinePricing}',                           'MedicinePricingController@update')->name('update');
            Route::delete('/{medicinePricing}',                         'MedicinePricingController@destroy')->name('destroy');
        });

        Route::prefix('exam-packages')->name('exam-packages/')->group(static function () {
            Route::get('/',                                             'ExamPackagesController@index')->name('index');
            Route::get('/create',                                       'ExamPackagesController@create')->name('create');
            Route::post('/',                                            'ExamPackagesController@store')->name('store');
            Route::get('/{examPackage}/edit',                           'ExamPackagesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'ExamPackagesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{examPackage}',                               'ExamPackagesController@update')->name('update');
            Route::delete('/{examPackage}',                             'ExamPackagesController@destroy')->name('destroy');
        });

        Route::prefix('call-pateints')->name('call-pateints/')->group(static function () {
            Route::get('/{patient}/{type}',                                             'CallPateintController@index')->name('index');
        });

        Route::prefix('exchanges')->name('exchanges/')->group(static function () {
            Route::get('/',                                             'ExchangesController@index')->name('index');
            Route::get('/create',                                       'ExchangesController@create')->name('create');
            Route::post('/',                                            'ExchangesController@store')->name('store');
            Route::get('/{exchange}/edit',                              'ExchangesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'ExchangesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{exchange}',                                  'ExchangesController@update')->name('update');
            Route::delete('/{exchange}',                                'ExchangesController@destroy')->name('destroy');
        });

        Route::prefix('notification-receptions')->name('notification-receptions/')->group(static function () {
            Route::get('/',                                             'NotificationReceptionsController@index')->name('index');
            Route::get('/create',                                       'NotificationReceptionsController@create')->name('create');
            Route::post('/',                                            'NotificationReceptionsController@store')->name('store');
            Route::get('/{notificationReception}/edit',                 'NotificationReceptionsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'NotificationReceptionsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{notificationReception}',                     'NotificationReceptionsController@update')->name('update');
            Route::delete('/{notificationReception}',                   'NotificationReceptionsController@destroy')->name('destroy');
        });

        Route::prefix('wages')->name('wages/')->group(static function () {
            Route::get('/',                                             'WagesController@index')->name('index');
            Route::get('/create',                                       'WagesController@create')->name('create');
            Route::post('/',                                            'WagesController@store')->name('store');
            Route::get('/{wage}/edit',                                  'WagesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'WagesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{wage}',                                      'WagesController@update')->name('update');
            Route::delete('/{wage}',                                    'WagesController@destroy')->name('destroy');
        });

        Route::prefix('owners')->name('owners/')->group(static function () {
            Route::get('/',                                             'OwnerController')->name('owner');
        });

        Route::prefix('reports')->name('reports/')->group(static function () {
            Route::get('/',                                             'ReportController@index')->name('index');
            Route::get('/view-summary/{status}',                          'ReportController@viewSummary')->name('viewSummary');
            Route::get('/get-summary',                                     'ReportController@getDataSummary')->name('getDataSummary');
            Route::get('/print/{dateForm}/{dateTo}/{status}',           'ReportController@printReport')->name('printReport');
            Route::get('/print/add/stock/{dateForm}/{dateTo}',          'ReportController@printReportAddStock')->name('printReportAddStock');

            Route::get('/download/excel',          'ReportController@download')->name('download');

        });

        Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

        Route::prefix('provinces')->name('provinces/')->group(static function () {
            Route::get('/',                                             'ProvincesController@index')->name('index');
            Route::get('/create',                                       'ProvincesController@create')->name('create');
            Route::post('/',                                            'ProvincesController@store')->name('store');
            Route::get('/{province}/edit',                              'ProvincesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'ProvincesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{province}',                                  'ProvincesController@update')->name('update');
            Route::delete('/{province}',                                'ProvincesController@destroy')->name('destroy');

            Route::get('/districts/{province_id}',                      'ProvincesController@getDistrict');
            Route::get('/districts-in-province/{id}',                   'ProvincesController@getDistrictInprovince');
        });

        Route::prefix('districts')->name('districts/')->group(static function () {
            Route::get('/',                                             'DistrictsController@index')->name('index');
            Route::get('/create',                                       'DistrictsController@create')->name('create');
            Route::post('/',                                            'DistrictsController@store')->name('store');
            Route::get('/{district}/edit',                              'DistrictsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'DistrictsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{district}',                                  'DistrictsController@update')->name('update');
            Route::delete('/{district}',                                'DistrictsController@destroy')->name('destroy');
        });

        Route::prefix('patient-statistics')->name('patient-statistics/')->group(static function () {
            Route::get('/',                                             'PatientStatisticsController@index')->name('index');
            Route::get('/create',                                       'PatientStatisticsController@create')->name('create');
            Route::post('/',                                            'PatientStatisticsController@store')->name('store');
            Route::get('/{patientStatistic}/edit',                      'PatientStatisticsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'PatientStatisticsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{patientStatistic}',                          'PatientStatisticsController@update')->name('update');
            Route::delete('/{patientStatistic}',                        'PatientStatisticsController@destroy')->name('destroy');
        });


        Route::prefix('profits')->name('profits/')->group(static function () {
            Route::get('/',                                             'ProfitController@index')->name('index');
            Route::get('/create',                                       'ProfitController@create')->name('create');
            Route::post('/',                                            'ProfitController@store')->name('store');
            Route::get('/{profit}/edit',                                'ProfitController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'ProfitController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{profit}',                                    'ProfitController@update')->name('update');
            Route::delete('/{profit}',                                  'ProfitController@destroy')->name('destroy');
        });

        Route::prefix('lab-xray-echos')->name('lab-xray-echos/')->group(static function () {
            Route::get('/',                                             'LabXrayEchoController@index')->name('index');
            Route::get('/create',                                       'LabXrayEchoController@create')->name('create');
            Route::post('/',                                            'LabXrayEchoController@store')->name('store');
            Route::get('/{labXrayEcho}/edit',                           'LabXrayEchoController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'LabXrayEchoController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{labXrayEcho}',                               'LabXrayEchoController@update')->name('update');
            Route::delete('/{labXrayEcho}',                             'LabXrayEchoController@destroy')->name('destroy');
        });

        Route::prefix('chart')->name('chart/')->group(static function () {
            Route::get('/',                                             'ChartController@index')->name('index');
        });

        Route::get('print-examination', 'ExaminationsController@printExamination');
        Route::get('/saline-10-15', 'GetMedicinesController@printSaline1015');
        Route::get('/saline-10-8', 'GetMedicinesController@printSaline108');
        Route::get('/saline-7-5', 'GetMedicinesController@printSaline75');



    });
});
