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
// use App\Http\Controllers\Api\ChatMessagesController;
// use App\Http\Controllers\Api\ChatsController;
// use App\Http\Controllers\Api\MessagesController;
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
use App\Http\Controllers\Api\VendorsController;
use App\Http\Controllers\Api\WalletsController;
use App\Http\Controllers\Api\WinnersController;
use App\Http\Controllers\Api\WishlistAdsController;
use App\Http\Controllers\Api\WishlistDealsController;
use App\Http\Controllers\VitrineController;
use App\Http\Controllers\Api\ViewController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\ConversationController;

/*
|--------------------------------------------------------------------------
| ROLES DE LA PLATEFORME TIJARA
|--------------------------------------------------------------------------
| IdRole = 1 -> User (acheteur / visiteur connecte)
| IdRole = 2 -> Entreprise (vendeur)
| IdRole = 3 -> Admin (moderation + configuration globale)
|
| CHANGELOG (audit du 01/08/2026) :
| - Suppression de la route 'invoices index' dupliquee en Section 3
|   (meme URL que celle de la Section 2, jamais executee -> code mort).
| - Ajout de routes vendeur scopees : /vendors/{id}/payments,
|   /vendors/{id}/transports, /vendors/{id}/reports (l'entreprise ne
|   pouvait voir que ses factures, pas ses paiements/transports/signalements).
| - Remplacement de PUT/DELETE brut sur /orders (cote acheteur) par des
|   transitions explicites : cancel (acheteur), accept/reject/ship
|   (vendeur), meme logique que /ads/{id}/activate deja en place.
| - /products/{id}/stats et /ads/{id}/stats deplaces a cote de leurs
|   routes de module respectives (etaient isolees en bas de Section 1).
| - Ajout de tags en lecture publique (Section 1) : rien ne les exposait
|   avant, alors que Section 2 permettait deja de les creer/editer.
| - ATTENTION : /ads/search|category|typecat|state|country|user|price|active
|   et l'equivalent /products/... pointent vers des methodes de controleur
|   (search, byCategory, byUser, byPriceRange, byActive...) absentes du
|   code source partage. Laissees en place mais marquees TODO ci-dessous -
|   a confirmer avant mise en prod, sinon elles renverront une erreur 500.
|   index() couvre deja les memes filtres via query string (?search=,
|   ?IdCateg=, ?PriceAd_min=&PriceAd_max=, ?Active=...).
| - Fusion du 06/08/2026 : la version distante avait un doublon de la
|   Section 4 (admin) avec un groupe 'orders' plus restrictif
|   (['index','destroy']) et un second bloc middleware admin en fin de
|   fichier qui ne faisait que redeclarer 'users'. Les deux ont ete
|   dedupliques ici : une seule Section 4, orders garde 'update' pour
|   permettre a l'admin de trancher les litiges (voir NB ci-dessous).
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| 1) PUBLIC — pas d'authentification requise
|--------------------------------------------------------------------------
*/

// ---- Authentification ----
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);
Route::get('/auth/facebook', [AuthController::class, 'redirectToFacebook']);
Route::get('/auth/facebook/callback', [AuthController::class, 'handleFacebookCallback']);

// ---- Vitrine publique ----
Route::get('/vitrine', [VitrineController::class, 'index']);

// ---- Catalogue produits (lecture seule) ----
Route::get('/products', [ProductsController::class, 'index']);
// TODO verifier existence des methodes ci-dessous avant prod (voir CHANGELOG)
Route::get('/products/search/{search}', [ProductsController::class, 'search']);
Route::get('/products/category/{IdCateorie}', [ProductsController::class, 'byCategory']);
Route::get('/products/user/{IdUser}', [ProductsController::class, 'byUser']);
Route::get('/products/price/{min_price}/{max_price}', [ProductsController::class, 'byPriceRange']);
Route::get('/products/active/{Active}', [ProductsController::class, 'byActive']);
Route::get('/products/{id}/stats', [ViewController::class, 'productStats']);
Route::get('/products/{products}', [ProductsController::class, 'show']);

