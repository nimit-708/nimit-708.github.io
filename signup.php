<?php
// DB2 database connection parameters
$db2Host = '21fecfd8-47b7-4937-840d-d791d0218660.bs2io90l08kqb1od8lcg.databases.appdomain.cloud';
$db2Username = 'gbs82092';
$db2Password = 'rXKQDfVuHXQxruG4';
$dbName = 'bludb';

// Data from the form
$firstname = $_POST['first_name'];
$lastname = $_POST['last_name']
$phone = $_POST['phone_number']
$email = $_POST['email'];
$passwordGiven = $_POST['password']
$address1 = $_POST['address1']
$address2 = $_POST['address2']
$city = $_POST['city']
$postcode = $_POST['postcode']

try {
    // Connect to the DB2 database
    $conn = new PDO("ibm:DRIVER={IBM DB2 ODBC DRIVER};DATABASE=$dbName;HOSTNAME=$db2Host;PORT=31864;PROTOCOL=TCPIP;", $db2Username, $db2Password);

    // Set error mode to exceptions
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL query to insert data into the DB2 table
    $sql = "INSERT INTO CUSTOMERINFO (FIRSTNAME, LASTNAME,PHONENUMBER, EMAIL, PASSWORD_HASH, ADDRESS_LINE_1, ADDRESS_LINE_2,CITY,POSTCODE) VALUES (:firstname, :lastname, :phone, :email, :passwordGiven, :address1, :address2, :city, :postcode)";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':passwordGiven', $passwordGiven);
    $stmt->bindParam(':address1', $address1);
    $stmt->bindParam(':address2', $address2);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':postcode', $postcode);

    // Execute the query
    $stmt->execute();

    // Close the database connection
    $conn = null;

    // Redirect back to the form with a success message
    header('Location: form.html?success=1');
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
