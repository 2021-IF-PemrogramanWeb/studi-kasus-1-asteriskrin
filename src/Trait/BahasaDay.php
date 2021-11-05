<?php
    namespace Garnet\App\Traits;
    trait BahasaDay {
        public static function getDayName($day) {
            $res = '';
            switch($day){
                case 'Sun': $res = "Minggu"; break;
                case 'Mon': $res = "Senin"; break;
                case 'Tue': $res = "Selasa"; break;
                case 'Wed': $res = "Rabu"; break;
                case 'Thu': $res = "Kamis"; break;
                case 'Fri': $res = "Jumat"; break;
                case 'Sat': $res = "Sabtu"; break;
            }
            return $res;
        }
    }
?>