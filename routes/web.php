<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CandidatoController;
use App\Http\Controllers\EmpregadorController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\JobPostController;
use App\Http\Controllers\ProfileController;
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
//password forgot
Route::get('forgot-password', [PasswordResetController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('forgot-password', [PasswordResetController::class, 'sendVerificationCode'])->name('password.email');
Route::get('reset-password', [PasswordResetController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('reset-password', [PasswordResetController::class, 'resetPassword'])->name('password.update');
//login
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
//post
 Route::get('/job-posts', [JobPostController::class, 'index'])->name('job_posts.index'); // Listar todas as vagas
 Route::get('/job-posts/create', [JobPostController::class, 'create'])->name('job_posts.create'); // Criar nova vaga
 Route::post('/job-posts', [JobPostController::class, 'store'])->name('job_posts.store'); // Armazenar nova vaga
 Route::get('/job-posts/{jobPost}/edit', [JobPostController::class, 'edit'])->name('job_posts.edit'); // Editar vaga
 Route::put('/job-posts/{jobPost}', [JobPostController::class, 'update'])->name('job_posts.update'); // Atualizar vaga
 Route::delete('/job-posts/{jobPost}', [JobPostController::class, 'destroy'])->name('job_posts.destroy'); // Apagar vaga
 Route::patch('/job-posts/{jobPost}/status', [JobPostController::class, 'alterarStatus'])->name('job_posts.alterarStatus'); // Alterar status
 Route::get('/job-posts/{jobPost}', [JobPostController::class, 'show'])->name('job_posts.show'); // Detalhes de uma vaga
 //job
 Route::get('/feed', [FeedController::class, 'index'])->name('feed.index');
 Route::post('/job_posts/{jobPost}/like', [FeedController::class, 'like'])->name('feed.like');
 Route::post('/job_posts/{jobPost}/comentar', [FeedController::class, 'comentar'])->name('feed.comentar');
 Route::post('/job_posts/{jobPost}/candidatar', [FeedController::class, 'candidatar'])->name('feed.candidatar');

//comentario
Route::put('/feed/comentario/{comentario}', [FeedController::class, 'updateComment'])->name('feed.update_comment');
Route::delete('/feed/comentario/{comentario}', [FeedController::class, 'deleteComment'])->name('feed.delete_comment');
// Rota para exibir o perfil
Route::get('/perfil', [ProfileController::class, 'index'])->name('perfil.index');
