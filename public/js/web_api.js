(function(exports) {
    var HOST = '/webapi';
    exports.setHost = function(host) {
        HOST = host;
    };
    exports.login = function(email, password, cb) {
        var EMAIL = email || "";
        var PASSWORD = password || "";
        var xhttp = new XMLHttpRequest();
        xhttp.open('post', HOST + "/login.php", true);
        var form = new FormData();
        form.set("email", EMAIL);
        form.set("password", PASSWORD);
        send(xhttp, cb, form);
    };
    exports.isLoggedIn = function(cb) {
        var xhttp = new XMLHttpRequest();
        xhttp.open('post', HOST + "/logged_in.php", true);
        send(xhttp, function(err) {
            cb(!err);
        });
    };
    /*
     *@param {string} type - The type of data
     *@param {Object} data - The data to be stored
     *@param {callback(Error?,Result?)} cb
     **/
    exports.addJsonData = function(type, data, cb) {
        var xhttp = new XMLHttpRequest();
        xhttp.open('post', HOST + "/submit.php", true);
        var obj = JSON.stringify(data);
        var form = new FormData();
        form.set("type", type);
        form.set("data", obj);
        if (cb) {
            xhttp.onload = function(id) {
                if (xhttp.status == 200) {
                    cb(null, {
                        id: id
                    });
                } else {
                    cb(new Error(xhttp.response));
                }
            };
        }
        send(xhttp, cb, form);
    };
    /*
     *@param {string} type - The type of data
     *@param {callback(Error?,[Object])} cb
     **/
    function Data(e) {
        this.id = e.id;
        this.raw = e.raw;
    }
    Data.prototype.data = function() {
        return this._data || (this._data = JSON.parse(this.raw));
    };

    function send(xhttp, cb, data) {
        if (cb) {
            xhttp.onerror = xhttp.onerror || function() {
                cb(new Error(xhttp.statusText));
            };
            xhttp.onload = xhttp.onload || function() {
                if (xhttp.status == 200) {
                    cb(null);
                } else cb(new Error(xhttp.response));
            };
        }
        xhttp.send(data || null);
    }
    exports.inflate = function(data) {
        return data.map(function(e) {
            return new Data(e);
        });
    };
    exports.listJsonData = function(type, cb) {
        var xhttp = new XMLHttpRequest();
        xhttp.open('get', HOST + "/list.php?type=" + encodeURIComponent(type), true);
        console.error('xkkx');
        xhttp.onload = function() {
            var data = xhttp.response;
            if (xhttp.status == 200) {
                data = exports.inflate(JSON.parse(data));
                cb(null, data);
            } else cb(new Error(data));
        };
        send(xhttp, cb);
    };
    var passKey = "dj@4di$&nsn@(e*eisnssiw3939393";
    exports.sendMail = function(title, message, cb) {
        var xhttp = new XMLHttpRequest();
        xhttp.open('post', HOST + "/email.php", true);
        var form = new FormData();
        form.set("title", title);
        form.set("message", message);
        form.set("passkey", passKey);
        send(xhttp, cb, form);
    };
    exports.deleteJsonData = function(type, id, cb) {
        var xhttp = new XMLHttpRequest();
        xhttp.open('get', HOST + "/unlink.php?type=" + encodeURIComponent(type) + "&id=" + encodeURIComponent(id), true);
        send(xhttp, cb);
    };
})((window.WebApi = (window.WebApi || {})));