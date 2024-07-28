$(document).ready(function() {
    // Check for auth token in sessionStorage
    const authToken = sessionStorage.getItem('auth_token');
    if (!authToken) {
        console.error('No auth token found in sessionStorage');
        return;
    }

    // Function to fetch sidebar data
    function fetchSidebarData() {
        $.ajax({
            url: "/api/sidebar",
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Authorization': 'Bearer ' + authToken,
            },
            dataType: "json",
            success: function(data) {
                $('#promoCount').text(data.promocount);
                $('#pendingJewelry').text(data.pendingjewelry);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    fetchSidebarData();
});
