<?php
 
 	include_once ("./account.php");
 
    class CheckingAccount extends Account 
    {
        const OVERDRAW_LIMIT = -200;

        public function withdrawal($amount) 
        {
            // write code here. Return true if withdrawal goes through; false otherwise
            if (parent::getBalance() - $amount > self::OVERDRAW_LIMIT)
            {
                parent::setBalance(parent::getBalance() - $amount);
            }
        } // end withdrawal

        //freebie. I am giving you this code.
        public function getAccountDetails() 
        {
            $accountDetails = "<h2>Checking Account</h2>";
            $accountDetails .= parent::getAccountDetails();
            
            return $accountDetails;
        }
    }

    
?>
