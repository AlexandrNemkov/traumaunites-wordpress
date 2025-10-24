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
        
        <!-- Edit Profile Form -->
        <form action="<?php echo admin_url('admin-post.php'); ?>" method="post" class="max-w-400 mx-auto" data-js="form">
            <input type="hidden" name="action" value="update_profile">
            <?php wp_nonce_field('update_profile_nonce', 'profile_nonce'); ?>
            
            <h1 class="text-28 font-semibold md:text-32 leading-none mb-20">Edit Profile</h1>
            
            <div class="flex flex-col gap-32">
                <!-- Personal Information -->
                <div class="flex flex-col gap-4">
                    <label class="uppercase font-semibold text-16 text-black text-opacity-50">Name</label>
                    <div class="relative">
                        <input type="text" name="first_name" class="tw-input" placeholder="Enter your name" value="<?php echo esc_attr($current_user->first_name); ?>" required>
                        <svg class="tw-input-icon pointer-events-none"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#profile"></use></svg>
                    </div>
                </div>
                
                <div class="flex flex-col gap-4">
                    <label class="uppercase font-semibold text-16 text-black text-opacity-50">Email</label>
                    <div class="relative">
                        <input type="email" name="user_email" class="tw-input" placeholder="Enter your email" value="<?php echo esc_attr($current_user->user_email); ?>" required>
                        <svg class="tw-input-icon pointer-events-none"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#message"></use></svg>
                    </div>
                </div>
                
                <div class="flex flex-col gap-4">
                    <label class="uppercase font-semibold text-16 text-black text-opacity-50">Phone</label>
                    <div class="relative">
                        <input type="tel" name="phone" class="tw-input" placeholder="Enter your phone" value="<?php echo isset($user_meta['phone'][0]) ? esc_attr($user_meta['phone'][0]) : ''; ?>">
                        <svg class="tw-input-icon pointer-events-none"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#time"></use></svg>
                    </div>
                </div>
                
                <div class="flex flex-col gap-4">
                    <label class="uppercase font-semibold text-16 text-black text-opacity-50">Date of Birth</label>
                    <div class="relative">
                        <input type="date" name="birth_date" class="tw-input" value="<?php echo isset($user_meta['birth_date'][0]) ? esc_attr($user_meta['birth_date'][0]) : ''; ?>">
                        <svg class="tw-input-icon pointer-events-none"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#calendar"></use></svg>
                    </div>
                </div>
                
                <div class="flex flex-col gap-4">
                    <label class="uppercase font-semibold text-16 text-black text-opacity-50">Address</label>
                    <div class="relative">
                        <input type="text" name="address" class="tw-input" placeholder="Enter your address" value="<?php echo isset($user_meta['address'][0]) ? esc_attr($user_meta['address'][0]) : ''; ?>">
                        <svg class="tw-input-icon pointer-events-none"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#profile"></use></svg>
                    </div>
                </div>
                
                <!-- Emergency Contact -->
                <div class="flex flex-col gap-4">
                    <label class="uppercase font-semibold text-16 text-black text-opacity-50">Emergency Contact Name</label>
                    <div class="relative">
                        <input type="text" name="emergency_contact_name" class="tw-input" placeholder="Enter emergency contact name" value="<?php echo isset($user_meta['emergency_contact_name'][0]) ? esc_attr($user_meta['emergency_contact_name'][0]) : ''; ?>">
                        <svg class="tw-input-icon pointer-events-none"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#profile"></use></svg>
                    </div>
                </div>
                
                <div class="flex flex-col gap-4">
                    <label class="uppercase font-semibold text-16 text-black text-opacity-50">Emergency Contact Phone</label>
                    <div class="relative">
                        <input type="tel" name="emergency_contact_phone" class="tw-input" placeholder="Enter emergency contact phone" value="<?php echo isset($user_meta['emergency_contact_phone'][0]) ? esc_attr($user_meta['emergency_contact_phone'][0]) : ''; ?>">
                        <svg class="tw-input-icon pointer-events-none"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#time"></use></svg>
                    </div>
                </div>
                
                <!-- Medical Information -->
                <div class="flex flex-col gap-4">
                    <label class="uppercase font-semibold text-16 text-black text-opacity-50">Medical Conditions</label>
                    <div class="relative">
                        <input type="text" name="medical_conditions" class="tw-input" placeholder="Enter any medical conditions" value="<?php echo isset($user_meta['medical_conditions'][0]) ? esc_attr($user_meta['medical_conditions'][0]) : ''; ?>">
                        <svg class="tw-input-icon pointer-events-none"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#tick"></use></svg>
                    </div>
                </div>
                
                <div class="flex flex-col gap-4">
                    <label class="uppercase font-semibold text-16 text-black text-opacity-50">Allergies</label>
                    <div class="relative">
                        <input type="text" name="allergies" class="tw-input" placeholder="Enter any allergies" value="<?php echo isset($user_meta['allergies'][0]) ? esc_attr($user_meta['allergies'][0]) : ''; ?>">
                        <svg class="tw-input-icon pointer-events-none"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#tick"></use></svg>
                    </div>
                </div>
                
                <div class="flex flex-col gap-4">
                    <label class="uppercase font-semibold text-16 text-black text-opacity-50">Current Medications</label>
                    <div class="relative">
                        <input type="text" name="current_medications" class="tw-input" placeholder="Enter current medications" value="<?php echo isset($user_meta['current_medications'][0]) ? esc_attr($user_meta['current_medications'][0]) : ''; ?>">
                        <svg class="tw-input-icon pointer-events-none"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#tick"></use></svg>
                    </div>
                </div>
                
                <!-- Insurance Information -->
                <div class="flex flex-col gap-4">
                    <label class="uppercase font-semibold text-16 text-black text-opacity-50">Insurance Provider</label>
                    <div class="relative">
                        <input type="text" name="insurance_company" class="tw-input" placeholder="Enter insurance provider" value="<?php echo isset($user_meta['insurance_company'][0]) ? esc_attr($user_meta['insurance_company'][0]) : ''; ?>">
                        <svg class="tw-input-icon pointer-events-none"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#tick"></use></svg>
                    </div>
                </div>
                
                <div class="flex flex-col gap-4">
                    <label class="uppercase font-semibold text-16 text-black text-opacity-50">Policy Number</label>
                    <div class="relative">
                        <input type="text" name="policy_number" class="tw-input" placeholder="Enter policy number" value="<?php echo isset($user_meta['policy_number'][0]) ? esc_attr($user_meta['policy_number'][0]) : ''; ?>">
                        <svg class="tw-input-icon pointer-events-none"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#tick"></use></svg>
                    </div>
                </div>
                
                <!-- Privacy Policy -->
                <div class="tw-checkbox-label">
                    <input type="checkbox" name="privacy_policy" class="tw-checkbox" required>
                    <span class="tw-checkbox-text">
                        I agree to the <a href="#" class="underline">Privacy Policy</a> and <a href="#" class="underline">Terms of Service</a>
                    </span>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex gap-20 mt-20">
                    <button type="submit" class="tw-btn tw-btn--secondary">Save Changes</button>
                    <a href="<?php echo home_url('/profile'); ?>" class="tw-btn tw-btn--clear text-red-40">Cancel</a>
                </div>
                
                <div class="text-red-40" data-js="form_error" hidden></div>
            </div>
        </form>
        
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
    // Checkbox functionality
    const checkboxes = document.querySelectorAll('.tw-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                this.classList.add('checked');
            } else {
                this.classList.remove('checked');
            }
        });
    });
});
</script>

<?php get_footer(); ?>
