$( document ).ready(function() {

    function formatDate(timestamp)
    {
        let date = new Date(timestamp*1000);
        // Hours part from the timestamp
        let hours = date.getHours();
        // Minutes part from the timestamp
        let minutes = "0" + date.getMinutes();
        // Seconds part from the timestamp
        let seconds = "0" + date.getSeconds();

        // Will display time in 10:30:23 format
        let formattedTime = hours + ':' + minutes.substr(-2) + ':' + seconds.substr(-2);
        return formattedTime;
    }

    let wrapmessages = $('#wrapmessages');
    let textarea = $('#content');
    wrapmessages.scrollTop(9999);

    function createMessage(content, cat, idcats, time) {
            let mess = $('<article style="border-bottom:2px solid gray;" class="cat-message">');
            let right_part = $('<div class="right-part__cat-message">');
            let datemessage = $('<div class="date-message">');
            datemessage.append(time);
            let catE = $('<a class="creator-message">');
            catE.attr('href', 'http://cats.ru/public/profile/'+idcats);
            catE.append(cat);
            let contentE = $('<div class="content-message">');
            contentE.append(content);
            right_part.append(datemessage);
            right_part.append(catE);
            right_part.append(contentE);
            mess.append(right_part);
            return mess;
    }

    $('#send_message').click(function(event) {
      let message = textarea.val();
      $.get(id_theme + "/addmessage/"+ latest_timestamp +"?message="+message, (data,status) => {
        let jsonData = JSON.parse(data);
        for (var i = jsonData[0].length - 1; i >= 0; i--) {
            wrapmessages.append(createMessage(jsonData[0][i].content, 
                                              jsonData[0][i].name, 
                                              jsonData[0][i].idcats, 
                                              formatDate(jsonData[0][i].created_at)));
        }
        latest_timestamp = jsonData[1];
        textarea.val('');
        wrapmessages.scrollTop(9999);
      });
    });


    setInterval(()=>{
      $.get(id_theme + "/refresh/" + latest_timestamp, (data,status) => {
        if (data != '') {
            let jsonData = JSON.parse(data);
            for (var i = jsonData[0].length - 1; i >= 0; i--) {
                wrapmessages.append(createMessage(jsonData[0][i].content, 
                                                  jsonData[0][i].name,
                                                  jsonData[0][i].idcats, 
                                                  jsonData[0][i].created_at));
            }
            latest_timestamp = jsonData[1];
            wrapmessages.scrollTop(9999);
        }
      });
    }, 5000);
});