<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Products;
use App\Models\Ads;

class ViewController extends Controller
{

    /**
     * Register product/ad view
     */
    public function registerView($user, $type, $item)
    {

        // Update item statistics

        $item->ViewCount = ($item->ViewCount ?? 0) + 1;
        $item->LastViewedAt = now();
        $item->save();



        // User history

        $recent = $user->RecentlyViewed ?? [];


        if (is_string($recent)) {
            $recent = json_decode($recent, true) ?? [];
        }



        $recent = array_values(array_filter($recent, function ($view) use ($type, $item) {

            return !(
                ($view['type'] ?? '') === $type &&
                ($view['id'] ?? 0) == $item->getKey()
            );
        }));



        array_unshift($recent, [

            'type' => $type,

            'id' => $item->getKey(),

            'at' => now()->toDateTimeString()

        ]);



        $recent = array_slice($recent, 0, 20);



        $user->RecentlyViewed = $recent;

        $user->save();
    }

    /**
     * Get user recently viewed products/ads
     */
    public function recent()
    {

        /** @var Users $user */
        $user = auth('api')->user();

        if (!$user) {

            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }


        $recent = $user->RecentlyViewed ?? [];


        if (is_string($recent)) {

            $recent = json_decode($recent, true) ?? [];
        }



        $result = [];



        foreach ($recent as $view) {


            if (($view['type'] ?? '') === 'product') {


                $item = Products::find($view['id']);
            } else {


                $item = Ads::find($view['id']);
            }



            if ($item) {

                $result[] = [

                    'type' => $view['type'],

                    'viewed_at' => $view['at'],

                    'data' => $item

                ];
            }
        }



        return response()->json([

            'success' => true,

            'count' => count($result),

            'data' => $result

        ]);
    }





    /**
     * Product statistics
     */
    public function productStats($id)
    {

        $product = Products::findOrFail($id);


        return response()->json([

            'success' => true,

            'ViewCount' => $product->ViewCount,

            'LastViewedAt' => $product->LastViewedAt

        ]);
    }




    /**
     * Ad statistics
     */
    public function adStats($id)
    {

        $ad = Ads::findOrFail($id);


        return response()->json([

            'success' => true,

            'ViewCount' => $ad->ViewCount,

            'LastViewedAt' => $ad->LastViewedAt

        ]);
    }
}
