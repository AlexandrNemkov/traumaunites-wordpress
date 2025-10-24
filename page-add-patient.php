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
            
            <h1 class="text-28 font-semibold md:text-32 leading-none mb-20">Add New Patient</h1>
            
            <div class="flex flex-col gap-32">
                <!-- Personal Information -->
                <div class="flex flex-col gap-4">
                    <label class="uppercase font-semibold text-16 text-black text-opacity-50">First Name</label>
                    <div class="relative">
                        <input type="text" name="first_name" class="tw-input" placeholder="Enter first name" required>
                        <svg class="tw-input-icon pointer-events-none"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#profile"></use></svg>
                    </div>
                </div>
                
                <div class="flex flex-col gap-4">
                    <label class="uppercase font-semibold text-16 text-black text-opacity-50">Last Name</label>
                    <div class="relative">
                        <input type="text" name="last_name" class="tw-input" placeholder="Enter last name" required>
                        <svg class="tw-input-icon pointer-events-none"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#profile"></use></svg>
                    </div>
                </div>
                
                <div class="flex flex-col gap-4">
                    <label class="uppercase font-semibold text-16 text-black text-opacity-50">Email</label>
                    <div class="relative">
                        <input type="email" name="email" class="tw-input" placeholder="Enter email address" required>
                        <svg class="tw-input-icon pointer-events-none"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#message"></use></svg>
                    </div>
                </div>
                
                <div class="flex flex-col gap-4">
                    <label class="uppercase font-semibold text-16 text-black text-opacity-50">Phone Number</label>
                    <div class="relative">
                        <input type="tel" name="phone" class="tw-input" placeholder="Enter phone number" required>
                        <svg class="tw-input-icon pointer-events-none"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#time"></use></svg>
                    </div>
                </div>
                
                <div class="flex flex-col gap-4">
                    <label class="uppercase font-semibold text-16 text-black text-opacity-50">Date of Birth</label>
                    <div class="relative">
                        <input type="date" name="birth_date" class="tw-input" required>
                        <svg class="tw-input-icon pointer-events-none"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#calendar"></use></svg>
                    </div>
                </div>
                
                <div class="flex flex-col gap-4">
                    <label class="uppercase font-semibold text-16 text-black text-opacity-50">Gender</label>
                    <div class="relative">
                        <select name="gender" class="tw-input" required>
                            <option value="">Select gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                            <option value="prefer-not-to-say">Prefer not to say</option>
                        </select>
                        <svg class="tw-input-icon pointer-events-none"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#down"></use></svg>
                    </div>
                </div>
                
                <div class="flex flex-col gap-4">
                    <label class="uppercase font-semibold text-16 text-black text-opacity-50">Address</label>
                    <div class="relative">
                        <input type="text" name="address" class="tw-input" placeholder="Enter full address">
                        <svg class="tw-input-icon pointer-events-none"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#profile"></use></svg>
                    </div>
                </div>
                
                <!-- Emergency Contact -->
                <div class="flex flex-col gap-4">
                    <label class="uppercase font-semibold text-16 text-black text-opacity-50">Emergency Contact Name</label>
                    <div class="relative">
                        <input type="text" name="emergency_contact_name" class="tw-input" placeholder="Enter emergency contact name">
                        <svg class="tw-input-icon pointer-events-none"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#profile"></use></svg>
                    </div>
                </div>
                
                <div class="flex flex-col gap-4">
                    <label class="uppercase font-semibold text-16 text-black text-opacity-50">Emergency Contact Phone</label>
                    <div class="relative">
                        <input type="tel" name="emergency_contact_phone" class="tw-input" placeholder="Enter emergency contact phone">
                        <svg class="tw-input-icon pointer-events-none"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#time"></use></svg>
                    </div>
                </div>
                
                <div class="flex flex-col gap-4">
                    <label class="uppercase font-semibold text-16 text-black text-opacity-50">Relationship to Patient</label>
                    <div class="relative">
                        <select name="relationship" class="tw-input">
                            <option value="">Select relationship</option>
                            <option value="spouse">Spouse</option>
                            <option value="parent">Parent</option>
                            <option value="child">Child</option>
                            <option value="sibling">Sibling</option>
                            <option value="friend">Friend</option>
                            <option value="other">Other</option>
                        </select>
                        <svg class="tw-input-icon pointer-events-none"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#down"></use></svg>
                    </div>
                </div>
                
                <!-- Medical Information -->
                <div class="flex flex-col gap-4">
                    <label class="uppercase font-semibold text-16 text-black text-opacity-50">Medical Conditions</label>
                    <div class="relative">
                        <input type="text" name="medical_conditions" class="tw-input" placeholder="Enter any medical conditions">
                        <svg class="tw-input-icon pointer-events-none"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#tick"></use></svg>
                    </div>
                </div>
                
                <div class="flex flex-col gap-4">
                    <label class="uppercase font-semibold text-16 text-black text-opacity-50">Allergies</label>
                    <div class="relative">
                        <input type="text" name="allergies" class="tw-input" placeholder="Enter any allergies">
                        <svg class="tw-input-icon pointer-events-none"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#tick"></use></svg>
                    </div>
                </div>
                
                <div class="flex flex-col gap-4">
                    <label class="uppercase font-semibold text-16 text-black text-opacity-50">Current Medications</label>
                    <div class="relative">
                        <input type="text" name="current_medications" class="tw-input" placeholder="Enter current medications">
                        <svg class="tw-input-icon pointer-events-none"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#tick"></use></svg>
                    </div>
                </div>
                
                <!-- Insurance Information -->
                <div class="flex flex-col gap-4">
                    <label class="uppercase font-semibold text-16 text-black text-opacity-50">Insurance Provider</label>
                    <div class="relative">
                        <input type="text" name="insurance_company" class="tw-input" placeholder="Enter insurance provider">
                        <svg class="tw-input-icon pointer-events-none"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#tick"></use></svg>
                    </div>
                </div>
                
                <div class="flex flex-col gap-4">
                    <label class="uppercase font-semibold text-16 text-black text-opacity-50">Policy Number</label>
                    <div class="relative">
                        <input type="text" name="policy_number" class="tw-input" placeholder="Enter policy number">
                        <svg class="tw-input-icon pointer-events-none"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#tick"></use></svg>
                    </div>
                </div>
                
                <div class="flex flex-col gap-4">
                    <label class="uppercase font-semibold text-16 text-black text-opacity-50">Group Number</label>
                    <div class="relative">
                        <input type="text" name="group_number" class="tw-input" placeholder="Enter group number">
                        <svg class="tw-input-icon pointer-events-none"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#tick"></use></svg>
                    </div>
                </div>
                
                <!-- Additional Information -->
                <div class="flex flex-col gap-4">
                    <label class="uppercase font-semibold text-16 text-black text-opacity-50">Reason for Visit</label>
                    <div class="relative">
                        <input type="text" name="reason_for_visit" class="tw-input" placeholder="Enter reason for visit">
                        <svg class="tw-input-icon pointer-events-none"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#tick"></use></svg>
                    </div>
                </div>
                
                <div class="flex flex-col gap-4">
                    <label class="uppercase font-semibold text-16 text-black text-opacity-50">Preferred Doctor</label>
                    <div class="relative">
                        <select name="preferred_doctor" class="tw-input">
                            <option value="">Select preferred doctor</option>
                            <option value="dr-smith">Dr. Smith</option>
                            <option value="dr-johnson">Dr. Johnson</option>
                            <option value="dr-williams">Dr. Williams</option>
                            <option value="dr-brown">Dr. Brown</option>
                        </select>
                        <svg class="tw-input-icon pointer-events-none"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#down"></use></svg>
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
                    <button type="submit" class="tw-btn tw-btn--secondary">Add Patient</button>
                    <a href="<?php echo home_url('/profile'); ?>" class="tw-btn tw-btn--clear text-red-40">Cancel</a>
                </div>
                
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
