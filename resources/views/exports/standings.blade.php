<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #0f172a; }
        h1 { font-size: 20px; margin-bottom: 8px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #cbd5e1; padding: 8px; text-align: left; }
        th { background: #e2e8f0; }
    </style>
</head>
<body>
    <h1>{{ $season->name }} Standings</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Team</th>
                <th>P</th>
                <th>W</th>
                <th>D</th>
                <th>L</th>
                <th>GF</th>
                <th>GA</th>
                <th>GD</th>
                <th>Pts</th>
                <th>Fair Play</th>
            </tr>
        </thead>
        <tbody>
            @foreach($standings as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row['team_name'] }}</td>
                    <td>{{ $row['played'] }}</td>
                    <td>{{ $row['wins'] }}</td>
                    <td>{{ $row['draws'] }}</td>
                    <td>{{ $row['losses'] }}</td>
                    <td>{{ $row['goals_for'] }}</td>
                    <td>{{ $row['goals_against'] }}</td>
                    <td>{{ $row['goal_difference'] }}</td>
                    <td>{{ $row['points'] }}</td>
                    <td>{{ $row['fair_play_points'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>