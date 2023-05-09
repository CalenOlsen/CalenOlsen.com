<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="variables.css">
  <link rel="stylesheet" href="header.css">
  <link rel="stylesheet" href="footer.css">
  <link rel="stylesheet" href="index.css">
  <link rel="stylesheet" href="contactMe.css">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>

  <script type="text/javascript"
          src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js">
  </script>


     <?php
     echo '<script>console.log("test")</script>';

     function saveToDB()
     {
         $dbLocation = "localhost";
         $dbUsername = "root";
         $dbPassword = "root";
         $dbName = "messages";

         if (!isset($dbLocation)) {
             echo "Database location is missing.<br>
                  Connection script now terminating.";
             exit(0);
         }

         if (!isset($dbUsername)) {
             echo "Database username is missing.<br>
                  Connection script now terminating.";
             exit(0);
         }

         if (!isset($dbPassword)) {
             echo "Database password is missing.<br>
                  Connection script now terminating.";
             exit(0);
         }

         if (!isset($dbName)) {
             echo "Database name is missing.<br>
                  Connection script now terminating.";
             exit(0);
         }

         $db = mysqli_connect($dbLocation, $dbUsername, $dbPassword, $dbName);

         if (mysqli_connect_errno() || $db == null) {
             printf(
                 "Database connection failed: %s<br>
                  Connection script now terminating.",
                 mysqli_connect_error()
             );
             exit(0);
         }

         echo '<script>console.log("save?")</script>';

         if (emailAlreadyExists($db, $_POST["email"])) {
             echo '<script>console.log("email....?")</script>';

             echo "<h3>email has been registered already.</h3>";
         } else {
             echo '<script>console.log("good!....?")</script>';

             $query = "INSERT INTO messages(Email, FirstName, LastName, Company, Phone, Message, Rating) VALUES ('$_POST[email]',  '$_POST[firstName]','$_POST[lastName]','$_POST[company]','$_POST[phoneNumber]','$_POST[extraInfo]','$_POST[rating]');";
             $success = mysqli_query($db, $query);
             echo '<script>console.log("bet")</script>';

             echo "<h3>Thank you for registering </h3>";
         }
         mysqli_close($db);
     }
     echo '<script>console.log("reset")</script>';

     if (isset($_POST["email"])) {
         echo '<script>console.log("posted")</script>';

         saveToDB();
     }

     function emailAlreadyExists($db, $email)
     {
         echo '<script>console.log("email already exist....?")</script>';

         $query = "SELECT *
                FROM messages 
                WHERE Email = '$email'";
         $customers = mysqli_query($db, $query);
         $numRecords = mysqli_num_rows($customers);

         echo '<script>console.log("not faile....?")</script>';

         return $numRecords > 0 ? true : false;
     }
     ?>

  <script type="text/javascript">
    (function () {
      emailjs.init("yh9pprloFKIdjNcJu");
    })();
  </script>

  <script type="text/javascript">
    function validateRecaptcha() {
      console.log("bet?")
      var response = grecaptcha.getResponse();
      if (response.length === 0) {
        alert("I don't want spam! Are you a human?");
        return false;
      } else {
        handleIt()
        return true;
      }
    }
  </script>

  <script type="text/javascript">

    const validateEmail = (email) => {
      return String(email)
        .toLowerCase()
        .match(
          /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        );
    };

    const validatePhoneNumber = (phoneNumber) => {
      if (inputtxt.value.match(/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/)) {
        return true;
      }
      else {
        return false;
      }
    }
    function handleIt() {
      console.log("handle?")
      let firstName = document.forms["contactme"]["firstName"].value;
      let lastName = document.forms["contactme"]["lastName"].value;
      let company = document.forms["contactme"]["company"].value;
      let email = document.forms["contactme"]["email"].value;
      let phoneNumber = document.forms["contactme"]["phoneNumber"].value;
      let extraInfo = document.forms["contactme"]["extraInfo"].value;

      let contactNote = ""

      let emailValid = false
      if (validateEmail(email)) {
        emailValid = true
      } else {
        alert("You have entered an invalid email address!")
        return;
      }

      //phone number validation later
      // let phoneValid = false
      // if (validateEmail(phoneNumber)) {
      //     emailValid = true
      // }else{
      //     alert("You have entered an invalid Phone Number!")
      //     return;
      // }

      if (emailValid) {
        contactNote = "Thank you for leaving a email I will reach out to either " + phoneNumber + " or " + email + "."
      }

      var rating = ""
      var ele = document.getElementsByName('rating');

      for (i = 0; i < ele.length; i++) {
        if (ele[i].checked)
          rating = "Thank you for the " + ele[i].value + " star rating";
      }

      emailjs.send("service_27qhbqg", "template_evb3g9v", {
        from_name: firstName +" " + lastName,
        company: company,
        email: email,
        phoneNumber: phoneNumber,
        extraInfo: extraInfo,
        stars: rating,
      });    

     

        alert("Thank you for leaving a message I will hopefully get in touch soon");

      console.log("testing: ");
    }
  </script>

  <script>
    function changeTheme(selectedTheme) {
      console.log(selectedTheme);

      var element = document.body;
      if (selectedTheme == 0) {
        element.className = "";
      } else if (selectedTheme == 1) {
        element.className = "light-mode"
      }

      console.log(element.classList)

    }
  </script>

