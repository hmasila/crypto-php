<?php

$array_kraken = array();
$array_poloniex = array();
$auth_ids = $coinigy_client->auth_ids();
$accounts = $coinigy_client->accounts();
foreach ($accounts["Kraken"] as $key => $value) {
  $array_kraken[$auth_ids[$value]] = $coinigy_client->balances($auth_ids[$value]);
}

foreach ($accounts["Poloniex"] as $key => $value) {
  $array_poloniex[$auth_ids[$value]] = $coinigy_client->balances($auth_ids[$value]);
}
?>

<?php
if (isset($_POST['submit'])) {
  if ($_POST['exch_mkt'] == "Kraken"){
    $poloniex_api->withdraw($_POST['currency'], $_POST['amount'], $_POST['address']);
  } else {
    $poloniex_api->withdraw($_POST['currency'], $_POST['amount'], $_POST['address']);
  }
}
?>

<div style="margin: 5%; padding: 5px">
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
        <div class="row">
          <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
						<?php foreach ($array_kraken as $key => $balance_array) {
        ?>
          <?php if(sizeof($balance_array) > 0) { ?>
            <?php foreach ($balance_array as $balance) {
        ?>
          <div class="col-md-2">
            <?php  echo '.$balance["balance_curr_code"]. : .round($balance["btc_balance"]).' ?>
            <input type="hidden" name="exch_mkt" id="exch_mkt" value="Kraken">
            <input type="hidden" name="currency" id="currency" value=<?php $balance["balance_curr_code"] ?>>
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
      } } else {
      	echo "You do not have any account with withdrawable balance";
      }}?>
        </div>
				</td>
				<td width=50%>
        <div class="row">
          <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
						<?php foreach ($array_poloniex as $balance_array) {
        ?>
          <?php if(sizeof($balance_array) > 0) { ?>
            <?php foreach ($balance_array as $balance) {
        ?>
          <div class="col-md-2">
            <?php  echo '.$balance["balance_curr_code"]. : .round($balance["btc_balance"]).' ?>
            <input type="hidden" name="exch_mkt" id="exch_mkt" value="Poloniex">
            <input type="hidden" name="currency" id="currency" value=<?php $balance["balance_curr_code"] ?>>
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
      } } else {
      	echo "You do not have any account with withdrawable balance";
      }}?>
        </div>
				</td>
			</tr>
		</tbody>
	</table>
</div>
