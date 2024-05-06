<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice Pemesanan Tiket Konser</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    .container {
      width: 80%;
      margin: 20px auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      border: 2px solid #007bff;
    }

    h1 {
      text-align: center;
      color: #007bff;
    }

    .invoice-details {
      margin-bottom: 20px;
    }

    .invoice-details p {
      margin: 5px 0;
    }

    .button {
      display: inline-block;
      padding: 10px 20px;
      margin-top: 20px;
      background-color: #007bff;
      color: #fff;
      text-decoration: none;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .button:hover {
      background-color: #0056b3;
    }

    footer {
      text-align: center;
      margin-top: 20px;
      color: green;
      clear: both;
      /* Menjadikan footer tetap di bawah */
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>Invoice Pemesanan Tiket Konser</h1>
    <div class="invoice-details">
      <?php
      // Memeriksa apakah parameter email telah diterima
      if (isset($_GET['email'])) {
        $email = $_GET['email'];

        // Query untuk mendapatkan data pemesanan berdasarkan email
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "konser";

        // Membuat koneksi
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Memeriksa koneksi
        if ($conn->connect_error) {
          die("Koneksi gagal: " . $conn->connect_error);
        }

        // Query untuk mendapatkan data pemesanan berdasarkan email
        $sql = "SELECT * FROM booking WHERE email='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          // Output data pemesanan dalam bentuk detail invoice
          while ($row = $result->fetch_assoc()) {
            echo "<p><strong>Nama:</strong> " . $row["name"] . "</p>";
            echo "<p><strong>E-mail:</strong> " . $row["email"] . "</p>";
            echo "<p><strong>Nomor Telepon:</strong> " . $row["phone"] . "</p>";
            echo "<p><strong>Konser:</strong> " . $row["concert"] . "</p>";
            echo "<p><strong>Jenis Tiket:</strong> " . $row["ticket_type"] . "</p>";
            echo "<p><strong>Jumlah Tiket:</strong> " . $row["quantity"] . "</p>";
          }
        } else {
          echo "Data pemesanan tidak ditemukan.";
        }

        // Menutup koneksi
        $conn->close();
      } else {
        echo "Parameter email tidak ditemukan.";
      }
      ?>
    </div>
    <footer>Terima Kasih Telah Memesan Tiket!</footer>
    <a href="tampilForm.php" class="button">Kembali</a>
  </div>
</body>

</html>