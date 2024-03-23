<?php
  $option_array = json_decode(get_option("vp_options"),true);
if(current_user_can("vtupress_access_users")){
?>

<div class="container-fluid license-container">
            <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
            <style>
                div.vtusettings-container *{
                    font-family:roboto;
                }
                .swal-button.swal-button--confirm {
                    width: fit-content;
                    padding: 10px !important;
                }
            </style>

<p style="visibility:hidden;">
Please take note to always have security system running and checked. DO not disclose your login details to anyone except for confidential reasons. 
Not even the developers of this plugin should be trusted enough to grant access anyhow.

                  </p>


<?php
if(!defined('ABSPATH')){
    $pagePath = explode('/wp-content/', dirname(__FILE__));
    include_once(str_replace('wp-content/' , '', $pagePath[0] . '/wp-load.php'));
}
if(WP_DEBUG == false){
error_reporting(0);	
}
include_once(ABSPATH."wp-load.php");
include_once(ABSPATH .'wp-content/plugins/vtupress/admin/pages/history/functions.php');
include_once(ABSPATH .'wp-content/plugins/vtupress/functions.php');

?>

<div class="row">

    <div class="col-12">
    <link
      rel="stylesheet"
      type="text/css"
      href="<?php echo esc_url(plugins_url("vtupress/admin")); ?>/assets/extra-libs/multicheck/multicheck.css"
    />
    <link
      href="<?php echo esc_url(plugins_url("vtupress/admin")); ?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css"
      rel="stylesheet"
    />
<div class="card">
                <div class="card-body">
                  <h5 class="card-title">DATA CARD IMPORTER</h5> 
                  <div class="table-responsive">
<div class="p-4">

    <div class="row mb-3 p-4 border border-secondary">
            <div class="col col-1">
                <li class="fas fa-info-circle align-middle"></li>
            </div>
            <div class="col col-11">
            Please note that the listed vendors does not belong to vtupress and issues with them should be directed to their admins/customer care reps.
          </div>
    </div>


<div class="row">

<div class="col datacard">

<span class="input-group-text">SELECT PROVIDER:</span>
<select name="datacard_select" class="datacard_select" >
<option value="<?php echo vp_option_array($option_array,"datacard_select");?>"><?php echo vp_option_array($option_array,"datacard_select");?></option>

<?php
$data = file_get_contents("https://vtupress.com/wp-content/plugins/vpimporter/vpimporter.php?datacard_names");
$json = json_decode($data, true);
foreach($json as $key => $value){
	?>
	<option value='<?php echo $value;?>'><?php echo ucfirst($key);?></option>
	<?php
}
?>
</select>
<input type="button" name="datacard_import" class="datacard_import" value="IMPORT">

</div>


</div>

<script>

jQuery(".datacard_import").click(function(){
	jQuery("#cover-spin").show();
var obj = {};
var toatl_input = jQuery(".datacard select, .datacard input").length;
var run_obj;

for(run_obj = 0; run_obj <= toatl_input; run_obj++){
var current_input = jQuery(".datacard select, .datacard input").eq(run_obj);


var obj_name = current_input.attr("name");
var obj_value = current_input.val();

if(typeof obj_name !== typeof undefined && obj_name !== false){
obj[obj_name] = obj_value;
}
	
}

jQuery.ajax({
  url: "<?php echo esc_url(plugins_url('vpdatas/importer.php'));?>",
  data: obj,
  dataType: "text",
  "cache": false,
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
  title: "Error!",
  text: msg,
  icon: "error",
  button: "Okay",
});
        } else if (exception === "parsererror") {
            msg = "Requested JSON parse failed.";
			   swal({
  title: msg,
  text: jqXHR.responseText,
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
        if(data == "100" ){
	
		  swal({
  title: "Imported!",
  text: "Go To The Service To See Changes",
  icon: "success",
  button: "Okay",
}).then((value) => {
	location.reload();
});
	  }
	  else if(data == "101" ){
jQuery("#cover-spin").hide();
var select = jQuery(".datacard_select option:selected").text();
	swal({
  title: "Error",
  text: jQuery(".datacard_select option:selected").text()+" Importer Doesn\'t Exist  For This Service",
  icon: "error",
  button: "Okay",
});	  
	  }
	  else{
		  
	jQuery("#cover-spin").hide();
	 swal({
  title: "Error!",
  text: data,
  icon: "warning",
  button: "Okay",
});
	  }
  },
  type: "POST"
});

});

</script>

</div>







<?php   
}

/*
1. The name
2. Plan ID associated to the name
3. format
4. url

*/
//LOADER

//$datacard_select = vp_getoption("datacard_select");
$datacard_baseurl = vp_getoption("datacard_baseurl");
$datacard_format = vp_getoption("datacard_format");
$datacard_apikey = vp_getoption("datacard_apikey");
$datacard_quantities = vp_getoption("datacard_quantities");
$datacard_plans = vp_getoption("datacard_plans");

