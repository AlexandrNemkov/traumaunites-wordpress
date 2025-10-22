<?php
/**
 * Template part for displaying the about section
 */

$doctors_query = new WP_Query(array(
    'post_type' => 'doctors',
    'posts_per_page' => 3,
    'post_status' => 'publish'
));
?>

<section class="relative mt-80 md:mt-120 lg:mt-150 overflow-hidden">
    <div class="container">
        <h2 class="text-28 font-semibold lg:text-48" data-animate="text">About us</h2>
        <div class="tw-about-carousel f-carousel mt-20 lg:mt-40" data-js="carousel">
            <?php if ($doctors_query->have_posts()) : ?>
                <?php while ($doctors_query->have_posts()) : $doctors_query->the_post(); ?>
                    <div class="f-carousel__slide">
                        <div class="bg-blue-40 rounded-24 p-16 pt-0 text-white flex flex-col gap-16 md:flex-row md:gap-20 md:px-48 md:py-20 lg:gap-60 lg:py-40">
                            <div class="relative -mx-24 md:w-1/2 md:flex-none md:mx-0 md:-my-36 md:order-1 lg:-my-64 lg:w-2/3">
                                <?php if (has_post_thumbnail()) : ?>
                                    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>" alt="<?php the_title(); ?>" class="w-full h-280 object-cover rounded-32 border-8 border-blue-20 md:absolute md:top-0 md:left-0 md:h-full">
                                <?php else : ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/about-slide-1.webp" alt="<?php the_title(); ?>" class="w-full h-280 object-cover rounded-32 border-8 border-blue-20 md:absolute md:top-0 md:left-0 md:h-full">
                                <?php endif; ?>
                            </div>
                            <div class="md:flex-1">
                                <div class="text-20 font-semibold lg:text-32"><?php the_title(); ?></div>
                                <div class="text-grey-20 tw-html mt-8 lg:mt-16">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <!-- Default content if no doctors are added -->
                <div class="f-carousel__slide">
                    <div class="bg-blue-40 rounded-24 p-16 pt-0 text-white flex flex-col gap-16 md:flex-row md:gap-20 md:px-48 md:py-20 lg:gap-60 lg:py-40">
                        <div class="relative -mx-24 md:w-1/2 md:flex-none md:mx-0 md:-my-36 md:order-1 lg:-my-64 lg:w-2/3">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/about-slide-1.webp" alt="" class="w-full h-280 object-cover rounded-32 border-8 border-blue-20 md:absolute md:top-0 md:left-0 md:h-full">
                        </div>
                        <div class="md:flex-1">
                            <div class="text-20 font-semibold lg:text-32">Dr. Joaquim Casañas</div>
                            <div class="text-grey-20 tw-html mt-8 lg:mt-16">
                                <p>Dr. Joaquim Casañas is a highly regarded specialist in peripheral nerve and hand surgery with more than 25 years experience.</p>
                                <ul>
                                    <li>Dr. Casañas is the President of the Spanish Society of Hand Surgery and a </li>
                                    <li>member of several committees of the European Federation for Surgery of the Hand and </li>
                                    <li>a Fellow of the American Society for Surgery of the Hand.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="f-carousel__slide">
                    <div class="bg-blue-40 rounded-24 p-16 pt-0 text-white flex flex-col gap-16 md:flex-row md:gap-20 md:px-48 md:py-20 lg:gap-60 lg:py-40">
                        <div class="relative -mx-24 md:w-1/2 md:flex-none md:mx-0 md:-my-36 md:order-1 lg:-my-64 lg:w-2/3">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/about-slide-2.webp" alt="" class="w-full h-280 object-cover rounded-32 border-8 border-blue-20 md:absolute md:top-0 md:left-0 md:h-full">
                        </div>
                        <div class="md:flex-1">
                            <div class="text-20 font-semibold lg:text-32">Team of professionals</div>
                            <div class="text-grey-20 tw-html mt-8 lg:mt-16">
                                <p>The T-EXPERT team is made up of</p>
                                <ul>
                                    <li>12 senior surgeons,</li>
                                    <li>10 nurses,</li>
                                    <li>4 administrative staff and a</li>
                                    <li>team of neurologists and physiotherapists,</li>
                                </ul>
                                <p>who offer a traumatology and orthopedic surgery assistance service, with high qualifications and specialization in all facets of traumatology.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="f-carousel__slide">
                    <div class="bg-blue-40 rounded-24 p-16 pt-0 text-white flex flex-col gap-16 md:flex-row md:gap-20 md:px-48 md:py-20 lg:gap-60 lg:py-40">
                        <div class="relative -mx-24 md:w-1/2 md:flex-none md:mx-0 md:-my-36 md:order-1 lg:-my-64 lg:w-2/3">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/about-slide-3.webp" alt="" class="w-full h-280 object-cover rounded-32 border-8 border-blue-20 md:absolute md:top-0 md:left-0 md:h-full">
                        </div>
                        <div class="md:flex-1">
                            <div class="text-20 font-semibold lg:text-32">T-EXPERT</div>
                            <div class="text-grey-20 tw-html mt-8 lg:mt-16">
                                <p>T-EXPERT is a traumatology and orthopedic surgery unit, located at the Teknon Medical Center, and directed by Dr. Joaquim Casañas.</p>
                                <p>T-EXPERT began its career in 2005 with the main objective of offering highly specialized medical care with great technological value, personalized attention to facilitate communication with the patient, and a high capacity to respond to their problems.</p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
