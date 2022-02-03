<div class="container">
    <form action="?type=user&action=signUp" method="post">
        <div class="d-flex flex-column">
            <h1>Sign up</h1>
            <input type="text" value="newUser" name="username" placeholder="Your username" id="username" required>
            <input type="email" value="someone@gmail.com" name="email" placeholder="Your email" id="email" required>
            <input type="password" value="password" name="password" id="password" required>
            <input type="text" value="newUser" name="displayName" placeholder="Your display name" id="displayName" required>
            <input class="btn btn-info" type="submit" name="signup" value="post">
        </div>
    </form>
</div>