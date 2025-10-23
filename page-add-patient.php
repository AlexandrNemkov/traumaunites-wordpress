<?php
/*
Template Name: Add Patient Page
*/
get_header(); ?>

<section class="relative mt-24">
    <div class="container">
        <div class="flex items-center gap-4 flex-wrap text-black text-opacity-80">
            <a href="<?php echo home_url(); ?>" class="transition hover:text-blue-60">Main</a>
            <svg class="size-16"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#right"></use></svg>
            <a href="<?php echo home_url('/profile'); ?>" class="transition hover:text-blue-60">Profile</a>
            <svg class="size-16"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#right"></use></svg>
            <span class="text-opacity-100 text-blue-60">Add another patient</span>
        </div>
    </div>
</section>

<section class="relative mt-40 lg:mt-64">
    <div class="container">
        <?php if (is_user_logged_in()) : ?>
        <form action="<?php echo admin_url('admin-post.php'); ?>" method="post" class="max-w-400 mx-auto" data-js="form">
            <input type="hidden" name="action" value="add_patient">
            <?php wp_nonce_field('add_patient_nonce', 'patient_nonce'); ?>
            <div class="flex flex-col gap-20">
                <div>
                    <div class="uppercase font-semibold text-16 text-black text-opacity-50">Name</div>
                    <input type="text" name="first_name" class="tw-input mt-4" placeholder="Nina" required>
                </div>
                <div>
                    <div class="uppercase font-semibold text-16 text-black text-opacity-50">Surname(s)</div>
                    <input type="text" name="last_name" class="tw-input mt-4" placeholder="Rio">
                </div>
                <div>
                    <div class="uppercase font-semibold text-16 text-black text-opacity-50">Date of birth</div>
                    <div class="relative mt-4">
                        <input type="date" name="birth_date" class="tw-input" required>
                        <svg class="tw-input-icon pointer-events-none"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#calendar"></use></svg>
                    </div>
                </div>
                <div>
                    <div class="uppercase font-semibold text-16 text-black text-opacity-50">Insurance company</div>
                    <input type="text" name="insurance_company" class="tw-input mt-4" placeholder="Not selected">
                </div>
                <div>
                    <div class="uppercase font-semibold text-16 text-black text-opacity-50">Phone</div>
                    <input type="tel" name="phone" class="tw-input mt-4" placeholder="+34" required>
                </div>
                <div>
                    <div class="uppercase font-semibold text-16 text-black text-opacity-50">E-mail</div>
                    <input type="email" name="email" class="tw-input mt-4" placeholder="example@mail.com" required>
                </div>
                <label class="tw-checkbox-label">
                    <input type="checkbox" name="agree" required>
                    <svg class="tw-checkbox"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#tick"></use></svg>
                    <div class="tw-checkbox-text">This patient agree with <a href="<?php echo home_url('/legal'); ?>">Terms</a></div>
                </label>
                <button type="submit" class="tw-btn tw-btn--secondary mt-12 w-full">Add patient</button>
                <div class="text-red-40" data-js="form_error" hidden></div>
            </div>
        </form>
        <?php else : ?>
        <div class="text-center py-20">
            <h1 class="text-28 font-semibold leading-none md:text-48">Please log in to add a patient</h1>
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

<?php get_footer(); ?>