?>


<label class="d-none">FORMAT:</label><br>
<input type="text" class="form-control mb-1 d-none card_format" name="datacardformat" value="<?php echo lcfirst($datacard_format);?>" />

<label  class="d-none">BASE URL:</label><br>
<input type="text" class="form-control mb-1 d-none card_baseurl" name="datacardbaseurl" value="<?php echo lcfirst($datacard_baseurl);?>" />

<label>API KEY:</label><br>
<input type="text" class="form-control mb-1 card_apikey" name="datacardapikey" value="<?php echo $datacard_apikey;?>" />

<label>SELECT PLAN:</label><br>
<select class="form-control mb-1 card_plan" name="datacardplan">
    <?php
    $each_plan_data = explode(",",$datacard_plans);
    
    foreach($each_plan_data as $datacardlist){
        $ddatas = explode("-",$datacardlist);

        if(!empty($ddatas) && isset($ddatas[6])){
        ?>
    <option plan-network="<?php echo  trim($ddatas[0]);?>"  plan-network-name="<?php echo  trim($ddatas[6]);?>" plan-id="<?php echo  trim($ddatas[1]);?>" plan-type="<?php echo  trim($ddatas[3]);?>" plan-plan="<?php echo  trim($ddatas[4]);?>" plan-volume="<?php echo  trim($ddatas[5]);?>"><?php echo ucfirst(trim($ddatas[2]));?></option>
    <?php
    }
  }

    ?>
</select>


<label>AMOUNT:</label><br>
<input type="text" class="form-control mb-1 card_amount" name="datacardamount" value="" />

<label>LOADING USSD:</label><br>
<input type="text" class="form-control mb-1 card_loading" name="datacardloading" value="" />

<label>BALANCE USSD:</label><br>
<input type="text" class="form-control mb-1 card_checking" name="datacardchecking" value="" />

<label>SELECT QUANTITY:</label><br>
<select class="form-control mb-1 card_quantity" name="datacardplan">
    <?php
    foreach(explode(",", $datacard_quantities) as $qlist){
        ?>
    <option value="<?php echo trim($qlist);?>" ><?php echo trim($qlist);?></option>
    <?php
    }

    ?>
</select>

<input type="button" value="PURCHASE" onclick="purchase_pins()" />


<script>

function purchase_pins(){
	jQuery("#cover-spin").show();
var obj = {};
var format = jQuery(".card_format").val();
var baseurl = jQuery(".card_baseurl").val();
var apikey = jQuery(".card_apikey").val();
var quantity = jQuery(".card_quantity").val();
var network = jQuery(".card_plan").find(':selected').attr('plan-network');
var planid = jQuery(".card_plan").find(':selected').attr('plan-id');
var plan = jQuery(".card_plan").find(':selected').attr('plan-plan');
var volume = jQuery(".card_plan").find(':selected').attr('plan-volume');
var plantype = jQuery(".card_plan").find(':selected').attr('plan-type');
var amount = jQuery(".card_amount").val();
var check_ussd = jQuery(".card_checking").val();
var load_ussd = jQuery(".card_loading").val();
var network_name = jQuery(".card_plan").find(':selected').attr('plan-network-name');

obj["format"] = format;
obj["baseurl"] = baseurl;
obj["network"] = network;
obj["quantity"] = quantity;
obj["planid"] = planid;
obj["plan"] = plan;
obj["apikey"] = apikey;
obj["amount"] = amount;
obj["network_name"] = network_name;
obj["volume"] = volume;
obj["type"] = plantype;
obj["check_ussd"] = check_ussd;
obj["load_ussd"] = load_ussd;




jQuery.ajax({
  url: "<?php echo esc_url(plugins_url('vpdatas/vend.php'));?>",
  data: obj,
  dataType: "text",
  "cache": false,
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
  title: "Error!",
  text: msg,
  icon: "error",
  button: "Okay",
});
        } else if (exception === "parsererror") {
            msg = "Requested JSON parse failed.";
			   swal({
  title: msg,
  text: jqXHR.responseText,
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
        if(data == "100" ){
	
		  swal({
  title: "LOADED!",
  text: quantity+" Pins Successfully Loaded",
  icon: "success",
  button: "Okay",
}).then((value) => {
	location.reload();
});
	  }
	  else{
jQuery("#cover-spin").hide();
var select = jQuery(".datacard_purchase_select option:selected").text();
	swal({
  title: "Error Loading",
  text: data,
  icon: "error",
  button: "Okay",
});	  
	  }
  },
  type: "POST"
});

};

</script>

</div>
                </div>
              </div>


</div>


</div>



</div>