{{-- resources/views/transaction/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Kasir Laundry')

@section('content')
<div class="container py-3">

    
    <h5 class="mb-3">Tambah Order</h5>
    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('transaction.store') }}" method="POST" id="kasir-form">
        @csrf

        <div class="row">

            {{-- ================= LEFT ================= --}}
            <div class="col-md-8">

                {{-- CUSTOMER --}}
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Tipe Customer</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="customer_type" id="type_member" value="member" checked>
                                    <label class="form-check-label" for="type_member">Member</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="customer_type" id="type_guest" value="guest">
                                    <label class="form-check-label" for="type_guest">Bukan Member</label>
                                </div>
                            </div>
                        </div>

                        <div id="member_section">
                            <label>Pilih Member</label>
                            <select name="customer_id" id="customer_id" class="form-control">
                                <option value="">-- Pilih Customer --</option>
                                @foreach($customers as $c)
                                    <option value="{{ $c->id }}" data-isnew="{{ $c->is_new_member ? '1' : '0' }}">
                                        {{ $c->customer_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div id="guest_section" style="display:none;">
                            <div class="mb-2">
                                <label>Nama Lengkap</label>
                                <input type="text" name="customer_name" class="form-control" placeholder="Nama Customer">
                            </div>
                            <div class="mb-2">
                                <label>No Telpon</label>
                                <input type="text" name="customer_phone" class="form-control" placeholder="Nomor Telpon">
                            </div>
                            <div class="mb-2">
                                <label>Alamat</label>
                                <textarea name="customer_address" class="form-control" rows="2" placeholder="Alamat lengkap"></textarea>
                            </div>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" name="register_member" id="register_member" value="1">
                                <label class="form-check-label" for="register_member">
                                    Daftarkan sebagai Member Baru & Dapatkan Diskon 5%
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TANGGAL --}}
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <label>Tanggal Masuk</label>
                                <input type="date" name="order_date" class="form-control"
                                    value="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="col">
                                <label>Tanggal Selesai</label>
                                <input type="date" name="order_end_date" class="form-control"
                                    value="{{ date('Y-m-d', strtotime('+2 days')) }}" required>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SERVICE --}}
                <div class="card">
                    <div class="card-body">

                        <table class="table" id="service-table">
                            <thead>
                                <tr>
                                    <th>Service</th>
                                    <th width="120">Qty</th>
                                    <th width="150">Subtotal</th>
                                    <th width="50"></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>

                        <button type="button" id="add-row" class="btn btn-primary btn-sm">
                            + Tambah Service
                        </button>

                    </div>
                </div>

            </div>

            {{-- ================= RIGHT ================= --}}
            <div class="col-md-4">

                <div class="card sticky-top mb-3">
                    <div class="card-body">
                        <label>Voucher Code (Optional)</label>
                        <input type="text" name="voucher_code" id="voucher_code" class="form-control" placeholder="MEMBER10 / PROMO10">
                    </div>
                </div>

                <div class="card sticky-top">
                    <div class="card-body">

                        <p>Subtotal: <span id="subtotal">Rp 0</span></p>
                        <p class="text-success">Diskon (<span id="discount_percent">0</span>%): <span id="discount_nominal">Rp 0</span></p>
<p>Pajak (10%): <span id="tax">Rp 0</span></p>

<h5>Total: <span id="grand-total">Rp 0</span></h5>

<hr>

<label>Pay</label>
<input type="number" name="cash_received" id="cash"
    class="form-control" required>

<br>

<div class="alert alert-success text-center">
    Change <br>
    <strong id="change">Rp 0</strong>
</div>

                        <button class="btn btn-success w-100">
                            Simpan Transaksi
                        </button>

                    </div>
                </div>

            </div>

        </div>

    </form>
</div>

<script>
let index = 0;
let services = {
    @foreach($services as $s)
    {{ $s->id }}: { price: {{ $s->price }}, name: "{{ $s->service_name }}" },
    @endforeach
};

