<?php
	session_start();	
	if (!(empty($_SESSION['email'])))
	{		
		if ($_SESSION['staff'] != "1")
		{
			//so hes not a stalf member so why should he be here? 
			//so ill send him to the index page...
			header('location: ../index.php');
		}		
	}
	else
	{
			header('location: ../index.php');
	}
?>
<!doctype html>
<html lang="en">
	<head>
		<title> PC Insight Staff Area</title>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
		<script src="../js/staffArea.js"></script>
		<script src="../ckeditor/ckeditor.js"></script>
		<link rel="stylesheet" type="text/css" href="../css/staffArea.css" />		
	</head>
	<body>
		<div id="top">
			<div id="TopRight">
				<span id="Notif"></span>
				<ul>
					<li>
						<a id="logout" href="#"><?php echo $_SESSION['email'];?><span class="caret"></span></a>
						<ul	class="dropDown">	
							<li><a href="profile.php"> Edit Profile </a></li>
							<li><a href="../logout.php"> Logout </a></li>
						</ul>						
					</li>
				</ul>
			</div>
			<div id="TopLeft">
				<ul>
					<li><a href="../index.php"> To website. </a></li>
					<li><a href="index.php"> Home </a></li>
					<li><a href="#"> Editors <span class="caret"></span></a>
						<ul	class="dropDown">	
							<li><a href="editors.php"> New Article </a></li>
							<li><a href="review.php"> Review Article </a></li>
						</ul>						
					</li>
					<?php
						require_once('../scripts/required/login.php');
						$db = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
						if (mysqli_connect_errno($con))
						{
							echo "Failed to connect to MySQL: " . mysqli_connect_error();
						}
						$id = $_SESSION['UserID'];
						$query = mysqli_query($db, "SELECT admin FROM users WHERE UserID=$id");	
						$query = mysqli_fetch_array($query);
						mysqli_close($db);
						if ($query['admin'] == '1'){
						echo '<li><a href="#"> Moderators <span class="caret"></span></a>
							<ul	class="dropDown">	
								<li><a href="users.php"> Users </a></li>
								<li><a href="articles.php"> Articles </a></li>
							</ul>						
						</li>';
					}
					?>
				</ul>
			</div>
		</div>
		<div id="content">
			<h1> Welcome staff </h1>
			<span id="error"></span>
			<div id="contentWrapper">
				<span id="titleSpan"> Title: </span>
				<input type="text" name="title" id="title" />
				<div id="ckedit">
					<textarea id="ckeditor"></textarea>
				</div>
				<script type="text/javascript">
					CKEDITOR.replace( 'ckeditor', {
						fullPage: false,
						allowedContent: true
					});
				</script>
				<p> Tags </p>
				<div id="tags">						
					<div id="tagsHolder"></div>
					<input type="text" id="TagInput" />
				</div>
				<button id="submit">Submit</button>
			</div>
		</div>
		<span id="loader"></span>
		<div id="Notifications">
			<div id="NotificationsTop">
				<h3> Notifications </h3>
				<a href="#"> View all Notifications </a>
			</div>
			<ul id="notificationInsert">
				
			</ul>
		</div>
	</body>
</html>