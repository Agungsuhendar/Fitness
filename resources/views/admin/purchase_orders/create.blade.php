@extends('admin.layout')

@section('title', 'Terbitkan Surat PO Supplier Baru - Admin FitLife Center')
@section('header_title', 'Terbitkan Surat Pesanan Pembelian PO Supplier')

@section('admin_content')
<div style="width: 100%;">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.75rem; flex-wrap: wrap; gap: 1rem;">
        <div>
            <h3 style="font-size: 1.5rem; color: #ffffff; margin: 0 0 0.25rem; font-weight: 900; font-family: 'Outfit', sans-serif;">
                📝 Form Surat Pesanan PO Supplier Baru
            </h3>
            <p style="color: #94a3b8; font-size: 0.9rem; margin: 0;">
                Pilih supplier dari daftar atau tambah suplier baru. Saat fisik barang diterima, HPP Moving Average &amp; stok akan otomatis terhitung.
            </p>
        </div>

        <a href="{{ route('admin.purchase-orders.index') }}" class="btn" style="background: rgba(255,255,255,0.08); color: white; border: 1px solid rgba(255,255,255,0.2); border-radius: 99px; font-weight: 800; text-decoration: none; padding: 0.65rem 1.35rem;">
            ← Kembali ke Daftar PO
        </a>
    </div>

    <form action="{{ route('admin.purchase-orders.store') }}" method="POST" id="createPoForm">
        @csrf

        <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 1.75rem;" class="grid-2">
            
            <!-- Vendor Info Card -->
            <div style="background: #0d1410; border: 1.5px solid rgba(255,255,255,0.1); border-radius: 1.5rem; padding: 1.5rem;">
                <h4 style="font-size: 1.1rem; color: #84cc16; margin-bottom: 1.25rem; font-weight: 900; font-family: 'Outfit', sans-serif;">
                    🚚 Data Supplier / Vendor
                </h4>

                <div style="margin-bottom: 1.15rem;">
                    <label style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; display: block; margin-bottom: 0.35rem;">NOMOR DOKUMEN PO *</label>
                    <input type="text" name="po_number" value="{{ $nextPoNo }}" required class="form-control bg-dark text-white border-secondary fw-bold">
                </div>

                <div style="margin-bottom: 1.15rem;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.35rem;">
                        <label style="font-size: 0.775rem; font-weight: 800; color: #84cc16; margin: 0;">NAMA SUPPLIER / VENDOR *</label>
                        <button type="button" onclick="openAddSupplierModal()" style="background: rgba(132, 204, 22, 0.2); color: #84cc16; border: 1px solid #84cc16; padding: 0.2rem 0.6rem; border-radius: 6px; font-weight: 900; font-size: 0.725rem; cursor: pointer;">
                            + Tambah Suplier Baru
                        </button>
                    </div>

                    <select name="supplier_name" id="supplierSelect" onchange="handleSupplierChange(this)" required class="form-select bg-dark text-white border-secondary fw-bold" style="color: #84cc16 !important;">
                        <option value="">-- Pilih Vendor / Suplier --</option>
                        @foreach($suppliers as $sup)
                            <option value="{{ $sup->name }}" data-phone="{{ $sup->phone }}">{{ $sup->name }} {{ $sup->phone ? '('.$sup->phone.')' : '' }}</option>
                        @endforeach
                        <option value="__add_new__" style="color: #84cc16; font-weight: 900;">➕ + Tambah Suplier Baru...</option>
                    </select>
                </div>

                <div style="margin-bottom: 1.15rem;">
                    <label style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; display: block; margin-bottom: 0.35rem;">NO. WHATSAPP SUPPLIER</label>
                    <input type="text" name="supplier_phone" id="supplierPhoneInput" placeholder="081234567890" class="form-control bg-dark text-white border-secondary fw-bold">
                </div>

                <div style="margin-bottom: 1.15rem;">
                    <label style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; display: block; margin-bottom: 0.35rem;">TANGGAL PEMESANAN *</label>
                    <input type="date" name="order_date" value="{{ date('Y-m-d') }}" required class="form-control bg-dark text-white border-secondary fw-bold">
                </div>

                <div style="margin-bottom: 1.15rem;">
                    <label style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; display: block; margin-bottom: 0.35rem;">STATUS PEMBAYARAN SUPPLIER *</label>
                    <select name="payment_status" class="form-select bg-dark text-white border-secondary fw-bold">
                        <option value="unpaid">🔴 Belum Dibayar (Tempo / Kredit)</option>
                        <option value="paid" selected>🟢 Sudah Lunas (Cash / Transfer Direct)</option>
                    </select>
                </div>

                <div style="margin-bottom: 1rem;">
                    <label style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; display: block; margin-bottom: 0.35rem;">CATATAN DOKUMEN PO</label>
                    <textarea name="notes" rows="3" class="form-control bg-dark text-white border-secondary" placeholder="Catatan syarat pengiriman atau nomor rekening vendor..."></textarea>
                </div>
            </div>

            <!-- Items Form Card -->
            <div style="background: #0d1410; border: 1.5px solid rgba(255,255,255,0.1); border-radius: 1.5rem; padding: 1.5rem; display: flex; flex-direction: column; justify-content: space-between;">
                <div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
                        <h4 style="font-size: 1.1rem; color: #38bdf8; margin: 0; font-weight: 900; font-family: 'Outfit', sans-serif;">
                            📦 Rincian Barang &amp; Harga Modal PO
                        </h4>
                        <button type="button" onclick="addPoRow()" style="background: rgba(132, 204, 22, 0.2); color: #84cc16; border: 1px solid #84cc16; padding: 0.4rem 0.85rem; border-radius: 8px; font-weight: 800; font-size: 0.8rem; cursor: pointer;">
                            + Tambah Item Barang
                        </button>
                    </div>

                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.85rem;" id="poItemsTable">
                            <thead>
                                <tr style="border-bottom: 1px solid rgba(255,255,255,0.1); color: #94a3b8; font-size: 0.75rem; text-transform: uppercase;">
                                    <th style="padding: 0.75rem;">Pilih Produk Kasir</th>
                                    <th style="padding: 0.75rem; width: 100px;">Jumlah Qty</th>
                                    <th style="padding: 0.75rem; width: 140px;">Harga Modal (HPP)</th>
                                    <th style="padding: 0.75rem; width: 140px;">Subtotal (Rp)</th>
                                    <th style="padding: 0.75rem; width: 40px;"></th>
                                </tr>
                            </thead>
                            <tbody id="poRowsBody">
                                <tr>
                                    <td style="padding: 0.75rem;">
                                        <select name="items[0][product_id]" required class="form-select bg-dark text-white border-secondary fw-bold" onchange="updateRowSubtotal(this)">
                                            <option value="">-- Pilih Produk --</option>
                                            @foreach($products as $p)
                                                <option value="{{ $p->id }}" data-cost="{{ (int)$p->cost_price }}">{{ $p->name }} (HPP Lama: Rp {{ number_format($p->cost_price, 0, ',', '.') }})</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td style="padding: 0.75rem;">
                                        <input type="number" name="items[0][qty_ordered]" value="10" min="1" required class="form-control bg-dark text-white border-secondary fw-bold" oninput="updateRowSubtotal(this)">
                                    </td>
                                    <td style="padding: 0.75rem;">
                                        <input type="number" name="items[0][cost_price]" value="10000" min="0" required class="form-control bg-dark text-white border-secondary fw-bold" oninput="updateRowSubtotal(this)">
                                    </td>
                                    <td style="padding: 0.75rem; font-weight: 900; color: #84cc16;" class="row-subtotal">
                                        Rp 100.000
                                    </td>
                                    <td style="padding: 0.75rem; text-align: center;">
                                        <button type="button" onclick="removePoRow(this)" style="background: none; border: none; color: #ef4444; font-size: 1.1rem; cursor: pointer;">&times;</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div style="border-top: 1px solid rgba(255,255,255,0.1); padding-top: 1.25rem; margin-top: 1.5rem; display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <span style="font-size: 0.8rem; color: #94a3b8; display: block;">TOTAL ESTIMASI PEMBELIAN PO:</span>
                        <div style="font-size: 1.75rem; font-weight: 900; color: #84cc16; font-family: 'Outfit', sans-serif;" id="grandTotalPo">
                            Rp 100.000
                        </div>
                    </div>

                    <button type="submit" class="btn glow-btn" style="background: linear-gradient(135deg, #84cc16 0%, #22c55e 100%); color: #060907 !important; border: none; padding: 0.9rem 2rem; border-radius: 99px; font-weight: 900; font-size: 1rem; cursor: pointer;">
                        🚀 TERBITKAN SURAT PO SUPPLIER
                    </button>
                </div>
            </div>

        </div>
    </form>

