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
use App\Http\Controllers\Api\CausesReportsController;
use App\Http\Controllers\Api\ChatMessagesController;
use App\Http\Controllers\Api\ChatsController;
use App\Http\Controllers\Api\CitiesController;
use App\Http\Controllers\Api\CausesController;
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
use App\Http\Controllers\Api\ViewController;
use App\Http\Controllers\Api\WalletsController;
use App\Http\Controllers\Api\WinnersController;
use App\Http\Controllers\Api\WishlistAdsController;
use App\Http\Controllers\Api\WishlistDealsController;


/*
|--------------------------------------------------------------------------
| 1) ROUTES PUBLIQUES — pas d'authentification requise
|    (navigation/consultation, comme un visiteur non connecte sur Wamia.tn)
|--------------------------------------------------------------------------
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

Route::get('/auth/facebook', [AuthController::class, 'redirectToFacebook']);
Route::get('/auth/facebook/callback', [AuthController::class, 'handleFacebookCallback']);




//hathom par exemple mayet3amlouch min8ir login
//kaa admin wala entreprise nheb naraf chkoun amali comments par exemple wala like
Route::apiResource('ad-comments', AdCommentsController::class);
Route::apiResource('ad-likes', AdLikesController::class);
Route::apiResource('admin-settings', AdminSettingsController::class);


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




Route::get('deliveries/track/{trackingNumber}', [DeliveriesController::class, 'track']);



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
// Custom routes FIRST
Route::get('payments/order/{idOrder}', [PaymentsController::class, 'orderPayments']);
Route::get('payments/user/{idUser}', [PaymentsController::class, 'userPayments']);
Route::post('payments/{id}/complete', [PaymentsController::class, 'markCompleted']);
Route::post('payments/{id}/refund', [PaymentsController::class, 'refund']);
Route::get('payments/order/{idOrder}/total', [PaymentsController::class, 'totalPaid']);

Route::apiResource('permissions', PermissionsController::class);
Route::apiResource('point-packets', PointPacketsController::class);
Route::apiResource('prizes', PrizesController::class);
Route::apiResource('products', ProductsController::class);

Route::apiResource('ratings', RatingsController::class);
Route::apiResource('reports', ReportsController::class);
Route::apiResource('reviews', ReviewsController::class);
Route::apiResource('roles', RolesController::class);
Route::apiResource('sms-logs', SmsLogsController::class);
Route::apiResource('states', StatesController::class);
Route::apiResource('tags', TagsController::class);

Route::apiResource('transports', TransportsController::class)->only(['index', 'show']);
Route::apiResource('type-category', TypeCategoryController::class);
Route::apiResource('user-follows', UserFollowsController::class);
Route::apiResource('users', UsersController::class);
Route::apiResource('wallets', WalletsController::class);
Route::apiResource('winners', WinnersController::class);
Route::apiResource('wishlist-ads', WishlistAdsController::class);
Route::apiResource('wishlist-deals', WishlistDealsController::class);



// ---- Routes publiques (non auth) ----

// Consultation publique du catalogue
Route::get('/products', [ProductsController::class, 'index']);
Route::get('/products/{products}', [ProductsController::class, 'show']);
Route::get('/products/search/{search}', [ProductsController::class, 'search']);
Route::get('/products/category/{IdCateorie}', [ProductsController::class, 'byCategory']);
Route::get('/products/user/{IdUser}', [ProductsController::class, 'byUser']);
Route::get('/products/price/{min_price}/{max_price}', [ProductsController::class, 'byPriceRange']);
Route::get('/products/active/{Active}', [ProductsController::class, 'byActive']);

Route::get('/ads', [AdsController::class, 'index']);
Route::get('/ads/{ads}', [AdsController::class, 'show']);
Route::get('/ads/search/{search}', [AdsController::class, 'search']);
Route::get('/ads/category/{IdCateg}', [AdsController::class, 'byCategory']);
Route::get('/ads/typecat/{Idtypecat}', [AdsController::class, 'byTypeCat']);
Route::get('/ads/state/{IdState}', [AdsController::class, 'byState']);
Route::get('/ads/country/{IdCountry}', [AdsController::class, 'byCountry']);
Route::get('/ads/user/{IdUser}', [AdsController::class, 'byUser']);
Route::get('/ads/price/{min_price}/{max_price}', [AdsController::class, 'byPriceRange']);
Route::get('/ads/active/{Active}', [AdsController::class, 'byActive']);

Route::get('/deals', [DealsController::class, 'index']);
Route::get('/deals/{deals}', [DealsController::class, 'show']);

Route::get('/categories-roots', [CategoriesController::class, 'roots']);
Route::get('/categories/{categories}/children', [CategoriesController::class, 'children']);

Route::post('/coupons/validate', [CouponsController::class, 'validateCoupon']);

Route::get('/invoices/{number}/pdf', [InvoicesController::class, 'downloadPDF']);
Route::get('/invoices/number/{number}', [InvoicesController::class, 'showByNumber']);
Route::post('/invoices/{number}/pay', [InvoicesController::class, 'pay']);
Route::post('/invoices/{number}/cancel', [InvoicesController::class, 'cancel']);
Route::get('/invoices/{id}/pdf', [InvoicesController::class, 'downloadPDF']);

// Products
Route::get(
    '/products/{products}',
    [ProductsController::class, 'show']
);


// Ads
Route::get(
    '/ads/{ads}',
    [AdsController::class, 'show']
);


// User profiles
Route::get(
    '/users/{users}',
    [UsersController::class, 'show']
);
/*
|--------------------------------------------------------------------------
| 2) ROUTES UTILISATEUR CONNECTE (auth:api) — cote "acheteur"
|    IdRole = 1 (user), mais aussi accessible a 2 (entreprise) et 3 (admin)
|    puisque ce sont toutes des actions d'achat/interaction standard
|--------------------------------------------------------------------------
*/

