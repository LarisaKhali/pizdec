function toggle() {
    if ($('#publish').val() == 2) {
        $('.field-card-cancellation_reason').show('fade')
    } else {
        $('.field-card-cancellation_reason').hide('fade')
    }
}

toggle()

$('#publish').on('change', toggle)