foreach($_POST as $key => $value)
		{
			if(!empty($_POST[$key]))
			$qarray[$key]="$key LIKE '%$_POST[$key]%'";
			$insarray[$key]=$_POST[$key];
		}
		$qstring=implode(' AND ',$qarray);
		$insstring=implode(' , ',$insarray);
		$num=(isset($_GET['num']))?$_GET['num']:1;
		$no_res=25;
		$query="select * from register where $qstring";
		$res=mysqli_query($dbconn,$query) or die('error in query');
		$no_rows=mysqli_num_rows($res);
		if($no_rows==0){
		$q="insert into register values $insstring";
		$r=mysqli_query($dbconn,$q) or die('error in query');
		echo 'Added into register';
		}
		$query="select * from register where $qstring LIMIT $num,$no_res";
		$res=mysqli_query($dbconn,$query) or die('error in query');