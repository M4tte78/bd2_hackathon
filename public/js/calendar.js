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
        editable: false,
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
                dayHeaderFormat: { weekday: 'long', day: 'numeric', month: 'numeric' },
            }
        },
        eventClick: function(info) {
            const event = info.event;
            const start = new Date(event.start);
            const end = event.end ? new Date(event.end) : start;
            
            const formattedStart = start.toLocaleDateString('fr-FR');
            const formattedEnd = end.toLocaleDateString('fr-FR');
            
            const tooltip = document.createElement('div');
            tooltip.className = 'fc-event-tooltip';
            tooltip.innerHTML = `
                <div style="background: white; border: 1px solid #ddd; padding: 5px; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.2); position: absolute; z-index: 1000; font-size: 12px;">
                    <div><strong>${event.extendedProps.employeNom || ''} ${event.extendedProps.employePrenom || ''}</strong></div>
                    <div><strong>Chantier:</strong> ${event.extendedProps.chantierNom || ''}</div>
                    <div><strong>Date début:</strong> ${formattedStart}</div>
                    <div><strong>Date fin:</strong> ${formattedEnd}</div>
                </div>
            `;
            
            document.querySelectorAll('.fc-event-tooltip').forEach(el => el.remove());
            
            document.body.appendChild(tooltip);
            
            const rect = info.el.getBoundingClientRect();
            tooltip.firstElementChild.style.left = rect.left + 'px';
            tooltip.firstElementChild.style.top = (rect.bottom + window.scrollY) + 'px';
            
            document.addEventListener('click', function closeTooltip(e) {
                if (!tooltip.contains(e.target) && !info.el.contains(e.target)) {
                    tooltip.remove();
                    document.removeEventListener('click', closeTooltip);
                }
            });
        }
    });
    calendar.render();
    
    const menuItems = document.querySelectorAll('.sidebar-menu li');
    let currentFilter = '';
    
    menuItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            
            menuItems.forEach(i => i.classList.remove('active'));
            
            this.classList.add('active');
            
            const itemId = this.querySelector('a').getAttribute('data-id');
            if (itemId) {
                sessionStorage.setItem('activeMenuItem', itemId);
                
                if (itemId === 'all') {
                    currentFilter = '';
                } else {
                    currentFilter = itemId;
                }
                
                applyFilter();
            }
        });
    });
    
    function applyFilter() {
        if (currentFilter === '') {
            calendar.getEvents().forEach(event => {
                event.setProp('display', 'auto');
            });
        } else {
            calendar.getEvents().forEach(event => {
                const chantierNom = event.extendedProps.chantierNom || '';
                if (chantierNom.toLowerCase().includes(currentFilter.toLowerCase())) {
                    event.setProp('display', 'auto');
                } else {
                    event.setProp('display', 'none');
                }
            });
        }
    }
    
    const savedActiveItem = sessionStorage.getItem('activeMenuItem');
    if (savedActiveItem) {
        const itemToActivate = document.querySelector(`.sidebar-menu li a[data-id="${savedActiveItem}"]`);
        if (itemToActivate) {
            const parentLi = itemToActivate.closest('li');
            menuItems.forEach(i => i.classList.remove('active'));
            parentLi.classList.add('active');
            
            if (savedActiveItem === 'all') {
                currentFilter = '';
            } else {
                currentFilter = savedActiveItem;
            }
            
            applyFilter();
        }
    }
});