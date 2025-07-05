@extends('admin.layouts.app')
@section('content')
    <div class="pagetitle">
        <h1>Add Invoice</h1>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Invoice</h5>

                        <form action="{{ url('manager/invoice/add') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Customer Name <span style="color: red;">
                                        *</span></label>
                                <div class="col-sm-10">
                                    <select name="customer_id" class="form-control" required>
                                        <option value="">Select Customer</option>
                                        @foreach ($getRecord as $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div id="items-area">
                                <div class="item-row row mb-3">
                                    <div class="col-sm-4">
                                        <select name="item_id[]" class="form-control item-select" required>
                                            <option value="">Pilih Item</option>
                                            @foreach ($getItem as $value)
                                                <option value="{{ $value->id }}"
                                                    data-price="{{ $value->price_per_day }}">{{ $value->kode_unit }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-3">
                                        <input type="number" name="rental_days[]" class="form-control rental-days"
                                            placeholder="Hari" required>
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="text" class="form-control price-per-day" placeholder="Harga"
                                            readonly>
                                        <input type="hidden" name="price_per_day[]" class="price-per-day-raw">
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="text" class="form-control sub-total" placeholder="Sub Total"
                                            readonly>
                                        <input type="hidden" name="sub_total[]" class="sub-total-raw">
                                    </div>

                                    <div class="col-sm-1">
                                        <button type="button" class="btn btn-danger remove-item">X</button>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-primary mb-3" id="add-item">+ Tambah Item</button>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Start Date <span style="color: red;">
                                        *</span></label>
                                <div class="col-sm-10">
                                    <input type="date" id="start_date" name="start_date" class="form-control" required
                                        onkeydown="return false;">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">End Date <span style="color: red;"> *</span></label>
                                <div class="col-sm-10">
                                    <input type="date" id="end_date" name="end_date" class="form-control" required
                                        onkeydown="return false;">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Description <span style="color: red;">
                                        *</span></label>
                                <div class="col-sm-10">
                                    <textarea name="description" class="form-control" required></textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Submit </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function formatRupiah(angka) {
            return 'Rp. ' + parseFloat(angka).toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function hitungSubtotal(row) {
            const days = parseFloat(row.querySelector('.rental-days').value) || 0;
            const price = parseFloat(row.querySelector('.price-per-day').getAttribute('data-raw')) || 0;
            const subtotal = days * price;

            row.querySelector('.price-per-day').value = formatRupiah(price);
            row.querySelector('.sub-total').value = formatRupiah(subtotal);

            row.querySelector('.price-per-day-raw').value = price;
            row.querySelector('.sub-total-raw').value = subtotal;
        }

        function updateDisabledOptions() {
            const selectedValues = Array.from(document.querySelectorAll('.item-select'))
                .map(select => select.value).filter(val => val !== "");

            document.querySelectorAll('.item-select').forEach(select => {
                const currentValue = select.value;
                select.querySelectorAll('option').forEach(option => {
                    if (option.value === "") return;
                    option.disabled = selectedValues.includes(option.value) && option.value !==
                        currentValue;
                });
            });
        }

        function updateRemoveButtons() {
            const rows = document.querySelectorAll('.item-row');
            const buttons = document.querySelectorAll('.remove-item');
            buttons.forEach(btn => btn.disabled = rows.length <= 1);
        }

        document.getElementById('add-item').addEventListener('click', function() {
            const area = document.getElementById('items-area');
            const newRow = area.querySelector('.item-row').cloneNode(true);

            newRow.querySelectorAll('input').forEach(input => {
                input.value = '';
                input.removeAttribute('data-raw');
            });
            newRow.querySelector('.item-select').value = '';

            area.appendChild(newRow);
            updateDisabledOptions();
            updateRemoveButtons();
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-item')) {
                const rows = document.querySelectorAll('.item-row');
                if (rows.length > 1) {
                    e.target.closest('.item-row').remove();
                    updateDisabledOptions();
                    updateRemoveButtons();
                }
            }
        });

        document.addEventListener('change', function(e) {
            const row = e.target.closest('.item-row');

            if (e.target.classList.contains('item-select')) {
                const price = e.target.selectedOptions[0].getAttribute('data-price');
                row.querySelector('.price-per-day').setAttribute('data-raw', price);
                row.querySelector('.price-per-day-raw').value = price;
                hitungSubtotal(row);
                updateDisabledOptions();
            }

            if (e.target.classList.contains('rental-days')) {
                hitungSubtotal(row);
            }
        });

        document.getElementById('start_date').addEventListener('change', function() {
            const endInput = document.getElementById('end_date');
            endInput.min = this.value;
        });

        document.addEventListener('DOMContentLoaded', function() {
            updateRemoveButtons();
        });
    </script>
@endsection
