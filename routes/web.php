<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminHomePageController;
use App\Http\Controllers\Admin\AdminJobCategoryController;
use App\Http\Controllers\Admin\AdminWhyChooseController;
use App\Http\Controllers\Admin\AdminPackageController;
use App\Http\Controllers\Admin\AdminJobLocationController;
use App\Http\Controllers\Admin\AdminJobTypeController;

use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\TermsController;
use App\Http\Controllers\Front\PricingController;
use App\Http\Controllers\Front\JobCategoryController;
use App\Http\Controllers\Front\LoginController;

use App\Http\Controllers\Company\CompanyController;

use App\Http\Controllers\Candidate\CandidateController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/terms', [TermsController::class, 'index'])->name('terms');
Route::get('/pricing', [PricingController::class, 'index'])->name('pricing');
Route::get('/job-categories', [JobCategoryController::class, 'categories'])->name('job_categories');
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::get('/signup', [LoginController::class, 'signup'])->name('signup');

// Company
Route::post('login_company_submit', [LoginController::class, 'companyLoginSubmit'])->name('company_login_submit');
Route::post('signup_company_submit', [LoginController::class, 'companySignupSubmit'])->name('company_signup_submit');
Route::get('company_signup_verify/{token}/{email}', [LoginController::class, 'companySignupVerify'])->name('company_signup_verify');
Route::get('/company/logout', [LoginController::class, 'companyLogout'])->name('company_logout');

Route::get('/company/forget-password', [LoginController::class, 'companyForgetPassword'])->name('company_forget_password');
Route::post('/company/forget-password-submit', [LoginController::class, 'companyForgetPasswordSubmit'])->name('company_forget_password_submit');
Route::get('company/reset-password/{token}/{email}', [LoginController::class, 'companyResetPassword'])->name('company_reset_password');
Route::post('company/reset-password-submit', [LoginController::class, 'companyResetPasswordSubmit'])->name('company_reset_password_submit');

Route::middleware(['company:company'])->group(function () {
    Route::get('/company/dashboard', [CompanyController::class, 'dashboard'])->name('company_dashboard');
    Route::get('/company/make-payment', [CompanyController::class, 'makePayment'])->name('company_make_payment');
    Route::get('/company/orders', [CompanyController::class, 'orders'])->name('company_orders');

    Route::post('/company/paypal/payment', [CompanyController::class, 'paypal'])->name('company_paypal');
    Route::get('/company/paypal/success', [CompanyController::class, 'paypal_success'])->name('company_paypal_success');
    Route::get('/company/paypal/cancel', [CompanyController::class, 'paypal_cancel'])->name('company_paypal_cancel');

    Route::post('/company/stripe/payment', [CompanyController::class, 'stripe'])->name('company_stripe');
    Route::get('/company/stripe/success', [CompanyController::class, 'stripe_success'])->name('company_stripe_success');
    Route::get('/company/stripe/cancel', [CompanyController::class, 'stripe_cancel'])->name('company_stripe_cancel');
});

// Candidate
Route::post('login_candidate_submit', [LoginController::class, 'candidateLoginSubmit'])->name('candidate_login_submit');
Route::post('signup_candidate_submit', [LoginController::class, 'candidateSignupSubmit'])->name('candidate_signup_submit');
Route::get('candidate_signup_verify/{token}/{email}', [LoginController::class, 'candidateSignupVerify'])->name('candidate_signup_verify');
Route::get('candidate/logout', [LoginController::class, 'candidateLogout'])->name('candidate_logout');

Route::get('candidate/forget-password', [LoginController::class, 'candidateForgetPassword'])->name('candidate_forget_password');
Route::post('candidate/forget-password-submit', [LoginController::class, 'candidateForgetPasswordSubmit'])->name('candidate_forget_password_submit');
Route::get('candidate/reset-password/{token}/{email}', [LoginController::class, 'candidateResetPassword'])->name('candidate_reset_password');
Route::post('candidate/reset-password-submit', [LoginController::class, 'candidateResetPasswordSubmit'])->name('candidate_reset_password_submit');

Route::middleware(['candidate:candidate'])->group(function () {
    Route::get('candidate/dashboard', [candidateController::class, 'dashboard'])->name('candidate_dashboard');
});

// Admin
Route::get('/admin/login', [AdminLoginController::class, 'login'])->name('admin_login');
Route::post('/admin/login-submit', [AdminLoginController::class, 'login_submit'])->name('admin_login_submit');
Route::get('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin_logout');
Route::get('/admin/forget-password', [AdminLoginController::class, 'forget_password'])->name('admin_forget_password');
Route::post('/admin/forget-password-submit', [AdminLoginController::class, 'forget_password_submit'])->name('admin_forget_password_submit');
Route::get('/admin/reset-password/{token}/{email}', [AdminLoginController::class, 'reset_password'])->name('admin_reset_password');
Route::post('/admin/reset-password-submit', [AdminLoginController::class, 'reset_password_submit'])->name('admin_reset_password_submit');

