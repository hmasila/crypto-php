<?php

$array_kraken = array_unique(array_column($kraken_api->getTradingPairs(), "base"));
$array_poloniex = array();
foreach ($poloniex_api->get_balances() as $key => $value) {
	if($value > 0){
		array_push($array_poloniex, $key);
	}
}
?>

<?php
if (isset($_POST['submit'])) {
    $poloniex_api->withdraw($_POST['currency'], $_POST['amount'], $_POST['address']);
}
?>

<div class="panel">
	<table width=100%>
		<thead>
			<th width="50%">
				Kraken Balances
			</th>
			<th width="50%">
				Poloniex balances
			</th>
		</thead>
		<tbody>
			<tr>
				<td width=50%>
					<form method="post" action="">
						<?php foreach ($array_kraken as $currency) {
    ?>
						<div class="row">
							<div class="col-md-2">
								<?php  echo $currency ?>
								<input type="hidden" name="currency" id="currency" value=<?php $currency ?>>
							</div>
							<div class="col-md-5" style="margin-right: 2px;">
								<input type="text" name="address" id="address" placeholder="Input Address" size="25">
							</div>
							<div class="col-md-2">
								<input type="text" name="amount" id="amount" placeholder="Amount" size="10">
							</div>
							<div class="col-md-2">
								<button type="submit" name="submit" class="submit-btn">Withdraw </button>
							</div>
						</div>
					</form>
				<?php
} ?>
				</td>
				<td width=50%>
					<?php if(sizeof($array_poloniex) > 0) { ?>
        <div class="row">
          <form method="post" action="">
						<?php foreach ($array_poloniex as $currency) {
        ?>
          <div class="col-md-2">
            <?php  echo $currency; ?>
            <input type="hidden" name="currency" id="currency" value=<?php $currency ?>>
          </div>
          <div class="col-md-5" style="margin-right: 2px;">
            <input type="text" name="address" id="address" placeholder="Input Address" size="30">
          </div>
          <div class="col-md-2">
            <input type="text" name="amount" id="amount" placeholder="Amount" size="10">
          </div>
          <div class="col-md-2">
            <button type="submit" name="submit" class="submit-btn">Withdraw </button>
          </div>
        </form>
          <?php
      } ?>
        </div>
        <?php
      } else {
      	echo "You do not have any account with withdrawable balance";
      }
      ?>
				</td>
			</tr>
		</tbody>
	</table>
</div>
