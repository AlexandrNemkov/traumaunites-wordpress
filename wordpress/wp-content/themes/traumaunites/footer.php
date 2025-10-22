<footer id="footer" class="pb-16 mt-80 md:mt-120 lg:mt-150">
    <div class="container">
        <div class="bg-blue-60 text-white rounded-24 px-16 py-24 pt-120 relative md:flex md:py-16 lg:px-24">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="bg-white text-black flex items-center gap-6 text-20 font-extrabold leading-none absolute top-0 left-0 py-22 pr-16 rounded-br-24">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.svg" width="20" height="20" alt="<?php bloginfo('name'); ?>">
                <?php bloginfo('name'); ?>
                <div class="bg-white absolute top-0 -right-24"><div class="w-24 h-24 bg-blue-60 rounded-tl-24"></div></div>
                <div class="bg-white absolute -bottom-24 left-0"><div class="w-24 h-24 bg-blue-60 rounded-tl-24"></div></div>
            </a>
            <div class="grid grid-cols-1 gap-48 md:grid-cols-2 md:gap-x-20 lg:flex">
                <div class="lg:flex-1">
                    <div class="uppercase font-semibold">Address</div>
                    <div class="mt-8 text-blue-20 flex items-start flex-col gap-8">
                        <p>Centro MédicoTeknon <br>Dr. Joaquim Casañas <br></p>
                        <p>Consultorios Vilana (despacho 122, planta baja) | Vilana, 12 · 08022 Barcelona</p>
                    </div>
                </div>
                <div class="lg:flex-1">
                    <div class="uppercase font-semibold">Contact</div>
                    <div class="mt-8 text-blue-20 flex items-start flex-col gap-8">
                        <a href="tel:+34933933222">+34 93 393 32 22</a>
                        <a href="mailto:recepcio@traumaunit.es">recepcio@traumaunit.es</a>
                    </div>
                </div>
                <div class="lg:flex-1">
                    <div class="uppercase font-semibold">Social media</div>
                    <div class="mt-8 flex gap-20">
                        <a href="#" target="_blank" class="rounded-full bg-white text-white bg-opacity-20 w-48 h-48 flex transition hover:bg-opacity-50">
                            <svg class="size-24 m-auto"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#facebook"></use></svg>
                        </a>
                        <a href="#" target="_blank" class="rounded-full bg-white text-white bg-opacity-20 w-48 h-48 flex transition hover:bg-opacity-50">
                            <svg class="size-24 m-auto"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#youtube"></use></svg>
                        </a>
                    </div>
                </div>
                <div>
                    <div class="uppercase font-semibold">Legal</div>
                    <div class="mt-8 text-blue-20 flex items-start flex-col gap-10">
                        <a href="#" class="inline-block border-b hover:border-transparent">Privacy policy</a>
                        <a href="#" class="inline-block border-b hover:border-transparent">Cookies policy</a>
                    </div>
                </div>
            </div>
            <div class="text-blue-30 mt-16 md:mt-0 md:self-end md:w-1/3 md:flex-none md:-order-1">Copyright © 2010-<?php echo date('Y'); ?></div>
        </div>
    </div>
</footer>

<div class="flex items-center gap-16 bg-white border-2 border-grey-30 border-b-0 rounded-t-24 fixed bottom-0 max-w-768 left-0 right-0 mx-auto z-1000 p-16 transition translate-y-full md:p-24" data-js="cookie">
    <div class="flex-1">
        <div class="font-bold md:text-24">We use cookies to improve your site experience</div>
        <a href="/legal" class="inline-block mt-8 opacity-50 border-b hover:border-transparent">More about cookies</a>
    </div>
    <button type="button" class="tw-btn tw-btn--secondary flex-none px-32" data-js="cookie_ok">OK</button>
</div>

<?php wp_footer(); ?>
</body>
</html>
