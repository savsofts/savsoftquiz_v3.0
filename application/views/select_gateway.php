 <div class="container">

  <div class="row">
    
<div class="col-md-8">
<br> 
 <div class="login-panel panel panel-default">
		<div class="panel-body"> 
	  	<img src="<?php echo base_url('images/logo.png');?>">
	
 <h3><?php echo $this->lang->line('select_payment_gateway');?></h3>
   
 <br>
  <?php 
  if($this->config->item('paypal')){
	  ?>
	<b><?php echo $this->lang->line('paypal');?>  </b><br>
 <?php echo $this->lang->line('price_');?>: <?php echo $this->config->item('paypal_currency_prefix');?> <?php echo $user['price']*$this->config->item('paypal_conversion');?> <?php echo $this->config->item('paypal_currency_sufix');?><br>




<form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="<?php echo $this->config->item('paypal_receiver');?>">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="item_name" value="<?php echo $this->lang->line('quiz_subscription');?>">
<input type="hidden" name="notify_url" value="<?php echo site_url('payment_gateway_2/paypal_ipn');?>">
<input type="hidden" name="custom" value="<?php echo $user['uid'].'-'.$user['gid'];?>">
<input type="hidden" name="return" value="<?php echo site_url('payment_gateway_2/success');?>">
<input type="hidden" name="cancel_return" value="<?php echo site_url('payment_gateway_2/cancel');?>">
<input type="hidden" name="amount" value="<?php echo $user['price']*$this->config->item('paypal_conversion');?>">
<input type="image" src="http://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
</form>


 <hr>
 
 <?php 
  }
   if($this->config->item('payumoney')){
	  ?>
	<b><?php echo $this->lang->line('payumoney');?>  </b><br>
 <?php echo $this->lang->line('price_');?>: <?php echo $this->config->item('payumoney_currency_prefix');?> <?php echo $user['price']*$this->config->item('payumoney_conversion');?> <?php echo $this->config->item('payumoney_currency_sufix');?><br>

 
 <?php
 $price=$user['price']*$this->config->item('payumoney_conversion');
 // Merchant key here as provided by Payu
$MERCHANT_KEY = $this->config->item('payu_merchant_key');

// Merchant Salt as provided by Payu
$SALT =  $this->config->item('payu_salt');
$txnid = $user['uid'];
$hash_string = $MERCHANT_KEY."|".$txnid."|".$price."|Quiz Credit|".$user['first_name']."|".$user['email']."|".$user['uid']."||||||||||".$SALT;
$hash = hash('sha512', $hash_string);
    //print_r( $hash_string);
	//echo"<br>";
	//print_r($hash);
?>
<form method="POST" action="https://secure.payu.in/_payment">

 <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY; ?>" />
      <input type="hidden" name="hash" value="<?php echo $hash; ?>"/>
      <input type="hidden" name="txnid" value="<?php echo $txnid; ?>" />
     
	 
	 
<?php echo $this->lang->line('update').' '.$this->lang->line('contact_no');?>  <input type="text" name="phone" value="<?php echo $user['contact_no'];?>" />
	<br><br><input type="hidden" name="amount" value="<?php echo $price;?>" />
	
	<input type="hidden" name="firstname" id="firstname" value="<?php echo $user['first_name'];?>" >
	<input type="hidden"  name="email" id="email" value="<?php echo $user['email'];?>"  />
	 <input type="hidden"  name="productinfo" value="<?php echo $this->lang->line('quiz_subscription');?>">
		  <input type="hidden"  name="surl" value="<?php echo site_url('payment_gateway_2/success/payu');?>" size="64" />
		  <input type="hidden"  name="furl" value="<?php echo site_url('payment_gateway_2/cancel');?>" size="64" />
		  <input type="hidden"   name="service_provider" value="payu_paisa" size="64" />
<input  type="hidden"  name="udf1" value="<?php echo $user['uid'].'-'.$user['gid'];?>">
 
 <input type="submit" value="<?php echo $this->lang->line('proceed_payment_gateway');?>" class="btn btn-success" >
</form>

 <hr>
 <?php 
  }
  ?>
 
 
</div> 

</div> 

</div> 

</div> 
 


</div> 