@if (session('success'))
<div class="notification success-notification" id="successNotification">
    <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="notification error-notification" id="errorNotification">
    <i class="bi bi-x-circle-fill"></i> {{ session('error') }}
</div>
@endif

<style>
/* Common notification styles */
.notification {
    position: fixed;
    z-index: 1050;
    top: 20px; /* Position at the top of the page */
    left: 50%;
    transform: translateX(-50%);
    padding: 15px 20px;
    border-radius: 5px;
    color: #fff;
    font-size: 16px;
    display: flex;
    align-items: center;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    transition: all 0.5s ease;
    opacity: 0; /* Initially hidden */
    pointer-events: none; /* Prevent interaction */
}

/* Success notification style */
.success-notification {
    background-color: #28a745; /* Green */
    margin-top: 60px;
}

/* Error notification style */
.error-notification {
    background-color: #ac2b37; /* Red */
    margin-top: 60px; /* Offset error notification slightly below success */
}
</style>

<script>
    // Function to show and automatically hide notifications
    function showNotification(id) {
        const notification = document.getElementById(id);
        if (notification) {
            notification.style.opacity = '1'; // Make it visible
            notification.style.pointerEvents = 'auto'; // Allow interaction

            // Auto-hide after 5 seconds
            setTimeout(() => {
                notification.style.opacity = '0'; // Hide it
                notification.style.pointerEvents = 'none'; // Disable interaction
            }, 5000);
        }
    }

    // Trigger notifications if they exist
    document.addEventListener('DOMContentLoaded', () => {
        showNotification('successNotification');
        showNotification('errorNotification');
    });
</script>
