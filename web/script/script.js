"use strict";


var MyRouter;
window.addEventListener("load", function () { MyRouter = new Router(); MyRouter.Create(); });

function Router() {
    this.WorkForm;

    this.parametrs = [];
    this.path = [];

    Router.prototype.SetParametrs = function SetParametrs() {
        this.parametrs = [];
        this.parametrs['size'] = [];
        this.parametrs['type'] = [];
        this.parametrs['condition'] = [];
        var event = location.search.substr(1).split('&').reduce(function (res, a) {
            var t = a.split('=');
            if (decodeURIComponent(t[0]) !== '')
                res[decodeURIComponent(t[0])] = t.length == 1 ? null : decodeURIComponent(t[1]);
            return res;
        }, {});
        for (var key in event) {
            switch (key) {
                case 'size': this.parametrs[key] = event[key].split(','); break;
                case 'type': this.parametrs[key] = event[key].split(','); break;
                case 'condition': this.parametrs[key] = event[key].split(','); break;
                default: this.parametrs[key] = event[key]; break;
            }
        }
        this.path = location.pathname.split('/');
        for (var i = 0; i < this.path.length; i++)
            if (this.path[i] === "")
                delete this.path[i];
    }

    Router.prototype.Create = function Create() {
        window.onpopstate = this.Update.bind(this);
        this.SetParametrs();
        switch (this.path[1]) {
            case "search":
                this.WorkForm = new SearchForm();
                this.WorkForm.Create();
                this.WorkForm.SetParametrs(this.parametrs);
                break;
            default:
                ChangeURL({}, "Поиск", "search");
                this.WorkForm = new SearchForm();
                this.WorkForm.Create();
                this.WorkForm.SetParametrs(this.parametrs);
                break;
        }
    }

    Router.prototype.Update = function Update() {
        this.SetParametrs();
        switch (this.path[1]) {
            case "search":
                this.WorkForm.SetParametrs(this.parametrs);
                break;
            default: break;
        }
    }
}

