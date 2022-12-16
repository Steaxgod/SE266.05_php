

<?php
    include_once ("./checking.php");
    include_once ("./savings.php");
    
    $checking = new CheckingAccount('C123', 1000, '12-20-2019');
    $savings = new SavingsAccount('S123', 5000, '03-20-2020');
    if (isset($_POST["checkingAccountId"]))
    {
        $checking = new CheckingAccount($_POST["checkingAccountId"], $_POST["checkingBalance"], $_POST["checkingDate"]);
    }
    if (isset($_POST["savingsAccountId"]))
    {
        $savings = new SavingsAccount($_POST["savingsAccountId"], $_POST["savingsBalance"], $_POST["savingsDate"]);
    }
    if (isset ($_POST['withdrawChecking'])) 
    {
        $checking->withdrawal($_POST["checkingWithdrawAmount"]);
        //echo "I pressed the checking withdrawal button";
    } 
    else if (isset ($_POST['depositChecking'])) 
    {
        $checking->deposit($_POST["checkingDepositAmount"]);
        
        
        //echo "I pressed the checking deposit button";
    } 
    else if (isset ($_POST['withdrawSavings'])) 
    {
        $savings->withdrawal($_POST["savingsWithdrawAmount"]);
        
        
        //echo "I pressed the savings withdrawal button";
    } 
    else if (isset ($_POST['depositSavings'])) 
    {
        $savings->deposit($_POST["savingsDepositAmount"]);
        
        
        //echo "I pressed the savings deposit button";
    } 
     
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATM</title>
    <style type="text/css">
        body {
            margin-left: 120px;
            margin-top: 50px;
        }
       .wrapper {
            display: grid;
            grid-template-columns: 300px 300px;
        }
        .account {
            border: 1px solid black;
            padding: 10px;
        }
        .label {
            text-align: right;
            padding-right: 10px;
            margin-bottom: 5px;
        }
        label {
           font-weight: bold;
        }
        input[type=text] {width: 80px;}
        .error {color: red;}
        .accountInner {
            margin-left:10px;margin-top:10px;
        }
    </style>
</head>
<body>

    <form method="post">
       
        <input type="hidden" name="checkingAccountId" value="C123" />
        <input type="hidden" name="checkingDate" value="12-20-2019" />
        <input type="hidden" name="checkingBalance" value=<?php echo $checking->getBalance()?> />
        <input type="hidden" name="savingsAccountId" value="S123" />
        <input type="hidden" name="savingsDate" value="03-20-2020" />
        <input type="hidden" name="savingsBalance" value=<?php echo $savings->getBalance()?> />
        
    <h1>ATM</h1>
        <div class="wrapper">
            
            <div class="account">
                    <ul>
                        <?php echo $checking->getAccountDetails() ?>
                    </ul>
                    
                    <div class="accountInner">
                        <input type="text" name="checkingWithdrawAmount" value=""/>
                        <input type="submit" name="withdrawChecking" value="Withdraw" />
                    </div>
                    <div class="accountInner">
                        <input type="text" name="checkingDepositAmount" value="" />
                        <input type="submit" name="depositChecking" value="Deposit" /><br />
                    </div>
            
            </div>

            <div class="account">
                
                    <ul>
                        <?php echo $savings->getAccountDetails() ?>
                    </ul>
                    
                    <div class="accountInner">
                        <input type="text" name="savingsWithdrawAmount" value="" />
                        <input type="submit" name="withdrawSavings" value="Withdraw" />
                    </div>
                    <div class="accountInner">
                        <input type="text" name="savingsDepositAmount" value="" />
                        <input type="submit" name="depositSavings" value="Deposit" /><br />
                    </div>
            
            </div>
            
        </div>
    </form>
</body>
</html>
