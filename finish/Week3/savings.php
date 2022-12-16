<?php

include_once ("./account.php");
 
    class SavingsAccount extends Account 
    {

        public function withdrawal($amount) 
        {
            // write code here. Return true if withdrawal goes through; false otherwise
            parent::setBalance(parent::getBalance() - $amount);
            
        } //end withdrawal

        public function getAccountDetails() 
        {
            $accountDetails = "<h2>Savings Account</h2>";
            $accountDetails .= parent::getAccountDetails();
            
            return $accountDetails;
        }
        
    } // end Savings


    
?>