function SearchForm() {
    this.url = "search"
    this.name = "Поиск"

    this.CheckBoxs = {};
    this.Inputs = {};

    this.node;
    this.workzone;
    this.parametrs = [];

    SearchForm.prototype.Create = function Create() {

        this.parametrs = [];
        this.parametrs['size'] = [];
        this.parametrs['type'] = [];
        this.parametrs['condition'] = [];

        this.node = document.querySelectorAll('.workarea')[0];





        this.Inputs["sort"] = new Sort(this.node, this.ChangeParametr.bind(this));
        new Clear(this.Inputs["sort"].div, this.Clear.bind(this));


        this.workzone = new CreateDiv(this.node, "workzone");



        this.search = new CreateDiv(this.workzone.node, "right");
        this.search_area = new CreateDiv(this.search.node, "right_box");

        this.items_zone = new CreateDiv(this.workzone.node, "qr");


        var div_search = document.createElement("div");
        div_search.classList.add("search_line");
        this.items_zone.node.appendChild(div_search);
        this.Inputs["query"] = new Search(div_search, this.ChangeParametr.bind(this));


        this.items = new CreateDiv(this.items_zone.node, "left");



        this.Inputs["sex"] = new SexChoose(this.search_area.node, this.ChangeSex.bind(this));
        this.CreateLine(this.search_area.node);




        var div_types = new CreateDiv(this.search_area.node, "types");
        $.ajax({
            method: "GET",
            url: "https://waypay.herokuapp.com//json//types.json",
            success: (function (data) {
                //var obj = JSON.parse(data);
                var obj = data;
                this.CreateCategories(div_types.node, obj, this.CheckBoxChange.bind(this));
            }).bind(this)
        });

        this.CreateLine(this.search_area.node);
        var div_sizes = new CreateDiv(this.search_area.node, "sizes");
        $.ajax({
            method: "GET",
            url: "https://waypay.herokuapp.com//json//sizes.json",
            success: (function (data) {
                //var obj = JSON.parse(data);
                var obj = data;
                this.CreateCategories(div_sizes.node, obj, this.CheckBoxChange.bind(this));
            }).bind(this)
        });

        this.CreateLine(this.search_area.node);
        var minmaxcontainer = new Container(this.search_area.node, "Цена, руб.");
        var div_minmaxpicker = new CreateDiv(minmaxcontainer.node, "maxminvalue");
        this.Inputs["at"] = new MinPicker(div_minmaxpicker.node, this.ChangeParametr.bind(this));
        this.Inputs["to"] = new MaxPicker(div_minmaxpicker.node, this.ChangeParametr.bind(this));

        this.CreateLine(this.search_area.node);
        var div_conditions = new CreateDiv(this.search_area.node, "conditions");
        $.ajax({
            method: "GET",
            url: "https://waypay.herokuapp.com//json//conditions.json",
            success: (function (data) {
                //var obj = JSON.parse(data);
                var obj = data;
                this.CreateCategories(div_conditions.node, obj, this.CheckBoxChange.bind(this));
            }).bind(this)
        });

        this.items = new Items(this.items.node);
        //this.node.appendChild(this.workzone);
    };
    SearchForm.prototype.Clear = function Clear() {
        this.parametrs = [];
        this.parametrs['size'] = [];
        this.parametrs['type'] = [];
        this.parametrs['condition'] = [];
        ChangeURL(this.parametrs, this.name, this.url);
        this.SetParametrs(this.parametrs);
    }

    SearchForm.prototype.CreateLine = function CreateLine(node) {
        var div = new CreateDiv(node, "line");
    }




    SearchForm.prototype.CreateCategories = function CreateCategories(node, obj, callback) {
        for (var key in obj) {
            var a = new Container(node, key);
            this.CheckBoxs[obj[key]["name"]] = {};
            for (var key_1 in obj[key]["all"])
                if (typeof obj[key]["all"][key_1] === "object") {
                    var b = new PopUpMenu(a.node, key_1);
                    for (var key_2 in obj[key]["all"][key_1])
                        this.CheckBoxs[obj[key]["name"]][key_2] = new CheckBox(b, b.node, obj[key]["name"], key_2, obj[key]["all"][key_1][key_2], callback.bind(this));
                }
                else this.CheckBoxs[obj[key]["name"]][key_1] = new CheckBox(undefined, a.node, obj[key]["name"], key_1, obj[key]["all"][key_1], callback.bind(this));
        }
    }

    /* Обработчики */
    SearchForm.prototype.CheckBoxChange = function CheckBoxChange(checkbox) {
        if (checkbox.checked)
            if (this.parametrs[checkbox.name].indexOf(checkbox.id) === -1) this.parametrs[checkbox.name].push(checkbox.id);
            else delete this.parametrs[checkbox.name].splice(this.parametrs[checkbox.name].indexOf(checkbox.id), 1);
        else if (this.parametrs[checkbox.name].indexOf(checkbox.id) !== -1) delete this.parametrs[checkbox.name].splice(this.parametrs[checkbox.name].indexOf(checkbox.id), 1);
        ChangeURL(this.parametrs, this.name, this.url);
        this.GetItems();
    };

    SearchForm.prototype.ChangeSex = function ChangeSex(name, value) {
        if (value === undefined || value === null || value === "") delete this.parametrs[name];
        else this.parametrs[name] = value;
        ChangeURL(this.parametrs, this.name, this.url);
        this.GetItems();
    };

    SearchForm.prototype.ChangeParametr = function ChangeParametr(name, value) {
        if (value === undefined || value === null || value === "") delete this.parametrs[name];
        else this.parametrs[name] = value;
        ChangeURL(this.parametrs, this.name, this.url);
        this.GetItems();
    };



    /* Установка параметров */
    SearchForm.prototype.SetParametrs = function SetParametrs(parametrs) {
        
        this.parametrs = parametrs;
        
        if (this.parametrs['size'] === undefined || this.parametrs['size'] === null)
            this.parametrs['size'] = [];
        if (this.parametrs['type'] === undefined || this.parametrs['type'] === null)
            this.parametrs['type'] = [];
        if (this.parametrs['condition'] === undefined || this.parametrs['condition'] === null)
            this.parametrs['condition'] = [];

        for (var key in this.CheckBoxs)
            for (var id in this.CheckBoxs[key])
                this.CheckBoxs[key][id].SetFalse();

        for (var key in this.Inputs)
            this.Inputs[key].SetDefaultValue();

        for (var key in this.parametrs) {
            switch (key) {
                case 'type':
                    for (var i = 0; i < this.parametrs[key].length; i++)
                    {
                        console.log(key);
                        console.log(parametrs[key][i]);
                        console.log(this.CheckBoxs);
                        
                        this.CheckBoxs[key].this.parametrs[key][i].SetTrue();
                    }
                    break;
                case 'size':
                    for (var i = 0; i < this.parametrs[key].length; i++)
                        this.CheckBoxs[key][this.parametrs[key][i]].SetTrue();
                    break;
                case 'condition':
                    for (var i = 0; i < this.parametrs[key].length; i++)
                        this.CheckBoxs[key][this.parametrs[key][i]].SetTrue();
                    break;
                default: this.Inputs[key].SetValue(this.parametrs[key]); break;
            }
        }
        this.GetItems();
    };


    SearchForm.prototype.GetItems = function GetItems() {
        /*
        if (this.hwr) this.hwr.abort();
        this.hwr = $.ajax({
            url: "/server/server.php",
            method: "GET",
            data: "comand=get&" + GetURL(this.parametrs),
            beforeSend: (function (data) {
                this.counter = 0;
                this.items.Clear();
                this.items.Start();
            }).bind(this),
            success: (function (data) {
                this.items.Stop();
                var obj = JSON.parse(data);
                for (var key in obj) {

                    this.items.Add(obj[key]["id"], obj[key]["img"], obj[key]["name"], obj[key]["price"], obj[key]["model"], obj[key]["size"], obj[key]["date"]);
                }
            }).bind(this),
            abort: (function (data) {
                this.items.Stop();
            }).bind(this),
            error: (function (data) {
                this.items.Stop();
            }).bind(this),
        });
        */
    };
}