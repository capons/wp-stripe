<?php
/**
 * @var $sign_up_link string
 * @var $errors array
 * @var $data array
 */
?>

<div class="wrap get-site-control">
    <div class="tool-box full-width">
        <form action="" method="POST" data-form-validate="">
            <h1>Sign in to GetSiteControl</h1>

            <?php if(!empty($errors['__all__'])): ?>
                <div class="general-validation-message">
                    <?php echo $errors['__all__'][0]; ?>
                </div>
            <?php endif; ?>

            <?php wp_nonce_field(); ?>

            <div class="form-group <?php echo (!empty($errors['email'])) ? 'has-error'  : ''; ?>">
                <label class="control-label" for="email">Email</label>
                <input id="email" placeholder="Enter your email" class="form-control" name="gsc_email" type="email" value="<?php echo !empty($data['email']) ? $data['email'] : ''; ?>">

                <div class="validation-container">
                    <span class="validation-message" data-message="required">Specify your email address</span>
                    <span class="validation-message" data-message="email">Please enter a valid email address</span>
                    <span class="validation-message show" data-message="server"><?php echo (!empty($errors['email'])) ? $errors['email'][0]  : ''; ?></span>
                </div>
            </div>

            <div class="form-group <?php echo (!empty($errors['password'])) ? 'has-error'  : ''; ?>">
                <label class="control-label" for="password">Password</label>
                <input id="password"  placeholder="Enter your password" class="form-control" name="gsc_password" type="password" value="<?php echo !empty($data['password']) ? $data['password'] : ''; ?>">

                <div class="validation-container">
                    <span class="validation-message" data-message="required">Enter your password</span>
                    <span class="validation-message" data-message="minlength">Your password must have a minimum of 4 characters</span>
                    <span class="validation-message show" data-message="server"><?php echo (!empty($errors['password'])) ? $errors['password'][0]  : ''; ?></span>
                </div>
            </div>

            <div class="submit-alternative clear">
                <div class="submit-block">
                    <input type="submit" name="gsc_sign_in" value="Sign In" class="button-primary" />
                </div>
                <div class="alternative-block">
                    <div class="create-account mt20">New user? <a href="<?php echo $sign_up_link; ?>">Create an account</a></div>
                </div>
            </div>
        </form>
    </div>
</div>
