document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridWeek',
        headerToolbar: {
            left: 'prev,next',
            center: 'title',
            right: 'dayGridMonth,dayGridWeek'
        },
        height: 'auto',
        locale: 'fr',
        firstDay: 1,
        events: affectations,
        editable: true,
        eventDrop: function(info) {
            const event = info.event;
            fetch(`/affectation/${event.id}/update-date`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ date: event.start.toISOString().split('T')[0] }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    console.log('Date mise à jour avec succès');
                } else {
                    console.error('Erreur lors de la mise à jour de la date');
                    info.revert();
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                info.revert();
            });
        },
        dayHeaderFormat: { weekday: 'long' },
        views: {
            dayGridWeek: {
                dayHeaderFormat: { weekday: 'long' },
            }
        }
    });
    calendar.render();

    const menuItems = document.querySelectorAll('.sidebar-menu li');
    
    menuItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            
            menuItems.forEach(i => i.classList.remove('active'));
            
            this.classList.add('active');
            
            const itemId = this.querySelector('a').getAttribute('data-id');
            if (itemId) {
                sessionStorage.setItem('activeMenuItem', itemId);
            }
        });
    });
    
    const savedActiveItem = sessionStorage.getItem('activeMenuItem');
    if (savedActiveItem) {
        const itemToActivate = document.querySelector(`.sidebar-menu li a[data-id="${savedActiveItem}"]`);
        if (itemToActivate) {
            const parentLi = itemToActivate.closest('li');
            menuItems.forEach(i => i.classList.remove('active'));
            parentLi.classList.add('active');
        }
    }
});