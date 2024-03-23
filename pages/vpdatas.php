<?php
if(current_user_can("vtupress_admin")){

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
$option_array = json_decode(get_option("vp_options"),true);





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

                

                
                <div class="form-check form-switch card-title d-flex">
<div class="input-group">
<label class="form-check-label float-start input-group-text" for="flexSwitchCheckChecked">Data Card Status</label>
<input onchange="changestatus('datas')" value="checked" class="form-check-input datas input-group-text h-100 float-start" type="checkbox" role="switch" id="flexSwitchCheckChecked" <?php echo vp_option_array($option_array,"datascontrol");?>>
</div>
</div>
<script>
function changestatus(type){
var obj = {}
if(jQuery("input."+type).is(":checked")){
  obj["set_status"] = "checked";
}
else{
  obj["set_status"] = "unchecked";
}
obj["spraycode"] = "<?php echo vp_getoption("spraycode");?>";
obj["set_control"] = type;



  jQuery.ajax({
  url: "<?php echo esc_url(plugins_url('vtupress/controls.php'));?>",
  data: obj,
  dataType: "text",
  "cache": false,
  "async": true,
  error: function (jqXHR, exception) {
	  jQuery(".preloader").hide();
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
	jQuery(".preloader").hide();
        if(data == "100" ){
	location.reload();
	  }
	  else{
		  
	jQuery(".preloader").hide();
	 swal({
  title: "Error",
  text: data,
  icon: "error",
  button: "Okay",
});
	  }
  },
  type: "POST"
});

}

</script>


                  <div class="table-responsive">
<div class="p-4">

<div id="cardseasyaccess">
<div class="alert alert-primary mb-2" role="alert">
<b>HOW TO USE :</b>
<br>
<br>
<h5>Adding DATACARDS PIN</h5>
<ol>
<li>Select the Network Such as MTN, GLO e.t.c you wanna add pin for. The Drop-Down is next to [NETWORK] below</li>
<li>In the large textarea next to NETWORK which you\'ve selected is where you have to enter the pin. Enter PIN and SERIAL Number. To do that, kindly enter the pin and serial number in this format <b>12345-6789</b>. Where 12345 is the pin and 6789 is the serial number. for any pin that doesn\'t need serial number, just enter the pin alone</li>
<li>Set DELIMITER: if you are uploading one pin for a network, kindly leave the delimiter as none or enter comma [,] to let the system know you are entering multiple PINS. NOTE: if you enter commer [,] in the delimiter, make sure you separate each pin in the step above with comma [,]. E.g 12345-6789, 5678-9355</li>
<li> Click the Add Pins Button</li>
</ol>

<b>Read more by clicking this link: <a href="https://vtupress.com/doc/setting-up-ecards-data-pins/">ECARDS</a></b>
</div>



<div class="neglect border border-secondary">
<!--BEGINNING OF GREY-->
<div style="background-color:grey;">
<label style="color:white;" class="ml-2">ADD DATACARD PIN[s]</label>
<div class="p-2">
<form class="dpins">
<div class="input-group md-3">
<span class="input-group-text">NETWORK:</span>
<select class="network form-control" name="network">
<option value="mtn">MTN</option>
<option value="glo">GLO</option>
<option value="9mobile">9MOBILE</option>
<option value="airtel">AIRTEL</option>
</select>
<span class="input-group-text form-control">PLAN:</span>
<input type="number" class="value" name="value" placeholder="(e.g 1.5,2.5,1,10 e.t.c)">
</div>

<div class="input-group md-3">
<span class="input-group-text form-control">VOLUME:</span>
<select class="volume form-control" name="volume">
<option value="GB">GB</option>
<option value="MB">MB</option>
</select>
<span class="input-group-text form-control">TYPE:</span>
<select class="type form-control" name="type">
<option value="SME">SME</option>
<option value="CORPORATE">CORPORATE</option>
<option value="DIRECT">DIRECT</option>
</select>
<span class="input-group-text form-control">AMOUNT [NGN]:</span>
<input type="number" class="form-control amount" />

</div>

<div class="input-group md-3">
<span class="input-group-text form-control">LOADING USSD:</span>
<input type="text" class="form-control loading_ussd" />
<span class="input-group-text form-control">CHECKING USSD:</span>
<input type="text" class="form-control checking_ussd" />
</div>

<textarea name="pin" class="pin form-control" placeholder="Enter Pin(s). Separate Pins By Comma sign and enter Comma sign in the delimiter field if you are importing more than one pin"></textarea>
<div class="input-group mb-3">
<span class="input-group-text" title="[use none if you are uploading a single pin or separate each pins by {, or / or ;}]">DELIMITER </span>
<input type="text" class="delimiter" name="delimiter" value="none" placeholder="separate pins by comma \',\'">
<span class="input-group-text">ACTION</span>
<input type="button" name="add_pin" class="add_pin btn btn-success" value="ADD PIN[s]">
</div>


</form>
</div>
</div>
 </div>
<?php
    global $wpdb;
    $table_name = $wpdb->prefix.'vpdatas';
    $resultfad = $wpdb->get_results("SELECT * FROM  $table_name WHERE status = 'unused' ORDER BY id DESC");
    $used = $wpdb->get_results("SELECT * FROM  $table_name WHERE status = 'used' ORDER BY id DESC");


    ?>


<div  style='background-color:grey;'>
<label style='color:white;' class='ml-2'>SHOW NETWORK(s)</label>
<div class='p-2'>
<div class='input-group mb-3'>
<span class='input-group-text'>FIND NETWORK</span>
<select class='network thenetwork group-text' name='network'>
<option value='all'>ALL</option>
<option value='mtn'>MTN</option>
<option value='glo'>GLO</option>
<option value='airtel'>AIRTEL</option>
<option value='9mobile'>9MOBILE</option>
</select>
<span class='input-group-text'>STATUS</span>
<select class='nvisibility group-text' name='network'>
<option value='unused'>UNUSED</option>
<option value='used'>USED</option>
</select>
<input type='button' value='SHOW NETWORK' name='submitnetwork' class='btn btn-primary group-text searchnetwork'>
</div>
</div>
</div>



<div  style='background-color:grey;'>
<label style='color:white;' class='ml-2'>ACTION</label>
<div class='p-2'>
<div class='input-group mb-3'>
<span class='input-group-text'>TARGET</span>
<select class='target1 group-text' name='target'>
<option value='checked'>CHECKED</option>
<option value='unchecked'>UNCHECKED</option>
</select>
<span class='input-group-text'>STATUS</span>
<select class='targetstatus1 group-text' name='targetstatus1'>
<option value='used'>USED</option>
<option value='unused'>UNUSED</option>
</select>
<span class='input-group-text'>ACTION</span>
<select class='target-action group-text' name='target-action'>
<option value='delete'>DELETE</option>
</select>
<input type='button' value='RUN' name='runtarget' class='btn btn-primary group-text runtarget'>
</div>
</div>
</div>



<div class='input-group'>
<input class='usedbtn btn btn-primary' type='button' value='USED' name=''> <input class='unusedbtn btn btn-primary' type='button' value='UN USED' name=''>
</div>

	<div class='container dtable d-flex justify-content-start' >
  <table class='table table-striped table-hover table-bordered table-responsive'>
	<thead>
	<tr>
	<th scope='col'><input type='checkbox' class='unused mastercheckbox border-success'> <input type='checkbox' class='used mastercheckbox border-danger'></th>
	<th scope='col'>Id:</th>
	<th scope='col'>Network:</th>
  <th scope='col'>Type:</th>
	<th scope='col'>Plan:</th>
  <th scope='col'>Volume:</th>
  <th scope='col'>Pin:</th>
  <th scope='col'>Load:</th>
  <th scope='col'>Check:</th>
  <th scope='col'>Amount:</th>
  <th scope='col'>Used By:</th>
	<th scope='col'>Time</th>
	<th scope='col'>Status</th>
	</tr>
	</thead>
	<tbody>
<?php
foreach($resultfad as $pins){
	
	$id = $pins->id;
  $network = $pins->network;
  $type = strtoupper($pins->type);
  $plan = $pins->plan;
  $volume = $pins->volume;
	$pin = $pins->pin;
	$amount = $pins->value;
  $check = $pins->check_ussd;
  $load = $pins->load_ussd;
  $used_by = $pins->used_by;

	$time = $pins->the_time;
	$status = $pins->status;	
	echo"
	<tr class='unused $network networkresult all'>
	<th scope='col'><input type='checkbox' class='unusedcheckbox border-success' value='$id'></th>
	<th scope='row'>$id</th>
	<td>$network</td>
  <td>$type</td>
  <td>$plan</td>
  <td>$volume</td>
  <td>$pin</td>
  <td>$load</td>
  <td>$check</td>
  <td>$amount</td>
  <td>$used_by</td>
  <td>$time</td>
  <td>$status</td>
	</tr>
	";

	
}	

foreach($used as $pins){
	
	$id = $pins->id;
  $network = $pins->network;
  $type = strtoupper($pins->type);
  $plan = $pins->plan;
  $volume = $pins->volume;
	$pin = $pins->pin;
	$amount = $pins->value;
	$time = $pins->the_time;
	$status = $pins->status;	
  $used_by = $pins->used_by;
  $check = $pins->check_ussd;
  $load = $pins->load_ussd;

	echo"
	<tr class='used $network networkresult all'>
	<th scope='col'><input type='checkbox' class='usedcheckbox border-danger' value='$id'></th>
	<th scope='row'>$id</th>
	<td>$network</td>
  <td>$type</td>
  <td>$plan</td>
  <td>$volume</td>
  <td>$pin</td>
  <td>$load</td>
  <td>$check</td>
  <td>$amount</td>
  <td>$used_by</td>
  <td>$time</td>
  <td>$status</td>
	</tr>
	";

	
}
?>
	</tbody>
</table>
</div>


<script>

	
jQuery(document).ready(function(){
jQuery("input[type=checkbox].used").removeProp("checked");
jQuery("input[type=checkbox].unused").removeProp("checked");
});
		 
	jQuery(".used.mastercheckbox").on("change",function(){

	 jQuery("input[type=checkbox].usedcheckbox").prop("checked", jQuery(this).prop("checked"));

	});
	
	jQuery(".unused.mastercheckbox").on("change",function(){

	 jQuery("input[type=checkbox].unusedcheckbox").prop("checked", jQuery(this).prop("checked"));

	});
	
	
	jQuery(".runtarget").on("click",function(){
	jQuery("#cover-spin").show();
	var targetstatus1 = jQuery(".targetstatus1").val();
	var ids = "-";
	var target = jQuery(".target1").val();
	
	var targetaction = jQuery(".target-action").val();
	
	if(target == "checked"){
	jQuery("."+targetstatus1+"checkbox:checked").each(function(){
	ids = ids+"-"+jQuery(this).val();
	});
	
	}
	else{
	jQuery("."+targetstatus1+"checkbox:not(:checked)").each(function(){
	ids = ids+"-"+jQuery(this).val();
	});	
	}
	
	obj = {};
	obj["target"] = target;
	obj["targetstatus"] = targetstatus1;
	obj["targetaction"] = targetaction;
	obj["keys"] = ids;
	
	jQuery.ajax({
  url: "<?php echo esc_url(plugins_url("vpdatas/index.php"));?>",
  data: obj,
  dataType: "json",
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
		  swal({
  title: "Successfully Added",
  text: data.message,
  icon: "success",
  button: "Okay",
}).then((value) => {
	location.reload();
});
	  }
	  else{
	swal(data.message, {
      icon: "error",
    }); 
	  }
  },
  type: "POST"
});
	
	
	});
	
	
	
	
