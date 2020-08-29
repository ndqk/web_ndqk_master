
let userId = window.Laravel.user.id;

window.Echo.private('App.Entity.User.' + userId)
            .notification((notification) => {
                let notiCount = parseInt($('#notification-badge').text()) + 1;
                
                if(Number.isNaN(notiCount)){
                    $('#notification-badge').text(1);
                    $('#notification-header').text('1 Notification');
                }
                else{
                    $('#notification-badge').text(notiCount);
                    $('#notification-header').text(`${notiCount} Notifications`);
                }

                let data = [];
                $('.notification-item').each(function(){
                    data.push($('<div>').append($(this).clone()).html());
                });
                console.log(notification);
                
                let newNotification = `
                        <div class="notification-item un-read-notification">
                            <div class="dropdown-divider"></div>
                            <a href="/admin/notification/detail/${notification.id}" class="dropdown-item">
                                <i class="${notification.icon} mr-2"></i> ${notification.title}
                                <span class="float-right text-muted text-sm">now</span>
                            </a>
                        </div>`;
                
                data.unshift(newNotification);
                if(data.length > 5) data.pop();
                
                $('#notification-list').html(data);

                document.getElementById('notification-sound').play();
            });

$('#notification-more').click(function(){
    $.ajax({
        method : 'GET',
        url: '/admin/notification/all',
        success : function(data){
            $('#notification-list').addClass('show-all-notifications')
            $('#notification-list').html(data);
            $('#notification-more').addClass('disable-custom');
        }
    });
    return false;
});

$('#notification-button').click(function(){
    $.ajax({
        method : 'GET',
        url: '/admin/notification/list',
        success : function(data){
            $('#notification-list').removeClass('show-all-notifications')
            $('#notification-list').html(data);
            $('#notification-more').removeClass('disable-custom');
        }
    });

});