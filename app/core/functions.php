<?php

// function get_pagination_vars()
// {

// 	/** set pagination vars **/
// 	$page_number = $_GET['page'] ?? 1;
// 	$page_number = empty($page_number) ? 1 : (int)$page_number;
// 	$page_number = $page_number < 1 ? 1 : $page_number;

// 	$current_link = $_GET['url'] ?? 'home';
// 	$current_link = ROOT . "/" . $current_link;
// 	$query_string = "";

// 	foreach ($_GET as $key => $value)
// 	{
// 		if($key != 'url')
// 			$query_string .= "&".$key."=".$value;
// 	}

// 	if(!strstr($query_string, "page="))
// 	{
// 		$query_string .= "&page=".$page_number;
// 	}

// 	$query_string = trim($query_string,"&");
// 	$current_link .= "?".$query_string;

// 	$current_link = preg_replace("/page=.*/", "page=".$page_number, $current_link);
// 	$next_link = preg_replace("/page=.*/", "page=".($page_number+1), $current_link);
// 	$first_link = preg_replace("/page=.*/", "page=1", $current_link);
// 	$prev_page_number = $page_number < 2 ? 1 : $page_number - 1;
// 	$prev_link = preg_replace("/page=.*/", "page=".$prev_page_number, $current_link);

// 	$result = [
// 		'current_link'	=>$current_link,
// 		'next_link'		=>$next_link,
// 		'prev_link'		=>$prev_link,
// 		'first_link'	=>$first_link,
// 		'page_number'	=>$page_number,
// 	];

// 	return $result;
// }


function logged_in()
{
	if(!empty($_SESSION['USER']))
		return true;

	return false;
}

    //exit();

create_tables();
function create_tables()
{
	
	$con = mysqli_connect(DBHOST, DBUSER, DBPASS,DB_NAME);
	// Database Connection Check...
	if(!$con) {
		echo mysqli_connect_error();
	}
	else echo "successfull";

    // Create Database If not exists ....
	$query = "CREATE DATABASE IF NOT EXISTS ". DB_NAME;
	$stm = mysqli_query($con, $query);
	

	$query = "use ". DB_NAME;
	$stm = mysqli_query($con, $query);
	/** users table **/
	$query = "create table if not exists users(
		id int primary key auto_increment,
        first_name varchar(30) not null,
        last_name varchar(30) not null,
		user_name varchar(20) not null,
        password varchar(255) not null,
		email varchar(100) not null,
		gender varchar(10) not null,
		date_of_birth date not null,
		phone varchar(20) not null,
		address text not null,
		user_img varchar(1024) null,
        role varchar(10) not null,
        about_me text not null,
		date datetime default current_timestamp,
		is_active tinyint(4) not null,
        is_delete tinyint(4) not null,
        created_at datetime not null,
        updated_at datetime not null,

		key user_name (user_name),
		key email (email)

	)";
	$stm = mysqli_query($con,$query);
	
	if($con->query($query) === TRUE) 
		echo "Database and Table Online";
	else
		echo "Database and Table Offline " . $con->error;
	$con->close();

	/** categories table **/
	// $query = "create table if not exists categories(

	// 	id int primary key auto_increment,
	// 	category varchar(50) not null,
	// 	slug varchar(100) not null,
	// 	disabled tinyint default 0,

	// 	key slug (slug),
	// 	key category (category)

	// )";
	// $stm = $con->prepare($query);
	// $stm->execute();

	// /** posts table **/
	// $query = "create table if not exists posts(

	// 	id int primary key auto_increment,
	// 	user_id int,
	// 	category_id int,
	// 	title varchar(100) not null,
	// 	content text null,
	// 	image varchar(1024) null,
	// 	date datetime default current_timestamp,
	// 	slug varchar(100) not null,

	// 	key user_id (user_id),
	// 	key category_id (category_id),
	// 	key title (title),
	// 	key slug (slug),
	// 	key date (date)

	// )";
	// $stm = $con->prepare($query);
	// $stm->execute();


}
