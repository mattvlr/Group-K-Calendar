<?php
class db_interface
{
	public function connect();
	public function disconnect();
	public function delete( $table, $where='', $orderBy='', $limit=array(), $shutdown=false );
	public function update( $table, $set, $where='', $shutdown=false, $preformatted=false );
	public function insert( $table, $set, $shutdown=false);
	public function replace( $table, $set, $where, $shutdown=false );
	public function build( $data );  //Takes an array of commands and makes a query
	public function build_first( $data); // makes query returns first
	public function execute(); //runs stored query
	public function executeOnShutodwn();
	public function query( $query);
	public function getChangedRows();
	public function getTotalRows($query_id=null);
	public function getAutoId();  // get last auto increment id
	public function getThreadId();
	public function freeResult( $query_id=null);
	public function getRow($query_id = null);
	public function getArray($query_id=null); //get array containing results from set
	public function checkIndex( $table, $index) // returns whether a index exists in a table
	public function checkField( $table, $field) // returns whether a field exists in a table
	public function checkTable( $table);  // checks if table exists
	public function dropTable( $table); //drops a table
	public function dropField( $table, $field );
	public function addField( $table, $field, $type, $default=NULL );
	public function addIndex( $table, $name, $fieldlist, $isPrimary=false ); //add an index to a column
	public function changeField( $table, $old_field, $new_field, $type='', $default='' ); // changes filed from old name to new, also can change type and defualt value
	//public function optimize( $table);
	//public function addFulltextIndex( $table, $field);
	//public function getSchematic( $table);
	//public function getTableNames();
	//public function getFieldNames( $table );
	//public function getFulltextStatus( $table ); // whether or not a table has a fulltext index
	
	//public function getSqlVersion();
	//public function getQueryCount(); //number of running queries
	//public function flushQuery(); //flush queued query
	//public function preventAddSlashes( $fields=array() ); //prevent sql injection
	
	
	//takes array of field, value pairs
	//public function compileInsertString( $data ); // compiles an array of fields for insertion
	//public function compileUpdateString( $data ); // same but for update
	
	//public function addSlashes( $t);  //takes text to escape and reurns escaped text
	
	//public function buildConcat($data); // concats an array data and reurns sql formatted concat string
	
	//public function buildBetween( $column, $value1, $value2);
	
	
	
	
	
}


?>