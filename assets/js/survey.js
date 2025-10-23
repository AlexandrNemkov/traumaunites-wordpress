/**
 * TraumaUnites Survey/Quiz JavaScript
 */

document.addEventListener('DOMContentLoaded', function() {
    console.log('TraumaUnites Survey JS loaded');
    
    // Survey functionality
    initSurvey();
    initForm();
    initTabs();
});

function initSurvey() {
    const surveyBody = document.querySelector('[data-js="survey_body"]');
    const surveyCircles = document.querySelectorAll('[data-js="survey_circle"]');
    const surveySteps = document.querySelectorAll('[data-js="survey_step"]');
    const surveyStepNums = document.querySelectorAll('[data-js="survey_step_num"]');
    const surveyStepNextBtns = document.querySelectorAll('[data-js="survey_step_next"]');
    const surveyBodyInfo = document.querySelector('[data-js="survey_body_info"]');
    const surveyChangeView = document.querySelector('[data-js="survey_change_view"]');
    const surveyBodyFront = document.querySelector('[data-js="survey_body_front"]');
    const surveyBodyBack = document.querySelector('[data-js="survey_body_back"]');
    const surveyZoom = document.querySelector('[data-js="survey_zoom"]');
    const surveyZoomClose = document.querySelector('[data-js="survey_zoom_close"]');
    const surveyLocations = document.querySelectorAll('[data-js="survey_location"]');
    const surveySelectLocations = document.querySelectorAll('[data-js="survey_select_location"]');
    const surveySelectedLocations = document.querySelector('[data-js="survey_selected_locations"]');
    
    let currentStep = 1;
    let selectedLocations = [];
    
    // Change body view (front/back)
    if (surveyChangeView) {
        surveyChangeView.addEventListener('click', function() {
            if (surveyBodyFront && surveyBodyBack) {
                const isFrontVisible = !surveyBodyFront.hidden;
                surveyBodyFront.hidden = !isFrontVisible;
                surveyBodyBack.hidden = isFrontVisible;
                
                // Show/hide circles based on view
                surveyCircles.forEach(circle => {
                    const isBackCircle = circle.dataset.id.includes('back-');
                    circle.hidden = isBackCircle ? isFrontVisible : !isFrontVisible;
                });
            }
        });
    }
    
    // Circle click handler
    surveyCircles.forEach(circle => {
        circle.addEventListener('click', function() {
            const locationId = this.dataset.id;
            const location = document.querySelector(`[data-js="survey_location"][data-id="${locationId}"]`);
            
            if (location) {
                // Hide all other locations
                surveyLocations.forEach(loc => loc.hidden = true);
                
                // Show clicked location
                location.hidden = false;
                
                // Show body info overlay
                if (surveyBodyInfo) {
                    surveyBodyInfo.classList.remove('opacity-0', 'invisible');
                    surveyBodyInfo.classList.add('opacity-100', 'visible');
                }
                
                // Update zoom image
                if (surveyZoom) {
                    const isBackView = locationId.includes('back-');
                    surveyZoom.src = isBackView ? 
                        surveyBodyBack.src : 
                        surveyBodyFront.src;
                }
            }
        });
    });
    
    // Close zoom overlay
    if (surveyZoomClose) {
        surveyZoomClose.addEventListener('click', function() {
            if (surveyBodyInfo) {
                surveyBodyInfo.classList.add('opacity-0', 'invisible');
                surveyBodyInfo.classList.remove('opacity-100', 'visible');
            }
        });
    }
    
    // Location selection
    surveySelectLocations.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const locationName = this.value;
            const tag = this.closest('.tw-tag-label').querySelector('.tw-tag span');
            
            if (this.checked) {
                if (!selectedLocations.includes(locationName)) {
                    selectedLocations.push(locationName);
                }
                tag.textContent = 'Selected';
                tag.parentElement.classList.add('tw-tag--selected');
            } else {
                selectedLocations = selectedLocations.filter(loc => loc !== locationName);
                tag.textContent = 'Select';
                tag.parentElement.classList.remove('tw-tag--selected');
            }
            
            updateSelectedLocationsDisplay();
            updateNextButton();
        });
    });
    
    function updateSelectedLocationsDisplay() {
        if (surveySelectedLocations) {
            surveySelectedLocations.innerHTML = '';
            selectedLocations.forEach(location => {
                const tag = document.createElement('span');
                tag.className = 'tw-tag tw-tag--m tw-tag--selected';
                tag.innerHTML = `
                    <span>${location}</span>
                    <svg class="tw-tag-icon"><use href="${window.location.origin}/wp-content/themes/traumaunites/assets/img/sprite.svg#cross"></use></svg>
                `;
                surveySelectedLocations.appendChild(tag);
            });
            
            surveySelectedLocations.hidden = selectedLocations.length === 0;
        }
    }
    
    function updateNextButton() {
        const currentStepBtn = document.querySelector(`[data-js="survey_step"][data-step="${currentStep}"] [data-js="survey_step_next"]`);
        if (currentStepBtn) {
            const isEnabled = checkStepCompletion(currentStep);
            currentStepBtn.disabled = !isEnabled;
        }
    }
    
    function checkStepCompletion(step) {
        switch(step) {
            case 1:
                return selectedLocations.length > 0;
            case 2:
                const typeCheckboxes = document.querySelectorAll('input[name="types[]"]:checked');
                const typeDescription = document.querySelector('textarea[name="type_description"]');
                return typeCheckboxes.length > 0 || (typeDescription && typeDescription.value.trim() !== '');
            case 3:
                const howLong = document.querySelector('select[name="how_long"]');
                const longDescription = document.querySelector('textarea[name="long_description"]');
                return (howLong && howLong.value !== '') || (longDescription && longDescription.value.trim() !== '');
            case 4:
                const strength = document.querySelector('input[name="strength"]:checked');
                return strength !== null;
            default:
                return false;
        }
    }
    
    // Step navigation
    surveyStepNextBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            if (currentStep < 4) {
                // Move to next step
                currentStep++;
                updateStepDisplay();
                updateNextButton();
            } else {
                // Final step - save survey data and move to form
                saveSurveyData();
                switchToForm();
            }
        });
    });
    
    function updateStepDisplay() {
        // Update step numbers
        surveyStepNums.forEach((num, index) => {
            if (index < currentStep) {
                num.classList.add('is-active');
            } else {
                num.classList.remove('is-active');
            }
        });
        
        // Update step content
        surveySteps.forEach(step => {
            const stepNum = parseInt(step.dataset.step);
            if (stepNum === currentStep) {
                step.classList.add('is-active');
                step.classList.remove('is-finished');
            } else if (stepNum < currentStep) {
                step.classList.remove('is-active');
                step.classList.add('is-finished');
            } else {
                step.classList.remove('is-active', 'is-finished');
            }
        });
    }
    
    function saveSurveyData() {
        // Save survey data to hidden inputs
        const painLocationsInput = document.createElement('input');
        painLocationsInput.type = 'hidden';
        painLocationsInput.name = 'pain_locations';
        painLocationsInput.value = selectedLocations.join(', ');
        document.querySelector('form').appendChild(painLocationsInput);
        
        const painTypes = Array.from(document.querySelectorAll('input[name="types[]"]:checked')).map(cb => cb.value);
        const painTypesInput = document.createElement('input');
        painTypesInput.type = 'hidden';
        painTypesInput.name = 'pain_types';
        painTypesInput.value = painTypes.join(', ');
        document.querySelector('form').appendChild(painTypesInput);
        
        const howLong = document.querySelector('select[name="how_long"]').value;
        const howLongInput = document.createElement('input');
        howLongInput.type = 'hidden';
        howLongInput.name = 'how_long';
        howLongInput.value = howLong;
        document.querySelector('form').appendChild(howLongInput);
        
        const strength = document.querySelector('input[name="strength"]:checked');
        const strengthInput = document.createElement('input');
        strengthInput.type = 'hidden';
        strengthInput.name = 'strength';
        strengthInput.value = strength ? strength.value : '';
        document.querySelector('form').appendChild(strengthInput);
    }
    
    function switchToForm() {
        // Switch to form tab
        const surveyTab = document.querySelector('a[href="#help-survey"]');
        const formTab = document.querySelector('a[href="#help-form"]');
        const surveyContent = document.querySelector('#help-survey');
        const formContent = document.querySelector('#help-form');
        
        if (surveyTab && formTab && surveyContent && formContent) {
            surveyTab.classList.remove('is-active');
            formTab.classList.add('is-active');
            surveyContent.hidden = true;
            formContent.hidden = false;
        }
    }
    
    // Initialize step display
    updateStepDisplay();
    updateNextButton();
}

