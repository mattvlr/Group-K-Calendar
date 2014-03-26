<?php

class mysql_driver extends db_info
{

	public $query_id = null;
	public $fetch = '';
	protected $connection_id = null;
	
	public function connect()
	{
		$this->connection_id = mysqli_connect(parent::DB_SERVER,parent::DB_USERNAME,parent::DB_PASSWORD,parent::DB_DATABASE);
		if (mysqli_connect_errno()) {  //Check connection
			$this->error("Failed to connect to MYSQL: " . mysqli_connect_error());
			return false;
		}
		else
		{
			return true;
		}
	}
	public function arrayPairToQuery($set) //format key value array to query-able format
	{
		$field_names = "";
		$field_values = "";
		
		foreach( $set as $k => $v)  //split into two data sets each separated by ,
		{
		$field_names .= $k . ',';

			if ( is_numeric( $v ) and strcmp( intval($v), $v ) === 0 )
			{
				$field_values .= $v.",";
			}
			else  // if its a string use 'value' instead of value
			{
				$field_values .= "'" . $v . "'" . ',';
			}
		}

	$field_names  = rtrim( $field_names, ","  ); //take space out
	$field_values = rtrim( $field_values, "," );
	return array ('FIELD_NAMES' => $field_names, //return array
				'FIELD_VALUES' => $field_values,
				);
	}
	
	/*public function arrayToQuery($set) //format array of fields to comma separated query string
	{
		$field_names = "";
		
		foreach( $set as $k ) 
		{
		$field_names .= $k . ',';
		}

		
	$field_names  = rtrim( $field_names, ","  ); //take space out
	return $field_names;
	}*/
	
	public function select( $table, $get, $where='') //can only select from single table atm
	{
	$query = "SELECT " . $get . " FROM " . $table;
	
		if( $where != '')
		{
		$query .= " WHERE " . $where;
		}
	$result = $this->getQuery($query,$get);
	
	}
	
	public function compare( $table, $get, $value, $where='' )  // USE unique where or this wont work as desired
	{	//test a value against the db
		$same = false;
		$query = "SELECT " . $get . " FROM " . $table;
	
		if( $where != '')
		{
			$query .= " WHERE " . $where . ';';
		}
		$query_id = $this->query($query);
		while($row = mysqli_fetch_array($query_id))
		{
		$found = $row["$get"];
		}
		echo "GET: " . $get . "<br>";
		echo "LOL: " . $found ."<br>";

		if(mysqli_num_rows($query_id) > 0)
		{
			if( $value == $found)
			{
				$same = true;
			}
		}
		else
		{
			$same = false;
		}

	return $same;
	}
	
	public function delete( $table, $where='')
	{
		if(! $where )
		{
			$query = "TRUNCATE TABLE " . $table;
		}
		else
		{
			$query = "DELETE FROM " . $table . " WHERE " . $where;
		}
	$result = $this->query($query);
	return $result;
	}
	

	public function update( $table, $set, $where='')
	{
		if( $where )
		{
			$query .= "WHERE " . $where;
		}
	return $this->query($query);
	}
	
	public function insert( $table, $set)
	{
	$q = $this->arrayPairToQuery( $set);
	$query = "INSERT INTO " . $table .  " ({$q['FIELD_NAMES']}) VALUES({$q['FIELD_VALUES']})";
	return $this->query($query);
	}
	
	public function error( $err)
	{
	echo $err . '<br>';
	echo '<script language="javascript">';
	echo 'alert("'.$err.'")';
	echo '</script>';
	}
	public function query( $query)
	{
	echo "QUERY : '" . $query . "'<br>";
	$this->query_id = mysqli_query($this->connection_id, $query);

		if(! $this->query_id )
		{
			$this->error("MYSQL QUERY ERROR: QUERY = " . $query);
		}
	return $this->query_id;
	}
	
	public function fetch($query)
	{
	echo "QUERY : '" . $query . "'<br";
	$this->query_id = mysqli_fetch_field($this->connection_id, $query);
		if(! $this->query_id )
		{
			$this->error("MYSQL QUERY ERROR: QUERY = " . $query);
		}
	return $this->query_id;
	}
	
	public function fetchArray($query)
	{
	echo "QUERY : '" . $query . "'<br";
	$this->query_id = mysqli_fetch_array($this->connection_id, $query);
		if(! $this->query_id )
		{
			$this->error("MYSQL QUERY ERROR: QUERY = " . $query);
		}
	return $this->query_id;
	}
	
	
	public function getQuery( $query,$field_names)
	{
	$this->query_id = mysqli_query($this->connection_id, $query);
		while($row = mysqli_fetch_array($result))
		{
		
		
		
		}
		if(! $this->query_id )
		{
			$this->error("MYSQL QUERY ERROR: QUERY = " . $query);
		}
	return $data;
	}
	
	
	public function disconnect()
	{
    	if ( $this->connection_id )
    	{
        	return @mysqli_close( $this->connection_id );
        }
    }
}
?>