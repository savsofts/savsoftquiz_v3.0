<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_gateway_2 extends CI_Controller {

	 function __construct()
	 {
	   parent::__construct();
	   $this->load->database();
	   $this->load->model("user_model");
	   $this->load->model("payment_model");
	   $this->lang->load('basic', $this->config->item('language'));

	 }

	public function subscribe($gid='1',$uid='0')
	{
		
			
			
		$data['uid']=$uid;
		$data['title']=$this->lang->line('buy_subscription');
		// fetching payment_history
		$data['user']=$this->user_model->get_user($uid);

		$this->load->view('header',$data);
		$this->load->view('select_gateway',$data);
		$this->load->view('footer',$data);
	}
	
	
	
	
	
		public function cancel()
	{
		
		$data['title']=$this->lang->line('payment_cancel');
		 
		$this->load->view('header',$data);
		$this->load->view('cancel',$data);
		$this->load->view('footer',$data);
	}
	
	
	
	 public function success_message(){
		$data['title']=$this->lang->line('payment_completed');
	   $this->load->view('header',$data);
	   $this->load->view('payment_completed',$data);
		$this->load->view('footer',$data);
	}
 
 
	function success($pg='')
	 {
	 if($pg=="payu"){
		 if($_POST['status']=="success" && $_POST['key']==$this->config->item('payu_merchant_key')){
		 
		 $ud=explode('-',$_POST['udf1']);
		 $uid=$ud[0];
		 $gid=$ud[1];
		 $amount=$_POST['amount'];
		 $transaction_id=$_POST['transaction_id'];
		 


		$this->payment_model_2->activate_group($uid,$gid,$amount,$transaction_id,'Payumoney');
	redirect('payment_gateway_2/success_message');
		}
	 }else{
		 
			redirect('payment_gateway_2/success_message'); 
		 
	 }

	 }
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 function paypal_ipn(){
		 $paypalmode = '';  
		  if($_POST)
		{
				if($paypalmode=='sandbox')
				{
					$paypalmode     =   '.sandbox';
				}
				$req = 'cmd=' . urlencode('_notify-validate');
				foreach ($_POST as $key => $value) {
					$value = urlencode(stripslashes($value));
					$req .= "&$key=$value";
				}
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, 'https://www'.$paypalmode.'.paypal.com/cgi-bin/webscr');
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array('Host: www'.$paypalmode.'.sandbox.paypal.com'));
				$res = curl_exec($ch);
				curl_close($ch);

				if (strcmp ($res, "VERIFIED") == 0)
				{
					$transaction_id = $_POST['txn_id'];
					$payerid = $_POST['payer_id'];
					$firstname = $_POST['first_name'];
					$lastname = $_POST['last_name'];
					$payeremail = $_POST['payer_email'];
					$paymentdate = $_POST['payment_date'];
					$paymentstatus = $_POST['payment_status'];
					$amount   = $_POST['mc_gross'];
					$mdate= date('Y-m-d h:i:s',strtotime($paymentdate));
					$otherstuff = json_encode($_POST);
					$cd=$_POST['custom'];
					$uid=$cd[0];
					$gid=$cd[1];
					$fullname=$firstname.' '.$lastname;
		   $result = $this->payment_model_2->validate_transaction_id($transaction_id);
			
		if($result >= "1"){
		// it is duplicate id
		exit;
		}
				$this->payment_model_2->activate_group($uid,$gid,$amount,$transaction_id,'Paypal');

				}
		}



		 }

 
 
	
}
