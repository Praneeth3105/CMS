<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="icon2.png">
    <title>Add Faculty | Certificate Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Poppins:wght@400;500;600;700&display=swap');

        :root {
            --dark: #1a120b;
            --dark-2: #2b1d13;
            --gold: #d4af37;
            --gold-soft: #c9a227;
            --gold-pale: #f0e2b8;
            --cream: #f5efe6;
            --cream-card: #fffdf8;
            --rust: #b5502e;
            --radius: 18px;
            --radius-sm: 10px;
            --shadow: 0 10px 30px rgba(26, 18, 11, 0.15);
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--cream);
            color: var(--dark);
            margin: 0;
            padding: 0 0 60px;
        }

        .n {
            text-decoration: none;
        }

        /* ---------- Top bar ---------- */
        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 32px;
            background: linear-gradient(135deg, var(--dark) 0%, var(--dark-2) 100%);
            box-shadow: var(--shadow);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 22px;
            background: #17120e;
            color: #e6c877 !important;
            border: 1px solid #caa24c;
            border-radius: 999px;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn:hover {
            background: #caa24c;
            color: #17120e !important;
            border-color: #caa24c;
        }

        .page-hero {
            text-align: center;
            padding: 42px 24px 8px;
        }

        .page-hero .eyebrow {
            text-transform: uppercase;
            letter-spacing: 3px;
            font-size: 0.75rem;
            color: var(--rust);
            font-weight: 600;
            margin-bottom: 10px;
        }

        .page-hero h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark);
            margin: 0;
        }

        .panel {
            background: var(--cream-card);
            margin: 30px auto;
            padding: 40px 44px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid rgba(212, 175, 55, 0.25);
            max-width: 760px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px 40px;
        }

        .field {
            margin-bottom: 20px;
        }

        .field label {
            display: block;
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--dark-2);
            margin-bottom: 8px;
            letter-spacing: 0.2px;
        }

        .field input,
        .field select {
            width: 100%;
            padding: 12px 14px;
            font-size: 0.95rem;
            font-family: 'Poppins', sans-serif;
            color: var(--dark);
            background: var(--cream-card);
            border: 1.5px solid var(--gold-soft);
            border-radius: var(--radius-sm);
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            appearance: none;
        }

        .field select {
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="%23c9a227" viewBox="0 0 16 16"><path d="M8 11L2 5h12z"/></svg>');
            background-repeat: no-repeat;
            background-position: right 14px center;
            cursor: pointer;
            padding-right: 36px;
        }

        .field input::placeholder {
            color: #a89a80;
        }

        .field input:focus,
        .field select:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.18);
        }

        .button-area {
            text-align: center;
            margin-top: 22px;
        }

        .button-area input[type="submit"] {
            padding: 13px 44px;
            background: var(--dark);
            color: var(--gold-pale);
            border: 1px solid var(--gold-soft);
            border-radius: 999px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.25s ease;
        }

        .button-area input[type="submit"]:hover {
            background: var(--gold);
            color: var(--dark);
        }

        @media only screen and (max-width: 700px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .panel {
                margin: 18px;
                padding: 26px 22px;
            }
        }
    </style>
</head>

<body>

    <div class="topbar">
        <a href="admin.php" class="n">
            <button type="button" class="btn">Back</button>
        </a>
        <a href="logout.php" class="n">
            <button type="button" class="btn">Logout</button>
        </a>
    </div>

    <div class="page-hero">
        <div class="eyebrow">Faculty Records</div>
        <h2>Add Faculty</h2>
    </div>

    <div class="panel">
        <form method="POST" action="nu2.php" enctype="multipart/form-data">
            <div class="form-grid">

                <div class="field">
                    <label for="uname">ID</label>
                    <input type="text" placeholder="Enter your ID Number" name="uname" id="uname" required>
                </div>

                <div class="field">
                    <label for="jdate">Joining Year</label>
                    <input type="date" name="date" id="jdate" required>
                </div>

                <div class="field">
                    <label for="psw">Password</label>
                    <input type="password" placeholder="Enter Password" name="psw" id="psw" required>
                </div>

                <div class="field">
                    <label for="department">Department</label>
                    <select name="department" id="department" required>
                        <option value="">Select Branch</option>
                        <option value="CSM">CSM</option>
                        <option value="CSE">CSE</option>
                        <option value="CSO">CSO</option>
                        <option value="CIC">CIC</option>
                        <option value="EEE">EEE</option>
                        <option value="ECE">ECE</option>
                        <option value="MECH">MECH</option>
                        <option value="CIVIL">CIVIL</option>
                        <option value="CSD">CSD</option>
                    </select>
                </div>

                <div class="field">
                    <label for="name">Name</label>
                    <input type="text" placeholder="Enter Your Name" name="name" id="name" required>
                </div>

                <div class="field">
                    <label for="email">Email</label>
                    <input type="email" placeholder="Enter Email" name="email" id="email" required>
                </div>

            </div>

            <div class="button-area">
                <input type="submit" value="Submit" name="submit">
            </div>
        </form>
    </div>

</body>

</html>