Route::middleware('auth:api')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // ---- Wishlists (cote acheteur) ----
    Route::post('/ads-wishlist/add', [AdsWishlistController::class, 'addToWishlist']);
    Route::delete('/ads-wishlist/remove', [AdsWishlistController::class, 'removeFromWishlist']);
    Route::apiResource('ads-wishlist', AdsWishlistController::class);

    Route::post('/deals-wishlist/add', [DealsWishlistController::class, 'addToWishlist']);
    Route::delete('/deals-wishlist/remove', [DealsWishlistController::class, 'removeFromWishlist']);
    Route::apiResource('deals-wishlist', DealsWishlistController::class);

    Route::post('/product-wishlist/add', [ProductWishlistController::class, 'addToWishlist']);
    Route::delete('/product-wishlist/remove', [ProductWishlistController::class, 'removeFromWishlist']);
    Route::apiResource('product-wishlist', ProductWishlistController::class);

    Route::apiResource('wishlist-ads', WishlistAdsController::class);
    Route::apiResource('wishlist-deals', WishlistDealsController::class);

    // ---- Interactions sociales ----
    Route::apiResource('ad-comments', AdCommentsController::class);
    Route::apiResource('ad-likes', AdLikesController::class);
    Route::apiResource('comments', CommentsController::class);
    Route::apiResource('likes', LikesController::class);
    Route::apiResource('reviews', ReviewsController::class);
    Route::apiResource('ratings', RatingsController::class);
    Route::apiResource('messages', MessagesController::class);

    Route::post('/chats/start', [ChatsController::class, 'start']);
    Route::get('/chats', [ChatsController::class, 'index']);
    Route::get('/chats/{chats}', [ChatsController::class, 'show']);
    Route::put('/chats/{chats}', [ChatsController::class, 'update']);
    Route::delete('/chats/{chats}', [ChatsController::class, 'destroy']);

    Route::get('/chats/{idChat}/messages', [ChatMessagesController::class, 'index']);
    Route::post('/chats/{idChat}/messages', [ChatMessagesController::class, 'store']);
    Route::get('/chat-messages/{chat_messages}', [ChatMessagesController::class, 'show']);
    Route::delete('/chat-messages/{chat_messages}', [ChatMessagesController::class, 'destroy']);

    Route::apiResource('notifications', NotificationsController::class);
    Route::apiResource('user-follows', UserFollowsController::class);
    Route::apiResource('tags', TagsController::class);

    // ---- Commandes / paiements / livraisons (les siennes, cote acheteur) ----
    Route::apiResource('orders', OrdersController::class);
    Route::apiResource('order-details', OrderDetailsController::class);
    Route::get('/order-details/total/{idOrder}', [OrderDetailsController::class, 'total']);
    Route::apiResource('payments', PaymentsController::class);
    Route::apiResource('deliveries', DeliveriesController::class);
    Route::apiResource('invoices', InvoicesController::class)->only(['show', 'store', 'update']);
    Route::get('/customers/{id}/invoices', [InvoicesController::class, 'customerInvoices']);

    // ---- Profil / compte ----
    Route::apiResource('users', UsersController::class);
    Route::apiResource('wallets', WalletsController::class);
    Route::apiResource('email-tokens', EmailTokensController::class);

    // ---- Signalements ----
    Route::apiResource('reports', ReportsController::class);

    // ---- Referentiels en lecture seule ----
    Route::apiResource('categories', CategoriesController::class)->only(['index', 'show']);
    Route::apiResource('brands', BrandsController::class)->only(['index', 'show']);
    Route::apiResource('cities', CitiesController::class)->only(['index', 'show']);
    Route::apiResource('countries', CountriesController::class)->only(['index', 'show']);
    Route::apiResource('countries-full', CountriesFullController::class)->only(['index', 'show']);
    Route::apiResource('states', StatesController::class)->only(['index', 'show']);
    Route::apiResource('causes', CausesController::class)->only(['index', 'show']);
    Route::apiResource('features', FeaturesController::class)->only(['index', 'show']);
    Route::apiResource('features-values', FeaturesValuesController::class)->only(['index', 'show']);
    Route::apiResource('feature-categories', FeatureCategoriesController::class)->only(['index', 'show']);
    Route::apiResource('transports', TransportsController::class)->only(['index', 'show']);
    Route::apiResource('type-category', TypeCategoryController::class)->only(['index', 'show']);
    Route::apiResource('labels', LabelsController::class)->only(['index', 'show']);
    Route::apiResource('point-packets', PointPacketsController::class)->only(['index', 'show']);
    Route::apiResource('coupons', CouponsController::class)->only(['index', 'show']);
    Route::apiResource('prizes', PrizesController::class)->only(['index', 'show']);



    // ---- Wishlists (buyer only, requires login) ----
    Route::post('/ads-wishlist/add', [AdsWishlistController::class, 'addToWishlist']);
    Route::delete('/ads-wishlist/remove', [AdsWishlistController::class, 'removeFromWishlist']);
    Route::apiResource('ads-wishlist', AdsWishlistController::class);

    Route::post('/deals-wishlist/add', [DealsWishlistController::class, 'addToWishlist']);
    Route::delete('/deals-wishlist/remove', [DealsWishlistController::class, 'removeFromWishlist']);
    Route::apiResource('deals-wishlist', DealsWishlistController::class);

    Route::post('/product-wishlist/add', [ProductWishlistController::class, 'addToWishlist']);
    Route::delete('/product-wishlist/remove', [ProductWishlistController::class, 'removeFromWishlist']);
    Route::apiResource('product-wishlist', ProductWishlistController::class);

    // ---- Payments (buyer initiates payment, views own history — cannot complete/refund) ----
    Route::apiResource('payments', PaymentsController::class)->only(['index', 'store', 'show']);
    Route::get('/payments/user/{idUser}', [PaymentsController::class, 'userPayments']);

    // ---- Deliveries (buyer can view/track their own orders' packages, not manage them) ----
    Route::apiResource('deliveries', DeliveriesController::class)->only(['index', 'show']);
    Route::get('/deliveries/order/{idOrder}', [DeliveriesController::class, 'orderDeliveries']);

    // ---- Transports read-only (already public, but harmless if kept here too — optional, can remove) ----
    // Route::apiResource('transports', TransportsController::class)->only(['index', 'show']); // redundant, public already covers it

    // ... rest unchanged ...
    Route::get(
        '/views/recent',
        [ViewController::class, 'recent']
    );

    Route::get(
        '/views/product/{id}',
        [ViewController::class, 'productStats']
    );


    Route::get(
        '/views/ad/{id}',
        [ViewController::class, 'adStats']
    );

    // View user profile (same public route but with token)
    Route::get(
        '/users/{users}',
        [UsersController::class, 'show']
    );
});



