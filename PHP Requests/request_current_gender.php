<?php
	if (session_status() == PHP_SESSION_NONE)
		session_start();
	
	if(isset($_POST['action']) && !empty($_POST['action']))
	{
		$action = $_POST['action'];
		$args = isset($_POST['arguments']) ? $_POST['arguments'] : "";
		request_current_gender($args);
	}
	
	function request_current_gender($args)
	{
		include '../Config/database.php';
		$username = $_SESSION['username'];

		$sql = "use matcha";
		$connection->exec($sql);
		
		$stmt = $connection->prepare("SELECT * FROM registered_users WHERE username = :username");
		$stmt->execute(array(':username' => $username));
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		if(!empty($result))
		{
			echo implode(", ", array($result['gender'], $args));
			return;
		}
		return null;
	}
?>