function addRow() {
    let tbody = document.querySelector('#service-table tbody');

    let row = `
    <tr>
        <td>
            <select name="services[${index}][service_id]" class="form-control service">
                <option value="">-- pilih --</option>
                @foreach($services as $s)
                    <option value="{{ $s->id }}">{{ $s->service_name }}</option>
                @endforeach
            </select>
        </td>
        <td>
            <input type="number" name="services[${index}][qty]" value="1"
                class="form-control qty">
        </td>
        <td class="subtotal">Rp 0</td>
        <td>
            <button type="button" class="btn btn-danger btn-sm remove">X</button>
        </td>
    </tr>`;

    tbody.insertAdjacentHTML('beforeend', row);
    index++;
}

document.getElementById('add-row').onclick = addRow;

// hapus row
document.addEventListener('click', function(e){
    if(e.target.classList.contains('remove')){
        e.target.closest('tr').remove();
        hitung();
    }
});

// hitung total
document.addEventListener('change', hitung);
document.addEventListener('input', hitung);

document.querySelectorAll('input[name="customer_type"]').forEach(el => {
    el.addEventListener('change', function() {
        if(this.value == 'member') {
            document.getElementById('member_section').style.display = 'block';
            document.getElementById('guest_section').style.display = 'none';
        } else {
            document.getElementById('member_section').style.display = 'none';
            document.getElementById('guest_section').style.display = 'block';
        }
        hitung();
    });
});
if(document.getElementById('customer_id')) document.getElementById('customer_id').addEventListener('change', hitung);
if(document.getElementById('voucher_code')) document.getElementById('voucher_code').addEventListener('input', hitung);

if(document.getElementById('register_member')) document.getElementById('register_member').addEventListener('change', hitung);

function hitung(){
    let subtotal = 0;
    let taxPercent = 10;
    let discountPercent = 0;

    let customerType = document.querySelector('input[name="customer_type"]:checked');
    if (customerType && customerType.value === 'member') {
        let select = document.getElementById('customer_id');
        if(select && select.selectedIndex > 0) {
            let selectedOption = select.options[select.selectedIndex];
            if (selectedOption.dataset.isnew == '1') {
                discountPercent += 5;
            }
        }
    } else if (customerType && customerType.value === 'guest') {
        let registerMember = document.getElementById('register_member');
        if(registerMember && registerMember.checked) {
            discountPercent += 5;
        }
    }

    let voucherCode = document.getElementById('voucher_code');
    if (voucherCode && voucherCode.value.trim() !== '') {
        discountPercent += 10;
    }

    document.querySelectorAll('#service-table tbody tr').forEach(tr => {
        let service = tr.querySelector('.service');
        let qty = tr.querySelector('.qty');
        if(service && qty) {
            service = service.value;
            qty = qty.value;
            if(service){
                let sub = services[service].price * qty;
                subtotal += sub;

                tr.querySelector('.subtotal').innerText =
                    "Rp " + sub.toLocaleString('id-ID');
            }
        }
    });

    // hitung diskon
    let discountNominal = subtotal * discountPercent / 100;
    let totalAfterDiscount = subtotal - discountNominal;

    // hitung pajak
    let tax = totalAfterDiscount * taxPercent / 100;

    // grand total
    let total = totalAfterDiscount + tax;

    // tampilkan
    document.getElementById('subtotal').innerText =
        "Rp " + subtotal.toLocaleString('id-ID');

    document.getElementById('discount_percent').innerText = discountPercent;
    document.getElementById('discount_nominal').innerText =
        "-Rp " + discountNominal.toLocaleString('id-ID');

    document.getElementById('tax').innerText =
        "Rp " + tax.toLocaleString('id-ID');

    document.getElementById('grand-total').innerText =
        "Rp " + total.toLocaleString('id-ID');

    // hitung kembalian
    let cash = document.getElementById('cash').value || 0;
    let change = cash - total;

    document.getElementById('change').innerText =
        "Rp " + change.toLocaleString('id-ID');
}

// init 1 row
addRow();
</script>

@endsection