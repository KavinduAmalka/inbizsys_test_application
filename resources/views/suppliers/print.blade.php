<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppliers List - Print</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            line-height: 1.6;
        }

        @page {
            size: A4;
            margin: 2cm 2cm 3cm 2cm;
        }

        @page :first {
            margin-top: 2cm;
        }

        @bottom-left {
            content: "Page " counter(page);
            font-size: 10pt;
            color: #666;
        }

        .page-break {
            page-break-after: always;
        }

        .print-header {
            text-align: center;
            margin-bottom: 2.5cm;
            border-bottom: 2px solid #333;
            padding-bottom: 1cm;
            page-break-after: avoid;
        }

        .print-header h1 {
            font-size: 28pt;
            font-weight: bold;
            color: #333;
            margin-bottom: 0.3cm;
        }

        .print-header p {
            font-size: 11pt;
            color: #666;
        }

        .suppliers-list {
            margin-top: 1.5cm;
        }

        .supplier-item {
            border: 1px solid #ddd;
            padding: 0.8cm;
            margin-bottom: 0.6cm;
            page-break-inside: avoid;
            border-radius: 4px;
        }

        .supplier-item:hover {
            background-color: #f9f9f9;
        }

        .supplier-header {
            display: flex;
            align-items: center;
            margin-bottom: 0.4cm;
            page-break-after: avoid;
        }

        .supplier-id {
            display: inline-block;
            width: 0.8cm;
            height: 0.8cm;
            background-color: #1e40af;
            color: white;
            border-radius: 50%;
            text-align: center;
            line-height: 0.8cm;
            font-weight: bold;
            font-size: 11pt;
            margin-right: 0.5cm;
            flex-shrink: 0;
        }

        .supplier-name {
            font-size: 14pt;
            font-weight: 600;
            color: #1e40af;
        }

        .supplier-body {
            margin-left: 1.3cm;
            font-size: 10pt;
        }

        .supplier-row {
            margin-bottom: 0.3cm;
            page-break-after: avoid;
        }

        .supplier-label {
            font-weight: 600;
            color: #555;
            display: inline-block;
            width: 1.2cm;
            vertical-align: top;
        }

        .supplier-value {
            color: #333;
            word-wrap: break-word;
        }

        .empty-state {
            text-align: center;
            padding: 2cm;
            color: #666;
            font-size: 12pt;
        }

        .print-footer {
            text-align: center;
            margin-top: 2cm;
            padding-top: 1cm;
            border-top: 1px solid #ddd;
            font-size: 9pt;
            color: #999;
            page-break-after: avoid;
        }

        @media print {
            body {
                background: white;
            }

            .supplier-item {
                break-inside: avoid;
                page-break-inside: avoid;
            }

            a {
                color: #333;
                text-decoration: none;
            }
        }
    </style>
</head>
<body>
    <!-- Print Header -->
    <div class="print-header">
        <h1>Suppliers List</h1>
        <p>Printed on {{ now()->format('d F Y, H:i') }}</p>
    </div>

    <!-- Suppliers Content -->
    <div class="suppliers-list">
        @if ($suppliers->isEmpty())
            <div class="empty-state">
                <p>No suppliers available at the moment.</p>
            </div>
        @else
            @foreach ($suppliers as $supplier)
                <div class="supplier-item">
                    <div class="supplier-header">
                        <div class="supplier-id">{{ $supplier->id }}</div>
                        <div class="supplier-name">{{ $supplier->name }}</div>
                    </div>
                    <div class="supplier-body">
                        <div class="supplier-row">
                            <span class="supplier-label">Email:</span>
                            <span class="supplier-value">{{ $supplier->email }}</span>
                        </div>
                        <div class="supplier-row">
                            <span class="supplier-label">Phone:</span>
                            <span class="supplier-value">{{ $supplier->phone }}</span>
                        </div>
                        <div class="supplier-row">
                            <span class="supplier-label">Address:</span>
                            <span class="supplier-value">{{ $supplier->address }}</span>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Print Footer -->
            <div class="print-footer">
                <p>Total Suppliers: <strong>{{ $suppliers->count() }}</strong></p>
                <p style="margin-top: 0.3cm;">This document was generated automatically from the Suppliers Management System.</p>
            </div>
        @endif
    </div>

    <script>
        // Auto-trigger print dialog on page load
        window.addEventListener('load', function() {
            window.print();
        });
    </script>
</body>
</html>
