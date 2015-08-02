<?php

include_once dirname(__FILE__) . '/../../../services/restaurants/domain/options/RestaurantsLocalFavoritesRequestOptions.php';
include_once dirname(__FILE__) . '/../../../services/restaurants/domain/restaurant/Address.php';
include_once dirname(__FILE__) . '/../../../services/restaurants/domain/countries/Country.php';
include_once dirname(__FILE__) . '/../../../services/restaurants/domain/country_subdivisions/CountrySubdivision.php';
include_once dirname(__FILE__) . '/../../../services/restaurants/domain/restaurant/Location.php';
include_once dirname(__FILE__) . '/../../../services/restaurants/domain/restaurant/Point.php';
include_once dirname(__FILE__) . '/../../../services/restaurants/domain/restaurant/Restaurants.php';
include_once dirname(__FILE__) . '/../../../services/restaurants/domain/restaurant/Restaurant.php';
include_once dirname(__FILE__) . '/../../../common/Connector.php';
include_once dirname(__FILE__) . '/../../../common/Environment.php';
include_once dirname(__FILE__) . '/../../../common/Serializer.php';
include_once dirname(__FILE__) . '/../../../common/URLUtil.php';

class RestaurantsLocalFavoritesService extends Connector{

    private $environment;

    private $SANDBOX_URL = 'https://sandbox.api.mastercard.com/restaurants/v1/restaurant?Format=XML';
    private $PRODUCTION_URL = 'https://api.mastercard.com/restaurants/v1/restaurant?Format=XML';

    public function __construct($consumerKey, $privateKey, $environment)
    {
        parent::__construct($consumerKey, $privateKey);
        $this->environment = $environment;
    }

    public function getRestaurants(RestaurantsLocalFavoritesRequestOptions $options)
    {
        $response = parent::doSimpleRequest($this->getURL($options),Connector::GET);
        $xml = simplexml_load_string($response);
        return $this->buildAtms($xml);
    }

    private function getURL(RestaurantsLocalFavoritesRequestOptions $options)
    {
        $url = "";
        if ($this->environment == Environment::PRODUCTION)
        {
            $url = $this->PRODUCTION_URL;
        }
        else
        {
            $url = $this->SANDBOX_URL;
        }

        $url = URLUtil::addQueryParameter($url, "PageLength", $options->getPageLength());
        $url = URLUtil::addQueryParameter($url, "PageOffset", $options->getPageOffset());
        $url = URLUtil::addQueryParameter($url, "AddressLine1", $options->getAddressLine1());
        $url = URLUtil::addQueryParameter($url, "AddressLine2", $options->getAddressLine2());
        $url = URLUtil::addQueryParameter($url, "City", $options->getCity());
        $url = URLUtil::addQueryParameter($url, "CountrySubdivision", $options->getCountrySubdivision());
        $url = URLUtil::addQueryParameter($url, "PostalCode", $options->getPostalCode());
        $url = URLUtil::addQueryParameter($url, "Country", $options->getCountry());
        $url = URLUtil::addQueryParameter($url, "Latitude", $options->getLatitude());
        $url = URLUtil::addQueryParameter($url, "Longitude", $options->getLongitude());
        $url = URLUtil::addQueryParameter($url, "DistanceUnit", $options->getDistanceUnit());
        $url = URLUtil::addQueryParameter($url, "Radius", $options->getRadius());
        return $url;
    }

    public function buildAtms($xml)
    {
        $pageOffset = (string)$xml->PageOffset;
        $totalCount = (string)$xml->TotalCount;

        $restaurantArray = array();
        foreach ($xml->Restaurant as $restaurant)
        {
            $tmpRestaurant = new Restaurant();
            $tmpRestaurant->setId((string)$restaurant->Id);
            $tmpRestaurant->setName((string)$restaurant->Name);
            $tmpRestaurant->setWebsiteUrl((string)$restaurant->WebsiteUrl);
            $tmpRestaurant->setPhoneNumber((string)$restaurant->PhoneNumber);
            $tmpRestaurant->setCategory((string)$restaurant->Category);
            $tmpRestaurant->setLocalFavoriteInd((string)$restaurant->LocalFavoriteInd);
            $tmpRestaurant->setHiddenGemInd((string)$restaurant->HiddenGemInd);

            $tmpLocation = new Location();
            $location = $restaurant->Location;
            $tmpLocation->setName((string)$location->Name);
            $tmpLocation->setDistance((string)$location->Distance);
            $tmpLocation->setDistanceUnit((string)$location->DistanceUnit);

            $tmpAddress = new Address();
            $address = $location->Address;
            $tmpAddress->setLine1((string)$address->Line1);
            $tmpAddress->setLine2((string)$address->Line2);
            $tmpAddress->setCity((string)$address->City);
            $tmpAddress->setPostalCode((string)$address->PostCode);

            $tmpCountry = new Country();
            $tmpCountry->setName((string)$address->Country->Name);
            $tmpCountry->setCode((string)$address->Country->Code);

            $tmpCountrySubdivision = new CountrySubdivision();
            $tmpCountrySubdivision->setName((string)$address->CountrySubdivision->Name);
            $tmpCountrySubdivision->setCode((string)$address->CountrySubdivision->Code);

            $tmpAddress->setCountry($tmpCountry);
            $tmpAddress->setCountrySubdivision($tmpCountrySubdivision);

            $tmpPoint = new Point();
            $point = $location->Point;
            $tmpPoint->setLatitude((string)$point->Latitude);
            $tmpPoint->setLongitude((string)$point->Longitude);

            $tmpLocation->setPoint($tmpPoint);
            $tmpLocation->setAddress($tmpAddress);
            $tmpRestaurant->setLocation($tmpLocation);
            array_push($restaurantArray, $tmpRestaurant);
        }
        $restaurants = new Restaurants($pageOffset, $totalCount, $restaurantArray);
        return $restaurants;
    }

} 