/*
|--------------------------------------------------------------------------
| 3) ROUTES ENTREPRISE (VENDEUR) — auth:api + middleware 'entreprise'
|    IdRole = 2. C'est ici que vit toute la logique "vendeur" (comme
|    l'espace pro sur Wamia.tn) : publier/gerer ses annonces, produits,
|    deals, booster ses publications, consulter ses ventes.
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:api', 'entreprise'])->group(function () {

    // ---- Gestion de ses propres produits ----
    Route::post('/products', [ProductsController::class, 'store']);
    Route::put('/products/{products}', [ProductsController::class, 'update']);
    Route::delete('/products/{products}', [ProductsController::class, 'destroy']);
    Route::delete('/products/{products}/photos', [ProductsController::class, 'removePhoto']);
    Route::delete('/products/{products}/videos', [ProductsController::class, 'removeVideo']);
    Route::post('/products/{products}/media', [ProductsController::class, 'addMedia']);
    Route::put('/products/{product}/assign-prize', [ProductsController::class, 'assignPrize']);
    Route::delete('/products/{product}/remove-prize', [ProductsController::class, 'removePrize']);

    // ---- Gestion de ses propres annonces ----
    Route::post('/ads', [AdsController::class, 'store']);
    Route::put('/ads/{ads}', [AdsController::class, 'update']);
    Route::delete('/ads/{ads}', [AdsController::class, 'destroy']);
    Route::delete('/ads/{ads}/photos', [AdsController::class, 'removePhoto']);
    Route::delete('/ads/{ads}/videos', [AdsController::class, 'removeVideo']);
    Route::post('/ads/{ads}/media', [AdsController::class, 'addMedia']);

    // ---- Gestion de ses propres deals / promotions ----
    Route::apiResource('deals', DealsController::class)->except(['index', 'show']);

    // ---- Boost des annonces/produits (visibilite payante) ----
    Route::apiResource('boost-ads-packs', BoostAdsPacksController::class)->only(['index', 'show']);
    Route::apiResource('boosts', BoostsController::class)->only(['index', 'show']);


    Route::get('/vendors/{id}/invoices', [InvoicesController::class, 'vendorInvoices']);
    Route::apiResource('invoices', InvoicesController::class)->only(['index', 'destroy']);
    // ---- Deliveries: vendor creates/manages colis for their own orders ----
    Route::apiResource('deliveries', DeliveriesController::class)->only(['store', 'update']);
    Route::post('/deliveries/{id}/status', [DeliveriesController::class, 'updateStatus']);
    Route::post('/deliveries/{id}/deliver', [DeliveriesController::class, 'markDelivered']);
    Route::get('/deliveries/order/{idOrder}', [DeliveriesController::class, 'orderDeliveries']);

    // ---- Payments: vendor can check payment status on their own orders, but not complete/refund ----
    Route::apiResource('payments', PaymentsController::class)->only(['index', 'show']);
    Route::get('/payments/order/{idOrder}', [PaymentsController::class, 'orderPayments']);

    // Vendor recently viewed
    Route::get(
        '/views/recent',
        [ViewController::class, 'recent']
    );


    // Product view statistics
    Route::get(
        '/views/product/{id}',
        [ViewController::class, 'productStats']
    );


    // Ad view statistics
    Route::get(
        '/views/ad/{id}',
        [ViewController::class, 'adStats']
    );
});


/*
|--------------------------------------------------------------------------
| 4) ROUTES ADMIN UNIQUEMENT — auth:api + middleware 'admin' (IdRole = 3)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:api', 'admin'])->group(function () {

    // ---- Activation / moderation ----
    Route::patch('/prizes/{prizes}/activate', [PrizesController::class, 'activate']);
    Route::patch('/ads/{ads}/activate', [AdsController::class, 'activate']);
    Route::patch('/products/{products}/activate', [ProductsController::class, 'activate']);

    // ---- Gestion des roles et permissions ----
    Route::apiResource('roles', RolesController::class);
    Route::apiResource('permissions', PermissionsController::class);
    Route::apiResource('list-permissions', ListPermissionsController::class);

    // ---- Configuration de la plateforme ----
    Route::apiResource('admin-settings', AdminSettingsController::class);
    Route::apiResource('type-category', TypeCategoryController::class)->except(['index', 'show']);
    Route::apiResource('labels', LabelsController::class)->except(['index', 'show']);
    Route::apiResource('transports', TransportsController::class)->except(['index', 'show']);
    Route::apiResource('features', FeaturesController::class)->except(['index', 'show']);
    Route::apiResource('features-values', FeaturesValuesController::class)->except(['index', 'show']);
    Route::apiResource('feature-categories', FeatureCategoriesController::class)->except(['index', 'show']);
    Route::apiResource('brands', BrandsController::class)->except(['index', 'show']);
    Route::apiResource('categories', CategoriesController::class)->except(['index', 'show']);
    Route::apiResource('cities', CitiesController::class)->except(['index', 'show']);
    Route::apiResource('countries', CountriesController::class)->except(['index', 'show']);
    Route::apiResource('countries-full', CountriesFullController::class)->except(['index', 'show']);
    Route::apiResource('states', StatesController::class)->except(['index', 'show']);
    Route::apiResource('causes', CausesController::class)->except(['index', 'show']);
    Route::apiResource('causes-reports', CausesReportsController::class);

    // ---- Offres commerciales de la plateforme (packs, coupons, boosts, prizes) ----
    Route::apiResource('coupons', CouponsController::class)->except(['index', 'show']);
    Route::apiResource('point-packets', PointPacketsController::class)->except(['index', 'show']);
    Route::apiResource('boost-ads-packs', BoostAdsPacksController::class)->except(['index', 'show']);
    Route::apiResource('boosts', BoostsController::class)->except(['index', 'show']);
    Route::apiResource('prizes', PrizesController::class)->except(['index', 'show']);
    Route::apiResource('winners', WinnersController::class);

    // ---- Supervision / logs ----
    Route::apiResource('sms-logs', SmsLogsController::class);
    Route::apiResource('errors', ErrorsController::class);
    Route::apiResource('reports', ReportsController::class)->only(['index']);

    // ---- Statistiques globales ----
    Route::get('/invoices/statistics', [InvoicesController::class, 'statistics']);
    Route::get('/invoices/revenue/monthly', [InvoicesController::class, 'monthlyRevenue']);

    // ---- Transports: full carrier management (already existed, unchanged) ----
    Route::apiResource('transports', TransportsController::class)->except(['index', 'show']);
    Route::get('/transports/date-range', [TransportsController::class, 'dateRange']);
    Route::get('/transports/order/{idOrder}', [TransportsController::class, 'orderTransports']);
    Route::get('/transports/{id}/deliveries', [TransportsController::class, 'transportDeliveries']);
    Route::post('/transports/{id}/toggle-active', [TransportsController::class, 'toggleActive']);
    Route::get('/transports/{id}/stats', [TransportsController::class, 'stats']);

    // ---- Deliveries: admin can delete/override any delivery record ----
    Route::apiResource('deliveries', DeliveriesController::class)->only(['destroy']);

    // ---- Payments: sensitive money actions restricted to admin ----
    Route::post('/payments/{id}/complete', [PaymentsController::class, 'markCompleted']);
    Route::post('/payments/{id}/refund', [PaymentsController::class, 'refund']);
    Route::get('/payments/order/{idOrder}/total', [PaymentsController::class, 'totalPaid']);
    Route::apiResource('payments', PaymentsController::class)->only(['destroy']);

    // Any user's recent views (if needed)
    Route::get(
        '/views/recent',
        [ViewController::class, 'recent']
    );


    // Product statistics
    Route::get(
        '/views/product/{id}',
        [ViewController::class, 'productStats']
    );


    // Ad statistics
    Route::get(
        '/views/ad/{id}',
        [ViewController::class, 'adStats']
    );

    Route::get(
        '/users/{users}',
        [UsersController::class, 'show']
    );
});
