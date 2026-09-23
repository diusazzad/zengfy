<?php

use App\Http\Controllers\Api\V1\ModuleApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::controller(ModuleApiController::class)->prefix('v1')->group(function () {
    Route::get('/modules', 'index')->middleware(['throttle:60,1'])->name('api.v1.modules.index');
    Route::get('/modules/{subdomain}', 'show')->middleware(['throttle:60,1'])->name('api.v1.modules.show');
});

// Central Identity & Authentication Routes (v1)
Route::prefix('v1/auth')->group(function () {
    Route::post('/register', [\Modules\Auth\Http\Controllers\AuthController::class, 'register'])
        ->middleware(['throttle:5,1'])
        ->name('api.v1.auth.register');

    Route::post('/login', [\Modules\Auth\Http\Controllers\AuthController::class, 'login'])
        ->middleware(['throttle:60,1'])
        ->name('api.v1.auth.login');

    Route::post('/sso/exchange', [\Modules\Auth\Http\Controllers\SsoController::class, 'exchangeTicket'])
        ->middleware(['throttle:30,1'])
        ->name('api.v1.auth.sso.exchange');

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/me', [\Modules\Auth\Http\Controllers\AuthController::class, 'me'])
            ->name('api.v1.auth.me');

        Route::post('/logout', [\Modules\Auth\Http\Controllers\AuthController::class, 'logout'])
            ->name('api.v1.auth.logout');

        Route::post('/logout-all', [\Modules\Auth\Http\Controllers\AuthController::class, 'logoutAll'])
            ->name('api.v1.auth.logout-all');

        Route::post('/sso/ticket', [\Modules\Auth\Http\Controllers\SsoController::class, 'generateTicket'])
            ->middleware(['throttle:15,1'])
            ->name('api.v1.auth.sso.ticket');

        Route::post('/nid/verify', [\Modules\Auth\Http\Controllers\NidVerificationController::class, 'verify'])
            ->middleware(['throttle:10,1'])
            ->name('api.v1.auth.nid.verify');

        Route::get('/nid/status', [\Modules\Auth\Http\Controllers\NidVerificationController::class, 'status'])
            ->name('api.v1.auth.nid.status');
    });
});

// Multi-Tenant Organization & Granular Scoping Routes (v1)
Route::prefix('v1/organizations')->middleware(['auth:sanctum'])->group(function () {
    Route::get('/', [\Modules\Organization\Http\Controllers\OrganizationController::class, 'index'])
        ->name('api.v1.organizations.index');

    Route::post('/', [\Modules\Organization\Http\Controllers\OrganizationController::class, 'store'])
        ->name('api.v1.organizations.store');

    Route::get('/{organization}', [\Modules\Organization\Http\Controllers\OrganizationController::class, 'show'])
        ->middleware(['tenant.resolve'])
        ->name('api.v1.organizations.show');

    Route::post('/{organization}/members', [\Modules\Organization\Http\Controllers\OrganizationController::class, 'inviteMember'])
        ->middleware(['tenant.resolve'])
        ->name('api.v1.organizations.members.invite');

    Route::get('/{organization}/members', [\Modules\Organization\Http\Controllers\OrganizationController::class, 'listMembers'])
        ->middleware(['tenant.resolve'])
        ->name('api.v1.organizations.members.index');

    // Tenant-Scoped Resources (demonstrating BelongsToTenant & Global TenantScope)
    Route::get('/{organization}/departments', [\Modules\Organization\Http\Controllers\OrganizationDepartmentController::class, 'index'])
        ->middleware(['tenant.resolve'])
        ->name('api.v1.organizations.departments.index');

    Route::post('/{organization}/departments', [\Modules\Organization\Http\Controllers\OrganizationDepartmentController::class, 'store'])
        ->middleware(['tenant.resolve', 'tenant.permission:departments.manage'])
        ->name('api.v1.organizations.departments.store');

    Route::get('/{organization}/departments/{department}', [\Modules\Organization\Http\Controllers\OrganizationDepartmentController::class, 'show'])
        ->middleware(['tenant.resolve'])
        ->name('api.v1.organizations.departments.show');

    // Granular RBAC Role Management
    Route::get('/{organization}/roles', [\Modules\Organization\Http\Controllers\RoleController::class, 'index'])
        ->middleware(['tenant.resolve'])
        ->name('api.v1.organizations.roles.index');

    Route::post('/{organization}/roles', [\Modules\Organization\Http\Controllers\RoleController::class, 'store'])
        ->middleware(['tenant.resolve', 'tenant.permission:roles.manage'])
        ->name('api.v1.organizations.roles.store');

    Route::post('/{organization}/members/{membership}/roles', [\Modules\Organization\Http\Controllers\RoleController::class, 'assignRoleToMember'])
        ->middleware(['tenant.resolve', 'tenant.permission:roles.manage'])
        ->name('api.v1.organizations.members.roles.assign');

    Route::delete('/{organization}/members/{membership}/roles/{role}', [\Modules\Organization\Http\Controllers\RoleController::class, 'removeRoleFromMember'])
        ->middleware(['tenant.resolve', 'tenant.permission:roles.manage'])
        ->name('api.v1.organizations.members.roles.remove');
});

Route::get('v1/permissions', [\Modules\Organization\Http\Controllers\RoleController::class, 'listPermissions'])
    ->middleware(['auth:sanctum'])
    ->name('api.v1.permissions.index');

// Consumer Social Media & Graph Routes (v1)
Route::prefix('v1')->group(function () {
    Route::get('/users/{identifier}/profile', [\Modules\Social\Http\Controllers\ProfileController::class, 'show'])
        ->name('api.v1.users.profile.show');

    Route::get('/users/{id}/followers', [\Modules\Social\Http\Controllers\FollowController::class, 'followers'])
        ->name('api.v1.users.followers');

    Route::get('/users/{id}/following', [\Modules\Social\Http\Controllers\FollowController::class, 'following'])
        ->name('api.v1.users.following');

    Route::get('/users/{id}/friends', [\Modules\Social\Http\Controllers\FriendshipController::class, 'friends'])
        ->name('api.v1.users.friends');

    Route::middleware('auth:sanctum')->group(function () {
        Route::put('/profile', [\Modules\Social\Http\Controllers\ProfileController::class, 'update'])
            ->name('api.v1.profile.update');

        Route::post('/users/{id}/follow', [\Modules\Social\Http\Controllers\FollowController::class, 'follow'])
            ->name('api.v1.users.follow');

        Route::delete('/users/{id}/follow', [\Modules\Social\Http\Controllers\FollowController::class, 'unfollow'])
            ->name('api.v1.users.unfollow');

        Route::post('/users/{id}/friend-request', [\Modules\Social\Http\Controllers\FriendshipController::class, 'sendRequest'])
            ->name('api.v1.users.friend-request.send');

        Route::get('/friend-requests', [\Modules\Social\Http\Controllers\FriendshipController::class, 'pendingRequests'])
            ->name('api.v1.friend-requests.index');

        Route::post('/friend-requests/{id}/accept', [\Modules\Social\Http\Controllers\FriendshipController::class, 'acceptRequest'])
            ->name('api.v1.friend-requests.accept');

        Route::post('/friend-requests/{id}/decline', [\Modules\Social\Http\Controllers\FriendshipController::class, 'declineRequest'])
            ->name('api.v1.friend-requests.decline');

        Route::delete('/users/{id}/friends', [\Modules\Social\Http\Controllers\FriendshipController::class, 'removeFriend'])
            ->name('api.v1.users.friends.remove');
    });
});


