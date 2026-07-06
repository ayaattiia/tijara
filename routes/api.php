<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

use App\Http\Controllers\Api\AdCommentsController;
use App\Http\Controllers\Api\AdLikesController;
use App\Http\Controllers\Api\AdminSettingsController;
use App\Http\Controllers\Api\AdsController;
use App\Http\Controllers\Api\AdsWishlistController;
use App\Http\Controllers\Api\BoostAdsPacksController;
use App\Http\Controllers\Api\BoostsController;
use App\Http\Controllers\Api\BrandsController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\CausesController;
use App\Http\Controllers\Api\CausesReportsController;
use App\Http\Controllers\Api\ChatMessagesController;
use App\Http\Controllers\Api\ChatsController;
use App\Http\Controllers\Api\CitiesController;
use App\Http\Controllers\Api\CommentsController;
use App\Http\Controllers\Api\CountriesController;
use App\Http\Controllers\Api\CountriesFullController;
use App\Http\Controllers\Api\CouponsController;
use App\Http\Controllers\Api\DealsController;
use App\Http\Controllers\Api\DealsWishlistController;
use App\Http\Controllers\Api\DeliveriesController;
use App\Http\Controllers\Api\EmailTokensController;
use App\Http\Controllers\Api\ErrorsController;
use App\Http\Controllers\Api\FeatureCategoriesController;
use App\Http\Controllers\Api\FeaturesController;
use App\Http\Controllers\Api\FeaturesValuesController;
use App\Http\Controllers\Api\InvoicesController;
use App\Http\Controllers\Api\LabelsController;
use App\Http\Controllers\Api\LikesController;
use App\Http\Controllers\Api\ListPermissionsController;
use App\Http\Controllers\Api\MessagesController;
use App\Http\Controllers\Api\NotificationsController;
use App\Http\Controllers\Api\OrderDetailsController;
use App\Http\Controllers\Api\OrdersController;
use App\Http\Controllers\Api\PaymentsController;
use App\Http\Controllers\Api\PermissionsController;
use App\Http\Controllers\Api\PointPacketsController;
use App\Http\Controllers\Api\PrizesController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\ProductWishlistController;
use App\Http\Controllers\Api\RatingsController;
use App\Http\Controllers\Api\ReportsController;
use App\Http\Controllers\Api\ReviewsController;
use App\Http\Controllers\Api\RolesController;
use App\Http\Controllers\Api\SmsLogsController;
use App\Http\Controllers\Api\StatesController;
use App\Http\Controllers\Api\TagsController;
use App\Http\Controllers\Api\TransportsController;
use App\Http\Controllers\Api\TypeCategoryController;
use App\Http\Controllers\Api\UserFollowsController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\WalletsController;
use App\Http\Controllers\Api\WinnersController;
use App\Http\Controllers\Api\WishlistAdsController;
use App\Http\Controllers\Api\WishlistDealsController;


// ---- Routes publiques (auth) ----
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

