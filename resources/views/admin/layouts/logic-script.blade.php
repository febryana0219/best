@yield('script')

{{-- <script>
    let idleTime = 0;
    let idleInterval = setInterval(timerIncrement, 60000); // 1 minute interval

    // Reset idle timer on mouse or keyboard activity
    window.onload = resetTimer;
    document.onmousemove = resetTimer;
    document.onkeypress = resetTimer;

    function timerIncrement() {
        idleTime++;
        if (idleTime >= 5) { // 5 minutes
            alert("You've been idle for 5 minutes. You will be logged out.");
            document.getElementById('logout-form').submit(); // Auto submit the logout form
        }
    }

    function resetTimer() {
        idleTime = 0; // Reset idle time to 0 on any activity
    }
</script> --}}

<script>
    ClassicEditor.create(document.querySelector('#editor')).catch(error => {
        console.error(error);
    });

    window.setTimeout(function() {
        $(".alert.alert-info").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 3000);

    $(function() {
        $('#sortable').sortable({
            items: 'li',
            cursor: 'move',
            placeholder: 'ui-state-highlight'
        });
    });

    function setDeleteFormAction(action) {
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.action = action;
    }

    function updateStatus(id, isChecked, url, fieldName) {
        const data = {
            _token: '{{ csrf_token() }}',
            [fieldName]: isChecked ? 1 : 0
        };

        $.ajax({
            url: url.replace(':id', id),
            type: 'POST',
            data: data,
            success: function(response) {
                showAlert('success', response.message);
                autoCloseAlert();
            },
            error: function(xhr) {
                const message = xhr.responseJSON?.message || 'An error occurred. Please try again.';
                showAlert('error', message);
            }
        });
    }

    function showAlert(type, message) {
        let alertHTML = '';

        if (type === 'success') {
            alertHTML = `
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
        } else if (type === 'error') {
            alertHTML = `
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
        }

        $('#alertContainer').html(alertHTML);
    }

    function autoCloseAlert() {
        $(".alert.alert-info").fadeTo(1000, 0).slideUp(1000, function() {
            $(this).remove();
            location.reload();
        });
    }
</script>
@yield('script-bottom')

