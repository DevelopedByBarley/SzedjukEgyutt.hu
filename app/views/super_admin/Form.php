<div class="container">
    <div class="row">
        <h1 class="display-4 text-center mb-3">Admin Bejelentkezés</h1>
    </div>
    <div class="row mt-5">
        <form class="bg-light p-3" id="admin-login-form" action="/admin/login" method="POST">

            <div class="form-outline mb-4">
                <label class="form-label" for="form1Example1">Név</label>
                <input type="text" id="form1Example1" class="form-control" name="userName"/>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="form1Example2">Jelszó</label>
                <input type="password" id="form1Example2" class="form-control" name="password"/>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-success btn-block">Bejelentkezés</button>
        </form>
    </div>
</div>

<style>
    @media(min-width: 768px) {
        #admin-login-form {
            width: 40%;
            margin: 0 auto;
        }
    }
</style>