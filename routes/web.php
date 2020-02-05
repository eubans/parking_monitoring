<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'Controller@Login');
Route::get('login', 'Controller@Login');
Route::post('login/action', 'Controller@ActionLogin');
Route::get('logout', 'Controller@Logout');
Route::get('home', 'Controller@Home');

Route::get('forgot-password', 'Controller@Forgot_Password');
Route::post('forgot-password/send-verification-code', 'Controller@Send_Verification_Code');
Route::get('forgot-password/updateVerificationCode', 'Controller@updateVerificationCode');
Route::get('forgot-password/code-verification', 'Controller@Verify_Code');
Route::get('forgot-password/change-password', 'Controller@Change_Password');
Route::post('forgot-password/change-forgotten-password', 'Controller@Change_Password_Save');

Route::get('get-parking-status', 'Controller@getParkingStatus');
Route::get('get-ongoing-occupants', 'Controller@getOngoingOccupants');
Route::get('get-pending-reservations', 'Controller@getPendingReservation');
Route::get('get-queued-reservation-count', 'Controller@getQueuedReservationCount');
Route::get('get-occupant-queue-number', 'Controller@getOccupantQueueNumber');

Route::get('occupant-reserve-slot', 'Controller@reserveSlot');
Route::get('occupant-cancel-reservation', 'Controller@cancelReservation');

Route::get('occupant', 'Occupant@List');
Route::get('occupant/registration', 'Occupant@Registration');
Route::post('occupant/registration/save', 'Occupant@Registration_Save');
Route::get('occupant/profile', 'Occupant@Registration');
Route::get('occupant/profile/fetch', 'Occupant@getOccupantProfile');
Route::post('occupant/profile/toggle-status', 'Occupant@Occupant_Change_Status');
Route::post('occupant/profile/toggle-login', 'Occupant@Occupant_Change_Login');

Route::get('occupant/attendance-logs', 'Occupant@Attendance_Logs');

Route::get('scan', 'Scan@Index');
Route::get('scan/fetch-occupant-details', 'Scan@getOccupantDetails');
Route::get('scan/occupant/in', 'Scan@occupantTimeIn');
Route::get('scan/occupant/out', 'Scan@occupantTimeOut');
Route::get('scan/occupant/reserve', 'Scan@occupantReservation');
Route::get('scan/fetch-occupant-logs', 'Scan@getOccupantLogs');

Route::get('reservation', 'Reservation@List');
Route::get('reservation/logs', 'Reservation@Logs');
Route::get('reservation/cancel', 'Reservation@Cancel_Reservation');

Route::get('settings/global-variables', 'Settings@Global_Variables');
Route::post('settings/global-variables/parking-slot/save', 'Settings@Parking_Slot_Save');

Route::get('settings/user/list', 'Settings@User_List');
Route::get('settings/user', 'Settings@User');
Route::post('settings/user/save', 'Settings@User_Save');
Route::get('settings/user/fetch-details', 'Settings@getAdminitratorDetails');

Route::get('user-settings', 'Settings@User_Settings');
Route::post('user-settings/save', 'Settings@User_Settings_Save');

Route::post('user-settings/upload', 'Settings@uploadAvatar');
Route::get('user-settings/upload', 'Settings@uploadAvatar');

Route::get('qr-code', function () {
    return QrCode::size(250)->generate('2588cb9d5f503262dcf0b00d74f4bcf37bf0ad05');
});

Route::get('datenow', function () {
    return date('Y-m-d h:i:s');
});

Route::get('sample-sms', function () {

    $nexmo = app('Nexmo\Client');

    return $nexmo->message()->send([
        'to'   => '639059033184',
        'from' => '639059033184',
        'text' => "Testing. Parking Monitoring" . date('Y-m-d h:i:s')
    ]);
});
