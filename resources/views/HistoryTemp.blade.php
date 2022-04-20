@extends('layouts.app')

@section('content')
<main class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3><u>History</u></h3>
                <table class = "table" id = "datatable">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Date/Hour</th>
                            <th>Car Model</th>
                        </tr>
                    <thead>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
