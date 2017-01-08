<?php
/**
 * @var $sign_in_link string
 * @var $errors array
 * @var $data array
 */
?>

<div class="wrap get-site-control">
    <h1>Sign up for GetSiteControl</h1>

    <div class="tool-box">
        <form action="" method="POST" data-form-validate="">
            <?php if(!empty($errors['__all__'])): ?>
                <div class="general-validation-message">
                    <?php echo $errors['__all__'][0]; ?>
                </div>
            <?php endif; ?>

            <?php wp_nonce_field(); ?>

            <div class="form-group <?php echo (!empty($errors['name'])) ? 'has-error'  : ''; ?>">
                <label class="control-label" for="name">Name</label>
                <input id="name" name="gsc_name" placeholder="Enter your name" class="form-control" value="<?php echo !empty($data['name']) ? $data['name'] : ''; ?>" type="text">

                <div class="validation-container">
                    <span class="validation-message" data-message="required">Specify your name</span>
                    <span class="validation-message" data-message="name">Please enter a valid name</span>
                    <span class="validation-message show" data-message="server"><?php echo (!empty($errors['name'])) ? $errors['name'][0]  : ''; ?></span>
                </div>
            </div>

            <div class="form-group <?php echo (!empty($errors['email'])) ? 'has-error'  : ''; ?>">
                <label class="control-label" for="email">Email</label>
                <input id="email" name="gsc_email" placeholder="Enter your email" class="form-control" value="<?php echo !empty($data['email']) ? $data['email'] : ''; ?>" type="email">

                <div class="validation-container">
                    <span class="validation-message" data-message="required">Specify your email address</span>
                    <span class="validation-message" data-message="email">Please enter a valid email address</span>
                    <span class="validation-message show" data-message="server"><?php echo (!empty($errors['email'])) ? $errors['email'][0]  : ''; ?></span>
                </div>
            </div>

            <div class="form-group <?php echo (!empty($errors['password'])) ? 'has-error'  : ''; ?>">
                <label class="control-label" for="password">Password</label>
                <input id="password" name="gsc_password" placeholder="Choose a password" class="form-control" value="<?php echo !empty($data['password']) ? $data['password'] : ''; ?>" type="password">

                <div class="validation-container">
                    <span class="validation-message" data-message="required">Enter your password</span>
                    <span class="validation-message" data-message="minlength">Your password must have a minimum of 4 characters</span>
                    <span class="validation-message show" data-message="server"><?php echo (!empty($errors['password'])) ? $errors['password'][0]  : ''; ?></span>
                </div>
            </div>

            <div class="form-group <?php echo (!empty($errors['site'])) ? 'has-error'  : ''; ?>">
                <label class="control-label" for="website">Website</label>
                <input id="website" name="gsc_site" placeholder="Enter your website URL" class="form-control" value="<?php echo !empty($data['site']) ? $data['site'] : ''; ?>" type="url">

                <div class="validation-container">
                    <span class="validation-message" data-message="required">Specify your site URL</span>
                    <span class="validation-message" data-message="url">Please enter a valid URL</span>
                    <span class="validation-message show" data-message="server"><?php echo (!empty($errors['site'])) ? $errors['site'][0]  : ''; ?></span>
                </div>
            </div>

            <div class="submit-alternative clear">
                <div class="submit-block">
                    <input type="submit" class="button-primary" name="gsc_sign_up" value="Sign up" />
                </div>
                <div class="alternative-block">
                    <div class="sign-in">Already a registered user? <a href="<?php echo $sign_in_link; ?>">Sign in</a></div>
                    <div class="create-account">Fill out the form to register or visit the <a href="https://getsitecontrol.com/start" target="_blank">website</a></div>
                </div>
            </div>
        </form>
    </div>

    <ul class="advert">
        <li>
            <span class="advert-icon free"></span>
            <div class="advert-description">
                Create and manage surveys, live chats, contact forms, promo notifications, opt-in forms, follow and share widgets, all in one dashboard.
            </div>
        </li>
        <li>
            <span class="advert-icon payment"></span>
            <div class="advert-description">
                Bars, popups, buttons or panels - you choose how your widgets will look like. Add custom images, choose colors, fonts and animations.
            </div>
        </li>
        <li>
            <span class="advert-icon upgrade"></span>
            <div class="advert-description">
                Sing up and stay on the Free plan for as long as you want. The Free plan does not expire, has no hidden costs and includes all core features.
            </div>
        </li>
    </ul>
</div>