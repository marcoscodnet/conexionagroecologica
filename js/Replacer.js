var Replacer = function () {
    this.pattern = /\$\{[a-zA-Z]+(\[\])?\}/g;
    this.replace = function (htmls, object) {
        var pattern = new RegExp(this.pattern), item = '', attr = '';
        while (!!(item = pattern.exec(htmls['main']))) {
            attr = item[0].replace(/\$\{/g, '').replace(/\}/g, '')
            if (item[0].indexOf('[]') != -1) {
                attr = attr.replace('[]','');
                var tpl = this.listReplace(htmls[attr], object[attr])
                htmls['main'] = htmls['main'].replace(item[0], tpl);
            } else {
                htmls['main'] = htmls['main'].replace(item[0], object[attr]);
            }  
        }
        item = attr = null;
        return htmls['main'];
    }
    
    this.listReplace = function (html, object) {
        var tpl = '';
        for (var i in object) {
            tpl += this.itemReplace(html, object[i])
        }
        return tpl;
    }
    
    this.itemReplace = function (html, object) {
        var pattern = /\$\{[a-zA-Z]+(\[\])?\}/g, item = '', attr = '';
        var tpl=html;
        while (item = pattern.exec(html)) {
            attr = item[0].replace(/\$\{/g, '').replace(/\}/g, '')
            tpl = (object[attr]!==undefined)?tpl.replace(item[0], object[attr]):tpl.replace(item[0], '');
        }
        pattern = item = attr = null;
        return tpl;
    }
}