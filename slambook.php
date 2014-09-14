<?php
print'
<?xml version="1.0" encoding="UTF-8"?>
<Module>
  <ModulePrefs title="Online SlamBook (pepool.com)">
    <Require feature="opensocial-0.8"/>
    <Require feature="views" />
  </ModulePrefs>
  <Content type="html" view="home,profile,canvas">
<![CDATA[
';
?>
  <script type="text/javascript">
  // In this gadget, users choose a language from a drop-down menu, and the gadget displays
  // a "Hello World" message for the selected language. The gadget uses DOM functions to set 
  // the direction and formatting for the message, depending on whether its language is RTL 
  // or LTR.
  // Associative array containing "Hello World" messages for different languages
  var msgs = new Object();
  msgs = {
    "English" : "Hello World",
    "Hebrew"  : "שלום עולם",
    "French"  : "Bonjour Monde",
    "Arabic"  : "أهلاً بالعالم",
    "Russian" : "Здравствуйте Мир!"
    };
  
  function showMsg() {
    var html="<h1>";
    var div = _gel('mydiv');
    div.style.color = "green";
    var index = document.myform.Language.selectedIndex;
    var lang = document.myform.Language.options[index].text;
    var str = msgs[lang];    
    if (!str)
       str="";
    // If language is Hebrew or Arabic, set the div direction to be right-to-left.
    // Offset text 30px from right margin.
    if(lang=="Hebrew" || lang=="Arabic") {
      div.style.direction = "rtl";
      div.style.marginRight = "30px";
      html += str;
    }
    // For other languages, set div direction to left-to-right.
    // Offset text 30px from left margin.
    else {
      div.style.direction = "ltr";
      div.style.marginLeft = "30px";
      html += str;
    }
    html+= "</h1>";
    div.innerHTML = html;
  }
  </script>
  <div style="background-color: #BFCFFF; height: 200px; color:green;">
    <br />
    <div>
      <form name="myform" style="text-align: center;">
        <select name="Language" onchange="showMsg()">
          <option>Pick a Language
          <option>English
          <option>Hebrew
          <option>French
          <option>Arabic
          <option>Russian
        </select>
      </form>
    </div>
    <br />
    <div id="mydiv"><h2 style='text-align: center;'>****Pick a language****</h2></div>
  </div>

<?php
print']]>
  </Content>
</Module>
';
?>