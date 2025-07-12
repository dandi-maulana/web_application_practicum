<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barcode Scan Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">

    <h1 class="mb-4">Scan Barcode / QR Code</h1>

    <div class="row">
        <div class="col-md-6">
            <div id="reader" style="width: 100%;"></div>
        </div>
        <div class="col-md-6">
            <p>Product Code: <span id="code" class="fw-bold"></span></p>
            <div id="result" class="mt-3"></div>
        </div>
    </div>

    <script src="https://unpkg.com/html5-qrcode"></script>
    <script>
        function onScanSuccess(decodedText, decodedResult) {
            fetch('/scan', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    code: decodedText
                })
            })
            .then(response => response.json())
            .then(data => {
                const resultDiv = document.getElementById('result');
                const resultCode = document.getElementById('code');

                resultCode.textContent = data.code;

                if (data.success) {
                    const product = data.product;
                    resultDiv.innerHTML = `
                        <p><strong>Nama:</strong> ${product.name}</p>
                        <p><strong>SKU:</strong> ${product.sku}</p>
                        <p><strong>Harga:</strong> Rp ${parseInt(product.price).toLocaleString()}</p>
                        <p><strong>Deskripsi:</strong> ${product.description}</p>
                        <img src="${product.image}" style="max-width: 60%; height: auto;">
                    `;
                } else {
                    resultDiv.innerHTML = `<p class="text-danger">${data.message}</p>`;
                }
            })
            .catch(error => {
                document.getElementById('result').innerHTML = `<p class="text-danger">Terjadi kesalahan.</p>`;
                console.error('Error:', error);
            });
        }

        // Inisialisasi scanner
        let html5QrcodeScanner = new Html5QrcodeScanner("reader", {
            fps: 10,
            qrbox: 250
        });
        html5QrcodeScanner.render(onScanSuccess);
    </script>

</body>
</html>