</div>

<!-- Modal Tambah Suplier Baru -->
<div class="modal fade" id="addSupplierModal" tabindex="-1" aria-hidden="true" style="background: rgba(0,0,0,0.85);">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background: #0d1410; border: 1.5px solid rgba(132, 204, 22, 0.4); border-radius: 1.25rem; color: white;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                <h5 class="modal-title" style="font-size: 1.15rem; font-weight: 900; color: #ffffff; margin: 0; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-truck-field" style="color: #84cc16;"></i> Tambah Suplier / Vendor Baru
                </h5>
                <button type="button" class="btn-close btn-close-white" onclick="closeAddSupplierModal()"></button>
            </div>
            <form id="ajaxSupplierForm" onsubmit="submitNewSupplierAjax(event)">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #84cc16; text-transform: uppercase;">NAMA VENDOR / SUPPLIER *</label>
                        <input type="text" id="modalSupName" placeholder="e.g. PT Distributor Mineral Utama" required class="form-control bg-dark text-white border-secondary fw-bold">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">NO. WHATSAPP / TELEPON</label>
                        <input type="text" id="modalSupPhone" placeholder="081234567890" class="form-control bg-dark text-white border-secondary fw-bold">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">EMAIL VENDOR (OPSIONAL)</label>
                        <input type="email" id="modalSupEmail" placeholder="vendor@supplier.com" class="form-control bg-dark text-white border-secondary fw-bold">
                    </div>
                    <div class="mb-2">
                        <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">ALAMAT GUDANG VENDOR</label>
                        <textarea id="modalSupAddress" rows="2" placeholder="Jl. Magelang KM 7, Sleman..." class="form-control bg-dark text-white border-secondary"></textarea>
                    </div>
                </div>

                <div class="modal-footer" style="border-top: 1px solid rgba(255,255,255,0.1);">
                    <button type="button" class="btn btn-secondary" onclick="closeAddSupplierModal()" style="border-radius: 0.65rem; font-weight: 700;">Batal</button>
                    <button type="submit" id="saveSupBtn" class="btn btn-lime" style="border-radius: 0.65rem; font-weight: 900; padding: 0.5rem 1.35rem;">
                        <i class="fa-solid fa-plus-circle"></i> Simpan &amp; Pilih Suplier Ini
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let rowIndex = 1;
    const productsJson = @json($products);

    function handleSupplierChange(select) {
        if (select.value === '__add_new__') {
            openAddSupplierModal();
            select.value = '';
            return;
        }

        const selectedOpt = select.options[select.selectedIndex];
        const phone = selectedOpt.getAttribute('data-phone');
        if (phone) {
            document.getElementById('supplierPhoneInput').value = phone;
        }
    }

    function openAddSupplierModal() {
        const modalEl = document.getElementById('addSupplierModal');
        if (modalEl) {
            modalEl.classList.add('show');
            modalEl.style.display = 'block';
        }
    }

    function closeAddSupplierModal() {
        const modalEl = document.getElementById('addSupplierModal');
        if (modalEl) {
            modalEl.classList.remove('show');
            modalEl.style.display = 'none';
        }
    }

    function submitNewSupplierAjax(e) {
        e.preventDefault();
        const saveBtn = document.getElementById('saveSupBtn');
        saveBtn.disabled = true;
        saveBtn.innerText = 'Menyimpan...';

        const name = document.getElementById('modalSupName').value;
        const phone = document.getElementById('modalSupPhone').value;
        const email = document.getElementById('modalSupEmail').value;
        const address = document.getElementById('modalSupAddress').value;

        fetch('/admin/suppliers', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ name, phone, email, address })
        })
        .then(res => res.json())
        .then(data => {
            saveBtn.disabled = false;
            saveBtn.innerHTML = '<i class="fa-solid fa-plus-circle"></i> Simpan &amp; Pilih Suplier Ini';
            if (data.success && data.supplier) {
                const select = document.getElementById('supplierSelect');
                const newOpt = document.createElement('option');
                newOpt.value = data.supplier.name;
                newOpt.text = data.supplier.name + (data.supplier.phone ? ' (' + data.supplier.phone + ')' : '');
                newOpt.setAttribute('data-phone', data.supplier.phone || '');
                newOpt.selected = true;

                const addNewOpt = select.querySelector('option[value="__add_new__"]');
                select.insertBefore(newOpt, addNewOpt);

                if (data.supplier.phone) {
                    document.getElementById('supplierPhoneInput').value = data.supplier.phone;
                }

                closeAddSupplierModal();
                alert('Suplier "' + data.supplier.name + '" berhasil ditambahkan & terpilih!');
            } else {
                alert('Gagal menambahkan suplier.');
            }
        })
        .catch(err => {
            saveBtn.disabled = false;
            saveBtn.innerHTML = '<i class="fa-solid fa-plus-circle"></i> Simpan &amp; Pilih Suplier Ini';
            alert('Terjadi kesalahan saat menyimmpan suplier.');
        });
    }

    function addPoRow() {
        const tbody = document.getElementById('poRowsBody');
        let optionsHtml = '<option value="">-- Pilih Produk --</option>';
        productsJson.forEach(p => {
            optionsHtml += `<option value="${p.id}" data-cost="${parseInt(p.cost_price || 0)}">${p.name} (HPP Lama: Rp ${parseInt(p.cost_price || 0).toLocaleString('id-ID')})</option>`;
        });

        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td style="padding: 0.75rem;">
                <select name="items[${rowIndex}][product_id]" required class="form-select bg-dark text-white border-secondary fw-bold" onchange="updateRowSubtotal(this)">
                    ${optionsHtml}
                </select>
            </td>
            <td style="padding: 0.75rem;">
                <input type="number" name="items[${rowIndex}][qty_ordered]" value="10" min="1" required class="form-control bg-dark text-white border-secondary fw-bold" oninput="updateRowSubtotal(this)">
            </td>
            <td style="padding: 0.75rem;">
                <input type="number" name="items[${rowIndex}][cost_price]" value="10000" min="0" required class="form-control bg-dark text-white border-secondary fw-bold" oninput="updateRowSubtotal(this)">
            </td>
            <td style="padding: 0.75rem; font-weight: 900; color: #84cc16;" class="row-subtotal">
                Rp 100.000
            </td>
            <td style="padding: 0.75rem; text-align: center;">
                <button type="button" onclick="removePoRow(this)" style="background: none; border: none; color: #ef4444; font-size: 1.1rem; cursor: pointer;">&times;</button>
            </td>
        `;
        tbody.appendChild(tr);
        rowIndex++;
        calculateGrandTotal();
    }

    function removePoRow(btn) {
        const row = btn.closest('tr');
        if (document.querySelectorAll('#poRowsBody tr').length > 1) {
            row.remove();
            calculateGrandTotal();
        } else {
            alert('Minimal 1 item barang dalam PO!');
        }
    }

    function updateRowSubtotal(input) {
        const row = input.closest('tr');
        const select = row.querySelector('select');
        const qtyInput = row.querySelector('input[name*="[qty_ordered]"]');
        const costInput = row.querySelector('input[name*="[cost_price]"]');
        const subtotalEl = row.querySelector('.row-subtotal');

        if (input.tagName === 'SELECT') {
            const selectedOpt = select.options[select.selectedIndex];
            const defaultCost = selectedOpt.getAttribute('data-cost');
            if (defaultCost) {
                costInput.value = defaultCost;
            }
        }

        const qty = parseInt(qtyInput.value) || 0;
        const cost = parseFloat(costInput.value) || 0;
        const subtotal = qty * cost;

        subtotalEl.innerText = 'Rp ' + subtotal.toLocaleString('id-ID');
        calculateGrandTotal();
    }

    function calculateGrandTotal() {
        let total = 0;
        document.querySelectorAll('#poRowsBody tr').forEach(row => {
            const qty = parseInt(row.querySelector('input[name*="[qty_ordered]"]').value) || 0;
            const cost = parseFloat(row.querySelector('input[name*="[cost_price]"]').value) || 0;
            total += (qty * cost);
        });

        document.getElementById('grandTotalPo').innerText = 'Rp ' + total.toLocaleString('id-ID');
    }

    document.addEventListener('DOMContentLoaded', calculateGrandTotal);
</script>
@endsection
