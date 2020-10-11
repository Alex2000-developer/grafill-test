<?php 
    namespace App\Service;

    class CasualNumberGenerator
    {
        
        public function getCasualNumber(){
            return random_int(1, 1000);
        }
    }
?>