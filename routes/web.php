<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\JobOrderController;
use App\Http\Controllers\OccupantController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\OccupancyController;
use App\Http\Controllers\SchedulerController;
use App\Http\Controllers\UserLoginController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\WorkCategoryController;
use App\Http\Controllers\CategoryOptionController;
use App\Http\Controllers\RepresentativeController;
use App\Http\Controllers\ClientAppointmentController;
use App\Http\Controllers\MaintenanceLocationController;
use App\Http\Controllers\NotificationController;
use App\Http\Livewire\Admin\Employees;
use App\Http\Livewire\Admin\TransacttionLogs;
use App\Http\Livewire\Admin\Users;
use App\Http\Livewire\AppointmentDetails;
use App\Http\Livewire\Assigner\AssignFacilities;
use App\Http\Livewire\Assigner\AssignTenant;
use App\Http\Livewire\Assigner\StaffList;
use App\Http\Livewire\Facilities\UnderRestoration;
use App\Http\Livewire\NewTenant;
use App\Http\Livewire\Reports\CheckinReport;
use App\Http\Livewire\Reports\CheckoutReport;
use App\Http\Livewire\Scheduler\CreateAppointment;
use App\Http\Livewire\Scheduler\JobOrders;
use App\Http\Livewire\Scheduler\Restoration;
use App\Http\Livewire\Supervisor\CreateOpenAppointment;
use App\Http\Livewire\Supervisor\UpgradeCheckout;
use App\Http\Livewire\Tenants\CreateAppointments;
use App\Http\Livewire\Tenants\EditAppointments;
use App\Http\Livewire\Tenants\Survey;
use App\Http\Livewire\Users\Profile;
use App\Http\Livewire\Users\ResetPassword;
use App\Http\Livewire\UserSessions;
use Illuminate\Support\Facades\Auth;

// Auth::routes();

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.perform');

