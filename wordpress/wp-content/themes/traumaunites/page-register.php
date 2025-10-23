<?php
/*
Template Name: Custom Register Page
*/
get_header(); ?>

<section class="relative mt-24">
    <div class="container">
        <div class="flex items-center gap-4 flex-wrap text-black text-opacity-80">
            <a href="<?php echo home_url(); ?>" class="transition hover:text-blue-60">Main</a>
            <svg class="size-16"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#right"></use></svg>
            <span class="text-opacity-100 text-blue-60">Register</span>
        </div>
    </div>
</section>

<section class="relative mt-40 lg:mt-64">
    <div class="container">
        <form method="post" action="<?php echo home_url('/wp-login.php?action=register'); ?>" class="max-w-400 mx-auto" data-js="form">
            <?php wp_nonce_field('ajax-register-nonce', 'security'); ?>
            <div class="flex flex-col gap-20" data-js="form_fields">
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
                        <input type="text" name="birth_date" class="tw-input" data-js="datepicker" placeholder="mm/dd/yyyy" readonly required>
                        <svg class="tw-input-icon pointer-events-none"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#calendar"></use></svg>
                    </div>
                </div>
                <div class="text-black text-opacity-80">We will send a verification code to this email</div>
                <div>
                    <div class="uppercase font-semibold text-16 text-black text-opacity-50">E-mail</div>
                    <input type="email" name="user_email" class="tw-input mt-4" placeholder="example@mail.com" required>
                </div>
                <div>
                    <div class="uppercase font-semibold text-16 text-black text-opacity-50">Password</div>
                    <div class="relative mt-4">
                        <input type="password" name="user_pass" class="tw-input" placeholder="at least 6 characters" minlength="6" required>
                        <svg class="tw-input-icon" data-js="password_view"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#eye"></use></svg>
                    </div>
                </div>
                <label class="tw-checkbox-label">
                    <input type="checkbox" name="agree" required>
                    <svg class="tw-checkbox"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#tick"></use></svg>
                    <div class="tw-checkbox-text">By registering I agree with <a href="<?php echo home_url('/legal'); ?>">Terms</a></div>
                </label>
                <button type="submit" class="tw-btn tw-btn--arrow mt-16 w-full group" disabled>
                    <span>Register</span>
                    <svg class="tw-btn-icon p-4"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#arrow-up"></use></svg>
                </button>
                <div class="text-red-40" data-js="form_error" hidden></div>
                <div class="mt-16 text-20 font-semibold text-black text-opacity-50">Already have an account? <a href="<?php echo home_url('/login'); ?>" class="text-blue-60">Log in</a></div>
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

    // Initialize AirDatepicker
    console.log('AirDatepicker available:', typeof AirDatepicker !== 'undefined');
    if (typeof AirDatepicker !== 'undefined') {
        console.log('Initializing AirDatepicker...');
        document.querySelectorAll('[data-js="datepicker"]').forEach(elem => {
            new AirDatepicker(elem, {
                locale: {
                    days: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                    daysShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                    daysMin: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                    months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    today: 'Today',
                    clear: 'Clear',
                    dateFormat: 'mm/dd/yyyy',
                    timeFormat: 'hh:mm aa',
                    firstDay: 0
                },
                container: elem.parentElement,
                classes: 'tw-datepicker',
                prevHtml: '<svg><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#left"></use></svg>',
                nextHtml: '<svg><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#right"></use></svg>',
                autoClose: true,
                minDate: new Date(1900, 0, 1),
                maxDate: new Date(),
                navTitles: {
                    'days': 'yyyy MMMM',
                },
                position({ $datepicker, $target, $pointer }) {
                    $datepicker.style.left = '0';
                    $datepicker.style.right = '0';
                    $datepicker.style.top = ($target.offsetHeight + 4) + 'px';
                },
                onSelect: ({ date, formattedDate, datepicker }) => {
                    elem.dispatchEvent(new Event('change', { bubbles: true }));
                },
            });
        });
    } else {
        console.error('AirDatepicker not loaded! Falling back to native date input.');
        // Fallback: convert to native date input if AirDatepicker fails
        document.querySelectorAll('[data-js="datepicker"]').forEach(elem => {
            elem.type = 'date';
            elem.removeAttribute('readonly');
            elem.removeAttribute('data-js');
        });
    }

    // Form validation and button state
    const form = document.querySelector('[data-js="form"]');
    const submitBtn = form.querySelector('button[type="submit"]');
    const requiredFields = form.querySelectorAll('input[required], input[name="agree"]');
    
    function checkFormValidity() {
        let isValid = true;
        requiredFields.forEach(field => {
            if (field.type === 'checkbox') {
                if (!field.checked) isValid = false;
            } else {
                if (!field.value.trim()) isValid = false;
            }
        });
        submitBtn.disabled = !isValid;
    }
    
    requiredFields.forEach(field => {
        field.addEventListener('input', checkFormValidity);
        field.addEventListener('change', checkFormValidity);
    });
    
    // Initial check
    checkFormValidity();
});
</script>

<?php get_footer(); ?>
