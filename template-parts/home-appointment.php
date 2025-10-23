<?php
/**
 * Template part for displaying the appointment section
 */

$body_data = include get_template_directory() . '/template-parts/body-data.php';
?>

<section class="relative mt-80 md:mt-120 lg:mt-150" id="appointment-form">
    <div class="container">
        <div class="flex flex-col gap-8 lg:flex-row lg:items-center lg:gap-60">
            <h2 class="text-28 font-semibold lg:text-48" data-animate="text">Let us help you</h2>
            <div class="opacity-80 font-semibold" data-animate="fadein" data-animation-delay="1000">To make an appointment with a doctor, <br>complete the survey or fill out the form</div>	
        </div>
        <div class="mt-20 flex lg:mt-40 text-24 font-bold">
            <a href="#help-survey" class="tw-tab is-active" data-js="tab">The survey</a>
            <a href="#help-form" class="tw-tab" data-js="tab">The form</a>
        </div>
        <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST" class="bg-blue-30 text-white rounded-24 rounded-tl-none p-16 lg:p-40" data-js="form">
            <input type="hidden" name="action" value="submit_appointment">
            <?php wp_nonce_field('appointment_form', 'appointment_nonce'); ?>
            
            <div id="help-survey" class="flex flex-col gap-16 lg:flex-row" data-js="tab_content">
                <div class="flex items-start relative -m-16 mb-0 lg:-m-40 lg:mr-0 lg:mb-0 lg:flex-none">
                    <div class="relative mx-auto transition z-10" data-js="survey_body">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/body-front.webp" alt="" class="w-408 lg:w-508 select-none" data-js="survey_body_front">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/body-back.webp" alt="" class="w-408 lg:w-508 select-none" data-js="survey_body_back" hidden>
                        <svg width="90" height="80" class="text-white hover:text-blue-40 transition cursor-pointer absolute top-60 right-1/2 translate-x-150 lg:top-120" data-js="survey_change_view"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#arrow-around"></use></svg>
                        <?php foreach ($body_data as $key => $location) : ?>
                        <div class="tw-survey-circle" data-js="survey_circle" data-id="<?php echo esc_attr($key); ?>" style="<?php echo esc_attr($location['position']); ?>" <?php echo (strpos($key, 'back-') !== false ? 'hidden': ''); ?>></div>
                        <?php endforeach; ?>
                    </div>
                    <div class="absolute top-16 left-0 right-0 w-300 mx-auto opacity-0 invisible transition lg:w-400 lg:top-40" data-js="survey_body_info">
                        <div class="relative h-300 lg:h-400 rounded-full border-4 border-white overflow-hidden">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/body-front.webp" alt="" class="w-1524 select-none max-w-none absolute top-1/2 left-1/2 transform" data-js="survey_zoom">
                        </div>
                        <button type="button" class="bg-blue-20 size-56 rounded-full flex border-4 border-white text-blue-60 absolute top-20 right-36" data-js="survey_zoom_close">
                            <svg class="size-24 m-auto"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#cross"></use></svg>
                        </button>
                        <div class="-mt-20 px-0 lg:-mt-40 lg:px-25 z-10">
                            <?php foreach ($body_data as $key => $location) : ?>
                            <div class="bg-white text-black bg-opacity-60 p-16 rounded-24 backdrop-blur-4" data-js="survey_location" data-id="<?php echo esc_attr($key); ?>" hidden>
                                <div class="text-24 font-semibold"><?php echo esc_html($location['name']); ?></div>
                                <div class="mt-8"><?php echo esc_html($location['description']); ?></div>
                                <div class="mt-16 flex justify-end">
                                    <label class="tw-tag-label">
                                        <input type="checkbox" data-js="survey_select_location" value="<?php echo esc_attr($location['name']); ?>">
                                        <span class="tw-tag tw-tag--m">
                                            <span data-default="Select" data-selected="Selected">Select</span>
                                            <svg class="tw-tag-icon"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#cross"></use></svg>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="relative lg:flex-1">
                    <div class="flex items-center mb-16 lg:hidden">
                        <div class="tw-survey-step-num is-active" data-js="survey_step_num">1</div>
                        <div class="tw-survey-step-line"></div>
                        <div class="tw-survey-step-num" data-js="survey_step_num">2</div>
                        <div class="tw-survey-step-line"></div>
                        <div class="tw-survey-step-num" data-js="survey_step_num">3</div>
                        <div class="tw-survey-step-line"></div>
                        <div class="tw-survey-step-num" data-js="survey_step_num">4</div>
                    </div>
                    <div class="flex flex-col gap-40">
                        <div class="tw-survey-step is-active" data-js="survey_step" data-step="1">
                            <div class="tw-survey-step-num">1</div>
                            <div class="tw-survey-step-line"></div>
                            <h3 class="tw-survey-step-title">Where it hurts?</h3>
                            <div class="tw-survey-step-desc">
                                <div class="max-w-600">Select a location on the model on the left where you feel pain</div>
                                <div class="mt-20 flex items-center gap-8 flex-wrap" data-js="survey_selected_locations" hidden></div>
                                <div class="mt-20 text-right lg:text-left">
                                    <button type="button" class="tw-btn tw-btn--secondary px-32" data-js="survey_step_next" disabled>Next</button>
                                </div>
                            </div>
                        </div>
                        <div class="tw-survey-step" data-js="survey_step" data-step="2">
                            <div class="tw-survey-step-num">2</div>
                            <div class="tw-survey-step-line"></div>
                            <h3 class="tw-survey-step-title">How it hurts?</h3>
                            <div class="tw-survey-step-desc">
                                <div class="max-w-600">Select one or more types of pain from those suggested below or write your own description</div>
                                <div class="mt-20 flex items-center gap-8 flex-wrap">
                                    <label class="tw-tag-label">
                                        <input type="checkbox" name="types[]" value="Dull">
                                        <span class="tw-tag tw-tag--m">
                                            <span>Dull</span>
                                            <svg class="tw-tag-icon"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#cross"></use></svg>
                                        </span>
                                    </label>
                                    <label class="tw-tag-label">
                                        <input type="checkbox" name="types[]" value="Dizzy">
                                        <span class="tw-tag tw-tag--m">
                                            <span>Dizzy</span>
                                            <svg class="tw-tag-icon"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#cross"></use></svg>
                                        </span>
                                    </label>
                                    <label class="tw-tag-label">
                                        <input type="checkbox" name="types[]" value="Sharp">
                                        <span class="tw-tag tw-tag--m">
                                            <span>Sharp</span>
                                            <svg class="tw-tag-icon"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#cross"></use></svg>
                                        </span>
                                    </label>
                                    <label class="tw-tag-label">
                                        <input type="checkbox" name="types[]" value="Stabbing">
                                        <span class="tw-tag tw-tag--m">
                                            <span>Stabbing</span>
                                            <svg class="tw-tag-icon"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#cross"></use></svg>
                                        </span>
                                    </label>
                                    <label class="tw-tag-label">
                                        <input type="checkbox" name="types[]" value="Pressing">
                                        <span class="tw-tag tw-tag--m">
                                            <span>Pressing</span>
                                            <svg class="tw-tag-icon"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#cross"></use></svg>
                                        </span>
                                    </label>
                                    <label class="tw-tag-label">
                                        <input type="checkbox" name="types[]" value="Aching">
                                        <span class="tw-tag tw-tag--m">
                                            <span>Aching</span>
                                            <svg class="tw-tag-icon"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#cross"></use></svg>
                                        </span>
                                    </label>
                                    <label class="tw-tag-label">
                                        <input type="checkbox" name="types[]" value="Pulling">
                                        <span class="tw-tag tw-tag--m">
                                            <span>Pulling</span>
                                            <svg class="tw-tag-icon"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#cross"></use></svg>
                                        </span>
                                    </label>
                                </div>
                                <div class="relative mt-20 max-w-600">
                                    <textarea name="type_description" class="tw-input" rows="3" placeholder="Your own description (optional)"></textarea>
                                    <svg class="tw-input-icon" data-js="input_clear" hidden><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#cross"></use></svg>
                                </div>
                                <div class="mt-20 text-right lg:text-left">
                                    <button type="button" class="tw-btn tw-btn--secondary px-32" data-js="survey_step_next" disabled>Next</button>
                                </div>
                            </div>
                        </div>
                        <div class="tw-survey-step" data-js="survey_step" data-step="3">
                            <div class="tw-survey-step-num">3</div>
                            <div class="tw-survey-step-line"></div>
                            <h3 class="tw-survey-step-title">How long does it hurt?</h3>
                            <div class="tw-survey-step-desc">
                                <div class="relative max-w-600">
                                    <select name="how_long" class="tw-input peer" data-js="select">
                                        <option value="">Not selected</option>
                                        <option value="Day or less">Day or less</option>
                                        <option value="Less than week">Less than week</option>
                                        <option value="Less than month">Less than month</option>
                                        <option value="Less than year">Less than year</option>
                                        <option value="More than year / Chronical">More than year / Chronical</option>
                                    </select>
                                    <svg class="tw-input-icon pointer-events-none peer-focus:rotate-180"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#down"></use></svg>
                                </div>
                                <div class="max-w-600 mt-20">Write your own description, for example, in the morning, after meals, after exersices, etc.</div>
                                <div class="relative mt-20 max-w-600">
                                    <textarea name="long_description" class="tw-input" rows="3" placeholder="Your own description"></textarea>
                                    <svg class="tw-input-icon" data-js="input_clear" hidden><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#cross"></use></svg>
                                </div>
                                <div class="mt-20 text-right lg:text-left">
                                    <button type="button" class="tw-btn tw-btn--secondary px-32" data-js="survey_step_next" disabled>Next</button>
                                </div>
                            </div>
                        </div>
                        <div class="tw-survey-step" data-js="survey_step" data-step="4">
                            <div class="tw-survey-step-num">4</div>
                            <h3 class="tw-survey-step-title">How bad does it hurt?</h3>
                            <div class="tw-survey-step-desc">
                                <div class="max-w-600">Determine the strength of pain from 1 to 10 and select the corresponding number below</div>
                                <div class="mt-20 flex items-center gap-8 flex-wrap">
                                    <?php for ($i = 1; $i <= 10; $i++) : ?>
                                    <label class="tw-tag-label">
                                        <input type="radio" name="strength" value="<?php echo $i; ?>">
                                        <span class="tw-tag tw-tag--m tw-tag--border" style="background-color:<?php echo 'hsl(' . (120 - ($i * 10)) . ', 70%, 50%)'; ?>">
                                            <span><?php echo $i; ?></span>
                                            <svg class="tw-tag-icon"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#cross"></use></svg>
                                        </span>
                                    </label>
                                    <?php endfor; ?>
                                </div>
                                <div class="mt-20 text-right lg:text-left">
                                    <button type="button" class="tw-btn tw-btn--secondary px-32" data-js="survey_step_next" disabled>Save and go to the appointment</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="help-form" class="flex flex-col gap-16 lg:flex-row" data-js="tab_content" hidden>
                <div class="hidden flex-none w-468 lg:block">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/calendar.webp" alt="" class="mx-auto">
                </div>
                <div class="relative lg:flex-1" data-js="form_fields">
                    <div class="flex items-center mb-16 lg:hidden">
                        <div class="tw-survey-step-num is-active" data-js="form_step_num">1</div>
                        <div class="tw-survey-step-line"></div>
                        <div class="tw-survey-step-num is-active" data-js="form_step_num">2</div>
                        <div class="tw-survey-step-line"></div>
                        <div class="tw-survey-step-num" data-js="form_step_num">3</div>
                    </div>
                    <div class="flex flex-col gap-40">
                        <div class="tw-survey-step is-finished" data-js="form_step" data-step="1">
                            <div class="tw-survey-step-num">1</div>
                            <div class="tw-survey-step-line"></div>
                            <h3 class="tw-survey-step-title">Anything we need to know about your problem</h3>
                            <div class="tw-survey-step-desc mt-16">
                                <div class="relative">
                                    <textarea name="description" class="tw-input" rows="5" placeholder="Your own description (optional)"></textarea>
                                    <svg class="tw-input-icon" data-js="input_clear" hidden><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#cross"></use></svg>
                                </div>
                            </div>
                        </div>
                        <div class="tw-survey-step is-active" data-js="form_step" data-step="2">
                            <div class="tw-survey-step-num">2</div>
                            <div class="tw-survey-step-line"></div>
                            <h3 class="tw-survey-step-title">Select date and time</h3>
                            <div class="tw-survey-step-desc mt-16">
                                <div class="grid grid-cols-1 gap-20 gap-y-16 md:grid-cols-2">
                                    <div>
                                        <div class="uppercase font-semibold text-16 text-white">Date</div>
                                        <div class="relative mt-4">
                                            <input type="date" name="date" class="tw-input" data-js="datepicker" placeholder="Not selected" required>
                                            <svg class="tw-input-icon pointer-events-none"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#calendar"></use></svg>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="uppercase font-semibold text-16 text-white">Time</div>
                                        <div class="relative mt-4">
                                            <select name="time" class="tw-input peer" data-js="select" required>
                                                <option value="">Not selected</option>
                                                <option value="10:00">10:00</option>
                                                <option value="10:30">10:30</option>
                                                <option value="11:00">11:00</option>
                                                <option value="11:30">11:30</option>
                                            </select>
                                            <svg class="tw-input-icon pointer-events-none peer-focus:rotate-180"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#down"></use></svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-20 text-right lg:text-left">
                                    <button type="button" class="tw-btn tw-btn--secondary px-32" data-js="form_step_next" disabled>Next</button>
                                </div>
                            </div>
                        </div>
                        <div class="tw-survey-step" data-js="form_step" data-step="3">
                            <div class="tw-survey-step-num">3</div>
                            <h3 class="tw-survey-step-title">Enter patient details</h3>
                            <div class="tw-survey-step-desc mt-16">
                                <div class="grid grid-cols-1 gap-20 gap-y-16 md:grid-cols-2">
                                    <div>
                                        <div class="uppercase font-semibold text-16 text-white">Name</div>
                                        <input type="text" name="name" class="tw-input mt-4" placeholder="Nina" required>
                                    </div>
                                    <div>
                                        <div class="uppercase font-semibold text-16 text-white">Surname(s)</div>
                                        <input type="text" name="surname" class="tw-input mt-4" placeholder="Rio" required>
                                    </div>
                                    <div>
                                        <div class="uppercase font-semibold text-16 text-white">Date of birth</div>
                                        <div class="relative mt-4">
                                            <input type="date" name="birthdate" class="tw-input" data-js="datepicker" placeholder="Not selected" readonly>
                                            <svg class="tw-input-icon pointer-events-none"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#calendar"></use></svg>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="uppercase font-semibold text-16 text-white">Insurance company</div>
                                        <input type="text" name="insurance_company" class="tw-input mt-4" placeholder="Not selected">
                                    </div>
                                    <div>
                                        <div class="uppercase font-semibold text-16 text-white">Phone</div>
                                        <input type="tel" name="phone" class="tw-input mt-4" placeholder="+34" required>
                                    </div>
                                    <div>
                                        <div class="uppercase font-semibold text-16 text-white">E-mail</div>
                                        <input type="email" name="email" class="tw-input mt-4" placeholder="address@mail.com" required>
                                    </div>
                                </div>
                                <div class="mt-16">
                                    <label class="tw-checkbox-label">
                                        <input type="checkbox" name="vip">
                                        <svg class="tw-checkbox"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#tick"></use></svg>
                                        <div class="tw-checkbox-text text-white">GO VIP - exclusive service level for demanding clients</div>
                                    </label>
                                </div>
                                <button type="submit" class="tw-btn tw-btn--arrow mt-32 w-full group lg:w-300 lg:mt-56" disabled>
                                    <span>Get help</span>
                                    <svg class="tw-btn-icon p-4"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#arrow-up"></use></svg>
                                </button>
                                <div class="mt-20 text-red-40" data-js="form_error" hidden></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative lg:flex-1" data-js="form_success" hidden>
                    <div class="text-20 lg:text-24 font-bold">You have successfully booked an appointment with a doctor. Details in your profile</div>
                    <a href="<?php echo esc_url(home_url('/profile')); ?>" class="tw-btn tw-btn--arrow mt-32 w-full group lg:w-300 lg:mt-56">
                        <span>Go to Profile</span>
                        <svg class="tw-btn-icon p-4"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#arrow-up"></use></svg>
                    </a>
                </div>
            </div>
        </form>
    </div>
</section>