function initForm() {
    const formSteps = document.querySelectorAll('[data-js="form_step"]');
    const formStepNums = document.querySelectorAll('[data-js="form_step_num"]');
    const formStepNextBtns = document.querySelectorAll('[data-js="form_step_next"]');
    const formFields = document.querySelector('[data-js="form_fields"]');
    const formSuccess = document.querySelector('[data-js="form_success"]');
    const formError = document.querySelector('[data-js="form_error"]');
    const submitBtn = document.querySelector('button[type="submit"]');
    
    let currentFormStep = 2; // Start from step 2 (date/time)
    
    // Form step navigation
    formStepNextBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            if (currentFormStep < 3) {
                currentFormStep++;
                updateFormStepDisplay();
                updateFormNextButton();
            }
        });
    });
    
    function updateFormStepDisplay() {
        // Update step numbers
        formStepNums.forEach((num, index) => {
            if (index < currentFormStep) {
                num.classList.add('is-active');
            } else {
                num.classList.remove('is-active');
            }
        });
        
        // Update step content
        formSteps.forEach(step => {
            const stepNum = parseInt(step.dataset.step);
            if (stepNum === currentFormStep) {
                step.classList.add('is-active');
                step.classList.remove('is-finished');
            } else if (stepNum < currentFormStep) {
                step.classList.remove('is-active');
                step.classList.add('is-finished');
            } else {
                step.classList.remove('is-active', 'is-finished');
            }
        });
    }
    
    function updateFormNextButton() {
        const currentStepBtn = document.querySelector(`[data-js="form_step"][data-step="${currentFormStep}"] [data-js="form_step_next"]`);
        if (currentStepBtn) {
            const isEnabled = checkFormStepCompletion(currentFormStep);
            currentStepBtn.disabled = !isEnabled;
        }
        
        // Update submit button
        if (submitBtn) {
            const isFormComplete = checkFormStepCompletion(3);
            submitBtn.disabled = !isFormComplete;
        }
    }
    
    function checkFormStepCompletion(step) {
        switch(step) {
            case 2:
                const date = document.querySelector('input[name="date"]');
                const time = document.querySelector('select[name="time"]');
                return (date && date.value !== '') && (time && time.value !== '');
            case 3:
                const name = document.querySelector('input[name="name"]');
                const surname = document.querySelector('input[name="surname"]');
                const phone = document.querySelector('input[name="phone"]');
                const email = document.querySelector('input[name="email"]');
                return (name && name.value !== '') && 
                       (surname && surname.value !== '') && 
                       (phone && phone.value !== '') && 
                       (email && email.value !== '');
            default:
                return false;
        }
    }
    
    // Form validation on input change
    const formInputs = document.querySelectorAll('#help-form input, #help-form select, #help-form textarea');
    formInputs.forEach(input => {
        input.addEventListener('input', function() {
            updateFormNextButton();
        });
    });
    
    // Form submission
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Show loading state
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span>Отправка...</span>';
            }
            
            // Submit form via AJAX
            const formData = new FormData(this);
            
            fetch(this.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // Show success message
                if (formFields && formSuccess) {
                    formFields.hidden = true;
                    formSuccess.hidden = false;
                }
            })
            .catch(error => {
                console.error('Form submission error:', error);
                if (formError) {
                    formError.textContent = 'Ошибка отправки формы. Попробуйте еще раз.';
                    formError.hidden = false;
                }
                
                // Reset submit button
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<span>Get help</span><svg class="tw-btn-icon p-4"><use href="' + window.location.origin + '/wp-content/themes/traumaunites/assets/img/sprite.svg#arrow-up"></use></svg>';
                }
            });
        });
    }
    
    // Initialize form display
    updateFormStepDisplay();
    updateFormNextButton();
}

function initTabs() {
    const tabs = document.querySelectorAll('[data-js="tab"]');
    const tabContents = document.querySelectorAll('[data-js="tab_content"]');
    
    tabs.forEach(tab => {
        tab.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            const targetContent = document.querySelector(targetId);
            
            if (targetContent) {
                // Update tab states
                tabs.forEach(t => t.classList.remove('is-active'));
                this.classList.add('is-active');
                
                // Update content visibility
                tabContents.forEach(content => {
                    content.hidden = true;
                });
                targetContent.hidden = false;
            }
        });
    });
}
