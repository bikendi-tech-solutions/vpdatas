<?php
/**
*Plugin Name: VP Data Cards
*Plugin URI: http://vtupress.com
*Description: Add Data Card Printing Business To Your Website
*Version: 1.1.6
*Author: Akor Victor
*Author URI: https://facebook.com/akor.victor.39
*/
//VP CARDS is just an addon for vtupress and a plugin for wordpress to add Data data printing business to wordpress via vtupress plugin as a addon to iterator_apply
#HELLO
if(!defined('ABSPATH')){
    $pagePath = explode('/wp-content/', dirname(__FILE__));
    include_once(str_replace('wp-content/' , '', $pagePath[0] . '/wp-load.php'));
};
if(WP_DEBUG == false){
error_reporting(0);	
}
include_once(ABSPATH."wp-load.php");
include_once(ABSPATH.'wp-admin/includes/plugin.php');
require_once(ABSPATH.'wp-admin/includes/upgrade.php');
$path = WP_PLUGIN_DIR.'/vtupress/functions.php';

if(file_exists($path) && in_array('vtupress/vtupress.php', apply_filters('active_plugins', get_option('active_plugins')))){
include_once(ABSPATH .'wp-content/plugins/vtupress/functions.php');
}
else{
	if(!function_exists("vp_updateuser")){
function vp_updateuser(){
	
}

function vp_getuser(){
	
}

function vp_adduser(){
	
}

function vp_updateoption(){
	
}

function vp_getoption(){
	
}

function vp_option_array(){
	
}

function vp_user_array(){
	
}

function vp_deleteuser(){
	
}

function vp_addoption(){
	
}

	}

}


require __DIR__.'/plugin-update-checker/plugin-update-checker.php';
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$myUpdateChecker = PucFactory::buildUpdateChecker(
	'https://github.com/bikendi-tech-solutions/vpdatas/',
	__FILE__,
	'vpdatas'
);
//Set the branch that contains the stable release.
$myUpdateChecker->setBranch('main');

$myUpdateChecker->setAuthentication('your-token-here');

$myUpdateChecker->getVcsApi()->enableReleaseAssets();



add_action("vtupress_history_condition","adddatasservices");
function adddatasservices(){
  $bill = false;
  if($bill){

  }
  elseif($_GET["subpage"] == "datacard" && $_GET["type"] == "successful"){
    include_once(ABSPATH .'wp-content/plugins/vpdatas/pages/sdata.php');
  }
  elseif($_GET["subpage"] == "datacard" && $_GET["type"] == "unsuccessful"){
    include_once(ABSPATH .'wp-content/plugins/vpdatas/pages/fdata.php');
  }
}


add_action("vtupress_gateway_tab","vpdatatab");
function vpdatatab(){
$tab = false;
if($tab){

}elseif($_GET["subpage"] == "datacard"){
    include_once(ABSPATH .'wp-content/plugins/vpdatas/pages/vpdatas.php');
}

}

add_action("vtupress_gateway_submenu","vpdatasubmenu");
function vpdatasubmenu(){
?>
  <li class="sidebar-item">
                    <a href="?page=vtupanel&adminpage=gateway&subpage=datacard" class="sidebar-link"
                      ><i class="fas fa-hashtag"></i
                      ><span class="hide-menu">Data Card</span></a
                    >
  </li>
<?php
}

add_action("vtupress_import_submenu","vpdatasubmenuimp");
function vpdatasubmenuimp(){
?>
  <li class="sidebar-item">
                    <a href="?page=vtupanel&adminpage=import&subpage=datacard" class="sidebar-link"
                      ><i class="fas fa-hashtag"></i
                      ><span class="hide-menu">Data Card</span></a
                    >
  </li>
<?php
}

add_action("vtupress_admin_list_import","vpdataslistimport");
function vpdataslistimport(){

if($_GET["subpage"] == "datacard"){
	include_once(ABSPATH .'wp-content/plugins/vpdatas/formats/loader.php');
}
}


add_action("vtupress_history_submenu","adddatasubmenu");
function adddatasubmenu(){
?>
<li class="sidebar-item bg bg-success">   
                  <a
                  class="sidebar-link has-arrow waves-effect waves-dark"
                  href="javascript:void(0)"
                  aria-expanded="false"
                  ><i class="fas fa-hashtag"></i
                  ><span class="hide-menu">Data Pins</span></a
                >
                <ul aria-expanded="false" class="collapse first-level">
                   <li class="sidebar-item">
                      <a href="?page=vtupanel&adminpage=history&subpage=datacard&type=successful" class="sidebar-link"
                      ><i class="far fa-check-circle"></i
                      ><span class="hide-menu">Successful</span></a
                    >
                  </li>
                  <li class="sidebar-item">
                      <a href="?page=vtupanel&adminpage=history&subpage=datacard&type=unsuccessful" class="sidebar-link"
                      ><i class="fas fa-ban"></i
                      ><span class="hide-menu">Failed</span></a
                    >
                  </li>
</ul> 
</li>
<?php
}




add_action("user_feature","datas_user_feature");
add_action("template_user_feature","datas_template_user_feature");
add_action("set_control","datas_set_control");
add_action("set_control_post","datas_set_control_post");


vp_addoption("datacard_select","");
vp_addoption("datacard_baseurl","");
vp_addoption("datacard_format","");
vp_addoption("datacard_quantities","");
vp_addoption("datacard_plans","");
vp_addoption("datacard_apikey","");




function create_datas(){

global $wpdb;
$table_name = $wpdb->prefix.'vpdatas';
$charset_collate=$wpdb->get_charset_collate();
$sql= "CREATE TABLE IF NOT EXISTS $table_name(
id int NOT NULL AUTO_INCREMENT,
network text,
plan text,
value text,
volume text,
pin text,
type text,
status text,
the_time text,
load_ussd text,
check_ussd text,
via text,
used_by text,
PRIMARY KEY (id))$charset_collate;";
require_once(ABSPATH.'wp-admin/includes/upgrade.php');
dbDelta($sql);

