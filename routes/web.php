<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CandidatoController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\EmpregadorController;
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


// Roteamento para a criação de perfis
Route::get('/perfil/candidato', [PerfilController::class, 'createCandidato'])->name('perfil.create.candidato');
Route::post('/perfil/candidato', [PerfilController::class, 'storeCandidato'])->name('perfil.store.candidato');
Route::get('/perfil/empregador', [PerfilController::class, 'createEmpregador'])->name('perfil.create.empregador');
Route::post('/perfil/empregador', [PerfilController::class, 'storeEmpregador'])->name('perfil.store.empregador');


 // Candidatos
 Route::get('candidatos/edit', [CandidatoController::class, 'edit'])->name('candidatos.edit');
 Route::put('candidatos/update', [CandidatoController::class, 'update'])->name('candidatos.update');

 // Empregadores
 Route::get('empregadores/edit', [EmpregadorController::class, 'edit'])->name('empregadores.edit');
 Route::get('/empregadores', [EmpregadorController::class, 'index'])->name('empregadores.index');
 Route::get('/empregadores/create', [EmpregadorController::class, 'create'])->name('empregadores.create');

 Route::put('empregadores/update', [EmpregadorController::class, 'update'])->name('empregadores.update');