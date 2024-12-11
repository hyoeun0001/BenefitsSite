<?php
session_start();


error_reporting( E_ALL );
ini_set( "display_errors", 1 );



require 'dbcon.php'; //DB연결

if(isset($_POST['login_id']) && isset($_POST['login_pw'])) {
 
    $id = $_POST['login_id'];
    $pw = $_POST['login_pw'];
    
    if(empty($id)) {
        header("location: login_view.php?error=아이디를 입력하지 않았습니다.");
        exit();
    }
        
    else if(empty($pw)) {
        
        header("location: login_view.php?error=비밀번호를 입력하지 않았습니다.");
        exit();
    }
    
    else 
    {
        $pw = base64_encode($pw); //암호화
        
        //로그인시 DB저장된 ID확인
        $sql_v = "SELECT* FROM customer where ID = '$id'"; 
        $res = oci_parse($db,$sql_v);
        oci_execute($res);
        
       

        if($res) 
        {     
            $row = oci_fetch_array($res,OCI_ASSOC);
           
            if($row["PW"] == $pw) 
            {
                
                $_SESSION['ID'] = $row["ID"];
                
                header("location: mypage.php"); 
                exit();
            }
            else {
             header("location: login_view.php?error=비밀번호가 잘못 되었습니다.");
            exit();

            }
    
        }
        else {
            header("location: login_view.php?error=아이디가 잘못 되었습니다.");
            exit();
        }
    }
}

else {
    header("location: login_view.php?error=알 수 없는 오류가 발생하였습니다.");
    exit();
}

oci_free_statement($res);
 oci_close($db);
            
    
?>