[1mdiff --cc routes/api.php[m
[1mindex af10a98,ffe36b1..0000000[m
[1m--- a/routes/api.php[m
[1m+++ b/routes/api.php[m
[36m@@@ -334,37 -304,14 +334,45 @@@[m [mRoute::middleware(['auth:api', 'entrepr[m
  [m
      // ---- Suivi de ses paiements recus ----[m
      Route::get('/payments/order/{idOrder}', [PaymentsController::class, 'orderPayments']);[m
[31m- });[m
  [m
  [m
[32m++<<<<<<< HEAD[m
[32m +/*[m
[32m +|--------------------------------------------------------------------------[m
[32m +| 4) ADMIN — auth:api + middleware 'admin' (IdRole = 3)[m
[32m +|--------------------------------------------------------------------------[m
[32m +*/[m
[32m +[m
[32m +Route::middleware(['auth:api', 'admin'])->group(function () {[m
[32m +[m
[32m +    // ---- Activation / moderation du contenu publie ----[m
[32m +    Route::patch('/prizes/{prizes}/activate', [PrizesController::class, 'activate']);[m
[32m +    Route::patch('/ads/{ads}/activate', [AdsController::class, 'activate']);[m
[32m +    Route::patch('/products/{products}/activate', [ProductsController::class, 'activate']);[m
[32m +[m
[32m +    // ---- Gestion des roles et permissions ----[m
[32m +    Route::apiResource('roles', RolesController::class);[m
[32m +    Route::apiResource('permissions', PermissionsController::class);[m
[32m +    Route::apiResource('list-permissions', ListPermissionsController::class);[m
[32m +[m
[32m +    // ---- Gestion globale des comptes (au-dela de son propre profil) ----[m
[32m +    Route::apiResource('users', UsersController::class)->only(['index', 'destroy']);[m
[32m +    Route::apiResource('wallets', WalletsController::class)->only(['index', 'update', 'destroy']);[m
[32m +    Route::apiResource('email-tokens', EmailTokensController::class);[m
[32m +[m
[32m +    // ---- Supervision globale et override des commandes / paiements / factures ----[m
[32m +    // NB (audit) : l'admin garde un acces global complet (index/update/destroy)[m
[32m +    // pour intervenir en cas de litige - c'est la difference structurelle[m
[32m +    // avec les transitions restreintes des Sections 2 et 3.[m
[32m +    Route::apiResource('orders', OrdersController::class)->only(['index', 'update', 'destroy']);[m
[32m++=======[m
[32m+ [m
[32m+ [m
[32m+     //---------------------eli kanou fl admin 9bal ----------------------[m
[32m+     [m
[32m+     // ---- Vision globale des commandes / paiements / factures ----[m
[32m+     Route::apiResource('orders', OrdersController::class)->only(['index', 'destroy']);[m
[32m++>>>>>>> cf13bf0e473ed428397b6a671feeab98ee1ce94f[m
      Route::get('/payments/user/{idUser}', [PaymentsController::class, 'userPayments']);[m
      Route::post('/payments/{id}/complete', [PaymentsController::class, 'markCompleted']);[m
      Route::post('/payments/{id}/refund', [PaymentsController::class, 'refund']);[m
