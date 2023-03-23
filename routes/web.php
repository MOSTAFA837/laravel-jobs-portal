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
use App\Http\Controllers\Admin\AdminJobExperienceController;
use App\Http\Controllers\Admin\AdminJobGenderController;
use App\Http\Controllers\Admin\AdminJobSalaryRangeController;
use App\Http\Controllers\Admin\AdminCompanyLocationController;
use App\Http\Controllers\Admin\AdminCompanyIndustryController;
use App\Http\Controllers\Admin\AdminCompanySizeController;

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

    Route::get('company/edit-profile', [CompanyController::class, 'edit_profile'])->name('company_edit_profile');
    Route::post('company/edit-profile-update', [CompanyController::class, 'edit_profile_update'])->name('company_edit_profile_update');

    Route::get('company/edit-password', [CompanyController::class, 'edit_password'])->name('company_edit_password');
    Route::post('company/edit-password-update', [CompanyController::class, 'edit_password_update'])->name('company_edit_password_update');

    Route::get('company/photos', [CompanyController::class, 'photos'])->name('company_photos');
    Route::post('company/photos-submit', [CompanyController::class, 'photos_submit'])->name('company_photos_submit');
    Route::get('company/photos/delete/{id}', [CompanyController::class, 'photos_delete'])->name('company_photos_delete');

    Route::get('company/jobs/create-job', [CompanyController::class, 'jobs_create'])->name('company_jobs_create');
    Route::post('company/jobs/create-job-submit', [CompanyController::class, 'jobs_create_submit'])->name('company_jobs_create_submit');
    Route::get('company/jobs', [CompanyController::class, 'jobs'])->name('company_jobs');
    Route::get('company/job-edit/{id}', [CompanyController::class, 'job_edit'])->name('company_job_edit');
    Route::post('company/job-edit-submit/{id}', [CompanyController::class, 'job_edit_submit'])->name('company_job_edit_submit');
    Route::get('company/job/delete/{id}', [CompanyController::class, 'job_delete'])->name('company_job_delete');
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
    Route::get('candidate/dashboard', [CandidateController::class, 'dashboard'])->name('candidate_dashboard');
    Route::get('candidate/edit-profile', [CandidateController::class, 'edit_profile'])->name('candidate_edit_profile');
    Route::post('candidate/edit-profile/update', [CandidateController::class, 'edit_profile_update'])->name('candidate_edit_profile_update');

    Route::get('candidate/edit-password', [CandidateController::class, 'edit_password'])->name('candidate_edit_password');
    Route::post('candidate/edit-password-update', [CandidateController::class, 'edit_password_update'])->name('candidate_edit_password_update');

    Route::get('candidate/education/view', [CandidateController::class, 'education'])->name('candidate_education');
    Route::get('candidate/education/create', [CandidateController::class, 'education_create'])->name('candidate_education_create');
    Route::post('candidate/education/store', [CandidateController::class, 'education_store'])->name('candidate_education_store');
    Route::get('candidate/education/edit/{id}', [CandidateController::class, 'education_edit'])->name('candidate_education_edit');
    Route::post('candidate/education/update/{id}', [CandidateController::class, 'education_update'])->name('candidate_education_update');
    Route::get('candidate/education/delete/{id}', [CandidateController::class, 'education_delete'])->name('candidate_education_delete');

    Route::get('candidate/skill/view', [CandidateController::class, 'skill'])->name('candidate_skill');
    Route::get('candidate/skill/create', [CandidateController::class, 'skill_create'])->name('candidate_skill_create');
    Route::post('candidate/skill/store', [CandidateController::class, 'skill_store'])->name('candidate_skill_store');
    Route::get('candidate/skill/edit/{id}', [CandidateController::class, 'skill_edit'])->name('candidate_skill_edit');
    Route::post('candidate/skill/update/{id}', [CandidateController::class, 'skill_update'])->name('candidate_skill_update');
    Route::get('candidate/skill/delete/{id}', [CandidateController::class, 'skill_delete'])->name('candidate_skill_delete');

    Route::get('candidate/experience/view', [CandidateController::class, 'experience'])->name('candidate_experience');
    Route::get('candidate/experience/create', [CandidateController::class, 'experience_create'])->name('candidate_experience_create');
    Route::post('candidate/experience/store', [CandidateController::class, 'experience_store'])->name('candidate_experience_store');
    Route::get('candidate/experience/edit/{id}', [CandidateController::class, 'experience_edit'])->name('candidate_experience_edit');
    Route::post('candidate/experience/update/{id}', [CandidateController::class, 'experience_update'])->name('candidate_experience_update');
    Route::get('candidate/experience/delete/{id}', [CandidateController::class, 'experience_delete'])->name('candidate_experience_delete');

    Route::get('candidate/award/view', [CandidateController::class, 'award'])->name('candidate_award');
    Route::get('candidate/award/create', [CandidateController::class, 'award_create'])->name('candidate_award_create');
    Route::post('candidate/award/store', [CandidateController::class, 'award_store'])->name('candidate_award_store');
    Route::get('candidate/award/edit/{id}', [CandidateController::class, 'award_edit'])->name('candidate_award_edit');
    Route::post('candidate/award/update/{id}', [CandidateController::class, 'award_update'])->name('candidate_award_update');
    Route::get('candidate/award/delete/{id}', [CandidateController::class, 'award_delete'])->name('candidate_award_delete');
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

    Route::get('/admin/job-experience/view', [AdminJobExperienceController::class, 'index'])->name('admin_job_experience');
    Route::get('/admin/job-experience/create', [AdminJobExperienceController::class, 'create'])->name('admin_job_experience_create');
    Route::post('/admin/job-experience/store', [AdminJobExperienceController::class, 'store'])->name('admin_job_experience_store');
    Route::get('/admin/job-experience/edit/{id}', [AdminJobExperienceController::class, 'edit'])->name('admin_job_experience_edit');
    Route::post('/admin/job-experience/update/{id}', [AdminJobExperienceController::class, 'update'])->name('admin_job_experience_update');
    Route::get('/admin/job-experience/delete/{id}', [AdminJobExperienceController::class, 'delete'])->name('admin_job_experience_delete');

    Route::get('/admin/job-gender/view', [AdminJobGenderController::class, 'index'])->name('admin_job_gender');
    Route::get('/admin/job-gender/create', [AdminJobGenderController::class, 'create'])->name('admin_job_gender_create');
    Route::post('/admin/job-gender/store', [AdminJobGenderController::class, 'store'])->name('admin_job_gender_store');
    Route::get('/admin/job-gender/edit/{id}', [AdminJobGenderController::class, 'edit'])->name('admin_job_gender_edit');
    Route::post('/admin/job-gender/update/{id}', [AdminJobGenderController::class, 'update'])->name('admin_job_gender_update');
    Route::get('/admin/job-gender/delete/{id}', [AdminJobGenderController::class, 'delete'])->name('admin_job_gender_delete');

    Route::get('/admin/job-salary-range/view', [AdminJobSalaryRangeController::class, 'index'])->name('admin_job_salary_range');
    Route::get('/admin/job-salary-range/create', [AdminJobSalaryRangeController::class, 'create'])->name('admin_job_salary_range_create');
    Route::post('/admin/job-salary-range/store', [AdminJobSalaryRangeController::class, 'store'])->name('admin_job_salary_range_store');
    Route::get('/admin/job-salary-range/edit/{id}', [AdminJobSalaryRangeController::class, 'edit'])->name('admin_job_salary_range_edit');
    Route::post('/admin/job-salary-range/update/{id}', [AdminJobSalaryRangeController::class, 'update'])->name('admin_job_salary_range_update');
    Route::get('/admin/job-salary-range/delete/{id}', [AdminJobSalaryRangeController::class, 'delete'])->name('admin_job_salary_range_delete');

    Route::get('/admin/company-location/view', [AdminCompanyLocationController::class, 'index'])->name('admin_company_location');
    Route::get('/admin/company-location/create', [AdminCompanyLocationController::class, 'create'])->name('admin_company_location_create');
    Route::post('/admin/company-location/store', [AdminCompanyLocationController::class, 'store'])->name('admin_company_location_store');
    Route::get('/admin/company-location/edit/{id}', [AdminCompanyLocationController::class, 'edit'])->name('admin_company_location_edit');
    Route::post('/admin/company-location/update/{id}', [AdminCompanyLocationController::class, 'update'])->name('admin_company_location_update');
    Route::get('/admin/company-location/delete/{id}', [AdminCompanyLocationController::class, 'delete'])->name('admin_company_location_delete');

    Route::get('/admin/company-industry/view', [AdminCompanyIndustryController::class, 'index'])->name('admin_company_industry');
    Route::get('/admin/company-industry/create', [AdminCompanyIndustryController::class, 'create'])->name('admin_company_industry_create');
    Route::post('/admin/company-industry/store', [AdminCompanyIndustryController::class, 'store'])->name('admin_company_industry_store');
    Route::get('/admin/company-industry/edit/{id}', [AdminCompanyIndustryController::class, 'edit'])->name('admin_company_industry_edit');
    Route::post('/admin/company-industry/update/{id}', [AdminCompanyIndustryController::class, 'update'])->name('admin_company_industry_update');
    Route::get('/admin/company-industry/delete/{id}', [AdminCompanyIndustryController::class, 'delete'])->name('admin_company_industry_delete');

    Route::get('/admin/company-size/view', [AdminCompanySizeController::class, 'index'])->name('admin_company_size');
    Route::get('/admin/company-size/create', [AdminCompanySizeController::class, 'create'])->name('admin_company_size_create');
    Route::post('/admin/company-size/store', [AdminCompanySizeController::class, 'store'])->name('admin_company_size_store');
    Route::get('/admin/company-size/edit/{id}', [AdminCompanySizeController::class, 'edit'])->name('admin_company_size_edit');
    Route::post('/admin/company-size/update/{id}', [AdminCompanySizeController::class, 'update'])->name('admin_company_size_update');
    Route::get('/admin/company-size/delete/{id}', [AdminCompanySizeController::class, 'delete'])->name('admin_company_size_delete');
});
