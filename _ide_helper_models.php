<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $IdComment
 * @property int $IdAd
 * @property int $IdUser
 * @property string $Content
 * @property string|null $CreatedAt
 * @property int|null $Active
 * @property-read \App\Models\Ads|null $ad
 * @property-read \App\Models\Comments|null $comment
 * @property-read \App\Models\Users|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdComments newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdComments newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdComments query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdComments whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdComments whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdComments whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdComments whereIdAd($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdComments whereIdComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdComments whereIdUser($value)
 */
	class AdComments extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdLike
 * @property int $IdAd
 * @property int $IdUser
 * @property string|null $CreatedAt
 * @property-read \App\Models\Ads|null $ad
 * @property-read \App\Models\Likes|null $like
 * @property-read \App\Models\Users|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdLikes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdLikes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdLikes query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdLikes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdLikes whereIdAd($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdLikes whereIdLike($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdLikes whereIdUser($value)
 */
	class AdLikes extends \Eloquent {}
}

namespace App\Models{
/**
 * @property string $Key
 * @property string|null $Value
 * @property string $UpdatedAt
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdminSettings newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdminSettings newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdminSettings query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdminSettings whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdminSettings whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdminSettings whereValue($value)
 */
	class AdminSettings extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdAd
 * @property string|null $TitleAd
 * @property string|null $DescriptionAd
 * @property string|null $DetailsAd
 * @property string|null $PriceAd
 * @property int|null $IdPricesDelevery
 * @property string|null $DatePublication
 * @property string|null $ImageAd
 * @property string|null $VideoAd
 * @property int|null $IdCateg
 * @property int|null $IdUser
 * @property int|null $IdState
 * @property int|null $IdCountry
 * @property string|null $LocationAd
 * @property string|null $DateEnd
 * @property string|null $Color
 * @property string|null $Brand
 * @property string|null $Ownerads
 * @property string|null $Telephone
 * @property string|null $Email
 * @property string|null $StartDate
 * @property int|null $Idtypecat
 * @property int|null $Active
 * @property string|null $Type
 * @property-read \App\Models\Categories|null $categ
 * @property-read \App\Models\Countries|null $country
 * @property-read \App\Models\States|null $state
 * @property-read \App\Models\TypeCategory|null $typecat
 * @property-read \App\Models\Users|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ads newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ads newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ads query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ads whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ads whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ads whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ads whereDateEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ads whereDatePublication($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ads whereDescriptionAd($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ads whereDetailsAd($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ads whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ads whereIdAd($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ads whereIdCateg($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ads whereIdCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ads whereIdPricesDelevery($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ads whereIdState($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ads whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ads whereIdtypecat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ads whereImageAd($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ads whereLocationAd($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ads whereOwnerads($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ads wherePriceAd($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ads whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ads whereTelephone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ads whereTitleAd($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ads whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ads whereVideoAd($value)
 */
	class Ads extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdWishlistAd
 * @property int|null $IdUser
 * @property int|null $IdAd
 * @property int|null $Liked
 * @property-read \App\Models\Ads|null $ad
 * @property-read \App\Models\Users|null $user
 * @property-read \App\Models\WishlistAds|null $wishlistad
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdsWishlist newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdsWishlist newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdsWishlist query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdsWishlist whereIdAd($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdsWishlist whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdsWishlist whereIdWishlistAd($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdsWishlist whereLiked($value)
 */
	class AdsWishlist extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdBoost
 * @property string $Title
 * @property numeric $Price
 * @property numeric $Discount
 * @property int $MaxDuration
 * @property int $Sliders
 * @property int $SideBar
 * @property int $Footer
 * @property int $RelatedPost
 * @property int $FirstLogin
 * @property int $OrdersCount
 * @property int $Links
 * @property int $Active
 * @property string $CreatedAt
 * @property-read \App\Models\Boosts|null $boost
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BoostAdsPacks newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BoostAdsPacks newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BoostAdsPacks query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BoostAdsPacks whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BoostAdsPacks whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BoostAdsPacks whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BoostAdsPacks whereFirstLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BoostAdsPacks whereFooter($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BoostAdsPacks whereIdBoost($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BoostAdsPacks whereLinks($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BoostAdsPacks whereMaxDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BoostAdsPacks whereOrdersCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BoostAdsPacks wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BoostAdsPacks whereRelatedPost($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BoostAdsPacks whereSideBar($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BoostAdsPacks whereSliders($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BoostAdsPacks whereTitle($value)
 */
	class BoostAdsPacks extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdBoost
 * @property string $TitleBoost
 * @property float $Price
 * @property string|null $Discount
 * @property int|null $MaxDurationPerDay
 * @property int|null $InSliders
 * @property int|null $InSideBar
 * @property int|null $InFooter
 * @property int|null $InRelatedPost
 * @property int|null $InFirstLogin
 * @property int|null $HasLinks
 * @property int|null $Orders
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Boosts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Boosts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Boosts query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Boosts whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Boosts whereHasLinks($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Boosts whereIdBoost($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Boosts whereInFirstLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Boosts whereInFooter($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Boosts whereInRelatedPost($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Boosts whereInSideBar($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Boosts whereInSliders($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Boosts whereMaxDurationPerDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Boosts whereOrders($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Boosts wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Boosts whereTitleBoost($value)
 */
	class Boosts extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdBrand
 * @property string $Title
 * @property string $Description
 * @property string|null $Image
 * @property int $Active
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brands newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brands newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brands query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brands whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brands whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brands whereIdBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brands whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brands whereTitle($value)
 */
	class Brands extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdCateg
 * @property int $idparent
 * @property string|null $TitleEn
 * @property string|null $TitleFr
 * @property string|null $TitleAr
 * @property string|null $Description
 * @property string|null $Image
 * @property \App\Models\TypeCategory|null $idtypecat
 * @property int|null $Active
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Categories> $children
 * @property-read int|null $children_count
 * @property-read Categories|null $parent
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categories newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categories newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categories query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categories roots()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categories whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categories whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categories whereIdCateg($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categories whereIdparent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categories whereIdtypecat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categories whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categories whereTitleAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categories whereTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categories whereTitleFr($value)
 */
	class Categories extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdCause
 * @property string $Title
 * @property string|null $Description
 * @property string|null $Email
 * @property string|null $Type
 * @property int $Active
 * @property string $CreatedAt
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Causes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Causes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Causes query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Causes whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Causes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Causes whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Causes whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Causes whereIdCause($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Causes whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Causes whereType($value)
 */
	class Causes extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdCauseReport
 * @property string|null $TitleCauseEn
 * @property string|null $TitleCauseAr
 * @property string|null $TitleCauseFr
 * @property string|null $GroupName
 * @property int|null $Active
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CausesReports newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CausesReports newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CausesReports query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CausesReports whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CausesReports whereGroupName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CausesReports whereIdCauseReport($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CausesReports whereTitleCauseAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CausesReports whereTitleCauseEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CausesReports whereTitleCauseFr($value)
 */
	class CausesReports extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdChatMessage
 * @property int|null $IdChat
 * @property string|null $Message
 * @property string|null $CreateDate
 * @property int|null $IdUserSender
 * @property string|null $Report
 * @property string|null $AdminReview
 * @property int|null $Active
 * @property-read \App\Models\Chats|null $chat
 * @property-read \App\Models\Users|null $usersender
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChatMessages newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChatMessages newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChatMessages query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChatMessages whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChatMessages whereAdminReview($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChatMessages whereCreateDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChatMessages whereIdChat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChatMessages whereIdChatMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChatMessages whereIdUserSender($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChatMessages whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChatMessages whereReport($value)
 */
	class ChatMessages extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdChat
 * @property int|null $IdUserSender
 * @property int|null $IdUserReciver
 * @property string|null $CreatedAt
 * @property string|null $AdminReview
 * @property int|null $Active
 * @property-read \App\Models\Users|null $usersender
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chats newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chats newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chats query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chats whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chats whereAdminReview($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chats whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chats whereIdChat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chats whereIdUserReciver($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chats whereIdUserSender($value)
 */
	class Chats extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdCity
 * @property string $Title
 * @property int|null $IdCountry
 * @property string|null $TitleEn
 * @property string|null $TitleAr
 * @property string|null $Image
 * @property int $Active
 * @property string $CreatedAt
 * @property-read \App\Models\Countries|null $country
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cities newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cities newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cities query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cities whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cities whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cities whereIdCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cities whereIdCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cities whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cities whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cities whereTitleAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cities whereTitleEn($value)
 */
	class Cities extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdComment
 * @property int|null $IdUser
 * @property string|null $Comment
 * @property int|null $IdReplyComment
 * @property string|null $Date
 * @property int|null $IdCourse
 * @property int|null $IdLesson
 * @property int|null $IdMeet
 * @property int|null $Active
 * @property-read \App\Models\Users|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comments newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comments newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comments query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comments whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comments whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comments whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comments whereIdComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comments whereIdCourse($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comments whereIdLesson($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comments whereIdMeet($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comments whereIdReplyComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comments whereIdUser($value)
 */
	class Comments extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdCountry
 * @property string|null $country_code
 * @property string|null $country_enName
 * @property string|null $country_arName
 * @property string|null $country_enNationality
 * @property string|null $country_arNationality
 * @property int|null $Active
 * @property string|null $Title
 * @property string|null $Flag
 * @property string|null $Code
 * @property string|null $PhoneCode
 * @property string $CreatedAt
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Countries newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Countries newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Countries query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Countries whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Countries whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Countries whereCountryArName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Countries whereCountryArNationality($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Countries whereCountryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Countries whereCountryEnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Countries whereCountryEnNationality($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Countries whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Countries whereFlag($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Countries whereIdCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Countries wherePhoneCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Countries whereTitle($value)
 */
	class Countries extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdCountry
 * @property string $NameEN
 * @property string $NameFR
 * @property string|null $NameAR
 * @property string|null $NameDE
 * @property string|null $NameES
 * @property string|null $NameCH
 * @property string|null $NameRU
 * @property string|null $CodeCountry2
 * @property string|null $CodeCountry3
 * @property string|null $Flag
 * @property string|null $MAP
 * @property string|null $PhoneCode
 * @property string|null $Continent
 * @property int|null $Active
 * @property-read \App\Models\Countries|null $country
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CountriesFull newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CountriesFull newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CountriesFull query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CountriesFull whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CountriesFull whereCodeCountry2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CountriesFull whereCodeCountry3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CountriesFull whereContinent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CountriesFull whereFlag($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CountriesFull whereIdCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CountriesFull whereMAP($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CountriesFull whereNameAR($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CountriesFull whereNameCH($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CountriesFull whereNameDE($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CountriesFull whereNameEN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CountriesFull whereNameES($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CountriesFull whereNameFR($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CountriesFull whereNameRU($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CountriesFull wherePhoneCode($value)
 */
	class CountriesFull extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdCoupon
 * @property string $Title
 * @property string|null $Description
 * @property string|null $DateStart
 * @property string|null $DateEnd
 * @property numeric $Price
 * @property int $NumberOfCoupon
 * @property int $Used
 * @property int $Active
 * @property string $CreatedAt
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupons newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupons newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupons query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupons whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupons whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupons whereDateEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupons whereDateStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupons whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupons whereIdCoupon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupons whereNumberOfCoupon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupons wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupons whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupons whereUsed($value)
 */
	class Coupons extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdDeal
 * @property string|null $titleDeal
 * @property string|null $descriptionDeal
 * @property string|null $detailsDeal
 * @property string|null $priceDeal
 * @property string|null $discountDeal
 * @property string|null $quantity
 * @property string|null $datePublication
 * @property string|null $dateEnd
 * @property string|null $imageDeal
 * @property \App\Models\TypeCategory|null $idtypecat
 * @property int|null $idCateg
 * @property int|null $idUser
 * @property int|null $idState
 * @property int|null $idPrize
 * @property string|null $locationDeal
 * @property int|null $active
 * @property string|null $colors
 * @property int|null $likes
 * @property int|null $liked
 * @property string|null $telephone
 * @property string|null $email
 * @property string|null $ownerdeals
 * @property string|null $brand
 * @property string|null $startDate
 * @property int|null $TotalCount
 * @property-read \App\Models\Categories|null $idcateg
 * @property-read \App\Models\Prizes|null $idprize
 * @property-read \App\Models\States|null $idstate
 * @property-read \App\Models\Users|null $iduser
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deals newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deals newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deals query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deals whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deals whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deals whereColors($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deals whereDateEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deals whereDatePublication($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deals whereDescriptionDeal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deals whereDetailsDeal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deals whereDiscountDeal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deals whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deals whereIdCateg($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deals whereIdDeal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deals whereIdPrize($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deals whereIdState($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deals whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deals whereIdtypecat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deals whereImageDeal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deals whereLiked($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deals whereLikes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deals whereLocationDeal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deals whereOwnerdeals($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deals wherePriceDeal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deals whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deals whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deals whereTelephone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deals whereTitleDeal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deals whereTotalCount($value)
 */
	class Deals extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdWishlistDeal
 * @property int|null $IdUser
 * @property int|null $IdDeal
 * @property int|null $Liked
 * @property-read \App\Models\Deals|null $deal
 * @property-read \App\Models\Users|null $user
 * @property-read \App\Models\WishlistDeals|null $wishlistdeal
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DealsWishlist newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DealsWishlist newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DealsWishlist query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DealsWishlist whereIdDeal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DealsWishlist whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DealsWishlist whereIdWishlistDeal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DealsWishlist whereLiked($value)
 */
	class DealsWishlist extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdDelivery
 * @property int $IdOrder
 * @property int|null $IdTransport
 * @property string|null $TrackingNumber
 * @property string $Status
 * @property string|null $AddressLine
 * @property string|null $City
 * @property string|null $PostalCode
 * @property string|null $Phone
 * @property numeric|null $DeliveryFee
 * @property string|null $EstimatedAt
 * @property string|null $DeliveredAt
 * @property string|null $Note
 * @property string|null $CreatedAt
 * @property string|null $UpdatedAt
 * @property-read \App\Models\Orders|null $order
 * @property-read \App\Models\Transports|null $transport
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deliveries newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deliveries newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deliveries query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deliveries whereAddressLine($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deliveries whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deliveries whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deliveries whereDeliveredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deliveries whereDeliveryFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deliveries whereEstimatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deliveries whereIdDelivery($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deliveries whereIdOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deliveries whereIdTransport($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deliveries whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deliveries wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deliveries wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deliveries whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deliveries whereTrackingNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deliveries whereUpdatedAt($value)
 */
	class Deliveries extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdToken
 * @property int $IdUser
 * @property string $Token
 * @property string $Type
 * @property string $ExpiresAt
 * @property int|null $Used
 * @property string|null $CreatedAt
 * @property-read \App\Models\Users|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailTokens newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailTokens newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailTokens query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailTokens whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailTokens whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailTokens whereIdToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailTokens whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailTokens whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailTokens whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailTokens whereUsed($value)
 */
	class EmailTokens extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdError
 * @property int|null $IdUser
 * @property string|null $TitleError
 * @property string|null $Req
 * @property string|null $ReqError
 * @property string|null $ExceptionError
 * @property string|null $OtheError
 * @property string|null $Page
 * @property string|null $Action
 * @property string|null $dateTimeError
 * @property int|null $Validate
 * @property-read \App\Models\Users|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Errors newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Errors newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Errors query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Errors whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Errors whereDateTimeError($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Errors whereExceptionError($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Errors whereIdError($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Errors whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Errors whereOtheError($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Errors wherePage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Errors whereReq($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Errors whereReqError($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Errors whereTitleError($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Errors whereValidate($value)
 */
	class Errors extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdFC
 * @property int|null $IdCategory
 * @property int|null $IdFeature
 * @property-read \App\Models\Categories|null $category
 * @property-read \App\Models\Features|null $feature
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FeatureCategories newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FeatureCategories newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FeatureCategories query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FeatureCategories whereIdCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FeatureCategories whereIdFC($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FeatureCategories whereIdFeature($value)
 */
	class FeatureCategories extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdFeature
 * @property string|null $TitleFeature
 * @property string|null $DescriptionFeature
 * @property string|null $UnitFeature
 * @property string|null $ImgFeature
 * @property int|null $Active
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Features newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Features newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Features query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Features whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Features whereDescriptionFeature($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Features whereIdFeature($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Features whereImgFeature($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Features whereTitleFeature($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Features whereUnitFeature($value)
 */
	class Features extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdFV
 * @property string|null $ValueFeature
 * @property int|null $IdFeature
 * @property int|null $Active
 * @property-read \App\Models\Features|null $feature
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FeaturesValues newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FeaturesValues newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FeaturesValues query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FeaturesValues whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FeaturesValues whereIdFV($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FeaturesValues whereIdFeature($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FeaturesValues whereValueFeature($value)
 */
	class FeaturesValues extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdInvoice
 * @property string $Number
 * @property int $IdOrder
 * @property int $IdUser
 * @property int|null $IdVendor
 * @property numeric $Subtotal
 * @property numeric|null $Tax
 * @property numeric|null $DeliveryFee
 * @property numeric $Total
 * @property string|null $Status
 * @property string|null $IssuedAt
 * @property string|null $PaidAt
 * @property-read \App\Models\Orders|null $order
 * @property-read \App\Models\Users|null $user
 * @property-read \App\Models\Users|null $vendor
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoices newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoices newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoices query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoices whereDeliveryFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoices whereIdInvoice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoices whereIdOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoices whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoices whereIdVendor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoices whereIssuedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoices whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoices wherePaidAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoices whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoices whereSubtotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoices whereTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoices whereTotal($value)
 */
	class Invoices extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdLabel
 * @property string|null $TitleEn
 * @property string|null $TitleFr
 * @property string|null $TitleAr
 * @property string|null $Color
 * @property int|null $Active
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Labels newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Labels newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Labels query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Labels whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Labels whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Labels whereIdLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Labels whereTitleAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Labels whereTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Labels whereTitleFr($value)
 */
	class Labels extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdLike
 * @property int $IdUser
 * @property string $TargetType
 * @property int $TargetId
 * @property string|null $CreatedAt
 * @property-read \App\Models\Users|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Likes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Likes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Likes query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Likes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Likes whereIdLike($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Likes whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Likes whereTargetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Likes whereTargetType($value)
 */
	class Likes extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdListPermission
 * @property string|null $TitleEn
 * @property string|null $TitleFr
 * @property string|null $TitleAr
 * @property string|null $Description
 * @property string|null $GroupName
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ListPermissions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ListPermissions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ListPermissions query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ListPermissions whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ListPermissions whereGroupName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ListPermissions whereIdListPermission($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ListPermissions whereTitleAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ListPermissions whereTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ListPermissions whereTitleFr($value)
 */
	class ListPermissions extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdMessage
 * @property int|null $IdUserSender
 * @property int|null $IdUserReceiver
 * @property string|null $DateMessage
 * @property int|null $IdMessageReplay
 * @property string|null $Message
 * @property int|null $Active
 * @property-read \App\Models\Users|null $usersender
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Messages newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Messages newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Messages query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Messages whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Messages whereDateMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Messages whereIdMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Messages whereIdMessageReplay($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Messages whereIdUserReceiver($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Messages whereIdUserSender($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Messages whereMessage($value)
 */
	class Messages extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdNotification
 * @property string|null $Title
 * @property string|null $Description
 * @property string|null $Date
 * @property string|null $Type
 * @property int|null $IsRead
 * @property int|null $IdUser
 * @property-read \App\Models\Users|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notifications newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notifications newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notifications query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notifications whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notifications whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notifications whereIdNotification($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notifications whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notifications whereIsRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notifications whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notifications whereType($value)
 */
	class Notifications extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdOrderDeatils
 * @property int|null $IdUser
 * @property int|null $IdProduct
 * @property int|null $IdState
 * @property int|null $IdCountry
 * @property int|null $IdOrder
 * @property int|null $ZipCode
 * @property string|null $Address
 * @property string|null $Email
 * @property string|null $Telephone
 * @property string|null $FirstName
 * @property string|null $LastName
 * @property int|null $Quantity
 * @property string|null $TotalAmount
 * @property string|null $DateTimeCommand
 * @property int|null $Active
 * @property-read \App\Models\Countries|null $country
 * @property-read \App\Models\Orders|null $order
 * @property-read \App\Models\Products|null $product
 * @property-read \App\Models\States|null $state
 * @property-read \App\Models\Users|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderDetails newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderDetails newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderDetails query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderDetails whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderDetails whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderDetails whereDateTimeCommand($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderDetails whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderDetails whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderDetails whereIdCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderDetails whereIdOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderDetails whereIdOrderDeatils($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderDetails whereIdProduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderDetails whereIdState($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderDetails whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderDetails whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderDetails whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderDetails whereTelephone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderDetails whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderDetails whereZipCode($value)
 */
	class OrderDetails extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdOrder
 * @property int|null $IdUser
 * @property int|null $IdDeal
 * @property int|null $IdState
 * @property string|null $DateTimeCommand
 * @property int|null $Active
 * @property-read \App\Models\Deals|null $deal
 * @property-read \App\Models\States|null $state
 * @property-read \App\Models\Users|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Orders newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Orders newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Orders query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Orders whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Orders whereDateTimeCommand($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Orders whereIdDeal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Orders whereIdOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Orders whereIdState($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Orders whereIdUser($value)
 */
	class Orders extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdPayment
 * @property int $IdUser
 * @property int|null $IdOrder
 * @property numeric $Amount
 * @property string $Method
 * @property string $Status
 * @property string|null $Reference
 * @property string|null $TransactionId
 * @property string|null $CreatedAt
 * @property string|null $PaidAt
 * @property-read \App\Models\Orders|null $order
 * @property-read \App\Models\Users|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payments newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payments newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payments query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payments whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payments whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payments whereIdOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payments whereIdPayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payments whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payments whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payments wherePaidAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payments whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payments whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payments whereTransactionId($value)
 */
	class Payments extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdPermission
 * @property int|null $IdRole
 * @property int|null $IdListPermission
 * @property string|null $PermissionDate
 * @property string|null $Resource
 * @property int|null $CanRead
 * @property int|null $CanCreate
 * @property int|null $CanUpdate
 * @property int|null $CanDelete
 * @property-read \App\Models\ListPermissions|null $listpermission
 * @property-read \App\Models\Roles|null $role
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permissions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permissions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permissions query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permissions whereCanCreate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permissions whereCanDelete($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permissions whereCanRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permissions whereCanUpdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permissions whereIdListPermission($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permissions whereIdPermission($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permissions whereIdRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permissions wherePermissionDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permissions whereResource($value)
 */
	class Permissions extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdPacket
 * @property string $Title
 * @property string|null $Description
 * @property int $PointsCount
 * @property numeric $Price
 * @property numeric $Discount
 * @property int $Active
 * @property string $CreatedAt
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PointPackets newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PointPackets newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PointPackets query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PointPackets whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PointPackets whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PointPackets whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PointPackets whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PointPackets whereIdPacket($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PointPackets wherePointsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PointPackets wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PointPackets whereTitle($value)
 */
	class PointPackets extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $idPrize
 * @property string|null $image
 * @property string|null $title
 * @property string|null $description
 * @property int|null $idUser
 * @property int|null $active
 * @property string|null $datePublication
 * @property-read \App\Models\Users|null $iduser
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Prizes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Prizes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Prizes query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Prizes whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Prizes whereDatePublication($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Prizes whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Prizes whereIdPrize($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Prizes whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Prizes whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Prizes whereTitle($value)
 */
	class Prizes extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdWishlistProduct
 * @property int|null $IdUser
 * @property int|null $IdProduct
 * @property int|null $Liked
 * @property-read \App\Models\Products|null $product
 * @property-read \App\Models\Users|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductWishlist newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductWishlist newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductWishlist query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductWishlist whereIdProduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductWishlist whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductWishlist whereIdWishlistProduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductWishlist whereLiked($value)
 */
	class ProductWishlist extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdProduct
 * @property string|null $CodeBarProduct
 * @property string|null $CodeProduct
 * @property string|null $ReferenceProduct
 * @property string|null $TitleProduct
 * @property string|null $DescriptionProduct
 * @property int|null $QuantityProduct
 * @property string|null $ColorProduct
 * @property string|null $PriceProduct
 * @property string|null $TvaProduct
 * @property int|null $IdPricesDelevery
 * @property string|null $ImageProduct
 * @property string|null $VideoProduct
 * @property int|null $IdPrize
 * @property int|null $IdCateorie
 * @property int|null $IdUser
 * @property int|null $IdCountrie
 * @property int|null $Active
 * @property-read \App\Models\Categories|null $cateorie
 * @property-read \App\Models\Countries|null $countrie
 * @property-read \App\Models\Prizes|null $prize
 * @property-read \App\Models\Users|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Products newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Products newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Products query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Products whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Products whereCodeBarProduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Products whereCodeProduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Products whereColorProduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Products whereDescriptionProduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Products whereIdCateorie($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Products whereIdCountrie($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Products whereIdPricesDelevery($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Products whereIdPrize($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Products whereIdProduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Products whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Products whereImageProduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Products wherePriceProduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Products whereQuantityProduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Products whereReferenceProduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Products whereTitleProduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Products whereTvaProduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Products whereVideoProduct($value)
 */
	class Products extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdRating
 * @property int|null $IdUser
 * @property int|null $Rating
 * @property string|null $CommentRating
 * @property string|null $Date
 * @property string|null $TableName
 * @property int|null $IdTable
 * @property int|null $Active
 * @property-read \App\Models\Users|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ratings newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ratings newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ratings query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ratings whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ratings whereCommentRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ratings whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ratings whereIdRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ratings whereIdTable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ratings whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ratings whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ratings whereTableName($value)
 */
	class Ratings extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdReport
 * @property int|null $IdUser
 * @property int|null $IdCauseReport
 * @property string|null $Subject
 * @property string|null $Description
 * @property string|null $Date
 * @property int|null $State
 * @property string|null $TypeTable
 * @property int|null $IdTable
 * @property string|null $IdProduct
 * @property-read \App\Models\CausesReports|null $causereport
 * @property-read \App\Models\Products|null $product
 * @property-read \App\Models\Users|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reports newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reports newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reports query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reports whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reports whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reports whereIdCauseReport($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reports whereIdProduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reports whereIdReport($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reports whereIdTable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reports whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reports whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reports whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reports whereTypeTable($value)
 */
	class Reports extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdReview
 * @property int $IdUser
 * @property string $TargetType
 * @property int $TargetId
 * @property int $Rating
 * @property string|null $Comment
 * @property int $Active
 * @property string $CreatedAt
 * @property-read \App\Models\Users|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reviews newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reviews newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reviews query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reviews whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reviews whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reviews whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reviews whereIdReview($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reviews whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reviews whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reviews whereTargetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reviews whereTargetType($value)
 */
	class Reviews extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdRole
 * @property string|null $RoleUser
 * @property int|null $Active
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Roles newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Roles newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Roles query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Roles whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Roles whereIdRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Roles whereRoleUser($value)
 */
	class Roles extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdSms
 * @property string $Recipient
 * @property string $Message
 * @property string|null $Status
 * @property string|null $Provider
 * @property string|null $SentAt
 * @property string|null $Error
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SmsLogs newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SmsLogs newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SmsLogs query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SmsLogs whereError($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SmsLogs whereIdSms($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SmsLogs whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SmsLogs whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SmsLogs whereRecipient($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SmsLogs whereSentAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SmsLogs whereStatus($value)
 */
	class SmsLogs extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdState
 * @property string|null $NameEN
 * @property string|null $NameFR
 * @property string|null $NameAR
 * @property string|null $NameDE
 * @property string|null $NameES
 * @property string|null $NameCH
 * @property string|null $NameRU
 * @property string|null $CodeState
 * @property string|null $CityPostalCode
 * @property string|null $Flag
 * @property string|null $MAP
 * @property string|null $PhoneCode
 * @property string|null $CountriesName
 * @property int|null $IdCountry
 * @property int|null $Active
 * @property-read \App\Models\Countries|null $country
 * @method static \Illuminate\Database\Eloquent\Builder<static>|States newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|States newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|States query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|States whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|States whereCityPostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|States whereCodeState($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|States whereCountriesName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|States whereFlag($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|States whereIdCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|States whereIdState($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|States whereMAP($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|States whereNameAR($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|States whereNameCH($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|States whereNameDE($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|States whereNameEN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|States whereNameES($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|States whereNameFR($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|States whereNameRU($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|States wherePhoneCode($value)
 */
	class States extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int|null $IdUser
 * @property string|null $Tag
 * @property int|null $IdLangue
 * @property int|null $Active
 * @property-read \App\Models\Users|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tags newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tags newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tags query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tags whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tags whereIdLangue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tags whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tags whereTag($value)
 */
	class Tags extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdTransport
 * @property string $Name
 * @property string|null $Logo
 * @property string|null $Phone
 * @property string|null $Email
 * @property numeric|null $DeliveryFee
 * @property numeric|null $FreeFrom
 * @property string|null $Zones
 * @property int|null $Active
 * @property string|null $CreatedAt
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transports newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transports newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transports query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transports whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transports whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transports whereDeliveryFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transports whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transports whereFreeFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transports whereIdTransport($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transports whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transports whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transports wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transports whereZones($value)
 */
	class Transports extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $Idtypecat
 * @property string|null $Title
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeCategory whereIdtypecat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeCategory whereTitle($value)
 */
	class TypeCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdUser
 * @property string|null $Username
 * @property string|null $FirstName
 * @property string|null $LastName
 * @property string|null $BirthDate
 * @property string|null $Gender
 * @property string|null $Email
 * @property string|null $ICN
 * @property string|null $Telephone
 * @property string|null $Password
 * @property int|null $IdRole
 * @property string|null $FacebookId
 * @property string|null $GoogleId
 * @property string|null $RefreshToken
 * @property string|null $ProfilePicture
 * @property string|null $CreationDate
 * @property int|null $IsVerified
 * @property int|null $IsPremuim
 * @property string|null $PremiumExpiry
 * @property string|null $IdentityPicture
 * @property int|null $IsBusinessAccount
 * @property string|null $ICNBusiness
 * @property string|null $BusinessVerificationPicture
 * @property int|null $IdState
 * @property int|null $IdCountry
 * @property string|null $Location
 * @property string|null $LastConnection
 * @property int|null $Active
 * @property string|null $City
 * @property int|null $EmailConfirmed
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereBirthDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereBusinessVerificationPicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailConfirmed($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereFacebookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereGoogleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereICN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereICNBusiness($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereIdCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereIdRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereIdState($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereIdentityPicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereIsBusinessAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereIsPremuim($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereIsVerified($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereLastConnection($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePremiumExpiry($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereProfilePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRefreshToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereTelephone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUsername($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdFollow
 * @property int $IdUser
 * @property int $IdVendor
 * @property string|null $CreatedAt
 * @property-read \App\Models\Users|null $user
 * @property-read \App\Models\Users|null $vendor
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserFollows newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserFollows newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserFollows query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserFollows whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserFollows whereIdFollow($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserFollows whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserFollows whereIdVendor($value)
 */
	class UserFollows extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdUser
 * @property string|null $Username
 * @property string|null $FirstName
 * @property string|null $LastName
 * @property string|null $BirthDate
 * @property string|null $Gender
 * @property string|null $Email
 * @property string|null $ICN
 * @property string|null $Telephone
 * @property string|null $Password
 * @property int|null $IdRole
 * @property string|null $FacebookId
 * @property string|null $GoogleId
 * @property string|null $RefreshToken
 * @property string|null $ProfilePicture
 * @property string|null $CreationDate
 * @property int|null $IsVerified
 * @property int|null $IsPremuim
 * @property string|null $PremiumExpiry
 * @property string|null $IdentityPicture
 * @property int|null $IsBusinessAccount
 * @property string|null $ICNBusiness
 * @property string|null $BusinessVerificationPicture
 * @property int|null $IdState
 * @property int|null $IdCountry
 * @property string|null $Location
 * @property string|null $LastConnection
 * @property int|null $Active
 * @property string|null $City
 * @property int|null $EmailConfirmed
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Passport\Client> $clients
 * @property-read int|null $clients_count
 * @property-read \App\Models\Countries|null $country
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Passport\Client> $oauthApps
 * @property-read int|null $oauth_apps_count
 * @property-read \App\Models\Roles|null $role
 * @property-read \App\Models\States|null $state
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Passport\Token> $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Users newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Users newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Users query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Users whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Users whereBirthDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Users whereBusinessVerificationPicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Users whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Users whereCreationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Users whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Users whereEmailConfirmed($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Users whereFacebookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Users whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Users whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Users whereGoogleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Users whereICN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Users whereICNBusiness($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Users whereIdCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Users whereIdRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Users whereIdState($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Users whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Users whereIdentityPicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Users whereIsBusinessAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Users whereIsPremuim($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Users whereIsVerified($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Users whereLastConnection($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Users whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Users whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Users wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Users wherePremiumExpiry($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Users whereProfilePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Users whereRefreshToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Users whereTelephone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Users whereUsername($value)
 */
	class Users extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdWallet
 * @property int|null $IdUser
 * @property string|null $ICN
 * @property int|null $NbrJeton
 * @property numeric|null $MoneyBudget
 * @property numeric|null $MoneyBlocked
 * @property numeric|null $MoneyTransfered
 * @property int|null $Active
 * @property-read \App\Models\Users|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Wallets newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Wallets newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Wallets query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Wallets whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Wallets whereICN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Wallets whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Wallets whereIdWallet($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Wallets whereMoneyBlocked($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Wallets whereMoneyBudget($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Wallets whereMoneyTransfered($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Wallets whereNbrJeton($value)
 */
	class Wallets extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdWinner
 * @property int|null $IdPrize
 * @property int|null $IdUser
 * @property string|null $DateWin
 * @property-read \App\Models\Prizes|null $prize
 * @property-read \App\Models\Users|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Winners newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Winners newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Winners query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Winners whereDateWin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Winners whereIdPrize($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Winners whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Winners whereIdWinner($value)
 */
	class Winners extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdWish
 * @property int $IdUser
 * @property int $IdAd
 * @property string|null $CreatedAt
 * @property-read \App\Models\Ads|null $ad
 * @property-read \App\Models\Users|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WishlistAds newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WishlistAds newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WishlistAds query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WishlistAds whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WishlistAds whereIdAd($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WishlistAds whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WishlistAds whereIdWish($value)
 */
	class WishlistAds extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $IdWish
 * @property int $IdUser
 * @property int $IdDeal
 * @property string|null $CreatedAt
 * @property-read \App\Models\Deals|null $deal
 * @property-read \App\Models\Users|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WishlistDeals newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WishlistDeals newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WishlistDeals query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WishlistDeals whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WishlistDeals whereIdDeal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WishlistDeals whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WishlistDeals whereIdWish($value)
 */
	class WishlistDeals extends \Eloquent {}
}

