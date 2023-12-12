<?php

use App\Http\Controllers\EmailController;
use App\Http\Controllers\PackagesController;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\LoginController;
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


Route::get('/login', [LoginController::class,'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/shared/{url}',[DashboardController::class, 'tableResult'])->name('share');
Route::get('/share/{id}',[DashboardController::class, 'tableSingleResult'])->name('shareSingle');
Route::get('/teacherPublicProfile/{id}',[DashboardController::class, 'teacherPublicProfile'])->name('shareTeacher');
// Out of System Registration Forms
Route::get('/registerStudent',[StudentController::class, 'register'])->name('publicStudent');
Route::get('/registerTeacher', [TeacherController::class, 'register'])->name('publicTeacher');
Route::Post('/storeStudent', [StudentController::class, 'store']);
Route::POST('/storeTeacher', [TeacherController::class, 'store']);
Route::get('/reviewFormStudent/{id}', [DashboardController::class, 'reviewForm'])->name('reviewFormStudent');
Route::get('/reviewFormTeacher/{id}', [DashboardController::class, 'reviewForm'])->name('reviewFormTeacher');
Route::POST('/storeReview', [DashboardController::class, 'storeReview'])->name('storeReview');
Route::get('/reviews', [DashboardController::class, 'reviews'])->name('reviews');


Route::middleware(['auth', 'role:1'])->group(function () {
    Route::get('/allStaff', [UserController::class, 'index']);
    Route::get('/addStaff', [UserController::class, 'add']);
    Route::POST('/storeUser', [UserController::class, 'store']);
    Route::get('/editUser/{id}', [UserController::class, 'edit']);
    Route::POST('/updateUser', [UserController::class, 'update']);
    Route::get('/deleteUser/{id}', [UserController::class, 'Destroy']);
    Route::get('/deleteStudent/{id}', [StudentController::class, 'Destroy']);
    Route::get('/deleteTeacher/{id}', [TeacherController::class, 'Destroy']);
   
    
});

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/find/{id}', [DashboardController::class, 'search'])->name('find');
    Route::get('/find', [DashboardController::class, 'findResults'])->name('findResults');
    Route::POST('/findTeachers', [DashboardController::class, 'findTeacher']);


//Student Routes
    Route::get('/StudentProfile/{id}', [StudentController::class, 'profile']);
    Route::get('/allStudents', [StudentController::class, 'index']);
    Route::get('/addStudent', [StudentController::class, 'add']);
    Route::get('/editStudent/{id}', [StudentController::class, 'edit']);
    Route::POST('/updateStudent', [StudentController::class, 'update']);
    Route::get('/studentReport/{id}', [StudentController::class, 'report']);
    Route::get('/changePermission/{id}/{status}', [StudentController::class, 'changePermission']);


//Teacher Routes
    Route::get('/TeacherProfile/{id}', [TeacherController::class, 'profile']);
    Route::get('/allTeachers', [TeacherController::class, 'index']);
    Route::get('/addTeacher', [TeacherController::class, 'add']);
    Route::get('/editTeacher/{id}', [TeacherController::class, 'edit']);
    Route::POST('/updateTeacher', [TeacherController::class, 'update']);
    Route::get('teacher.cv/{cv}', [TeacherController::class, 'showCV'])->name('teacher.cv');
    Route::post('/send-email', [TeacherController::class, 'sendEmail'])->name('send.email');


// Subjects Routes
    Route::get('/Subjects', [SubjectsController::class, 'index']);
    Route::POST('/addSubject', [SubjectsController::class, 'store']);
    Route::get('/deleteSubject/{id}', [SubjectsController::class, 'Destroy']);
    Route::get('/classLevels', [SubjectsController::class, 'classLevelsIndex']);
    Route::POST('/addClassLevel', [SubjectsController::class, 'addClassLevel']);
    Route::get('/deleteClassLevel/{id}', [SubjectsController::class, 'DestroyClassLevel']);
    Route::get('/cities', [SubjectsController::class, 'citiesIndex']);
    Route::POST('/addCity', [SubjectsController::class, 'addCity']);
    Route::get('/deleteCity/{id}', [SubjectsController::class, 'DestroyCity']);
    Route::get('/todo', [SubjectsController::class, 'todoIndex']);
    Route::POST('/addTask', [SubjectsController::class, 'addTask']);
    Route::get('/deleteTodo/{id}', [SubjectsController::class, 'deleteTodo']);
    Route::get('/updateTodo/{id}', [SubjectsController::class, 'updateTodo']);
    Route::POST('/updateRemark', [SubjectsController::class, 'updateRemark']);

    Route::get('/studentBilling', [BillingController::class, 'studentIndex']);
    Route::POST('/store', [BillingController::class, 'store']);
    Route::get('/Billing/{id}', [BillingController::class, 'studentBilling']);
    Route::get('/studentScheduleDownload/{id}', [BillingController::class, 'studentScheduleDownload']);
    Route::POST('/createSchedule', [BillingController::class, 'createSchedule']);
    Route::POST('/recurringClasses', [BillingController::class, 'recurringClasses']);
    Route::post('/update-status', [BillingController::class, 'updateStatus']);
    Route::get('/teacherBilling', [BillingController::class, 'teacherIndex']);
    Route::get('/teacherBillingFull/{id}', [BillingController::class, 'teacherBilling']);
    Route::get('/teacherScheduleDownload/{id}', [BillingController::class, 'teacherScheduleDownload']);
    Route::get('/deleteBill/{id}', [BillingController::class, 'destroyBill']);
    Route::get('/editBill/{id}', [BillingController::class, 'editBill']);
    Route::POST('/updateClass', [BillingController::class, 'updateClass']);
    Route::get('/clearCredit/{id}', [BillingController::class, 'clearCredit']);
    Route::get('/sendReview/{id}/{role}', [BillingController::class, 'sendReview']);
    
    Route::get('/packages/{id}', [PackagesController::class, 'allPackages']);
    Route::POST('/createPackage', [PackagesController::class, 'createPackage']);
    Route::get('/deletePackage/{studentId}/{id}', [PackagesController::class, 'Destroy']);
    Route::get('/editPackage/{id}', [PackagesController::class,'editPackage']);
    Route::POST('/updatePackage', [PackagesController::class, 'updatePackage']);
    Route::get('/packageDetails/{id}/{studentId}', [PackagesController::class, 'packageFull']);

    Route::get('/alertForm/{id}/{classTime}/{teacherId}', [DashboardController::class,'alertForm']);
    Route::POST('/sendAlert', [DashboardController::class, 'alertEmail']);

    Route::get('/sendStudentSchedule/{id}', [DashboardController::class, 'sendSchedule'])->name('studentSchedule');
    Route::get('/sendSchedule/{id}', [DashboardController::class, 'sendSchedule'])->name('teacherSchedule');

    Route::get('/register', [BillingController::class ,'registerIndex']);
    Route::POST('/storeRegister', [BillingController::class ,'storeRegister']);
    Route::get('/deleteRecord/{id}', [BillingController::class ,'deleteRecord']);
    Route::POST('/showClasses', [DashboardController::class ,'showClasses']);
    Route::POST('/showClasses2', [DashboardController::class ,'showClasses2']);
    Route::get('/sendClassReminder/{id}', [DashboardController::class, 'sendClassReminder']);

    Route::get('/logout', [LoginController::class, 'logout']);
    
    Route::get('/reminderEmail/{id}', [DashboardController::class, 'reminderEmailForm'])->name("reminderEmail");
});
    Route::get('/teacherEmail',[DashboardController::class,'teacherEmailForm']);
    Route::POST('/sendTeacherEmail',[DashboardController::class,'sendTeacherEmail']);
    Route::get('/studentEmail',[DashboardController::class,'studentEmailForm']);
    Route::POST('/sendStudentEmail',[DashboardController::class,'sendStudentEmail']);
    Route::get('/teachersReport', [TeacherController::class, 'teachersReport']);
    Route::get('/studentsMonthlyReport', [StudentController::class, 'studentsMonthlyReport']);
    Route::get('/reminderEmailForm/{name}', [StudentController::class, 'reminderEmailForm'])->name('reminderEmailForm');
    Route::POST('/sendPaymentReminder', [StudentController::class, 'sendPaymentReminder']);
//Route::get('/sendReminder', [EmailController::class, 'sendReminder']);