maybe_add_column($table_name,"used_by", "ALTER TABLE $table_name ADD used_by text");
maybe_add_column($table_name,"check_ussd", "ALTER TABLE $table_name ADD check_ussd text");
maybe_add_column($table_name,"load_ussd", "ALTER TABLE $table_name ADD load_ussd text");

}

function create_datas_transaction(){

global $wpdb;
$table_name = $wpdb->prefix.'sdatacard';
$charset_collate=$wpdb->get_charset_collate();
$sql= "CREATE TABLE IF NOT EXISTS $table_name(
id int NOT NULL AUTO_INCREMENT,
name text,
email text,
type text,
value text,
pin text,
quantity text,
bal_bf text,
bal_nw text,
amount text,
user_id int,
the_time text,
status text,
network text,
load_ussd text,
check_ussd text,
volume text,
via text,
plan text,
PRIMARY KEY (id))$charset_collate;";
require_once(ABSPATH.'wp-admin/includes/upgrade.php');
dbDelta($sql);


maybe_add_column($table_name,"check_ussd", "ALTER TABLE $table_name ADD check_ussd text");
maybe_add_column($table_name,"load_ussd", "ALTER TABLE $table_name ADD load_ussd text");
}








function datas_gateway_tab(){
	

	




}





function datas_template_user_feature(){
	if(isset($_GET["vend"]) && $_GET["vend"]=="datacard" && vp_getoption("datascontrol") == "checked" && vp_getoption("resell") == "yes"){
		$id = get_current_user_id();
		$option_array = json_decode(get_option("vp_options"),true);
		$user_array = json_decode(get_user_meta($id,"vp_user_data",true),true);
		$data = get_userdata($id);
		
		$bal = vp_getuser($id, 'vp_bal', true);
		
		$plan = vp_getuser($id,'vr_plan',true);
	global $level;
	global $wpdb;
	$table_name = $wpdb->prefix."vpdatas";
	$dnetwork_result = $wpdb->get_results("SELECT * FROM $table_name WHERE status = 'unused' GROUP BY network");
	$dplan_result = $wpdb->get_results("SELECT * FROM $table_name WHERE status = 'unused' GROUP BY network, plan, value");
	?>
			<div id="container">
	
	
			<style>
			.user-vends{
				border: 1px solid grey;
				border-radius: 5px;
				padding: 1rem !important;
			}
			</style>
	
			
			<div id="side-datas-w" class="pt-4 px-3">
	
			<div class="user-vends">
	<form class="for" id="cfor" method="post" <?php echo apply_filters('formaction','target="_self"');?>>
	
			 <div class="visually-hidden">
					<input type="hidden" name="vpname" class="form-control datas-name" placeholder="Name" aria-label="Name" aria-describedby="basic-addon1" value="<?php echo $data->user_login; ?>">
				</div>
				<div class="visually-hidden">
					<input type="hidden" name="vpemail" class="form-control datas-email" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" value="<?php echo $data->user_email; ?>">
				</div>
				<div class="visually-hidden">		
					<input type="hidden" id="tcode" name="tcode" value="cdatas">
					<input type="hidden" id="url" name="url">
					<input type="hidden" id="uniqidvalue" name="uniqidvalue" value="<?php echo uniqid('VTU-',false);?>">
					<input type="hidden" id="url1" name="url1" value="<?php echo esc_url(plugins_url("vtupress/process.php"));?>">
					<input type="hidden" id="id" name="id" value="<?php echo uniqid('VTU-',false);?>">
				</div>
	
	<div class="input-group mb-2 ">
	<span class="input-group-text">NETWORK</span>
	<select name="network" class="form-control form-select network" onchange="show_plan()">
	<option value="none">---Select---</option>
<?php
foreach($dnetwork_result as $this_result){
?>
<option value="<?php echo trim(strtolower($this_result->network));?>"><?php echo strtoupper(trim($this_result->network));?></option>
<?php
}
?>
	</select>
	 <div id="validationServer04Feedback" class="invalid-feedback">
						  Error: <span class="datas-network-message"></span>
							</div>
	</div>

	<div class="input-group mb-2">
	<span class="input-group-text">PLANS:</span>
	<select name="plan" class="form-control form-select plan" onchange="change_plan()">	
	<option value="none">---Select---</option>
<?php
foreach($dplan_result as $plan_result){
	?>
<option plan="<?php echo trim($plan_result->plan);?>" amount="<?php echo trim($plan_result->value);?>" volume="<?php echo trim($plan_result->volume);?>" class="<?php echo trim(strtolower($plan_result->network));?> general-network" network="<?php echo trim($plan_result->network);?>" ><?php echo strtoupper(trim($plan_result->network));?> <?php echo trim($plan_result->plan);?><?php echo strtoupper(trim($plan_result->volume));?> [NGN <?php echo trim($plan_result->value);?>]</option>
	<?php
}
?>
	</select>
	 <div id="validationServer04Feedback" class="invalid-feedback">
						  Error: <span class="datas-plan-error-message"></span>
							</div>
	</div>
	<br>


	<div class="input-group mb-2">
	<span class="input-group-text">Quantity</span>
	<select name="edunumber" class="form-control form-select edunumber quantity" onchange="change_quantity()">
	<option value="1">---Select---</option>
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	<option value="5">5</option>
	<option value="10">10</option>
	</select>
	 <div id="validationServer04Feedback" class="invalid-feedback">
						  Error: <span class="datas-quantity-error-message"></span>
							</div>
	</div>
	
	 <div class="input-group mb-2">
						<span class="input-group-text" id="basic-addon1">NGN.</span>
						<input id="amt" name="amount" type="number" class="form-control datas-amount" disabled max="<?php echo $bal;?>" placeholder="Amount" aria-label="Username" aria-describedby="basic-addon1" readonly required>
						<span class="input-group-text" id="basic-addon1">.00</span>
						<div id="validationServer04Feedback" class="invalid-feedback">
						  Error: <span class="datas-amount-error-message"></span>
						  </div>
	 </div>
	   <div class="vstack gap-2">
						<button type="button" class="btn w-full p-2 text-xs font-bold text-white uppercase bg-indigo-600 rounded shadow   purchase-datas" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">PRINT</button>
	  </div>	
				
	</form>
	</div>
		  <!--The Modal-->
				<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
					  <div class="modal-content">
						<div class="modal-header">
						  <h5 class="modal-title" id="exampleModalLabel">Data Card Purchase Confirmation</h5>
						  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
						<div>
						Network : <span class="datas-network-confirm"></span><br>
						Quantity : <span class="datas-quantity-confirm"></span><br>
						Amount : ₦<span class="datas-amount-confirm"></span><br>
						Status : <span class="datas-status-confirm"></span><br>
						<div class="input-group form">
						<span class="input-group-text">PIN</span>
						<input class="form-control pin" type="number" name="pin">
						</div>
						</div>
						</div>
						<div class="modal-footer">
						  <button type="button" class="p-2 text-xs font-bold text-white uppercase bg-gray-600 rounded shadow  data-proceed-cancled btn-danger" data-bs-dismiss="modal">Cancel</button>
						  <button type="button" name="wallet" id="wallet" class="p-2 text-xs font-bold text-white uppercase bg-indigo-600 rounded shadow datas-proceed btn-success" form="cfor">Proceed</button>
						</div>
					  </div>
					</div>
				</div>
			
			
			</div>
			
			<script>
	jQuery(".general-network").hide();		
		function show_plan(){
		var network = jQuery(".network").val();
		jQuery(".general-network").hide();
		jQuery("."+network).show();
		}

		function change_plan(){
		var plan = jQuery(".plan");
		var price = plan.find(':selected').attr('amount');
		jQuery(".datas-amount").val(price);
		jQuery(".datas-amount-confirm").text(price);

		}

		function change_quantity(){
	   var plan = jQuery(".plan");
	   var quantity = jQuery(".quantity").val();
	   var price = plan.find(':selected').attr('amount');
   	  // var price = plan.find(':selected').attr('amount')*quantity;

   		var str = price;
			var edunumber = jQuery(".quantity").val();
			var cards = jQuery(".network").val();
			var numbers;
			var price;
			var discount;
			switch(cards){
				case"glo":
				
				price = parseFloat(str - ((<?php

				$s = (floatval($level[0]->data_glo));
				echo $s;

				?>*str)/100) )* edunumber;
				
				jQuery(".datas-amount").val(price);
				jQuery(".datas-amount-confirm").text(price);
				break;
				case "airtel":
				
				price = parseFloat(str - ((<?php

				$s = (floatval($level[0]->data_airtel));
				echo $s;

				?>*str)/100) ) * edunumber;
				
				jQuery(".datas-amount").val(price);
				jQuery(".datas-amount-confirm").text(price);
				break;
				case "mtn":
				
				price = parseFloat(str - ((<?php

				$s = (floatval($level[0]->data_mtn));
				echo $s;

				?>*str)/100) ) * edunumber;
			
				jQuery(".datas-amount").val(price);
				jQuery(".datas-amount-confirm").text(price);
				break;
				case "9mobile":
					
				price = parseFloat(str - ((<?php

				$s = (floatval($level[0]->data_9mobile));
				echo $s;

				?>*str)/100) ) * edunumber;
			
				jQuery(".datas-amount").val(price);
				jQuery(".datas-amount-confirm").text(price);
				break;
			}

			var total_amount = price;

   jQuery(".datas-amount").val(price);
   jQuery(".datas-amount-confirm").text(price);
   }
			
	
	jQuery(".purchase-datas").click(function(){
		change_plan();
		change_quantity();
		var total_amount = 	jQuery(".datas-amount").val();
				
				jQuery(".datas-network-confirm").text(jQuery(".network").val());
				jQuery(".datas-quantity-confirm").text(jQuery(".edunumber").val());
	
				
	if( jQuery(".network").val() == "none" ){
					jQuery(".network").addClass("is-invalid");
					jQuery(".network").removeClass("is-valid");
					jQuery(".datas-network-message").text("Please Select One");
					jQuery(".datas-proceed").hide();
					jQuery(".datas-status-confirm").text("Please Select One Network");
	}
	else if( jQuery(".quantity").val() == "none"){
					jQuery(".quantity").addClass("is-invalid");
					jQuery(".quantity").removeClass("is-valid");
					jQuery(".datas-quantity-error-message").text("Please Select One");
					jQuery(".datas-proceed").hide();
					jQuery(".datas-quantity-confirm").text("Please Select One Network");
	}
	else if( jQuery(".plan").val() == "none"){
					jQuery(".plan").addClass("is-invalid");
					jQuery(".plan").removeClass("is-valid");
					jQuery(".datas-plan-error-message").text("Please Select One");
					jQuery(".datas-proceed").hide();
					jQuery(".datas-plan-confirm").text("Please Select One Network");
	}
	else{
		
					
				if(total_amount <= <?php echo $bal;?> && total_amount > 0){
				jQuery(".datas-proceed").show();
					jQuery(".datas-amount").removeClass("is-invalid");
					jQuery(".datas-amount").addClass("is-valid");
					jQuery(".datas-status-confirm").text("Correct");
	jQuery(".datas-proceed").show();
	jQuery(".network").addClass("is-valid");
	jQuery(".network").removeClass("is-invalid");
	jQuery(".datas-status-confirm").text("Correct");
				}
				else if(total_amount > <?php echo $bal;?> || total_amount <= 0){
				jQuery(".datas-status-confirm").text("Balance Too Low");
				jQuery(".datas-proceed").hide();
				jQuery(".datas-amount").addClass("is-invalid");
				jQuery(".datas-amount-error-message").text("Balance Too Low");
				}
		
	
	}	
			
		
			});
			
			
			
					
	jQuery(".datas-proceed").click(function(){
		
		change_plan();
		change_quantity();

		jQuery('.btn-close').trigger('click');
		jQuery.LoadingOverlay("show");
		
	var obj = {};
	obj["vend"] = "vend";
	obj["network"] = jQuery(".network").val();
	obj["plan"] = jQuery(".plan").find(':selected').attr('plan');
	obj["volume"] = jQuery(".plan").find(':selected').attr('volume');
	obj["uniqidvalue"] = jQuery("#uniqidvalue").val();
	obj["quantity"] = jQuery(".quantity").val();
	obj["pin"] = jQuery(".pin").val();
	obj["amount"] = jQuery(".datas-amount").val();
	obj["value"] = obj["network"]+" "+obj["plan"]+obj["volume"];
	
	
	jQuery.ajax({
	  url: '<?php echo esc_url(plugins_url("vpdatas/index.php"));?>',
	  data: obj,
	  dataType: 'json',
	  'cache': false,
	  "async": true,
	  error: function (jqXHR, exception) {
		  jQuery.LoadingOverlay("hide");
			var msg = "";
			if (jqXHR.status === 0) {
				msg = "No Connection.\n Verify Network.";
		 swal({
	  title: "Error!",
	  text: msg,
	  icon: "error",
	  button: "Okay",
	});
	  
			} else if (jqXHR.status == 404) {
				msg = "Requested page not found. [404]";
				 swal({
	  title: "Error!",
	  text: msg,
	  icon: "error",
	  button: "Okay",
	});
			} else if (jqXHR.status == 500) {
				msg = "Internal Server Error [500].";
				 swal({
	  title:  msg ,
	  text:  jqXHR.responseText,
	  icon: "error",
	  button: "Okay",
	});
			} else if (exception === "parsererror") {
				msg = jqXHR.responseText;
				   swal({
	  title: "Error",
	  text: msg,
	  icon: "error",
	  button: "Okay",
	});
			} else if (exception === "timeout") {
				msg = "Time out error.";
				 swal({
	  title: "Error!",
	  text: msg,
	  icon: "error",
	  button: "Okay",
	});
			} else if (exception === "abort") {
				msg = "Ajax request aborted.";
				 swal({
	  title: "Error!",
	  text: msg,
	  icon: "error",
	  button: "Okay",
	});
			} else {
				msg = "Uncaught Error.\n" + jqXHR.responseText;
				 swal({
	  title: "Error!",
	  text: msg,
	  icon: "error",
	  button: "Okay",
	});
			}
		},
	  
	  success: function(data) {
		jQuery.LoadingOverlay("hide");
			 if(data.code == "100"){
			var val = data.pin;
			var result = val.includes("-");
			if(result === true){
				var split = val.split("-");
				var pin = split[0];
				var ser = split[1];
			  swal({
	  title: "PIN: ["+pin+"]",
	  text: "SERIAL NO: ["+ser+"]",
	  icon: "success",
	  button: "Okay",
	}).then((value) => {
		location.reload();
	});
			}
			else{
		swal({
	  title: "PIN ["+data.pin+"]",
	  text: "Thanks For Your Patronage",
	  icon: "success",
	  button: "Okay",
	}).then((value) => {
		location.reload();
	});	
			}
		  }
		  else{
		swal(data.message, {
		  icon: "error",
		}); 
		  }
	  },
	  type: 'POST'
	});
	
	});
			
			
			
			</script>
			
	</div>
			
			
			<?php
			
	
			}
	}





