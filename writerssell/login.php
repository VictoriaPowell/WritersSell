<?php
		session_start();
		$login_successful = false;
		
		if(isset($_POST['submit']) || isset($_COOKIE['login']))
		{
			if(isset($_COOKIE['login'])) 
			{
				$username = $_COOKIE['login'];
				$login_successful = true;
			}else{

				if(isset($_POST['savelogin']))
				{
					$expire = time()+60*60*24*30; //set to a month
					setcookie("login", $_POST['username'], $expire);
				}
				$username = $_POST['username'];
				$login_successful = true;
			}
			
		}

		if ( isset ( $_GET['session_destroy'] ) && $_GET['session_destroy'] ==true ) {
			session_destroy();
		}
?>

<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>

<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<head>
		<title>Sign in</title>
		<style type="text/css">
			body { background-color: #fafca7; }
			div { border-style:solid;
				  border-width:5px;
				  border-color:#5C01FE; 
				  padding:5px; 
				  text-align:center; 
				  background-color: #fafca7; }
		</style>
	</head>
	<body>
	<div>
	 <?php if($login_successful == false){ ?>
            <form action='login.php' method='post'>
                Username:<br />
                <input type="text" name="username" />
                <br /><br />
                
                Password:<br />
                <input type="password" name="password" />
                <br /><br />
                
                <input type="checkbox" name="savelogin" />&nbsp;Keep me logged in
                <br /><br />
                
                <input type="submit" name="submit" value="Sign In" />
                
            </form>
        <?php }
			else { ?>
        	<h2>Welcome, <?php echo $username; ?>.</h2>
			<br />
			<h2>Would you like to Sign Out?</h2>
			<a href="<?php echo ( $_SERVER['PHP_SELF'] );?>?session_destroy=true">Yes</a>
			<br />
			<br />
			<a href="index.html">No</a>
			<br />
			<br />			
			<a href="index.html">Go to Main Page</a>
	
        <?php } ?>
	</div>	
	</body>
</html>