// Route Group for Tenant
Route::group(['middleware' => 'auth'], function() {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/reset-password', ResetPassword::class)->name('reset.password');
    Route::get('/logout', [LoginController::class, 'perform'])->name('logout');
});
Route::group(['middleware' => ['auth', 'appAccess']], function() {

    //    This is for Tenant dashboard
    Route::get('profile/{id}', Profile::class)->name('profile');
    Route::get('/reset/password', [UserLoginController::class, 'resetPassword'])->name('reset');
    Route::get('/help', function () {
        return view('help.index');
    });
    Route::put('/profile/update{id}', [UserLoginController::class, 'profileUpdate'])->name('profile.update');
    Route::put('/reset/password', [UserLoginController::class, 'newPassword'])->name('reset.store');

    Route::get('get-schedule', [ClientAppointmentController::class, 'searchSchedule'])->name('schedule.get');
    Route::put('cancel-appointment/{id}', [ClientAppointmentController::class, 'cancel'])->name('client-appointment.cancel');
    Route::put('update-appointment/{id}', [ClientAppointmentController::class, 'updateAppointment'])->name('update');
    Route::get('/show-chats/{id}', [ClientAppointmentController::class, 'showChat']);
    Route::put('request-checkout/{id}', [ClientAppointmentController::class, 'reqCheckout'])->name('reqCheckout.submit');
    Route::put('cancel-checkout/{id}', [ClientAppointmentController::class, 'cancelCheckout'])->name('cancel-checkout.submit');

    Route::get('/tenant/appointments/{var}', [ClientAppointmentController::class, 'tenantAppointments'])->name('tenant.appointments');
    Route::get('/appointments-edit/{buildingId}', EditAppointments::class)->name('edit.appointment');
    Route::get('/tenants-create-appointment', CreateAppointments::class)->name('create.appointments');
    Route::resource('/client-appointments', ClientAppointmentController::class);

    Route::get('appointment/{appointmentId}/details', AppointmentDetails::class)->name('appointment.info');

    Route::get('/appointment/{appointmentId}/survey', Survey::class)->name('survey');
    Route::get('/survey/{appointment}/show', [ClientAppointmentController::class, 'showSurvey'])->name('survey.show');
    Route::resource('/chats', ChatController::class);

    Route::get('notifications-list', [NotificationController::class, 'index'])->name('notification.index');
    Route::get('clear-notification', [NotificationController::class, 'clear'])->name('notification.clear');
    Route::post('notification/{id}', [NotificationController::class, 'destroy'])->name('notification.destroy');


    // This is for admin dashboard
    Route::group(['middleware' => ['user'] ], function () {


        Route::get('appointment-details/{id}', [AppointmentController::class, 'showAppointment'])->name('appointment.view');
        Route::put('appointment-closed/{id}', [AppointmentController::class, 'closedAppointment'])->name('appointment.closed');
        Route::get('/calendar', [AppointmentController::class, 'calendar'])->name('calendar');
        Route::get('closed-appointments', [AppointmentController::class, 'closed'])->name('appointments.closed');
        Route::get('open-appointments', [AppointmentController::class, 'open'])->name('appointments.open');
        Route::get('cancelled-appointments', [AppointmentController::class, 'cancelled'])->name('appointments.cancelled');
        Route::get('occupant-info/{badge}', [AppointmentController::class, 'info'])->name('client.info');
        Route::get('print-service-order/{id}', [AppointmentController::class, 'printJO'])->name('print.jo');
        Route::resource('/appointments', AppointmentController::class);

        Route::get('/category-options-import', [CategoryOptionController::class, 'importIndex']);
        Route::post('/category-options/import', [CategoryOptionController::class, 'import'])->name('import.category-options');
        Route::resource('/category-options', CategoryOptionController::class);

        Route::get('/maintenance-location-import', [MaintenanceLocationController::class, 'importIndex'])->name('maint-import');
        Route::post('/maintenance-location/import', [MaintenanceLocationController::class, 'import'])->name('import.maintenance-location');

        Route::post('search-occupants', [OccupantController::class, 'search'])->name('occupants.search');
        Route::get('occupants-import', [OccupantController::class, 'importIndex'])->name('occupants-import.index');
        Route::post('occupants-import', [OccupantController::class, 'import'])->name('import.occupants');
        Route::get('tenants-checkout', [OccupantController::class, 'checkout'])->name('tenants.checkout');
        Route::get('tenants-checkin', [OccupantController::class, 'checkin'])->name('tenant.show');
        Route::get('tenants-checkin/{id}', [OccupantController::class, 'checkinTenant'])->name('tenant.checkin');
        Route::put('checkin/store', [OccupantController::class, 'checkinStore'])->name('checkin.store');
        Route::resource('/occupants', OccupantController::class);


        Route::post('search-buildings', [BuildingController::class, 'search'])->name('buildings.search');
        Route::get('building-job-orders/{id}', [BuildingController::class, 'jobOrders'])->name('job-orders');
        Route::get('buildings-import', [BuildingController::class, 'importIndex'])->name('build-import.index');
        Route::post('buildings-import', [BuildingController::class, 'import'])->name('import.buildings');
        Route::get('facilities-restoration', UnderRestoration::class)->name('restoration');
        // Route::get('facilities-restoration', [BuildingController::class, 'restoration'])->name('restoration');
        Route::get('facilities-restoration/{type}', [BuildingController::class, 'restorationperType'])->name('restoration-type');
        Route::get('facilities/{type}', [BuildingController::class, 'indexperType'])->name('index-type');
        Route::put('facilities-release', [BuildingController::class, 'release'])->name('release.submit');
        Route::resource('facilities', BuildingController::class);


        Route::get('schedules-monitoring', [ScheduleController::class, 'monitoring'])->name('sched-monitoring.index');
        Route::get('schedules-import', [ScheduleController::class, 'importIndex'])->name('sched-import.index');
        Route::get('restoration-list', [ScheduleController::class, 'restorationList'])->name('restoration.list');
        Route::get('restoration-create', Restoration::class)->name('restoration.create');
        Route::post('restoration-store', [ScheduleController::class, 'storeRestoration'])->name('restoration.store');
        Route::post('schedules-import', [ScheduleController::class, 'import'])->name('import.schedules');
        Route::get('schedules-remove', [ScheduleController::class, 'removeSchedulesIndex'])->name('schedules.get');
        Route::post('schedules-remove', [ScheduleController::class, 'removeSchedules'])->name('remove.schedule');
        Route::resource('schedules', ScheduleController::class);

        Route::post('tenant/create', [UserController::class, 'tenantStore'])->name('tenant.create');
        Route::get('users-import', [UserController::class, 'importIndex'])->name('users-import.index');
        Route::get('tenants', [UserController::class, 'tenants'])->name('tenants.index');
        Route::post('users-import', [UserController::class, 'import'])->name('import.users');

        // Add new Tenant from LDAP
        Route::get('new-tenant', NewTenant::class)->name('new.tenant');
        Route::post('add-new-tenant', [RepresentativeController::class, 'addTenant'])->name('add.tenant');
        // End


        Route::get('employees-import', [EmployeeController::class, 'importIndex'])->name('emp-import.index');
        Route::post('employees-import', [EmployeeController::class, 'import'])->name('import.employees');
        Route::resource('employees', EmployeeController::class);

        Route::post('add-staff', [OccupancyController::class, 'addStaff'])->name('staff.store');
        Route::get('staff-list', StaffList::class)->name('staff.list');
        Route::get('occupancies-attachment/{user}', [OccupancyController::class, 'occAttachment'])->name('checkin.attachment');
        Route::get('occupancies-assigned', [OccupancyController::class, 'assigned'])->name('occupancies.assigned');
        Route::get('checkout-approved', [OccupancyController::class, 'checkApproved'])->name('checkout.approved');
        Route::get('occupancies-import-index', [OccupancyController::class, 'importIndex'])->name('occ-import.index');
        Route::post('occupancies-import', [OccupancyController::class, 'import'])->name('import.occupancies');
        Route::get('occupancies-details/{id}', [OccupancyController::class, 'details'])->name('occupancies.view');
        Route::resource('occupancies', OccupancyController::class);


        Route::get('checkout/{id}', [CheckoutController::class, 'checkoutView'])->name('checkout.view');
        Route::post('checkout/submit', [CheckoutController::class, 'checkOut'])->name('checkout.submit');


        Route::put('close-restoration/{id}', [JobOrderController::class, 'closeRestoration'])->name('restoration.closed');
        Route::get('job-orders-list/{id}', JobOrders::class)->name('job-orders.info');
        Route::resource('job-orders', JobOrderController::class);
        Route::resource('work-categories', WorkCategoryController::class);

        // For Generating Report
        Route::get('appointments-report', [ReportController::class, 'appointmentReportIndex'])->name('appointments.report');
        Route::get('appointment-report', [ReportController::class, 'appointmentReport'])->name('appointment.report');
        Route::get('checkin-reports', CheckinReport::class)->name('checkins.report');
        Route::get('checkout-reports', CheckoutReport::class)->name('checkouts.report');


        // For Sadara Representative
        Route::get('checkout-request', [RepresentativeController::class, 'reqCheckout'])->name('checkout.request');
        Route::get('checkout-tenant', [RepresentativeController::class, 'checkout'])->name('checkout.tenant');
        Route::get('occupied-facilities', [RepresentativeController::class, 'index'])->name('facilities.occupied');
        Route::get('occupied-facilities/{type}', [RepresentativeController::class, 'occupiedPerType'])->name('facilities-type.occupied');
        Route::get('vacant-facilities', [RepresentativeController::class, 'repVacant'])->name('facilities.vacant');
        Route::get('vacant-facilities/{type}', [RepresentativeController::class, 'repVacantPerType'])->name('facilities-type.vacant');
        Route::get('assigned-facilities', [RepresentativeController::class, 'assigned'])->name('facilities.assigned');
        Route::get('assign-facility', AssignTenant::class)->name('assign-facilty.tenant');
        Route::put('checkout-approve/{badge}', [RepresentativeController::class, 'appCheckout'])->name('appCheckout.submit');
        Route::post('assign/tenant', [RepresentativeController::class, 'assignStore'])->name('assign.store');

        // For RCL Scheduler
        Route::get('scheduler-create', CreateAppointment::class)->name('scheduler.create');
        // Route::get('scheduler-create', [SchedulerController::class, 'create'])->name('scheduler.create');
        Route::get('scheduler-schedule', [SchedulerController::class, 'searchSchedule'])->name('scheduler.search');
        Route::post('schedule-store', [SchedulerController::class, 'store'])->name('schedule.store');
        Route::post('preventive-maintenance-create', [SchedulerController::class, 'storePM'])->name('pm-schedule.store');
        Route::get('create-preventive-maintenance', [AppointmentController::class, 'emergencyCreate'])->name('pm.create');
        Route::get('preventive-maintenance-list', [SchedulerController::class, 'prevMaint'])->name('prevMaint');
        Route::get('maintenance-location', [AppointmentController::class, 'searchLocation'])->name('emergency.location');
        Route::get('maintenance-bulding', [AppointmentController::class, 'search'])->name('emergency.building');
        Route::post('emergency/appointment', [AppointmentController::class, 'emergencyStore'])->name('emergency.store');

        // Supervisor Create Open Appointment
        // This appointment will not check the availabilty of the appointment slot and can make appointment for later date
        Route::get('supervisor-appointment-create', CreateOpenAppointment::class)->name('supervisor.create');

        // Upgraded account need to be checkout
        Route::get('checkout-upgraded-account', UpgradeCheckout::class)->name('upgraded.checkout');

        Route::get('survey-scores', [AppointmentController::class, 'appointmentsWithSurvey'])->name('survey.scores');

        Route::group(['middleware' => 'admin' ], function () {
            Route::resource('users', UserController::class);
            Route::get('users-list', Users::class)->name('users');
            Route::get('employees-list', Employees::class)->name('employees');
            Route::get('sessions-list', UserSessions::class)->name('sessions.list');
            Route::get('transaction-logs', TransacttionLogs::class)->name('logs');
        });
    });


});


