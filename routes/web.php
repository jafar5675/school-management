<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\HomeworkController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CommunicateController;
use App\Http\Controllers\ExaminationsController;
use App\Http\Controllers\ClassSubjectControlloer;
use App\Http\Controllers\ClassTimetableController;
use App\Http\Controllers\FeesColeectionController;
use App\Http\Controllers\AssignClassTeacherController;
use App\Http\Controllers\ChatController;

/*
|--------------------------------------------------------------------------
| Web Routes
|    bitwise php manual
|---https://www.php.net/manual/en/language.operators.bitwise.php-----------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// যা বললে শিরকের অল্প ও বেশি সবই দূর হয়ে যাবে,
// (আল্লাহুম্মা ইন্নি আউজুবিকা আন উশরিকা বিকা ওয়া আনা আ’লামু, ওয়া আসতাগফিরুকা লিমা লা আ’লামু)
// এ ছাড়া আরেকটি এমন আমল আছে, যার মাধ্যমে কয়েক সেকেন্ডে সব কবিরা গুনাহ থেকে পবিত্র হওয়া যায়।
//  (আসতাগফিরুল্লাহাল আজিম আল্লাজি লা ইলাহা ইল্লা হুয়াল হাইয়্যুল কাইয়্যুমু ওয়া আতুবু ইলাইহি)

Route::get('/', [AuthController::class,'login']);
Route::post('login', [AuthController::class,'authLogin']);
Route::get('logout', [AuthController::class,'logout']);
Route::get('forgot-password', [AuthController::class,'forgotPassword']);
Route::post('forgot-password', [AuthController::class,'PostForgotPassword']);
Route::get('reset/{token}', [AuthController::class,'reset']);
Route::post('reset/{token}', [AuthController::class,'PostReset']);


Route::group(['middleware' => 'common'], function(){
    Route::get('chat', [ChatController::class, 'chat']);
    Route::post('submit_message', [ChatController::class, 'submit_message']);
    Route::post('get_chat_windows', [ChatController::class, 'get_chat_windows']);
    Route::post('get_chat_search_user', [ChatController::class, 'get_chat_search_user']);
});
Route::group(['middleware' => 'admin'], function(){
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('admin/admin/list', [AdminController::class,'list']);
    Route::get('admin/admin/add', [AdminController::class,'add']);
    Route::post('admin/admin/add', [AdminController::class,'insert']);
    Route::get('admin/admin/edit/{id}', [AdminController::class,'edit']);
    Route::post('admin/admin/edit/{id}', [AdminController::class,'update']);
    Route::get('admin/admin/delete/{id}', [AdminController::class,'delete']);


    // Teacher
    Route::get('admin/teacher/list', [TeacherController::class,'list']);
    Route::get('admin/teacher/add', [TeacherController::class,'add']);
    Route::post('admin/teacher/add', [TeacherController::class,'insert']);
    Route::get('admin/teacher/edit/{id}', [TeacherController::class,'edit']);
    Route::post('admin/teacher/edit/{id}', [TeacherController::class,'update']);
    Route::get('admin/teacher/delete/{id}', [TeacherController::class,'delete']);
    Route::post('admin/teacher/export_excel', [TeacherController::class,'export_excel']);

    // Student
    Route::get('admin/student/list', [StudentController::class,'list']);
    Route::get('admin/student/add', [StudentController::class,'add']);
    Route::post('admin/student/add', [StudentController::class,'insert']);
    Route::get('admin/student/edit/{id}', [StudentController::class,'edit']);
    Route::post('admin/student/edit/{id}', [StudentController::class,'update']);
    Route::get('admin/student/delete/{id}', [StudentController::class,'delete']);
    Route::post('admin/student/export_excel', [StudentController::class,'export_excel']);

    // Parent
    Route::get('admin/parent/list', [ParentController::class,'list']);
    Route::get('admin/parent/add', [ParentController::class,'add']);
    Route::post('admin/parent/add', [ParentController::class,'insert']);
    Route::get('admin/parent/edit/{id}', [ParentController::class,'edit']);
    Route::post('admin/parent/edit/{id}', [ParentController::class,'update']);
    Route::get('admin/parent/delete/{id}', [ParentController::class,'delete']);

    Route::get('admin/parent/my-student/{id}', [ParentController::class,'myStudent']);
    Route::get('admin/parent/assign_student_parent/{student_id}/{parent_id}', [ParentController::class,'assignParentStudent']);
    Route::get('admin/parent/assign_student_parent_delete/{student_id}', [ParentController::class,'assignParentStudentDelete']);
    Route::post('admin/parent/export_excel', [ParentController::class,'export_excel']);

    // class url
    Route::get('admin/class/list', [ClassController::class,'list']);
    Route::get('admin/class/add', [ClassController::class,'add']);
    Route::post('admin/class/add', [ClassController::class,'insert']);
    Route::get('admin/class/edit/{id}', [ClassController::class,'edit']);
    Route::post('admin/class/edit/{id}', [ClassController::class,'update']);
    Route::get('admin/class/delete/{id}', [ClassController::class,'delete']);

    // subject url
    Route::get('admin/subject/list', [SubjectController::class,'list']);
    Route::get('admin/subject/add', [SubjectController::class,'add']);
    Route::post('admin/subject/add', [SubjectController::class,'insert']);
    Route::get('admin/subject/edit/{id}', [SubjectController::class,'edit']);
    Route::post('admin/subject/edit/{id}', [SubjectController::class,'update']);
    Route::get('admin/subject/delete/{id}', [SubjectController::class,'delete']);

    // assign subject url
    Route::get('admin/assign_subject/list', [ClassSubjectControlloer::class,'list']);
    Route::get('admin/assign_subject/add', [ClassSubjectControlloer::class,'add']);
    Route::post('admin/assign_subject/add', [ClassSubjectControlloer::class,'insert']);
    Route::get('admin/assign_subject/edit/{id}', [ClassSubjectControlloer::class,'edit']);
    Route::post('admin/assign_subject/edit/{id}', [ClassSubjectControlloer::class,'update']);
    Route::get('admin/assign_subject/delete/{id}', [ClassSubjectControlloer::class,'delete']);
    Route::get('admin/assign_subject/edit_single/{id}', [ClassSubjectControlloer::class,'edit_single']);
    Route::post('admin/assign_subject/edit_single/{id}', [ClassSubjectControlloer::class,'update_single']);

    // Class Timetable
    Route::get('admin/class_timetable/list', [ClassTimetableController::class,'list']);
    Route::post('admin/class_timetable/get_subject', [ClassTimetableController::class,'get_subject']);
    Route::post('admin/class_timetable/add', [ClassTimetableController::class,'insert_update']);

    Route::get('admin/account', [UserController::class, 'MyAccount']);
    Route::post('admin/account', [UserController::class, 'UpdateMyAccountAdmin']);

    Route::get('admin/setting', [UserController::class, 'Setting']);
    Route::post('admin/setting', [UserController::class,'UpdateSetting']);

    Route::get('admin/change_password', [UserController::class,'change_password']);
    Route::post('admin/change_password', [UserController::class,'update_change_password']);
// assign class to teacher
    Route::get('admin/assign_class_teacher/list', [AssignClassTeacherController::class, 'list']);
    Route::get('admin/assign_class_teacher/add', [AssignClassTeacherController::class, 'add']);
    Route::post('admin/assign_class_teacher/add', [AssignClassTeacherController::class, 'insert']);
    Route::get('admin/assign_class_teacher/edit/{id}', [AssignClassTeacherController::class, 'edit']);
    Route::post('admin/assign_class_teacher/edit/{id}', [AssignClassTeacherController::class, 'update']);
    Route::get('admin/assign_class_teacher/edit_single/{id}', [AssignClassTeacherController::class, 'edit_single']);
    Route::post('admin/assign_class_teacher/edit_single/{id}', [AssignClassTeacherController::class, 'update_single']);
    Route::get('admin/assign_class_teacher/delete/{id}', [AssignClassTeacherController::class, 'delete']);

    // Examinations
    Route::get('admin/examinations/exam/list', [ExaminationsController::class,'exam_list']);
    Route::get('admin/examinations/exam/add', [ExaminationsController::class,'exam_add']);
    Route::post('admin/examinations/exam/add', [ExaminationsController::class,'exam_insert']);
    Route::get('admin/examinations/exam/edit/{id}', [ExaminationsController::class,'exam_edit']);
    Route::post('admin/examinations/exam/edit/{id}', [ExaminationsController::class,'exam_update']);
    Route::get('admin/examinations/exam/delete/{id}', [ExaminationsController::class,'exam_delete']);

    Route::get('admin/examinations/exam_schedule', [ExaminationsController::class,'exam_schedule']);
    Route::post('admin/examinations/exam_schedule_insert', [ExaminationsController::class,'exam_schedule_insert']);
    Route::get('admin/examinations/marks_register', [ExaminationsController::class,'marks_register']);

    Route::post('admin/examinations/submit_marks_register', [ExaminationsController::class,'submit_marks_register']);
    Route::post('admin/examinations/single_submit_marks_register', [ExaminationsController::class,'single_submit_marks_register']);
//    mark grade
    Route::get('admin/examinations/marks_grade', [ExaminationsController::class, 'marks_grade']);
    Route::get('admin/examinations/marks_grade/add', [ExaminationsController::class,'marks_grade_add']);
    Route::post('admin/examinations/marks_grade/add', [ExaminationsController::class,'marks_grade_insert']);
    Route::get('admin/examinations/marks_grade/edit/{id}', [ExaminationsController::class,'marks_grade_edit']);
    Route::post('admin/examinations/marks_grade/edit/{id}', [ExaminationsController::class,'marks_grade_update']);
    Route::get('admin/examinations/marks_grade/delete/{id}', [ExaminationsController::class,'marks_grade_delete']);
    Route::get('admin/my_exam_result/print', [ExaminationsController::class,'MyExamResultPrint']);

    Route::get('admin/attendance/student', [AttendanceController::class,'attendanceStudent']);
    Route::post('admin/attendance/student/save', [AttendanceController::class,'attendanceStudentSubmit']);
    Route::get('admin/attendance/report', [AttendanceController::class,'attendanceReport']);
    Route::post('admin/attendance/report_export_excel', [AttendanceController::class,'attendanceReportExcelExport']);

    Route::get('admin/communicate/notice_board', [CommunicateController::class,'NoticeBoard']);
    Route::get('admin/communicate/notice_board/add', [CommunicateController::class,'addNoticeBoard']);
    Route::post('admin/communicate/notice_board/add', [CommunicateController::class,'InsertNoticeBoard']);
    Route::get('admin/communicate/notice_board/edit/{id}', [CommunicateController::class,'EditNoticeBoard']);
    Route::post('admin/communicate/notice_board/edit/{id}', [CommunicateController::class,'UpdateNoticeBoard']);
    Route::get('admin/communicate/notice_board/delete/{id}', [CommunicateController::class,'DeleteNoticeBoard']);

    Route::get('admin/communicate/send_email', [CommunicateController::class,'SendEmail']);
    Route::post('admin/communicate/send_email', [CommunicateController::class,'SendEmailUser']);
    Route::get('admin/communicate/search_user', [CommunicateController::class,'SearchUser']);

    // home work
    Route::get('admin/homework/homework', [HomeworkController::class, 'homework']);
    Route::get('admin/homework/homework/add', [HomeworkController::class, 'homeworkAdd']);
    Route::post('admin/ajax_get_subject', [HomeworkController::class, 'ajax_get_subject']);
    Route::post('admin/homework/homework/add', [HomeworkController::class, 'insert']);
    Route::get('admin/homework/homework/edit/{id}', [HomeworkController::class, 'edit']);
    Route::post('admin/homework/homework/edit/{id}', [HomeworkController::class, 'update']);
    Route::get('admin/homework/homework/delete/{id}', [HomeworkController::class, 'delete']);
    Route::get('admin/homework/homework/submitted/{id}', [HomeworkController::class, 'submitted']);

    Route::get('admin/homework/homework_report', [HomeworkController::class, 'homeworkReport']);

    Route::get('admin/fees_collection/collect_fees', [FeesColeectionController::class, 'collect_fees']);
    Route::get('admin/fees_collection/collect_fees_report', [FeesColeectionController::class, 'collect_fees_report']);
    Route::post('admin/fees_collection/export_collect_fees_report', [FeesColeectionController::class, 'export_collect_fees_report']);

    Route::get('admin/fees_collection/collect_fees/add_fees/{student_id}', [FeesColeectionController::class, 'collect_fees_add']);
    Route::post('admin/fees_collection/collect_fees/add_fees/{student_id}', [FeesColeectionController::class, 'collect_fees_insert']);
});
Route::group(['middleware' => 'teacher'], function(){
    Route::get('teacher/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('teacher/change_password', [UserController::class,'change_password']);
    Route::post('teacher/change_password', [UserController::class,'update_change_password']);
    Route::get('teacher/account', [UserController::class, 'MyAccount']);
    Route::post('teacher/account', [UserController::class, 'UpdateMyAccountTeacher']);
    Route::get('teacher/my_student', [StudentController::class, 'MyStudent']);

    Route::get('teacher/my_class_subject', [AssignClassTeacherController::class, 'MyClassSubject']);
    Route::get('teacher/my_class_subject/class_timetable/{class_id}/{subject_id}', [ClassTimetableController::class, 'MyTimetableTeacher']);
    Route::get('teacher/my_exam_timetable', [ExaminationsController::class, 'MyExamTimetableTeacher']);
    Route::get('teacher/my_exam_result/print', [ExaminationsController::class,'MyExamResultPrint']);

    Route::get('teacher/my_calendar', [CalendarController::class, 'MyCalendarTeacher']);

    Route::get('teacher/marks_register', [ExaminationsController::class,'marks_register_teacher']);
    Route::post('teacher/submit_marks_register', [ExaminationsController::class,'submit_marks_register']);
    Route::post('teacher/single_submit_marks_register', [ExaminationsController::class,'single_submit_marks_register']);

    Route::get('teacher/attendance/student', [AttendanceController::class,'attendanceStudentTeacher']);
    Route::post('teacher/attendance/student/save', [AttendanceController::class,'attendanceStudentSubmit']);
    Route::get('teacher/attendance/report', [AttendanceController::class,'attendanceReportTeacher']);
    Route::get('teacher/my_notice_board', [CommunicateController::class, 'MyNoticeBoardTeacher']);
     // home work
     Route::get('teacher/homework/homework', [HomeworkController::class, 'HomeworkTeacher']);
     Route::get('teacher/homework/homework/add', [HomeworkController::class, 'homeworkAddTeacher']);
     Route::post('teacher/ajax_get_subject', [HomeworkController::class, 'ajax_get_subject']);
     Route::post('teacher/homework/homework/add', [HomeworkController::class, 'insertTeacher']);
     Route::get('teacher/homework/homework/edit/{id}', [HomeworkController::class, 'editTeacher']);
     Route::post('teacher/homework/homework/edit/{id}', [HomeworkController::class, 'updateTeacher']);
     Route::get('teacher/homework/homework/delete/{id}', [HomeworkController::class, 'delete']);
     Route::get('teacher/homework/homework/submitted/{id}', [HomeworkController::class, 'submittedTeacher']);

});
Route::group(['middleware' => 'student'], function(){
    Route::get('student/dashboard', [DashboardController::class, 'dashboard']);

    Route::get('student/change_password', [UserController::class,'change_password']);
    Route::post('student/change_password/{id}', [UserController::class,'update_change_password']);

    Route::get('student/account', [UserController::class, 'MyAccount']);
    Route::post('student/account', [UserController::class, 'UpdateMyAccountStudent']);

    Route::get('student/my_subject', [SubjectController::class, 'MySubject']);
    Route::get('student/my_timetable', [ClassTimetableController::class, 'MyTimetable']);

    Route::get('student/my_exam_timetable', [ExaminationsController::class, 'MyExamTimetable']);
    Route::get('student/my_calendar', [CalendarController::class, 'MyCalendar']);

    Route::get('student/my_exam_result', [ExaminationsController::class,'MyExamResult']);
    Route::get('student/my_exam_result/print', [ExaminationsController::class,'MyExamResultPrint']);

    Route::get('student/my_attendance', [AttendanceController::class,'MyAttendanceStudent']);

    Route::get('student/my_notice_board', [CommunicateController::class, 'MyNoticeBoardStudent']);

    Route::get('student/my_homework', [HomeworkController::class, 'StudentHomework']);
    Route::get('student/my_homework/submit_homework/{id}', [HomeworkController::class, 'SubmitHomework']);
    Route::post('student/my_homework/submit_homework/{id}', [HomeworkController::class, 'SubmitHomeworkInsert']);
    Route::get('student/my_submitted_homework', [HomeworkController::class, 'HomeworkSubmittedByStudent']);

    Route::get('student/fees_collection', [FeesColeectionController::class, 'CollectFeesStudent']);
    Route::post('student/fees_collection', [FeesColeectionController::class, 'CollectFeesStudentPayment']);

    Route::get('student/stripe/payment-error', [FeesColeectionController::class, 'PaymentError']);
    Route::get('student/stripe/payment-success', [FeesColeectionController::class, 'PaymentSuccessStripe']);
});
Route::group(['middleware' => 'parent'], function(){
    Route::get('parent/dashboard', [DashboardController::class,'dashboard']);

    Route::get('parent/change_password', [UserController::class,'change_password']);
    Route::post('parent/change_password', [UserController::class,'update_change_password']);

    Route::get('parent/account', [UserController::class, 'MyAccount']);
    Route::post('parent/account', [UserController::class, 'UpdateMyAccountParent']);

    Route::get('parent/my_student/subject/{student_id}', [SubjectController::class, 'ParentStudentSubject']);
    Route::get('parent/my_student/exam_timetable/{student_id}', [ExaminationsController::class, 'ParentMyExamTimetable']);
    Route::get('parent/my_student/exam_result/{student_id}', [ExaminationsController::class, 'ParentMyExamResult']);
    Route::get('parent/my_exam_result/print', [ExaminationsController::class,'MyExamResultPrint']);

    Route::get('parent/my_student/subject/class_timetable/{student_id}/{subject_id}/{user_id}', [ClassTimetableController::class, 'MyTimetableParent']);

    Route::get('parent/my_student/calendar/{student_id}', [CalendarController::class, 'myCalendarParent']);

    Route::get('parent/my_student/attendance/{Student_id}', [AttendanceController::class, 'myAttendanceParent']);

    Route::get('parent/my_student', [ParentController::class, 'myStudentParent']);

    Route::get('parent/my_student_notice_board', [CommunicateController::class, 'MyStudentNoticeBoardParent']);
    Route::get('parent/my_notice_board', [CommunicateController::class, 'MyNoticeBoardParent']);

    Route::get('parent/my_student/homework/{id}',[HomeworkController::class,'HomeworkStudentParent']);
    Route::get('parent/my_student/submitted_homework/{id}',[HomeworkController::class,'SubmittedHomeworkStudentParent']);

    Route::get('parent/my_student/fees_collection/{student_id}', [FeesColeectionController::class, 'CollectFeesStudentParent']);
    Route::post('parent/my_student/fees_collection/{student_id}', [FeesColeectionController::class, 'CollectFeesStudentPaymentParent']);

    Route::get('parent/paypal/payment_error/{student_id}', [FeesColeectionController::class, 'PaymentErrorParent']);
    Route::post('parent/paypal/payment_success/{student_id}', [FeesColeectionController::class, 'PaymentSuccessParent']);

});

// gojol
// https://fb.watch/pwKu8kxb5S/
