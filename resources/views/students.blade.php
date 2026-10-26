<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f1f5f9; margin: 0; padding: 40px 20px; color: #0f172a; }
        .container { max-width: 900px; margin: auto; }
        h1 { color: #1d4ed8; }
        .card { background: white; padding: 24px; border-radius: 12px; margin: 20px 0; box-shadow: 0 4px 15px #0000000d; }
        form { display: grid; gap: 12px; }
        input { padding: 12px; border: 1px solid #cbd5e1; border-radius: 6px; }
        button { padding: 12px; background: #2563eb; color: white; border: 0; border-radius: 6px; cursor: pointer; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; border-bottom: 1px solid #e2e8f0; text-align: left; }
        th { background: #eff6ff; }
        .success { color: #15803d; }
        .error { color: #dc2626; }
    </style>
</head>
<body>
<div class="container">
    <h1>Student Management System</h1>
    <p>Three-Tier Application | Laravel and MySQL</p>

    <div class="card">
        <h2>Add Student</h2>

        @if(session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        @if($errors->any())
            @foreach($errors->all() as $error)
                <p class="error">{{ $error }}</p>
            @endforeach
        @endif

        <form action="/students" method="POST">
            @csrf
            <input name="name" placeholder="Student name" value="{{ old('name') }}" required>
            <input name="email" type="email" placeholder="Email address" value="{{ old('email') }}" required>
            <input name="course" placeholder="Course name" value="{{ old('course') }}" required>
            <button type="submit">Add Student</button>
        </form>
    </div>

    <div class="card">
        <h2>Registered Students</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Course</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                    <tr>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->course }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">No students registered yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
