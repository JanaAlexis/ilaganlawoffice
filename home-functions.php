<?php
    include_once('config/config.php');
    
    if($_SERVER['REQUEST_METHOD']=='POST'){
        switch($_GET["action"]){
            case "add":
           		$category = $_POST['addType'];
				echo $category;

		  	    if($category == 1){
		            $clientId = $_POST['clientId'];
		            $clientFname = $_POST['fname'];
		            $clientLname = $_POST['lname'];
		            $clientGen = $_POST['clientGender'];
		            $clientBirth = $_POST['birthday'];
	                $clientAdd = $_POST ['clientAdd'];
		            $clientCon = $_POST ['clientCon'];
		            $clientStat = $_POST['clientStat'];

		            $clientStat = ucfirst($clientStat);

		          $clientFname = ucfirst($clientFname);
		          $clientLname = ucfirst($clientLname);

	              $conn = mysqli_connect("localhost","root","","lawfirm");
	              $insertClient = "INSERT INTO client (`clientFname`, `clientLname`, `clientGen`, `clientBirth`, `clientAdd`, `clientCon`, `clientStat`) VALUES ('$clientFname', '$clientLname', '$clientGen', '$clientBirth', '$clientAdd', '$clientCon', '$clientStat')";
	              $sql = mysqli_query($conn, $insertClient) or die(mysqli_error($conn));

	              //echo $insertClient;
	              header("Location: client.php");

	            }else if ($category == 2){

	            	$ccFname = $_POST['ccfname'];
		            $ccLname = $_POST['cclname'];
		            $caseId = $_POST['cdId'];
		            $caseTitle = $_POST['cdTitle'];
		            $caseDesc = $_POST['cdDesc'];
		            $casetags = $_POST['casetags'];
		            $ctags = implode(",", $casetags);
		            echo $ctags;

					if(is_uploaded_file($_FILES['document']['tmp_name'])) {
		            	$conn = mysqli_connect("localhost","root","","lawfirm");

		            	$query = "SELECT `caseID` FROM `case_disk` WHERE `caseID` = '$caseId'";
				  		$sql = mysqli_query($conn, $query);

				  		if(mysqli_num_rows($sql)<1){

				  			$ccFname = ucfirst($ccFname);
					  		$ccLname = ucfirst($ccLname);

							$resquery = "SELECT `clientID` FROM `client` WHERE `clientFname` = '$ccFname' AND `clientLname` = '$ccLname'";
					  		$res = mysqli_query($conn, $resquery);

					  		if(mysqli_num_rows($res)>0){
						  		$row = mysqli_fetch_assoc($res);

					  			$name = $_FILES['document']['name'];
								$type = $_FILES['document']['type'];
							   	$data = mysqli_real_escape_string($conn, file_get_contents($_FILES['document']['tmp_name']));

							 		$conn = mysqli_connect("localhost","root","","lawfirm");
					                $insertCase = "INSERT INTO case_disk (caseID, clientID, caseTitle, caseDesc, caseTags, cfilename, cfilemime, cfiledata) VALUES ('$caseId','$row[clientID]', '$caseTitle', '$caseDesc','$ctags', '$name','$type','$data')";
					                //echo $insertCase;
					      			$sql = mysqli_query($conn, $insertCase) or die(mysqli_error($conn));
					           
									header("Location: case.php");
							}else{
								header("Location: home.php?page=adding&msg=noclient");

				  			}
				  		}else{
	                        header("Location: home.php?page=adding&msg=existing");
				  		}
					}else{

						header("Location: home.php?page=adding&msg=nodocu");

					}

				}else if ($category == 3){
				 	$dcFname = $_POST['dcfname'];
		            $dcLname = $_POST['dclname'];
		            $dataId = $_POST['ddId'];
		            $dataTitle = $_POST['ddTitle'];
		            $dataDesc = $_POST['ddDesc'];
		            $datatags = $_POST['datatags'];
		            $dtags = implode(",", $datatags);  

		            if(is_uploaded_file($_FILES['document']['tmp_name'])) {
		            	$conn = mysqli_connect("localhost","root","","lawfirm");
		            	$dataquery = "SELECT `clientID` FROM `client` WHERE `clientFname` = '$dcFname' AND `clientLname` = '$dcLname'";
				  		$datares = mysqli_query($conn, $dataquery) or die(mysqli_error($conn));

				  		if(mysqli_num_rows($datares)>0){
				  			$drow = mysqli_fetch_assoc($datares);


							$name = $_FILES['document']['name'];
							$type = $_FILES['document']['type'];
					   	 	$data = mysqli_real_escape_string($conn, file_get_contents($_FILES['document']['tmp_name']));


					 		$conn = mysqli_connect("localhost","root","","lawfirm");
			                $insertData = "INSERT INTO data_disk (clientID, dataTitle, dataDesc, dataTags, filename, filemime, filedata) VALUES ('$drow[clientID]', '$dataTitle', '$dataDesc','$dtags', '$name','$type','$data')";
			                $sql = mysqli_query($conn, $insertData) or die(mysqli_error($conn));

			                header("Location: data.php");
				  		}else{
							header("Location: home.php?page=adding&msg=noclient");

				  		}
				  		

		         	}else{

						header("Location: home.php?page=adding&msg=nodocu");

					}
		        }else{
		           	echo "Invalid category.";
		        }
				break;
		}
	}




?>