<?php
/*
Template Name: Custom Login Page
*/
get_header(); ?>

<main id="primary" class="site-main min-h-screen bg-gray-50 flex items-center justify-center py-12">
    <div class="max-w-md w-full bg-white rounded-lg shadow-lg p-8">
        <!-- Breadcrumbs -->
        <nav class="mb-6">
            <ol class="flex items-center space-x-2 text-sm text-gray-600">
                <li><a href="<?php echo home_url(); ?>" class="hover:text-blue-600">Main</a></li>
                <li class="text-gray-400">></li>
                <li class="text-gray-800">Log in</li>
            </ol>
        </nav>

        <!-- Login Form -->
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Log in</h1>
        </div>

        <form method="post" action="<?php echo wp_login_url(); ?>" class="space-y-6">
            <?php wp_nonce_field('ajax-login-nonce', 'security'); ?>
            
            <!-- Email Field -->
            <div>
                <label for="log" class="block text-sm font-medium text-gray-700 mb-2">E-MAIL</label>
                <input type="email" 
                       id="log" 
                       name="log" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                       placeholder="example@mail.com" 
                       required>
            </div>

            <!-- Password Field -->
            <div>
                <label for="pwd" class="block text-sm font-medium text-gray-700 mb-2">PASSWORD</label>
                <div class="relative">
                    <input type="password" 
                           id="pwd" 
                           name="pwd" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent pr-12" 
                           placeholder="at least 6 characters" 
                           required>
                    <button type="button" 
                            onclick="togglePassword('pwd')" 
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Forgot Password Link -->
            <div class="text-right">
                <a href="<?php echo wp_lostpassword_url(); ?>" class="text-sm text-gray-500 hover:text-blue-600 underline">
                    I forgot password
                </a>
            </div>

            <!-- Login Button -->
            <button type="submit" 
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-lg transition duration-200 flex items-center justify-center space-x-2">
                <span>Login</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>

            <!-- Register Link -->
            <div class="text-center">
                <p class="text-sm text-gray-600">
                    Don't have an account yet? 
                    <a href="<?php echo home_url('/register'); ?>" class="text-blue-600 hover:text-blue-700 underline font-medium">
                        Register
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