// ---- Routes protegees par Passport ----
Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    Route::apiResource('ad-comments', AdCommentsController::class);
    Route::apiResource('ad-likes', AdLikesController::class);
    Route::apiResource('admin-settings', AdminSettingsController::class);



    Route::apiResource('ads-wishlist', AdsWishlistController::class);
    Route::apiResource('boost-ads-packs', BoostAdsPacksController::class);
    Route::apiResource('boosts', BoostsController::class);
    Route::apiResource('brands', BrandsController::class);


    Route::get('categories-roots', [CategoriesController::class, 'roots']);
    Route::get('categories/{categories}/children', [CategoriesController::class, 'children']);
    Route::apiResource('categories', CategoriesController::class);


    Route::apiResource('causes', CausesController::class);
    Route::apiResource('causes-reports', CausesReportsController::class);
    Route::apiResource('chat-messages', ChatMessagesController::class);
    Route::apiResource('chats', ChatsController::class);
    Route::apiResource('cities', CitiesController::class);
    Route::apiResource('comments', CommentsController::class);
    Route::apiResource('countries', CountriesController::class);
    Route::apiResource('countries-full', CountriesFullController::class);
    Route::apiResource('coupons', CouponsController::class);
    Route::apiResource('deals', DealsController::class);
    Route::apiResource('deals-wishlist', DealsWishlistController::class);
    Route::apiResource('deliveries', DeliveriesController::class);
    Route::apiResource('email-tokens', EmailTokensController::class);
    Route::apiResource('errors', ErrorsController::class);
    Route::apiResource('feature-categories', FeatureCategoriesController::class);
    Route::apiResource('features', FeaturesController::class);
    Route::apiResource('features-values', FeaturesValuesController::class);
    Route::apiResource('invoices', InvoicesController::class);
    Route::apiResource('labels', LabelsController::class);
    Route::apiResource('likes', LikesController::class);
    Route::apiResource('list-permissions', ListPermissionsController::class);
    Route::apiResource('messages', MessagesController::class);
    Route::apiResource('notifications', NotificationsController::class);
    Route::apiResource('order-details', OrderDetailsController::class);
    Route::apiResource('orders', OrdersController::class);
    Route::apiResource('payments', PaymentsController::class);
    Route::apiResource('permissions', PermissionsController::class);
    Route::apiResource('point-packets', PointPacketsController::class);
    Route::apiResource('prizes', PrizesController::class);
    Route::apiResource('products', ProductsController::class);
    Route::apiResource('product-wishlist', ProductWishlistController::class);
    Route::apiResource('ratings', RatingsController::class);
    Route::apiResource('reports', ReportsController::class);
    Route::apiResource('reviews', ReviewsController::class);
    Route::apiResource('roles', RolesController::class);
    Route::apiResource('sms-logs', SmsLogsController::class);
    Route::apiResource('states', StatesController::class);
    Route::apiResource('tags', TagsController::class);
    Route::apiResource('transports', TransportsController::class);
    Route::apiResource('type-category', TypeCategoryController::class);
    Route::apiResource('user-follows', UserFollowsController::class);
    Route::apiResource('users', UsersController::class);
    Route::apiResource('wallets', WalletsController::class);
    Route::apiResource('winners', WinnersController::class);
    Route::apiResource('wishlist-ads', WishlistAdsController::class);
    Route::apiResource('wishlist-deals', WishlistDealsController::class);





});

// ---- Routes publiques (non auth) ----
Route::get('/products', [ProductsController::class, 'index']);
Route::post('/products', [ProductsController::class, 'store']);
Route::get('/products/{products}', [ProductsController::class, 'show']);
Route::put('/products/{products}', [ProductsController::class, 'update']);
Route::delete('/products/{products}', [ProductsController::class, 'destroy']);

Route::get('/products/search/{search}', [ProductsController::class, 'search']);
Route::get('/products/category/{IdCateorie}', [ProductsController::class, 'byCategory']);
Route::get('/products/user/{IdUser}', [ProductsController::class, 'byUser']);
Route::get('/products/price/{min_price}/{max_price}', [ProductsController::class, 'byPriceRange']);
Route::get('/products/active/{Active}', [ProductsController::class, 'byActive']);  

Route::get('/ads', [AdsController::class, 'index']);
Route::get('/ads/{ads}', [AdsController::class, 'show']);
Route::post('/ads', [AdsController::class, 'store']);
Route::put('/ads/{ads}', [AdsController::class, 'update']);
Route::delete('/ads/{ads}', [AdsController::class, 'destroy']);

Route::get('/ads/search/{search}', [AdsController::class, 'search']);
Route::get('/ads/category/{IdCateg}', [AdsController::class, 'byCategory']);
Route::get('/ads/typecat/{Idtypecat}', [AdsController::class, 'byTypeCat']);
Route::get('/ads/state/{IdState}', [AdsController::class, 'byState']);
Route::get('/ads/country/{IdCountry}', [AdsController::class, 'byCountry']);
Route::get('/ads/user/{IdUser}', [AdsController::class, 'byUser']);
Route::get('/ads/price/{min_price}/{max_price}', [AdsController::class, 'byPriceRange']);
Route::get('/ads/active/{Active}', [AdsController::class, 'byActive']);
