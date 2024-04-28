<script crossorigin src="https://unpkg.com/react@18/umd/react.development.js"></script>
<script crossorigin src="https://unpkg.com/react-dom@18/umd/react-dom.development.js"></script>
<script type="text/javascript" src="https://unpkg.com/babel-standalone@6/babel.js"></script>

<!-- Все подключаемые решения могут устанавливаться как через  CDN, так и локально -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Onest:wght@100..900&display=swap" rel="stylesheet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Onest:wght@100..900&display=swap" rel="stylesheet">

<link href="styles.css" rel="stylesheet">

<div id="header">
    <img style="margin-left: 10px;" src="icons/Margin.svg"></img>
    <a href="./"><img src="icons/Button_margin.svg"></img></a>
</div>
    
  
<center><div style="max-width: 1270px" id="root"></div></center>
<img style="width: 100%"src="icons/Footer.png"></img>


<script type="text/babel">
  // Component Left-menu
  function LeftMenu() {
    return <div id="left_menu">
    <ul>
        <li><img class="icon" src="icons/menu/Learn.png"/>Обучение</li>
        <li><img class="icon" src="icons/menu/Pentool.png"/>Задание</li>
        <li><img class="icon" src="icons/menu/Homa.png"/>Анкеты</li>
        <hr/>
        <li><img class="icon" src="icons/menu/Rows.png"/>Наставники</li>
        <a class="menu-link" href="./"><li class="link_current"><img class="icon" src="icons/menu/Chat.png"/>Чат-бот</li></a>
        <hr/>
        <li><img class="icon" src="icons/menu/Settings.png"/>Настройки</li>
    </ul>
    </div>;
  }
  
  //Component Chat-Bot Copilot
    function Copilot() {

    return <div id="copilot">
        <div id="copilot-specialist">
            <div class="people-find"><img class="co-chater-find" src="icons/image.png"/>Поиск людей</div>
            <div class="people-find people-find-person"><img class="co-chater-find" src="icons/Profile.png"/>GeekBrains</div>
        </div>
        <div id="copilot-window">
            <div class="answers-window">
                <div class="message-all"><img height="40px" src="icons/Profile.png"/><div class="message">Я – виртуальный интеллектуальный помощник, соорентирую Вас по действующим курсам и по платформе GB.ru в целом</div></div>
            </div>

            <div id="udata">
                <img onClick={get_answer} id="upload-files" width="24px" height="24px" src="icons/scretch.png" />
                <textarea onKeyPress={handleKeyPress} id="uquestion" name="story" rows="2" placeholder="Опишите Ваш вопрос">
                </textarea>
            </div>
        </div>
    </div>;
  }

  // Render the component to the DOM
  ReactDOM.render(
    <div class="mainDiv">
        <div class="left-menu-centered"><LeftMenu /></div>
        <Copilot />
    </div>,
    document.getElementById("root")
  );
</script>

<script>
        handleKeyPress = (event) => {
          if(event.key === 'Enter'){
            console.log('enter press here! ')
            if(document.getElementById("uquestion").value){
                get_answer();
            }
          }
        }
        
    function get_answer(){
        var requestOptions = {
          method: 'POST',
          redirect: 'follow'
        };
        
        let uquestion = document.getElementById("uquestion").value;
        
        if(uquestion){
            let question_total = `<div style="display:flex; flex-wrap: nowrap; align-items: center;"><div class="message" style="margin-left: auto;">${uquestion}</div><img height="32px" src="icons/Background.png"/></div>`;
            console.log(uquestion);
            fetch(`http://185.185.69.60:8000/question/?question_str=${uquestion}`, requestOptions)
              .then(response => response.json())
              .then(result => { 
                  console.log(result.answer); 
                  let result_br = result.answer.replace(/\n/g,'<br>');
                  document.getElementsByClassName("answers-window")[0].innerHTML += question_total;
                  let answer_total = `<div style="display:flex; flex-wrap: nowrap; align-items: center;"><img height="40px" src="icons/Profile.png"/><div class="message">${result_br}</div></div>`;
                  document.getElementsByClassName("answers-window")[0].innerHTML += answer_total;
                  var div = document.getElementsByClassName("answers-window")[0];
                  div.scrollTop = div.scrollHeight;
              })
              .catch(error => console.log('error', error));
        }
    }
</script>