// ---- Annonces (lecture seule) ----
Route::get('/ads', [AdsController::class, 'index']);
// TODO verifier existence des methodes ci-dessous avant prod (voir CHANGELOG)
Route::get('/ads/search/{search}', [AdsController::class, 'search']);
Route::get('/ads/category/{IdCateg}', [AdsController::class, 'byCategory']);
Route::get('/ads/typecat/{Idtypecat}', [AdsController::class, 'byTypeCat']);
Route::get('/ads/state/{IdState}', [AdsController::class, 'byState']);
Route::get('/ads/country/{IdCountry}', [AdsController::class, 'byCountry']);
Route::get('/ads/user/{IdUser}', [AdsController::class, 'byUser']);
Route::get('/ads/price/{min_price}/{max_price}', [AdsController::class, 'byPriceRange']);
Route::get('/ads/active/{Active}', [AdsController::class, 'byActive']);
Route::get('/ads/{id}/stats', [ViewController::class, 'adStats']);
Route::get('/ads/{ads}', [AdsController::class, 'show']);

// ---- Deals / promotions (lecture seule) ----
Route::get('/deals', [DealsController::class, 'index']);
Route::get('/deals/{deals}', [DealsController::class, 'show']);

// ---- Referentiels publics (necessaires pour naviguer / s'inscrire) ----
Route::get('/categories-roots', [CategoriesController::class, 'roots']);
Route::get('/categories/{categories}/children', [CategoriesController::class, 'children']);
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
Route::apiResource('point-packets', PointPacketsController::class)->only(['index', 'show']); // pricing packs
Route::apiResource('boost-ads-packs', BoostAdsPacksController::class)->only(['index', 'show']); // pricing packs
Route::apiResource('prizes', PrizesController::class)->only(['index', 'show']); // catalogue public de lots
Route::apiResource('vendors', VendorsController::class)->only(['index', 'show']); // fiches vendeurs publiques
// Tags: consultables publiquement (ex: tags populaires sur une annonce) ;
// creation/edition reste reservee aux users connectes (Section 2).
Route::apiResource('tags', TagsController::class)->only(['index', 'show']);

// ---- Avis / notes (lecture seule, preuve sociale) ----
Route::apiResource('reviews', ReviewsController::class)->only(['index', 'show']);
Route::apiResource('ratings', RatingsController::class)->only(['index', 'show']);

// ---- Coupons : verification uniquement (pas de listing public) ----
Route::post('/coupons/validate', [CouponsController::class, 'validateCoupon']);

// ---- Paiement de facture via lien recu par email/SMS (numero = jeton) ----
Route::get('/invoices/number/{number}', [InvoicesController::class, 'showByNumber']);
Route::get('/invoices/{number}/pdf', [InvoicesController::class, 'downloadPDF']);
Route::post('/invoices/{number}/pay', [InvoicesController::class, 'pay']);
Route::post('/invoices/{number}/cancel', [InvoicesController::class, 'cancel']);


