
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var cdate=new Date();
    var cy=cdate.getFullYear();
    var cm=cdate.getMonth()+1;
    var cd=cdate.getDate();

    if(cm<10)cm='0'+cm;
    if(cd<10)cd='0'+cd;

    var ctoday=cy+'-'+cm+'-'+cd;
  
    var calendar = new FullCalendar.Calendar(calendarEl, {

        //aspectRatio: 1.5,
        eventTimeFormat: {
            hour: 'numeric',
            minute: '2-digit',
            meridiem: false
          },
      headerToolbar: {
        left: 'prevYear,prev,next,nextYear',
        center: 'title',
        right: 'today dayGridMonth'
      },
      initialDate: '2022-09-01',
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      dayMaxEvents: true, // allow "more" link when too many events
      displayEventEnd: true,
      events: [
        {
          title: '만화영화상영관',       //일정
          start: '2022-09-01',          //yyyy-mm-dd 지정일
          color: '#e71e10'   
        },
        {
            start: '2022-09-01T10:30:00',
            end: '2022-09-01T17:30:00',
            color: '#e71e10'                     //불린 색
            
        },
        {
          title: '일반교육실',
          start: '2022-09-07',        
          end: '2022-09-09', 
          color: '#ffd870'       //범위 지정 (9일까지 잡힘)
        },
        {
            start: '2022-09-07T12:00:00',        
            end: '2022-09-07T15:30:00', 
            color: '#ffd870'       //범위 지정 (9일까지 잡힘)
          },
          {
            start: '2022-09-08T12:00:00',        
            end: '2022-09-08T15:30:00', 
            color: '#ffd870'       //범위 지정 (9일까지 잡힘)
          },
        {
          title: '창의교육실',
          start: '2022-09-11',
          end: '2022-09-14',
          color: '#79a2ff'
        },
        {
            start: '2022-09-11T09:00:00',        
            end: '2022-09-11T18:00:00', 
            color: '#79a2ff'      //범위 지정 (9일까지 잡힘)
          },
          {
            start: '2022-09-12T09:00:00',        
            end: '2022-09-12T18:00:00', 
            color: '#79a2ff'      //범위 지정 (9일까지 잡힘)
          },
          {
            start: '2022-09-13T09:00:00',        
            end: '2022-09-13T18:00:00', 
            color: '#79a2ff'      //범위 지정 (9일까지 잡힘)
          },
        {
            title: '세미나실',
            start: '2022-09-30',
            color: '#65c291'
        },
        {
            start: '2022-09-30T14:00:00',        
            end: '2022-09-30T18:00:00', 
            color: '#65c291'      //범위 지정 (9일까지 잡힘)
          }
       
      ]
    });

    calendar.render();
  });