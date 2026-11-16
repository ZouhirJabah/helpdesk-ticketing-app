<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SolutionController;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        $userId = Auth::id();

        $totalTickets = Ticket::where('user_id', $userId)->count();
        $openTickets = Ticket::where('user_id', $userId)->whereIn('status', ['New', 'Processing', 'Late'])->count();
        $solvedTickets = Ticket::where('user_id', $userId)->where('status', 'Solved')->count();

        $recentTickets = Ticket::where('user_id', $userId)->latest()->take(5)->get();
        return view('employe.dashboard', compact('totalTickets', 'openTickets', 'solvedTickets', 'recentTickets'));
    })->name('dashboard');

    Route::get('/admin/dashboard', function () {
        $ticketsByStatus = Ticket::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        $ticketsByPriority = Ticket::select('priority', DB::raw('count(*) as total'))
            ->groupBy('priority')
            ->pluck('total', 'priority');

        $totalEmployees = User::where('role', 'employee')->count();
        $assignedTickets = Ticket::whereNotNull('assigned_to')
            ->where('status', '!=', 'Solved')
            ->count();
        $lateTickets = Ticket::where('created_at', '<', now()->subHours(48))
            ->where('status', '!=', 'Solved')
            ->count();

        $todayTickets = Ticket::whereDate('created_at', today())
            ->latest()
            ->take(5)
            ->get();
        return view('admin.dashboard', compact('ticketsByStatus', 'ticketsByPriority', 'totalEmployees', 'assignedTickets', 'lateTickets', 'todayTickets'));
    })->name('admin.dashboard');

    Route::get('/tickets/archives', [TicketController::class, 'archives'])->name('tickets.archives');
    Route::resource('tickets', TicketController::class);
    Route::patch('/tickets/{ticket}/assign', [TicketController::class, 'assign'])->name('tickets.assign');
    Route::patch('/tickets/{ticket}/resolve', [TicketController::class, 'resolve'])->name('tickets.resolve');
    Route::post('/tickets/{ticket}/add-attachment', [TicketController::class, 'addAttachment'])->name('tickets.add-attachment');
    Route::post('/tickets/{ticket}/message', [TicketController::class, 'addMessage'])->name('tickets.add-message');

    Route::prefix('admin')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
        Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');

        Route::get('/departements', [DepartmentController::class, 'index'])->name('admin.departements.index');
        Route::get('/departements/create', [DepartmentController::class, 'create'])->name('admin.departements.create');
        Route::post('/departements', [DepartmentController::class, 'store'])->name('admin.departements.store');
        Route::delete('/departements/{departement}', [DepartmentController::class, 'destroy'])->name('admin.departements.destroy');
        Route::get('/departements/{departement}/edit', [DepartmentController::class, 'edit'])->name('admin.departements.edit');
        Route::put('/departements/{departement}', [DepartmentController::class, 'update'])->name('admin.departements.update');

        Route::get('/solutions', [SolutionController::class, 'index'])->name('admin.solutions.index');
        Route::get('/solutions/create', [SolutionController::class, 'create'])->name('admin.solutions.create');
        Route::post('/solutions', [SolutionController::class, 'store'])->name('admin.solutions.store');
    });
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/api/unread-messages', [TicketController::class, 'getUnreadMessages'])->name('api.unread-messages');
});
