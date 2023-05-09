<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>rip friday</title>
  </head>

  <body>
    <header>
      <?php
      $dbLocation = 'localhost';
            $dbUsername = 'root';
            $dbPassword = 'root';
            $dbName = 'messages';

        if (!isset($dbLocation))
        {
            echo "Database location is missing.<br>
                  Connection script now terminating.";
            exit(0);
        }
        
        if (!isset($dbUsername))
        {
            echo "Database username is missing.<br>
                  Connection script now terminating.";
            exit(0);
        }
        
        if (!isset($dbPassword))
        {
            echo "Database password is missing.<br>
                  Connection script now terminating.";
            exit(0);
        }
        
        if (!isset($dbName))
        {
            echo "Database name is missing.<br>
                  Connection script now terminating.";
            exit(0);
        }

        $db = mysqli_connect($dbLocation,
                            $dbUsername,
                            $dbPassword,
                            $dbName);

        if (mysqli_connect_errno() || ($db == null))
        {
            printf("Database connection failed: %s<br>
                  Connection script now terminating.",
                  mysqli_connect_error());
            exit(0);
        }

      ?>
    </header>
      <p >
        <?php
    
          if (emailAlreadyExists($db, $_POST['firstName']))
          {
              echo "<h3>email has been registered already.</h3>";
          }
          else
          {

              $query = "INSERT INTO Customers(Email, FirstName, LastName, Company, Phone, Message, Rating) VALUES ('$_POST[Email]',  '$_POST[firstName]','$_POST[lastName]','$_POST[company]','$_POST[phoneNumber]','$_POST[extraInfo]','$_POST[rating]');"; 
              $success = mysqli_query($db, $query);
                      echo "<h3>Thank you for registering </h3>";
          }

          mysqli_close($db);
          function emailAlreadyExists($db, $email)
          {
              $query =
                "SELECT *
                FROM Customers 
                WHERE Email = '$email'";
              $customers = mysqli_query($db, $query);
              $numRecords = mysqli_num_rows($customers);

              return ($numRecords > 0) ? true : false;
          }
          

    
        ?>
      </p>
  </body>
</html>