function datas_user_feature(){
if(isset($_GET["vend"]) && $_GET["vend"]=="datacard" && vp_getoption("datascontrol") == "checked" && vp_getoption("resell") == "yes"){
$id = get_current_user_id();
$option_array = json_decode(get_option("vp_options"),true);
$user_array = json_decode(get_user_meta($id,"vp_user_data",true),true);
$data = get_userdata($id);

$bal = vp_getuser($id, 'vp_bal', true);

$plan = vp_getuser($id,'vr_plan',true);

global $wpdb;
$table_name = $wpdb->prefix."vpdatas";
$dnetwork_result = $wpdb->get_results("SELECT * FROM $table_name WHERE status = 'unused' GROUP BY network");
$dplan_result = $wpdb->get_results("SELECT * FROM $table_name WHERE status = 'unused' GROUP BY network, plan, value");
		
		?>
		<div id="dashboard-main-content">
<section class="container mx-auto">
<div class="p-md-5 p-1">
<div class="bg-white shadow">
<div class="dark-white flex items-center justify-between p-5 bg-gray-100">
<h1 class="text-xl font-bold">
<span class="lg:inline">Data Cards</span>
</h1>
<div class="font-bold tracking-wider">
<span class="dark inline-block px-3 py-1 bg-gray-200 border rounded-lg cursor-pointer" x-text="`NGN ${$format(total_sum)}`">NGN<?php echo $bal;?></span>
</div>
</div>
<div class="p-2 bg-white lg:p-5">
<template x-for="transaction in transactions"></template>


		<style>
		.user-vends{
			border: 1px solid grey;
			border-radius: 5px;
			padding: 1rem !important;
		}
		</style>

		
		<div id="side-datas-w">
<div class="mb-2 row" style="height:fit-content;">
       <span style="float:left;" class="col"> Wallet: ₦<?php echo $bal;
	   
	   global $level;
	   ?></span>
<span style="float:right;" class="col"><a href="?vend=wallet" style="text-decoration:none; float:right;" class="btn-primary btn-sm">Fund Wallet</a></span>

</div>


		<div class="user-vends">
		<form class="for" id="cfor" method="post" <?php echo apply_filters('formaction','target="_self"');?>>
	
		<div class="visually-hidden">
			   <input type="hidden" name="vpname" class="form-control datas-name" placeholder="Name" aria-label="Name" aria-describedby="basic-addon1" value="<?php echo $data->user_login; ?>">
		   </div>
		   <div class="visually-hidden">
			   <input type="hidden" name="vpemail" class="form-control datas-email" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" value="<?php echo $data->user_email; ?>">
		   </div>
		   <div class="visually-hidden">		
			   <input type="hidden" id="tcode" name="tcode" value="cdatas">
			   <input type="hidden" id="url" name="url">
			   <input type="hidden" id="uniqidvalue" name="uniqidvalue" value="<?php echo uniqid('VTU-',false);?>">
			   <input type="hidden" id="url1" name="url1" value="<?php echo esc_url(plugins_url("vtupress/process.php"));?>">
			   <input type="hidden" id="id" name="id" value="<?php echo uniqid('VTU-',false);?>">
		   </div>

<div class="input-group mb-2 ">
<span class="input-group-text">NETWORK</span>
<select name="network" class="form-control form-select network" onchange="show_plan()">
<option value="none">---Select---</option>
<?php
foreach($dnetwork_result as $this_result){
?>
<option value="<?php echo trim(strtolower($this_result->network));?>"><?php echo strtoupper(trim($this_result->network));?></option>
<?php
}
?>
</select>
<div id="validationServer04Feedback" class="invalid-feedback">
					 Error: <span class="datas-network-message"></span>
					   </div>
</div>

<div class="input-group mb-2">
<span class="input-group-text">PLANS:</span>
<select name="plan" class="form-control form-select plan" onchange="change_plan()">	
<option value="none">---Select---</option>
<?php
foreach($dplan_result as $plan_result){
?>
<option plan="<?php echo trim($plan_result->plan);?>" amount="<?php echo trim($plan_result->value);?>" volume="<?php echo trim($plan_result->volume);?>" class="<?php echo trim(strtolower($plan_result->network));?> general-network" network="<?php echo trim($plan_result->network);?>" ><?php echo strtoupper(trim($plan_result->network));?> <?php echo trim($plan_result->plan);?><?php echo strtoupper(trim($plan_result->volume));?> [NGN <?php echo trim($plan_result->value);?>]</option>
<?php
}
?>
</select>
<div id="validationServer04Feedback" class="invalid-feedback">
					 Error: <span class="datas-plan-error-message"></span>
					   </div>
</div>
<br>


<div class="input-group mb-2">
<span class="input-group-text">Quantity</span>
<select name="edunumber" class="form-control form-select edunumber quantity" onchange="change_quantity()">
<option value="1">---Select---</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="10">10</option>
</select>
<div id="validationServer04Feedback" class="invalid-feedback">
					 Error: <span class="datas-quantity-error-message"></span>
					   </div>
</div>

<div class="input-group mb-2">
				   <span class="input-group-text" id="basic-addon1">NGN.</span>
				   <input id="amt" name="amount" type="number" class="form-control datas-amount" disabled max="<?php echo $bal;?>" placeholder="Amount" aria-label="Username" aria-describedby="basic-addon1" readonly required>
				   <span class="input-group-text" id="basic-addon1">.00</span>
				   <div id="validationServer04Feedback" class="invalid-feedback">
					 Error: <span class="datas-amount-error-message"></span>
					 </div>
</div>
  <div class="vstack gap-2">
				   <button type="button" class="btn w-full p-2 text-xs font-bold text-white uppercase bg-indigo-600 rounded shadow   purchase-datas" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">PRINT</button>
 </div>	
		   
</form>
</div>
	 <!--The Modal-->
		   <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			   <div class="modal-dialog">
				 <div class="modal-content">
				   <div class="modal-header">
					 <h5 class="modal-title" id="exampleModalLabel">Data Card Purchase Confirmation</h5>
					 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				   </div>
				   <div class="modal-body">
				   <div>
				   Network : <span class="datas-network-confirm"></span><br>
				   Quantity : <span class="datas-quantity-confirm"></span><br>
				   Amount : ₦<span class="datas-amount-confirm"></span><br>
				   Status : <span class="datas-status-confirm"></span><br>
				   <div class="input-group form">
				   <span class="input-group-text">PIN</span>
				   <input class="form-control pin" type="number" name="pin">
				   </div>
				   </div>
				   </div>
				   <div class="modal-footer">
					 <button type="button" class="p-2 btn text-xs font-bold text-dark uppercase bg-gray-600 rounded shadow  data-proceed-cancled btn-danger" data-bs-dismiss="modal">Cancel</button>
					 <button type="button" name="wallet" id="wallet" class="p-2 text-xs font-bold text-white uppercase bg-indigo-600 rounded shadow datas-proceed btn-success" form="cfor">Proceed</button>
				   </div>
				 </div>
			   </div>
		   </div>
	   
	   
	   </div>
	   
	   <script>


jQuery(".general-network").hide();		
   function show_plan(){
   var network = jQuery(".network").val();
   jQuery(".general-network").hide();
   jQuery("."+network).show();
   }

   function change_plan(){
   var plan = jQuery(".plan");
   var price = plan.find(':selected').attr('amount');
   var network = jQuery(".network").val();
   jQuery(".datas-amount").val(price);
   jQuery(".datas-amount-confirm").text(price);

   }

   function change_quantity(){
	   var plan = jQuery(".plan");
	   var quantity = jQuery(".quantity").val();
	   var price = plan.find(':selected').attr('amount');
   	  // var price = plan.find(':selected').attr('amount')*quantity;

   		var str = price;
			var edunumber = jQuery(".quantity").val();
			var cards = jQuery(".network").val();
			var numbers;
			var price;
			var discount;
			switch(cards){
				case"glo":
				
				price = parseFloat(str - ((<?php

				$s = (floatval($level[0]->data_glo));
				echo $s;

				?>*str)/100) )* edunumber;
				
				jQuery(".datas-amount").val(price);
				jQuery(".datas-amount-confirm").text(price);
				break;
				case "airtel":
				
				price = parseFloat(str - ((<?php

				$s = (floatval($level[0]->data_airtel));
				echo $s;

				?>*str)/100) ) * edunumber;
				
				jQuery(".datas-amount").val(price);
				jQuery(".datas-amount-confirm").text(price);
				break;
				case "mtn":
				
				price = parseFloat(str - ((<?php

				$s = (floatval($level[0]->data_mtn));
				echo $s;

				?>*str)/100) ) * edunumber;
			
				jQuery(".datas-amount").val(price);
				jQuery(".datas-amount-confirm").text(price);
				break;
				case "9mobile":
					
				price = parseFloat(str - ((<?php

				$s = (floatval($level[0]->data_9mobile));
				echo $s;

				?>*str)/100) ) * edunumber;
			
				jQuery(".datas-amount").val(price);
				jQuery(".datas-amount-confirm").text(price);
				break;
			}

			var total_amount = price;

   jQuery(".datas-amount").val(price);
   jQuery(".datas-amount-confirm").text(price);
   }
	   

jQuery(".purchase-datas").click(function(){
   change_plan();
   change_quantity();
   var total_amount = 	jQuery(".datas-amount").val();
		   
		   jQuery(".datas-network-confirm").text(jQuery(".network").val());
		   jQuery(".datas-quantity-confirm").text(jQuery(".edunumber").val());

		   
if( jQuery(".network").val() == "none" ){
			   jQuery(".network").addClass("is-invalid");
			   jQuery(".network").removeClass("is-valid");
			   jQuery(".datas-network-message").text("Please Select One");
			   jQuery(".datas-proceed").hide();
			   jQuery(".datas-status-confirm").text("Please Select One Network");
}
else if( jQuery(".quantity").val() == "none"){
			   jQuery(".quantity").addClass("is-invalid");
			   jQuery(".quantity").removeClass("is-valid");
			   jQuery(".datas-quantity-error-message").text("Please Select One");
			   jQuery(".datas-proceed").hide();
			   jQuery(".datas-quantity-confirm").text("Please Select One Network");
}
else if( jQuery(".plan").val() == "none"){
			   jQuery(".plan").addClass("is-invalid");
			   jQuery(".plan").removeClass("is-valid");
			   jQuery(".datas-plan-error-message").text("Please Select One");
			   jQuery(".datas-proceed").hide();
			   jQuery(".datas-plan-confirm").text("Please Select One Network");
}
else{
   
			   
		   if(total_amount <= <?php echo $bal;?> && total_amount > 0){
		   jQuery(".datas-proceed").show();
			   jQuery(".datas-amount").removeClass("is-invalid");
			   jQuery(".datas-amount").addClass("is-valid");
			   jQuery(".datas-status-confirm").text("Correct");
jQuery(".datas-proceed").show();
jQuery(".network").addClass("is-valid");
jQuery(".network").removeClass("is-invalid");
jQuery(".datas-status-confirm").text("Correct");
		   }
		   else if(total_amount > <?php echo $bal;?> || total_amount <= 0){
		   jQuery(".datas-status-confirm").text("Balance Too Low");
		   jQuery(".datas-proceed").hide();
		   jQuery(".datas-amount").addClass("is-invalid");
		   jQuery(".datas-amount-error-message").text("Balance Too Low");
		   }
   

}	
	   
   
	   });
	   
	   
	   
			   
jQuery(".datas-proceed").click(function(){
   
   change_plan();
   change_quantity();

   jQuery('.btn-close').trigger('click');
   jQuery("#cover-spin").show();;
   
var obj = {};
obj["vend"] = "vend";
obj["network"] = jQuery(".network").val();
obj["plan"] = jQuery(".plan").find(':selected').attr('plan');
obj["volume"] = jQuery(".plan").find(':selected').attr('volume');
obj["uniqidvalue"] = jQuery("#uniqidvalue").val();
obj["quantity"] = jQuery(".quantity").val();
obj["pin"] = jQuery(".pin").val();
obj["amount"] = jQuery(".datas-amount").val();
obj["value"] = obj["network"]+" "+obj["plan"]+obj["volume"];


jQuery.ajax({
 url: '<?php echo esc_url(plugins_url("vpdatas/index.php"));?>',
 data: obj,
 dataType: 'json',
 'cache': false,
 "async": true,
 error: function (jqXHR, exception) {
	 jQuery("#cover-spin").hide();
	   var msg = "";
	   if (jqXHR.status === 0) {
		   msg = "No Connection.\n Verify Network.";
	swal({
 title: "Error!",
 text: msg,
 icon: "error",
 button: "Okay",
});
 
	   } else if (jqXHR.status == 404) {
		   msg = "Requested page not found. [404]";
			swal({
 title: "Error!",
 text: msg,
 icon: "error",
 button: "Okay",
});
	   } else if (jqXHR.status == 500) {
		   msg = "Internal Server Error [500].";
			swal({
 title:  msg ,
 text:  jqXHR.responseText,
 icon: "error",
 button: "Okay",
});
	   } else if (exception === "parsererror") {
		   msg = jqXHR.responseText;
			  swal({
 title: "Error",
 text: msg,
 icon: "error",
 button: "Okay",
});
	   } else if (exception === "timeout") {
		   msg = "Time out error.";
			swal({
 title: "Error!",
 text: msg,
 icon: "error",
 button: "Okay",
});
	   } else if (exception === "abort") {
		   msg = "Ajax request aborted.";
			swal({
 title: "Error!",
 text: msg,
 icon: "error",
 button: "Okay",
});
	   } else {
		   msg = "Uncaught Error.\n" + jqXHR.responseText;
			swal({
 title: "Error!",
 text: msg,
 icon: "error",
 button: "Okay",
});
	   }
   },
 
 success: function(data) {
   jQuery("#cover-spin").hide();
		if(data.code == "100"){
	   var val = data.pin;
	   var result = val.includes("-");
	   if(result === true){
		   var split = val.split("-");
		   var pin = split[0];
		   var ser = split[1];
		 swal({
 title: "PIN: ["+pin+"]",
 text: "SERIAL NO: ["+ser+"]",
 icon: "success",
 button: "Okay",
}).then((value) => {
   location.reload();
});
	   }
	   else{
   swal({
 title: "PIN ["+data.pin+"]",
 text: "Thanks For Your Patronage",
 icon: "success",
 button: "Okay",
}).then((value) => {
   location.reload();
});	
	   }
	 }
	 else{
   swal(data.message, {
	 icon: "error",
   }); 
	 }
 },
 type: 'POST'
});

});
	   
	   
	   
	   </script>
		
	</div>
</div>

</div>
</section>
</div>
		
		
		<?php
		

		}
}





