<?php

$array1_kraken = array("BTC: 1", "LTC: 5", "DASH: 2", "ADA: 8" );
$array2_kraken = array();
$array1_poloniex = array();
$array2_poloniex = array();
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
						<?php foreach ($array1_kraken as $currency) {
    ?>
						<div class="row">
							<div class="col-md-2">
								<?php  echo $currency ?>
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
						</div>
					</form>
				<?php
} ?>
				</td>
				<td width=50%>
					<form method="post" action="">
						<?php foreach ($array1_kraken as $currency) {
        ?>
        <div class="row">
          <div class="col-md-2">
            <?php  echo $currency ?>
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
        </div>
      </form>
				<?php
    } ?>
				</td>
			</tr>
		</tbody>
	</table>
</div>