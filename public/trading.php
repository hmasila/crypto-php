<?php
	$auth_ids = $coinigy_client->auth_ids();
	$markets = $coinigy_client->markets();
?>

<?php
if (isset($_POST['submit'])) {
	$coinigy_client->addOrder($_POST['api_key'], $_POST['market_id'], $_POST['order_type_id'], $_POST['amount'], $_POST['price']);
	}
?>
<div class="row">
	<div class="col-md-6">
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<div class="row">
				<div class="col-md-3">
					Select API Key:
				</div>
				<div class="col-md-3">
					<select name = "api_key" id="api_key" class="styled-select slate">
						<?php foreach ($auth_ids as $key => $value) {
				    echo '<option value = "'.$value.'"> '.$key.' </option>';
				    } ?>
					</select>
				</div>
			</div>
			<p></p>
			<div class="row">
				<div class="col-md-3">
					Select Currency:
				</div>
				<div class="col-md-3">
					<select name = "market_id" id="market_id" class="styled-select slate">
							<?php foreach ($markets as $key => $value) {
					    echo '<option value = "'.$key.'"> '.$value.' </option>';
					    } ?>
					</select>
				</div>
			</div>
			<p></p>
			<div class="row">
				<div class="col-md-2">
					Amount:
				</div>
				<div class="col-md-3">
					<input type="text" name="amount" id="amount">
				</div>
				<div class="col-md-1"></div>
				<div class="col-md-1">
					Price:
				</div>
				<div class="col-md-3">
					<input type="text" name="price" id="price">
				</div>
			</div>
				<button type = "submit" name="submit" class="submit-btn"> BUY </button>
				<input type="hidden" name="order_type_id" value="1">
		</form>
	</div>

	<div class="col-md-6">
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<div class="row">
				<div class="col-md-3">
					Select API Key:
				</div>
				<div class="col-md-3">
					<select name = "api_key" id="api_key" class="styled-select slate">
						<?php foreach ($auth_ids as $key => $value) {
				    echo '<option value = "'.$value.'"> '.$key.' </option>';
				    } ?>
					</select>
				</div>
			</div>
			<p></p>
			<div class="row">
				<div class="col-md-3">
					Select Currency:
				</div>
				<div class="col-md-3">
					<select name = "market_id" id="market_id" class="styled-select slate">
							<?php foreach ($markets as $key => $value) {
					    echo '<option value = "'.$key.'"> '.$value.' </option>';
					    } ?>
					</select>
				</div>
			</div>
			<p></p>
			<div class="row">
				<div class="col-md-2">
					Amount:
				</div>
				<div class="col-md-3">
					<input type="text" name="amount" id="amount">
				</div>
				<div class="col-md-1"></div>
				<div class="col-md-1">
					Price:
				</div>
				<div class="col-md-3">
					<input type="text" name="price" id="price">
				</div>
			</div>
			<input type="hidden" name="order_type_id" value="2">
			<button type = "submit" name="submit" class="submit-btn"> SELL </button>
		</form>
	</div>
</div>
