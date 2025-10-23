<?php
/*
Template Name: Profile Page
*/
get_header(); ?>

<section class="relative mt-24">
    <div class="container">
        <div class="flex items-center gap-4 flex-wrap text-black text-opacity-80">
            <a href="<?php echo home_url(); ?>" class="transition hover:text-blue-60">Main</a>
            <svg class="size-16"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#right"></use></svg>
            <span class="text-opacity-100 text-blue-60">Profile</span>
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
        <div class="flex items-center gap-16">
            <h1 class="text-28 font-semibold leading-none md:text-48"><?php echo esc_html($current_user->display_name); ?></h1>
            <a href="<?php echo home_url('/add-patient'); ?>" class="tw-btn tw-btn--secondary flex p-0 size-24 md:size-40">
                <svg class="size-24 m-auto"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#plus"></use></svg>
            </a>
            <div class="hidden relative ml-auto items-center gap-20 lg:flex">
                <a href="<?php echo home_url('/edit-profile'); ?>" class="tw-btn tw-btn--secondary">Edit profile</a>
                <a href="<?php echo wp_logout_url(home_url()); ?>" class="tw-btn tw-btn--secondary">Exit</a>
            </div>
            <div class="relative ml-auto lg:hidden">
                <a href="#profile_actions" data-js="dropdown_toggle" class="flex bg-blue-60 rounded-full size-24 text-white">
                    <svg class="size-16 m-auto"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#dots"></use></svg>
                </a>
                <nav id="profile_actions" class="tw-dropdown left-auto w-120" data-js="dropdown">
                    <a href="<?php echo home_url('/edit-profile'); ?>" class="px-16 py-12 bg-white transition hover:text-blue-40">Edit</a>
                    <a href="<?php echo wp_logout_url(home_url()); ?>" class="px-16 py-12 bg-white transition hover:text-blue-40">Exit</a>
                </nav>
            </div>
        </div>
        <div class="mt-16 font-semibold leading-none md:text-20">Date of birth <span class="inline-block ml-10 text-black text-opacity-50"><?php echo isset($user_meta['birth_date'][0]) ? esc_html($user_meta['birth_date'][0]) : 'Not specified'; ?></span></div>
        <div class="mt-4 font-semibold leading-none md:text-20 md:mt-16">Insurance company <span class="inline-block ml-10 text-black text-opacity-50"><?php echo isset($user_meta['insurance_company'][0]) ? esc_html($user_meta['insurance_company'][0]) : 'Not selected'; ?></span></div>
        <div class="mt-40 flex flex-col gap-20 md:flex-row md:items-center">
            <h2 class="text-32 font-semibold leading-none">My appointments</h2>
            <div class="flex items-center gap-4 bg-blue-40 rounded-6 text-white text-opacity-60 p-4 text-12 font-bold">
                <a href="#active" class="flex-1 uppercase px-12 rounded-4 leading-tag bg-white text-blue-60" data-js="tab" data-tab-small="1">Active</a>
                <a href="#archive" class="flex-1 uppercase px-12 rounded-4 leading-tag" data-js="tab" data-tab-small="1">Archive</a>
            </div>
        </div>
        <div id="active" class="mt-20" data-js="tab_content">
            <div class="text-20 font-semibold">If you have questions, <br>please contact us by phone <a href="tel:+34933933222" class="inline-block text-blue-40">+34 93 393 32 22</a></div>
            <?php
            $appointments = get_posts(array(
                'post_type' => 'appointments',
                'meta_key' => 'patient_email',
                'meta_value' => $current_user->user_email,
                'posts_per_page' => -1,
                'post_status' => 'publish'
            ));
            
            if ($appointments) :
            ?>
            <div class="mt-20 flex flex-col gap-20">
                <?php foreach ($appointments as $appointment) : 
                    $appointment_date = get_post_meta($appointment->ID, 'appointment_date', true);
                    $appointment_time = get_post_meta($appointment->ID, 'appointment_time', true);
                    $appointment_status = get_post_meta($appointment->ID, 'appointment_status', true);
                    $appointment_description = get_post_meta($appointment->ID, 'appointment_description', true);
                ?>
                <div class="bg-blue-10 p-24 rounded-24">
                    <div class="flex items-center gap-16">
                        <div class="flex items-center gap-8">
                            <svg class="size-24 text-black text-opacity-50"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#calendar"></use></svg>
                            <div class="text-20 font-semibold text-black text-opacity-80"><?php echo esc_html($appointment_date); ?></div>
                        </div>
                        <div class="ml-auto bg-green-30 bg-opacity-50 rounded-full py-2 px-8 text-white text-12 font-bold uppercase leading-tag"><?php echo esc_html($appointment_status); ?></div>
                        <div class="relative">
                            <a href="#item<?php echo $appointment->ID; ?>_actions" data-js="dropdown_toggle" class="flex bg-blue-60 rounded-full size-24 text-white">
                                <svg class="size-16 m-auto"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#dots"></use></svg>
                            </a>
                            <nav id="item<?php echo $appointment->ID; ?>_actions" class="tw-dropdown left-auto w-120" data-js="dropdown">
                                <a href="" class="px-16 py-12 bg-white transition hover:text-blue-40">Confirm</a>
                                <a href="" class="px-16 py-12 bg-white transition hover:text-blue-40">Cancel</a>
                            </nav>
                        </div>
                    </div>
                    <div class="mt-16 flex items-center gap-8">
                        <svg class="size-24 text-black text-opacity-50"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#time"></use></svg>
                        <div class="text-20 font-semibold text-black text-opacity-80"><?php echo esc_html($appointment_time); ?></div>
                    </div>
                    <div class="mt-20 pl-32">
                        <div>Description</div>
                        <div class="mt-8 text-black text-opacity-50"><?php echo esc_html($appointment_description); ?></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php else : ?>
            <div class="mt-20 min-h-240 flex flex-col items-center justify-center text-center">
                You haven't book an appointment yet
                <a href="<?php echo home_url('/book'); ?>" class="tw-btn tw-btn--arrow flex mt-20 group">
                    <span>Book an appointment</span>
                    <svg class="tw-btn-icon p-4"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#arrow-up"></use></svg>
                </a>
            </div>
            <?php endif; ?>
        </div>
        <div id="archive" class="mt-20" data-js="tab_content" hidden>
            <div class="mt-20 min-h-240 flex flex-col items-center justify-center text-center">
                This is where your past appointments will be stored
            </div>
        </div>
        <?php else : ?>
        <div class="text-center py-20">
            <h1 class="text-28 font-semibold leading-none md:text-48">Please log in to view your profile</h1>
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
    // Tab switching functionality
    const tabs = document.querySelectorAll('[data-js="tab"]');
    const tabContents = document.querySelectorAll('[data-js="tab_content"]');
    
    tabs.forEach(tab => {
        tab.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all tabs
            tabs.forEach(t => t.classList.remove('bg-white', 'text-blue-60'));
            tabContents.forEach(content => content.style.display = 'none');
            
            // Add active class to clicked tab
            this.classList.add('bg-white', 'text-blue-60');
            
            // Show corresponding content
            const targetId = this.getAttribute('href').substring(1);
            const targetContent = document.getElementById(targetId);
            if (targetContent) {
                targetContent.style.display = 'block';
            }
        });
    });
});
</script>

<?php get_footer(); ?>
