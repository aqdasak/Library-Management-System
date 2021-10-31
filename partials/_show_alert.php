<?php

if (isset($_SESSION['alert']) and $_SESSION['alert'] != '') {
    if (!isset($_SESSION['alert_type'])) {
        $_SESSION['alert_type'] = 'info';
    }
    echo '<div class="container mt-3">
                <div class="alert alert-' . $_SESSION['alert_type'] . ' alert-dismissible fade show" role="alert">
                    ' .   $_SESSION['alert'] . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              </div>';
    unset($_SESSION['alert'], $_SESSION['alert_type']);
}
