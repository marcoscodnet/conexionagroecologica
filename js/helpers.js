var coockieHelper = {
    setCookie: function (name,value,days) {
        var vencimiento = new Date();
        vencimiento.setDate(vencimiento.getDate() + days);
        value = escape(value) + ((days==null) ? "" : "; expires="+vencimiento.toUTCString());
        document.cookie = name + "=" + value;
    },
    getCookie: function (name) {
        var i,x,y,ARRcookies=document.cookie.split(";");
        for (i=0;i<ARRcookies.length;i++) {
            x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
            y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
            x=x.replace(/^\s+|\s+$/g,"");
            if (x==name) return unescape(y);
        }
        return false;
    }
}