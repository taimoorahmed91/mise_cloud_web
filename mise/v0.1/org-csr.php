<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the form submitted is for CSR generation
    if (isset($_POST['generateCSR'])) {
        // Retrieve the form parameters
        $commonName = $_POST['commonName'];
        $organization = $_POST['organization'];
        $organizationalUnit = $_POST['organizationalUnit'];
        $country = $_POST['country'];
        $state = $_POST['state'];
        $city = $_POST['city'];
        $email = $_POST['email'];
        $san = $_POST['san'];

        // Generate the CSR
        $dn = [
            'commonName' => $commonName,
            'organizationName' => $organization,
            'organizationalUnitName' => $organizationalUnit,
            'countryName' => $country,
            'stateOrProvinceName' => $state,
            'localityName' => $city,
            'emailAddress' => $email
        ];

        // Add Subject Alternative Names (SAN)
        if (!empty($san)) {
            $san = explode(',', $san);
            $san = array_map('trim', $san);
            $san = array_filter($san);
            if (!empty($san)) {
                $san = ['subjectAltName' => 'DNS:' . implode(', DNS:', $san)];
                $dn = array_merge($dn, $san);
            }
        }

        $privkey = openssl_pkey_new();
        $csr = openssl_csr_new($dn, $privkey, ['digest_alg' => 'sha256']);

        // Output the CSR
        $csrText = "";
        openssl_csr_export($csr, $csrText);

        echo "<h3>Generated CSR:</h3>";
        echo "<pre>" . htmlspecialchars($csrText) . "</pre>";

        // Move the CSR and private key to /etc/apache2/ssl
        $sslPath = '/etc/apache2/ssl/';
        file_put_contents($sslPath . 'csr_request.csr', $csr);
        openssl_pkey_export($privkey, $privateKey);
        file_put_contents($sslPath . 'private_key.key', $privateKey);
    } elseif (isset($_POST['uploadCert'])) {
        // Handle the uploaded certificate
        $uploadedCert = $_FILES['certificate']['tmp_name'];

        // Convert p7b to PEM format
        $certPath = 'signed_certificate.p7b';
        $pemPath = 'signed_certificate.pem';

        file_put_contents($certPath, file_get_contents($uploadedCert));
        exec("openssl pkcs7 -print_certs -in {$certPath} -out {$pemPath}");

        // Move the converted certificate to /etc/apache2/ssl
        $sslPath = '/etc/apache2/ssl/';
        rename($pemPath, $sslPath . 'signed_certificate.pem');

        // Display a success message
        echo "Signed certificate uploaded and converted to PEM format.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>CSR Generator and Certificate Upload</title>
</head>
<body>
    <h2>CSR Generator and Certificate Upload</h2>

    <h3>Generate CSR</h3>
    <form method="POST" action="" enctype="multipart/form-data">
        <label for="commonName">Common Name:</label>
        <input type="text" name="commonName" required><br><br>

        <label for="organization">Organization:</label>
        <input type="text" name="organization" required><br><br>

        <label for="organizationalUnit">Organizational Unit:</label>
        <input type="text" name="organizationalUnit"><br><br>

        <label for="country">Country:</label>
        <input type="text" name="country" required><br><br>

        <label for="state">State:</label>
        <input type="text" name="state" required><br><br>

        <label for="city">City:</label>
        <input type="text" name="city" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br><br>

        <label for="san">Subject Alternative Names (comma-separated):</label>
        <input type="text" name="san"><br><br>

        <input type="submit" name="generateCSR" value="Generate CSR">
    </form>

    <h3>Upload Certificate</h3>
    <form method="POST" action="" enctype="multipart/form-data">
        <input type="file" name="certificate" required><br><br>

        <input type="submit" name="uploadCert" value="Upload Certificate">
    </form>
</body>
</html>