function datas_set_control(){
	
	echo'
	if(jQuery("#datascontrol").is(":checked")){
		var datasc = "checked";
	}
	else{
		var datasc = "unchecked";
	}
	
obj["datascontrol"] = datasc;
	';
	
}

function datas_set_control_post(){
vp_updateoption("datascontrol",$_REQUEST["datascontrol"]);	
}




add_action("transaction_button","vpdatas_transaction_button");
add_action("transaction_style","vpdatas_transaction_style");
add_action("transaction_failed_case","vpdatas_failed");
add_action("transaction_successful_case","vpdatas_success");
add_action('vpttab', 'vpdatas_tab');

function vpdatas_transaction_style(){
	echo'
	.rsuccess{
		display:none;
	}
	.rfailed{
		display:none;
	}
	';
}
function vpdatas_transaction_button(){
	echo"
	<option value='datas'>Data Card</option>
	";
}






$id = get_current_user_id();
add_action("add_user_history_button","datas_history_button");
add_action("add_user_history_tab","datas_history_tab");

function datas_history_button(){
	echo'
	<a href="?vend=history&for=transactions&type=datacard" class="pe-2 text-decoration-none">	<button class="datas-hist btn-sm btn-primary btn"> <i class="mdi mdi-barcode-scan "></i> >Data Card</button> </a>
	';
	
}