jQuery(".used").hide();
jQuery(".unusedbtn").on("click",function(){
	jQuery(".used").hide();
	jQuery(".unused").show();
});
jQuery(".usedbtn").on("click",function(){
	jQuery(".unused").hide();
	jQuery(".used").show();
});

jQuery(".searchnetwork").on("click",function(){
	var val = jQuery(".thenetwork").val();
	var vis = jQuery(".nvisibility").val();
	jQuery(".networkresult").hide();
	jQuery(".mastercheckbox").hide();
	jQuery("."+val+"."+vis).show();
	jQuery("."+vis+".mastercheckbox").show();
	
});


/*
jQuery(".savecard").click(function(){

jQuery("#cover-spin").show();
	
var obj = {};
var toatl_input = jQuery(".cardeasy input,.cardeasy select").length;
var run_obj;

for(run_obj = 0; run_obj <= toatl_input; run_obj++){
var current_input = jQuery(".cardeasy input,.cardeasy select").eq(run_obj);


var obj_name = current_input.attr("name");
var obj_value = current_input.val();

if(typeof obj_name !== typeof undefined && obj_name !== false){
obj[obj_name] = obj_value;
}

	
}

	jQuery.ajax({
  url: "<?php echo esc_url(plugins_url('vpdatas/saveauth.php'));?>",
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
        if(data == "100" ){
	
		  swal({
  title: "SAVED",
  text: "Update Completed",
  icon: "success",
  button: "Okay",
}).then((value) => {
});
	  }
	  else{
		  
	jQuery("#cover-spin").hide();
	swal({
  buttons: {
    cancel: "Why?",
    defeat: "Okay",
  },
  title: "Update Wasn\'t Successful",
  text: "Click \'Why\' To See reason",
  icon: "error",
})
.then((value) => {
  switch (value) {
 
    case "defeat":
      break;
    default:
      swal({
		title: "Details",
		text: data,
      icon: "info",
    });
  }
}); 

  }
  },
  type: "POST"
});

	
});*/


jQuery(".dpins .add_pin").on("click",function(){
		  jQuery("#cover-spin").show();
var obj = {};
obj["network"] = jQuery(".dpins .network").val();
obj["pin"] = jQuery(".dpins .pin").val();
obj["value"] = jQuery(".dpins .value").val();
obj["add_pin"] = jQuery(".dpins .pin").val();
obj["delimiter"] = jQuery(".dpins .delimiter").val();
obj["volume"] = jQuery(".dpins .volume").val();
obj["type"] = jQuery(".dpins .type").val();
obj["amount"] = jQuery(".dpins .amount").val();
obj["check_ussd"] = jQuery(".dpins .checking_ussd").val();
obj["load_ussd"] = jQuery(".dpins .loading_ussd").val();

jQuery.ajax({
  url: '<?php echo esc_url(plugins_url("vpdatas/pins.php"));?>',
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
  title: "Error!",
  text: msg,
  icon: "error",
  button: "Okay",
});
        } else if (exception === "parsererror") {
            msg = "Requested JSON parse failed.";
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
		  swal({
  title: "Successfully Added",
  text: data.message,
  icon: "success",
  button: "Okay",
}).then((value) => {
	location.reload();
});
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
              </div>
</div>


</div>



</div>
<?php   
}
    
?>