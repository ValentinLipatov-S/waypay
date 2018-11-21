function ChangeURL(parametrs, name, url) {
    var state = {};
    var request = "";
    for (var key in parametrs) {
        switch (key) {
            case "type":
                if (parametrs[key].length > 0) {
                    var types = "";
                    if (parametrs[key].length > 1) {
                        types += parametrs[key][0];
                        for (var i = 1; i < parametrs[key].length; i++)
                            types += "," + parametrs[key][i];
                    }
                    else types += parametrs[key][0];
                    request += key + "=" + types + "&";
                    state.types = types;
                }
                break;
            case "size":
                if (parametrs[key].length > 0) {
                    var types = "";
                    if (parametrs[key].length > 1) {
                        types += parametrs[key][0];
                        for (var i = 1; i < parametrs[key].length; i++)
                            types += "," + parametrs[key][i];
                    }
                    else types += parametrs[key][0];
                    request += key + "=" + types + "&";
                    state.types = types;
                }
                break;
            case "condition":
                if (parametrs[key].length > 0) {
                    var types = "";
                    if (parametrs[key].length > 1) {
                        types += parametrs[key][0];
                        for (var i = 1; i < parametrs[key].length; i++)
                            types += "," + parametrs[key][i];
                    }
                    else types += parametrs[key][0];
                    request += key + "=" + types + "&";
                    state.types = types;
                }
                break;
            default: request += key + "=" + parametrs[key] + "&";
                state[key] = parametrs[key]; break;
        }
    }
    if (request[request.length - 1] === '&') request = request.substr(0, request.length - 1);
    if (request === "") history.pushState(state, "Поиск", "/" + url + "/");
    else history.pushState(state, name, "/" + url + "?" + request);
}

function GetURL(parametrs) {
    var state = {};
    var request = "";
    for (var key in parametrs) {
        switch (key) {
            case "type":
                if (parametrs[key].length > 0) {
                    var types = "";
                    if (parametrs[key].length > 1) {
                        types += parametrs[key][0];
                        for (var i = 1; i < parametrs[key].length; i++)
                            types += "," + parametrs[key][i];
                    }
                    else types += parametrs[key][0];
                    request += key + "=" + types + "&";
                    state.types = types;
                }
                break;
            case "size":
                if (parametrs[key].length > 0) {
                    var types = "";
                    if (parametrs[key].length > 1) {
                        types += parametrs[key][0];
                        for (var i = 1; i < parametrs[key].length; i++)
                            types += "," + parametrs[key][i];
                    }
                    else types += parametrs[key][0];
                    request += key + "=" + types + "&";
                    state.types = types;
                }
                break;
            case "condition":
                if (parametrs[key].length > 0) {
                    var types = "";
                    if (parametrs[key].length > 1) {
                        types += parametrs[key][0];
                        for (var i = 1; i < parametrs[key].length; i++)
                            types += "," + parametrs[key][i];
                    }
                    else types += parametrs[key][0];
                    request += key + "=" + types + "&";
                    state.types = types;
                }
                break;
            default: request += key + "=" + parametrs[key] + "&";
                state[key] = parametrs[key]; break;
        }
    }
    //if (request[request.length - 1] === '&') request = request.substr(0, request.length - 1);
    return request;
}