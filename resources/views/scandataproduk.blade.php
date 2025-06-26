<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scan Data Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">

    <div class="row">
        <div class="col-md-8">
            <input type="text" id="barcodeInput" class="form-control mb-3"
                placeholder="Barcode (hasil scan muncul disini)" autofocus>

            <table class="table table-bordered" style="width: 100%;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>SKU</th>
                        <th>Price</th>
                        <th style="width: 15%;">Qty</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="cartTableBody"></tbody>
                <tfoot>
                    <tr>
                        <td colspan="6" class="text-end"><strong>Sum Total:</strong></td>
                        <td id="sumTotal">Rp 0</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="col-md-4">
            <p><strong>Product Code:</strong> <span id="productCode"></span></p>
            <p><strong>Nama:</strong> <span id="productName"></span></p>
            <p><strong>SKU:</strong> <span id="productSku"></span></p>
            <p><strong>Harga:</strong> <span id="productPrice"></span></p>
            <p><strong>Deskripsi:</strong> <span id="productDescription"></span></p>
            <img id="productImage" src="" style="max-width: 60%; height: auto;" alt="">
        </div>
    </div>

    <script>
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        function saveCart() {
            localStorage.setItem('cart', JSON.stringify(cart));
        }

        function updateCartTable() {
            const tbody = document.getElementById('cartTableBody');
            tbody.innerHTML = '';
            let total = 0;

            cart.forEach((item, index) => {
                const subtotal = item.price * item.qty;
                total += subtotal;

                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${index + 1}</td>
                    <td>${item.name}</td>
                    <td>${item.sku}</td>
                    <td>Rp ${item.price.toLocaleString()}</td>
                    <td>
                        <input type="number" min="1" value="${item.qty}" data-index="${index}" class="form-control qty-input">
                    </td>
                    <td>Rp ${subtotal.toLocaleString()}</td>
                    <td>
                        <button class="btn btn-sm btn-danger delete-btn" data-index="${index}">Hapus</button>
                    </td>
                `;
                tbody.appendChild(row);
            });

            document.getElementById('sumTotal').textContent = `Rp ${total.toLocaleString()}`;
            saveCart();
        }

        document.addEventListener('input', function (e) {
            if (e.target.classList.contains('qty-input')) {
                const index = e.target.getAttribute('data-index');
                cart[index].qty = parseInt(e.target.value) || 1;
                updateCartTable();
            }
        });

        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('delete-btn')) {
                const index = e.target.getAttribute('data-index');
                cart.splice(index, 1);
                updateCartTable();
            }
        });

        document.getElementById('barcodeInput').addEventListener('keypress', function (e) {
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

                        const existingIndex = cart.findIndex(item => item.sku === p.sku);
                        if (existingIndex !== -1) {
                            cart[existingIndex].qty += 1;
                        } else {
                            cart.push({
                                name: p.name,
                                sku: p.sku,
                                price: p.price,
                                qty: 1
                            });
                        }

                        updateCartTable();

                        // Tampilkan info produk di sisi kanan
                        document.getElementById('productCode').textContent = data.code;
                        document.getElementById('productName').textContent = p.name;
                        document.getElementById('productSku').textContent = p.sku;
                        document.getElementById('productPrice').textContent = 'Rp ' + parseInt(p.price).toLocaleString();
                        document.getElementById('productDescription').textContent = p.description;
                        document.getElementById('productImage').src = p.image;

                        this.value = '';
                    } else {
                        alert(data.message);
                    }
                })
                .catch(err => console.error(err));
            }
        });

        // Fokuskan ke input dan tampilkan cart saat halaman dimuat
        window.onload = function () {
            document.getElementById('barcodeInput').focus();
            updateCartTable();
        }
    </script>

</body>
</html>
