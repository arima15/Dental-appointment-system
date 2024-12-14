document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('update-modal');
    const editButtons = document.querySelectorAll('.edit-btn');
    const closeModal = document.querySelector('.close-modal');
    const updateForm = document.getElementById('update-form');
    const textFieldGroup = document.getElementById('text-field-group');
    const textValueGroup = document.getElementById('text-value-group');
    const photoGroup = document.getElementById('photo-group');

    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const field = this.dataset.field;
            document.getElementById('update-field').value = field;

            // Show/hide appropriate form groups based on field type
            if (field === 'photo') {
                textFieldGroup.style.display = 'none';
                textValueGroup.style.display = 'none';
                photoGroup.style.display = 'block';
            } else {
                textFieldGroup.style.display = 'block';
                textValueGroup.style.display = 'block';
                photoGroup.style.display = 'none';

                const valueInput = document.getElementById('update-value');
                
                // Handle specific field types
                if (field === 'dob') {
                    valueInput.type = 'date';
                    // Convert current date format to YYYY-MM-DD for date input
                    const currentValue = document.getElementById(field).textContent;
                    const date = new Date(currentValue);
                    if (!isNaN(date.getTime())) {
                        valueInput.value = date.toISOString().split('T')[0];
                    }
                } else if (field === 'gender') {
                    // Replace input with select element
                    const selectEl = document.createElement('select');
                    selectEl.id = 'update-value';
                    selectEl.name = 'value';
                    selectEl.required = true;
                    
                    const options = ['Male', 'Female', 'Other'];
                    options.forEach(option => {
                        const optionEl = document.createElement('option');
                        optionEl.value = option;
                        optionEl.textContent = option;
                        selectEl.appendChild(optionEl);
                    });

                    // Set current value
                    const currentValue = document.getElementById(field).textContent;
                    selectEl.value = currentValue;

                    // Replace input with select
                    valueInput.parentNode.replaceChild(selectEl, valueInput);
                } else {
                    // Reset to text input for other fields
                    if (valueInput.tagName.toLowerCase() === 'select') {
                        const textInput = document.createElement('input');
                        textInput.type = 'text';
                        textInput.id = 'update-value';
                        textInput.name = 'value';
                        textInput.required = true;
                        valueInput.parentNode.replaceChild(textInput, valueInput);
                    } else {
                        valueInput.type = 'text';
                    }
                    // Pre-fill current value
                    const currentValue = document.getElementById(field).textContent;
                    document.getElementById('update-value').value = currentValue;
                }
            }

            modal.style.display = 'block';
        });
    });

    closeModal.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    updateForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        const formData = new FormData(this);

        try {
            const response = await fetch('/profile/update', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                }
            });

            if (!response.ok) {
                const textResponse = await response.text();
                console.log('Server response:', textResponse);
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();

            if (data.success) {
                const field = formData.get('field');
                if (field === 'photo') {
                    const file = formData.get('photo');
                    if (file) {
                        const profilePic = document.getElementById('profile-picture-left');
                        profilePic.src = URL.createObjectURL(file);
                    }
                } else {
                    const element = document.getElementById(field);
                    if (element) {
                        element.textContent = formData.get('value');
                    }
                }
                
                // Show success message
                alert('Profile updated successfully!');
                modal.style.display = 'none';
            } else {
                alert('Failed to update profile: ' + (data.message || 'Unknown error'));
            }
        } catch (error) {
            console.error('Error:', error);
            alert('An error occurred while updating the profile');
        }
    });

    // Close modal when clicking outside
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
}); 