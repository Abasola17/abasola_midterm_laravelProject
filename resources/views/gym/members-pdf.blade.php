<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Members Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        h1 {
            color: #1f2937;
            border-bottom: 2px solid #3b82f6;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th {
            background-color: #f3f4f6;
            color: #1f2937;
            padding: 10px;
            text-align: left;
            border: 1px solid #d1d5db;
            font-weight: bold;
        }
        td {
            padding: 8px;
            border: 1px solid #d1d5db;
        }
        tr:nth-child(even) {
            background-color: #f9fafb;
        }
        .header-info {
            margin-bottom: 20px;
            color: #6b7280;
        }
        .footer {
            margin-top: 30px;
            padding-top: 10px;
            border-top: 1px solid #d1d5db;
            color: #6b7280;
            font-size: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Gym Members Report</h1>
    
    <div class="header-info">
        <p><strong>Generated:</strong> {{ date('F d, Y h:i A') }}</p>
        <p><strong>Total Members:</strong> {{ $members->count() }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Plan</th>
                <th>Status</th>
                <th>Join Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($members as $member)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->email ?? 'N/A' }}</td>
                    <td>{{ $member->phone ?? 'N/A' }}</td>
                    <td>{{ $member->plan?->name ?? 'N/A' }}</td>
                    <td>{{ $member->status }}</td>
                    <td>{{ $member->join_date->format('M d, Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 20px; color: #6b7280;">
                        No members found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>This report was generated on {{ date('F d, Y h:i A') }} from Gym Management System</p>
    </div>
</body>
</html>


