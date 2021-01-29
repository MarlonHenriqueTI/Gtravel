function Welcome(props) {
    return <h1>Hello, {props.name}</h1>;
  }
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
  
    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'interaction', 'resourceTimeline' ],
      timeZone: 'UTC',
      defaultView: 'resourceTimelineDay',
      aspectRatio: 1.5,
      header: {
        left: 'prev,next',
        center: 'title',
        right: 'resourceTimelineDay,resourceTimelineWeek,resourceTimelineMonth'
      },
      editable: true,
      resourceRender: function(info) {
        var questionMark = document.createElement('a');
        questionMark.innerText = ' (?) ';
        
        info.el.querySelector('.fc-cell-text')
          .appendChild(questionMark);
  
        var tooltip = new Tooltip(questionMark, {
          html: true,
          title: '<span id="wewe">12121dfsfsdfsdfsdfsdfsdfsdfsdsdfsdf<br/>fdfdfdf</span>',
          placement: 'right-start',
          trigger: 'click',
          closeOnClickOutside: true,
          container: 'body',
        },{
          onCreate:data=>{
          }
        });
       //ReactDOM.render(<Welcome/>,document.getElementById('wewe'));
      },
      resourceLabelText: 'Rooms',
      resources: 'https://fullcalendar.io/demo-resources.json?with-nesting&with-colors',
      events: 'https://fullcalendar.io/demo-events.json?single-day&for-resource-timeline'
    });
  
    calendar.render();
  });