function datas_history_tab(){
	if($_GET["for"] == "transactions"){
		if($_GET["type"] == "datacard"){		
echo'	

	<div id="datashist" class="thistory bg bg-white">

		<button class="btn download_datacard_s_history btn-primary me-3" style="float:left;">DOWNLOAD DATA CARD HISTORY</button>
		<button class="btn print_datacard_s_history btn-primary" style="float:left;">PRINT SUCCESSFUL PINS</button>

		<br>
		<br>
		<br>
		<table class="d-flex justify-content-md-center table table-responsive table-hover history-successful datacard_s_history mt-2" id="datacardshistory">
		<tbody>
		';
$id = get_current_user_id();
/*
global $wpdb;
$table_name = $wpdb->prefix.'sdatacard';
$resultsad = $wpdb->get_results($wpdb->prepare("SELECT * FROM  $table_name WHERE user_id= %d ORDER BY id DESC", $id));
*/

pagination_before_front("?vend=history","datacard","datacard", "sdatacard", "resultsad", "WHERE user_id = $id");

pagination_after_front("?vend=history","datacard","datacard");

global $resultsad;
echo"
<tr>
<th scope='col'><input type='checkbox' class='checkall' > Id</th>
<th scope='col'>Via</th>
<th scope='col'>Network</th>
<th scope='col'>Type</th>
<th scope='col'>Pin - Serial No.</th>
<th scope='col'>Value</th>
<th scope='col'>Load With.</th>
<th scope='col'>Check With.</th>
<th scope='col'>Amount</th>
<th scope='col'>Previous Balance</th>
<th scope='col'>Current Balance</th>
<th scope='col'>Time</th>
<th scope='col'>Receipt</th>
</tr>
";
foreach ($resultsad as $resultsa){ 
echo "
<tr>
<td scope='row'><input type='checkbox' value='".$resultsa->id."' class='checkdatas' > ".$resultsa->id."</td>
<td>".$resultsa->via."</td>
<td>".$resultsa->network."</td>
<td>".$resultsa->type."</td>
<td>".$resultsa->pin."</td>
<td>".$resultsa->value."</td>
<td>".$resultsa->load_ussd."</td>
<td>".$resultsa->check_ussd."</td>
<td>".$resultsa->amount."</td>
<td>".$resultsa->bal_bf."</td>
<td>".$resultsa->bal_nw."</td>
<td>".$resultsa->the_time."</td>
<td>
<button type='button' class=\"btn btn-sm btn-secondary p-2 text-xs font-bold text-white uppercase bg-indigo-600 rounded shadow  show_datas".$resultsa->id."\" data-bs-toggle=\"modal\" data-bs-target=\"#cexampleModal".$resultsa->id."\" data-bs-whatever='@getbootstrap'>VIEW</button>
";
echo '
            <div class="modal fade" id="cexampleModal'.$resultsa->id.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">'.strtoupper($resultsa->type).' Purchase Confirmation</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
						<div class="container-fluid border border-secondary" id="datacardreceipt'.$resultsa->id.'">
								<div class="row bg bg-dark text-white">
									<div class="col bg bg-dark text-white">
										<span class=""><h3>@INVOICE</h3></span>
									</div>
								</div>
							
							
						<div class="row p-4">
							
							<div class="row bg text-dark border border-bottom-primary md-2">
								<div class="col">
										<span class="input-group-text1"><h5>ID</h5></span>
								</div>
								<div class="col right">
										<span class="input-group-text1"><h5>'.strtoupper($resultsa->id).'</h5></span>
								</div>
							</div>
							
							<div class="row bg text-dark border border-bottom-primary md-2">
								<div class="col">
										<span class="input-group-text1"><h5>TYPE</h5></span>
								</div>
								<div class="col right">
										<span class="input-group-text1"><h5>'.strtoupper($resultsa->type).'</h5></span>
								</div>
							</div>
							
							<div class="row bg text-dark border border-bottom-primary md-2">
								<div class="col">
										<span class="input-group-text1"><h5>TIME</h5></span>
								</div>
								<div class="col right">
										<span class="input-group-text1"><h5>'.strtoupper($resultsa->the_time).'</h5></span>
								</div>
							</div>
							
							
							';
							if(stripos(strtoupper($resultsa->pin), '-')){
								$pin = explode('-',strtoupper($resultsa->pin));
								echo'
							<div class="row bg bg-secondary text-white border border-bottom-primary md-2">
								<div class="col">
										<span class="input-group-text1"><h5>PIN</h5></span>
								</div>
								<div class="col right">
										<span class="input-group-text1"><h5>'.$pin[0].'</h5></span>
								</div>
							</div>
							<div class="row bg bg-secondary text-white border border-bottom-primary md-2">
								<div class="col">
										<span class="input-group-text1"><h5>Serial Number</h5></span>
								</div>
								<div class="col right">
										<span class="input-group-text1"><h5>'.$pin[1].'</h5></span>
								</div>
							</div>
							';
							}
							else{
							echo'
							<div class="row bg bg-secondary text-white border border-bottom-primary md-2">
								<div class="col">
										<span class="input-group-text1"><h5>PIN</h5></span>
								</div>
								<div class="col right">
										<span class="input-group-text1"><h5>'.strtoupper($resultsa->pin).'</h5></span>
								</div>
							</div>
';							
								
							}
							
							echo'
							
						</div>
							
						
						
						</div>
		
					</div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary p-2 text-xs font-bold text-black uppercase bg-grey-600 rounded shadow  data-proceed-cancled" data-bs-dismiss="modal">Cancel</button>
					  <button type="button" id="" class="btn btn-info p-2 text-xs font-bold text-white uppercase bg-blue-600 rounded shadow "  onclick="printContent(\'datacardreceipt'.$resultsa->id.'\');">Print</button>
                      <button type="button" name="datas_receipt" id="datasreceipt'.$resultsa->id.'" class="btn btn-primary p-2 text-xs font-bold text-white uppercase bg-indigo-600 rounded shadow  datas_proceed'.$resultsa->id.'" >Download</button>
                    </div>
                  </div>
                </div>
            </div>
';
echo"
		<script>
jQuery(\".datas_proceed".$resultsa->id."\").on(\"click\",function(){
 var element = document.getElementById(\"datacardreceipt".$resultsa->id."\");
 jQuery('#cover-spin').show();
html2pdf(element, {
  margin:       10,
  filename:     'datacard.pdf',
  image:        { type: 'jpeg', quality: 0.98 },
  html2canvas:  { scale: 2, logging: true, dpi: 192, letterRendering: true },
  jsPDF:        { unit:'mm', format: 'a4', orientation:'portrait' }
});

 jQuery('#cover-spin').hide();
});
/*
var el = jQuery(\'.datas_s_history\').clone();
            jQuery(\'.clo\').append(el);
			*/
</script>

</td>
</tr>
";
}
echo'</tbody>
		</table>
		<br>

<script>
jQuery(".download_datacard_s_history").on("click",function(){
 var element = document.getElementById("datacardshistory");
html2pdf(element, {
  margin:       10,
  filename:     \'datacard.pdf\',
  image:        { type: \'jpeg\', quality: 0.98 },
  html2canvas:  { scale: 2, logging: true, dpi: 192, letterRendering: true },
  jsPDF:        { unit:\'mm\', format: \'a4\', orientation:\'portrait\' }
});
});

	jQuery(".checkall").on("change",function(){

	 jQuery("input[type=checkbox].checkdatas").prop("checked", jQuery(this).prop("checked"));

	});

jQuery(".print_datacard_s_history").on("click",function(){
 let person = prompt("Please enter a business name", "");
 
 var pins = 0;
 jQuery(".checkdatas:checked").each(function(){
	 var val = jQuery(this).val();
	pins += ","+val;
 });
 
	
 if(person != null && person.length > 0){
	 if(pins == 0){
	window.location.href = "'.get_home_url().'/wp-content/plugins/vpdatas/print.php?print_datas=all&biz_name="+person;	
	 }
	 else{
	window.location.href = "'.get_home_url().'/wp-content/plugins/vpdatas/print.php?print_datas="+pins+"&biz_name="+person;	 
	 }
 }

});

</script>

</div>	
	
';	
}
	}
}







register_activation_hook(__FILE__,"create_datas");
register_activation_hook(__FILE__,"create_datas_transaction");


$ver = 18;
if(vp_getoption("resolve_datas") != $ver ){


	global $wpdb;
	$lsd_name = $wpdb->prefix.'vpdatas';
	$sdata = $wpdb->prefix.'sdatacard';
	maybe_add_column($sdata, "volume", "ALTER TABLE $sdata ADD volume text");
	maybe_add_column($lsd_name,"via","ALTER TABLE $lsd_name ADD via text");
	maybe_add_column($sdata,"via","ALTER TABLE $sdata ADD via text");

	

	global $wpdb;
	$table_name = $wpdb->prefix.'sdatacard';
    $data = [ 'status' => 'Successful' ];
    $where = [ 'status' => NULL ];
    $updated = $wpdb->update($table_name, $data, $where);
	

vp_updateoption("resolve_datas",$ver);


}
