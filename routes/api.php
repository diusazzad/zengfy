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

    // Password Reset & Recovery
    Route::post('/password/forgot', [\Modules\Auth\Http\Controllers\PasswordResetController::class, 'forgotPassword'])
        ->middleware(['throttle:6,1'])
        ->name('api.v1.auth.password.forgot');

    Route::post('/password/verify-code', [\Modules\Auth\Http\Controllers\PasswordResetController::class, 'verifyCode'])
        ->middleware(['throttle:10,1'])
        ->name('api.v1.auth.password.verify');

    Route::post('/password/reset', [\Modules\Auth\Http\Controllers\PasswordResetController::class, 'resetPassword'])
        ->middleware(['throttle:6,1'])
        ->name('api.v1.auth.password.reset');

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

    // School Academic Architecture (TASK-018)
    Route::prefix('{organization}/school')->middleware(['tenant.resolve'])->group(function () {
        Route::get('/academic-years', [\Modules\School\Http\Controllers\AcademicStructureController::class, 'indexAcademicYears'])
            ->name('api.v1.organizations.school.academic-years.index');

        Route::post('/academic-years', [\Modules\School\Http\Controllers\AcademicStructureController::class, 'storeAcademicYear'])
            ->middleware(['tenant.permission:academic.manage'])
            ->name('api.v1.organizations.school.academic-years.store');

        Route::post('/academic-years/{academicYear}/set-current', [\Modules\School\Http\Controllers\AcademicStructureController::class, 'setCurrentAcademicYear'])
            ->middleware(['tenant.permission:academic.manage'])
            ->name('api.v1.organizations.school.academic-years.set-current');

        Route::post('/academic-years/{academicYear}/rollover', [\Modules\School\Http\Controllers\AcademicStructureController::class, 'rolloverAcademicYear'])
            ->middleware(['tenant.permission:academic.manage'])
            ->name('api.v1.organizations.school.academic-years.rollover');

        Route::get('/classes', [\Modules\School\Http\Controllers\AcademicStructureController::class, 'indexClasses'])
            ->name('api.v1.organizations.school.classes.index');

        Route::post('/classes', [\Modules\School\Http\Controllers\AcademicStructureController::class, 'storeClass'])
            ->middleware(['tenant.permission:academic.manage'])
            ->name('api.v1.organizations.school.classes.store');

        Route::get('/classes/{class}', [\Modules\School\Http\Controllers\AcademicStructureController::class, 'showClass'])
            ->name('api.v1.organizations.school.classes.show');

        Route::post('/classes/{class}/sections', [\Modules\School\Http\Controllers\AcademicStructureController::class, 'storeSection'])
            ->middleware(['tenant.permission:academic.manage'])
            ->name('api.v1.organizations.school.classes.sections.store');

        Route::post('/classes/{class}/subjects', [\Modules\School\Http\Controllers\AcademicStructureController::class, 'storeSubject'])
            ->middleware(['tenant.permission:academic.manage'])
            ->name('api.v1.organizations.school.classes.subjects.store');

        Route::get('/structure', [\Modules\School\Http\Controllers\AcademicStructureController::class, 'structure'])
            ->name('api.v1.organizations.school.structure');
    });
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

        // Post & Media endpoints (Authenticated)
        Route::post('/media/presign', [\Modules\Social\Http\Controllers\MediaController::class, 'presign'])
            ->name('api.v1.media.presign');

        Route::post('/posts', [\Modules\Social\Http\Controllers\PostController::class, 'store'])
            ->name('api.v1.posts.store');

        Route::delete('/posts/{id}', [\Modules\Social\Http\Controllers\PostController::class, 'destroy'])
            ->name('api.v1.posts.destroy');

        // Real-Time Conversations & Messaging endpoints (Authenticated)
        Route::post('/conversations/direct', [\Modules\Social\Http\Controllers\ConversationController::class, 'startDirect'])
            ->name('api.v1.conversations.direct');

        Route::get('/conversations', [\Modules\Social\Http\Controllers\ConversationController::class, 'index'])
            ->name('api.v1.conversations.index');

        Route::get('/conversations/{id}/messages', [\Modules\Social\Http\Controllers\ConversationController::class, 'messages'])
            ->name('api.v1.conversations.messages');

        Route::post('/conversations/{id}/messages', [\Modules\Social\Http\Controllers\ConversationController::class, 'sendMessage'])
            ->name('api.v1.conversations.messages.send');

        Route::post('/conversations/{id}/typing', [\Modules\Social\Http\Controllers\ConversationController::class, 'typing'])
            ->name('api.v1.conversations.typing');

        Route::post('/conversations/{id}/read', [\Modules\Social\Http\Controllers\ConversationController::class, 'markRead'])
            ->name('api.v1.conversations.read');

        // Emergency SOS Distress & Responders (Authenticated)
        Route::post('/emergency/sos', [\Modules\Social\Http\Controllers\EmergencySosController::class, 'trigger'])
            ->name('api.v1.emergency.sos.trigger');

        Route::post('/emergency/sos/{id}/resolve', [\Modules\Social\Http\Controllers\EmergencySosController::class, 'resolve'])
            ->name('api.v1.emergency.sos.resolve');

        Route::get('/emergency/active', [\Modules\Social\Http\Controllers\EmergencySosController::class, 'active'])
            ->name('api.v1.emergency.active');

        Route::get('/emergency/history', [\Modules\Social\Http\Controllers\EmergencySosController::class, 'history'])
            ->name('api.v1.emergency.history');

        Route::get('/emergency/contacts', [\Modules\Social\Http\Controllers\EmergencySosController::class, 'getContacts'])
            ->name('api.v1.emergency.contacts.index');

        Route::post('/emergency/contacts', [\Modules\Social\Http\Controllers\EmergencySosController::class, 'addContact'])
            ->name('api.v1.emergency.contacts.store');

        Route::delete('/emergency/contacts/{id}', [\Modules\Social\Http\Controllers\EmergencySosController::class, 'deleteContact'])
            ->name('api.v1.emergency.contacts.destroy');
    });

    // Public / Hybrid Feeds and Posts (Optional Sanctum Auth handled in controller)
    Route::get('/feed', [\Modules\Social\Http\Controllers\PostController::class, 'feed'])
        ->name('api.v1.feed');

    Route::get('/feed/hyperlocal/{wardCode}', [\Modules\Social\Http\Controllers\HyperlocalController::class, 'feed'])
        ->name('api.v1.feed.hyperlocal');

    Route::get('/feed/hyperlocal/{wardCode}/notices', [\Modules\Social\Http\Controllers\HyperlocalController::class, 'notices'])
        ->name('api.v1.feed.hyperlocal.notices');

    Route::get('/feed/hyperlocal/{wardCode}/stats', [\Modules\Social\Http\Controllers\HyperlocalController::class, 'stats'])
        ->name('api.v1.feed.hyperlocal.stats');

    Route::get('/users/{identifier}/posts', [\Modules\Social\Http\Controllers\PostController::class, 'userPosts'])
        ->name('api.v1.users.posts');

    Route::get('/posts/{id}', [\Modules\Social\Http\Controllers\PostController::class, 'show'])
        ->name('api.v1.posts.show');

    // Signed route for local/dev direct media upload
    Route::post('/media/direct-upload', [\Modules\Social\Http\Controllers\MediaController::class, 'directUpload'])
        ->name('api.v1.media.direct-upload');
});
