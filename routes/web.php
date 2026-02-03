<?php

use App\Http\Controllers\ChatBotController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CvUploadController;
use App\Http\Controllers\DetailedForm\Step1Controller;
use App\Http\Controllers\DetailedForm\Step2Controller;
use App\Http\Controllers\DetailedForm\Step3Controller;
use App\Http\Controllers\DetailedForm\Step4Controller;
use App\Http\Controllers\DetailedForm\Step5Controller;
use App\Http\Controllers\DetailedForm\Step6Controller;
use App\Http\Controllers\DetailedForm\Step7Controller;
use App\Http\Controllers\DetailedForm\Step8Controller;
use App\Http\Controllers\DetailedForm\Step9Controller;
use App\Http\Controllers\ProposalController;
use Illuminate\Support\Facades\Route;
use Spatie\Honeypot\ProtectAgainstSpam;

Route::view('/', 'home')->name('home');

Route::view('/contact', 'contact-form')->name('contact');
Route::post('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::view('/contact/thank-you', 'contact-thankyou')->name('contact.thankyou');

Route::post('/careers/cv', [CvUploadController::class, 'store'])
    ->middleware(ProtectAgainstSpam::class)
    ->name('careers.cv.store');

Route::view('/privacy-policy', 'static-pages.privacy-policy')->name('privacy-policy');
Route::view('/terms', 'static-pages.terms')->name('terms');
Route::view('/cookie-policy', 'cookie-policy')->name('cookie-policy');
Route::view('/pricing', 'static-pages.pricing')->name('pricing');
Route::view('/documentation', 'static-pages.documentation')->name('documentation');
Route::view('/about', 'static-pages.about')->name('about');
Route::view('/careers', 'static-pages.careers')->name('careers');
Route::view('/security', 'static-pages.security')->name('security');
Route::view('/compliance', 'static-pages.compliance')->name('compliance');
Route::view('/ai-invoice-automation', 'static-pages.ai-invoice-automation')
    ->name('ai-invoice-automation');
Route::view('/custom-ai-solutions', 'static-pages.custom-ai-solutions')
    ->name('custom-ai-solutions');
Route::view('/case-studies/ai-ecommerce-assistant', 'case-studies.e-commerce-assistant')
    ->name('case-studies.ai-ecommerce-assistant');
Route::view(
    '/case-studies/procurement-optimization-agent',
    'case-studies.procurement-optimization-agent'
)->name('case-studies.procurement-optimization-agent');
Route::view('/case-studies/dental-clinic-assistant', 'case-studies.dental-clinic-assistant')
    ->name('case-studies.dental-clinic-assistant');

Route::post('/chat', [ChatBotController::class, 'store'])->name('chat.store');
Route::post('/chat/rate', [ChatBotController::class, 'rate'])->name('chat.rate');

Route::prefix('detailed-form')->name('detailed-form.')->group(function () {
    Route::get('/step-1', [Step1Controller::class, 'show'])->name('step1.show');
    Route::post('/step-1', [Step1Controller::class, 'store'])->name('step1.store');
    Route::get('/step-2', [Step2Controller::class, 'show'])->name('step2.show');
    Route::post('/step-2', [Step2Controller::class, 'store'])->name('step2.store');
    Route::get('/step-3', [Step3Controller::class, 'show'])->name('step3.show');
    Route::post('/step-3', [Step3Controller::class, 'store'])->name('step3.store');
    Route::get('/step-4', [Step4Controller::class, 'show'])->name('step4.show');
    Route::post('/step-4', [Step4Controller::class, 'store'])->name('step4.store');
    Route::get('/step-5', [Step5Controller::class, 'show'])->name('step5.show');
    Route::post('/step-5', [Step5Controller::class, 'store'])->name('step5.store');
    Route::get('/step-6', [Step6Controller::class, 'show'])->name('step6.show');
    Route::post('/step-6', [Step6Controller::class, 'store'])->name('step6.store');
    Route::get('/step-7', [Step7Controller::class, 'show'])->name('step7.show');
    Route::post('/step-7', [Step7Controller::class, 'store'])->name('step7.store');
    Route::get('/step-8', [Step8Controller::class, 'show'])->name('step8.show');
    Route::post('/step-8', [Step8Controller::class, 'store'])->name('step8.store');
    Route::get('/step-9', [Step9Controller::class, 'show'])->name('step9.show');
    Route::post('/step-9', [Step9Controller::class, 'submit'])->name('step9.submit');
    Route::get('/thank-you', [Step9Controller::class, 'thankYou'])->name('thankyou');
});

Route::get('/detailed-form', function () {
    return redirect()->route('detailed-form.step1.show');
})->name('detailed-form');

Route::get('/sitemap.xml', function () {
    $sitemapPath = public_path('sitemap.xml');

    if (file_exists($sitemapPath)) {
        $content = file_get_contents($sitemapPath);

        return response($content, 200, [
            'Content-Type' => 'application/xml; charset=utf-8',
            'Content-Length' => strlen($content),
        ]);
    }

    return response('Sitemap not found', 404);
})->name('sitemap');

Route::get('/proposals/{proposal:company_name}', [ProposalController::class, 'index'])
    ->name('proposals.index');

Route::post('/proposals/{proposal:company_name}/accept-terms', [ProposalController::class, 'acceptTerms'])
    ->name('proposals.accept-terms');

Route::post('/proposals/{proposal:company_name}/accept', [ProposalController::class, 'acceptProposal'])
    ->name('proposals.accept');

Route::get('/proposals/{proposal:company_name}/demo', [ProposalController::class, 'demo'])
    ->name('proposals.demo');
