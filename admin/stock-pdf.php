<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width" />
        <!-- *Note: You must have internet connection on your laptop or pc other wise below code is not working -->
        <!-- Add icon library -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- bootstrap css and js -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
        <!-- JS for jQuery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-lg-12" align="center">
                    <br>
                    <h5 align="center">Stock Report</h5>
                    <br>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Quantity In Stock</th>
                                <th>Product Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                include "confing.php";

                                $sql = "SELECT pro_name, id, pro_price, quantity FROM product";

                                $result = mysqli_query($conn, $sql);

                                if(mysqli_num_rows($result)>0)
                                {
                                    while($row = mysqli_fetch_assoc($result))
                                    {
							?>
										<tr>
											<td><?php echo $row['id']; ?></td>
											<td><?php echo $row['pro_name']; ?></td>
											<td><?php echo $row['quantity']; ?></td>
											<td><?php echo $row['pro_price']; ?></td>
										</tr>
                            <?php
                                    }
                                }
							?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br>
    </body>
</html> 