<?php
/*
Template Name: Custom Login Page
*/
get_header(); ?>

<section class="relative mt-24">
    <div class="container">
        <div class="flex items-center gap-4 flex-wrap text-black text-opacity-80">
            <a href="<?php echo home_url(); ?>" class="transition hover:text-blue-60">Main</a>
            <svg class="size-16"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#right"></use></svg>
            <span class="text-opacity-100 text-blue-60">Log in</span>
        </div>
    </div>
</section>

<section class="relative mt-40 lg:mt-64">
    <div class="container">
        <form method="post" action="<?php echo wp_login_url(); ?>" class="max-w-400 mx-auto" data-js="form">
            <?php wp_nonce_field('ajax-login-nonce', 'security'); ?>
            <div class="flex flex-col gap-20">
                <div>
                    <div class="uppercase font-semibold text-16 text-black text-opacity-50">E-mail</div>
                    <input type="email" name="log" class="tw-input mt-4" placeholder="example@mail.com" required>
                </div>
                <div>
                    <div class="uppercase font-semibold text-16 text-black text-opacity-50">Password</div>
                    <div class="relative mt-4">
                        <input type="password" name="pwd" class="tw-input" placeholder="at least 6 characters" minlength="6" required>
                        <svg class="tw-input-icon" data-js="password_view"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#eye"></use></svg>
                    </div>
                    <div class="text-right mt-10"><a href="<?php echo wp_lostpassword_url(); ?>" class="inline-block mt-8 opacity-50 border-b hover:border-transparent">I forgot password</a></div>
                </div>
                <button type="submit" class="tw-btn tw-btn--arrow mt-16 w-full group">
                    <span>Log in</span>
                    <svg class="tw-btn-icon p-4"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#arrow-up"></use></svg>
                </button>
                <div class="text-red-40" data-js="form_error" hidden></div>
                <div class="mt-16 text-20 font-semibold text-black text-opacity-50">Don't have an account yet? <a href="<?php echo home_url('/register'); ?>" class="text-blue-60">Register</a></div>
            </div>
        </form>
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Password visibility toggle
    const passwordViews = document.querySelectorAll('[data-js="password_view"]');
    passwordViews.forEach(icon => {
        icon.addEventListener('click', function() {
            const input = this.parentElement.querySelector('input');
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
        });
    });
});
</script>

<?php get_footer(); ?>
