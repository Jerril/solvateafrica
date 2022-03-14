<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserManagement\AuthController;
use App\Http\Controllers\Location\LocationController;
use App\Http\Controllers\UserManagement\UserProfileController;
use App\Http\Controllers\WorkProfileController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\CertificationController;
use App\Http\Controllers\Gig\ExtragigserviceController;
use App\Http\Controllers\Gig\FaqController;
use App\Http\Controllers\Gig\Gallerycontroller;
use App\Http\Controllers\Gig\Gigcontroller;
use App\Http\Controllers\Gig\GigquestionController;
use App\Http\Controllers\Gig\ScopePackageController;
use App\Http\Controllers\Project\TaskContainerController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\Project\ProjectController;
use App\Http\Controllers\Project\TaskController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TrackorderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/testmail', [AuthController::class, 'testmail']);
Route::get('/verifyaccount', [AuthController::class, 'verifyaccount']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/socialmedialogin', [AuthController::class, 'socialmedialogin']);
Route::post('/socialmediaregister', [AuthController::class, 'socialmediaregister']);
Route::post('/forgotpassword', [ AuthController::class, 'forgotpassword']);
Route::put('/resetpassword',[ AuthController::class, 'resetpassword']);

Route::get('/get_countries',[ LocationController::class, 'getcountries' ]);
Route::get('/get_states/{countryId}', [ LocationController::class, 'getstates']);
Route::get('/get_cities/{stateId}', [ LocationController::class, 'getcities' ]);

Route::get("getalljobs", [JobController::class, 'getAllJobs'])->name('getalljobs');

Route::prefix("gig")->group(function () {
  Route::get("search", [Gigcontroller::class, 'search']);
  Route::get("getallgigs", [Gigcontroller::class, 'getallgigs']);
  Route::get("getusergigs/{id}", [Gigcontroller::class, 'getusergigs']);
});

Route::get("getallcategories", [CategoryController::class, 'index']);
  
Route::middleware('auth:sanctum')->group(function(){
    Route::post('/updateorcreateprofile',[UserProfileController::class, 'updateorcreate']);

    Route::get('getuser/{id}', [UserProfileController::class, 'getuser']);

    Route::prefix("gig")->group(function () {
      
        Route::post("store", [Gigcontroller::class, 'store']);
        Route::get("get", [Gigcontroller::class, 'index']);
        Route::get("{id}", [Gigcontroller::class, 'show']);
        Route::put("{id}", [Gigcontroller::class, 'update']);
        Route::delete("{id}", [Gigcontroller::class, 'destroy']);
      
       // Route::get("jide", [Gigcontroller::class, 'search']);
    });

    Route::prefix("gallery")->group(function () {
        Route::post("store", [GalleryController::class, 'store']);
        Route::get("get/{gigId}", [GalleryController::class, 'index']);
        Route::put("{id}", [GalleryController::class, 'update']);
        Route::delete("{id}", [GalleryController::class, 'destroy']);
    });

    Route::prefix("scopepackage")->group(function () {
        Route::post("store", [ScopePackageController::class, 'store']);
        Route::get("get/{gigId}", [ScopePackageController::class, 'index']);
        Route::put("{id}", [ScopePackageController::class, 'update']);
        Route::delete("{id}", [ScopePackageController::class, 'destroy']);
    });

    Route::prefix("trackorder")->group(function () {
        Route::post("store/{id}", [TrackorderController::class, 'store']);
        Route::get("get", [TrackorderController::class, 'index']);
        Route::delete("{id}", [TrackorderController::class, 'destroy']);
    });

    Route::prefix("project")->group(function () {
        Route::post("store", [ProjectController::class, 'store']);
        Route::get("get", [ProjectController::class, 'index']);
        Route::get("getprojectsbyuser/{id}", [ProjectController::class, 'getProjectsByUser']);
        Route::get("getprojectsbytrackedorderid/{id}", [ProjectController::class, 'getProjectsByTrackedOrderId']);
        // Route::put("{id}", [ProjectController::class, 'update']);
        Route::delete("{id}", [ProjectController::class, 'destroy']);
    });    

    Route::prefix("taskcontainer")->group(function () {
        Route::post("store", [TaskContainerController::class, 'store']);
        Route::get("get/{projectId}", [TaskContainerController::class, 'index']);
        Route::put("{id}", [TaskContainerController::class, 'update']);
        Route::delete("{id}", [TaskContainerController::class, 'destroy']);
    });

    Route::prefix("task")->group(function () {
        Route::post("store", [TaskController::class, 'store']);
        Route::get("get/{projectId}", [TaskController::class, 'index']);
        Route::put("{id}", [TaskController::class, 'update']);
        Route::delete("{id}", [TaskController::class, 'destroy']);
    });

    Route::prefix("gigquestion")->group(function () {
        Route::post("store", [GigquestionController::class, 'store']);
        Route::get("get/{gigId}", [GigquestionController::class, 'index']);
        Route::put("{id}", [GigquestionController::class, 'update']);
        Route::delete("{id}", [GigquestionController::class, 'destroy']);
    });

    Route::prefix("faq")->group(function () {
        Route::post("store", [FaqController::class, 'store']);
        Route::get("get/{id}", [FaqController::class, 'index']);
        Route::put("{id}", [FaqController::class, 'update']);
        Route::delete("{id}", [FaqController::class, 'destroy']);
    });

    Route::prefix("extraservice")->group(function () {
        Route::post("store", [ExtragigserviceController::class, 'store']);
        Route::get("get/{gigId}", [ExtragigserviceController::class, 'index']);
        Route::put("{id}", [ExtragigserviceController::class, 'update']);
        Route::delete("{id}", [ExtragigserviceController::class, 'destroy']);
    });

    Route::prefix("category")->group(function () {
        Route::post("store", [CategoryController::class, 'store']);
        Route::get("categories", [CategoryController::class, 'index']);
        Route::put("{id}", [CategoryController::class, 'update']);
        Route::delete("{id}", [CategoryController::class, 'destroy']);
    });

    Route::prefix("review")->group(function() {
        Route::get("getallreviews", [ReviewController::class, 'index']);
        Route::post("sendreview", [ReviewController::class, 'store']);
        Route::get("getsentreviews/{id}", [ReviewController::class, 'getSentReviews']);
        Route::get("getreceivedreviews/{id}", [ReviewController::class, 'getReceivedReviews']);
        Route::get("getjobreview/{id}", [ReviewController::class, 'getJobReview']);
    });

    Route::name("workprofile.")->prefix("workprofile")->group(function () {
        Route::post("store", [WorkProfileController::class, 'store'])->name('store');
        Route::get("", [WorkProfileController::class, 'index'])->name('index');
        Route::put("{workprofile:id}", [WorkProfileController::class, 'update'])->name('update');
        Route::delete("{workprofile:id}", [WorkProfileController::class, 'destroy'])->name('destroy');
    });

    Route::name("education.")->prefix("education")->group(function () {
        Route::post("store", [EducationController::class, 'store'])->name('store');
        Route::get("", [EducationController::class, 'index'])->name('index');
        Route::put("{education:id}", [EducationController::class, 'update'])->name('update');
        Route::delete("{education:id}", [EducationController::class, 'destroy'])->name('destroy');
    });


    Route::name("publication.")->prefix("publication")->group(function () {
        Route::post("store", [PublicationController::class, 'store'])->name('store');
        Route::get("", [PublicationController::class, 'index'])->name('index');
        Route::put("{publication:id}", [PublicationController::class, 'update'])->name('update');
        Route::delete("{publication:id}", [PublicationController::class, 'destroy'])->name('destroy');
    });

    Route::name("certification.")->prefix("certification")->group(function () {
        Route::post("store", [CertificationController::class, 'store'])->name('store');
        Route::get("", [CertificationController::class, 'index'])->name('index');
        Route::put("{certification:id}", [CertificationController::class, 'update'])->name('update');
        Route::delete("{certification:id}", [CertificationController::class, 'destroy'])->name('destroy');
    });

    Route::name("job.")->prefix("job")->group(function () {
        Route::post("store", [JobController::class, 'store'])->name('store');
        Route::get("", [JobController::class, 'index'])->name('index');
        Route::put("{job:id}", [JobController::class, 'update'])->name('update');
        Route::delete("{job:id}", [JobController::class, 'destroy'])->name('destroy');
        Route::post("applyforjob", [JobController::class, 'applyForJob'])->name('applyforjob');
        Route::put("rejectbid/{id}", [JobController::class, 'rejectbid'])->name('rejectbid');
        Route::get("getallsentjoboffers/{id}", [JobController::class, 'getAllSentJobOffers'])->name('getallsentjoboffers');
        Route::get("getopenjobs", [JobController::class, 'getOpenJobs'])->name('getopenjobs');
        Route::post("acceptagreement", [JobController::class, 'acceptAgreement'])->name('acceptagreement');
        Route::get("gethunterorders", [JobController::class, 'getHunterOrders'])->name('gethunterorders');
        Route::get("getcreativeorders", [JobController::class, 'getCreativeOrders'])->name('getcreativeorders');
        Route::get("getappliedjobs/{id}", [JobController::class, 'getAppliedJobs'])->name('getappliedjobs');
        Route::get("getacceptedbids/{id}", [JobController::class, 'getAcceptedBids'])->name('getacceptedbids');
        Route::put("startjob/{id}", [JobController::class, 'startJob'])->name('startjob');
        Route::get("getactivejobs/{id}", [JobController::class, 'getActiveJobs'])->name('getactivejobs');
        Route::post("submitjob/{id}", [JobController::class, 'submitJob'])->name('submitjob');
        Route::get("getsubmittedjobs", [JobController::class, 'getSubmittedJobs'])->name('getsubmittedjobs');
        Route::get("getsubmittedjob/{id}", [JobController::class, 'getSubmittedJob'])->name('getsubmittedjob');
        Route::put("acceptsubmittedjob/{id}", [JobController::class, 'acceptSubmittedJob'])->name('acceptsubmittedjob');
        Route::get("getacceptedjobs", [JobController::class, 'getAcceptedJobs'])->name('getacceptedjobs');
    });

    Route::name("skill.")->prefix("skill")->group(function () {
        Route::post("store", [SkillController::class, 'store'])->name('store');
        Route::get("", [SkillController::class, 'index'])->name('index');
        Route::put("{skill:id}", [SkillController::class, 'update'])->name('update');
        Route::delete("{skill:id}", [SkillController::class, 'destroy'])->name('destroy');
        Route::post("attachskilltouser", [SkillController::class, 'attachSkillToUser'])->name('attachskilltouser');
        Route::post("detachskilltouser", [SkillController::class, 'detachSkillToUser'])->name('detachskilltouser');
        Route::get("getalluserskills", [SkillController::class, 'getallUserSkills'])->name('getallUserSkills');
    });

    Route::name("smtp.")->prefix("smtp")->group(function () {
        Route::post("store", [SettingController::class, 'store'])->name('store');
        Route::get("", [SettingController::class, 'index'])->name('index');
    });

    Route::name("system.")->prefix("system")->group(function () {
        Route::post("store", [SystemController::class, 'store'])->name('store');
        Route::get("", [SystemController::class, 'index'])->name('index');
    });

    Route::name("Language.")->prefix("language")->group(function () {
        Route::post("store", [LanguageController::class, 'store'])->name('store');
        Route::get("", [LanguageController::class, 'index'])->name('index');
        Route::put("{language:id}", [LanguageController::class, 'update'])->name('update');
        Route::delete("{language:id}", [LanguageController::class, 'destroy'])->name('destroy');
        Route::post("attachlanguagetouser", [LanguageController::class, 'attachLanguageToUser'])->name('attachlanguagetouser');
        Route::post("detachlanguagetouser", [LanguageController::class, 'detachLanguageToUser'])->name('detachlanguagetouser');
        Route::get("getalluserlanguages", [LanguageController::class, 'getalluserlanguages'])->name('getalluserlanguages');
    });

    Route::name("Profile.")->prefix("profile")->group(function () {
        Route::get("search", [ProfileController::class, 'search'])->name('search');
    });

    Route::name("chat.")->prefix("chat")->group(function () {
        Route::get("getconversations", [ChatController::class, 'getConversations'])->name('getconversations');
        Route::post("sendmessage", [ChatController::class, 'sendMessage'])->name('sendmessage');
        Route::delete("deletemessage/{id}", [ChatController::class, 'deleteMessage'])->name('deletemessage');
        Route::get('getconversation/{id}', [ChatController::class, 'getConversation'])->name('getconversation');
        Route::get("getsentmessages", [ChatController::class, 'getSentMessages'])->name('getsentmessages');
        Route::get("getreceivedmessages", [ChatController::class, 'getReceivedMessages'])->name('getreceivedmessages');
    });
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

