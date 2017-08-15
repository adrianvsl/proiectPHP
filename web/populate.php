<?php
	/**
	 * Created by PhpStorm.
	 * User: root
	 * Date: 6/26/17
	 * Time: 10:06 PM
	 */
	
	
	// = "host=localhost port=5432 dbname=postgres user=levy options='--application_name=$appName'";
	$conn = pg_connect("host=localhost dbname=crawler_data user=levy password=qaz123okm");
//simple check

var_dump($conn);
	//$conn = pg_connect($connStr);
$i = 0;
	while($i < 10000)
	{
		$result = pg_query($conn, "SELECT DATA_POS_INTERMEDIATE_CLICK(INT '".rand(1,20)."', INT '".rand(1,222)."',timestamp '2001-09-28 11:20:00',TEXT 'domain', INT'1', TEXT 'click', JSONB '{
  \"array\": [
    1,
    2,
    3
  ],
  \"boolean\": true,
  \"null\": null,
  \"number\": 123,
  \"object\": {
    \"a\": \"b\",
    \"c\": \"d\",
    \"e\": \"f\"
  },
  \"string\": \"Hello World\"
}', TEXT 'ip');");
		var_dump($result);
		echo pg_last_error($conn);
		var_dump(pg_fetch_all($result));
		$i +=1;
	}