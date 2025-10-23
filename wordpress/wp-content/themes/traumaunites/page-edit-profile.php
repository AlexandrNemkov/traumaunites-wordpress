<?php
/*
Template Name: Edit Profile Page
*/
get_header(); ?>

<section class="relative mt-24">
    <div class="container">
        <div class="flex items-center gap-4 flex-wrap text-black text-opacity-80">
            <a href="<?php echo home_url(); ?>" class="transition hover:text-blue-60">Main</a>
            <svg class="size-16"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#right"></use></svg>
            <a href="<?php echo home_url('/profile'); ?>" class="transition hover:text-blue-60">Profile</a>
            <svg class="size-16"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#right"></use></svg>
            <span class="text-opacity-100 text-blue-60">Edit</span>
        </div>
    </div>
</section>

<section class="relative mt-40 lg:mt-64">
    <div class="container">
        <?php if (is_user_logged_in()) : ?>
        <?php 
        $current_user = wp_get_current_user();
        $user_meta = get_user_meta($current_user->ID);
        ?>
        
        <!-- Personal Information Form -->
        <form action="<?php echo admin_url('admin-post.php'); ?>" method="post" class="max-w-400 mx-auto" data-js="form">
            <input type="hidden" name="action" value="update_profile">
            <?php wp_nonce_field('update_profile_nonce', 'profile_nonce'); ?>
            <div class="flex flex-col gap-20">
                <div class="text-28 font-semibold md:text-32 leading-none">Personal</div>
                <div>
                    <div class="uppercase font-semibold text-16 text-black text-opacity-50">Name</div>
                    <input type="text" name="first_name" class="tw-input mt-4" placeholder="Nina" value="<?php echo esc_attr($current_user->first_name); ?>" required>
                </div>
                <div>
                    <div class="uppercase font-semibold text-16 text-black text-opacity-50">Surname(s)</div>
                    <input type="text" name="last_name" class="tw-input mt-4" placeholder="Rio" value="<?php echo esc_attr($current_user->last_name); ?>">
                </div>
                <div>
                    <div class="uppercase font-semibold text-16 text-black text-opacity-50">Date of birth</div>
                    <div class="relative mt-4">
                        <input type="date" name="birth_date" class="tw-input" value="<?php echo isset($user_meta['birth_date'][0]) ? esc_attr($user_meta['birth_date'][0]) : ''; ?>">
                        <svg class="tw-input-icon pointer-events-none"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#calendar"></use></svg>
                    </div>
                </div>
                <div>
                    <div class="uppercase font-semibold text-16 text-black text-opacity-50">Insurance company</div>
                    <input type="text" name="insurance_company" class="tw-input mt-4" placeholder="Not selected" value="<?php echo isset($user_meta['insurance_company'][0]) ? esc_attr($user_meta['insurance_company'][0]) : ''; ?>">
                </div>
                <button type="submit" class="tw-btn tw-btn--secondary mt-12 w-full">Save</button>
                <div class="text-red-40" data-js="form_error" hidden></div>
            </div>
        </form>
        
        <!-- Email Form -->
        <form action="<?php echo admin_url('admin-post.php'); ?>" method="post" class="max-w-400 mx-auto mt-40" data-js="form">
            <input type="hidden" name="action" value="update_email">
            <?php wp_nonce_field('update_email_nonce', 'email_nonce'); ?>
            <div class="text-28 font-semibold md:text-32 leading-none">E-mail</div>
            <div class="flex flex-col gap-20 mt-20" data-js="form_fields">
                <div>
                    <div class="uppercase font-semibold text-16 text-black text-opacity-50">E-mail</div>
                    <input type="email" name="user_email" class="tw-input mt-4" placeholder="example@mail.com" value="<?php echo esc_attr($current_user->user_email); ?>" required>
                </div>
                <button type="submit" class="tw-btn tw-btn--secondary mt-12 w-full">Save</button>
                <div class="text-red-40" data-js="form_error" hidden></div>
            </div>
        </form>
        
        <!-- Password Form -->
        <form action="<?php echo admin_url('admin-post.php'); ?>" method="post" class="max-w-400 mx-auto mt-40" data-js="form">
            <input type="hidden" name="action" value="update_password">
            <?php wp_nonce_field('update_password_nonce', 'password_nonce'); ?>
            <div class="flex flex-col gap-20">
                <div class="text-28 font-semibold md:text-32 leading-none">Password</div>
                <div>
                    <div class="uppercase font-semibold text-16 text-black text-opacity-50">Actual password</div>
                    <div class="relative mt-4">
                        <input type="password" name="current_password" class="tw-input" placeholder="Enter actual password" minlength="6" required>
                        <svg class="tw-input-icon" data-js="password_view"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#eye"></use></svg>
                    </div>
                </div>
                <div>
                    <div class="uppercase font-semibold text-16 text-black text-opacity-50">New password</div>
                    <div class="relative mt-4">
                        <input type="password" name="new_password" class="tw-input" placeholder="Enter new password" minlength="6" required>
                        <svg class="tw-input-icon" data-js="password_view"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#eye"></use></svg>
                    </div>
                </div>
                <button type="submit" class="tw-btn tw-btn--secondary mt-12 w-full">Change password</button>
                <div class="text-red-40" data-js="form_error" hidden></div>
            </div>
        </form>
        
        <!-- Delete Profile -->
        <div class="max-w-400 mx-auto mt-40" data-js="form">
            <div class="flex flex-col items-start gap-20">
                <div class="text-28 font-semibold md:text-32 leading-none">Delete profile</div>
                <div>After deleting your profile, you will not be able to restore your appointment history.</div>
                <a href="#delete_profile" data-fancybox class="text-20 font-semibold text-red-40 mt-4">Delete</a>
            </div>
        </div>
        
        <div id="delete_profile" class="hidden w-400">
            <form action="<?php echo admin_url('admin-post.php'); ?>" method="post" data-js="form">
                <input type="hidden" name="action" value="delete_profile">
                <?php wp_nonce_field('delete_profile_nonce', 'delete_nonce'); ?>
                <div class="text-28 font-semibold">Do you want to delete profile?</div>
                <div class="mt-20">After deleting your profile, you will not be able to restore your appointment history.</div>
                <div class="flex items-center justify-between gap-16 mt-20">
                    <button type="button" class="tw-btn tw-btn--arrow group" data-fancybox-close>
                        <span>No, cancel</span>
                        <svg class="tw-btn-icon p-4"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#arrow-up"></use></svg>
                    </button>
                    <button type="submit" class="text-20 font-semibold text-red-40">Delete</button>
                </div>
            </form>
        </div>
        
        <?php else : ?>
        <div class="text-center py-20">
            <h1 class="text-28 font-semibold leading-none md:text-48">Please log in to edit your profile</h1>
            <div class="mt-20">
                <a href="<?php echo home_url('/login'); ?>" class="tw-btn tw-btn--arrow group">
                    <span>Log in</span>
                    <svg class="tw-btn-icon p-4"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#arrow-up"></use></svg>
                </a>
            </div>
        </div>
        <?php endif; ?>
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
