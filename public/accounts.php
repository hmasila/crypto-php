<?php
$res = $coinigy_client->accounts();

?>

<div style="margin: 5%; padding: 5px">
	<h4>API keys</h4>
	<div class="row">
		<div class="col-md-6">
			<table width=100%>
				<thead>
					<th>
						Kraken API keys
					</th>
				</thead>
				<tbody>
					<?php
                    foreach ($res["Kraken"] as $row) {
                        ?>
					<tr>
						<td width=50%>
							API Key: &nbsp &nbsp <input type="text" value="<?php echo escape($row); ?>" readonly>
						</td>
					</tr>
				<?php
                    } ?>
				</tbody>
			</table>
		</div>
		<div class="col-md-6">
			<table width=100%>
				<thead>
					<th>
						Poloneix API keys
					</th>
				</thead>
				<tbody>
					<?php
                    foreach ($res["Poloniex"] as $row) {
                        ?>
					<tr>
						<td>
							API Key: &nbsp &nbsp <input type="text" value="<?php echo escape($row); ?>" readonly>
						</td>
					</tr>
				<?php
                    } ?>
				</tbody>
			</table>
		</div>
	</div>
</div
