<?php
$messagesJson = file_get_contents('../../data/messages.json');
$messages = json_decode($messagesJson, true);
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4" data-aos="fade-right">
                <i class="bi bi-envelope-fill me-2"></i>Messages
                <span class="badge bg-primary rounded-pill ms-2"><?php echo count($messages); ?></span>
            </h2>
            
            <div class="row" data-aos="fade-up" data-aos-delay="100">
                <?php foreach ($messages as $message): ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 message-card <?php echo $message['status'] === 'unread' ? 'border-primary' : ''; ?>" 
                             data-message-id="<?php echo $message['id']; ?>" 
                             data-aos="zoom-in" data-aos-delay="150">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">
                                    <?php if ($message['status'] === 'unread'): ?>
                                        <span class="badge bg-primary me-2">New</span>
                                    <?php endif; ?>
                                    <?php echo htmlspecialchars($message['subject']); ?>
                                </h5>
                                <small class="text-muted"><?php echo date('M d, Y', strtotime($message['timestamp'])); ?></small>
                            </div>
                            <div class="card-body">
                                <div class="mb-2">
                                    <strong><i class="bi bi-person-circle me-2"></i><?php echo htmlspecialchars($message['name']); ?></strong>
                                    <br>
                                    <small class="text-muted">
                                        <i class="bi bi-envelope me-2"></i><?php echo htmlspecialchars($message['email']); ?>
                                    </small>
                                </div>
                                <p class="card-text"><?php echo nl2br(htmlspecialchars($message['message'])); ?></p>
                            </div>
                            <div class="card-footer bg-transparent">
                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-sm btn-outline-primary" onclick="markAsRead('<?php echo $message['id']; ?>')">
                                        <i class="bi bi-check2-circle me-1"></i>Mark as Read
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" onclick="deleteMessage('<?php echo $message['id']; ?>')">
                                        <i class="bi bi-trash me-1"></i>Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<style>
.message-card {
    transition: transform 0.2s, box-shadow 0.2s;
}

.message-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.card-header {
    background-color: rgba(0,0,0,0.02);
}

.message-card.border-primary {
    border-width: 2px;
}
</style>

<script>
function markAsRead(messageId) {
    fetch('../../app/Handlers/markAsRead.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'messageId=' + encodeURIComponent(messageId)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update UI
            const messageCard = document.querySelector(`[data-message-id="${messageId}"]`);
            messageCard.classList.remove('border-primary');
            const newBadge = messageCard.querySelector('.badge.bg-primary');
            if (newBadge) newBadge.remove();
            
            // Update message count
            updateMessageCount();
        } else {
            alert('Error marking message as read: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while marking the message as read');
    });
}

function deleteMessage(messageId) {
    if (confirm('Are you sure you want to delete this message?')) {
        fetch('../../app/Handlers/deleteMessage.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'messageId=' + encodeURIComponent(messageId)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Remove the message card from UI
                const messageCard = document.querySelector(`[data-message-id="${messageId}"]`).closest('.col-md-6');
                messageCard.remove();
                
                // Update message count
                updateMessageCount();
            } else {
                alert('Error deleting message: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while deleting the message');
        });
    }
}

function updateMessageCount() {
    const unreadCount = document.querySelectorAll('.message-card.border-primary').length;
    const countBadge = document.querySelector('h2 .badge');
    if (countBadge) {
        countBadge.textContent = document.querySelectorAll('.message-card').length;
    }
}
</script>
