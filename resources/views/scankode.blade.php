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
            
            <!-- Add to Cart button -->
            <div id="addToCartSection" style="display: none;" class="mt-3">
                <button id="addToCartBtn" class="btn btn-success me-2">
                    Tambah ke Shopping Cart
                </button>
                <button id="goToCartBtn" class="btn btn-primary">
                    Lihat Shopping Cart
                </button>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/html5-qrcode"></script>
    <script>
        let currentProduct = null;

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
                const addToCartSection = document.getElementById('addToCartSection');

                resultCode.textContent = data.code;

                if (data.success) {
                    const product = data.product;
                    currentProduct = product;
                    
                    resultDiv.innerHTML = `
                        <div class="alert alert-success">
                            <h5>Produk Ditemukan!</h5>
                            <p><strong>Nama:</strong> ${product.name}</p>
                            <p><strong>SKU:</strong> ${product.sku}</p>
                            <p><strong>Harga:</strong> Rp ${parseInt(product.price).toLocaleString()}</p>
                            <p><strong>Deskripsi:</strong> ${product.description}</p>
                            ${product.image ? `<img src="${product.image}" style="max-width: 60%; height: auto;" class="img-fluid">` : ''}
                        </div>
                    `;
                    
                    addToCartSection.style.display = 'block';
                } else {
                    resultDiv.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
                    addToCartSection.style.display = 'none';
                }
            })
            .catch(error => {
                document.getElementById('result').innerHTML = `<div class="alert alert-danger">Terjadi kesalahan.</div>`;
                console.error('Error:', error);
            });
        }

        // Add to cart functionality
        document.getElementById('addToCartBtn').addEventListener('click', function() {
            if (!currentProduct) return;

            // Get existing cart from localStorage
            let cart = JSON.parse(localStorage.getItem('scanCart') || '[]');
            
            // Check if product already exists in cart
            const existingIndex = cart.findIndex(item => item.sku === currentProduct.sku);
            
            if (existingIndex !== -1) {
                cart[existingIndex].qty += 1;
            } else {
                cart.push({
                    name: currentProduct.name,
                    sku: currentProduct.sku,
                    price: parseFloat(currentProduct.price),
                    qty: 1
                });
            }
            
            // Save to localStorage
            localStorage.setItem('scanCart', JSON.stringify(cart));
            
            // Show success message
            const alertDiv = document.createElement('div');
            alertDiv.className = 'alert alert-success alert-dismissible fade show';
            alertDiv.innerHTML = `
                <strong>Berhasil!</strong> ${currentProduct.name} ditambahkan ke shopping cart.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            document.querySelector('.container').insertBefore(alertDiv, document.querySelector('.row'));
            
            // Auto dismiss after 3 seconds
            setTimeout(() => {
                alertDiv.remove();
            }, 3000);
        });

        // Go to cart page
        document.getElementById('goToCartBtn').addEventListener('click', function() {
            window.location.href = '/scan-data-produk';
        });

        // Inisialisasi scanner
        let html5QrcodeScanner = new Html5QrcodeScanner("reader", {
            fps: 10,
            qrbox: 250
        });
        html5QrcodeScanner.render(onScanSuccess);
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>