<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan Data Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Scan Data Produk - Shopping Cart</h1>
        
        <div class="row">
            <div class="col-md-8">
                <div class="mb-3">
                    <label for="barcodeInput" class="form-label">Barcode Scanner Input</label>
                    <input type="text" id="barcodeInput" class="form-control" 
                           placeholder="Scan barcode atau ketik manual (tekan Enter)" autofocus>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5>Shopping Cart</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>SKU</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Subtotal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="cartTableBody">
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">
                                            Cart kosong. Scan produk untuk menambahkan.
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5" class="text-end"><strong>Total:</strong></td>
                                        <td id="sumTotal" class="fw-bold">Rp 0</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Detail Produk</h5>
                    </div>
                    <div class="card-body">
                        <div id="productDetails">
                            <p><strong>Product Code:</strong> <span id="productCode">-</span></p>
                            <p><strong>Nama:</strong> <span id="productName">-</span></p>
                            <p><strong>SKU:</strong> <span id="productSku">-</span></p>
                            <p><strong>Harga:</strong> <span id="productPrice">-</span></p>
                            <p><strong>Deskripsi:</strong> <span id="productDescription">-</span></p>
                            <div class="text-center">
                                <img id="productImage" src="" style="max-width: 100%; height: auto; display: none;" alt="Product Image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let cart = [];

        function updateCartTable() {
            const tbody = document.getElementById('cartTableBody');
            tbody.innerHTML = '';
            let total = 0;

            if (cart.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="7" class="text-center text-muted">
                            Cart kosong. Scan produk untuk menambahkan.
                        </td>
                    </tr>
                `;
            } else {
                cart.forEach((item, index) => {
                    const subtotal = item.price * item.qty;
                    total += subtotal;

                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${index + 1}</td>
                        <td>${item.name}</td>
                        <td>${item.sku}</td>
                        <td>Rp ${parseFloat(item.price).toLocaleString('id-ID')}</td>
                        <td>
                            <input type="number" min="1" value="${item.qty}" 
                                   data-index="${index}" class="form-control qty-input" style="width: 80px;">
                        </td>
                        <td>Rp ${subtotal.toLocaleString('id-ID')}</td>
                        <td>
                            <button class="btn btn-sm btn-danger delete-btn" data-index="${index}">
                                Hapus
                            </button>
                        </td>
                    `;
                    tbody.appendChild(row);
                });
            }

            document.getElementById('sumTotal').textContent = `Rp ${total.toLocaleString('id-ID')}`;
        }

        // Event listeners
        document.addEventListener('input', function(e) {
            if (e.target.classList.contains('qty-input')) {
                const index = e.target.getAttribute('data-index');
                const newQty = parseInt(e.target.value) || 1;
                cart[index].qty = newQty;
                updateCartTable();
            }
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('delete-btn')) {
                const index = e.target.getAttribute('data-index');
                cart.splice(index, 1);
                updateCartTable();
            }
        });

        document.getElementById('barcodeInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                const code = this.value.trim();
                if (code === '') return;

                fetch('/scan-produk', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ code })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        const p = data.product;

                        // Check if product already exists in cart
                        const existingIndex = cart.findIndex(item => item.sku === p.sku);
                        if (existingIndex !== -1) {
                            cart[existingIndex].qty += 1;
                        } else {
                            cart.push({
                                name: p.name,
                                sku: p.sku,
                                price: parseFloat(p.price),
                                qty: 1
                            });
                        }

                        updateCartTable();

                        // Display product details
                        document.getElementById('productCode').textContent = data.code;
                        document.getElementById('productName').textContent = p.name;
                        document.getElementById('productSku').textContent = p.sku;
                        document.getElementById('productPrice').textContent = 
                            'Rp ' + parseFloat(p.price).toLocaleString('id-ID');
                        document.getElementById('productDescription').textContent = p.description;
                        
                        const imgElement = document.getElementById('productImage');
                        if (p.image) {
                            imgElement.src = p.image;
                            imgElement.style.display = 'block';
                        } else {
                            imgElement.style.display = 'none';
                        }

                        this.value = '';
                    } else {
                        alert(data.message);
                        this.value = '';
                    }
                })
                .catch(err => {
                    console.error('Error:', err);
                    alert('Terjadi kesalahan saat memproses scan');
                });
            }
        });

        // Focus on input when page loads
        window.onload = function() {
            document.getElementById('barcodeInput').focus();
            updateCartTable();
        };
    </script>
</body>
</html>