/*
|--------------------------------------------------------------------------
| 2) USER CONNECTE — auth:api (IdRole = 1, mais commun a 2 et 3 aussi)
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
    // NB (audit) : update/destroy doivent verifier IdUser === auth()->id()
    // cote controleur - non visible depuis les routes, a corriger dans
    // AdCommentsController / AdLikesController / CommentsController / LikesController.
    Route::apiResource('ad-comments', AdCommentsController::class);
    Route::apiResource('ad-likes', AdLikesController::class);
    Route::apiResource('comments', CommentsController::class);
    Route::apiResource('likes', LikesController::class);
    // index/show publics (Section 1) ; ici on n'ouvre que la creation/edition/suppression
    Route::apiResource('reviews', ReviewsController::class)->only(['store', 'update', 'destroy']);
    Route::apiResource('ratings', RatingsController::class)->only(['store', 'update', 'destroy']);

    // Route::apiResource('messages', MessagesController::class);
    // Route::post('/chats/start', [ChatsController::class, 'start']);
    // Route::get('/chats', [ChatsController::class, 'index']);
    // Route::get('/chats/{chats}', [ChatsController::class, 'show']);
    // Route::put('/chats/{chats}', [ChatsController::class, 'update']);
    // Route::delete('/chats/{chats}', [ChatsController::class, 'destroy']);
    // Route::get('/chats/{idChat}/messages', [ChatMessagesController::class, 'index']);
    // Route::post('/chats/{idChat}/messages', [ChatMessagesController::class, 'store']);
    // Route::get('/chat-messages/{chat_messages}', [ChatMessagesController::class, 'show']);
    // Route::delete('/chat-messages/{chat_messages}', [ChatMessagesController::class, 'destroy']);

    // ---- Conversations / messages (acheteur <-> vendeur) ----
    Route::get('/conversations', [ConversationController::class, 'index'])->name('conversations.index');
    Route::post('/conversations', [ConversationController::class, 'store'])->name('conversations.store');
    Route::get('/conversations/{conversation}', [ConversationController::class, 'show'])->name('conversations.show');
    Route::post('/conversations/{conversation}/messages', [MessageController::class, 'store'])->name('messages.store');

    Route::apiResource('notifications', NotificationsController::class);
    Route::apiResource('user-follows', UserFollowsController::class);
    // index/show des tags publics (Section 1) ; ici creation/edition
    Route::apiResource('tags', TagsController::class)->only(['store', 'update', 'destroy']);

    // ---- Commandes (cote acheteur) ----
    // NB (audit) : store/index/show uniquement ici. update/destroy bruts
    // retires - remplaces par une transition explicite 'cancel', pour ne
    // pas laisser un acheteur ecrire n'importe quel champ (ex: Status)
    // via un PUT generique. Le controleur doit filtrer index/show sur
    // l'utilisateur connecte (sauf admin, acces global en Section 4).
    Route::apiResource('orders', OrdersController::class)->only(['index', 'show', 'store']);
    Route::patch('/orders/{order}/cancel', [OrdersController::class, 'cancel']);

    Route::get('/order-details/total/{idOrder}', [OrderDetailsController::class, 'total']);
    Route::apiResource('order-details', OrderDetailsController::class);
    Route::apiResource('payments', PaymentsController::class)->only(['index', 'show', 'store']);
    Route::apiResource('deliveries', DeliveriesController::class)->only(['index', 'show']);
    Route::apiResource('invoices', InvoicesController::class)->only(['index', 'show', 'store']);
    Route::get('/customers/{id}/invoices', [InvoicesController::class, 'customerInvoices']);

    // ---- Profil / compte (uniquement le sien : pas d'index ni destroy ici) ----
    Route::get('/users/{users}', [UsersController::class, 'show']);
    Route::put('/users/{users}', [UsersController::class, 'update']);
    Route::get('/users/{id}/stats', [ViewController::class, 'userStats']);
    Route::get('/recently-viewed', [ViewController::class, 'recent']);
    Route::get('/wallets/{wallets}', [WalletsController::class, 'show']);

    // ---- Signalements (creer / consulter les siens) ----
    Route::apiResource('reports', ReportsController::class)->only(['index', 'show', 'store']);
});


/*
|--------------------------------------------------------------------------
| 3) ENTREPRISE (VENDEUR) — auth:api + middleware 'entreprise' (IdRole = 2)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:api', 'entreprise'])->group(function () {

    // ---- Gestion de ses propres produits ----
    // NB (audit) : le controleur DOIT verifier item->IdUser === auth()->id()
    // avant update/destroy/media/prize - actuellement absent, voir rapport.
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
    Route::apiResource('boosts', BoostsController::class)->except(['index']);

    // ---- Commandes recues (cote vendeur) ----
    // NB (audit) : nouveau - le vendeur n'avait auparavant AUCUNE route
    // pour agir sur les commandes contenant ses propres produits/annonces.
    Route::get('/orders/seller', [OrdersController::class, 'sellerOrders']);
    Route::patch('/orders/{order}/accept', [OrdersController::class, 'accept']);
    Route::patch('/orders/{order}/reject', [OrdersController::class, 'reject']);
    Route::patch('/orders/{order}/ship', [OrdersController::class, 'markShipped']);

    // ---- Livraisons liees a ses ventes ----
    Route::get('/deliveries/order/{idOrder}', [DeliveriesController::class, 'orderDeliveries']);
    Route::get('/deliveries/track/{trackingNumber}', [DeliveriesController::class, 'track']);
    Route::post('/deliveries/{id}/deliver', [DeliveriesController::class, 'markDelivered']);
    Route::post('/deliveries/{id}/status', [DeliveriesController::class, 'updateStatus']);
    Route::apiResource('deliveries', DeliveriesController::class)->only(['store', 'update']);

    // ---- Transport de ses colis ----
    Route::get('/transports/order/{idOrder}', [TransportsController::class, 'orderTransports']);
    Route::get('/transports/{id}/deliveries', [TransportsController::class, 'transportDeliveries']);

    // ---- Espace vendeur : sa fiche entreprise + ses ventes ----
    Route::apiResource('vendors', VendorsController::class)->only(['store', 'update', 'destroy']);
    Route::get('/vendors/{id}/invoices', [InvoicesController::class, 'vendorInvoices']);
    // NB (audit) : nouvelles routes scopees - avant cela, un vendeur devait
    // passer par des endpoints admin-only pour voir ses propres paiements,
    // ses transports ou les signalements lies a son activite.
    Route::get('/vendors/{id}/payments', [PaymentsController::class, 'vendorPayments']);
    Route::get('/vendors/{id}/transports', [TransportsController::class, 'vendorTransports']);
    Route::get('/vendors/{id}/reports', [ReportsController::class, 'vendorReports']);

    // ---- Suivi de ses paiements recus ----
    Route::get('/payments/order/{idOrder}', [PaymentsController::class, 'orderPayments']);
});


/*
|--------------------------------------------------------------------------
| 4) ADMIN — auth:api + middleware 'admin' (IdRole = 3)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:api', 'admin'])->group(function () {

    // ---- Activation / moderation du contenu publie ----
    Route::patch('/prizes/{prizes}/activate', [PrizesController::class, 'activate']);
    Route::patch('/ads/{ads}/activate', [AdsController::class, 'activate']);
    Route::patch('/products/{products}/activate', [ProductsController::class, 'activate']);

    // ---- Gestion des roles et permissions ----
    Route::apiResource('roles', RolesController::class);
    Route::apiResource('permissions', PermissionsController::class);
    Route::apiResource('list-permissions', ListPermissionsController::class);

    // ---- Gestion globale des comptes (au-dela de son propre profil) ----
    Route::apiResource('users', UsersController::class)->only(['index', 'destroy']);
    Route::apiResource('wallets', WalletsController::class)->only(['index', 'update', 'destroy']);
    Route::apiResource('email-tokens', EmailTokensController::class);

    // ---- Supervision globale et override des commandes / paiements / factures ----
    // NB (audit) : l'admin garde un acces global complet (index/update/destroy)
    // pour intervenir en cas de litige - c'est la difference structurelle
    // avec les transitions restreintes des Sections 2 et 3.
    Route::apiResource('orders', OrdersController::class)->only(['index', 'update', 'destroy']);
    Route::get('/payments/user/{idUser}', [PaymentsController::class, 'userPayments']);
    Route::post('/payments/{id}/complete', [PaymentsController::class, 'markCompleted']);
    Route::post('/payments/{id}/refund', [PaymentsController::class, 'refund']);
    Route::get('/payments/order/{idOrder}/total', [PaymentsController::class, 'totalPaid']);
    Route::apiResource('payments', PaymentsController::class)->only(['index', 'update', 'destroy']);
    Route::apiResource('invoices', InvoicesController::class)->only(['index', 'update', 'destroy']);
    Route::apiResource('deliveries', DeliveriesController::class)->only(['index', 'destroy']);
    Route::apiResource('transports', TransportsController::class)->except(['index', 'show']);
    Route::get('/transports/date-range', [TransportsController::class, 'dateRange']);
    Route::get('/transports/{id}/stats', [TransportsController::class, 'stats']);
    Route::post('/transports/{id}/toggle-active', [TransportsController::class, 'toggleActive']);

    // ---- Configuration de la plateforme (referentiels) ----
    Route::apiResource('admin-settings', AdminSettingsController::class);
    Route::apiResource('type-category', TypeCategoryController::class)->except(['index', 'show']);
    Route::apiResource('labels', LabelsController::class)->except(['index', 'show']);
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
    // 'show' reste public (Section 1) ; l'admin gere index/store/update/destroy
    Route::apiResource('coupons', CouponsController::class)->except(['show']);
    Route::apiResource('point-packets', PointPacketsController::class)->except(['index', 'show']);
    Route::apiResource('boost-ads-packs', BoostAdsPacksController::class)->except(['index', 'show']);
    Route::apiResource('boosts', BoostsController::class)->only(['index']);
    Route::apiResource('prizes', PrizesController::class)->except(['index', 'show']);
    Route::apiResource('winners', WinnersController::class);

    // ---- Vendeurs (moderation globale) ----
    Route::apiResource('vendors', VendorsController::class)->only(['destroy']);

    // ---- Avis / notes : moderation (suppression globale) ----
    Route::apiResource('reviews', ReviewsController::class)->only(['destroy']);
    Route::apiResource('ratings', RatingsController::class)->only(['destroy']);

    // ---- Supervision / logs ----
    Route::apiResource('sms-logs', SmsLogsController::class);
    Route::apiResource('errors', ErrorsController::class);
    Route::apiResource('reports', ReportsController::class)->only(['index', 'destroy']);

    // ---- Statistiques globales ----
    Route::get('/invoices/statistics', [InvoicesController::class, 'statistics']);
    Route::get('/invoices/revenue/monthly', [InvoicesController::class, 'monthlyRevenue']);

    // ---- Gestion complete des utilisateurs ----
    Route::apiResource('users', UsersController::class);
});
