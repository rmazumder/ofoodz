<?php
$MERCHANT_KEY = "5zjaVyAO";

$SALT = "aIKW0kL3YX";

// End point - change to https://secure.payu.in for LIVE mode
//$PAYU_BASE_URL = "https://test.payu.in";
//$MERCHANT_KEY = "JBZaLc";

// Merchant Salt as provided by Payu
//$SALT = "GQs7yium";

// End point - change to https://secure.payu.in for LIVE mode
$PAYU_BASE_URL = "https://test.payu.in";
$surl = "http://localhost/ofoodz/success.php";
$furl = "http://localhost/ofoodz/failure.php";
$amount = 200;
$action = '';
$firstname='Ruhul';
$email = 'ruhul.mazumder@gmail.com';
$productinfo = 'NonVeg meal';
$phone = "9940014026";

$formError = 0;


$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
$hash = '';
$data  = array("key"=>$MERCHANT_KEY, "txnid"=>$txnid, "amount"=>$amount, "firstname"=>$firstname, "email"=>$email, "phone"=>$phone, "productinfo"=>$productinfo, "surl"=>$surl, "furl"=>$furl, "service_provider"=>'payu_paisa');

// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";

    //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
	$hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';	
	foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($data[$hash_var]) ? $data[$hash_var] : '';
      $hash_string .= '|';
    }

    $hash_string .= $SALT;


    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';

?>
<html>
  <head>
  <script>
    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      if(hash == '') {
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
  </script>
  </head>
  <body onload="submitPayuForm()">
    <h2>PayU Form</h2>
    <br/>
    <?php if($formError) { ?>
	
      <span style="color:red">Please fill all mandatory fields.</span>
      <br/>
      <br/>
    <?php } ?>
    <form action="<?php echo $action; ?>" method="post" name="payuForm">
      <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
      <input type="hidden" name="hash" value="<?php echo $hash ?>"/>      
	  <input type="hidden" name="surl" value="<?php echo $surl ?>" />
	  <input type="hidden" name="furl" value="<?php echo $furl ?>" />
	  <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
	  <input type="hidden" name="amount" value="<?php echo $amount ?>" />
	  <input type="hidden" name="firstname" value="<?php echo $firstname ?>" />
	  <input type="hidden" name="email" value="<?php echo $email ?>" />
	  <input type="hidden" name="productinfo" value="<?php echo $productinfo ?>" />
	  <input type="hidden" name="phone" value="<?php echo $phone ?>" />
	  <input type="hidden" name="productinfo" value="<?php echo $productinfo ?>" />
	  <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
      <table>
       
        <tr>
          <?php if(!$hash) { ?>
            <td colspan="4"><input type="submit" value="Submit" /></td>
          <?php } ?>
        </tr>
      </table>
    </form>
  </body>
</html>
