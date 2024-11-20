<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
</head>

<style>
    .button-wrapper {
        margin-top: 10px;
    }

    .error {
        margin-top: 10px;
    }

    .error p {
        color: red;
        font-weight: bold;
        font-size: 18px;
    }
</style>

<body>

    <h1>Admin Panel</h1>

    <form action="/admin/login" method="post">
        <div>
            <label for="email">Email Address</label>
            <br>
            <input type="email" name="email" id="email">

        </div>
        <div>
            <label for="password">Password</label>
            <br>
            <input type="password" name="password" id="password">


            <div class="button-wrapper">
                <button type="submit">Login</button>
            </div>
        </div>
    </form>
    <?php if (!empty($invalid)): ?>
        <div class="error">
            <p>
                <?php echo $invalid; ?>
            </p>
        </div>
    <?php endif; ?>
</body>

</html>