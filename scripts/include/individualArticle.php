<?php
	require_once('scripts/required/login.php');
	$db = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	if (mysqli_connect_errno($con))
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}		
	$id = $_GET['articleid'];
	if (count($id) > 0){
	$query = mysqli_query($db, "SELECT * FROM Articles WHERE id=$id");
	
	echo '<div id="articleHolder">';		
		while ($row = mysqli_fetch_array($query))
		{	
			$writersEmail = $row['writer'];			
			$staffEmailQuery = mysqli_query($db, "SELECT * FROM users WHERE staff = 1");	
			while ($staffrows = mysqli_fetch_array($staffEmailQuery))
			{
				if ($staffrows['email'] == $writersEmail)
				{
					$writer = $staffrows['username'];
				}
			}	
			$message = $row['articletext'];	
			$article = "<div class='article'>";
				$article .= "<div class='innerArticle sponsor'>";
					$article .= '<h3 class="articleHeading"><a href="article.php?articleid='.$row['id'].'">'.$row['title'].'</a></h3>';
					$article .= "<span class='writer'>By <a href='mailto:".$writersEmail."' target='_blank'>".$writer."</a></span>";					
					$article .= $message;	
					$article .= "</div>";			
					$article .= "<div id='tagsHolder'>";
					$exp = explode(',', $row['tags']);	
					if (strlen($row['tags']) > 1)
					{
						if (count($exp) > 0)
						{					
							foreach ($exp as $index)
							{
								$article .="<a href='index.php?tags=$index'>$index</a>";
							}
						}
					}	
					else
					{
						$article .="<a href='index.php?tags=notags'>notags</a>";
					}
				$article .= "</div>";
			$article .= "</div>";
			echo $article;
		}
		echo "</div>";
	}
?>				