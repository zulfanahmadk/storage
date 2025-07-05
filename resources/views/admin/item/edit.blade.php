@extends('admin.layouts.app')
@section('content')
    <div class="pagetitle">
        <h1>Edit Item</h1>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Item</h5>

                        @include('admin.item._form')

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
