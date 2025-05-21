<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\studentController;

use App\Http\Controllers\formController;

use App\Http\Controllers\moreinfoController;

use App\Http\Controllers\dashboardController;

use App\Http\Controllers\incomeController;

use App\Http\Controllers\batchUploadController;

use App\Http\Controllers\SettingsController;

use App\Http\Controllers\cashierFormController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'ind
ex'])->name('home');

//Dashboard Controller
Route::get('/dashboard', [App\Http\Controllers\dashboardController::class, 'index'])->name('dashboard');
Route::get('/about/developer', [App\Http\Controllers\dashboardController::class, 'aboutus'])->name('about.developer');
Route::get('/about/system', [App\Http\Controllers\dashboardController::class, 'sysinfo'])->name('about.system');

//Student Controller
Route::get('/form/student_information', [App\Http\Controllers\formController::class, 'index'])->name('form.student');

//Income Controller
Route::get('/data/other_income', [App\Http\Controllers\incomeController::class, 'index'])->name('data.other_income');
Route::get('/data/incomeList', [App\Http\Controllers\incomeController::class, 'get_income_list'])->name('get.other_income');
Route::post('/data/income/save', [App\Http\Controllers\incomeController::class, 'Saveincome'])->name('store.income');
Route::post('/data/income/view', [App\Http\Controllers\incomeController::class, 'view'])->name('get.show.income');
Route::get('/data/edit/{id}', [App\Http\Controllers\incomeController::class, 'edit'])->name('edit.income');
Route::post('/data/update', [App\Http\Controllers\incomeController::class, 'update'])->name('update.income');
Route::post('/data/delete', [App\Http\Controllers\incomeController::class, 'deletePayment'])->name('delete.payments');
Route::post('/data/deleteSelectedStudents', [App\Http\Controllers\incomeController::class, 'deleteSelectedPayment'])->name('delete.selected.payment');

//Income Report
Route::post('/data/income/report', [App\Http\Controllers\incomeController::class, 'income_total'])->name('get.show.report');

//Report
Route::get('/form/reports', [App\Http\Controllers\formController::class, 'reportindex'])->name('forms.reports');
Route::post('/form/reports/total', [App\Http\Controllers\formController::class, 'total'])->name('forms.total');

Route::post('/form/tables/cashless', [App\Http\Controllers\formController::class, 'cashless_total'])->name('cashless.total');

//Form Controller
Route::get('/tables/studentdata', [App\Http\Controllers\studentController::class, 'index'])->name('table.student');
Route::get('/studentlist', [App\Http\Controllers\studentController::class, 'getStudentList'])->name('get.student.list');
Route::post('/tables/studentdata/save', [App\Http\Controllers\studentController::class, 'Saveform'])->name('store.student');
Route::post('/students/view', [App\Http\Controllers\studentController::class, 'view'])->name('get.show.payment');
Route::get('/payments_summary/view', [App\Http\Controllers\studentController::class, 'payments_history'])->name('get.payments.history');
Route::get('/students/edit/{id}', [App\Http\Controllers\studentController::class, 'edit'])->name('edit.payment');
Route::post('/students/update', [App\Http\Controllers\studentController::class, 'update'])->name('update.payment');

//Batch Upload Controller
Route::get('/download-student-data', [App\Http\Controllers\batchUploadController::class, 'downloadStudentData'])->name('download.student.data');
Route::get('/forms/batch_upload', [App\Http\Controllers\batchUploadController::class, 'index'])->name('student.batch_upload');
Route::post('/forms/import_excel', [App\Http\Controllers\batchUploadController::class, 'importExcel'])->name('student.Import');

Route::get('/data/archived', [App\Http\Controllers\studentController::class, 'archive'])->name('data.archive');
Route::get('/data/archivedstudentlist', [App\Http\Controllers\studentController::class, 'archivedStudentList'])->name('data.archivedStudentList');
Route::get('/data/cashdisbursement', [App\Http\Controllers\studentController::class, 'cashdisbursement'])->name('data.cashdisbursement');

//More Information Controller
Route::get('/moreinfo/registered', [App\Http\Controllers\moreinfoController::class, 'registered_students'])->name('moreinfo.registered');
Route::get('/moreinfo/paid_students', [App\Http\Controllers\moreinfoController::class, 'paid_students'])->name('moreinfo.paid_students');
Route::get('/moreinfo/withbalance_students', [App\Http\Controllers\moreinfoController::class, 'withbalance_students'])->name('moreinfo.withbalance_students');
Route::get('/moreinfo/payment_summary', [App\Http\Controllers\moreinfoController::class, 'payment_summary'])->name('moreinfo.payment_summary');

//Restore
Route::post('/students/restore', [App\Http\Controllers\studentController::class, 'restoreStudent'])->name('restore.student');

//Cashier Settings
Route::get('/settings/cashier', [App\Http\Controllers\SettingsController::class, 'index'])->name('setting.cashier');
Route::get('/settings/settings_data', [App\Http\Controllers\SettingsController::class, 'display'])->name('settings.data.list');
Route::post('/settings/stored', [App\Http\Controllers\SettingsController::class, 'setting_stored'])->name('setting.set');
Route::post('/data/delete', [App\Http\Controllers\SettingsController::class, 'setting_delete'])->name('delete.payments');
Route::post('/settings/view', [App\Http\Controllers\SettingsController::class, 'view'])->name('get.setting.payment');
Route::post('/settings/update', [App\Http\Controllers\SettingsController::class, 'setting_update'])->name('setting.update');
Route::post('/settings/delete/selected', [App\Http\Controllers\SettingsController::class, 'delete_selected_setting'])->name('setting.delete_selected');

//Settings
Route::get('/settings/annual_fee', [App\Http\Controllers\SettingsController::class, 'annual_index'])->name('setting.annual');
Route::get('/settings/annual_data_display', [App\Http\Controllers\SettingsController::class, 'annual_fee_display'])->name('settings.annual.display');

//Cashier Main Forms
Route::get('/cashier/mainform', [App\Http\Controllers\cashierFormController::class, 'index'])->name('cashier.mainform');

//Cashier Main Forms Search Student
Route::post('/student/store/info', [App\Http\Controllers\cashierFormController::class, 'Saveform'])->name('store.student.info');
Route::get('/student/search/form', [App\Http\Controllers\cashierFormController::class, 'searchStudentForm']);
Route::get('/student/search', [App\Http\Controllers\cashierFormController::class, 'searchStudent']);
Route::get('/student/get', [App\Http\Controllers\cashierFormController::class, 'GetStudent']);
Route::get('/student/get/payments', [App\Http\Controllers\cashierFormController::class, 'GetStudentPayment']);

//Archive
Route::post('/students/archive', [App\Http\Controllers\studentController::class, 'archiveStudent'])->name('archive.student');
Route::post('/students/archiveSelectedStudents', [App\Http\Controllers\studentController::class, 'archiveSelectedStudents'])->name('archive.selected.students');

Route::post('/students/delete', [App\Http\Controllers\studentController::class, 'deleteStudent'])->name('delete.payment');
Route::post('/students/deleteSelectedStudents', [App\Http\Controllers\studentController::class, 'deleteSelectedStudents'])->name('delete.selected.students');
