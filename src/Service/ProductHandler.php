<?php

namespace App\Service;

class ProductHandler {

    public static function getTotalPrice($products){
        $totalPrice = 0;
        if(!$products){
            return $totalPrice;
        }
        foreach ($products as $product) {
            $price = $product['price'] ?: 0;
            $totalPrice += $price;
        }
        return $totalPrice;
    } // getTotalPrice()

    public static function getDesertAndSortDesByPrice($products){
        if(!$products){
            return 0;
        }
        return self::_sortDesByPrice('dessert', $products);
    } // getDesertAndSortDesByPrice()

    private static function _sortDesByPrice($productType, $products){
        if(!$products){
            return 0;
        }
        $ret = array();
        foreach($products as $item){
            if($productType !== strtolower($item['type'])){
                continue;
            }
            $ret[] = $item;
        }
        usort($ret, array('self', '_cmpDes'));
        return $ret;
    } // _sortDesByPrice()

    private static function _cmpDes($a, $b){
        if($a['price'] == $b['price']){
            return 0;
        }
        return ($a['price'] > $b['price']) ? -1 : 1;
    } // _cmpDes()

    public static function date2Timestamp($products){
        $k = 'create_at';
        $ret = array();
        foreach($products as $item){
            $item[$k] = strtotime($item[$k]);
            $ret[] = $item;
        }
        return $ret;
    } // date2Timestamp()
}