</head>

<body>

    <header class="header-wrapper sticky">
        <div class="name">
            <a style="text-decoration:none" href="./index.html">
                Calen Olsen
            </a>
        </div>
        <div class="extra-info">
            <div class="experience">
                <a style="text-decoration:none" href="./index.html">
                    Experince
                </a>
            </div>
            <div class="education">
                <a style="text-decoration:none" href="./index.html">
                    Education
                </a>
            </div>
            <div class="skills">
                <a style="text-decoration:none" href="./index.html">
                    Skill
                </a>
            </div>
            <div class="contact-me">
                <a style="text-decoration:none" href="./contactMe.php">
                    Contact Me
                </a>
            </div>
            <div class="about-me">
                <a style="text-decoration:none" href="./index.html">
                    About Me
                </a>
            </div>
            <div>
                <label>Change theme</label>
                <select onchange="changeTheme(this.selectedIndex);" onfocus="this.selectedIndex = -1;">
                    <option>Dark</option>
                    <option>Light</option>
                </select>
            </div>
        </div>
    </header>


    <div class="content-wrapper-wrapper">
        <div class="content-wrapper">
            <h2>
                Like what you see? Send me an automated email with some contact info and I will reach out to you soon!
            </h2>
            <form name="contactme" id="contactme" method="post" action="contactMe.php" onsubmit="return validateRecaptcha();">
                <div class="contact-info">
                    <p>About you</p>
                    <label>First Name:</label>
                    <input name="firstName" type="text">
                    <label>Last Name:</label>
                    <input name="lastName" type="text">
                    <label>Company:</label>
                    <input name="company" type="text">
                </div>

                <div class="contact-info">
                    <p>Contact Info</p>
                    <label>Email:</label>
                    <input name="email" type="text">
                    <label>Phone Number:</label>
                    <input name="phoneNumber" type="text">
                </div>
                <div class="contact-info" style="flex-direction: column;">
                    <p>Extras</p>
                    <div style="align-items: center;">
                        <label>Extra Info:</label>
                        <textarea name="extraInfo" type="text"></textarea>
                    </div>
                    <div>
                        <label>Rate the site:</label>
                        <input type="radio" id="1star" name="rating" value="1">
                        <label for="age1">1 star</label>
                        <input type="radio" id="2star" name="rating" value="2">
                        <label for="age1">2 stars</label>
                        <input type="radio" id="3star" name="rating" value="3">
                        <label for="age1">3 stars</label>
                        <input type="radio" id="4star" name="rating" value="4">
                        <label for="age1">4 stars</label>
                        <input type="radio" id="5star" name="rating" value="5">
                        <label for="age1">5 stars</label>
                    </div>
                </div>
                <div class="g-recaptcha" data-sitekey="6LfbNeAlAAAAAB2QUnw2OqOpWVeGr9S_2vX8R2vJ"></div>
                <div>
                    <input type="submit" value="Reach Out" class="submit">
                </div>
            </form>
        </div>
    </div>

    <footer>
        <table class="footer-table">
            <tr>
                <td>
                    Calen Olsen
                </td>
                <td>
                    University of Nebraska Linoln
                </td>
                <td>
                    Established 2000
                </td>
            </tr>
        </table>
    </footer>

</body>

</html>