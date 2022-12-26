<?php
\Core\View::render('blocks/header', ['pageTitle' => 'Login']);
?>
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <form class="card mt-5" method="POST" action="<?= url('auth/verify') ?>">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1"
                                   aria-describedby="emailHelp" name="email">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
\Core\View::render('blocks/footer');
