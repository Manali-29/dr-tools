<?php
session_start();
                            if(isset($_POST['update_password']))
                            {
                                $current_password = $_POST['current_password'];
                                $check_password = md5($current_password);

                                $new_password = $_POST['new_password'];
                                $password = md5($new_password);
                                $email = $_SESSION['email'];
                                
                                include "confing.php";

                                $check_password_sql = "SELECT * FROM users WHERE email = '$email'";
                                $check_password_sql_result =  mysqli_query($conn, $check_password_sql);

                                if(mysqli_num_rows($check_password_sql_result) > 0){
                                    while($check_password_row = mysqli_fetch_assoc($check_password_sql_result))
                                    {
                                        if($check_password_row['password'] == $check_password)
                                        {
                                            $update_password = "UPDATE users SET password = '$password' WHERE email = '$email'";
                                            $update_password_query =  mysqli_query($conn, $update_password);
                                            header("Location: my-account.php");
                                        }
                                        else
                                        {
                                            $_SESSION['status'] = "Your Current Password Not Match...";
                                            header("Location: my-account.php");
                                        }
                                    }
                                }
                            }
                        ?>