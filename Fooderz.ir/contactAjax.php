<?php

                
              
                 
							$fname=$_POST["fname"];

                           	$txt=$_POST["txt"];
                           	$email=$_POST["email"];
                           	$phone=$_POST["phone"];
                           	$date_Time=date('Y-m-d');

                               



               
						if(!empty($fname)&& !empty($txt)&& !empty($email)&& !empty($phone))
						{ 
                           if(preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/', $email) &&
                           	preg_match('/^09[0-9]{9}$/', $phone))
                           {
                              
                      
							 
                               try {
                               	require_once '../DataBase/PDO/DBconnect/DBconnect.php';
                           	$sql='INSERT INTO contact_us(fullName,txt,phone,email,date_Time) 
                           	VALUES(:fullName,:txt,:phone,:email,:datetime1) ';
                           	    $stmt = $db->prepare($sql);
                           $arr = array(
                           	':fullName'=>$fname,                             
                              ':txt'=>$txt,
                              ':email'=>$email,
                        
                              ':phone'=>$phone
                              ,':datetime1'=>$date_Time
                            );
                              
                          
                             $stmt->execute($arr);
                             echo "پیام شما با موفقیت دریافت شد تیم پشتیبانی در اسرع رسیدگی خواهد کرد";

                               } catch (Exception $e) 

                               {
                               	$err=$e->getMessage();
                               	 var_dump($errinfo); 

                               }
                           		
                       
                            




                           
                         
                          
                           }

						}					
                 
					
				