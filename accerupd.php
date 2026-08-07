<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>CERTIFICATE MAINTENANCE SYSTEM</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    :root {
      --dark: #1c1510;
      --dark-2: #241b14;
      --gold: #c9a227;
      --gold-light: #d9b84a;
      --cream: #f5efe4;
      --card-bg: #ffffff;
      --text-dark: #2b2318;
      --text-muted: #6b6155;
      --border: #e6ddc9;
    }

    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: Georgia, 'Times New Roman', serif;
      background: var(--cream);
      color: var(--text-dark);
      min-height: 100vh;
    }

    .n {
      text-decoration: none;
    }

    .topbar {
      background: linear-gradient(180deg, var(--dark) 0%, var(--dark-2) 100%);
      padding: 18px 32px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      border-bottom: 2px solid var(--gold);
    }

    .topbar h1 {
      color: #f2ead8;
      font-size: 22px;
      margin: 0;
      letter-spacing: 0.5px;
    }

    .topbar h1 span {
      color: var(--gold-light);
    }

    .btn {
      font-family: Georgia, serif;
      font-weight: 600;
      font-size: 14px;
      letter-spacing: 0.4px;
      padding: 10px 22px;
      border-radius: 999px;
      border: 1px solid var(--gold);
      cursor: pointer;
      transition: all 0.2s ease;
      text-decoration: none;
      display: inline-block;
    }

    .btn-dark {
      background: var(--dark);
      color: var(--gold-light);
    }

    .btn-dark:hover {
      background: #000;
    }

    .page-heading {
      text-align: center;
      margin: 34px 0 22px;
    }

    .page-heading .eyebrow {
      color: var(--text-muted);
      letter-spacing: 3px;
      font-size: 12px;
      text-transform: uppercase;
      font-family: Arial, sans-serif;
      margin-bottom: 6px;
    }

    .page-heading h2 {
      font-size: 30px;
      margin: 0;
      color: var(--text-dark);
    }

    .page-heading h2 span {
      color: #a0522d;
    }

    .form-container {
      max-width: 460px;
      margin: 0 auto 60px;
      padding: 0 24px;
    }

    .form-card {
      background: var(--card-bg);
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(28, 21, 16, 0.08);
      padding: 40px;
      text-align: center;
    }

    label {
      font-family: Arial, sans-serif;
      font-size: 13px;
      color: var(--text-muted);
      letter-spacing: 0.3px;
      display: block;
      margin-top: 4px;
      margin-bottom: 6px;
      text-align: left;
    }

    select,
    input[type=file] {
      width: 100%;
      font-family: Arial, sans-serif;
      font-size: 15px;
      padding: 12px 14px;
      border: 1px solid var(--border);
      border-radius: 10px;
      background: #faf7f0;
      color: var(--text-dark);
      outline: none;
      transition: border-color 0.2s ease;
      margin-bottom: 22px;
    }

    select:focus,
    input[type=file]:focus {
      border-color: var(--gold);
    }

    select {
      appearance: none;
      background-image: linear-gradient(45deg, transparent 50%, var(--text-muted) 50%),
        linear-gradient(135deg, var(--text-muted) 50%, transparent 50%);
      background-position: calc(100% - 18px) calc(1em + 4px), calc(100% - 13px) calc(1em + 4px);
      background-size: 5px 5px, 5px 5px;
      background-repeat: no-repeat;
    }

    input[type=file] {
      cursor: pointer;
      padding: 10px 12px;
    }

    input[type=submit] {
      width: 60%;
      min-width: 160px;
      font-family: Georgia, serif;
      font-weight: 600;
      font-size: 15px;
      padding: 12px 22px;
      border-radius: 999px;
      border: 1px solid var(--gold);
      background: var(--gold);
      color: var(--dark);
      cursor: pointer;
      transition: background 0.2s ease;
    }

    input[type=submit]:hover {
      background: var(--gold-light);
    }
  </style>
</head>

<body>
  <?php
  include "db_conn.php";
  session_start();
  $uname = $_SESSION['username'];
  $name  = $_SESSION['name'];
  ?>
  <div class="topbar">
    <h1>Certificate <span>Management</span> System</h1>
    <a href="accer.php" class="n"><button type="button" class="btn btn-dark">&larr; Back</button></a>
  </div>

  <div class="page-heading">
    <div class="eyebrow">Digital Records, Verified</div>
    <h2>Update <span>Memo</span></h2>
  </div>

  <div class="form-container">
    <div class="form-card">
      <form method='POST' action='upd.php' enctype='multipart/form-data'>
        <label for="department">Semester</label>
        <select name="sem" id="department" required>
          <option value="">Semester</option>
          <option value="semoo">1-1</option>
          <option value="semot">1-2</option>
          <option value="semto">2-1</option>
          <option value="semtt">2-2</option>
          <option value="semtho">3-1</option>
          <option value="semtht">3-2</option>
          <option value="semfo">4-1</option>
          <option value="semft">4-2</option>
        </select>
        <label for="number">Upload File</label>
        <input type="file" name="file" id="number">

        <input type='submit' value='Update' name='submit'>
      </form>
    </div>
  </div>

</body>

</html>
