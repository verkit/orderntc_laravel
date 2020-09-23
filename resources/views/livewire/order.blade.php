<x-slot name="header">
    <div class="col-sm-6">
        <h4 class="page-title">Order</h4>
    </div>
</x-slot>

<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="header-title mb-3">
                    <a href="{{ route('create.order') }}" class="btn btn-primary"><i class="fa fa-plus mr-1"></i> Order</a>
                </div>
                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;"
                    data-turbolinks-action="false">
                    <thead>
                        <tr>
                            <th>No Order</th>
                            <th>Sales</th>
                            <th>Pelanggan</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($order as $item)
                        <tr>
                            <td> {{ $item->noorder }} </td>
                            <td> {{ $item->nama_sales }} </td>
                            <td> {{ $item->nama_pelanggan }} </td>
                            <td> {{ $item->tanggal }} </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

@push('css')
<!-- DataTables -->
<link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css ') }}" rel="stylesheet" type="text/css" />
@endpush

@push('js')
<!-- Required datatable js -->
<script data-turbolinks-eval="false" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script data-turbolinks-eval="false" src="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Buttons examples -->
<script data-turbolinks-eval="false" src="{{ asset('assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script data-turbolinks-eval="false" src="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
<script data-turbolinks-eval="false" src="{{ asset('assets/plugins/datatables/jszip.min.js') }}"></script>
<script data-turbolinks-eval="false" src="{{ asset('assets/plugins/datatables/pdfmake.min.js') }}"></script>
<script data-turbolinks-eval="false" src="{{ asset('assets/plugins/datatables/vfs_fonts.js') }}"></script>
<script data-turbolinks-eval="false" src="{{ asset('assets/plugins/datatables/buttons.html5.min.js') }}"></script>
<script data-turbolinks-eval="false" src="{{ asset('assets/plugins/datatables/buttons.print.min.js') }}"></script>
<script data-turbolinks-eval="false" src="{{ asset('assets/plugins/datatables/buttons.colVis.min.js') }}"></script>

<!-- Responsive examples -->
<script data-turbolinks-eval="false" src="{{ asset('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script data-turbolinks-eval="false" src="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>

<!-- Datatable init js -->
<script data-turbolinks-eval="false" src="{{ asset('assets/pages/datatables.init.js') }}"></script>
@endpush
