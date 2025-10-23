<?php
/*
Template Name: Custom Register Page
*/
get_header(); ?>

<main id="primary" class="site-main min-h-screen bg-gray-50 flex items-center justify-center py-12">
    <div class="max-w-md w-full bg-white rounded-lg shadow-lg p-8">
        <!-- Breadcrumbs -->
        <nav class="mb-6">
            <ol class="flex items-center space-x-2 text-sm text-gray-600">
                <li><a href="<?php echo home_url(); ?>" class="hover:text-blue-600">Main</a></li>
                <li class="text-gray-400">></li>
                <li class="text-gray-800">Register</li>
            </ol>
        </nav>

        <!-- Registration Form -->
        <form method="post" action="<?php echo home_url('/wp-login.php?action=register'); ?>" class="space-y-6">
            <?php wp_nonce_field('ajax-register-nonce', 'security'); ?>
            
            <!-- First Name Field -->
            <div>
                <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">FIRST NAME</label>
                <input type="text" 
                       id="first_name" 
                       name="first_name" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                       placeholder="Nina" 
                       required>
            </div>

            <!-- Last Name Field -->
            <div>
                <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">LAST NAME</label>
                <input type="text" 
                       id="last_name" 
                       name="last_name" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                       placeholder="Nina" 
                       required>
            </div>

            <!-- Birth Date Field -->
            <div>
                <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-2">BIRTH DATE</label>
                <div class="relative">
                    <input type="date" 
                           id="birth_date" 
                           name="birth_date" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent pr-12" 
                           required>
                    <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>

            <!-- Email Field -->
            <div>
                <label for="user_email" class="block text-sm font-medium text-gray-700 mb-2">E-MAIL</label>
                <input type="email" 
                       id="user_email" 
                       name="user_email" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                       placeholder="example@mail.com" 
                       required>
                <p class="mt-1 text-xs text-gray-500">We will send a verification code to this email</p>
            </div>

            <!-- Password Field -->
            <div>
                <label for="user_pass" class="block text-sm font-medium text-gray-700 mb-2">PASSWORD</label>
                <div class="relative">
                    <input type="password" 
                           id="user_pass" 
                           name="user_pass" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent pr-12" 
                           placeholder="at least 6 characters" 
                           required>
                    <button type="button" 
                            onclick="togglePassword('user_pass')" 
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Repeat Password Field -->
            <div>
                <label for="user_pass_confirm" class="block text-sm font-medium text-gray-700 mb-2">REPEAT PASSWORD</label>
                <div class="relative">
                    <input type="password" 
                           id="user_pass_confirm" 
                           name="user_pass_confirm" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent pr-12" 
                           placeholder="at least 6 characters" 
                           required>
                    <button type="button" 
                            onclick="togglePassword('user_pass_confirm')" 
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Register Button -->
            <button type="submit" 
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-lg transition duration-200 flex items-center justify-center space-x-2">
                <span>Register</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>

            <!-- Login Link -->
            <div class="text-center">
                <p class="text-sm text-gray-600">
                    Already have an account? 
                    <a href="<?php echo home_url('/login'); ?>" class="text-blue-600 hover:text-blue-700 underline font-medium">
                        Log in
                    </a>
                </p>
            </div>
        </form>
    </div>
</main>

<script>
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const type = field.getAttribute('type') === 'password' ? 'text' : 'password';
    field.setAttribute('type', type);
}
</script>

<?php get_footer(); ?>
