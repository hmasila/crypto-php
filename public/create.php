<?php

/**
 * Use an HTML form to create a new entry in the
 * api keys table.
 *
 */


if (isset($_POST['submit'])) {
    require "../config.php";
    require "../common.php";

    try {
        $connection = new PDO($dsn, $username, $password, $options);

        $new_key = array(
            "api_key" => $_POST['api_key'],
            "exchange_platform"  => $_POST['exchange_platform']
        );

        $sql = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "api_keys",
                implode(", ", array_keys($new_key)),
                ":" . implode(", :", array_keys($new_key))
        );

        $statement = $connection->prepare($sql);
        $statement->execute($new_key);
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>

<?php require "templates/header.php"; ?>

<?php
if (isset($_POST['submit']) && $statement) {
    ?>
	<blockquote><?php echo $_POST['exchange_platform']; ?> key successfully added.</blockquote>
<?php
} ?>
<table width=100% height=100%>
	<tr>
		<td width=50%>
			<h2>Add Kraken API Key</h2>

			<form method="post">
				API Key <input type="text" name="api_key" id="api_key">
				<input type="hidden" name="exchange_platform" value="Kraken">
				<input type="submit" name="submit" value="Add Key">
			</form>
		</td>
		<td width=50%>
			<h2>Add Poloniex API Key</h2>

			<form method="post">
				API Key <input type="text" name="api_key" id="api_key">
				<input type="hidden" name="exchange_platform" value="Poloniex">
				<input type="submit" name="submit" value="Add Key" id="submit">
			</form>
		</td>
	</tr>
</table>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>
