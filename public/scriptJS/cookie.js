
//http://www.analyste-programmeur.com/javascript/cookies/effacer-un-cookie-en-javascript
//http://www.analyste-programmeur.com/javascript/cookies/lire-un-cookie-javascript

function setCookie(nom, valeur, expire, chemin, domaine, securite){
 			document.cookie = nom + ' = ' + escape(valeur) + '  ' +
           ((expire == undefined) ? '' : ('; expires = ' + expire.toGMTString())) +
           ((chemin == undefined) ? '' : ('; path = ' + chemin)) +
           ((domaine == undefined) ? '' : ('; domain = ' + domaine)) +
           ((securite == true) ? '; secure' : '');
}

function getCookie(name){
     if(document.cookie.length == 0)
       return null;

     var regSepCookie = new RegExp('(; )', 'g');
     var cookies = document.cookie.split(regSepCookie);

     for(var i = 0; i < cookies.length; i++){
       var regInfo = new RegExp('=', 'g');
       var infos = cookies[i].split(regInfo);
       if(infos[0] == name){
         return unescape(infos[1]);
       }
     }
     return null;
   }