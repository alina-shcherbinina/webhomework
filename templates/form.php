<!DOCTYPE html>
  <html>
  <head>
    <title>form</title>
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Jost&display=swap');
      body {
        font-family: 'Jost', sans-serif;
      }
     input[type=text], select {
      width: 40%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      }

    input[type=submit] {
      width: 40%;
      background-color: #4CAF50;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    input[type=submit]:hover {
      background-color: #45a049;
    }

      }
      .form-group {
        margin-bottom: : 30px;
      }
      .error {
        color: red;
      }
    </style>
  </head>
  <body>
    <?php if (!empty($successMessage)): ?>
      <p><?= $successMessage ?></p>

    <?php else: ?>
        <p><strong>Validation errors encountered!</strong></p>


      <form method="POST" action="">
        <div class="form-group">
          <label>Name:</label>
          <input type="text" name='username' value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
                <span class="error"><?= $errors['username'] ?? '' ?></span>
        </div>

        <div class="form-group">
          <label>Lastname:</label>
          <input type="text" name='lastname' value="<?= htmlspecialchars($_POST['lastname'] ?? '') ?>">
          <span class="error"><?= $errors['lastname'] ?? '' ?></span>
        </div>

        <div class="form-group">
          <label>email:</label>
          <input type="text" name='email' value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
          <span class="error"><?= $errors['email'] ?? '' ?></span>
        </div>

     <div class="form-group">
          <label>phone:</label>
          <input type="text" name='phone' value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
          <span class="error"><?= $errors['phone'] ?? '' ?></span>
        </div>


        <div class="form-group">
          <label>conference:</label>
          <select name="conf" value="<?= $_POST['conf'] ?? '' ?>">
            <option value="">--</option>
            <?php foreach ($order->getConfies() as $confID => $confName) : ?>
              <option value="<?= $confID ?>" <?= !empty($_POST['conf']) && $_POST['conf'] == $confID ? ' selected' : '' ?>><?= $confName ?></option>
            <?php endforeach ?> 
          </select>
          <span class="error"><?= $errors['conf'] ?? '' ?> </span>
        </div>


        <div class="form-group">
          <label>payment method:</label>
          <select name="pay" value="<?= $_POST['pay'] ?? '' ?>">
            <option value="">--</option>
            <?php foreach ($order->getPayment() as $payID => $payName): ?>
             <option value="<?= $payID ?>" <?= !empty($_POST['pay']) && $_POST['pay'] == $payID ? ' selected' : '' ?>><?= $payName ?></option>
            <?php endforeach ?> 
          </select>
          <span class="error"><?= $errors['pay'] ?? '' ?> </span>
        </div>


        <div class="form-group">
        <label>Message:</label>
        <textarea placeholder="Remember, be nice!" cols="30" rows="5" name="message"><?= htmlspecialchars($_POST['messsage'] ?? '') ?></textarea>
        <span class="error"> <?= isset($errors['message']) ? $errors['message'] : '' ?></span>
        </div>

        <div class="form-group">
          <label>
            <input type="checkbox" name="post" <?= !empty($_POST['post']) ? ' checked' : '' ?>>
            I agree to subscribe to the mailing list
          </label> 
        </div>

        <div class="form-group">
          <label>
            <input type="checkbox" name='agree' <?= !empty($_POST['agree']) ? 'checked' : '' ?>>
            I agree to the personal data processing
          </label>  
          <br>
          <span class="error"><?= $errors['agree'] ?? '' ?></span>
        </div>

        <button type="submit">Submit</button>
      </form>
    <?php endif; ?>
  </body>
  </html>
