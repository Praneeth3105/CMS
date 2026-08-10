<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="icon2.png">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <title>CERTIFICATE MANAGEMENT SYSTEM</title>

  <style>
    html,
    body {
      height: 100%;
    }

    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    .login-section {
      flex: 1;
    }

    :root {
      --ink: #0d0d0d;
      --cream: #f7f4ef;
      --gold: #c9a84c;
      --rust: #b84c2c;
      --muted: #6b6560;
      --card: #ffffff;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--cream);
      color: var(--ink);
    }

    /* ===== TOP BADGE / HERO ===== */
    .cms-hero {
      min-height: 46vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      padding: 3.5rem 1.5rem 4.5rem;
      background: linear-gradient(135deg, #0d0d0d 55%, #1a1208 100%);
      position: relative;
      overflow: hidden;
    }

    .cms-hero::before {
      content: '';
      position: absolute;
      top: -120px;
      right: -120px;
      width: 500px;
      height: 500px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(201, 168, 76, 0.15) 0%, transparent 70%);
    }

    .cms-hero::after {
      content: '';
      position: absolute;
      bottom: -140px;
      left: -140px;
      width: 400px;
      height: 400px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(184, 76, 44, 0.12) 0%, transparent 70%);
    }

    .badge-circle {
      position: relative;
      z-index: 2;
      width: 96px;
      height: 96px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      background: radial-gradient(circle at 30% 30%, #2a2113, #0d0d0d 70%);
      border: 2px solid var(--gold);
      box-shadow: 0 0 0 6px rgba(201, 168, 76, 0.12), 0 8px 24px rgba(0, 0, 0, 0.5);
      animation: floatBadge 4s ease-in-out infinite;
    }

    .badge-circle .material-icons {
      font-size: 44px;
      color: var(--gold);
    }

    @keyframes floatBadge {

      0%,
      100% {
        transform: translateY(0);
      }

      50% {
        transform: translateY(-8px);
      }
    }

    .hero-tag {
      position: relative;
      z-index: 2;
      color: var(--gold);
      font-size: 0.78rem;
      letter-spacing: 0.22em;
      text-transform: uppercase;
      margin-top: 1.4rem;
    }

    .cms-hero h1 {
      position: relative;
      z-index: 2;
      font-family: 'Playfair Display', serif;
      color: #fff;
      font-size: clamp(2.1rem, 5vw, 3.4rem);
      line-height: 1.15;
      margin-top: 0.6rem;
    }

    .cms-hero h1 span {
      color: var(--gold);
    }

    .cms-hero p {
      position: relative;
      z-index: 2;
      color: #aaa;
      max-width: 480px;
      margin: 1rem auto 0;
      font-size: 1rem;
      line-height: 1.7;
    }

    /* ===== LOGIN CARDS ===== */
    .login-section {
      padding: 0 1.5rem 5rem;
      margin-top: -3rem;
      position: relative;
      z-index: 3;
    }

    .login-row {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 2rem;
      max-width: 1100px;
      margin: 0 auto;
    }

    .role-card {
      background: var(--card);
      width: 280px;
      border-radius: 14px;
      border: 1px solid #e8e4dd;
      box-shadow: 0 12px 34px rgba(0, 0, 0, 0.08);
      padding: 2.2rem 1.6rem 1.8rem;
      text-align: center;
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .role-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 18px 44px rgba(0, 0, 0, 0.14);
    }

    .role-icon-wrap {
      width: 84px;
      height: 84px;
      margin: 0 auto 1.1rem;
      border-radius: 50%;
      background: linear-gradient(135deg, #fbf7ee, #f1e6c9);
      border: 1px solid rgba(201, 168, 76, 0.5);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .role-icon-wrap .material-icons {
      font-size: 40px;
      color: var(--rust);
    }

    .role-card h3 {
      font-family: 'Playfair Display', serif;
      font-size: 1.3rem;
      margin-bottom: 0.5rem;
    }

    .role-card p {
      color: var(--muted);
      font-size: 0.88rem;
      line-height: 1.55;
      margin-bottom: 1.4rem;
      min-height: 60px;
    }

    .role-btn {
      display: block;
      width: 100%;
      padding: 0.75rem 0;
      border: none;
      border-radius: 25px;
      font-family: 'DM Sans', sans-serif;
      font-weight: 600;
      font-size: 0.85rem;
      letter-spacing: 0.06em;
      text-transform: uppercase;
      color: #fff;
      background: linear-gradient(to right, var(--ink), #2a2113, var(--ink));
      background-size: 200%;
      cursor: pointer;
      text-decoration: none;
      transition: background-position 0.5s, transform 0.2s;
    }

    .role-btn:hover {
      background-position: right;
      transform: translateY(-2px);
      color: var(--gold);
    }

    /* responsive: stack on small screens, otherwise stay side by side */
    @media (max-width: 720px) {
      .login-row {
        gap: 1.4rem;
      }

      .role-card {
        width: 100%;
        max-width: 320px;
      }
    }

    footer.cms-footer {
      background: var(--ink);
      color: #666;
      text-align: center;
      padding: 1.6rem;
      font-size: 0.82rem;
    }

    .n {
      text-decoration: none;
    }
    
  </style>
</head>

<body>

  <!-- HERO with circular badge (replaces gif slideshow) -->
  <section class="cms-hero">
    <div class="badge-circle">
      <span class="material-icons">workspace_premium</span>
    </div>
    <p class="hero-tag">Digital Records, Verified</p>
    <h1>Certificate <span>Management</span> System</h1>
    <p>One secure place for students, faculty, and admins to issue, track, and manage academic certificates.</p>
  </section>

  <!-- LOGIN CARDS: student, faculty, admin side by side -->
  <section class="login-section">
    <div class="login-row">

      <div class="role-card">
        <div class="role-icon-wrap">
          <span class="material-icons">school</span>
        </div>
        <h3>Student</h3>
        <p>Maintain your certificate collection. Log in to view and manage your records.</p>
        <a class="n" href="login1.php"><button type="button" class="role-btn">Login</button></a>
      </div>

      <div class="role-card">
        <div class="role-icon-wrap">
          <span class="material-icons">person</span>
        </div>
        <h3>Faculty</h3>
        <p>Review and manage certificates for your students. Log in to your faculty account.</p>
        <a class="n" href="login2.php"><button type="button" class="role-btn">Login</button></a>
      </div>

      <div class="role-card">
        <div class="role-icon-wrap">
          <span class="material-icons">admin_panel_settings</span>
        </div>
        <h3>Admin</h3>
        <p>Oversee the entire system, manage users, and issue certificates. Log in to the admin panel.</p>
        <a class="n" href="login3.php"><button type="button" class="role-btn">Login</button></a>
      </div>

    </div>
  </section>

  <footer class="cms-footer">

  </footer>

</body>

</html>