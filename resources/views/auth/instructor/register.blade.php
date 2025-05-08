<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Registration</title>

    <!-- ✅ FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        /* Color Theme */
        :root {
            --primary-color: #007bff;
            --background-gradient: linear-gradient(to right, #4facfe, #00f2fe);
            --text-color: #fff;
            --input-border: #ccc;
            --input-focus: #007bff;
        }

        /* Global Styles */
        body {
            background: var(--background-gradient);
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Form Container */
        .form-container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            width: 400px;
            text-align: center;
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Instructor Icon */
        .instructor-icon {
            font-size: 50px;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        /* Floating Label Input Fields */
        .input-group {
            position: relative;
            margin-bottom: 20px;
            text-align: left;
        }

        .input-group input {
            width: 100%;
            padding: 12px 15px 12px 40px;
            border: none;
            border-bottom: 2px solid var(--input-border);
            font-size: 14px;
            transition: all 0.3s ease-in-out;
            outline: none;
            background: none;
        }

        .input-group input:focus {
            border-bottom: 2px solid var(--input-focus);
        }

        .input-group label {
            position: absolute;
            top: 50%;
            left: 40px;
            transform: translateY(-50%);
            font-size: 14px;
            color: #666;
            transition: all 0.3s ease-in-out;
            pointer-events: none;
        }

        .input-group input:focus + label,
        .input-group input:valid + label {
            top: -10px;
            left: 35px;
            font-size: 12px;
            color: var(--input-focus);
        }

        /* Icons Inside Input Fields */
        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 16px;
            color: var(--primary-color);
            transition: all 0.3s ease-in-out;
        }

        .input-group input:focus ~ i {
            color: var(--input-focus);
        }

        /* Small Note */
        .note {
            font-size: 12px;
            color: #666;
            margin-top: -5px;
            margin-bottom: 10px;
        }

        /* Submit Button */
        button {
            background: var(--primary-color);
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease-in-out;
        }

        button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Instructor Registration</h2>
        <i class="fa-solid fa-chalkboard-user instructor-icon"></i>

        <form action="{{ route('instructor.register') }}" method="POST">
            @csrf

            <div class="input-group">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="full_name" required>
                <label for="full_name">Full Name</label>
            </div>

            <div class="input-group">
                <i class="fa-solid fa-envelope"></i>
                <input type="email" name="email" required>
                <label for="email">Email (Used as Username)</label>
                <p class="note">Your email will be your username for logging in.</p>
            </div>

            <div class="input-group">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="password" required>
                <label for="password">Password</label>
            </div>

            <div class="input-group">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="password_confirmation" required>
                <label for="password_confirmation">Confirm Password</label>
            </div>

            <button type="submit"><i class="fa-solid fa-paper-plane"></i> Register</button>
        </form>
    </div>
</body>
</html>
