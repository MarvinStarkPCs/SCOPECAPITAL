<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recover Password - SCOPE CAPITAL</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #000;
      font-family: Arial, sans-serif;
      font-size: 0.85rem;
      color: #f1c40f;
    }

    .recover-container {
      background-color: #121212;
      border-radius: 10px;
      padding: 30px 40px;
      width: 320px;
      text-align: center;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
      animation: fadeSlideIn 1s ease-out forwards;
    }

    @keyframes fadeSlideIn {
      0% {
        opacity: 0;
        transform: translateY(50px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .logo {
      margin-bottom: 20px;
    }

    .logo img {
      width: 100px;
      height: auto;
    }

    .recover-container h1 {
      margin-bottom: 20px;
      font-size: 1.1rem;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      margin-bottom: 15px;
    }

    .form-group label {
      text-align: left;
      margin-bottom: 5px;
    }

    .form-group input {
      padding: 10px;
      border: none;
      border-radius: 5px;
      background-color: #222;
      color: #fff;
    }

    .recover-container button {
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 5px;
      background-color: #f1c40f;
      color: #000;
      cursor: pointer;
      margin-top: 10px;
    }

    .recover-container button:hover {
      background-color: #d4ac0d;
    }

    .alert {
      padding: 10px;
      border-radius: 5px;
      margin-bottom: 15px;
      text-align: center;
    }

    .alert-success {
      background-color: #2ecc71;
      color: #fff;
    }

    .alert-error {
      background-color: #e74c3c;
      color: #fff;
    }

    .link-back {
      margin-top: 15px;
      display: inline-block;
      color: #f1c40f;
      text-decoration: none;
    }

    .link-back:hover {
      text-decoration: underline;
      color: #d4ac0d;
    }
  </style>
</head>
<body>
  <div class="recover-container">
    <div class="logo">
      <img src="<?= base_url('img/logo.ico') ?>" alt="Logo">
    </div>
    <h1>Recover your password</h1>

    <?php if (session()->getFlashdata('success')): ?>
      <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
      </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
      <div class="alert alert-error">
        <?= session()->getFlashdata('error') ?>
      </div>
    <?php endif; ?>

    <form method="post" action="<?= base_url('recover/send-link') ?>">
      <?= csrf_field() ?>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Enter your email" required>
      </div>
      <button type="submit">Send Recovery Link</button>
    </form>

    <a class="link-back" href="<?= base_url('login') ?>">← Back to login</a>
  </div>
</body>
</html>
