<div class="case-document">
    <div class="doc-header">
        <div class="doc-meta">
            <p class="eyebrow">Case Details</p>
            <h1>Case summary</h1>
            <p class="muted">Generated on {{ date('d/m/Y H:i') }}</p>
        </div>
        <div class="badge">
            <span class="label">Document ID</span>
            <span class="value">#{{ $case->getKey() }}</span>
        </div>
    </div>

    <div class="section">
        <h2>Core information</h2>
        <div class="grid two-col">
            <div class="card">
                <div class="row">
                    <span class="label">Case number</span>
                    <span class="value">{{ $case->court_case_number ?? 'N/A' }}</span>
                </div>
                <div class="row">
                    <span class="label">Office file</span>
                    <span class="value">{{ $case->office_file_number ?? 'N/A' }}</span>
                </div>
                <div class="row">
                    <span class="label">Case title</span>
                    <span class="value">{{ $case->case_title ?? 'N/A' }}</span>
                </div>
            </div>
            <div class="card">
                <div class="row">
                    <span class="label">Case type</span>
                    <span class="value">{{ $case->case_type_name }}</span>
                </div>
                <div class="row">
                    <span class="label">Stage</span>
                    <span class="value">{{ $case->case_stage_name }}</span>
                </div>
                <div class="row">
                    <span class="label">Court</span>
                    <span class="value">{{ $case->court_name }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <h2>Parties</h2>
        <div class="grid two-col">
            <div class="card">
                <div class="row">
                    <span class="label">Client</span>
                    <span class="value">{{ $case->client_name ?? 'N/A' }}</span>
                </div>
                <div class="row">
                    <span class="label">Opponent</span>
                    <span class="value">{{ $case->opponent_name ?? 'N/A' }}</span>
                </div>
            </div>
            <div class="card">
                <div class="row">
                    <span class="label">Opponent lawyer</span>
                    <span class="value">{{ $case->opponent_lawyer ?? 'N/A' }}</span>
                </div>
                <div class="row">
                    <span class="label">Status</span>
                    <span class="value">{{ ucfirst($case->status ?? 'pending') }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <h2>Important dates</h2>
        <div class="grid three-col">
            <div class="card">
                <p class="label">Opening date</p>
                <p class="value">{{ $case->opening_date ? \Carbon\Carbon::parse($case->opening_date)->format('d/m/Y') : 'N/A' }}</p>
            </div>
            <div class="card">
                <p class="label">Previous date</p>
                <p class="value">{{ $case->formatted_previous_date }}</p>
            </div>
            <div class="card">
                <p class="label">Next date</p>
                <p class="value">{{ $case->formatted_next_date }}</p>
            </div>
        </div>
    </div>

    @if (!empty($case->description) || !empty($case->notes))
        <div class="section">
            <h2>Notes</h2>
            <div class="card">
                <p class="value">{{ $case->description ?? $case->notes }}</p>
            </div>
        </div>
    @endif

    <div class="doc-footer">
        <p>This document was generated automatically from the Lawyer Diary system.</p>
        <p>Generated: {{ date('d/m/Y H:i:s') }}</p>
    </div>
</div>

@push('styles')
    <style>
        .case-document {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #1f2937;
            max-width: 960px;
            margin: 0 auto;
            padding: 16px;
        }

        .doc-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding-bottom: 16px;
            border-bottom: 2px solid #0ea5e9;
            margin-bottom: 20px;
        }

        .doc-meta h1 {
            margin: 2px 0;
            font-size: 26px;
            font-weight: 800;
        }

        .eyebrow {
            text-transform: uppercase;
            letter-spacing: 0.12em;
            font-size: 11px;
            font-weight: 700;
            color: #0ea5e9;
            margin: 0;
        }

        .muted {
            color: #6b7280;
            margin: 0;
        }

        .badge {
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 10px 12px;
            background: #f8fafc;
            text-align: right;
        }

        .badge .label {
            display: block;
            font-size: 11px;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .badge .value {
            display: block;
            font-weight: 800;
            font-size: 14px;
            color: #0f172a;
        }

        .section {
            margin-bottom: 22px;
        }

        .section h2 {
            margin: 0 0 10px;
            font-size: 18px;
            font-weight: 800;
            color: #0f172a;
        }

        .grid {
            display: grid;
            gap: 10px;
        }

        .two-col {
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        }

        .three-col {
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        }

        .card {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 12px;
            background: #fff;
        }

        .row {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            padding: 6px 0;
        }

        .row + .row {
            border-top: 1px dashed #e5e7eb;
        }

        .label {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: #6b7280;
            font-weight: 700;
        }

        .value {
            font-size: 14px;
            font-weight: 700;
            color: #0f172a;
        }

        .doc-footer {
            border-top: 1px solid #e5e7eb;
            padding-top: 14px;
            margin-top: 24px;
            text-align: center;
            font-size: 12px;
            color: #6b7280;
        }

        @media screen and (max-width: 600px) {
            .case-document {
                padding: 12px;
            }

            .doc-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .doc-meta h1 {
                font-size: 22px;
            }
        }

        @media print {
            .case-document {
                font-size: 12px;
                padding: 0;
            }

            .doc-meta h1 {
                font-size: 18px;
            }
        }
    </style>
@endpush
