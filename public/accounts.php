<?php
$res = $coinigy_client->accounts();

?>

<div class="container">
	<h4>API keys</h4>
		<table width=100%>
			<thead>
				<th width="50%">
					Kraken API keys
				</th>
				<th width="50%">
					Poloneix API keys
				</th>
			</thead>

			<tbody>
	<?php
        foreach ($res["Kraken"] as $row) {
            ?>
			<tr>
				<td width=50%>
					Public: &nbsp &nbsp <input type="text" value="<?php echo escape($row); ?>">
				</td>
				<td width=50%>
					Private: &nbsp &nbsp <input type="text" value="<?php echo escape($row); ?>">
				</td>
			</tr>
		<?php
        } ?>
		</tbody>
	</table>
</div
