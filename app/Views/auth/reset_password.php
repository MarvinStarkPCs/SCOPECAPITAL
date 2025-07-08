<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Reset Password - SCOPE CAPITAL</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #000;
      font-family: 'Nunito', sans-serif;
      font-size: 0.85rem;
      color: #f1c40f;
    }

    .reset-container {
      background-color: #121212;
      border-radius: 10px;
      padding: 30px 40px;
      width: 350px;
      text-align: center;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
      animation: fadeSlideIn 1s ease-out forwards;
    }

    @keyframes fadeSlideIn {
      0% { opacity: 0; transform: translateY(50px); }
      100% { opacity: 1; transform: translateY(0); }
    }

    .logo { margin-bottom: 20px; }
    .logo img { width: 100px; height: auto; }

    .reset-container h1 {
      margin-bottom: 20px;
      font-size: 1.1rem;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      margin-bottom: 15px;
      text-align: left;
    }

    .form-group label {
      margin-bottom: 5px;
      color: #f1c40f;
    }

    .form-group input {
      padding: 10px;
      border: none;
      border-radius: 5px;
      background-color: #222;
      color: #fff;
    }

    .reset-container button {
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 5px;
      background-color: #f1c40f;
      color: #000;
      cursor: pointer;
      margin-top: 10px;
      font-weight: bold;
    }

    .reset-container button:hover {
      background-color: #d4ac0d;
    }

    .alert {
      padding: 10px;
      border-radius: 5px;
      margin-bottom: 15px;
      text-align: center;
    }

    .alert-error {
      background-color: #e74c3c;
      color: #fff;
    }

    .requirements {
      background-color: #2c2c2c;
      color: #f1c40f;
      font-size: 0.75rem;
      padding: 10px;
      border-radius: 6px;
      margin-top: 8px;
    }

    .requirements ul {
      padding-left: 20px;
      margin: 5px 0;
    }

    .requirements li {
      list-style: none;
      margin: 4px 0;
    }

    .valid { color: #2ecc71; }
    .invalid { color: #e74c3c; }

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
  <div class="reset-container">
    <div class="logo">
      <img src="<?= base_url('img/logo.ico') ?>" alt="Logo">
    </div>
    <h1>Reset your password</h1>

    <?php if (session()->getFlashdata('error')): ?>
      <div class="alert alert-error">
        <?= session()->getFlashdata('error') ?>
      </div>
    <?php endif; ?>

    <form method="post" action="<?= base_url('reset-password/confirm') ?>">
      <?= csrf_field() ?>
      <input type="hidden" name="token" value="<?= esc($token) ?>">

      <div class="form-group">
        <label for="password">New password</label>
        <input type="password" name="password" id="password" placeholder="Enter new password" required>
        <div class="requirements" id="password-rules">
          <ul>
            <li id="length" class="invalid">❌ Mínimo 8 caracteres</li>
            <li id="uppercase" class="invalid">❌ Al menos una letra mayúscula</li>
            <li id="lowercase" class="invalid">❌ Al menos una letra minúscula</li>
            <li id="number" class="invalid">❌ Al menos un número</li>
            <li id="special" class="invalid">❌ Al menos un carácter especial</li>
            <li id="spaces" class="invalid">❌ Sin espacios</li>
          </ul>
        </div>
      </div>

      <div class="form-group">
        <label for="confirm_password">Confirm password</label>
        <input type="password" name="confirm_password" id="confirm_password" placeholder="Repeat password" required>
        <div class="requirements" id="match-rule">
          <ul>
            <li id="match" class="invalid">❌ Las contraseñas deben coincidir</li>
          </ul>
        </div>
      </div>

      <button type="submit">Update Password</button>
    </form>

    <a class="link-back" href="<?= base_url('login') ?>">← Back to login</a>
  </div>

  <script>
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirm_password');

    const rules = {
      length: document.getElementById('length'),
      uppercase: document.getElementById('uppercase'),
      lowercase: document.getElementById('lowercase'),
      number: document.getElementById('number'),
      special: document.getElementById('special'),
      spaces: document.getElementById('spaces'),
      match: document.getElementById('match')
    };

    function validatePassword() {
      const val = password.value;
      const confirm = confirmPassword.value;

      rules.length.className = val.length >= 8 ? 'valid' : 'invalid';
      rules.uppercase.className = /[A-Z]/.test(val) ? 'valid' : 'invalid';
      rules.lowercase.className = /[a-z]/.test(val) ? 'valid' : 'invalid';
      rules.number.className = /\d/.test(val) ? 'valid' : 'invalid';
      rules.special.className = /[\W_]/.test(val) ? 'valid' : 'invalid';
      rules.spaces.className = /\s/.test(val) ? 'invalid' : 'valid';
      rules.match.className = val === confirm && val.length > 0 ? 'valid' : 'invalid';

      rules.length.textContent = (val.length >= 8 ? '✔️' : '❌') + ' Mínimo 8 caracteres';
      rules.uppercase.textContent = (/[A-Z]/.test(val) ? '✔️' : '❌') + ' Al menos una letra mayúscula';
      rules.lowercase.textContent = (/[a-z]/.test(val) ? '✔️' : '❌') + ' Al menos una letra minúscula';
      rules.number.textContent = (/\d/.test(val) ? '✔️' : '❌') + ' Al menos un número';
      rules.special.textContent = (/[\W_]/.test(val) ? '✔️' : '❌') + ' Al menos un carácter especial';
      rules.spaces.textContent = (/\s/.test(val) ? '❌' : '✔️') + ' Sin espacios';
      rules.match.textContent = (val === confirm && val.length > 0 ? '✔️' : '❌') + ' Las contraseñas deben coincidir';
    }

    password.addEventListener('input', validatePassword);
    confirmPassword.addEventListener('input', validatePassword);
  </script>
</body>
</html>
