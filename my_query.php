<?php

    /****************Add Data********************************
    ********************************************************/
    function change_content(){
        if (isset($_GET['u_id'])) {
            echo 'Update';
        }else{
            echo 'Add';
        }
    }

/****************Add Data********************************
 ********************************************************/
    function add_data($name, $email, $pass, $table_name){
        global $CONN;
        $dateTime= date('Y-m-d H:i:s');
        $fetch = "select count(*) AS count from $table_name where email = '$email'";
        $execute = mysqli_query($CONN, $fetch);
        if($execute){
            $rows = mysqli_fetch_assoc($execute);
            if($rows['count']>=1){
                return "1";
              
            }else{
                $sql = "INSERT INTO $table_name(`name`, `email`, `password`, `profile`, `status`, `created_at`) VALUES ('$name','$email','$pass','2','1','$dateTime')";
                $run = mysqli_query($CONN,$sql);
                if($run){
                    header('location:manage_employee.php');
                  
                }else{
                    return "3";
                }
            }
        }    
    }
/*End Add Data************************************************
*********************Start Fething Data***********************/
    function fetch_data($tbl_name, $row_id='')
    {
        global $CONN;
        if ($tbl_name=='mentor_profile') {
            // fetching data from mentro_profile table
            $sql = "select * from $tbl_name order by id desc";
        }
        elseif ($row_id=="" ) {
            // fetching data from employee table
            $sql = "select * from $tbl_name where profile = '2' order by id desc";
        
        }else{
            // If row id is null and tbl name is employee - fetching single row from employee table
            $sql = "select id, name, email from $tbl_name where id = $row_id";
        }
        
        $results = array();

        foreach ($CONN->query($sql) as $row) {
            
            $results[] = $row;
      
        }
        return $results;
    }

/*End Fetching Data************************************************
*********************Start Delete Data****************************/
    function delete_data($tbl_name, $row_id)
    {
        global $CONN;
        
        $sql = "delete from $tbl_name where id = $row_id";
        
        $run = mysqli_query($CONN,$sql);
        
        if($run){
            return "1";
            
        }else{
            return "2";
        }     
    }

/*End Delete Data************************************************
*********************Start Updating Data****************************/
    function update_data($name='', $email='', $pass='', $table_name, $row_id, $status='')
    {
        
        global $CONN;
        $dateTime= date('Y-m-d H:i:s');
        if ($status!='') {
            // Update status only
             $sql = "UPDATE $table_name SET `status`='$status',`updated_at`='$dateTime' WHERE id = '$row_id'";
        }else{
            // Update Table 
             $sql = "UPDATE $table_name SET `name`='$name',`email`='$email',`password`='$pass',`updated_at`='$dateTime' WHERE id = '$row_id'";
        }
       
        // echo $sql;
        // exit();
        $run = mysqli_query($CONN,$sql);
        
        if($run){
            return "1";   
        }else{
            return "2";
        }     
    }
    ?>