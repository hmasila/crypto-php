<?php
$eth = array();
$bth = array();
foreach ($kraken_api->getTradingPairs() as $key => $value) {
  if (strpos($key, 'XBT')) {
    array_push($bth, $key);
  }
  else {
    array_push($eth, $key);
  }
}
?>
<div class="row pre-scrollable">
  <div class="col-md-6">
    <div class="col-md-3">
	    <ul>
	      <?php
	      foreach ($bth as $key) {
	        echo "<li>" . $key . "</li>";
	      }
	    ?>
	    </ul>
  	</div>
  	<div class="col-md-3">
	    <ul>
	      <?php
	      foreach ($eth as $key) {
	        echo "<li>" . $key . "</li>";
	      }
	    ?>
	    </ul>
  	</div>
  </div>
</div>
