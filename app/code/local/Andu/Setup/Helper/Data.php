<?php
class Andu_Setup_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function fetchProductCoordinates($product)
    {
        if ($product->getAddressDisplay()) {
            $address = $product->getAddressDisplay();
        } else {
            $address = '';
            if ($product->getStreetLine1()) {
                $address .= $product->getStreetLine1() . ' ';
            }
            if ($product->getStreetLine2()) {
                $address .= $product->getStreetLine2() . ' ';
            }
            if ($product->getCity()) {
                $address .= $product->getCity() . ' ';
            }
            if ($product->getState()) {
                $address .= $product->getState() . ' ';
            }
            if ($product->getZipcode()) {
                $address .= $product->getZipcode() . ' ';
            }
        }
        $url = "https://maps.googleapis.com/maps/api/geocode/json?";
        $url .= 'address=' . urlencode(preg_replace('#\r|\n#', ' ', $address));
        $cinit = curl_init();
        curl_setopt($cinit, CURLOPT_URL, $url);
        curl_setopt($cinit, CURLOPT_HEADER, 0);
        curl_setopt($cinit, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]);
        curl_setopt($cinit, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($cinit);
        $result = json_decode($response);
        if ($result->status != 'OK') {
            return $product;
        }
        $candidates = $result->results;
        if (isset($candidates[0]) && $candidates[0]) {
            $location = $candidates[0]->geometry->location;
        }
        $product->setLatitude($location->lat)->setLongitude($location->lng);
        return $product;
    }

    public function fetchLocationCoordinates($location)
    {
        $url = "https://maps.googleapis.com/maps/api/geocode/json?";
        $url .= 'address=' . urlencode(preg_replace('#\r|\n#', ' ', $location));
        $cinit = curl_init();
        curl_setopt($cinit, CURLOPT_URL, $url);
        curl_setopt($cinit, CURLOPT_HEADER, 0);
        curl_setopt($cinit, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]);
        curl_setopt($cinit, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($cinit);
        $result = json_decode($response);
        if ($result->status != 'OK') {
            return null;
        }
        $candidates = $result->results;
        if (isset($candidates[0]) && $candidates[0]) {
            $loc = $candidates[0]->geometry->location;
        }
        return array(
            'lat'=>$loc->lat,
            'lng'=>$loc->lng
        );
    }
}
	 