@extends('layouts.default')

@section('title', 'Balance Sheet')

@section('breadcrumb')
    <li class="breadcrumb-item">Financial</li>
    <li class="breadcrumb-item active">Balance Sheet</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header card-no-border">
                    <h3 class="text-primary mb-0">BALANCE SHEET</h3>
                </div>
                <div class="card-body pt-0">
                    {{-- Filter Form --}}
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Periode</label>
                            <input type="month" id="periodFilter" class="form-control"
                                value="{{ $year }}-{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Report Type</label>
                            <select id="typeFilter" class="form-select">
                                <option value="summary" {{ $type === 'summary' ? 'selected' : '' }}>SUMMARY</option>
                                <option value="detail" {{ $type === 'detail' ? 'selected' : '' }}>DETAIL</option>
                            </select>
                        </div>
                        <div class="col-md-4 d-flex align-items-end gap-2">
                            <button type="button" id="viewReportBtn" class="btn btn-primary flex-fill">
                                View Report
                            </button>
                            <button type="button" id="downloadExcelBtn" class="btn btn-success flex-fill">
                                Download Excel
                            </button>
                        </div>
                    </div>

                    {{-- PDF Viewer --}}
                    <div class="pdf-viewer-container bg-dark rounded p-2" style="min-height: 600px;">
                        <iframe id="pdfViewer" src="" style="width: 100%; height: 600px; border: none;"
                            class="bg-secondary rounded"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const periodFilter = document.getElementById('periodFilter');
            const typeFilter = document.getElementById('typeFilter');
            const viewReportBtn = document.getElementById('viewReportBtn');
            const downloadExcelBtn = document.getElementById('downloadExcelBtn');
            const pdfViewer = document.getElementById('pdfViewer');

            function getFilterParams() {
                const period = periodFilter.value.split('-');
                return {
                    year: period[0],
                    month: parseInt(period[1]),
                    type: typeFilter.value
                };
            }

            function buildUrl(baseUrl, params) {
                const url = new URL(baseUrl, window.location.origin);
                Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));
                return url.toString();
            }

            function loadPdf() {
                const params = getFilterParams();
                const pdfUrl = buildUrl('{{ route('financial.balance-sheet.pdf') }}', params);
                pdfViewer.src = pdfUrl;
            }

            viewReportBtn.addEventListener('click', function() {
                loadPdf();
            });

            downloadExcelBtn.addEventListener('click', function() {
                const params = getFilterParams();
                const excelUrl = buildUrl('{{ route('financial.balance-sheet.excel') }}', params);
                window.location.href = excelUrl;
            });

            // Load PDF on page load
            loadPdf();
        });
    </script>
@endpush

@push('styles')
    <style>
        .pdf-viewer-container {
            background: linear-gradient(135deg, #2d3436 0%, #1e272e 100%);
        }

        #pdfViewer {
            background-color: #636e72;
        }
    </style>
@endpush
