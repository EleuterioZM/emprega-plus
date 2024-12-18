<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CandidatoController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\EmpregadorController;
use App\Http\Controllers\JobPostController;
use Illuminate\Support\Facades\Route;

// Rotas de autenticação
Route::get('/', function () {
    return view('auth.login');
})->name('login');

// Rotas do dashboard
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});





Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
Route::get('/verify', [RegisterController::class, 'showVerificationForm'])->name('verification.notice');
Route::post('/verify', [RegisterController::class, 'verify'])->name('verification.verify');
Route::post('verify', [RegisterController::class, 'verify'])->name('verify');
Route::get('users', [RegisterController::class, 'list'])->name('users.list');
Route::get('users/{id}/edit', [RegisterController::class, 'edit'])->name('users.edit');
Route::put('users/{id}', [RegisterController::class, 'update'])->name('users.update');
Route::delete('users/{id}', [RegisterController::class, 'destroy'])->name('users.destroy');
Route::post('verify', [RegisterController::class, 'verify'])->name('verification.verify');
Route::patch('/users/{id}/deactivate', [RegisterController::class, 'deactivate'])->name('users.deactivate');

Route::get('forgot-password', [PasswordResetController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('forgot-password', [PasswordResetController::class, 'sendVerificationCode'])->name('password.email');
Route::get('reset-password', [PasswordResetController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('reset-password', [PasswordResetController::class, 'resetPassword'])->name('password.update');

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');



 // Candidatos


 Route::get('/candidatos', [CandidatoController::class, 'index'])->name('candidatos.index');
 Route::get('/candidato/editar', [CandidatoController::class, 'edit'])->name('candidatos.edit');
 Route::put('/candidato/atualizar', [CandidatoController::class, 'update'])->name('candidatos.update');
 Route::patch('/candidato/{id}/alterar-status', [CandidatoController::class, 'alterarStatus'])->name('candidatos.alterar-status');
 Route::get('/candidatos/download/{filename}', [CandidatoController::class, 'downloadCV'])->name('candidatos.download');
 Route::patch('/candidatos/{id}/alterar-status', [CandidatoController::class, 'alterarStatus'])->name('candidatos.alterarStatus');
 // Empregadores
 Route::get('empregadores/edit', [EmpregadorController::class, 'edit'])->name('empregadores.edit');
 Route::get('/empregadores', [EmpregadorController::class, 'index'])->name('empregadores.index');
 Route::get('/empregadores/create', [EmpregadorController::class, 'create'])->name('empregadores.create');
 Route::put('empregadores/update', [EmpregadorController::class, 'update'])->name('empregadores.update');
 Route::patch('/empregadores/{empregadorId}/status', [EmpregadorController::class, 'alterarStatus'])->name('empregadores.alterarStatus');

 Route::get('/job-posts', [JobPostController::class, 'index'])->name('job_posts.index');
 Route::get('/job-posts/create', [JobPostController::class, 'create'])->name('job_posts.create');
 Route::post('/job-posts', [JobPostController::class, 'store'])->name('job_posts.store');
 Route::get('/job-posts/{id}/edit', [JobPostController::class, 'edit'])->name('job_posts.edit');
 Route::put('/job-posts/{id}', [JobPostController::class, 'update'])->name('job_posts.update');
 Route::delete('/job-posts/{id}', [JobPostController::class, 'destroy'])->name('job_posts.destroy');
 Route::patch('/job-posts/{id}/status', [JobPostController::class, 'alterarStatus'])->name('job_posts.alterarStatus');
 Route::get('/job_posts/{job_post}', [JobPostController::class, 'show'])->name('job_posts.show');