Route::middleware(['admin:admin'])->group(function () {
    Route::get('/admin/home', [AdminHomeController::class, 'index'])->name('admin_home');

    Route::get('/admin/edit-profile', [AdminProfileController::class, 'index'])->name('admin_profile');
    Route::post('/admin/edit-profile-submit', [AdminProfileController::class, 'profile_submit'])->name('profile_edit_submit');

    Route::get('/admin/home-page', [AdminHomePageController::class, 'index'])->name('admin_home_page');
    Route::post('/admin/home-page/update', [AdminHomePageController::class, 'update'])->name('admin_home_page_update');

    Route::get('/admin/job-category/view', [AdminJobCategoryController::class, 'index'])->name('admin_job_category');
    Route::get('/admin/job-category/create', [AdminJobCategoryController::class, 'create'])->name('admin_job_category_create');
    Route::post('/admin/job-category/store', [AdminJobCategoryController::class, 'store'])->name('admin_job_category_store');
    Route::get('/admin/job-category/edit/{id}', [AdminJobCategoryController::class, 'edit'])->name('admin_job_category_edit');
    Route::post('/admin/job-category/update/{id}', [AdminJobCategoryController::class, 'update'])->name('admin_job_category_update');
    Route::get('/admin/job-category/delete/{id}', [AdminJobCategoryController::class, 'delete'])->name('admin_job_category_delete');

    Route::get('/admin/why-choose/view', [AdminWhyChooseController::class, 'index'])->name('admin_why_choose_item');
    Route::get('/admin/why-choose/create', [AdminWhyChooseController::class, 'create'])->name('admin_why_choose_item_create');
    Route::post('/admin/why-choose/store', [AdminWhyChooseController::class, 'store'])->name('admin_why_choose_item_store');
    Route::get('/admin/why-choose/edit/{id}', [AdminWhyChooseController::class, 'edit'])->name('admin_why_choose_item_edit');
    Route::post('/admin/why-choose/update/{id}', [AdminWhyChooseController::class, 'update'])->name('admin_why_choose_item_update');
    Route::get('/admin/why-choose/delete/{id}', [AdminWhyChooseController::class, 'delete'])->name('admin_why_choose_item_delete');

    Route::get('/admin/package/view', [AdminPackageController::class, 'index'])->name('admin_package');
    Route::get('/admin/package/create', [AdminPackageController::class, 'create'])->name('admin_package_create');
    Route::post('/admin/package/store', [AdminPackageController::class, 'store'])->name('admin_package_store');
    Route::get('/admin/package/edit/{id}', [AdminPackageController::class, 'edit'])->name('admin_package_edit');
    Route::post('/admin/package/update/{id}', [AdminPackageController::class, 'update'])->name('admin_package_update');
    Route::get('/admin/package/delete/{id}', [AdminPackageController::class, 'delete'])->name('admin_package_delete');

    Route::get('/admin/job-location/view', [AdminJobLocationController::class, 'index'])->name('admin_job_location');
    Route::get('/admin/job-location/create', [AdminJobLocationController::class, 'create'])->name('admin_job_location_create');
    Route::post('/admin/job-location/store', [AdminJobLocationController::class, 'store'])->name('admin_job_location_store');
    Route::get('/admin/job-location/edit/{id}', [AdminJobLocationController::class, 'edit'])->name('admin_job_location_edit');
    Route::post('/admin/job-location/update/{id}', [AdminJobLocationController::class, 'update'])->name('admin_job_location_update');
    Route::get('/admin/job-location/delete/{id}', [AdminJobLocationController::class, 'delete'])->name('admin_job_location_delete');

    Route::get('/admin/job-type/view', [AdminJobTypeController::class, 'index'])->name('admin_job_type');
    Route::get('/admin/job-type/create', [AdminJobTypeController::class, 'create'])->name('admin_job_type_create');
    Route::post('/admin/job-type/store', [AdminJobTypeController::class, 'store'])->name('admin_job_type_store');
    Route::get('/admin/job-type/edit/{id}', [AdminJobTypeController::class, 'edit'])->name('admin_job_type_edit');
    Route::post('/admin/job-type/update/{id}', [AdminJobTypeController::class, 'update'])->name('admin_job_type_update');
    Route::get('/admin/job-type/delete/{id}', [AdminJobTypeController::class, 'delete'])->name('admin_job_type_delete');
});
