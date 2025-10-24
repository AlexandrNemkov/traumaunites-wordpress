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
        
        <!-- Profile Header -->
        <div class="flex items-start gap-24">
            <div class="flex-1">
                <div class="flex items-center gap-16">
                    <h1 class="text-28 font-semibold leading-none md:text-48"><?php echo esc_html($current_user->display_name); ?></h1>
                    <a href="<?php echo home_url('/add-patient'); ?>" class="flex items-center justify-center size-40 bg-blue-20 border-4 border-white rounded-full">
                        <svg class="size-24 text-blue-60"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#plus"></use></svg>
                    </a>
                </div>
                <div class="mt-16 flex flex-col gap-12">
                    <div class="flex items-center gap-12">
                        <svg class="size-24 text-black text-opacity-50"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#message"></use></svg>
                        <span class="text-20 font-semibold text-black">Email:</span>
                        <span class="text-20 font-semibold text-black text-opacity-50"><?php echo esc_html($current_user->user_email); ?></span>
                    </div>
                    <div class="flex items-center gap-12">
                        <svg class="size-24 text-black text-opacity-50"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#time"></use></svg>
                        <span class="text-20 font-semibold text-black">Phone:</span>
                        <span class="text-20 font-semibold text-black text-opacity-50"><?php echo isset($user_meta['phone'][0]) ? esc_html($user_meta['phone'][0]) : 'Not specified'; ?></span>
                    </div>
                    <div class="flex items-center gap-12">
                        <svg class="size-24 text-black text-opacity-50"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#calendar"></use></svg>
                        <span class="text-20 font-semibold text-black">Date of Birth:</span>
                        <span class="text-20 font-semibold text-black text-opacity-50"><?php echo isset($user_meta['birth_date'][0]) ? esc_html($user_meta['birth_date'][0]) : 'Not specified'; ?></span>
                    </div>
                    <div class="flex items-center gap-12">
                        <svg class="size-24 text-black text-opacity-50"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#profile"></use></svg>
                        <span class="text-20 font-semibold text-black">Address:</span>
                        <span class="text-20 font-semibold text-black text-opacity-50"><?php echo isset($user_meta['address'][0]) ? esc_html($user_meta['address'][0]) : 'Not specified'; ?></span>
                    </div>
                </div>
            </div>
            <div class="flex flex-col items-end gap-20">
                <div class="flex items-end gap-20">
                    <a href="<?php echo home_url('/edit-profile'); ?>" class="tw-btn tw-btn--secondary">Edit Profile</a>
                    <a href="<?php echo wp_logout_url(home_url()); ?>" class="tw-btn tw-btn--clear text-red-40">Delete Account</a>
                </div>
            </div>
        </div>
        <!-- Appointments Section -->
        <div class="mt-40 flex flex-col gap-20">
            <div class="flex items-center gap-20">
                <h2 class="text-32 font-semibold leading-none">Appointments</h2>
                <div class="flex items-center gap-4 bg-blue-40 rounded-6 p-4 w-160">
                    <a href="#all" class="flex-1 uppercase px-4 rounded-4 leading-tag bg-white text-blue-60 text-12 font-bold" data-js="tab">All</a>
                    <a href="#upcoming" class="flex-1 uppercase px-4 rounded-4 leading-tag text-white text-opacity-60 text-12 font-bold" data-js="tab">Upcoming</a>
                </div>
                <div class="text-20 font-semibold text-black">
                    If you need to reschedule or cancel an appointment, please call us at <span class="text-blue-40">+1 (555) 123-4567</span>
                </div>
            </div>
            <div id="all" class="mt-20 flex flex-col gap-20" data-js="tab_content">
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
                <?php foreach ($appointments as $appointment) : 
                    $appointment_date = get_post_meta($appointment->ID, 'appointment_date', true);
                    $appointment_time = get_post_meta($appointment->ID, 'appointment_time', true);
                    $appointment_status = get_post_meta($appointment->ID, 'appointment_status', true);
                    $appointment_description = get_post_meta($appointment->ID, 'appointment_description', true);
                    $doctor_name = get_post_meta($appointment->ID, 'doctor_name', true);
                ?>
                <div class="bg-blue-20 p-24 rounded-24">
                    <div class="flex gap-24">
                        <div class="flex-1 flex flex-col gap-20">
                            <div class="flex justify-between items-start">
                                <div class="flex flex-col gap-16">
                                    <div class="flex items-center gap-8">
                                        <svg class="size-24 text-black text-opacity-50"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#calendar"></use></svg>
                                        <span class="text-20 font-semibold text-black text-opacity-80"><?php echo esc_html($appointment_date); ?></span>
                                    </div>
                                    <div class="flex items-center gap-8">
                                        <svg class="size-24 text-black text-opacity-50"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#time"></use></svg>
                                        <span class="text-20 font-semibold text-black text-opacity-80"><?php echo esc_html($appointment_time); ?></span>
                                    </div>
                                    <div class="flex items-center gap-8">
                                        <svg class="size-24 text-black text-opacity-50"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#doctor"></use></svg>
                                        <span class="text-20 font-semibold text-black text-opacity-80"><?php echo esc_html($doctor_name ? $doctor_name : 'Dr. Smith'); ?></span>
                                    </div>
                                    <div class="flex items-center gap-8">
                                        <svg class="size-24 text-black text-opacity-50"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#tick"></use></svg>
                                        <span class="text-20 font-semibold text-black text-opacity-80"><?php echo esc_html($appointment->post_title); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="pl-32 flex flex-col gap-8">
                                <h3 class="text-16 font-normal text-black">Appointment Details</h3>
                                <p class="text-16 font-normal text-black text-opacity-50"><?php echo esc_html($appointment_description ? $appointment_description : 'Regular checkup and health assessment. Please arrive 15 minutes early for paperwork.'); ?></p>
                            </div>
                            <div class="w-full max-w-600 p-12 border border-blue-40 rounded-16 flex flex-col gap-8">
                                <h4 class="text-20 font-semibold text-black text-opacity-80">Important Message</h4>
                                <p class="text-16 font-normal text-black text-opacity-80">Please bring your insurance card and a list of current medications.</p>
                            </div>
                        </div>
                        <div class="flex flex-col items-end gap-16">
                            <div class="flex items-center gap-16">
                                <?php 
                                $status_class = 'status-pending';
                                $status_text = 'Pending';
                                if ($appointment_status === 'confirmed') {
                                    $status_class = 'status-confirmed';
                                    $status_text = 'Confirmed';
                                } elseif ($appointment_status === 'completed') {
                                    $status_class = 'status-canceled';
                                    $status_text = 'Completed';
                                }
                                ?>
                                <div class="px-8 py-2 rounded-full backdrop-blur-4 <?php echo $status_class; ?> text-12 font-bold uppercase leading-tag">
                                    <?php echo esc_html($status_text); ?>
                                </div>
                            </div>
                            <div class="flex items-center justify-center size-24 bg-blue-60 rounded-full">
                                <svg class="size-16 text-white"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#dots"></use></svg>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
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
            <div id="upcoming" class="mt-20 flex flex-col gap-20" data-js="tab_content" hidden>
                <div class="mt-20 min-h-240 flex flex-col items-center justify-center text-center">
                    This is where your upcoming appointments will be stored
                </div>
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
            tabs.forEach(t => {
                t.classList.remove('bg-white', 'text-blue-60');
                t.classList.add('text-white', 'text-opacity-60');
            });
            tabContents.forEach(content => content.style.display = 'none');
            
            // Add active class to clicked tab
            this.classList.add('bg-white', 'text-blue-60');
            this.classList.remove('text-white', 'text-opacity-60');
            
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
