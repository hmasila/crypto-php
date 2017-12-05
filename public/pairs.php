<?php
$eth = array();
$bth = array();
foreach ($coinigy_client->markets() as $key => $value) {
  if (strpos($value, 'ETH')) {
    array_push($eth, $value);
  }
  else {
    array_push($bth, $value);
  }
}
?>
<div class="row pre-scrollable">
  <div class="col-md-6 col-md-offset-3">
  	<div class="col-md-3">
      <h4> Etherium Pairs </h4>
	    <ul>
	      <?php
	      foreach ($eth as $key) {
	        echo "<li>" . $key . "</li>";
	      }
	    ?>
	    </ul>
  	</div>
    <div class="col-md-3">
	    <ul>
        <h4> Bitcoin Pairs </h4>
	      <?php
	      foreach ($bth as $key) {
	        echo "<li>" . $key . "</li>";
	      }
	    ?>
	    </ul>
  	</div>
  </div>
</div>
