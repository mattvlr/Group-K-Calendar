<?php
require_once('_db.php');
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
	
	public function arrayToQuery($set) //format array of fields to comma separated query string
	{
		$field_names = "";
		
		foreach( $set as $k ) 
		{
		$field_names .= $k . ',';
		}

		
	$field_names  = rtrim( $field_names, ","  ); //take space out
	return $field_names;
	}
	
	public function exists($what,$where) //format array of fields to comma separated query string
	{
	$exists = false;
	$query = "SELECT * FROM user WHERE " . $what . "='"	. $where. "';";
	$query_id = $this->query( $query);
	while($row = mysqli_fetch_array($query_id))
	{
	}
	if(mysqli_num_rows($query_id) > 0)
	{
	$exists = true;
	}
	return $exists;
	}
	
	
	public function select( $table, $get, $where='') //SELECTs the fields designated in the array $get WHERE conditions..
	{
		$data = array();
		if(is_array($get))
		{
			$getq = $this->arrayToQuery($get);
		}
		else
		{
			$getq = $get;
		}
		$query = "SELECT " . $getq . " FROM " . $table;
		
		if( $where != '')
		{
			$query .= " WHERE " . $where;
		}
		$query_id = $this->query($query,$get);
		
		if(is_array($get))
		{
		while($row = mysqli_fetch_array($query_id))
		{
			$i = 0;
			while( $i < count($get))
			{
				$data[$get[$i]] = $row[$get[$i]];
				$i++;
			}
		}
		}
		else  // handle single data returns
		{
		while($row = mysqli_fetch_array($query_id))
		{

				$data = $row[$get];
		}
		}
		if(! $this->query_id )
		{
			$this->error("MYSQL QUERY ERROR: QUERY = " . $query);
			return false;
		}	
		
		
		
		
		
	return $data;
	
	
	}
	
	public function compare( $table, $get='', $value, $where='' ) // used like compare('user', 'passhash', $test_passhash, 'id') can also be used to see if 
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
	$query = "UPDATE " . $table . " SET " . $set;
		if( $where )
		{
			$query .= " WHERE " . $where;
		}
	if($this->query($query))
	{
		return true;
	}
	return false;
	}
	
	public function insert( $table, $set)
	{
	$q = $this->arrayPairToQuery( $set);
	$query = "INSERT INTO " . $table .  " ({$q['FIELD_NAMES']}) VALUES({$q['FIELD_VALUES']})";
	$query_id = $this->query($query);
	if(mysqli_affected_rows($this->connection_id) > 0)
	{
	return true;
	}
	return false;
	}
	
	public function error( $err)
	{
	echo $err . '<br>';
	echo '<script language="javascript">';
	echo 'alert("'.$err.'")';
	echo '</script>';
	}
	public function query( $query_string)
	{
	$this->query_id = mysqli_query($this->connection_id, $query_string);

		if(! $this->query_id )
		{
			$this->error("MYSQL QUERY ERROR: QUERY = " . $query_string);
		}
	return $this->query_id;
	}
	
	public function fetch($query)
	{
	$this->query_id = mysqli_fetch_field($this->connection_id, $query);
		if(! $this->query_id )
		{
			$this->error("MYSQL QUERY ERROR: QUERY = " . $query);
		}
	return $this->query_id;
	}
	
	public function fetchArray($query_id)
	{
	mysqli_fetch_array($query_id);
		if(! $this->query_id )
		{
			$this->error("MYSQL QUERY ERROR: QUERY = " . $query);
		}
	return $this->query_id;
	}
	
	
	
	public function getSessionInfo($id)  //take id from cookie and return array of session info
	{
		$fields = array('username','first_name','last_name','avatar','permission');
		$where = "id='" . $id . "'";
		$info = $this->select('user',$fields,$where);
		if(!$info)
		{
		return false;
		}
		return $info;
	
	
	/*
	$query = "SELECT username, first_name, last_name, avatar, permission FROM user WHERE id=" . $id . ";";    //This is old code that was written before I finished the select function
	$query_id = $this->query($query);

	while($row = mysqli_fetch_array($query_id))
	{

	$session_info = array(	'username' => $row['username'],
							'first_name' => $row['first_name'],
							'last_name' => $row['last_name'],
							'avatar' => $row['avatar'],
							'permission' => $row['permission']
						);

	}
	if(mysqli_num_rows($query_id) > 0)
	{
	return $session_info;
	}
	else
	{
    return false;
	}*/
	
	}
	
	public function login($email, $password)
	{
		$what = array('id','passhash','salt','permission');
		$where = 'email = "' . $email. '"';
		$login = $this->select('user',$what,$where);
		if($login != false)
		{
			$testhash = crypt($password,$login['salt']);
			if($testhash == $login['passhash'])
			{
				return $login['id'];
			}
		}
	
	return false;
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